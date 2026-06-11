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

      this.buildDays()
      this.todayDate = (() => {
        const t = new Date()
        return `${t.getFullYear()}-${String(t.getMonth() + 1).padStart(2, '0')}-${String(t.getDate()).padStart(2, '0')}`
      })()
    },

    prevMonth() {
      if (this.currentMonth === 0) {
        this.currentMonth = 11
        this.currentYear -= 1
      } else {
        this.currentMonth -= 1
      }
      this.buildDays()
    },

    nextMonth() {
      if (this.currentMonth === 11) {
        this.currentMonth = 0
        this.currentYear += 1
      } else {
        this.currentMonth += 1
      }
      this.buildDays()
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
        cells.push({
          year: py,
          month: pm,
          date: d,
          fullDate: full,
          outside: true,
        })
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
          cells.push({
            year: ny,
            month: nm,
            date: d,
            fullDate: full,
            outside: true,
          })
        }
      }

      this.days = cells
    },

    selectDay(day) {
      if (this.isDisabled(day)) return
      this.selectedDate = day.fullDate
      if (day.outside) {
        this.currentYear = day.year
        this.currentMonth = day.month
        this.buildDays()
      }
    },

    isSelected(day) {
      return this.selectedDate !== '' && day.fullDate === this.selectedDate
    },

    isToday(day) {
      const today = new Date()
      const y = today.getFullYear()
      const m = String(today.getMonth() + 1).padStart(2, '0')
      const d = String(today.getDate()).padStart(2, '0')
      return day.fullDate === `${y}-${m}-${d}`
    },

    isDisabled(day) {
      if (this.minDate && day.fullDate < this.minDate) return true
      if (this.maxDate && day.fullDate > this.maxDate) return true
      return false
    },
})
