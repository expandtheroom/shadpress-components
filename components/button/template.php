<?php

/** @var \Theme\Components\Button $this */

$is_link = !empty($this->link['url']);

$shared_attrs = implode(' ', array_filter([
    $this->component_attrs(),
    'class="' . esc_attr(classNames($this->button_classes(), $this->get_classes())) . '"',
]));
?>

<?php if ($is_link):
    $link = $this->link;
    $url = $this->link['url'];

    $is_external = !empty($url) && parse_url($url, PHP_URL_HOST) && parse_url($url, PHP_URL_HOST) !== parse_url(home_url(), PHP_URL_HOST);

    $target_attr = !empty($link['target']) || $is_external
        ? 'target="' . ($is_external ? '_blank'
            : (esc_attr($link['target'] ?? '_self'))) . '"'
        : '';
    $rel_attr = $is_external ? 'rel="noopener noreferrer"' : '';

    $link_attrs = implode(' ', array_filter([
        'href="' . esc_url($url) . '"',
        $target_attr,
        $rel_attr,
    ]));
?>
    <a <?= $shared_attrs ?>
        <?= $link_attrs ?>>
        <?= $this->link['title'] ?? '' ?>
    </a>
<?php else:
    $button_attrs = implode(' ', array_filter([
        $this->disabled ? 'disabled aria-disabled="true"' : '',
        'type="' . esc_attr($this->type) . '"',
        $this->click_action === 'alpine' && $this->alpine_module ? 'x-data="' . esc_attr($this->alpine_module) . '"' : '',
    ]));
?>
    <button <?= $shared_attrs ?>
        <?= $button_attrs ?>>
        <?= esc_html($this->label) ?>
    </button>
<?php endif; ?>
