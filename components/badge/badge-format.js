/* globals wp */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, SelectControl } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/badge'

  const VARIANT_OPTIONS = [
    { label: __('Default', 'shadpress-starter'), value: 'default' },
    { label: __('Secondary', 'shadpress-starter'), value: 'secondary' },
    { label: __('Destructive', 'shadpress-starter'), value: 'destructive' },
    { label: __('Outline', 'shadpress-starter'), value: 'outline' },
  ]

  function BadgeFormatEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [variant, setVariant] = useState('default')

    function openPopover() {
      setVariant(
        isActive && activeAttributes
          ? activeAttributes.variant || 'default'
          : 'default'
      )
      setShowPopover(true)
    }

    function applyFormat() {
      onChange(
        toggleFormat(value, { type: FORMAT_NAME, attributes: { variant } })
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
                minWidth: '180px',
              },
            },
            el(SelectControl, {
              label: __('Variant', 'shadpress-starter'),
              value: variant,
              options: VARIANT_OPTIONS,
              onChange: setVariant,
            }),
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
    },
    edit: BadgeFormatEdit,
  })
})()
