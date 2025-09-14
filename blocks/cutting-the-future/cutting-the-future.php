<?php

/**
 * Cutting the Future Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cutting-the-future-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'cutting-the-future';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$label = get_field('etykieta');
$title = get_field('tytul');
$text = get_field('tekst');
$background_id = get_field('tlo');
$logo_id = get_field('logo');

// Get background image URL
$background_url = '';
if ($background_id) {
    $background_url = wp_get_attachment_image_url($background_id, 'full');
}

// Get logo image
$logo_html = '';
if ($logo_id) {
    $logo_html = wp_get_attachment_image($logo_id, 'full', false, array('class' => 'cutting-the-future__logo-img'));
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>"<?php if ($background_url) : ?> style="background-image: url('<?php echo esc_url($background_url); ?>');"<?php endif; ?>>
    <div class="cutting-the-future__overlay"></div>
    <div class="container">
        <div class="cutting-the-future__content">
            <?php if ($label) : ?>
                <div class="cutting-the-future__label label"><?php echo esc_html($label); ?></div>
            <?php endif; ?>
            
            <?php if ($title) : ?>
                <h2 class="cutting-the-future__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <?php if ($text) : ?>
                <div class="cutting-the-future__text"><?php echo esc_html($text); ?></div>
            <?php endif; ?>
        </div>
        
        <?php if ($logo_html) : ?>
            <div class="cutting-the-future__logo">
                <?php echo $logo_html; ?>
            </div>
        <?php endif; ?>
    </div>
</section>