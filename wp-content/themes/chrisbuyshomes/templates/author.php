<?php chris_buys_homes_get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    // Get author ID
    $author_id = get_queried_object_id();
    ?>

    <div class="author-page">
        <div class="author-avatar">
            <?php echo get_avatar($author_id, 128); ?>
        </div>
        <div class="author-info">
            <h1><?php echo get_the_author_meta('display_name', $author_id); ?></h1>
            <p class="author-title"><?php echo esc_html(get_the_author_meta('author_title', $author_id)); ?></p>
            <div class="author-bio">
                <?php echo wpautop(get_the_author_meta('full_bio', $author_id)); ?>
            </div>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <h2>Posts by <?php the_author(); ?></h2>
        <div class="author-posts">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php chris_buys_homes_get_footer(); ?>