<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

get_header(); 
$termID = get_queried_object()->term_id;
$args = array(
    'post_status' => 'publish',
    'post_type' => 'termresults',
    'order' => 'ASC',
    'tax_query' => array(
        array(
        'taxonomy' => 'termresult_cate',
        'field' => 'term_id',
        'terms' => $termID
         )
      )
);
$the_query = new WP_Query($args);
?>
<div class="relative">
    <div class="lg:h-[250px] overflow-hidden ">
        <?php if (function_exists('z_taxonomy_image')) z_taxonomy_image(); ?>
    </div>
    <div class=" absolute top-[50px] md:top-[90px] w-full ">
        <h1 class="text-center text-[34px] font-semibold text-white"><?php echo single_term_title() ?></h1>
        <div class="border-t-4 border-white white-popup w-14 mx-auto rounded-sm"></div>
    </div>
</div>
<main id="primary" class="container wrapper-content mx-auto px-4 lg:px-0 my-5 lg:mt-10">

    <div class="lg:grid grid-cols-3 gap-4 mt-5">
   <?php

	if ($the_query->have_posts()) {
		echo '<div class="wrapper-term-result-archive my-4">';
		while ($the_query->have_posts()) {
			$the_query->the_post();
	?>

			<div class='  my-4'>
				<a href='<?php the_permalink() ?>' class='related-thumb no-underline'>
					<div class='cart-posts group bg-primary rounded-lg shadow-md'>
						<div class=' overflow-hidden rounded-t-lg'>
							<?php
							the_post_thumbnail('medium', 'w-full transform transition duration-500 scale-110 group-hover:scale-125');
							?>
						</div>

						<div class='p-5'>
							<h5 class='title-like text-white font-semibold'>

								<?php the_title();
								?>
							</h5>
						</div>
					</div>
				</a>
			</div>

		<?php
		}
		echo '</div>';
    }else{
        echo '<div class="text-center my-5">There is no Term Result<div>';
    }
        ?>
    </div>
</main>
<?php
get_footer();