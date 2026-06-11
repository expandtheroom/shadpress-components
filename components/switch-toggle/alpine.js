export default () => ({
    checked: false,
    name: '',
    disabled: false,

    init() {
      this.checked = this.$el.dataset.checked === 'true'
      this.name = this.$el.dataset.name || ''
      this.disabled = this.$el.dataset.disabled === 'true'
    },
})
