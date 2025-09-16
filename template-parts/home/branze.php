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
                    $img_url = $obrazek ? wp_get_attachment_image_url($obrazek, 'full') : '';
                ?>

                    <div class="content content--sticky content--half bg-2">
                        <img class="content__img content__img--small" src="<?php echo esc_url($img_url); ?>" />
                    </div>
                    <div class="content content--sticky content--half bg-1">
                        <div class="content__inner">
                            <h2 class="content__title"><?php echo esc_html($nazwa); ?> </h2>
                            <p class="content__text content__text--narrow text-meta"><?php echo esc_html($opis); ?></p>
                            <a class="content__link btn btn--primary" href="<?php echo esc_url($link); ?>"><?php echo esc_html__('Czytaj więcej', 'edba'); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="branze__bottom">
        <div class="container">
            <h2 class="branze__bottom-title"><?php echo esc_html($branze['naglowek_dol'] ?? 'Panorama naszych branżowych partnerstw. Sprawdź inne sektory, dla których pracujemy:'); ?></h2>

            <div class="branze__links">
                <?php if ($branze && !empty($branze['inne_sektory'])): ?>
                    <?php foreach ($branze['inne_sektory'] as $sektor): ?>
                        <a href="<?php echo esc_url($sektor['link']); ?>" class="branze__link">
                            <?php echo esc_html($sektor['nazwa']); ?> <span class="branze__link-icon">🡥</span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="branze__video-wrapper">
        <div class="container">


            <?php if ($branze && !empty($branze['film'])):
                $video = $branze['film'];
                $video_url = $video['url'];
            ?>
                <video class="branze__video" autoplay loop muted playsinline>
                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                </video>
                <div class="branze__video-overlay"></div>
            <?php endif; ?>
        </div>
    </div>
</section>