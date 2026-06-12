export default () => ({
    openItems: [],

    init() {
      const type = this.$el.dataset.type || 'single'
      const uid = Math.random().toString(36).slice(2, 8)

      const triggers = Array.from(
        this.$el.querySelectorAll('[data-slot="accordion-trigger"]')
      )
      const panels = Array.from(
        this.$el.querySelectorAll('[data-slot="accordion-content"]')
      )
      const chevrons = triggers.map((t) => t.querySelector('svg'))

      triggers.forEach((trigger, i) => {
        trigger.id = `accordion-trigger-${uid}-${i}`
        trigger.setAttribute('aria-controls', `accordion-panel-${uid}-${i}`)
        trigger.setAttribute('aria-expanded', 'false')
        trigger.setAttribute('data-state', 'closed')
        trigger.addEventListener('click', () => toggle(i))
      })

      panels.forEach((panel, i) => {
        panel.id = `accordion-panel-${uid}-${i}`
        panel.setAttribute('role', 'region')
        panel.setAttribute('aria-labelledby', `accordion-trigger-${uid}-${i}`)
        panel.setAttribute('data-state', 'closed')
      })

      function setOpen(i, open) {
        triggers[i].setAttribute('aria-expanded', open ? 'true' : 'false')
        triggers[i].setAttribute('data-state', open ? 'open' : 'closed')
        panels[i].setAttribute('data-state', open ? 'open' : 'closed')
        if (chevrons[i])
          chevrons[i].setAttribute('data-state', open ? 'open' : 'closed')
        panels[i].style.display = open ? '' : 'none'
      }

      function toggle(i) {
        if (type === 'single') {
          const wasOpen = triggers[i].getAttribute('data-state') === 'open'
          triggers.forEach((_, j) => setOpen(j, false))
          if (!wasOpen) setOpen(i, true)
        } else {
          const isOpen = triggers[i].getAttribute('data-state') === 'open'
          setOpen(i, !isOpen)
        }
      }
    },
})
