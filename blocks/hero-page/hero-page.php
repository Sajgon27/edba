<?php

/**
 * Hero Page Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-page-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'hero-page';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
$title = get_field('tytul');
$bg_image_id = get_field('tlo_zdjecie');
$bg_video = get_field('tlo_film');
$show_video_button = get_field('zobacz_video');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php if ($bg_video) : ?>
        <video class="hero-page__bg-video" autoplay muted loop playsinline>
            <source src="<?php echo esc_url($bg_video['url']); ?>" type="video/mp4">
        </video>
    <?php elseif ($bg_image_id) : ?>
        <?php echo wp_get_attachment_image($bg_image_id, 'full', false, array('class' => 'hero-page__bg-image')); ?>
    <?php endif; ?>

    <div class="hero-page__overlay"></div>


    <div class="container">
        <div class="hero-page__content">
            <?php if ($show_video_button && $bg_video) : ?>
                <div class="hero-page__video-button">
                    <a href="<?php echo esc_url($bg_video['url']); ?>" class="video-trigger" target="_blank" rel="noopener noreferrer">
                        <div class="video-icon">
                           <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 3C4 2.6 4.4 2.4 4.7 2.6L12 7.2C12.3 7.4 12.3 7.9 12 8.1L4.7 12.7C4.4 12.9 4 12.7 4 12.3V3Z" fill="currentColor"/>
</svg>

                        </div>
                        <span class="video-text"><?php echo esc_html__('ZOBACZ WIDEO', 'edba'); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($title) : ?>
                <h1 class="hero-page__title"><?php echo $title; ?></h1>
            <?php endif; ?>
        </div>
    </div>
</section>