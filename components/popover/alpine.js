export default () => ({
    open: false,
    side: 'bottom',
    align: 'center',

    init() {
      const root = this.$el.closest('[data-component]')
      this.side = root?.dataset.side || 'bottom'
      this.align = root?.dataset.align || 'center'
    },
})
