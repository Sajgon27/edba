<?php

/**
 * Historia Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'historia-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'historia';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$label = get_field('etykieta');
$title = get_field('tytul');
$text = get_field('tekst');
$images = get_field('zdjecia');
$timeline = get_field('os_czasu');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="historia__wrapper">
        <!-- Images Slideshow -->
        <?php if ($images && count($images) > 0) : ?>
        <div class="historia__images">
            <div class="historia__slideshow">
                <?php foreach ($images as $index => $image_id) : 
                    $image_url = wp_get_attachment_image_url($image_id, 'full'); 
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); 
                ?>
                    <div class="historia__slide <?php echo ($index === 0) ? 'active' : ''; ?>" style="background-image: url('<?php echo esc_url($image_url); ?>');">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="historia__slide-img">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="historia__content">
            <div class="container historia__container">
                <?php if ($label) : ?>
                    <div class="historia__label  label"><?php echo esc_html($label); ?></div>
                <?php endif; ?>
                
                <?php if ($title) : ?>
                    <h2 class="historia__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($text) : ?>
                    <div class="historia__text"><?php echo esc_html($text); ?></div>
                <?php endif; ?>

                <!-- Timeline - Combined Structure -->
                <?php if ($timeline && count($timeline) > 0) : ?>
                <div class="historia__timeline">
                    <!-- Single Timeline with Events and Dots -->
                    <div class="historia__timeline-container">
                        <div class="historia__line"></div>
                        <div class="swiper historia-timeline-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($timeline as $index => $event) : ?>
                                    <div class="swiper-slide">
                                        <div class="historia__event" data-index="<?php echo esc_attr($index); ?>">
                                            <div class="historia__year"><?php echo esc_html($event['rok']); ?></div>
                                            <div class="historia__description"><?php echo esc_html($event['wydarzenie']); ?></div>
                                            <div class="historia__dot" data-index="<?php echo esc_attr($index); ?>"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="swiper-slide"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Timeline Navigation -->
                    <div class="historia__timeline-nav">
                        <button class="historia__nav historia__nav--prev" aria-label="Previous event">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 18l-6-6 6-6"/>
                            </svg>
                        </button>
                        <button class="historia__nav historia__nav--next" aria-label="Next event">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>