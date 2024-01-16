<?php

/**
 * Template Name: Template News
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

get_header();
?>

<main id="primary">
    <?php
    // wp-query to get all published posts without pagination
    $allPostsWPQuery = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1)); ?>

    <?php if ($allPostsWPQuery->have_posts()) : ?>

        <ul>
            <?php while ($allPostsWPQuery->have_posts()) : $allPostsWPQuery->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p><?php _e('There no posts to display.'); ?></p>
    <?php endif; ?>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
