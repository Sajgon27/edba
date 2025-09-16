<?php

/**
 * The template for displaying the Contact page
 *
 * This is a specific template for the Contact page (page-kontakt.php)
 */

get_header();

// Get ACF fields
$adres = get_field('adres');
$email = get_field('email');
$nr_telefonu_1 = get_field('nr_telefonu_1');
$nr_telefonu_2 = get_field('nr_telefonu_2');
?>

<?php
// Include the hero-simple component
get_template_part('template-parts/components/hero-simple', null, [
    'title' => get_the_title(),
]);
?>

<section class="kontakt">
    <div class="container">
        <div class="kontakt__wrapper">
            <div class="kontakt__left">
                <div class="label"><?php _e('DANE KONTAKTOWE', 'edba'); ?></div>
                <h2 class="kontakt__title"><?php _e('EDBA Bartosz Drosakis', 'edba'); ?></h2>

                <div class="kontakt__info">
                    <?php if ($adres) : ?>
                        <div class="kontakt__info-item">
                            <div class="kontakt__info-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/contact/map.svg" alt="Adres" />
                            </div>
                            <div class="kontakt__info-text"><?php echo esc_html($adres); ?></div>
                        </div>
                    <?php endif; ?>

                         <?php if ($nr_telefonu_1) : ?>
                        <div class="kontakt__info-item">
                            <div class="kontakt__info-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/contact/phone.svg" alt="Telefon" />
                            </div>
                            <div class="kontakt__info-text">
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', $nr_telefonu_1)); ?>"><?php echo esc_html($nr_telefonu_1); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="kontakt__info-item">
                            <div class="kontakt__info-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/contact/mail.svg" alt="Email" />
                            </div>
                            <div class="kontakt__info-text">
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>

               

                    <?php if ($nr_telefonu_2) : ?>
                        <div class="kontakt__info-item">
                            <div class="kontakt__info-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/contact/phone2.svg" alt="Telefon" />
                            </div>
                            <div class="kontakt__info-text">
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', $nr_telefonu_2)); ?>"><?php echo esc_html($nr_telefonu_2); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <button id="sprawdz-dojazd-btn" class="btn btn--primary"><?php _e('SPRAWDŹ DOJAZD', 'edba'); ?></button>
            </div>

            <div class="kontakt__right">
                <?php echo do_shortcode('[contact-form-7 id="fd28699" title="Kontakt PL"]'); ?>
            </div>
        </div>
    </div>
</section>

<section id="map-section" class="kontakt-mapa">
    <div class="container">
        <div id="map"></div>
        <a href="https://maps.google.com/maps?q=54.10815233663964,19.54320172572566&saddr=Current+Location" target="_blank" class="kontakt-mapa__wyznacz btn btn--filled">
            <?php _e('WYZNACZ TRASĘ', 'edba'); ?>
        </a>
    </div>
</section>

<?php
// Add Leaflet CSS and JS in footer
add_action('wp_footer', function () {
?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Exact coordinates for Myślęcin 6a, 82-310 Elbląg 2
            var myslecin_coords = [54.10815233663964, 19.54320172572566];
            
            // Initialize the map - more zoomed out (zoom level 10 instead of 13)
            var map = L.map('map', {
                zoomControl: false, // Remove zoom controls
                attributionControl: false // Remove attribution
            }).setView(myslecin_coords, 6);

            // Add the tile layer with grayscale filter
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                className: 'map-tiles-grayscale' // Apply CSS filter via this class
            }).addTo(map);

            // Create a standard Leaflet icon with custom options to match the image
            var orangeIcon = L.icon({
                iconUrl: '<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/map-marker.svg',
                iconSize: [36, 50], // Size of the icon (matches SVG dimensions)
                iconAnchor: [18, 50], // Point of the icon which corresponds to marker's location (bottom middle)
                popupAnchor: [0, -50] // Point from which popups should open (top middle)
            });

            // Add a marker with custom icon for Myślęcin 6a using exact coordinates
            var marker = L.marker(myslecin_coords, {
                icon: orangeIcon
            }).addTo(map);

            // Add click event to the "SPRAWDŹ DOJAZD" button
            document.getElementById('sprawdz-dojazd-btn').addEventListener('click', function() {
                document.getElementById('map-section').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
<?php
});
?>

<?php get_footer(); ?>