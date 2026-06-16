/* globals wp */
;(function () {
  const { registerFormatType, toggleFormat, removeFormat, applyFormat: richTextApply } = wp.richText
  const { RichTextToolbarButton } = wp.blockEditor
  const { useState, useRef } = wp.element
  const { createElement: el, Fragment } = wp.element
  const { Popover, Button, TextControl, SelectControl } = wp.components
  const { __ } = wp.i18n

  const FORMAT_NAME = 'shadpress/tooltip'

  const SIDE_OPTIONS = [
    { label: __('Top', 'shadpress'), value: 'top' },
    { label: __('Bottom', 'shadpress'), value: 'bottom' },
    { label: __('Left', 'shadpress'), value: 'left' },
    { label: __('Right', 'shadpress'), value: 'right' },
  ]

  function TooltipFormatEdit({ value, onChange, isActive, activeAttributes }) {
    const [showPopover, setShowPopover] = useState(false)
    const [content, setContent] = useState('')
    const [side, setSide] = useState('top')
    const anchorRef = useRef(null)
    const openValueRef = useRef(null)
    const openIsActiveRef = useRef(false)

    function openPopover() {
      openValueRef.current = value
      openIsActiveRef.current = isActive
      const attrs = isActive && activeAttributes ? activeAttributes : {}
      setContent(attrs.content || '')
      setSide(attrs.side || 'top')
      setShowPopover(true)
    }

    function apply() {
      const openValue = openValueRef.current
      const openIsActive = openIsActiveRef.current
      const attributes = { component: 'tooltip', slot: 'tooltip', content, side, xData: 'tooltip' }
      if (openIsActive) {
        const { formats, start, end } = openValue
        let rangeStart = start
        let rangeEnd = end
        while (rangeStart > 0 && formats[rangeStart - 1]?.some((f) => f.type === FORMAT_NAME)) {
          rangeStart--
        }
        while (rangeEnd < formats.length && formats[rangeEnd]?.some((f) => f.type === FORMAT_NAME)) {
          rangeEnd++
        }
        const newFormat = { type: FORMAT_NAME, attributes }
        const cleared = removeFormat(openValue, FORMAT_NAME, rangeStart, rangeEnd)
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
          icon: 'info',
          title: __('Tooltip', 'shadpress'),
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
              label: __('Tooltip content', 'shadpress'),
              value: content,
              onChange: setContent,
            }),
            el(SelectControl, {
              label: __('Side', 'shadpress'),
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
                  onClick: apply,
                  disabled: !content.trim(),
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
    title: __('Tooltip', 'shadpress'),
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
