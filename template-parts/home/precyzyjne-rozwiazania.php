<?php
$rozwiazania = get_field('rozwiazania');

if ($rozwiazania) {
    $zdjecie_1 = $rozwiazania['zdjecie_1'] ?? '';
    $zdjecie_2 = $rozwiazania['zdjecie_2'] ?? '';
    $zdjecie_3 = $rozwiazania['zdjecie_3'] ?? '';
    $naglowek = $rozwiazania['naglowek'] ?? '';

    // Get image URLs
    $zdjecie_1_url = $zdjecie_1 ? wp_get_attachment_image_url($zdjecie_1, 'large') : '';
    $zdjecie_2_url = $zdjecie_2 ? wp_get_attachment_image_url($zdjecie_2, 'large') : '';
    $zdjecie_3_url = $zdjecie_3 ? wp_get_attachment_image_url($zdjecie_3, 'large') : '';
}
?>

<section class="precyzyjne-rozwiazania">
    <div class="container">
        <div class="precyzyjne-rozwiazania__images">
            <?php if ($zdjecie_1_url) : ?>
                <div class="precyzyjne-rozwiazania__image precyzyjne-rozwiazania__image--left">
                    <img src="<?php echo esc_url($zdjecie_1_url); ?>" alt="" class="precyzyjne-rozwiazania__img">
                </div>
            <?php endif; ?>
                <div class="precyzyjne-rozwiazania__image--right">
     <?php if ($zdjecie_2_url) : ?>
                <div class="precyzyjne-rozwiazania__image precyzyjne-rozwiazania__image--top">
                    <img src="<?php echo esc_url($zdjecie_2_url); ?>" alt="" class="precyzyjne-rozwiazania__img">
                </div>
            <?php endif; ?>

            <?php if ($zdjecie_3_url) : ?>
                <div class="precyzyjne-rozwiazania__image precyzyjne-rozwiazania__image--bottom">
                    <img src="<?php echo esc_url($zdjecie_3_url); ?>" alt="" class="precyzyjne-rozwiazania__img">
                </div>
            <?php endif; ?>
                </div>
       
        </div>

        <div class="precyzyjne-rozwiazania__content">
            <?php if ($naglowek) : ?>
                <h2 class="precyzyjne-rozwiazania__title">
                    <?php echo wp_kses_post($naglowek); ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>
</section>