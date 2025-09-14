<?php
/**
 * Nasze Usługi Block Template.
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
$class_name = 'nasze-uslugi';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$boxes = get_field('box');
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <!-- Text Section Header -->
    <?php get_template_part('template-parts/components/text-section', null, array(
        'label' => $etykieta,
        'title' => $tytul,
        'content' => '',
        'class' => 'nasze-uslugi__header',
    )); ?>
    
    <?php if ($boxes && count($boxes) > 0) : ?>
        <div class="container">
            <div class="nasze-uslugi__grid">
                <?php foreach ($boxes as $box) : ?>
                    <?php 
                    $link = $box['link'] ? esc_url($box['link']) : '#';
                    $link_target = strpos($link, home_url()) !== false ? '_self' : '_blank';
                    ?>
                    <a href="<?php echo $link; ?>" target="<?php echo $link_target; ?>" class="nasze-uslugi__box">
                        <?php if ($box['ikonka']) : ?>
                            <div class="nasze-uslugi__icon">
                                <img src="<?php echo esc_url($box['ikonka']); ?>" alt="<?php echo esc_attr($box['tytul']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($box['tytul']) : ?>
                            <div class="nasze-uslugi__title">
                                <h5><?php echo esc_html($box['tytul']); ?> 🡥</h5>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
