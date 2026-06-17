<?php

/** @var \Theme\Components\RadioGroupField $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col gap-1.5') ?>">

    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <div data-slot="radio-group"
        role="radiogroup"
        x-data="<?= $this->component_module_name() ?>"
        data-default-value="<?= esc_attr($this->default_value) ?>"
        data-orientation="<?= esc_attr($this->orientation) ?>"
        class="flex data-[orientation=horizontal]:flex-row data-[orientation=horizontal]:gap-4 data-[orientation=vertical]:flex-col data-[orientation=vertical]:gap-2"
        data-disabled="<?= esc_attr($this->disabled ? 'true' : 'false') ?>"
        data-name="<?= esc_attr($this->name) ?>"
        <?php if ($this->label_component): ?>aria-labelledby="<?= esc_attr($this->id) ?>-label" <?php endif; ?>
        @keydown.arrow-up.prevent="movePrev()"
        @keydown.arrow-down.prevent="moveNext()"
        @keydown.arrow-left.prevent="movePrev()"
        @keydown.arrow-right.prevent="moveNext()">

        <input type="hidden" :name="name" :value="selected">

        <?php
        $radio_group_uid = uniqid('rg-');
        ?>
        <?php foreach ($this->options as $item): ?>
            <?php
            $item_value = $item['value'] ?? '';
            $item_label = $item['label'] ?? '';
            $item_id    = $radio_group_uid . '-' . esc_attr($item_value);
            ?>
            <div data-slot="radio-group-item-wrapper" class="inline-flex items-center gap-2">

                <button role="radio"
                    type="button"
                    id="<?= $item_id ?>"
                    data-slot="radio-group-item"
                    data-value="<?= esc_attr($item_value) ?>"
                    :aria-checked="(selected === '<?= esc_attr($item_value) ?>').toString()"
                    :data-state="selected === '<?= esc_attr($item_value) ?>' ? 'checked' : 'unchecked'"
                    aria-labelledby="<?= $item_id ?>-label"
                    @click="select('<?= esc_attr($item_value) ?>')"
                    :disabled="disabled || null"
                    class="size-4 shrink-0 rounded-full border border-primary focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 data-[state=checked]:shadow-[0_0_0_2px_var(--color-primary)] disabled:cursor-not-allowed disabled:opacity-50">
                    <span data-slot="radio-group-indicator"
                        x-show="selected === '<?= esc_attr($item_value) ?>'"
                        aria-hidden="true"
                        class="flex items-center justify-center w-full h-full after:content-[''] after:block after:w-2 after:h-2 after:rounded-full after:bg-primary">
                    </span>
                </button>

                <span data-slot="radio-group-label"
                    id="<?= $item_id ?>-label"
                    @click="!disabled && select('<?= esc_attr($item_value) ?>')"
                    class="text-sm font-medium leading-none"
                    :class="disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer'">
                    <?= esc_html($item_label) ?>
                </span>

            </div>
        <?php endforeach; ?>

    </div>

    <?php if ($this->description): ?>
        <p data-slot="field-description">
            <?= esc_html($this->description) ?>
        </p>
    <?php endif; ?>

    <?php if ($this->has_error()): ?>
        <p data-slot="field-error"
            <?php if ($this->error_id()): ?>id="<?= esc_attr($this->error_id()) ?>" <?php endif; ?>
            role="alert">
            <?= esc_html($this->error) ?>
        </p>
    <?php endif; ?>
</div>