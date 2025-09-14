<?php
/**
 * Tekst Zdjęcie Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tekst-zdjecie-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'tekst-zdjecie';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
// Get repeater sections
$sections = get_field('sekcja');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="tekst-zdjecie__wrapper">
        <div class="tekst-zdjecie__image-wrapper">
            <?php
            // Output all images for JS, default to first
            if ($sections && is_array($sections)) {
                $has_images = false;
                
                foreach ($sections as $i => $section) {
                    if (!empty($section['zdjecie'])) {
                        $has_images = true;
                        $img = $section['zdjecie'];
                        $is_active = $i === 0 ? 'active' : '';
                        
                        // Output the image with proper classes
                        if (function_exists('wp_get_attachment_image')) {
                            echo wp_get_attachment_image($img['ID'], 'full', false, array(
                                'class' => 'tekst-zdjecie__image ' . $is_active,
                                'data-index' => $i
                            ));
                        } else {
                            // Fallback if wp_get_attachment_image is not available
                            echo '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '" class="tekst-zdjecie__image ' . $is_active . '" data-index="' . $i . '">';
                        }
                    }
                }
                
                // Show message if no images found
                if (!$has_images && is_admin()) {
                    echo '<p>Please add images to the repeater fields.</p>';
                }
            }
            ?>
        </div>
        <div class="tekst-zdjecie__content">
            <?php if ($sections && is_array($sections)) : ?>
                <?php foreach ($sections as $i => $section) : ?>
                    <div class="tekst-zdjecie__section" data-index="<?php echo $i; ?>">
                        <div class="tekst-zdjecie__section-inner">
                        <?php if (!empty($section['tytul'])) : ?>
                            <h4 class="tekst-zdjecie__title"><?php echo esc_html($section['tytul']); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($section['tekst'])) : ?>
                            <div class="tekst-zdjecie__text">
                                <?php echo wp_kses_post($section['tekst']); ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>