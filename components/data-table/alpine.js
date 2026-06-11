export default () => ({
    search: '',
    sortKey: '',
    sortDir: '',
    headers: [],
    rows: [],

    get filteredSortedRows() {
      let result = this.rows.slice()

      if (this.search.trim() !== '') {
        const term = this.search.trim().toLowerCase()
        result = result.filter(function (row) {
          return row.some(function (cell) {
            return String(cell.content).toLowerCase().includes(term)
          })
        })
      }

      if (this.sortKey !== '' && this.sortDir !== '') {
        const headerIndex = this.headers.findIndex(function (h) {
          return h.key === this.sortKey
        }, this)

        if (headerIndex !== -1) {
          const dir = this.sortDir
          result = result.sort(function (a, b) {
            const aVal = String(a[headerIndex] ? a[headerIndex].content : '')
            const bVal = String(b[headerIndex] ? b[headerIndex].content : '')
            if (aVal < bVal) return dir === 'asc' ? -1 : 1
            if (aVal > bVal) return dir === 'asc' ? 1 : -1
            return 0
          })
        }
      }

      return result
    },

    init() {
      const el = this.$el.closest('[data-component]') || this.$el
      const configRaw = el.dataset.config || '{}'
      const filterable = el.dataset.filterable === 'true'

      let config = { headers: [], rows: [] }
      try {
        config = JSON.parse(configRaw)
      } catch (e) {
        console.warn('[DataTable] Failed to parse data-config', e)
      }

      this.headers = config.headers || []
      this.rows = config.rows || []

      if (!filterable) {
        this.search = ''
      }
    },

    sort(key) {
      if (this.sortKey !== key) {
        this.sortKey = key
        this.sortDir = 'asc'
      } else if (this.sortDir === 'asc') {
        this.sortDir = 'desc'
      } else {
        this.sortKey = ''
        this.sortDir = ''
      }
    },

    getSortAttr(key) {
      const header = this.headers.find(function (h) {
        return h.key === key
      })
      if (!header || !header.sortable) return null
      if (this.sortKey !== key) return 'none'
      return this.sortDir === 'asc' ? 'ascending' : 'descending'
    },
})
