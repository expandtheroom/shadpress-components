export default () => ({
    open: false,
    selected: null,
    disabled: false,
    placeholder: '',
    name: '',
    activeIndex: -1,
    itemCount: 0,

    init() {
      this.disabled = this.$el.dataset.disabled === 'true'
      this.placeholder = this.$el.dataset.placeholder || 'Select an option'
      this.name = this.$el.dataset.name || ''
      this.itemCount = this.$el.querySelectorAll(
        '[data-slot="select-item"]'
      ).length
    },

    choose(value, label) {
      this.selected = { value, label }
      this.open = false
      this.activeIndex = -1
    },

    openAndMoveNext() {
      if (!this.open) {
        this.open = true
        return
      }
      this.activeIndex =
        this.activeIndex < this.itemCount - 1 ? this.activeIndex + 1 : 0
    },

    openAndMovePrev() {
      if (!this.open) {
        this.open = true
        return
      }
      this.activeIndex =
        this.activeIndex > 0 ? this.activeIndex - 1 : this.itemCount - 1
    },

    confirmActive() {
      if (!this.open || this.activeIndex < 0) return
      const items = Array.from(
        this.$el.querySelectorAll('[data-slot="select-item"]')
      )
      const item = items[this.activeIndex]
      if (item) {
        this.choose(item.dataset.value, item.dataset.label)
      }
    },
})
