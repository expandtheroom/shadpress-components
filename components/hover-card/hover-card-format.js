/* globals wp */
;(function () {
  const { registerFormatType, toggleFormat, getActiveFormat, removeFormat } =
    wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useRef } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, TextareaControl, SelectControl } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/hover-card'

  const SIDE_OPTIONS = [
    { label: __('Bottom', 'shadpress-starter'), value: 'bottom' },
    { label: __('Top', 'shadpress-starter'), value: 'top' },
    { label: __('Left', 'shadpress-starter'), value: 'left' },
    { label: __('Right', 'shadpress-starter'), value: 'right' },
  ]

  const ALIGN_OPTIONS = [
    { label: __('Center', 'shadpress-starter'), value: 'center' },
    { label: __('Start', 'shadpress-starter'), value: 'start' },
    { label: __('End', 'shadpress-starter'), value: 'end' },
  ]

  function HoverCardEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [cardContent, setCardContent] = useState('')
    const [side, setSide] = useState('bottom')
    const [align, setAlign] = useState('center')
    const anchorRef = useRef(null)

    function openPopover() {
      if (isActive && activeAttributes) {
        setCardContent(activeAttributes.cardContent || '')
        setSide(activeAttributes.side || 'bottom')
        setAlign(activeAttributes.align || 'center')
      } else {
        setCardContent('')
        setSide('bottom')
        setAlign('center')
      }
      setShowPopover(true)
    }

    function applyFormat() {
      onChange(
        toggleFormat(value, {
          type: FORMAT_NAME,
          attributes: {
            xData: 'hoverCard',
            cardContent,
            side,
            align,
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
          icon: 'info-outline',
          title: __('Hover Card', 'shadpress-starter'),
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
            el(TextareaControl, {
              label: __('Card content', 'shadpress-starter'),
              value: cardContent,
              onChange: setCardContent,
              rows: 4,
            }),
            el(SelectControl, {
              label: __('Position', 'shadpress-starter'),
              value: side,
              options: SIDE_OPTIONS,
              onChange: setSide,
            }),
            el(SelectControl, {
              label: __('Alignment', 'shadpress-starter'),
              value: align,
              options: ALIGN_OPTIONS,
              onChange: setAlign,
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
                  onClick: applyFormat,
                  disabled: !cardContent.trim(),
                },
                __('Apply', 'shadpress-starter')
              )
            )
          )
        )
    )
  }

  registerFormatType(FORMAT_NAME, {
    title: __('Hover Card', 'shadpress-starter'),
    tagName: 'span',
    className: 'hover-card',
    attributes: {
      xData: 'x-data',
      cardContent: 'data-content',
      side: 'data-side',
      align: 'data-align',
    },
    edit: HoverCardEdit,
  })
})()
