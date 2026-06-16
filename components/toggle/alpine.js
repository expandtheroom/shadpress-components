export default () => ({
    checked: false,
    disabled: false,

    init() {
      this.checked = this.$el.dataset.checked === 'true'
      this.disabled = this.$el.dataset.disabled === 'true'
    },

    toggle() {
      if (this.disabled) return
      this.checked = !this.checked
    },
})
