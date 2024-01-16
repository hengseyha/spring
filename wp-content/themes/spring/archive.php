<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

get_header();?>
<div class="relative">
  <div class="lg:h-[250px] overflow-hidden ">
    <?php if (function_exists('z_taxonomy_image')) z_taxonomy_image(); ?>
  </div>
   <div class=" absolute top-[50px] md:top-[90px] w-full ">
	   <h1 class="text-center text-[34px] font-semibold text-white"><?php echo get_the_category( $id )[0]->name?></h1>
	   <div class="border-t-4 border-white white-popup w-14 mx-auto rounded-sm"></div>
   </div>

</div>
<main id="primary" class="container wrapper-content mx-auto px-4 lg:px-0 my-5 lg:mt-10">

	<div class="lg:grid grid-cols-3 gap-4 mt-5">
	<?php if (have_posts()) : ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="bg-white rounded-lg shadow-md">
					<div class=" cart-posts group mb-5">
						<a href="<?php the_permalink() ?>" class="related-thumb ">
							<div class="h-[250px] overflow-hidden rounded-t-lg"><?php the_post_thumbnail("large", "w-[100%] transform transition duration-500 scale-110 group-hover:scale-125"); ?></div>
						</a>
						<div class="p-5">
							<h5 class="title-like mb-2 text-base font-bold tracking-tight text-gray-900 group-hover:text-primary "><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
							<div class="text-xs mb-2 text-gray-400">
								<?php echo '<span class="text-[#707070] font-medium">' . get_the_date("l, F j, Y") . '</span>'; ?>
							</div>
						</div>
					</div>
				</div>
				
		<?php 
		endwhile;
		endif; 
		?>
	</div>
	<?php
	the_posts_pagination();
	?>
<div class="hidden">
		<?php

		/* Start the Loop */
		while (have_posts()) :
			the_post('<h1 class="hidden">', '</h1>');
			the_excerpt();
			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content/content', get_post_type());

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content/content', 'none');

	endif;
		?>
		</div>
</main><!-- #main -->

<?php
get_footer();
