export default () => ({
    selected: '',
    disabled: false,
    name: '',
    options: [],

    init() {
      this.selected = this.$el.dataset.defaultValue || ''
      this.disabled = this.$el.dataset.disabled === 'true'
      this.name = this.$el.dataset.name || ''

      const buttons = Array.from(
        this.$el.querySelectorAll('[data-slot="radio-group-item"]')
      )
      this.options = buttons.map((btn) => btn.dataset.value)

      this.updateTabindex()
    },

    select(val) {
      if (this.disabled) return
      this.selected = val
      this.updateTabindex()
    },

    updateTabindex() {
      const buttons = Array.from(
        this.$el.querySelectorAll('[data-slot="radio-group-item"]')
      )
      const activeVal =
        this.selected || (buttons[0] ? buttons[0].dataset.value : '')
      buttons.forEach((btn) => {
        btn.tabIndex = btn.dataset.value === activeVal ? 0 : -1
      })
    },

    movePrev() {
      if (!this.options.length) return
      const idx = this.options.indexOf(this.selected)
      const prev = idx <= 0 ? this.options.length - 1 : idx - 1
      this.select(this.options[prev])
    },

    moveNext() {
      if (!this.options.length) return
      const idx = this.options.indexOf(this.selected)
      const next = idx < 0 || idx >= this.options.length - 1 ? 0 : idx + 1
      this.select(this.options[next])
    },
})
