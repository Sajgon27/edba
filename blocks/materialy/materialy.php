<?php
/**
 * Materialy Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'materialy';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$tekst = get_field('tekst');
$boxes = get_field('box');
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <!-- Text Section Header -->
    <?php get_template_part('template-parts/components/text-section', null, array(
        'label' => $etykieta,
        'title' => $tytul,
        'content' => '',
        'class' => 'materialy__header',
    )); ?>
    
    <div class="container">
        <div class="materialy__content">
            <!-- Left side - Boxes -->
            <div class="materialy__boxes desktop">
                <?php if ($boxes && count($boxes) > 0) : ?>
                    <?php foreach ($boxes as $box) : ?>
                        <div class="materialy__box">
                            <?php if ($box['tekst']) : ?>
                                <div class="materialy__box-text"><?php echo wp_kses_post($box['tekst']); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Right side - Text -->
            <div class="materialy__text-section">
                <?php if ($tekst) : ?>
                    <div class="materialy__text"><?php echo $tekst; ?></div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Mobile Swiper -->
        <div class="materialy__swiper mobile">
            <?php if ($boxes && count($boxes) > 0) : ?>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($boxes as $box) : ?>
                            <div class="swiper-slide">
                                <div class="materialy__box">
                                    <?php if ($box['tekst']) : ?>
                                        <div class="materialy__box-text"><?php echo wp_kses_post($box['tekst']); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
