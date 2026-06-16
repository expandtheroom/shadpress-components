export default () => ({
    name: '',
    selectedDate: '',
    currentYear: 0,
    currentMonth: 0,
    minDate: '',
    maxDate: '',
    days: [],
    todayDate: '',

    get monthLabel() {
      const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
      ]
      return `${months[this.currentMonth]} ${this.currentYear}`
    },

    init() {
      const el = this.$el.closest('[data-component]') || this.$el
      this.name = el.dataset.name || ''
      this.selectedDate = el.dataset.selectedDate || ''
      this.minDate = el.dataset.minDate || ''
      this.maxDate = el.dataset.maxDate || ''

      const base = this.selectedDate
        ? new Date(this.selectedDate + 'T00:00:00')
        : new Date()
      this.currentYear = base.getFullYear()
      this.currentMonth = base.getMonth()

      this.todayDate = (() => {
        const t = new Date()
        return `${t.getFullYear()}-${String(t.getMonth() + 1).padStart(2, '0')}-${String(t.getDate()).padStart(2, '0')}`
      })()

      this.buildDays()
      this.renderGrid()

      this.$el.querySelector('[data-slot="calendar-grid"]').addEventListener('click', e => {
        const btn = e.target.closest('[data-slot="calendar-day"]')
        if (btn && !btn.disabled) {
          this.selectDay(JSON.parse(btn.dataset.day))
        }
      })
    },

    prevMonth() {
      if (this.currentMonth === 0) {
        this.currentMonth = 11
        this.currentYear -= 1
      } else {
        this.currentMonth -= 1
      }
      this.buildDays()
      this.renderGrid()
    },

    nextMonth() {
      if (this.currentMonth === 11) {
        this.currentMonth = 0
        this.currentYear += 1
      } else {
        this.currentMonth += 1
      }
      this.buildDays()
      this.renderGrid()
    },

    buildDays() {
      const year = this.currentYear
      const month = this.currentMonth

      const firstDay = new Date(year, month, 1).getDay()
      const daysInMonth = new Date(year, month + 1, 0).getDate()
      const daysInPrevMonth = new Date(year, month, 0).getDate()

      const cells = []

      for (let i = firstDay - 1; i >= 0; i--) {
        const d = daysInPrevMonth - i
        const pm = month === 0 ? 11 : month - 1
        const py = month === 0 ? year - 1 : year
        const full = `${py}-${String(pm + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`
        cells.push({ year: py, month: pm, date: d, fullDate: full, outside: true })
      }

      for (let d = 1; d <= daysInMonth; d++) {
        const full = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`
        cells.push({ year, month, date: d, fullDate: full, outside: false })
      }

      const remainder = cells.length % 7
      if (remainder !== 0) {
        const needed = 7 - remainder
        const nm = month === 11 ? 0 : month + 1
        const ny = month === 11 ? year + 1 : year
        for (let d = 1; d <= needed; d++) {
          const full = `${ny}-${String(nm + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`
          cells.push({ year: ny, month: nm, date: d, fullDate: full, outside: true })
        }
      }

      this.days = cells
    },

    renderGrid() {
      const grid = this.$el.querySelector('[data-slot="calendar-grid"]')
      const btnClass = 'flex items-center justify-center h-8 w-full text-sm rounded-md cursor-pointer transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring enabled:hover:bg-accent data-[today=true]:bg-accent data-[today=true]:font-semibold data-[selected=true]:bg-primary data-[selected=true]:text-primary-foreground data-[selected=true]:font-semibold data-[selected=true]:hover:bg-primary data-[outside=true]:opacity-40 disabled:cursor-not-allowed disabled:pointer-events-none disabled:opacity-50'

      grid.innerHTML = this.days.map(day => {
        const isToday    = day.fullDate === this.todayDate
        const isSelected = this.selectedDate !== '' && day.fullDate === this.selectedDate
        const isDisabled = (this.minDate && day.fullDate < this.minDate) || (this.maxDate && day.fullDate > this.maxDate)

        const extra = [
          isToday    ? 'data-today="true"'    : '',
          isSelected ? 'data-selected="true"' : '',
          day.outside ? 'data-outside="true"' : '',
          isDisabled  ? 'disabled'             : '',
        ].filter(Boolean).join(' ')

        return `<button type="button" data-slot="calendar-day" data-day='${JSON.stringify(day)}' ${extra} aria-label="${day.fullDate}" class="${btnClass}">${day.date}</button>`
      }).join('')
    },

    selectDay(day) {
      if (this.isDisabled(day)) return
      this.selectedDate = day.fullDate
      if (day.outside) {
        this.currentYear = day.year
        this.currentMonth = day.month
        this.buildDays()
      }
      this.renderGrid()
    },

    isDisabled(day) {
      if (this.minDate && day.fullDate < this.minDate) return true
      if (this.maxDate && day.fullDate > this.maxDate) return true
      return false
    },
})
