<?php
$zespol = get_field('zespol');

if ($zespol) {
    $etykieta = $zespol['etykieta'] ?? '';
    $naglowek = $zespol['naglowek'] ?? '';
    $tekst = $zespol['tekst'] ?? '';
    $zdjecie = $zespol['zdjecie'] ?? '';
}
?>

<section class="zespol">
    <div class="container">
        <?php
        // Use the text-section component for the header content
        get_template_part('template-parts/components/text-section', null, [
            'label' => $etykieta,
            'title' => $naglowek,
            'text' => $tekst
        ]);
        ?>

        <?php if (!empty($zdjecie)) : ?>
            <div class="zespol__image-wrapper">
                <img 
                    src="<?php echo esc_url($zdjecie['url']); ?>" 
                    alt="<?php echo esc_attr($zdjecie['alt'] ?? ''); ?>" 
                    class="zespol__image" 
                    width="<?php echo esc_attr($zdjecie['width'] ?? ''); ?>"
                    height="<?php echo esc_attr($zdjecie['height'] ?? ''); ?>"
                    loading="lazy"
                />
            </div>
        <?php endif; ?>
    </div>
</section>
