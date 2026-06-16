export default () => ({
    open: false,
    query: '',
    selected: null,
    activeIndex: -1,
    options: [],
    name: '',
    placeholder: '',

    get filteredOptions() {
      if (!this.query) return this.options
      const q = this.query.toLowerCase()
      return this.options.filter((option) => option.label.toLowerCase().includes(q))
    },

    init() {
      this.name = this.$el.dataset.name || ''
      this.placeholder = this.$el.dataset.placeholder || 'Search...'
      try {
        this.options = JSON.parse(this.$el.dataset.options || '[]')
      } catch (e) {
        this.options = []
      }
    },

    choose(option) {
      this.selected = option
      this.query = ''
      this.open = false
      this.activeIndex = -1
    },

    moveNext() {
      const len = this.filteredOptions.length
      if (!len) return
      this.activeIndex = this.activeIndex < len - 1 ? this.activeIndex + 1 : 0
    },

    movePrev() {
      const len = this.filteredOptions.length
      if (!len) return
      this.activeIndex = this.activeIndex > 0 ? this.activeIndex - 1 : len - 1
    },

    selectActive() {
      if (this.activeIndex >= 0 && this.filteredOptions[this.activeIndex]) {
        this.choose(this.filteredOptions[this.activeIndex])
      }
    },
})
