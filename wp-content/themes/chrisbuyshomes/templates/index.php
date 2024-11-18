<?php
// Include the header

ob_start();
if (have_posts()) :
    while (have_posts()) : the_post();
        chris_buys_homes_get_template_part_with_fallback('template-parts/content', get_post_format());
    endwhile;
else :
    chris_buys_homes_get_template_part_with_fallback('template-parts/content', 'none');
endif;
$the_content = ob_get_clean();

chris_buys_homes_get_header(); ?>

<main>
    <?= $the_content ?>
</main>

<?php
// Include the footer
chris_buys_homes_get_footer();