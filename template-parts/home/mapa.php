<?php
$mapa = get_field('mapa');
$etykieta = $mapa['etykieta'] ?? 'NASI KLIENCI';
$naglowek = $mapa['naglowek'] ?? 'Zaczęliśmy lokalnie, dziś jesteśmy obecni na rynkach wielu krajów.';
$film = $mapa['film'] ?? '';
$naglowek_dol = $mapa['naglowek_dol'] ?? 'Budujemy trwałe relacje z klientami w Europie i na świecie. Nasza sieć eksportowa stale się rozwija.';
$tekst = $mapa['tekst'] ?? 'Współpracujemy z firmami z Polski, Szwecji, Holandii, Belgii oraz krajów spoza Unii Europejskiej. Nasze realizacje trafiają do wymagających odbiorców, którzy cenią jakość, terminowość i partnerskie podejście.';
$liczba = $mapa['liczba'] ?? '21';
?>

<section class="mapa">
    <div class="container">
          <?php
        get_template_part('template-parts/components/text-section', null, [
            'label' => esc_html($etykieta),
            'title' => esc_html($naglowek),
           
        ]);
        ?>
        
        <div class="mapa__visual">
            <?php if ($film) : ?>
                <video class="mapa__video" autoplay loop muted playsinline>
                    <source src="<?php echo esc_url($film); ?>" type="video/mp4">
                </video>
            <?php else : ?>
                <div class="mapa__image">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/home/world-map.webp" alt="World map" class="mapa__map">
                    <span class="mapa__dot"></span>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mapa__footer">
            <div class="mapa__info">
                <h5 class="mapa__subtitle"><?php echo esc_html($naglowek_dol); ?></h5>
                <p class="mapa__text"><?php echo esc_html($tekst); ?></p>
            </div>
            <div class="mapa__stats">
                <div class="mapa__stats-content">
                    <span class="mapa__stats-label">KIERUNKÓW EKSPORTOWYCH</span>
                    <div class="mapa__stats-number"><?php echo esc_html($liczba); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>