<?php
/** @var \Theme\Components\Alert $this */

$x_attrs = $this->compile_attrs([
    'x-data' => $this->component_module_name() . '()',
    'x-show' => 'visible',
]);
?>
<div <?= $this->component_attrs() ?>
     <?= $x_attrs ?>
     class="<?= esc_attr(classNames($this->alert_classes(), $this->get_classes())) ?>">

    <?php if ($this->dismissible): ?>
        <button type="button"
                data-slot="alert-dismiss"
                @click="dismiss()"
                class="absolute right-2 top-2 rounded-sm opacity-70 hover:opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                aria-label="Dismiss">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16"
                 height="16"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
        </button>
    <?php endif; ?>

    <?php if ($this->title): ?>
        <div data-slot="alert-title"
             class="col-start-2 mb-1 font-medium leading-none tracking-tight">
            <?= esc_html($this->title) ?>
        </div>
    <?php endif; ?>

    <div data-slot="alert-description"
         class="col-start-2 text-sm [&_p]:leading-relaxed">
        <?= nl2br(esc_html($this->description)) ?>
    </div>

</div>
