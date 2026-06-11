<?php
/** @var \Theme\Components\Pagination $this */

$links = $this->get_links();

if (empty($links)) {
    return;
}
?>
<nav <?= $this->component_attrs() ?>>
    <ul data-slot="pagination-content">
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

            if ($is_prev) {
                $el->setAttribute('data-slot', 'pagination-previous');
            } elseif ($is_next) {
                $el->setAttribute('data-slot', 'pagination-next');
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
            ?>
            <li data-slot="pagination-item">
                <?= $dom->saveHTML($el) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
