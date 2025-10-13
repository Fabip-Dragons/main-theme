<?php
/**
 * Main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
        
        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.', 'main-theme'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
