export default () => ({
    type: 'single',
    value: '',
    values: [],

    init() {
      this.type = this.$el.dataset.type || 'single'
      const def = this.$el.dataset.default || ''

      if (this.type === 'single') {
        this.value = def
      } else {
        this.values = def
          ? def
              .split(',')
              .map((v) => v.trim())
              .filter(Boolean)
          : []
      }
    },

    toggle(val) {
      if (this.type === 'single') {
        this.value = this.value === val ? '' : val
      } else {
        const idx = this.values.indexOf(val)
        if (idx === -1) {
          this.values = [...this.values, val]
        } else {
          this.values = this.values.filter((v) => v !== val)
        }
      }
    },
})
