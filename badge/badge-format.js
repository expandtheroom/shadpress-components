/* globals wp, shadpressBadgeFormat */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, SelectControl, TextControl, ToggleControl } = wp.components
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

  function BadgeFormatEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [variant, setVariant] = useState('default')
    const [includeIcon, setIncludeIcon] = useState(false)
    const [icon, setIcon] = useState('')
    const [iconProvider, setIconProvider] = useState('')
    const [iconPosition, setIconPosition] = useState('left')

    const providers = (typeof shadpressBadgeFormat !== 'undefined' && shadpressBadgeFormat.iconProviders) || []
    const hasProviders = providers.length > 0
    const isMultiProvider = providers.length > 1

    function openPopover() {
      const attrs = isActive && activeAttributes ? activeAttributes : {}
      setVariant(attrs.variant || 'default')
      setIncludeIcon(attrs.includeIcon === '1')
      setIcon(attrs.icon || '')
      setIconProvider(attrs.iconProvider || (providers[0] ? providers[0].key : ''))
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
      onChange(
        toggleFormat(value, { type: FORMAT_NAME, attributes })
      )
      setShowPopover(false)
    }

    function removeCurrentFormat() {
      onChange(removeFormat(value, FORMAT_NAME))
      setShowPopover(false)
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
                minWidth: '200px',
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
                        options: providers.map((p) => ({ label: p.label, value: p.key })),
                        onChange: (val) => { setIconProvider(val); setIcon('') },
                      }),
                    el(TextControl, {
                      label: __('Icon', 'shadpress-starter'),
                      value: icon,
                      placeholder: __('e.g. star, check, circle', 'shadpress-starter'),
                      onChange: setIcon,
                      __nextHasNoMarginBottom: true,
                    }),
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
