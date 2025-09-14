<?php
/**
 * Block Name: Sekcja Bloki 2
 * Description: Block displaying content with icons and text in a grid
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$boxy = get_field('box');

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
        'class' => 'sekcja-bloki-2-header'
    ]
);
?>

<section class="sekcja-bloki-2 <?php echo esc_attr($class_name); ?>" <?php echo $anchor; ?>>
    <div class="container">
        <?php if ($boxy && is_array($boxy)) : ?>
            <div class="sekcja-bloki-2__grid">
                <?php foreach ($boxy as $box) : ?>
                    <div class="sekcja-bloki-2__item">
                        <?php if (!empty($box['ikonka'])) : ?>
                            <div class="sekcja-bloki-2__icon">
                                <img src="<?php echo esc_url($box['ikonka']); ?>" alt="<?php echo esc_attr($box['tytul'] ?? ''); ?>" />
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($box['tytul'])) : ?>
                            <span class="sekcja-bloki-2__item-title"><?php echo esc_html($box['tytul']); ?></span>
                        <?php endif; ?>
                        
                        <?php if (!empty($box['tekst'])) : ?>
                            <div class="sekcja-bloki-2__item-text"><?php echo wp_kses_post($box['tekst']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>