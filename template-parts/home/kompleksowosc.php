<?php
$kompleksowosc = get_field('kompleksowosc');
$etykieta = $kompleksowosc['etykieta'] ?? '';
$tekst = $kompleksowosc['tekst'] ?? '';
?>

<section class="kompleksowosc">
    <div class="container">
        <div class="kompleksowosc__wrapper">
            <div class="kompleksowosc__header">
                <?php if ($etykieta) : ?>
                    <span class="kompleksowosc__label label"><?php echo esc_html($etykieta); ?></span>
                <?php endif; ?>

            </div>

            <?php if ($tekst) : ?>
                <div class="kompleksowosc__content">
                    <h2 class="kompleksowosc__title">
                        <?php echo esc_html__('Dzięki', 'edba'); ?> <span class="text-highlight"><?php echo esc_html__('kompleksowej obsłudze', 'edba'); ?> 🡥</span>
                        <?php echo esc_html__('projektów zapewniamy pełne wsparcie na każdym etapie produkcji – od pomysłu przez techniczne konsultacje po gotowy produkt.', 'edba'); ?>
                    </h2>
                    <p class="kompleksowosc__text"><?php echo wp_kses_post($tekst); ?></p>
                </div>

            <?php endif; ?>

        </div>
    </div>
    <div class="kompleksowosc__image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/bg-abstraction.webp" alt="Kompleksowa obsługa" class="kompleksowosc__bg">
    </div>
</section>