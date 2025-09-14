<?php
$branze = get_field('branze');
$etykieta = $branze['etykieta'] ?? '';
$naglowek = $branze['naglowek'] ?? '';
?>
<section class="branze">
    <?php
    get_template_part('template-parts/components/text-section', null, [
        'label' => $etykieta,
        'title' => $naglowek,
        'class' => 'white-text-section container'
    ]);
    ?>

    <div class="wrap">
        <?php if ($branze && ! empty($branze['branza'])): ?>
            <div class="branze-list">
                <?php foreach ($branze['branza'] as $row):
                    $nazwa   = $row['nazwa'];
                    $opis    = $row['opis'];
                    $link    = $row['link'];
                    $obrazek = $row['obrazek'];
                    // Use large size for better quality images
                    $img_url = $obrazek ? wp_get_attachment_image_url($obrazek, 'large') : '';
                ?>
                  <div class="branze-item">
                    <div class="container">
                        <div class="branze-item__content">
                            <h2 class="branze-item__title"><?php echo esc_html($nazwa); ?></h2>
                            <div class="branze-item__text"><?php echo wp_kses_post($opis); ?></div>
                            <?php if ($link): ?>
                                <a href="<?php echo esc_url($link); ?>" class="branze-item__cta btn btn--secondary"><?php esc_html_e("Czytaj więcej", 'edba'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="branze-item__image">
                        <?php if ($img_url): ?>
                            <img class="branze-item__img" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($nazwa); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        <?php endif; ?>



    </div>

</section>