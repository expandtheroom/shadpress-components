/* global acf, iconPickerData, jQuery */
;(function ($) {
  'use strict'

  if (typeof acf === 'undefined') return
  ;(function injectStyles() {
    if (document.getElementById('shadpress-lucide-icon-picker-styles')) return
    $('<style id="shadpress-lucide-icon-picker-styles">')
      .text(
        '@keyframes shadpress-spin { to { transform: rotate(360deg); } }' +
          '.shadpress-icon-spinner {' +
          '  display:inline-block;width:14px;height:14px;' +
          '  border:2px solid rgba(0,0,0,.12);border-top-color:rgba(0,0,0,.45);' +
          '  border-radius:50%;animation:shadpress-spin .6s linear infinite;' +
          '  vertical-align:middle;margin-left:8px;' +
          '}'
      )
      .appendTo('head')
  })()

  function getIconsData() {
    return typeof iconPickerData !== 'undefined' && iconPickerData.iconsData
      ? iconPickerData.iconsData
      : {}
  }

  function buildIconSpan(slug, text, size) {
    var raw = getIconsData()[slug]
    if (!raw) return text

    var svgHtml = raw.slice(raw.indexOf('<svg'))
    var $icon = $(svgHtml)
      .attr({ width: size, height: size })
      .css('flex-shrink', '0')

    return $('<span style="display:inline-flex;align-items:center;gap:8px;">')
      .append($icon)
      .append(document.createTextNode(' ' + text))
  }

  function formatResult(option) {
    if (!option.id) return option.text
    return buildIconSpan(option.id, option.text, '16')
  }

  function formatSelection(option) {
    if (!option.id) return option.text
    return buildIconSpan(option.id, option.text, '20')
  }

  function initIconField(field) {
    var $select = field.$el.find('.acf-icon-select')
    if (!$select.length) return

    // PHP may not receive the saved value in Gutenberg.
    // Try ACF model first, then fall back to wp.data block store.
    var savedVal =
      (field.get && field.get('value')) || (field.val && field.val()) || ''
    if (!savedVal) {
      try {
        var fieldName = field.get && field.get('name')
        var blockData = wp.data.select('core/block-editor').getSelectedBlock()
        blockData =
          blockData && blockData.attributes && blockData.attributes.data
        savedVal = (blockData && fieldName && blockData[fieldName]) || ''
      } catch (e) {
        /* wp.data unavailable */
      }
    }
    if (savedVal && !$select.val()) {
      $select.val(savedVal)
    }

    if ($select.data('select2')) {
      $select.select2('destroy')
    }

    $select.select2({
      width: '100%',
      templateResult: formatResult,
      templateSelection: formatSelection,
    })

    $select
      .on('select2:opening', function () {
        $(this)
          .next('.select2-container')
          .find('.select2-selection__rendered')
          .append('<span class="shadpress-icon-spinner"></span>')
      })
      .on('select2:open', function () {
        $(this)
          .next('.select2-container')
          .find('.shadpress-icon-spinner')
          .remove()
      })
  }

  acf.addAction('new_field/type=theme_icon_picker', initIconField)
  acf.addAction('remount_field/type=theme_icon_picker', initIconField)
})(jQuery)
