<?php
/**
 * Blok Zdjęcie Block Template.
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
$class_name = 'blok-zdjecie';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

// Get ACF fields
$zdjecie = get_field('zdjecie');
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$tekst = get_field('tekst');
$boxes = get_field('box');
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <div class="blok-zdjecie__image-wrapper">
        <?php if ($zdjecie) : ?>
            <?php echo wp_get_attachment_image($zdjecie, 'full', false, array('class' => 'blok-zdjecie__image')); ?>
        <?php endif; ?>
    </div>
    
    <div class="container">
        <div class="blok-zdjecie__content">
            <?php if ($etykieta) : ?>
                <span class="blok-zdjecie__label label"><?php echo esc_html($etykieta); ?></span>
            <?php endif; ?>
            
            <?php if ($tytul) : ?>
                <h2 class="blok-zdjecie__title"><?php echo esc_html($tytul); ?></h2>
            <?php endif; ?>
            
            <?php if ($tekst) : ?>
                <div class="blok-zdjecie__text"><?php echo $tekst; ?></div>
            <?php endif; ?>
            
            <?php if ($boxes && count($boxes) > 0) : ?>
                <div class="blok-zdjecie__boxes desktop">
                    <?php foreach ($boxes as $box) : ?>
                        <div class="blok-zdjecie__box">
                            <?php if ($box['ikonka']) : ?>
                                <div class="blok-zdjecie__box-icon">
                                    <img src="<?php echo esc_url($box['ikonka']); ?>" alt="<?php echo esc_attr($box['tytul']); ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($box['tytul']) : ?>
                                <h3 class="blok-zdjecie__box-title"><?php echo esc_html($box['tytul']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($box['tekst']) : ?>
                                <div class="blok-zdjecie__box-text"><?php echo $box['tekst']; ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Mobile Swiper -->
                <div class="blok-zdjecie__swiper mobile">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($boxes as $box) : ?>
                                <div class="swiper-slide">
                                    <div class="blok-zdjecie__box">
                                        <?php if ($box['ikonka']) : ?>
                                            <div class="blok-zdjecie__box-icon">
                                                <img src="<?php echo esc_url($box['ikonka']); ?>" alt="<?php echo esc_attr($box['tytul']); ?>">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($box['tytul']) : ?>
                                            <h3 class="blok-zdjecie__box-title"><?php echo esc_html($box['tytul']); ?></h3>
                                        <?php endif; ?>
                                        
                                        <?php if ($box['tekst']) : ?>
                                            <div class="blok-zdjecie__box-text"><?php echo $box['tekst']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
