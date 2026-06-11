const OPEN_DELAY = 300
const CLOSE_DELAY = 100

export default () => ({
  isOpen: false,
  _openTimer: null,
  _closeTimer: null,

  init() {
    const content = this.$el.dataset.tooltipContent || ''
    const side = this.$el.dataset.side || 'top'

    this.$el.setAttribute('data-component', 'tooltip')
    this.$el.setAttribute('data-slot', 'tooltip')
    this.$el.classList.add('relative', 'inline-block')

    const panel =
      this.$el.querySelector('[data-slot="tooltip-content"]') ??
      document.createElement('span')

    if (!panel.id) {
      panel.id = 'tooltip-' + Math.random().toString(36).slice(2, 8)
    }

    panel.setAttribute('data-slot', 'tooltip-content')
    panel.setAttribute('role', 'tooltip')
    panel.textContent = content
    panel.className = [
      'hidden absolute z-50 pointer-events-none',
      'rounded-md px-3 py-1.5 text-xs font-medium whitespace-nowrap',
      'bg-background text-foreground',
      'transition-[opacity,transform] ease-out duration-150',
      'opacity-0 scale-95 shadow',
      this._positionClasses(side),
    ].join(' ')

    if (!panel.parentElement) {
      this.$el.appendChild(panel)
    }

    this._panel = panel

    const trigger =
      this.$el.querySelector('[data-slot="tooltip-trigger"]') ?? this.$el
    trigger.setAttribute('aria-describedby', panel.id)

    this.$watch('isOpen', (open) => {
      if (open) {
        panel.classList.remove('hidden')
        requestAnimationFrame(() => {
          panel.classList.remove('opacity-0', 'scale-95')
          panel.classList.add('opacity-100', 'scale-100')
        })
      } else {
        panel.classList.remove('opacity-100', 'scale-100')
        panel.classList.add('opacity-0', 'scale-95')
        panel.addEventListener(
          'transitionend',
          () => {
            if (!this.isOpen) panel.classList.add('hidden')
          },
          { once: true }
        )
      }
    })

    this.$el.addEventListener('mouseenter', () => this.open())
    this.$el.addEventListener('mouseleave', () => this.close())
    this.$el.addEventListener('focusin', () => this.open())
    this.$el.addEventListener('focusout', () => this.close())
  },

  _positionClasses(side) {
    return (
      {
        top: 'bottom-full left-1/2 -translate-x-1/2 mb-0.5',
        bottom: 'top-full left-1/2 -translate-x-1/2 mt-0.5',
        left: 'right-full top-1/2 -translate-y-1/2 mr-0.5',
        right: 'left-full top-1/2 -translate-y-1/2 ml-0.5',
      }[side] ?? 'bottom-full left-1/2 -translate-x-1/2 mb-0.5'
    )
  },

  open() {
    clearTimeout(this._openTimer)
    clearTimeout(this._closeTimer)
    this._openTimer = setTimeout(() => {
      this.isOpen = true
    }, OPEN_DELAY)
  },

  close() {
    clearTimeout(this._closeTimer)
    clearTimeout(this._openTimer)
    this._closeTimer = setTimeout(() => {
      this.isOpen = false
    }, CLOSE_DELAY)
  },
})
