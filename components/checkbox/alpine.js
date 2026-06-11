export default () => ({
    checked: false,
    name: '',
    value: '1',
    disabled: false,

    init() {
      this.checked = this.$el.dataset.checked === 'true'
      this.name = this.$el.dataset.name || ''
      this.value = this.$el.dataset.value || '1'
      this.disabled = this.$el.dataset.disabled === 'true'
    },
})
