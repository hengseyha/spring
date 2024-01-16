<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

?>

<article class="container mx-auto search-result" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' === get_post_type()) : ?>
			<!-- <div>
			<?php
			spring_posted_on();
			spring_posted_by();
			?>
		</div> -->
		<?php endif; ?>
	</header>
	<div class="bg-white rounded-lg shadow-md">
		<div class=" cart-posts group mb-5">
			<a href="<?php the_permalink() ?>" class="related-thumb ">
				<div class="h-[250px] overflow-hidden rounded-t-lg"><?php the_post_thumbnail("w-[100%] transform transition duration-500 scale-110 group-hover:scale-125"); ?></div>
			</a>
			<div class="p-5">
				<h5 class="title-like mb-2 text-base font-bold tracking-tight text-gray-900 group-hover:text-primary "><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
				<div class="text-xs mb-2 text-gray-400">
					<?php echo '<span class="text-[#707070] font-medium">' . get_the_date("l, F j, Y") . '</span>'; ?>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->