<?php
/**
 * Certyfikaty Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'certyfikaty-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'certyfikaty';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Load ACF values
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$kolumny = get_field('kolumna');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <div class="certyfikaty__header">
            <?php if ($etykieta) : ?>
                <div class="certyfikaty__label label"><?php echo esc_html($etykieta); ?></div>
            <?php endif; ?>
            
            <?php if ($tytul) : ?>
                <h2 class="certyfikaty__title"><?php echo esc_html($tytul); ?></h2>
            <?php endif; ?>
        </div>
        
        <?php if ($kolumny && count($kolumny) > 0) : ?>
            <div class="certyfikaty__grid">
                <?php foreach ($kolumny as $kolumna) : ?>
                    <div class="certyfikaty__item">
                        <?php if (!empty($kolumna['ikonka'])) : ?>
                            <div class="certyfikaty__icon">
                                <img src="<?php echo esc_url($kolumna['ikonka']['url']); ?>" alt="<?php echo esc_attr($kolumna['ikonka']['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($kolumna['tytul'])) : ?>
                            <span class="certyfikaty__item-title"><?php echo esc_html($kolumna['tytul']); ?></span>
                        <?php endif; ?>
                        
                        <?php if (!empty($kolumna['tekst'])) : ?>
                            <div class="certyfikaty__text"><?php echo esc_html($kolumna['tekst']); ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($kolumna['link_certyfikatu'])) : ?>
                            <a href="<?php echo esc_url($kolumna['link_certyfikatu']); ?>" class="btn btn--primary certyfikaty__btn">
                                <?php echo esc_html__('POKAŻ CERTYFIKAT', 'edba'); ?>
                                
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>