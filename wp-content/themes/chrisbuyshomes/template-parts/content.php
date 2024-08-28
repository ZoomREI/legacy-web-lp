<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php echo get_breadcrumb(); ?>
        <div class="entry-dets">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            <div class="entry-meta">
                <span class="author"><?php the_author(); ?></span>
                |
                <span class="date"><?php the_date(); ?></span>
            </div>
        </div>
        <?php get_template_part('template-parts/share-bar'); ?>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <footer class="entry-footer">
        <?php get_template_part('template-parts/share-bar'); ?>
        <div class="author-bio">
            <div class="author-avatar">
                <?php
                $profile_picture = get_the_author_meta('profile_picture');
                if ($profile_picture) {
                    echo '<img src="' . esc_url($profile_picture) . '" alt="' . esc_attr(get_the_author()) . '" />';
                } else {
                    echo get_avatar(get_the_author_meta('ID'), 96);
                }
                ?>
            </div>
            <div class="author-description">
                <div class="author-info">
                    <h3><?php the_author(); ?></h3>
                    <p class="author-title"><?php echo esc_html(get_the_author_meta('author_title')); ?></p>
                </div>
                <p><?php the_author_meta('description'); ?></p>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">Read full author bio</a>
            </div>
        </div>

        <?php echo do_shortcode('[doctor_homes_post-banner]'); ?>
    </footer>
</article>