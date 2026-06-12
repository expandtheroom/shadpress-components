export default () => ({
    open: false,

    init() {
      const root = this.$el.closest('[data-component]')
      this.open = root?.dataset.open === 'true'
    },

    toggle() {
      this.open = !this.open
    },
})
