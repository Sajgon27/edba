<?php
/**
 * Block Name: Maszyny Kontrola
 * Description: Block displaying machine control section with image and text
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$tekst = get_field('tekst');
$logo = get_field('logo');
$film = get_field('film');

// Block ID and classes
$block_id = $block['id'] ?? '';
$class_name = $block['className'] ?? '';
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '"';
}

// Include the text-section for the header
get_template_part(
    'template-parts/components/text-section',
    null,
    [
        'label' => $etykieta,
        'title' => $tytul,
        'class' => 'maszyny-kontrola-header'
    ]
);
?>

<section class="maszyny-kontrola <?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <div class="maszyny-kontrola__content">
            <div class="maszyny-kontrola__left">
                <div class="maszyny-kontrola__text">
                    <?php echo wpautop($tekst); ?>
                </div>
                <?php if ($logo) : ?>
                    <div class="maszyny-kontrola__logo">
                        <?php echo wp_get_attachment_image($logo, 'full'); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="maszyny-kontrola__right">
                <?php if ($film) : ?>
                    <div class="maszyny-kontrola__video">
                        <video class="maszyny-kontrola__video-element" autoplay muted loop playsinline>
                            <source src="<?php echo $film; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector('.maszyny-kontrola__video-element');
    
    if (video) {
        // Pause video when out of viewport to save resources
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        }, { threshold: 0.2 });
        
        observer.observe(video);
    }
});
</script>