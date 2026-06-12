/* globals wp, shadpressBadgeFormat, iconPickerData */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useLayoutEffect } = wp.element
  const { createElement: el, Fragment } = wp.element
  const {
    Popover,
    Button,
    SelectControl,
    TextControl,
    ComboboxControl,
    ToggleControl,
  } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/badge'

  const VARIANT_OPTIONS = [
    { label: __('Default', 'shadpress-starter'), value: 'default' },
    { label: __('Secondary', 'shadpress-starter'), value: 'secondary' },
    { label: __('Destructive', 'shadpress-starter'), value: 'destructive' },
    { label: __('Outline', 'shadpress-starter'), value: 'outline' },
  ]

  const POSITION_OPTIONS = [
    { label: __('Left', 'shadpress-starter'), value: 'left' },
    { label: __('Right', 'shadpress-starter'), value: 'right' },
  ]

  function scaleSvg(svg, size) {
    return svg.replace(
      '<svg',
      '<svg width="' +
        size +
        '" height="' +
        size +
        '" style="flex-shrink:0;vertical-align:middle"'
    )
  }

  function BadgeFormatEdit({ value, onChange, isActive, activeAttributes, contentRef }) {
    const [showPopover, setShowPopover] = useState(false)
    const [variant, setVariant] = useState('default')
    const [includeIcon, setIncludeIcon] = useState(false)
    const [icon, setIcon] = useState('')
    const [iconProvider, setIconProvider] = useState('')
    const [iconPosition, setIconPosition] = useState('left')

    const providers =
      typeof shadpressBadgeFormat !== 'undefined'
        ? shadpressBadgeFormat.iconProviders || []
        : []
    const hasProviders = providers.length > 0
    const isMultiProvider = providers.length > 1
    const iconsData =
      typeof iconPickerData !== 'undefined'
        ? iconPickerData.iconsData || {}
        : {}

    useLayoutEffect(() => {
      if (!contentRef || !contentRef.current) return
      if (!Object.keys(iconsData).length) return

      const root = contentRef.current
      const doc = root.ownerDocument

      root.querySelectorAll('[data-badge-preview]').forEach((n) => n.remove())
      root
        .querySelectorAll('.shadpress-badge[data-include-icon="1"][data-icon]')
        .forEach((span) => {
          const name = span.getAttribute('data-icon')
          const svgHtml = iconsData[name]
          if (!svgHtml) return

          const position = span.getAttribute('data-icon-position') || 'left'
          const wrapper = doc.createElement('span')
          wrapper.setAttribute('data-badge-preview', '1')
          wrapper.setAttribute('contenteditable', 'false')
          wrapper.style.cssText =
            'display:inline-flex;align-items:center;line-height:0;pointer-events:none;flex-shrink:0'
          wrapper.innerHTML = svgHtml

          const svgEl = wrapper.querySelector('svg')
          if (svgEl) {
            svgEl.removeAttribute('width')
            svgEl.removeAttribute('height')
            svgEl.style.cssText = 'width:1em;height:1em;vertical-align:-0.125em'
          }

          if (position === 'right') span.appendChild(wrapper)
          else span.insertBefore(wrapper, span.firstChild)
        })
    })

    const currentProvider =
      providers.find((p) => p.key === iconProvider) || providers[0]
    const iconOptions = (
      currentProvider && currentProvider.icons ? currentProvider.icons : []
    ).map((name) => ({ value: name, label: name }))

    function openPopover() {
      const attrs = isActive && activeAttributes ? activeAttributes : {}
      setVariant(attrs.variant || 'default')
      setIncludeIcon(attrs.includeIcon === '1')
      setIcon(attrs.icon || '')
      setIconProvider(
        attrs.iconProvider || (providers[0] ? providers[0].key : '')
      )
      setIconPosition(attrs.iconPosition || 'left')
      setShowPopover(true)
    }

    function applyFormat() {
      const attributes = { variant }
      if (hasProviders) {
        attributes.includeIcon = includeIcon ? '1' : '0'
        attributes.icon = icon
        if (iconProvider) attributes.iconProvider = iconProvider
        attributes.iconPosition = iconPosition
      }
      const base = isActive ? removeFormat(value, FORMAT_NAME) : value
      onChange(toggleFormat(base, { type: FORMAT_NAME, attributes }))
      setShowPopover(false)
    }

    function removeCurrentFormat() {
      onChange(removeFormat(value, FORMAT_NAME))
      setShowPopover(false)
    }

    function renderIconPicker() {
      if (iconOptions.length > 0) {
        return el(ComboboxControl, {
          label: __('Icon', 'shadpress-starter'),
          value: icon,
          options: iconOptions,
          onChange: setIcon,
          __nextHasNoMarginBottom: true,
        })
      }
      return el(TextControl, {
        label: __('Icon', 'shadpress-starter'),
        value: icon,
        placeholder: __('e.g. star, check, circle', 'shadpress-starter'),
        onChange: setIcon,
        __nextHasNoMarginBottom: true,
      })
    }

    function renderIconPreview() {
      if (!icon) return null
      const svg = iconsData[icon]
      return el(
        'div',
        {
          style: {
            display: 'flex',
            alignItems: 'center',
            gap: '6px',
            padding: '4px 0',
          },
        },
        svg
          ? el('span', {
              dangerouslySetInnerHTML: { __html: scaleSvg(svg, 20) },
            })
          : null,
        el('span', { style: { fontSize: '12px', color: '#757575' } }, icon)
      )
    }

    return el(
      Fragment,
      null,
      el(RichTextToolbarButton, {
        icon: 'tag',
        title: __('Badge', 'shadpress-starter'),
        onClick: openPopover,
        isActive,
      }),
      showPopover &&
        el(
          Popover,
          { onClose: () => setShowPopover(false), placement: 'bottom-start' },
          el(
            'div',
            {
              style: {
                padding: '12px',
                display: 'flex',
                flexDirection: 'column',
                gap: '8px',
                minWidth: '240px',
              },
            },
            el(SelectControl, {
              label: __('Variant', 'shadpress-starter'),
              value: variant,
              options: VARIANT_OPTIONS,
              onChange: setVariant,
            }),
            hasProviders &&
              el(
                Fragment,
                null,
                el(ToggleControl, {
                  label: __('Include Icon', 'shadpress-starter'),
                  checked: includeIcon,
                  onChange: setIncludeIcon,
                  __nextHasNoMarginBottom: true,
                }),
                includeIcon &&
                  el(
                    Fragment,
                    null,
                    isMultiProvider &&
                      el(SelectControl, {
                        label: __('Icon Provider', 'shadpress-starter'),
                        value: iconProvider,
                        options: providers.map((p) => ({
                          label: p.label,
                          value: p.key,
                        })),
                        onChange: (val) => {
                          setIconProvider(val)
                          setIcon('')
                        },
                      }),
                    renderIconPicker(),
                    renderIconPreview(),
                    el(SelectControl, {
                      label: __('Icon Position', 'shadpress-starter'),
                      value: iconPosition,
                      options: POSITION_OPTIONS,
                      onChange: setIconPosition,
                    })
                  )
              ),
            el(
              'div',
              { style: { display: 'flex', gap: '8px' } },
              el(
                Button,
                { variant: 'primary', onClick: applyFormat },
                __('Apply', 'shadpress-starter')
              ),
              isActive &&
                el(
                  Button,
                  { variant: 'secondary', onClick: removeCurrentFormat },
                  __('Remove', 'shadpress-starter')
                )
            )
          )
        )
    )
  }

  registerFormatType(FORMAT_NAME, {
    name: FORMAT_NAME,
    title: __('Badge', 'shadpress-starter'),
    tagName: 'span',
    className: 'shadpress-badge',
    attributes: {
      variant: 'data-variant',
      includeIcon: 'data-include-icon',
      icon: 'data-icon',
      iconProvider: 'data-icon-provider',
      iconPosition: 'data-icon-position',
    },
    edit: BadgeFormatEdit,
  })
})()
