<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring
 */

?>
<div>
	<div class="container top-header mx-auto px-2.5 md:px-3 hidden lg:block">
		<nav class="bg-white border-gray-200 hidden md:block">
			<div class="md:flex flex-wrap justify-between items-center py-2.5 ">
				<div class="logo-mobile text-center">
					<?php
						the_custom_logo();
						if (is_front_page()) :
						?>
						<?php
						else :
						?>
							<p class="hidden"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						endif;
						$spring_description = get_bloginfo('description', 'display');
						if ($spring_description || is_customize_preview()) :
					?>
					<?php endif; ?>
				</div>
				<div class="items-center flex space-x-4">
					<?php dynamic_sidebar('right-header'); ?>
					<button>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary cursor-pointer font-bold" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
						</svg>
					</button>
				</div>
			</div>
		</nav>
	</div>
</div>

<div class="bg-white lg:bg-primary px-2 md:py-2 lg:py-2 sticky top-0 z-50 shadow-sm">
	<div class="container mx-auto">
		<div class="justify-between items-center w-full md:w-auto md:order-1">
			<div class="hidden lg:flex">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'add_li_class'   => 'group',  // this will add class to li check function below add_additional_class_on_li()
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'wrap-primary-menu',
						)
					);
				?>
			</div>
			<div class="flex flex-wrap justify-between items-center lg:hidden ">
				<div>
					<button class="lg:hidden p-1 bg-primary hover:bg-secondary rounded-md inline-block align-middle" data-bs-toggle="offcanvas" href="#offcanvasPhonenav" role="button" aria-controls="offcanvasPhonenav">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
						</svg>
					</button>
				</div>
				<div class="wrapper-mobile-responsive ">
		        	<?php
						the_custom_logo();
						if (is_front_page()) :
						?>
						<?php
						else :
						?>
							<p class="hidden"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						endif;
						$spring_description = get_bloginfo('description', 'display');
						if ($spring_description || is_customize_preview()) :
					?>
				
					<?php endif; ?>
			    </div>
		   
		     <div class="navbar-mobile wrapper-mobile-responsive flex">
			    <div><?php dynamic_sidebar('right-header'); ?></div>
			    <button>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary cursor-pointer font-bold" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
						<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
					</svg>
				</button>
			 </div>
		   </div>
		   <div>
			</div>
		</div>
	</div>
</div>

<!-- Modal search -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="Modalsearch" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-lg modal-dialog-centered relative w-auto pointer-events-none">
		<div class="modal-content border-none relative flex flex-col w-full pointer-events-auto bg-clip-padding rounded-md outline-none text-current">
			<div class="modal-header flex flex-shrink-0 items-center justify-between p-4 rounded-t-md">
			</div>
			<div class="modal-body relative p-4 bg-white rounded-md search-model">
				<?php get_search_form(); ?>
			</div>

		</div>
	</div>
</div>

<header id="masthead">
	<!-- End -->
	<div class="offcanvas offcanvas-start fixed bottom-0 flex flex-col max-w-full bg-primary text-white invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out top-0 left-0 border-none w-96" tabindex="-1" id="offcanvasPhonenav" aria-labelledby="offcanvasPhonenavLabel">
		<div class="offcanvas-header flex items-center justify-between p-4 bg-white">
			<div class="offcanvas-title " id="offcanvasPhonenavLabel">
				    <div class="wrapper-mobile-responsive ">
						<?php
							the_custom_logo();
							if (is_front_page()) :
							?>
								<!-- <h1><?php bloginfo('name'); ?></h1> -->
							<?php
							else :
							?>
								<p class="hidden"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
							<?php
							endif;
							$spring_description = get_bloginfo('description', 'display');
							if ($spring_description || is_customize_preview()) :?>
							<p class="hidden">
								<?php echo $spring_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</p>
						<?php endif; ?>
					</div>
		    </div>
			<button type="button" class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-primary border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body flex-grow p-4 overflow-y-auto wrapper-mobile-responsive ">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu group',
						'menu_class'     => '',
					)
				);
			?>
		</div>
	</div>

	<!-- #site-navigation -->
</header><!-- #masthead -->
