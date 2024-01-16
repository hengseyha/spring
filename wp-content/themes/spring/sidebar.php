<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spring
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="container mx-auto my-5">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->