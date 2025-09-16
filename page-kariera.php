<?php

/**
 * The template for displaying the Career page
 *
 * This is a specific template for the Career page (page-kariera.php)
 */

get_header();

// Get ACF fields
$tytul = get_field('tytul');
$tekst = get_field('tekst');

// Get Zalety pracy fields
$zalety_pracy = get_field('zalety_pracy');
$etykieta = !empty($zalety_pracy['etykieta']) ? $zalety_pracy['etykieta'] : '';
$zalety_tytul = !empty($zalety_pracy['tytul']) ? $zalety_pracy['tytul'] : '';
$boxy = !empty($zalety_pracy['box']) ? $zalety_pracy['box'] : array();

// Get images
$zdjecie_1 = get_field('zdjecie_1');
$zdjecie_2 = get_field('zdjecie_2');
$zdjecie_3 = get_field('zdjecie_3');
$zdjecie_1_url = $zdjecie_1 ? wp_get_attachment_image_url($zdjecie_1, 'full') : '';
$zdjecie_2_url = $zdjecie_2 ? wp_get_attachment_image_url($zdjecie_2, 'full') : '';
$zdjecie_3_url = $zdjecie_3 ? wp_get_attachment_image_url($zdjecie_3, 'full') : '';

// Get bottom title
$tytul_dol = get_field('tytul_dol');
?>

<?php
// Include the hero-simple component
get_template_part('template-parts/components/hero-simple', null, [
    'title' => get_the_title(),
]);
?>

<section class="kariera">
    <div class="container">
        <div class="kariera__wrapper">
            <div class="kariera__left">
                <div class="label"><?php _e('DOŁĄCZ DO ZESPOŁU', 'edba'); ?></div>
                <h2 class="kariera__title"><?php echo !empty($tytul) ? esc_html($tytul) : ''; ?></h2>
                <div class="kariera__content">
                    <?php echo wp_kses_post($tekst); ?>
                </div>
            </div>

            <div class="kariera__right">
                <?php echo do_shortcode('[contact-form-7 id="cc892d4" title="Kariera PL"]'); ?>
            </div>
        </div>
    </div>
</section>

<section class="kariera__image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/bg-abstraction.webp" alt="EDBA Kariera" class="kariera__bg">
</section>

<section class="kariera-zalety">
    <div class="container">


            <?php get_template_part('template-parts/components/text-section', null, array(
        'label' => $etykieta,
        'title' => $zalety_tytul,
        'class' => 'kariera_header',
    )); ?>
        
        <div class="kariera-zalety__grid">
            <?php if (!empty($boxy)) : ?>
                <?php foreach ($boxy as $box) : ?>
                    <div class="kariera-zalety__item">
                        <?php if (!empty($box['ikonka'])) : ?>
                            <div class="kariera-zalety__item-icon">
                                <img src="<?php echo esc_url($box['ikonka']['url']); ?>" alt="<?php echo esc_attr($box['tytul'] ?? ''); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($box['tytul'])) : ?>
                            <span class="kariera-zalety__item-title"><?php echo esc_html($box['tytul']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($box['tekst'])) : ?>
                            <div class="kariera-zalety__item-text"><?php echo esc_html($box['tekst']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>


<section class="kariera-galeria">
    <div class="container">
        <div class="kariera-galeria__images">
            <?php if ($zdjecie_1_url) : ?>
                <div class="kariera-galeria__image kariera-galeria__image--left">
                    <img src="<?php echo esc_url($zdjecie_1_url); ?>" alt="EDBA Kariera" class="kariera-galeria__img">
                </div>
            <?php endif; ?>
            <div class="kariera-galeria__right">
                <?php if ($zdjecie_2_url) : ?>
                    <div class="kariera-galeria__image kariera-galeria__image--top">
                        <img src="<?php echo esc_url($zdjecie_2_url); ?>" alt="EDBA Kariera" class="kariera-galeria__img">
                    </div>
                <?php endif; ?>

                <?php if ($zdjecie_3_url) : ?>
                    <div class="kariera-galeria__image kariera-galeria__image--bottom">
                        <img src="<?php echo esc_url($zdjecie_3_url); ?>" alt="EDBA Kariera" class="kariera-galeria__img">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="kariera-galeria__content">
            <?php if ($tytul_dol) : ?>
                <h2 class="kariera-galeria__title">
                    <?php echo wp_kses_post($tytul_dol); ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>