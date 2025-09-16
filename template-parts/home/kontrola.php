<?php
$kontrola_jakosci = get_field('kontrola_jakosci');
$etykieta = $kontrola_jakosci['etykieta'] ?? '';
$naglowek = $kontrola_jakosci['naglowek'] ?? '';
$tekst = $kontrola_jakosci['tekst'] ?? '';
$boxy = $kontrola_jakosci['box'] ?? [];
?>

<section class="kontrola">
    <div class="container">
        <?php
        get_template_part('template-parts/components/text-section', null, [
            'label' => esc_html($etykieta),
            'title' => esc_html($naglowek),
            'text'  => esc_html($tekst),
        ]);
        ?>
        <div class="kontrola__cta">
            <a href="<?php echo esc_url(get_permalink(156)); ?>" class="btn btn--primary">
                <?php _e('Czytaj więcej', 'edba'); ?>
            </a>
        </div>

        <?php if (!empty($boxy)) : ?>
            <div class="kontrola__boxes">
                <?php foreach ($boxy as $box) : ?>
                    <div class="kontrola__box">
                        <?php if (!empty($box['ikonka'])) : ?>
                            <div class="kontrola__box-icon">
                                <img src="<?php echo esc_url($box['ikonka']); ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($box['tekst'])) : ?>
                            <div class="kontrola__box-text">
                                <?php echo esc_html($box['tekst']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>