export default () => ({
    active: null,
    menuCount: 0,
    focusedIndex: 0,

    init() {
        this.menuCount = parseInt(this.$el.dataset.menuCount, 10) || 0

        const triggers = Array.from(this.$el.querySelectorAll('[data-slot="menubar-trigger"]'))

        triggers.forEach((trigger, idx) => {
            trigger.setAttribute('aria-expanded', 'false')
            trigger.setAttribute('tabindex', idx === 0 ? '0' : '-1')
            trigger.addEventListener('click', () => {
                this.active = this.active === idx ? null : idx
            })
            trigger.addEventListener('mouseenter', () => {
                if (this.active !== null) this.active = idx
            })
        })

        this.$watch('active', () => {
            triggers.forEach((trigger, idx) => {
                trigger.setAttribute('aria-expanded', String(this.active === idx))
            })
        })

        this.$watch('focusedIndex', () => {
            triggers.forEach((trigger, idx) => {
                trigger.setAttribute('tabindex', this.focusedIndex === idx ? '0' : '-1')
            })
        })
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
