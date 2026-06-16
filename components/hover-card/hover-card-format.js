/* globals wp */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat, applyFormat: richTextApply } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useRef } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, TextareaControl, SelectControl } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/hover-card'

  const SIDE_OPTIONS = [
    { label: __('Bottom', 'shadpress'), value: 'bottom' },
    { label: __('Top', 'shadpress'), value: 'top' },
    { label: __('Left', 'shadpress'), value: 'left' },
    { label: __('Right', 'shadpress'), value: 'right' },
  ]

  const ALIGN_OPTIONS = [
    { label: __('Center', 'shadpress'), value: 'center' },
    { label: __('Start', 'shadpress'), value: 'start' },
    { label: __('End', 'shadpress'), value: 'end' },
  ]

  function HoverCardEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [cardContent, setCardContent] = useState('')
    const [side, setSide] = useState('bottom')
    const [align, setAlign] = useState('center')
    const anchorRef = useRef(null)
    const openValueRef = useRef(null)
    const openIsActiveRef = useRef(false)

    function openPopover() {
      openValueRef.current = value
      openIsActiveRef.current = isActive

      const attrs = isActive && activeAttributes ? activeAttributes : {}
      setCardContent(attrs.cardContent || '')
      setSide(attrs.side || 'bottom')
      setAlign(attrs.align || 'center')
      setShowPopover(true)
    }

    function applyFormat() {
      const openValue = openValueRef.current
      const openIsActive = openIsActiveRef.current
      const newAttrs = { component: 'hover-card', xData: 'hoverCard', cardContent, side, align }

      if (openIsActive) {
        // Find the full span boundaries from the cursor/selection position, then
        // use Gutenberg's own utilities with explicit indices to remove the old
        // format and apply the new one. This avoids the doubling that occurs
        // when toggleFormat sees the format as still-active after a no-op remove.
        const { formats, start, end } = openValue
        let rangeStart = start
        let rangeEnd = end
        while (rangeStart > 0 && formats[rangeStart - 1]?.some((f) => f.type === FORMAT_NAME)) {
          rangeStart--
        }
        while (rangeEnd < formats.length && formats[rangeEnd]?.some((f) => f.type === FORMAT_NAME)) {
          rangeEnd++
        }
        const newFormat = { type: FORMAT_NAME, attributes: newAttrs }
        const cleared = removeFormat(openValue, FORMAT_NAME, rangeStart, rangeEnd)
        onChange(richTextApply(cleared, newFormat, rangeStart, rangeEnd))
      } else {
        onChange(
          toggleFormat(openValue, {
            type: FORMAT_NAME,
            attributes: newAttrs,
          })
        )
      }

      setShowPopover(false)
    }

    function removeCurrentFormat() {
      const openValue = openValueRef.current
      const { formats, start, end } = openValue
      let rangeStart = start
      let rangeEnd = end
      while (rangeStart > 0 && formats[rangeStart - 1]?.some((f) => f.type === FORMAT_NAME)) {
        rangeStart--
      }
      while (rangeEnd < formats.length && formats[rangeEnd]?.some((f) => f.type === FORMAT_NAME)) {
        rangeEnd++
      }
      onChange(removeFormat(openValue, FORMAT_NAME, rangeStart, rangeEnd))
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
          title: __('Hover Card', 'shadpress'),
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
              label: __('Card content', 'shadpress'),
              value: cardContent,
              onChange: setCardContent,
              rows: 4,
            }),
            el(SelectControl, {
              label: __('Position', 'shadpress'),
              value: side,
              options: SIDE_OPTIONS,
              onChange: setSide,
            }),
            el(SelectControl, {
              label: __('Alignment', 'shadpress'),
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
                  __('Remove', 'shadpress')
                ),
              el(
                Button,
                { variant: 'secondary', onClick: () => setShowPopover(false) },
                __('Cancel', 'shadpress')
              ),
              el(
                Button,
                {
                  variant: 'primary',
                  onClick: applyFormat,
                  disabled: !cardContent.trim(),
                },
                __('Apply', 'shadpress')
              )
            )
          )
        )
    )
  }

  registerFormatType(FORMAT_NAME, {
    name: FORMAT_NAME,
    title: __('Hover Card', 'shadpress'),
    tagName: 'span',
    className: 'hover-card',
    attributes: {
      component: 'data-component',
      xData: 'x-data',
      cardContent: 'data-content',
      side: 'data-side',
      align: 'data-align',
    },
    edit: HoverCardEdit,
  })
})()
