<?php
/**
 * Reusable text section with label, title and optional text
 *
 * @param string $label     The label text (required)
 * @param string $title     The title text (required)
 * @param string $text      Optional text content
 * @param string $class     Optional additional CSS class
 */

// Make sure we have the required parameters
if (!isset($args['label']) || !isset($args['title'])) {
    return;
}

$label = $args['label'];
$title = $args['title'];
$text = $args['text'] ?? '';
$class = $args['class'] ?? '';
?>

<section class="text-section <?php echo esc_attr($class); ?>">
    <div class="container">
        
    <span class="label"><?php echo wp_kses_post($label); ?></span>
    <div class="text-section__content">
        <h2 class="text-section__title"><?php echo esc_html($title); ?></h2>
        
        <?php if (!empty($text)) : ?>
            <p class="text-section__text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>
    </div>
    </div>
</section>