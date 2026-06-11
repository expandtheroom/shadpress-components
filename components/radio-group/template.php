<?php
/** @var \Theme\Components\RadioGroup $this */
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="radio-group"
         role="radiogroup"
         x-data="<?= esc_attr($this->component_module_name()) ?>()"
         data-default-value="<?= esc_attr($this->default_value) ?>"
         data-orientation="<?= esc_attr($this->orientation) ?>"
         data-disabled="<?= esc_attr($this->disabled ? 'true' : 'false') ?>"
         data-name="<?= esc_attr($this->name) ?>"
         <?php if ($this->label): ?>aria-label="<?= esc_attr($this->label) ?>"<?php endif; ?>
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
                        @click="select('<?= esc_attr($item_value) ?>')"
                        :disabled="disabled || null"
                        class="size-4 shrink-0 rounded-full border focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50">
                    <span data-slot="radio-group-indicator"
                          x-show="selected === '<?= esc_attr($item_value) ?>'"
                          aria-hidden="true"
                          class="flex items-center justify-center">
                    </span>
                </button>

                <label data-slot="radio-group-label"
                       for="<?= $item_id ?>"
                       class="text-sm font-medium leading-none"
                       :class="disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer'">
                    <?= esc_html($item_label) ?>
                </label>

            </div>
        <?php endforeach; ?>

    </div>
</div>
