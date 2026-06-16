<?php

namespace Theme\Components;

class WysiwygContent extends BaseComponent {

    public ?Typography $typography = null;

    public function __construct(
        public string $html = '',
    ) {
    }

    public function prepare(): void {
        $this->typography = new Typography(body: $this->html);
    }
}
