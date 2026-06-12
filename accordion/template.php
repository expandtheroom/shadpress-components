<?php

/** @var \Theme\Components\Accordion $this */
?>
<div <?= $this->component_attrs() ?>
    class="<?= esc_attr($this->get_classes()) ?>"
    <?php if (!$this->is_preview): ?>x-data="<?= esc_attr($this->component_module_name()) ?>()"
    <?php endif; ?>>

    <?php foreach ($this->panels as $idx => $panel):
        $button_attrs = $this->compile_attrs([
            'id'            => 'accordion-trigger-' . esc_attr((string) $idx),
            'aria-controls' => 'accordion-panel-' . esc_attr((string) $idx),
            'aria-expanded' => $this->is_preview ? 'true' : 'false',
            'data-state'    => $this->is_preview ? 'open' : 'closed',
        ]);

        $panel_attrs = $this->is_preview ? $this->compile_attrs([
            'id'              => 'accordion-panel-' . esc_attr((string) $idx),
            'role'            => 'region',
            'aria-labelledby' => 'accordion-trigger-' . esc_attr((string) $idx),
            'data-state'      => $this->is_preview ? 'open' : 'closed',
        ]) : $this->compile_attrs([
            'style' => 'display:none',
        ]);
    ?>
        <div data-slot="accordion-item"
            class="border-b last:border-b-0">
            <h3>
                <button data-slot="accordion-trigger"
                    <?= $button_attrs ?>
                    type="button"
                    class="focus-visible:border-ring focus-visible:ring-ring/50 flex w-full items-start justify-between gap-4 rounded-md py-4 text-left text-sm font-medium transition-all outline-none focus-visible:ring-[3px] hover:underline">

                    <?= $this->render_panel_icon($panel) ?>
                    <?= esc_html($panel['trigger'] ?? '') ?>

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="shrink-0 transition-transform duration-200 mt-0.5"
                        aria-hidden="true">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
            </h3>

            <div data-slot="accordion-content"
                <?= $panel_attrs ?>
                class="overflow-hidden text-sm">
                <div class="pt-0 pb-4">
                    <?= $this->panel_contents[$idx] ?? '' ?>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

</div>
