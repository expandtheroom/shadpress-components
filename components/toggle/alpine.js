export default () => ({
    pressed: false,
    disabled: false,

    init() {
      const root = this.$el.closest('[data-component]')
      this.pressed = root?.dataset.pressed === 'true'
      this.disabled = root?.dataset.disabled === 'true'
    },

    toggle() {
      if (this.disabled) return
      this.pressed = !this.pressed
    },
})
