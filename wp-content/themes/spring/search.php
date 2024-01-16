<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package spring
 */

get_header(); ?>

<main id="primary" class="container mx-auto my-5 search-result">

	<?php if (have_posts()) : ?>

		<header>
			<h1 class="entry-title">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'spring'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header>
		<div class="lg:grid grid-cols-3 gap-4 mt-5">
		<?php
		/* Start the Loop */
		while (have_posts()) :
			the_post();
			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part('template-parts/content/content', 'search');

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content/content', 'none');

	endif;
		?>
		</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
