export default () => ({
    active: null,
    menuCount: 0,
    focusedIndex: 0,

    init() {
      this.menuCount = parseInt(this.$el.dataset.menuCount, 10) || 0
    },

    moveFocus(dir) {
      if (this.active === null) return
      let next = this.active + dir
      if (next < 0) next = this.menuCount - 1
      if (next >= this.menuCount) next = 0
      this.active = next
      this.focusedIndex = next
      const triggers = Array.from(
        this.$el.querySelectorAll('[data-slot="menubar-trigger"]')
      )
      const target = triggers[next]
      if (target) target.focus()
    },
})
