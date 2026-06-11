const OPEN_DELAY = 500
const CLOSE_DELAY = 500

export default () => ({
    isOpen: false,
    _openTimer: null,
    _closeTimer: null,

    init() {
      const side = this.$el.dataset.side || 'bottom'
      const align = this.$el.dataset.align || 'center'
      const content = this.$el.dataset.content || ''

      const panel = document.createElement('div')
      panel.id = 'hover-card-' + Math.random().toString(36).slice(2, 8)
      panel.setAttribute('role', 'tooltip')
      panel.innerHTML = content
      panel.className = [
        'absolute z-50 w-64',
        'rounded-md border border-border bg-popover p-4',
        'text-sm text-popover-foreground shadow-md',
        'transition ease-out duration-150',
        'opacity-0 scale-95 pointer-events-none',
        this._positionClasses(side, align),
      ].join(' ')
      panel.style.display = 'none'

      this.$el.classList.add(
        'relative',
        'cursor-help',
        'bg-accent',
        'p-0.5',
        '-m-0.5',
        'rounded-sm'
      )
      this.$el.appendChild(panel)

      this._panel = panel

      const trigger = this.$el.querySelector('a, [tabindex="0"]') ?? this.$el
      trigger.setAttribute('aria-describedby', panel.id)

      this.$watch('isOpen', (open) => {
        if (open) {
          panel.style.display = ''
          requestAnimationFrame(() => {
            panel.classList.remove(
              'opacity-0',
              'scale-95',
              'pointer-events-none'
            )
            panel.classList.add('opacity-100', 'scale-100')
          })
        } else {
          panel.classList.remove('opacity-100', 'scale-100')
          panel.classList.add('opacity-0', 'scale-95', 'pointer-events-none')
          panel.addEventListener(
            'transitionend',
            () => {
              if (!this.isOpen) panel.style.display = 'none'
            },
            { once: true }
          )
        }
      })

      // Event listeners for hover and focus are here instead of using
      // @mouseenter, @mouseleave, @focusin, @focusout in the template
      // because the code needs to work for both the hover-card block
      // and for hover cards generated through the Format API.
      this.$el.addEventListener('mouseenter', () => this.open())
      this.$el.addEventListener('mouseleave', () => this.close())
      this.$el.addEventListener('focusin', () => this.open())
      this.$el.addEventListener('focusout', () => this.close())
    },

    _positionClasses(side, align) {
      const isHorizontal = side === 'top' || side === 'bottom'

      const sideClass =
        {
          top: 'bottom-full mb-2',
          left: 'right-full mr-2',
          right: 'left-full ml-2',
          bottom: 'top-full mt-2',
        }[side] ?? 'top-full mt-2'

      const alignClass = isHorizontal
        ? ({
            start: 'left-0',
            end: 'right-0',
            center: 'left-1/2 -translate-x-1/2',
          }[align] ?? 'left-1/2 -translate-x-1/2')
        : ({
            start: 'top-0',
            end: 'bottom-0',
            center: 'top-1/2 -translate-y-1/2',
          }[align] ?? 'top-1/2 -translate-y-1/2')

      return `${sideClass} ${alignClass}`
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
