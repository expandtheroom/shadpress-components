export default () => ({
    open: false,

    init() {
      this.$el.addEventListener('keydown', (e) => {
        if (!this.open) return
        const items = Array.from(this.$el.querySelectorAll('[role="menuitem"]'))
        const current = document.activeElement
        const idx = items.indexOf(current)
        if (e.key === 'ArrowDown') {
          e.preventDefault()
          const next = idx < items.length - 1 ? items[idx + 1] : items[0]
          next && next.focus()
        } else if (e.key === 'ArrowUp') {
          e.preventDefault()
          const prev = idx > 0 ? items[idx - 1] : items[items.length - 1]
          prev && prev.focus()
        } else if (e.key === 'Tab') {
          this.open = false
        }
      })
    },
})
