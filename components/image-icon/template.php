<?php /** @var \Theme\Components\ImageIcon $this */ ?>

<div data-component="<?= $this->component_slug() ?>">
    <?php if ( ! empty( $this->icon ) ) : ?>
        <img src="<?= esc_url( $this->icon ) ?>" alt="<?= esc_attr( $this->alt_text ) ?>">
    <?php endif; ?>
</div>
