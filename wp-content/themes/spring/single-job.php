<?php

/**
 * The template for displaying all job
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
					the_title("<h1 class='text-[24px] font-medium text-primary pb-4'>", "</h1>");
					get_template_part('template-parts/content/content', get_post_type());

				endwhile; // End of the loop.
			?>
		</div>
		<div class="lg:w-[30%] w-full">
			<div class="sticky top-[4.5rem]">
				<div class="bg-white list-opening-hours w-full rounded-lg border border-gray-200 text-[#434343] py-5 mt-5">
					<ul class="bg-white rounded-lg text-gray-900">
						<?php if (get_post_meta($post->ID, 'deadline_date', true)) {
							echo " <li><span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
						  </svg> End Date: </span>" . custom_date_format(get_post_meta($post->ID, 'deadline_date', true)) . "</li>";
						} ?>
						<?php if (get_post_meta($post->ID, 'joblocation', true)) {
							echo " <li><span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M15 10.5a3 3 0 11-6 0 3 3 0 016 0z' />
							<path stroke-linecap='round' stroke-linejoin='round' d='M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z' />
						    </svg> Job Location: </span>" . get_post_meta($post->ID, 'joblocation', true) . "</li>";
						} ?>
						<?php if (get_post_meta($post->ID, 'salary_rank', true)) {
							echo " <li><span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z' />
						  </svg> Salary: </span>" . get_post_meta($post->ID, 'salary_rank', true) . "</li>";
						} ?>

					</ul>
				</div>

				<?php dynamic_sidebar('job'); ?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
