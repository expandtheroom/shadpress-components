export default () => ({
    open: false,
    id: '',

    openDialog() {
      this.open = true
      this.$nextTick(() => this.$refs.panel.focus())
    },

    init() {
      const uid = Math.random().toString(36).slice(2, 8)
      this.id = 'dialog-' + uid

      this.$watch('open', (val) => {
        document.body.style.overflow = val ? 'hidden' : ''
      })

      this.$el.addEventListener('keydown', (e) => {
        if (!this.open || e.key !== 'Tab') return

        const panel = this.$refs.panel
        const focusable = Array.from(
          panel.querySelectorAll(
            'a[href],button:not([disabled]),input:not([disabled]),select:not([disabled]),textarea:not([disabled]),[tabindex]:not([tabindex="-1"])'
          )
        ).filter((el) => !el.closest('[style*="display:none"]'))

        if (focusable.length === 0) {
          e.preventDefault()
          return
        }

        const first = focusable[0]
        const last = focusable[focusable.length - 1]

        if (e.shiftKey) {
          if (document.activeElement === first) {
            e.preventDefault()
            last.focus()
          }
        } else {
          if (document.activeElement === last) {
            e.preventDefault()
            first.focus()
          }
        }
      })
    },
})
