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
$main_image = get_field('zdjecie'); // Get the main fallback image

// Check if we have individual section images
$has_section_images = false;
$section_images_count = 0;
if ($sections && is_array($sections)) {
    foreach ($sections as $section) {
        if (!empty($section['zdjecie'])) {
            $has_section_images = true;
            $section_images_count++;
        }
    }
}

// Only enable hover functionality if we have multiple section images
$enable_hover = $has_section_images && $section_images_count > 1;
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="tekst-zdjecie__wrapper" data-hover-enabled="<?php echo $enable_hover ? 'true' : 'false'; ?>">
        <div class="tekst-zdjecie__image-wrapper">
            <?php
            // If no section images, use the main image
            if (!$has_section_images && !empty($main_image)) {
                if (function_exists('wp_get_attachment_image')) {
                    echo wp_get_attachment_image($main_image['ID'], 'full', false, array(
                        'class' => 'tekst-zdjecie__image'
                    ));
                } else {
                    echo '<img src="' . esc_url($main_image['url']) . '" alt="' . esc_attr($main_image['alt']) . '" class="tekst-zdjecie__image">';
                }
            }
            // If we have section images and hover is enabled, output all images
            elseif ($enable_hover && $sections && is_array($sections)) {
                foreach ($sections as $i => $section) {
                    if (!empty($section['zdjecie'])) {
                        $img = $section['zdjecie'];
                        $is_active = $i === 0 ? 'active' : '';
                        if (function_exists('wp_get_attachment_image')) {
                            echo wp_get_attachment_image($img['ID'], 'full', false, array(
                                'class' => 'tekst-zdjecie__image ' . $is_active,
                                'data-index' => $i
                            ));
                        } else {
                            echo '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '" class="tekst-zdjecie__image ' . $is_active . '" data-index="' . $i . '">';
                        }
                    }
                }
            }
            // Otherwise, show just the first section image if available
            elseif ($has_section_images && $sections && is_array($sections)) {
                foreach ($sections as $section) {
                    if (!empty($section['zdjecie'])) {
                        $img = $section['zdjecie'];
                        if (function_exists('wp_get_attachment_image')) {
                            echo wp_get_attachment_image($img['ID'], 'full', false, array(
                                'class' => 'tekst-zdjecie__image'
                            ));
                        } else {
                            echo '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '" class="tekst-zdjecie__image">';
                        }
                        break; // Only show the first image
                    }
                }
            }
            
            // Show message if no images found at all
            if (!$has_section_images && empty($main_image) && is_admin()) {
                echo '<p>Please add either a main image or images to individual sections.</p>';
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