<?php get_header(); ?>
    <?php 
    // Include the hero-simple component at the top
    get_template_part('template-parts/components/hero-simple', null, [
        'title' => get_the_title(),
    ]); 
    ?>
    <section class="container page-content">
        <?php the_content(); ?>
    </section>

<?php get_footer(); ?>