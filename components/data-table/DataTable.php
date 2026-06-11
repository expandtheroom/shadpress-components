<?php

namespace Theme\Components;

class DataTable extends BaseComponent {

    public function __construct(
        public string $caption     = '',
        public array  $headers     = [],
        public array  $rows        = [],
        public bool   $filterable  = false,
        public array  $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->headers = array_map(function (array $header): array {
            return [
                'label'    => $header['label']    ?? '',
                'key'      => $header['key']      ?? '',
                'sortable' => (bool) ($header['sortable'] ?? false),
            ];
        }, $this->headers);

        $this->rows = array_map(function (array $row): array {
            $cells = $row['cells'] ?? [];
            return array_map(function (array $cell): array {
                return ['content' => $cell['content'] ?? ''];
            }, $cells);
        }, $this->rows);
    }

    public function get_config(): string {
        return wp_json_encode([
            'headers' => $this->headers,
            'rows'    => $this->rows,
        ]);
    }
}
