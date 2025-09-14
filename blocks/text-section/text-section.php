<?php

/**
 * Text Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-section-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'text-section';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$label = get_field('etykieta');
$title = get_field('tytul');
$text = get_field('tekst');
$button_text = get_field('tekst_przycisku');
$button_link = get_field('link_przycisku');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <?php if ($label) : ?>
            <span class="label"><?php echo wp_kses_post($label); ?></span>
        <?php endif; ?>

        <div class="text-section__content">
            <?php if ($title) : ?>
                <h2 class="text-section__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($text)) : ?>
                <div class="text-section__text"><?php echo wp_kses_post($text); ?></div>
            <?php endif; ?>
            
            <?php if (!empty($button_text) && !empty($button_link)) : ?>
                <div class="text-section__btn-wrapper">
                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn--primary"><?php echo esc_html($button_text); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>