<?php
/**
 * Branże Boxy Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'branze-boxy-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'branze-boxy';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
$boxes = get_field('box');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <?php if ($boxes && is_array($boxes) && count($boxes) > 0) : ?>
            <!-- Desktop Grid -->
            <div class="branze-boxy__container desktop-grid">
                <?php foreach ($boxes as $box) : ?>
                    <div class="branze-boxy__box">
                        <?php if (!empty($box['tytul'])) : ?>
                            <h3 class="branze-boxy__title"><?php echo esc_html($box['tytul']); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($box['tekst'])) : ?>
                            <div class="branze-boxy__text">
                                <?php echo wp_kses_post($box['tekst']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Mobile Swiper -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($boxes as $box) : ?>
                        <div class="swiper-slide">
                            <div class="branze-boxy__box">
                                <?php if (!empty($box['tytul'])) : ?>
                                    <h3 class="branze-boxy__title"><?php echo esc_html($box['tytul']); ?></h3>
                                <?php endif; ?>
                                
                                <?php if (!empty($box['tekst'])) : ?>
                                    <div class="branze-boxy__text">
                                        <?php echo wp_kses_post($box['tekst']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        <?php endif; ?>
    </div>
</section>