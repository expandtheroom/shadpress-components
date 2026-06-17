export default () => ({
    open: false,
    side: 'bottom',
    align: 'center',

    init() {
        const root = this.$el.closest('[data-component]')
        this.side = root?.dataset.side || 'bottom'
        this.align = root?.dataset.align || 'center'

        const trigger = this.$el.querySelector('[data-slot="popover-trigger"]')
        if (!trigger) return

        trigger.setAttribute('aria-expanded', 'false')
        trigger.addEventListener('click', () => { this.open = !this.open })
        this.$watch('open', (val) => {
            trigger.setAttribute('aria-expanded', String(val))
        })
    },
})
