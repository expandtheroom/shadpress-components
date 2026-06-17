export default () => ({
    checked: false,

    init() {
        // When inside a toggle group, the group's Alpine manages state — opt out.
        if (this.$el.closest('[data-slot="toggle-group"]')) return

        const btn = this.$el.querySelector('[data-slot="toggle"]')
        if (!btn) return

        this.checked = btn.dataset.checked === 'true'
        btn.addEventListener('click', () => this.toggle(btn))

        this.$watch('checked', () => {
            btn.setAttribute('data-checked', String(this.checked))
            btn.setAttribute('aria-pressed', String(this.checked))
        })
    },

    toggle(btn) {
        if (btn.disabled) return
        this.checked = !this.checked
    },
})
