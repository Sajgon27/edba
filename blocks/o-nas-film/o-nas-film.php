<?php
/**
 * O Nas Film Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'o-nas-film-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'o-nas-film';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$title = get_field('tytul');
$video_url = get_field('film');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="o-nas-film__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        
        <?php if ($video_url) : ?>
            <div class="o-nas-film__video-container">
                <div class="o-nas-film__overlay">
                    <div class="o-nas-film__play-button">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="40" cy="40" r="39" stroke="white" stroke-width="2"/>
                            <path d="M55 40L32.5 53.4545L32.5 26.5455L55 40Z" fill="white"/>
                        </svg>
                    </div>
                </div>
                <video class="o-nas-film__video" preload="metadata" poster>
                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                    <?php esc_html_e('Your browser does not support the video tag.', 'edba'); ?>
                </video>
            </div>
        <?php endif; ?>
    </div>
</section>