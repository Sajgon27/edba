<?php
/**
 * Sekcja Bloki Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'sekcja-bloki-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" values.
$classes = 'sekcja-bloki';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Get ACF fields
$etykieta = get_field('etykieta');
$tytul = get_field('tytul');
$tekst = get_field('tekst');
$bloki = get_field('blok');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="container">
        <div class="sekcja-bloki__header">
            <?php if ($etykieta) : ?>
                <div class="sekcja-bloki__etykieta label"><?php echo esc_html($etykieta); ?></div>
            <?php endif; ?>
            
            <?php if ($tytul) : ?>
                <h2 class="sekcja-bloki__tytul"><?php echo esc_html($tytul); ?></h2>
            <?php endif; ?>
            
            <?php if ($tekst) : ?>
                <div class="sekcja-bloki__tekst"><?php echo esc_html($tekst); ?></div>
            <?php endif; ?>
        </div>
        
        <?php if ($bloki && is_array($bloki)) : ?>
            <!-- Desktop version (3 column grid) -->
            <div class="sekcja-bloki__grid desktop-only">
                <?php foreach ($bloki as $blok) : ?>
                    <div class="sekcja-bloki__item">
                        <?php if (!empty($blok['ikonka'])) : ?>
                            <div class="sekcja-bloki__item-icon">
                                <img src="<?php echo esc_url($blok['ikonka']); ?>" alt="<?php echo esc_attr($blok['tytul'] ?? ''); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($blok['tytul'])) : ?>
                            <span class="sekcja-bloki__item-title"><?php echo esc_html($blok['tytul']); ?></span>
                        <?php endif; ?>
                        
                        <?php if (!empty($blok['tekst'])) : ?>
                            <div class="sekcja-bloki__item-text"><?php echo esc_html($blok['tekst']); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Mobile version (Swiper) -->
            <div class="sekcja-bloki__swiper mobile-only">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($bloki as $blok) : ?>
                            <div class="swiper-slide">
                                <div class="sekcja-bloki__item">
                                    <?php if (!empty($blok['ikonka'])) : ?>
                                        <div class="sekcja-bloki__item-icon">
                                            <img src="<?php echo esc_url($blok['ikonka']); ?>" alt="<?php echo esc_attr($blok['tytul'] ?? ''); ?>">
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($blok['tytul'])) : ?>
                                        <h3 class="sekcja-bloki__item-title"><?php echo esc_html($blok['tytul']); ?></h3>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($blok['tekst'])) : ?>
                                        <div class="sekcja-bloki__item-text"><?php echo esc_html($blok['tekst']); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Add pagination bullets -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>