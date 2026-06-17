export default () => ({
    values: [],
    multiple: true,

    init() {
        this.multiple = this.$el.dataset.multiple !== 'false'

        const items = this.$el.querySelectorAll('[data-slot="toggle"]')

        items.forEach((btn) => {
            if (btn.dataset.checked === 'true') {
                this.values.push(btn.dataset.value)
            }
            btn.addEventListener('click', () => this.toggle(btn.dataset.value))
        })

        this.$watch('values', () => this.updateState())
        this.updateState()
    },

    updateState() {
        this.$el.querySelectorAll('[data-slot="toggle"]').forEach((btn) => {
            const on = this.values.includes(btn.dataset.value)
            btn.setAttribute('aria-pressed', String(on))
            btn.setAttribute('data-checked', String(on))
        })
    },

    toggle(val) {
        if (this.multiple) {
            const idx = this.values.indexOf(val)
            this.values = idx === -1
                ? [...this.values, val]
                : this.values.filter((v) => v !== val)
        } else {
            this.values = this.values.includes(val) ? [] : [val]
        }
    },
})
