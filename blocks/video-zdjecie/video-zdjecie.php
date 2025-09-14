<?php
/**
 * Video - Zdjęcie Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'video-zdjecie-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'video-zdjecie';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
$image_id = get_field('zdjecie');
$video_url = get_field('film');
$text = get_field('tekst');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <div class="video-zdjecie__wrapper">
            <div class="video-zdjecie__media">
                <?php if ($video_url) : ?>
                    <div class="video-zdjecie__video-container">
                        <video class="video-zdjecie__video" autoplay muted loop playsinline>
                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php elseif ($image_id) : ?>
                    <div class="video-zdjecie__image-container">
                        <?php echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'video-zdjecie__image')); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ($text) : ?>
                <div class="video-zdjecie__content">
                    <div class="video-zdjecie__text">
                        <?php echo $text; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>