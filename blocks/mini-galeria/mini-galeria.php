<?php
/**
 * Mini Galeria Block Template.
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
$class_name = 'mini-galeria';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$tekst = get_field('tekst');

$kolumny = get_field('kolumna');
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <!-- Text Section Header -->
    <?php get_template_part('template-parts/components/text-section', null, array(
        'label' => $etykieta,
        'title' => $tytul,
        'text' => $tekst,
        'class' => 'mini-galeria__header',
    )); ?>
    
    <?php if ($kolumny && count($kolumny) > 0) : ?>
        <div class="container">
            <!-- Desktop Grid -->
            <div class="mini-galeria__grid desktop">
                <?php foreach ($kolumny as $kolumna) : ?>
                    <div class="mini-galeria__item">
                        <?php if ($kolumna['zdjecie']) : ?>
                            <div class="mini-galeria__image-wrapper">
                                <?php echo wp_get_attachment_image($kolumna['zdjecie'], 'full', false, array('class' => 'mini-galeria__image')); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($kolumna['liczba']) : ?>
                            <div class="mini-galeria__number"><?php echo esc_html($kolumna['liczba']); ?></div>
                        <?php endif; ?>
                        
                        <?php if ($kolumna['tytul']) : ?>
                            <span class="mini-galeria__title"><?php echo esc_html($kolumna['tytul']); ?></span>
                        <?php endif; ?>
                        
                        <?php if ($kolumna['tekst']) : ?>
                            <div class="mini-galeria__text"><?php echo $kolumna['tekst']; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Mobile Swiper -->
            <div class="mini-galeria__swiper mobile">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($kolumny as $kolumna) : ?>
                            <div class="swiper-slide">
                                <div class="mini-galeria__item">
                                    <?php if ($kolumna['zdjecie']) : ?>
                                        <div class="mini-galeria__image-wrapper">
                                            <?php echo wp_get_attachment_image($kolumna['zdjecie'], 'full', false, array('class' => 'mini-galeria__image')); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kolumna['liczba']) : ?>
                                        <div class="mini-galeria__number"><?php echo esc_html($kolumna['liczba']); ?></div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kolumna['tytul']) : ?>
                                        <span class="mini-galeria__title"><?php echo esc_html($kolumna['tytul']); ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if ($kolumna['tekst']) : ?>
                                        <div class="mini-galeria__text"><?php echo $kolumna['tekst']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
