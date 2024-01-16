<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

?>

<footer id="colophon" >
	<div class="bg-primary py-[90px] text-white px-4">
		<div class="container mx-auto">
			<div class="lg:grid grid-cols-4 gap-[3.25rem]">
			<div class="my-2 lg:my-0">
				<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
			<div class="my-2 lg:my-0">
				<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
			<div class="my-2 lg:my-0">
				<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
			<div class="my-2 lg:my-0">
				<?php dynamic_sidebar( 'footer4' ); ?>
			</div>
			</div>
		</div>
	</div>
	<div class="bg-[#153e92] py-5 text-white">
	  <?php dynamic_sidebar( 'copyright' ); ?>
	</div>
	
</footer>

