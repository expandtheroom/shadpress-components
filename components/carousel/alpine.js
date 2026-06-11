export default () => ({
  active: 0,
  totalCount: 0,
  loop: false,
  autoplay: false,
  autoplayDelay: 3000,
  _timer: null,
  _pause: null,
  _resume: null,

  init() {
    const root = this.$el.closest('[data-component]') || this.$el
    this.loop = root.dataset.loop === 'true'
    this.autoplay = root.dataset.autoplay === 'true'
    this.autoplayDelay = parseInt(root.dataset.autoplayDelay, 10) || 3000
    this.totalCount = root.querySelectorAll(
      '[data-slot="carousel-item"]'
    ).length

    const track = this.$refs.track
    track.addEventListener(
      'scroll',
      () => {
        if (!track.clientWidth) return
        const i = Math.round(track.scrollLeft / track.clientWidth)
        if (i !== this.active) this.active = i
      },
      { passive: true }
    )

    if (this.autoplay) this._startAutoplay()

    this._pause = () => this._stopAutoplay()
    this._resume = () => {
      if (this.autoplay) this._startAutoplay()
    }
    root.addEventListener('mouseenter', this._pause)
    root.addEventListener('mouseleave', this._resume)
    root.addEventListener('focusin', this._pause)
    root.addEventListener('focusout', this._resume)
  },

  destroy() {
    this._stopAutoplay()
    const root = this.$el.closest('[data-component]') || this.$el
    root.removeEventListener('mouseenter', this._pause)
    root.removeEventListener('mouseleave', this._resume)
    root.removeEventListener('focusin', this._pause)
    root.removeEventListener('focusout', this._resume)
  },

  goTo(i) {
    if (this.totalCount === 0) return
    if (i < 0) i = this.loop ? this.totalCount - 1 : 0
    if (i >= this.totalCount) i = this.loop ? 0 : this.totalCount - 1
    this.active = i
    this.$refs.track.scrollTo({
      left: i * this.$refs.track.clientWidth,
      behavior: 'smooth',
    })
    if (this.$refs.liveRegion) {
      this.$refs.liveRegion.textContent = `Slide ${i + 1} of ${this.totalCount}`
    }
  },

  prev() {
    this.goTo(this.active - 1)
  },
  next() {
    if (!this.loop && this.active === this.totalCount - 1) {
      this._stopAutoplay()
      return
    }
    this.goTo(this.active + 1)
  },

  _startAutoplay() {
    this._stopAutoplay()
    this._timer = setInterval(() => {
      this.next()
    }, this.autoplayDelay)
  },

  _stopAutoplay() {
    if (this._timer) {
      clearInterval(this._timer)
      this._timer = null
    }
  },
  // }
})
