<?php

namespace Theme\Components;

class Calendar extends BaseComponent {

    public function __construct(
        public string $name          = '',
        public string $selected_date = '',
        public string $min_date      = '',
        public string $max_date      = '',
        public array  $extra_attrs   = []
    ) {
    }

    public function day_names(): array {
        return ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
    }

    public function build_days(): array {
        $base  = $this->selected_date ? new \DateTime($this->selected_date) : new \DateTime();
        $year  = (int) $base->format('Y');
        $month = (int) $base->format('n') - 1; // 0-indexed to match JS

        $first_of_month     = new \DateTime(sprintf('%04d-%02d-01', $year, $month + 1));
        $first_day          = (int) $first_of_month->format('w');
        $days_in_month      = (int) $first_of_month->format('t');
        $days_in_prev_month = (int) (clone $first_of_month)->modify('-1 day')->format('j');

        $cells = [];

        for ($i = $first_day - 1; $i >= 0; $i--) {
            $d  = $days_in_prev_month - $i;
            $pm = $month === 0 ? 11 : $month - 1;
            $py = $month === 0 ? $year - 1 : $year;
            $cells[] = [
                'year'     => $py,
                'month'    => $pm,
                'date'     => $d,
                'fullDate' => sprintf('%04d-%02d-%02d', $py, $pm + 1, $d),
                'outside'  => true,
            ];
        }

        for ($d = 1; $d <= $days_in_month; $d++) {
            $cells[] = [
                'year'     => $year,
                'month'    => $month,
                'date'     => $d,
                'fullDate' => sprintf('%04d-%02d-%02d', $year, $month + 1, $d),
                'outside'  => false,
            ];
        }

        $remainder = count($cells) % 7;
        if ($remainder !== 0) {
            $needed = 7 - $remainder;
            $nm     = $month === 11 ? 0 : $month + 1;
            $ny     = $month === 11 ? $year + 1 : $year;
            for ($d = 1; $d <= $needed; $d++) {
                $cells[] = [
                    'year'     => $ny,
                    'month'    => $nm,
                    'date'     => $d,
                    'fullDate' => sprintf('%04d-%02d-%02d', $ny, $nm + 1, $d),
                    'outside'  => true,
                ];
            }
        }

        return $cells;
    }

    public function month_label(): string {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];
        $base = $this->selected_date ? new \DateTime($this->selected_date) : new \DateTime();
        return $months[(int) $base->format('n') - 1] . ' ' . $base->format('Y');
    }

    public function is_today(string $full_date): bool {
        return $full_date === (new \DateTime())->format('Y-m-d');
    }

    public function is_selected(string $full_date): bool {
        return $this->selected_date !== '' && $full_date === $this->selected_date;
    }

    public function is_disabled(string $full_date): bool {
        if ($this->min_date && $full_date < $this->min_date) return true;
        if ($this->max_date && $full_date > $this->max_date) return true;
        return false;
    }

    protected function set_attrs(): array {
        return [
            'data-name' => $this->name ? esc_attr($this->name) : null,
            'data-selected-date' => $this->selected_date ? esc_attr($this->selected_date) : null,
            'data-min-date' => $this->min_date ? esc_attr($this->min_date) : null,
            'data-max-date' => $this->max_date ? esc_attr($this->max_date) : null,
            ...$this->extra_attrs,
        ];
    }
}
