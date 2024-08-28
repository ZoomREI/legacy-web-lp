<?php
// Include the header
chris_buys_homes_get_header(); ?>

<main id="site-content" role="main">
    <div class="legal-content">
        <h1 class="legal-title"><?php the_title(); ?></h1>
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</main>

<?php
// Include the footer
chris_buys_homes_get_footer();
