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
                        Dzięki <span  class="text-highlight">kompleksowej obsłudze <svg viewBox="0 0 36 36">

                                <line x1="5" y1="31" x2="31" y2="5" stroke="#D94F30" stroke-width="3" stroke-linecap="butt" />
                                <line x1="4" y1="4" x2="32" y2="4" stroke="#D94F30" stroke-width="3" stroke-linecap="square" />
                                <line x1="32" y1="4" x2="32" y2="32" stroke="#D94F30" stroke-width="3" stroke-linecap="square" />
                            </svg></span>
                        projektów zapewniamy pełne wsparcie na każdym etapie
                        produkcji – od pomysłu przez techniczne konsultacje
                        po gotowy produkt.
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