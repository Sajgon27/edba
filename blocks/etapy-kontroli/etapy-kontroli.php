<?php
/**
 * Etapy kontroli Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'etapy-kontroli';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$etapy = get_field('etap');
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <!-- Text Section Header -->
    <?php get_template_part('template-parts/components/text-section', null, array(
        'label' => $etykieta,
        'title' => $tytul,
        'content' => '',
        'class' => 'etapy-kontroli__header',
    )); ?>

    <!-- Etapy kontroli content -->
    <?php if ($etapy) : ?>
        <div class="etapy-kontroli__content">
            <div class="container">
                <div class="etapy-kontroli__items">
                    <?php foreach ($etapy as $etap) : ?>
                        <div class="etapy-kontroli__item">
                            <div class="etapy-kontroli__number">
                                <?php if ($etap['liczba']) : ?>
                                    <img src="<?php echo esc_url($etap['liczba']); ?>" alt="<?php echo esc_attr($etap['tytul']); ?>" class="etapy-kontroli__number-img">
                                <?php endif; ?>
                            </div>
                            <?php if ($etap['tytul']) : ?>
                                <span class="etapy-kontroli__title"><?php echo esc_html($etap['tytul']); ?></span>
                            <?php endif; ?>
                            <?php if ($etap['tekst']) : ?>
                                <div class="etapy-kontroli__text"><?php echo $etap['tekst']; ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
