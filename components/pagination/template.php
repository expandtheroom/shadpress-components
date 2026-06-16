<?php

/** @var \Theme\Components\Pagination $this */

$links = $this->get_links();

if (empty($links)) {
    return;
}
?>
<nav <?= $this->component_attrs() ?>
    class="<?= classNames($this->component_classes(), 'mx-auto flex w-full justify-center') ?>">

    <ul data-slot="pagination-content" class="flex flex-row items-center gap-1">
        <?php foreach ($links as $link_html): ?>
            <?php
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<?xml encoding="UTF-8">' . $link_html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $el = $dom->documentElement;

            $is_prev = str_contains($link_html, 'class="prev"');
            $is_next = str_contains($link_html, 'class="next"');
            $is_current = str_contains($link_html, 'aria-current');
            $is_anchor = $el->tagName === 'a';

            $link_classes = 'inline-flex items-center justify-center gap-1 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 cursor-pointer h-9 min-w-9 px-3 text-foreground hover:bg-muted hover:text-muted-foreground data-[current=true]:bg-primary data-[current=true]:text-primary-foreground data-[current=true]:pointer-events-none aria-[current=page]:bg-primary aria-[current=page]:text-primary-foreground aria-[current=page]:pointer-events-none';

            if ($is_prev) {
                $el->setAttribute('data-slot', 'pagination-previous');
                $link_classes .= ' pl-2.5 pr-2.5';
            } elseif ($is_next) {
                $el->setAttribute('data-slot', 'pagination-next');
                $link_classes .= ' pl-2.5 pr-2.5';
            } elseif ($is_current) {
                // <span aria-current="page"> from WordPress
                $el->setAttribute('data-slot', 'pagination-link');
                $el->setAttribute('data-current', 'true');
            } elseif (!$is_anchor) {
                // <span> without aria-current — ellipsis / dots
                $el->setAttribute('data-slot', 'pagination-link');
            } else {
                // plain <a> link
                $el->setAttribute('data-slot', 'pagination-link');
            }

            $existing_class = $el->getAttribute('class');
            $el->setAttribute('class', trim($existing_class . ' ' . $link_classes));
            ?>
            <li data-slot="pagination-item" class="list-none">
                <?= $dom->saveHTML($el) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
