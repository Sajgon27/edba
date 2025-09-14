<?php

/**
 * Nasze Liczby Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'nasze-liczby-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'nasze-liczby';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$label = get_field('etykieta');
$title = get_field('tytul');
$liczby = get_field('liczba');

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php
// Use the text-section template part for the header
get_template_part('template-parts/components/text-section', null, array(
    'label' => $label,
    'title' => $title
));
?>
    <div class="container nasze-liczby__inner">
        <?php if ($liczby && count($liczby) > 0) : ?>
            <div class="nasze-liczby__grid">
                <?php foreach ($liczby as $item) : ?>
                    <div class="nasze-liczby__item">
                        <div class="nasze-liczby__number"><?php echo esc_html($item['liczba']); ?></div>
                        <div class="nasze-liczby__text"><?php echo esc_html($item['tekst']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>