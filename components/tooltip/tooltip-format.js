/* globals wp */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useRef } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, TextControl, SelectControl } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/tooltip'

  const SIDE_OPTIONS = [
    { label: __('Top', 'shadpress-starter'), value: 'top' },
    { label: __('Bottom', 'shadpress-starter'), value: 'bottom' },
    { label: __('Left', 'shadpress-starter'), value: 'left' },
    { label: __('Right', 'shadpress-starter'), value: 'right' },
  ]

  function TooltipFormatEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [content, setContent] = useState('')
    const [side, setSide] = useState('top')
    const anchorRef = useRef(null)

    function openPopover() {
      if (isActive && activeAttributes) {
        setContent(activeAttributes.content || '')
        setSide(activeAttributes.side || 'top')
      } else {
        setContent('')
        setSide('top')
      }
      setShowPopover(true)
    }

    function apply() {
      onChange(
        toggleFormat(value, {
          type: FORMAT_NAME,
          attributes: {
            component: 'tooltip',
            slot: 'tooltip',
            content,
            side,
            xData: 'tooltip',
          },
        })
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
      el(
        'span',
        { ref: anchorRef },
        el(RichTextToolbarButton, {
          icon: 'info',
          title: __('Tooltip', 'shadpress-starter'),
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
                padding: '16px',
                minWidth: '280px',
                display: 'flex',
                flexDirection: 'column',
                gap: '12px',
              },
            },
            el(TextControl, {
              label: __('Tooltip content', 'shadpress-starter'),
              value: content,
              onChange: setContent,
            }),
            el(SelectControl, {
              label: __('Side', 'shadpress-starter'),
              value: side,
              options: SIDE_OPTIONS,
              onChange: setSide,
            }),
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
                  __('Remove', 'shadpress-starter')
                ),
              el(
                Button,
                { variant: 'secondary', onClick: () => setShowPopover(false) },
                __('Cancel', 'shadpress-starter')
              ),
              el(
                Button,
                {
                  variant: 'primary',
                  onClick: apply,
                  disabled: !content.trim(),
                },
                __('Apply', 'shadpress-starter')
              )
            )
          )
        )
    )
  }

  registerFormatType(FORMAT_NAME, {
    title: __('Tooltip', 'shadpress-starter'),
    tagName: 'span',
    className: 'tooltip',
    attributes: {
      component: 'data-component',
      slot: 'data-slot',
      xData: 'x-data',
      content: 'data-tooltip-content',
      side: 'data-side',
    },
    edit: TooltipFormatEdit,
  })
})()
