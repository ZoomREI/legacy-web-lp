<?php
chris_buys_homes_get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    while (have_posts()) : the_post();
        error_log('single.php - Start rendering post ID: ' . get_the_ID());
        chris_buys_homes_get_template_part_with_fallback('template-parts/content', 'single');
        error_log('single.php - End rendering post ID: ' . get_the_ID());
    endwhile; // End of the loop.
    ?>
    
    <?php echo do_shortcode('[chris_buys_homes_blog]'); ?>
</main>

<?php
chris_buys_homes_get_footer();
