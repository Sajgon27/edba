<?php
/**
 * Orange CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'orange-cta-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'orange-cta';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$link = get_field('link');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <a href="<?php echo esc_url($link); ?>" class="orange-cta__content">
            <?php if ($etykieta) : ?>
                <div class="orange-cta__etykieta label"><?php echo esc_html($etykieta); ?></div>
            <?php endif; ?>
            
            <?php if ($tytul) : ?>
                <h2 class="orange-cta__tytul">
                    <?php echo esc_html($tytul); ?>
                    <?php if ($link) : ?>
                        <svg viewBox="0 0 36 36">

                                <line x1="5" y1="31" x2="31" y2="5" stroke="#ffffff" stroke-width="3" stroke-linecap="butt" />
                                <line x1="4" y1="4" x2="32" y2="4" stroke="#ffffff" stroke-width="3" stroke-linecap="square" />
                                <line x1="32" y1="4" x2="32" y2="32" stroke="#ffffff" stroke-width="3" stroke-linecap="square" />
                            </svg>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
        </a>
        
   
    </div>
</section>