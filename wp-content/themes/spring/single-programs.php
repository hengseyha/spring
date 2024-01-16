<?php

/**
 * The template for displaying all for single progam
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package spring
 */

get_header();
?>
<div class="lg:my-4 my-5 px-4 lg:px-0 container mx-auto">
    <?php get_breadcrumb(); ?>
</div>
<main id="primary " class="wraper-single wrapper-program container mx-auto bg-white rounded-lg p-4 lg:px-0">
    <div class="lg:flex gap-5 mb-10">
        <div class="lg:w-[70%] w-full lg:mr-10 wrapper-single lg:border-r-1">
            <?php
            while (have_posts()) :
                the_post();
                the_post_thumbnail("w-full rounded thumbnail-programs");
                the_title("<h2 class='text-[28px] font-semibold text-primary my-4'>", "</h2>");
                // the_content();
                get_template_part('template-parts/content/content', 'programs');
            // get_template_part('template-parts/content/content', get_post_type());

            endwhile; // End of the loop.
            ?>
        </div>
        <div class="lg:w-[30%] w-full">
            <div class="sticky top-[4.5rem]">
                <?php dynamic_sidebar('program'); ?>
                <div class="bg-white list-opening-hours w-full rounded-lg border border-gray-200 text-[#434343] py-5">
                    <h1 class="text-[22px] font-semibold px-5 text-primary mb-5">Opening Hours</h1>
                    <ul class="bg-white rounded-lg text-gray-900">
                        <?php if( get_post_meta($post->ID, 'day_1', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_1', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_2', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_2', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_3', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_3', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_4', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_4', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_5', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_5', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_6', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_6', true ). "</li>";
                        } ?>
                        <?php if( get_post_meta($post->ID, 'day_7', true) ) {
                            echo " <li>".get_post_meta( $post->ID, 'day_7', true ). "</li>";
                        } ?>
   
                    </ul> 
                </div>

            </div>
        </div>
    </div>
</main>

<?php
get_footer();
