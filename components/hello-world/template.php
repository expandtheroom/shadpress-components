<?php
/** @var \Theme\Components\HelloWorld $this */
?>
<div <?= $this->get_anchor_attr() ?>
     data-component="<?= $this->component_slug() ?>"
     class="<?= esc_attr(classNames('p-10 space-y-5', $this->component_classes())) ?>">
    <h2><?= esc_html($this->title) ?></h2>

    <div x-data="helloWorld"
         class="hello-world-blue">
        <p>Alpine JS just works when it does. x-data can be set to the name of your camelCase partial (helloWorld).</p>
        <button x-on:click="opened = !opened">Toggle Me</button>
        <div x-show="opened">Hello 👋</div>
    </div>

</div>
