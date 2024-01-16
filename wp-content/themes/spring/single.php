<?php
/**
 * The template for displaying all single posts
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
<main id="primary " class="wraper-single container mx-auto bg-white rounded-lg p-4 lg:px-0">
	<div class="lg:flex gap-5 mb-10 ">
		<div class="lg:w-[70%] w-full lg:mr-10 wrapper-single lg:border-r-1">
			<?php
			while (have_posts()) :
				the_post();
				the_title("<h1 class='text-[34px] font-semibold text-primary pb-4'>", "</h1>");
				echo '<span class="text-gray-500 font-normal block pb-4"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
			  </svg> ' . get_the_date("l, F j, Y") . '</span>';
				get_template_part('template-parts/content/content', get_post_type());
			endwhile; // End of the loop.
			?>
		</div>
		<div class="lg:w-[30%] w-full">
			<div class="sticky top-[4.5rem]">
				<?php get_sidebar(); ?>
				<div>
					<div>
						<?php $categories = get_the_category($post->ID); ?>
						<?php if ($categories) : ?>
							<?php $category_ids = array(); ?>
							<?php foreach ($categories as $individual_category) : ?>
								<?php $category_ids[] = $individual_category->term_id; ?>
							<?php endforeach; ?>
							<?php $args = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'posts_per_page' => 3,
								'ignore_sticky_posts' => 1,
								'oderby' => 'rand'
							); ?>
							<?php $my_query = new WP_Query($args); ?>
							<?php if ($my_query->have_posts()) : ?>
								<section>
									<h2 class="text-[20px] font-bold my-5">Related Article</h2>
									<div class="mb-2">
										<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
											<div class="bg-white rounded-lg shadow-md">
												<div class=" cart-posts group mb-5">
													<a href="<?php the_permalink() ?>" class="related-thumb ">
														<div class="h-[200px] overflow-hidden rounded-t-lg"><?php the_post_thumbnail("large", "w-full transform transition duration-500 scale-110 group-hover:scale-125"); ?></div>
													</a>
													<div class="p-5">
														<h5 class="title-like mb-2 text-base font-bold tracking-tight text-gray-900 group-hover:text-primary "><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
														<div class="text-xs mb-2 text-gray-400">
															<?php echo '<span class="text-black font-medium">' . get_the_date('l, F j, Y') . '</span>'; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endwhile; ?>
									</div>


								</section>
							<?php endif; ?>
							<?php wp_reset_query(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
