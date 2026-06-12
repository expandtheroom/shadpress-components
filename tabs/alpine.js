export default () => ({
    activeTab: 0,

    init() {
      const uid = Math.random().toString(36).slice(2, 8)
      const triggers = Array.from(
        this.$el.querySelectorAll('[data-slot="tab-trigger"]')
      )
      const panels = Array.from(
        this.$el.querySelectorAll('[data-slot="tab-panel"]')
      )

      triggers.forEach((trigger, i) => {
        trigger.id = `tab-trigger-${uid}-${i}`
        trigger.setAttribute('aria-controls', `tab-panel-${uid}-${i}`)
        this._applyTriggerState(trigger, i === 0)

        trigger.addEventListener('click', () => this._activate(i))

        trigger.addEventListener('keydown', (e) => {
          const count = triggers.length
          if (e.key === 'ArrowRight') {
            e.preventDefault()
            this._activate((i + 1) % count)
          }
          if (e.key === 'ArrowLeft') {
            e.preventDefault()
            this._activate((i - 1 + count) % count)
          }
          if (e.key === 'Home') {
            e.preventDefault()
            this._activate(0)
          }
          if (e.key === 'End') {
            e.preventDefault()
            this._activate(count - 1)
          }
        })
      })

      panels.forEach((panel, i) => {
        panel.id = `tab-panel-${uid}-${i}`
        panel.setAttribute('aria-labelledby', `tab-trigger-${uid}-${i}`)
        panel.setAttribute('data-state', i === 0 ? 'active' : 'inactive')
        if (i !== 0) panel.style.display = 'none'
      })
    },

    _activate(index) {
      const triggers = Array.from(
        this.$el.querySelectorAll('[data-slot="tab-trigger"]')
      )
      const panels = Array.from(
        this.$el.querySelectorAll('[data-slot="tab-panel"]')
      )

      this.activeTab = index

      triggers.forEach((trigger, i) => {
        this._applyTriggerState(trigger, i === index)
        if (i === index) trigger.focus()
      })

      panels.forEach((panel, i) => {
        panel.style.display = i === index ? '' : 'none'
        panel.setAttribute('data-state', i === index ? 'active' : 'inactive')
      })
    },

    _applyTriggerState(trigger, isActive) {
      trigger.setAttribute('aria-selected', isActive ? 'true' : 'false')
      trigger.setAttribute('data-state', isActive ? 'active' : 'inactive')
      trigger.setAttribute('tabindex', isActive ? '0' : '-1')

      if (isActive) {
        trigger.classList.add('bg-background', 'text-foreground', 'shadow')
      } else {
        trigger.classList.remove('bg-background', 'text-foreground', 'shadow')
      }
    },
})
