/* globals wp, shadpressBadgeFormat, iconPickerData */
;(function () {
  const {
    registerFormatType,
    toggleFormat,
    removeFormat,
    applyFormat: richTextApply,
  } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useLayoutEffect, useRef } = wp.element
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
    { label: __('Default', 'shadpress'), value: 'default' },
    { label: __('Secondary', 'shadpress'), value: 'secondary' },
    { label: __('Destructive', 'shadpress'), value: 'destructive' },
    { label: __('Outline', 'shadpress'), value: 'outline' },
  ]

  const POSITION_OPTIONS = [
    { label: __('Left', 'shadpress'), value: 'left' },
    { label: __('Right', 'shadpress'), value: 'right' },
  ]

  function BadgeFormatEdit({
    value,
    onChange,
    isActive,
    activeAttributes,
    contentRef,
  }) {
    const [showPopover, setShowPopover] = useState(false)
    const [variant, setVariant] = useState('default')
    const [includeIcon, setIncludeIcon] = useState(false)
    const [icon, setIcon] = useState('')
    const [iconProvider, setIconProvider] = useState('')
    const [iconPosition, setIconPosition] = useState('left')
    const anchorRef = useRef(null)
    const openValueRef = useRef(null)
    const openIsActiveRef = useRef(false)

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
            'display:inline-flex;align-items:baseline;line-height:0;pointer-events:none;flex-shrink:0;width:1em;height:1em;'
          wrapper.innerHTML = svgHtml

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
      openValueRef.current = value
      openIsActiveRef.current = isActive
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
      const openValue = openValueRef.current
      const openIsActive = openIsActiveRef.current
      const attributes = { variant, component: 'badge' }
      if (hasProviders) {
        attributes.includeIcon = includeIcon ? '1' : '0'
        attributes.icon = icon
        if (iconProvider) attributes.iconProvider = iconProvider
        attributes.iconPosition = iconPosition
      }
      if (openIsActive) {
        const { formats, start, end } = openValue
        let rangeStart = start
        let rangeEnd = end
        while (
          rangeStart > 0 &&
          formats[rangeStart - 1]?.some((f) => f.type === FORMAT_NAME)
        ) {
          rangeStart--
        }
        while (
          rangeEnd < formats.length &&
          formats[rangeEnd]?.some((f) => f.type === FORMAT_NAME)
        ) {
          rangeEnd++
        }
        const newFormat = { type: FORMAT_NAME, attributes }
        const cleared = removeFormat(
          openValue,
          FORMAT_NAME,
          rangeStart,
          rangeEnd
        )
        onChange(richTextApply(cleared, newFormat, rangeStart, rangeEnd))
      } else {
        onChange(toggleFormat(openValue, { type: FORMAT_NAME, attributes }))
      }
      setShowPopover(false)
    }

    function removeCurrentFormat() {
      const openValue = openValueRef.current
      const { formats, start, end } = openValue
      let rangeStart = start
      let rangeEnd = end
      while (
        rangeStart > 0 &&
        formats[rangeStart - 1]?.some((f) => f.type === FORMAT_NAME)
      ) {
        rangeStart--
      }
      while (
        rangeEnd < formats.length &&
        formats[rangeEnd]?.some((f) => f.type === FORMAT_NAME)
      ) {
        rangeEnd++
      }
      onChange(removeFormat(openValue, FORMAT_NAME, rangeStart, rangeEnd))
      setShowPopover(false)
    }

    function renderIconPicker() {
      if (iconOptions.length > 0) {
        return el(ComboboxControl, {
          label: __('Icon', 'shadpress'),
          value: icon,
          options: iconOptions,
          onChange: setIcon,
          __nextHasNoMarginBottom: true,
        })
      }
      return el(TextControl, {
        label: __('Icon', 'shadpress'),
        value: icon,
        placeholder: __('e.g. star, check, circle', 'shadpress'),
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
              dangerouslySetInnerHTML: { __html: svg },
            })
          : null,
        el('span', { style: { fontSize: '12px', color: '#757575' } }, icon)
      )
    }

    return el(
      Fragment,
      null,
      el(
        'span',
        { ref: anchorRef },
        el(RichTextToolbarButton, {
          icon: 'tag',
          title: __('Badge', 'shadpress'),
          onClick: openPopover,
          isActive,
        })
      ),
      showPopover &&
        el(
          Popover,
          {
            anchor: anchorRef.current,
            onClose: () => setShowPopover(false),
            placement: 'bottom-start',
          },
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
              label: __('Variant', 'shadpress'),
              value: variant,
              options: VARIANT_OPTIONS,
              onChange: setVariant,
            }),
            hasProviders &&
              el(
                Fragment,
                null,
                el(ToggleControl, {
                  label: __('Include Icon', 'shadpress'),
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
                        label: __('Icon Provider', 'shadpress'),
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
                      label: __('Icon Position', 'shadpress'),
                      value: iconPosition,
                      options: POSITION_OPTIONS,
                      onChange: setIconPosition,
                    })
                  )
              ),
            el(
              'div',
              {
                style: {
                  display: 'flex',
                  gap: '8px',
                  justifyContent: 'flex-end',
                },
              },
              isActive &&
                el(
                  Button,
                  {
                    variant: 'tertiary',
                    isDestructive: true,
                    onClick: removeCurrentFormat,
                  },
                  __('Remove', 'shadpress')
                ),
              el(
                Button,
                { variant: 'secondary', onClick: () => setShowPopover(false) },
                __('Cancel', 'shadpress')
              ),
              el(
                Button,
                { variant: 'primary', onClick: applyFormat },
                __('Apply', 'shadpress')
              )
            )
          )
        )
    )
  }

  registerFormatType(FORMAT_NAME, {
    name: FORMAT_NAME,
    title: __('Badge', 'shadpress'),
    tagName: 'span',
    className: 'shadpress-badge',
    attributes: {
      component: 'data-component',
      variant: 'data-variant',
      includeIcon: 'data-include-icon',
      icon: 'data-icon',
      iconProvider: 'data-icon-provider',
      iconPosition: 'data-icon-position',
    },
    edit: BadgeFormatEdit,
  })
})()
