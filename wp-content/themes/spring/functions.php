<?php

/**
 * spring functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package spring
 */
// header security

function mad_security_hsts_plugin_get_headers(array $headers = array()): array
{
	$headers['Access-Control-Allow-Methods']             = 'GET,POST';
	$headers['Access-Control-Allow-Headers']             = 'Content-Type, Authorization';
	$headers['Content-Security-Policy']                  = mad_security_hsts_plugin_get_csp_header();
	$headers['Cross-Origin-Embedder-Policy']             = "unsafe-none; report-to='default'";
	$headers['Cross-Origin-Embedder-Policy-Report-Only'] = "unsafe-none; report-to='default'";
	$headers['Cross-Origin-Opener-Policy']               = 'unsafe-none';
	$headers['Cross-Origin-Opener-Policy-Report-Only']   = "unsafe-none; report-to='default'";
	$headers['Cross-Origin-Resource-Policy']             = 'cross-origin';
	$headers['Permissions-Policy']                       = 'accelerometer=(), autoplay=(), camera=(), cross-origin-isolated=(), display-capture=(self), encrypted-media=(), fullscreen=*, geolocation=(self), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), payment=*, picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(), usb=(), xr-spatial-tracking=(), gamepad=(), serial=()';
	$headers['Referrer-Policy']                          = 'strict-origin-when-cross-origin';
	$headers['Strict-Transport-Security']                = mad_security_hsts_plugin_get_hsts_header();
	$headers['X-Content-Security-Policy']                = 'default-src \'self\'; img-src *; media-src * data:;';
	$headers['X-Content-Type-Options']                   = 'nosniff';
	$headers['X-Frame-Options']                          = 'SAMEORIGIN';
	$headers['X-XSS-Protection']                         = '1; mode=block';
	$headers['X-Permitted-Cross-Domain-Policies']        = 'none';

	return $headers;
}
add_filter('wp_headers', 'mad_security_hsts_plugin_get_headers');

function mad_security_hsts_plugin_get_hsts_header(): string
{
	$max_age            = 63072000;
	$include_subdomains = false;
	$preload            = false;

	$header_tokens = array("max-age={$max_age}");
	if ($include_subdomains) {
		$header_tokens[] = 'includeSubDomains';
	}
	if ($preload) {
		$header_tokens[] = 'preload';
	}
	return implode('; ', $header_tokens);
}

function mad_security_hsts_plugin_get_csp_header(): string
{
	$csp = 'upgrade-insecure-requests;';
	return $csp;
}

if (!defined('SPRING_VERSION')) {
	// Replace the version number of the theme on each release.
	define('SPRING_VERSION', '1.0.0');
}

if (!function_exists('spring_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function spring_setup()
	{
		/*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on spring, use a find and replace
		 * to change 'spring' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('spring', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'spring'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'spring_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Add responsive embeds and block editor styles.
		 */
		add_theme_support('responsive-embeds');
		add_theme_support('editor-styles');
		add_editor_style('style-editor.css');
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'spring_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

function spring_content_width()
{
	$GLOBALS['content_width'] = apply_filters('spring_content_width', 640);
}
add_action('after_setup_theme', 'spring_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// Right header

function right_header_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Right Header', 'spring'),
			'id'            => 'right-header',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="right-header">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'right_header_widgets_init');

function spring_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'spring'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'spring_widgets_init');
// program sidebar

function prgogram_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Program', 'spring'),
			'id'            => 'program',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'prgogram_widgets_init');
// job sidebar

function job_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Job', 'spring'),
			'id'            => 'jobs',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'job_widgets_init');
// Footer

function footer1_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer 1', 'spring'),
			'id'            => 'footer1',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'footer1_widgets_init');

function footer2_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer 2', 'spring'),
			'id'            => 'footer2',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'footer2_widgets_init');

function footer3_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer 3', 'spring'),
			'id'            => 'footer3',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'footer3_widgets_init');

function footer4_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer 4', 'spring'),
			'id'            => 'footer4',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'footer4_widgets_init');

function copy_right_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Copy Right', 'spring'),
			'id'            => 'copyright',
			'description'   => esc_html__('Add widgets here.', 'spring'),
			'before_widget' => '<section id="%1$s" class="footer-colum">',
			'after_widget'  => '</section>',
		)
	);
}
add_action('widgets_init', 'copy_right_widgets_init');

/**
 * Enqueue scripts and styles.
 */

function spring_scripts()
{
	wp_enqueue_style('spring-style', get_stylesheet_uri(), array(), SPRING_VERSION);
	wp_enqueue_script('spring-script', get_template_directory_uri() . '/js/script.min.js', array(), SPRING_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'spring_scripts');

/**
 * Add the block editor class to TinyMCE.
 *
 * This allows TinyMCE to use Tailwind Typography styles with no other changes.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */

function spring_tinymce_add_class($settings)
{
	$settings['body_class'] = 'block-editor-block-list__layout';
	return $settings;
}
add_filter('tiny_mce_before_init', 'spring_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Adding classes to navigation li. Also Selecting nav link for current page.

function add_additional_class_on_li($classes, $item, $args)
{
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
// job Breadcrumb

function jobbreadbrumb()
{
	if (get_post_meta(get_the_ID(), 'deadline_date', true)) {
		echo 'Job';
	}
}

function programbrumb()
{
	if (get_post_type(get_the_ID()) == 'programs') {
		echo 'Programs';
	}
}

function termresultbrumb()
{
	if (get_post_type(get_the_ID()) == 'termresults') {
		//if is true
		echo 'Term Result';
	}
}

function eventbrumb()
{
	if (get_post_type(get_the_ID()) == 'events') {
		//if is true
		echo 'Events';
	}
}
// Breadcrumb

function breadcrumb_texonomy()
{
	$post_type = get_post_type(get_the_ID());
	$taxonomies = get_object_taxonomies($post_type);
	$taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array('fields' => 'names'));
	if (($taxonomy_names)) :
		foreach ($taxonomy_names as $tax_name) : ?>
			<span><?php echo $tax_name;
					?> </span>
	<?php endforeach;
	endif;
}

function get_breadcrumb()
{

	echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';
	if (is_category() || is_single() || get_post_type()) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		// breadcrumb_texonomy();
		the_category(' &bull; ');
		jobbreadbrumb();
		termresultbrumb();
		programbrumb();
		eventbrumb();
		if (is_single()) {
			echo ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
			the_title('<a class="truncate inline-block mb-[-6px] w-[200px] md:w-auto ">', '</a>');
		}
	} elseif (is_page()) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		echo the_title('<a class="truncate inline-block mb-[-6px] w-[200px] md:w-full">', '</a>');
	} elseif (is_search()) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ';
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}

/* Hide WP version strings from scripts and styles
    * @return {
        string}
        $src
        * @filter script_loader_src
        * @filter style_loader_src
        */

function fjarrett_remove_wp_version_strings($src)
{
	global $wp_version;
	parse_str(parse_url($src, PHP_URL_QUERY), $query);
	if (!empty($query['ver']) && $query['ver'] === $wp_version) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('script_loader_src', 'fjarrett_remove_wp_version_strings');
add_filter('style_loader_src', 'fjarrett_remove_wp_version_strings');

/* Hide WP version strings from generator meta tag */

function wpmudev_remove_version()
{
	return '';
}
add_filter('the_generator', 'wpmudev_remove_version');
// formar date

function custom_date_format($date)
{
	$date_formated = date_create($date);
	return date_format($date_formated, 'l, F j, Y');
}

// ===  ===  ===  ===  ===  = custom post type for program ===  ===  ===  ===  ===  = T
if (!function_exists('custom_post_for_programs')) {
	function custom_post_for_programs()
	{
		$labels = array(
			'name'                  => _x('Programs', 'Post Type General Name', '_scorch'),
			'singular_name'         => _x('program', 'Post Type Singular Name', '_scorch'),
			'menu_name'             => __('Programs', '_scorch'),
			'name_admin_bar'        => __('programs', '_scorch'),
			'archives'              => __('program Archives', '_scorch'),
			'parent_item_colon'     => __('Parent program:', '_scorch'),
			'all_items'             => __('All Programs', '_scorch'),
			'add_new_item'          => __('Add New program', '_scorch'),
			'add_new'               => __('Add New', '_scorch'),
			'new_item'              => __('New program', '_scorch'),
			'edit_item'             => __('Edit program', '_scorch'),
			'update_item'           => __('Update program', '_scorch'),
			'view_item'             => __('View program', '_scorch'),
			'search_items'          => __('Search program', '_scorch'),
			'not_found'             => __('Not found', '_scorch'),
			'not_found_in_trash'    => __('Not found in Trash', '_scorch'),
			'featured_image'        => __('Featured Image', '_scorch'),
			'set_featured_image'    => __('Set featured image', '_scorch'),
			'remove_featured_image' => __('Remove featured image', '_scorch'),
			'use_featured_image'    => __('Use as featured image', '_scorch'),
			'insert_into_item'      => __('Insert into program', '_scorch'),
			'uploaded_to_this_item' => __('Uploaded to this program', '_scorch'),
			'items_list'            => __('programs list', '_scorch'),
			'items_list_navigation' => __('programs list navigation', '_scorch'),
			'filter_items_list'     => __('Filter programs list', '_scorch'),
		);
		$args = array(
			'label'                 => __('program', '_scorch'),
			'description'           => __('Create a program Listing', '_scorch'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'author', 'thumbnail', 'page-attributes'),
			'taxonomies'            => array('post_tag'),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-welcome-learn-more',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'programs',
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array('slug' => 'programs'),
		);
		register_post_type('programs', $args);
	}
	add_action('init', 'custom_post_for_programs', 0);
}

function programs_taxonomy()
{
	$args = array(
		'labels' => array(
			'name' => 'Program Category',
			'singular_name' => 'progrm category'
		),
		'public' => true,
		'hierarchical' => true,
		'show_admin_column' => true

	);

	register_taxonomy('programs', array('programs'), $args);
}
function terms_result_taxonomy()
{
	$args = array(
		'labels' => array(
			'name' => 'Term Result Categories',
			'singular_name' => 'Term Results Category'
		),
		'public' => true,
		'hierarchical' => true,
		'show_admin_column' => true

	);

	register_taxonomy('termresult_cate', array('termresults'), $args);
}

add_filter('init', 'programs_taxonomy');
add_filter('init', 'terms_result_taxonomy');

add_shortcode('programs_listing', 'srping_program_archive');

function srping_program_archive($attr)
{
	$args = shortcode_atts(array(
		'category' => '',
	), $attr);
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'programs',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'programs',
				'field' => 'slug',
				'terms' => $args['category'],
			)
		)

	);
	$loop = new WP_Query($args);
	?>
	<div class='wrapper-program-archive'>
		<div class='lg:grid grid-cols-3 gap-4 '>
			<?php while ($loop->have_posts()) : $loop->the_post();
			?>

				<div class='bg-white rounded-lg shadow-md'>
					<div class='cart-posts group'>
						<a href='<?php the_permalink() ?>' class='related-thumb '>
							<div class='h-[250px] overflow-hidden rounded-t-lg'><?php the_post_thumbnail('medium', 'w-[100%] transform transition duration-500 scale-110 group-hover:scale-125');
																				?></div>
						</a>
						<div class='p-5'>
							<h5 class='title-like mb-2 text-base font-semibold'><a class='text-[22px] text-primary group-hover:text-blue-700' href='<?php the_permalink() ?>'><?php the_title();
																																												?></a></h5>
							<div class='text-[16px] text-[#434343] excerpt-content'>
								<?php the_excerpt('w-[96px]') ?>
								<a href='<?php the_permalink() ?>' class='inline-block mt-2 px-4 py-2.5 bg-primary text-white font-medium text-xs leading-tight uppercase rounded hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out'>VIEW DETAILS</a>
							</div>
						</div>
					</div>
				</div>

				<!-- pagination -->
			<?php wp_link_pages();
			endwhile;
			?>
		</div>
	</div>
	<?php wp_reset_postdata();
}
// ===  ===  ===  ===  ===  = End custom post type for program ===  ===  ===  ===  ===
// ===  ===  ===  ===  ===  = Term Result ===  ===  ===  ===  ===  ===  =

function termresults_init()
{
	$labels = array(
		'name' => 'Term Results',
		'singular_name' => 'Term Results',
		'add_new' => 'Add New Term Results',
		'add_new_item' => 'Add New Term Results',
		'edit_item' => 'Edit Term Results',
		'new_item' => 'New Term Results',
		'all_items' => 'All Term Results',
		'view_item' => 'View Term Results',
		'search_items' => 'Search Term Results',
		'not_found' =>  'No Term Results Found',
		'not_found_in_trash' => 'No Term Results found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Term Results',
	);

	$args = array(
		'label'                 => __('termresults', '_scorch'),
		'description'           => __('Create a termresults Listing', '_scorch'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'author', 'page-attributes', 'thumbnail'),
		'taxonomies'            => array('post_tag'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'termresults',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' => array('slug' => 'termresults'),
	);
	register_post_type('termresults', $args);
}
add_action('init', 'termresults_init');
//register_post_type( 'termresults', $args );

add_shortcode('term_result_listing', 'srping_term_result_archive');

function srping_term_result_archive($attr)
{
	$args = shortcode_atts(array(
		'category' => '',
	), $attr);
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'termresults',
		'order' => 'ASC',
	);
	$the_query = new WP_Query($args);

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
	} else {
		echo '<div class="text-center my-5">There is no Term Result<div>';
	}
}
// ===  ===  ===  ===  ===  = End Term Result ===  ===  ===  ===  ===
// custom post type for event
if (!function_exists('events')) {
	function event()
	{

		$labels = array(
			'name'                  => _x('events', 'Post Type General Name', '_scorch'),
			'singular_name'         => _x('event', 'Post Type Singular Name', '_scorch'),
			'menu_name'             => __('Events', '_scorch'),
			'name_admin_bar'        => __('events', '_scorch'),
			'archives'              => __('event Archives', '_scorch'),
			'parent_item_colon'     => __('Parent event:', '_scorch'),
			'all_items'             => __('All events', '_scorch'),
			'add_new_item'          => __('Add New event', '_scorch'),
			'add_new'               => __('Add New', '_scorch'),
			'new_item'              => __('New event', '_scorch'),
			'edit_item'             => __('Edit event', '_scorch'),
			'update_item'           => __('Update event', '_scorch'),
			'view_item'             => __('View event', '_scorch'),
			'search_items'          => __('Search event', '_scorch'),
			'not_found'             => __('Not found', '_scorch'),
			'not_found_in_trash'    => __('Not found in Trash', '_scorch'),
			'featured_image'        => __('Featured Image', '_scorch'),
			'set_featured_image'    => __('Set featured image', '_scorch'),
			'remove_featured_image' => __('Remove featured image', '_scorch'),
			'use_featured_image'    => __('Use as featured image', '_scorch'),
			'insert_into_item'      => __('Insert into event', '_scorch'),
			'uploaded_to_this_item' => __('Uploaded to this event', '_scorch'),
			'items_list'            => __('events list', '_scorch'),
			'items_list_navigation' => __('events list navigation', '_scorch'),
			'filter_items_list'     => __('Filter events list', '_scorch'),
		);
		$args = array(
			'label'                 => __('event', '_scorch'),
			'description'           => __('Create a event Listing', '_scorch'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'author', 'thumbnail'),
			// 'taxonomies'            => array( 'category', 'post_tag' ),
			'taxonomies'            => array('post_tag'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-calendar-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'events',
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array('slug' => 'events'),
		);
		register_post_type('events', $args);
	}
	add_action('init', 'event', 0);
}

//register event meta box

function rm_register_meta_box()
{
	add_meta_box('rm-meta-box-id', esc_html__('TIME & DATE', 'text-domain'), 'rm_meta_box_callback', 'events', 'advanced', 'high');
}
add_action('add_meta_boxes', 'rm_register_meta_box');

//Add field

function rm_meta_box_callback($post)
{
	// do_shortcode( '[coming_event][/coming_event]' );
	// do_shortcode( '[past_event][/past_event]' );
	$eventsarting_date = get_post_meta($post->ID, 'eventsarting_date', true);
	$eventending_date = get_post_meta($post->ID, 'eventending_date', true);
	$eventlocation = get_post_meta($post->ID, 'eventlocation', true);
	$outline = '<label for="eventsarting_date" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__('Start', 'text-domain') . '</label>';
	$outline .= '<input type="datetime-local" name="eventsarting_date" id="eventsarting_date" class="eventsarting_date" value="' . esc_attr($eventsarting_date) . '" style="width:100%;" required/>';
	// echo $outline;
	$enddate = '<label for="eventending_date" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__('End', 'text-domain') . '</label>';
	$enddate .= '<input type="datetime-local" name="eventending_date" id="eventending_date" class="eventending_date" value="' . esc_attr($eventending_date) . '" style="width:100%;" required/>';
	// echo $enddate;
	// $eventlocation = '<label for="eventlocation" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__( 'Location', 'text' ) . '</label>';
	$eventlocation = '<input type="text" name="eventlocation" id="eventlocation" class="eventlocation" placeholder="Location" value="' . esc_attr($eventlocation) . '" style="width:100%;" required/>';
	echo '
	  <div style="display:flex; align-items: center;">
	     <div>' .
		$outline .
		'</div>
		  <div style="margin: 26px 16px 1px;">To</div>
		 <div>
		 ' .
		$enddate
		. '</div>
	  </div>
	  <div>
	   <label style="margin: 12px 0px 6px; display: block;" for="eventlocation">Location</label>
	  ' .
		$eventlocation
		. '</div>
	';
}

//save meta box

function meta_box_custom_event_start_date_save($post_id)
{
	if (array_key_exists('eventsarting_date', $_POST)) {
		update_post_meta(
			$post_id,
			'eventsarting_date',
			$_POST['eventsarting_date'],
		);
	}
	if (array_key_exists('eventending_date', $_POST)) {
		update_post_meta(
			$post_id,
			'eventending_date',
			$_POST['eventending_date'],
		);
	}
	if (array_key_exists('eventlocation', $_POST)) {
		update_post_meta(
			$post_id,
			'eventlocation',
			$_POST['eventlocation'],
		);
	}
}
add_action('save_post', 'meta_box_custom_event_start_date_save');

// get custom coming event home listing
add_shortcode('coming_event_listing', 'spring_custom_upcoming_event_listing');

function spring_custom_upcoming_event_listing()
{
	$today = date('Y-m-d:h:i:sa');
	$args = array(
		'post_type' => 'events',
		'post_status' => 'publish',
		'order' => 'ASC',
		'orderby' => 'eventending_date',
		'posts_per_page' => 3,
		'meta_key' => 'eventending_date',
		'meta_query'   => array(
			array(
				'key'     => 'eventending_date',
				'value'   => $today,
				'compare' => '>='
			)
		),
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
		?>
			<?php $date_formated = custom_date_format(get_post_meta(get_the_ID(), 'eventsarting_date', true));
			?>
			<?php $date = date_create(get_post_meta(get_the_ID(), 'eventsarting_date', true));
			?>
			<div class='lg:grid grid-cols-2 gap-[3.25rem] group wraper-event-sortcode mb-5'>
				<div class='col-span-2'>
					<div class='flex'>
						<div class='mr-4 '>
							<div class='bg-white text-secondary px-2 py-4 rounded-md text-center w-[70px]'>
								<div class='text-[12px]'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'D');
									}
									?>
								</div>
								<div class='text-[18px] font-semibold'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'j');
									}
									?>
								</div>
								<div class='text-[12px]'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'Y');
									}
									?>
								</div>
							</div>
						</div>
						<div>
							<h4 class='text-[16px] m-0 text-white font-medium'><a class='no-underline hover:text-secondary' href='<?php echo permalink_link(); ?>'><?php echo the_title() ?></a></h4>
							<div class='text-[14px]'>
								<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-4 h-4 inline-block text-white'>
									<path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
								</svg>
								<small class='text-white'><?php echo $date_formated ?></small>
							</div>
							<div class='text-[12px]'>
								<?php if (get_post_meta(get_the_ID(), 'eventlocation', true)) {
									echo '<div class="flex"><div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-4 h-4 inline-block">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
									</svg></div> <div class="text-white">' . get_post_meta(get_the_ID(), 'eventlocation', true) . '</div></div>';
								}
								?>
							</div>

						</div>
					</div>
					<!-- 					<div class = 'justify-center mt-5 '>
                    <a href = '/upcoming-events' class = 'w-full block px-6 py-2.5 bg-white text-primary hover:text-white font-medium text-center leading-tight rounded shadow-md hover:bg-secondary hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-secondary active:shadow-lg transition duration-150 ease-in-out'>More</a>
                    </div> -->
				</div>
			</div>
		<?php	}
	} else {
		echo '<div class=" p-5 text-center text-[18px] text-white">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="300px" class="inline-block"><g id="freepik--background-complete--inject-1"><rect y="382.4" width="300px" height="0.25" style="fill:#ebebeb"></rect><rect x="363" y="398.49" width="86.9" height="0.25" style="fill:#ebebeb"></rect><rect x="357.66" y="389.21" width="8.69" height="0.25" style="fill:#ebebeb"></rect><rect x="280.12" y="397.5" width="19.19" height="0.25" style="fill:#ebebeb"></rect><rect x="52.46" y="390.89" width="21.6" height="0.25" style="fill:#ebebeb"></rect><rect x="82.96" y="390.89" width="27.93" height="0.25" style="fill:#ebebeb"></rect><rect x="207.67" y="394.99" width="46.84" height="0.25" style="fill:#ebebeb"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill:#ebebeb"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill:#ebebeb"></path><rect x="54.01" y="72.94" width="154.63" height="221.13" style="fill:#e6e6e6"></rect><rect x="56.18" y="72.94" width="157.1" height="221.13" style="fill:#f0f0f0"></rect><rect x="54.01" y="294.07" width="154.63" height="4.05" style="fill:#e6e6e6"></rect><rect x="58.65" y="294.07" width="157.1" height="4.05" style="fill:#f0f0f0"></rect><rect x="30.66" y="111.45" width="208.14" height="144.11" transform="translate(318.24 48.77) rotate(90)" style="fill:#fafafa"></rect><polygon points="129.26 287.57 164.22 79.44 182.22 79.44 147.26 287.57 129.26 287.57" style="fill:#fff"></polygon><polygon points="83.84 287.57 118.8 79.44 136.8 79.44 101.84 287.57 83.84 287.57" style="fill:#fff"></polygon><path d="M65.68,183.1c-.27,0-.49-.33-.49-.74V83.9c0-.41.22-.73.49-.73s.5.32.5.73v98.46C66.18,182.77,66,183.1,65.68,183.1Z" style="fill:#f0f0f0"></path><polygon points="151.13 287.57 186.09 79.44 193.1 79.44 158.14 287.57 151.13 287.57" style="fill:#fff"></polygon><rect x="102.31" y="183.09" width="208.14" height="0.82" transform="translate(389.88 -22.87) rotate(90)" style="fill:#e6e6e6"></rect><polygon points="214.82 98.21 60.19 98.21 59.59 81.96 214.22 81.96 214.82 98.21" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 124.91 60.19 124.91 59.59 108.67 214.22 108.67 214.82 124.91" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 151.62 60.19 151.62 59.59 135.38 214.22 135.38 214.82 151.62" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 178.33 60.19 178.33 59.59 162.08 214.22 162.08 214.82 178.33" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 205.03 60.19 205.03 59.59 188.79 214.22 188.79 214.82 205.03" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 231.74 60.19 231.74 59.59 215.5 214.22 215.5 214.82 231.74" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 111.56 60.19 111.56 59.59 95.31 214.22 95.31 214.82 111.56" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 138.27 60.19 138.27 59.59 122.02 214.22 122.02 214.82 138.27" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 164.97 60.19 164.97 59.59 148.73 214.22 148.73 214.82 164.97" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 191.68 60.19 191.68 59.59 175.44 214.22 175.44 214.82 191.68" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 218.39 60.19 218.39 59.59 202.14 214.22 202.14 214.82 218.39" style="fill:#e0e0e0;opacity:0.5"></polygon><polygon points="214.82 245.1 60.19 245.1 59.59 228.85 214.22 228.85 214.82 245.1" style="fill:#e0e0e0;opacity:0.5"></polygon><rect x="266.25" y="224.55" width="30.82" height="154.45" style="fill:#f0f0f0"></rect><rect x="272.17" y="379" width="151.98" height="3.4" style="fill:#f0f0f0"></rect><rect x="297.07" y="224.55" width="132.99" height="154.45" transform="translate(727.12 603.55) rotate(180)" style="fill:#f5f5f5"></rect><path d="M414.76,311.57H312.35a3.68,3.68,0,0,1-3.67-3.67V284a3.68,3.68,0,0,1,3.67-3.68h16.93a3.71,3.71,0,0,1,3.27,2.07,3.82,3.82,0,0,0,3.37,2h55.29a3.81,3.81,0,0,0,2.69-1.12,4.12,4.12,0,0,0,.72-1,3.63,3.63,0,0,1,3.24-2h16.9a3.68,3.68,0,0,1,3.68,3.68V307.9A3.68,3.68,0,0,1,414.76,311.57ZM312.35,281.33a2.68,2.68,0,0,0-2.67,2.68V307.9a2.68,2.68,0,0,0,2.67,2.67H414.76a2.68,2.68,0,0,0,2.68-2.67V284a2.68,2.68,0,0,0-2.68-2.68h-16.9a2.64,2.64,0,0,0-2.35,1.42,4.83,4.83,0,0,1-.91,1.25,4.78,4.78,0,0,1-3.39,1.41H335.92a4.82,4.82,0,0,1-4.25-2.54,2.74,2.74,0,0,0-2.39-1.54Z" style="fill:#ebebeb"></path><path d="M414.76,353.3H312.35a3.68,3.68,0,0,1-3.67-3.67V325.74a3.68,3.68,0,0,1,3.67-3.68h16.93a3.71,3.71,0,0,1,3.27,2.07,3.82,3.82,0,0,0,3.37,2h55.29a3.73,3.73,0,0,0,2.68-1.12,3.9,3.9,0,0,0,.73-1,3.63,3.63,0,0,1,3.24-2h16.9a3.68,3.68,0,0,1,3.68,3.68v23.89A3.68,3.68,0,0,1,414.76,353.3ZM312.35,323.06a2.68,2.68,0,0,0-2.67,2.68v23.89a2.68,2.68,0,0,0,2.67,2.67H414.76a2.68,2.68,0,0,0,2.68-2.67V325.74a2.68,2.68,0,0,0-2.68-2.68h-16.9a2.64,2.64,0,0,0-2.35,1.42,4.83,4.83,0,0,1-.91,1.25,4.72,4.72,0,0,1-3.39,1.41H335.92a4.82,4.82,0,0,1-4.25-2.54,2.74,2.74,0,0,0-2.39-1.54Z" style="fill:#ebebeb"></path><path d="M418.44,371.88H308.68V363H418.44Zm-108.76-1H417.44V364H309.68Z" style="fill:#ebebeb"></path><path d="M414.76,269.85H312.35a3.68,3.68,0,0,1-3.67-3.67V242.29a3.68,3.68,0,0,1,3.67-3.68h16.93a3.71,3.71,0,0,1,3.27,2.06,3.81,3.81,0,0,0,3.37,2h55.29a3.81,3.81,0,0,0,2.69-1.12,4.12,4.12,0,0,0,.72-1,3.63,3.63,0,0,1,3.24-2h16.9a3.68,3.68,0,0,1,3.68,3.68v23.89A3.68,3.68,0,0,1,414.76,269.85ZM312.35,239.61a2.68,2.68,0,0,0-2.67,2.68v23.89a2.68,2.68,0,0,0,2.67,2.67H414.76a2.68,2.68,0,0,0,2.68-2.67V242.29a2.68,2.68,0,0,0-2.68-2.68h-16.9a2.64,2.64,0,0,0-2.35,1.42,4.83,4.83,0,0,1-.91,1.25,4.76,4.76,0,0,1-3.39,1.41H335.92a4.83,4.83,0,0,1-4.25-2.54,2.74,2.74,0,0,0-2.39-1.54Z" style="fill:#ebebeb"></path><rect x="297.07" y="222.06" width="137.1" height="2.49" style="fill:#f0f0f0"></rect><rect x="261.94" y="222.06" width="35.12" height="2.49" transform="translate(559.01 446.61) rotate(180)" style="fill:#e6e6e6"></rect><rect x="286.69" y="78.27" width="117.63" height="116.75" style="fill:#e6e6e6"></rect><rect x="287.89" y="78.27" width="122.78" height="116.75" style="fill:#f0f0f0"></rect><rect x="296.57" y="80.93" width="105.42" height="111.44" transform="translate(485.93 -212.63) rotate(90)" style="fill:#fff"></rect><path d="M349.28,180.05a43.4,43.4,0,1,1,43.4-43.4A43.45,43.45,0,0,1,349.28,180.05Zm0-86.05a42.65,42.65,0,1,0,42.65,42.65A42.69,42.69,0,0,0,349.28,94Z" style="fill:#f5f5f5"></path></g><g id="freepik--Shadow--inject-1"><ellipse id="freepik--path--inject-1" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill:#f5f5f5"></ellipse></g><g id="freepik--event-calendar--inject-1"><polygon points="67.78 359.58 312.67 359.58 330.27 207.23 85.39 207.23 67.78 359.58" style="fill:#214695"></polygon><polygon points="67.78 359.58 312.67 359.58 330.27 207.23 85.39 207.23 67.78 359.58" style="fill:#fff;opacity:0.4"></polygon><polygon points="360.77 365.29 115.88 365.29 85.39 207.23 330.27 207.23 360.77 365.29" style="fill:#214695"></polygon><polygon points="360.77 365.29 115.88 365.29 85.39 207.23 330.27 207.23 360.77 365.29" style="fill:#fff;opacity:0.6000000000000001"></polygon><polygon points="351.39 356.81 121.98 356.81 97.35 229.1 326.76 229.1 351.39 356.81" style="fill:#fff"></polygon><g style="opacity:0.5"><polygon points="139.84 260.07 115.85 260.07 111.22 236.07 135.21 236.07 139.84 260.07" style="fill:#214695"></polygon><polygon points="320.21 260.07 296.21 260.07 291.59 236.07 315.58 236.07 320.21 260.07" style="fill:#214695"></polygon><polygon points="290.14 260.07 266.15 260.07 261.52 236.07 285.52 236.07 290.14 260.07" style="fill:#214695"></polygon><polygon points="260.08 260.07 236.09 260.07 231.46 236.07 255.46 236.07 260.08 260.07" style="fill:#214695"></polygon><polygon points="230.02 260.07 206.03 260.07 201.4 236.07 225.39 236.07 230.02 260.07" style="fill:#214695"></polygon><polygon points="199.96 260.07 175.97 260.07 171.34 236.07 195.33 236.07 199.96 260.07" style="fill:#214695"></polygon><polygon points="169.9 260.07 145.91 260.07 141.28 236.07 165.27 236.07 169.9 260.07" style="fill:#214695"></polygon><polygon points="145.61 289.99 121.62 289.99 116.99 266 140.98 266 145.61 289.99" style="fill:#214695;opacity:0.5"></polygon><polygon points="325.98 289.99 301.99 289.99 297.36 266 321.35 266 325.98 289.99" style="fill:#214695"></polygon><polygon points="295.92 289.99 271.93 289.99 267.3 266 291.29 266 295.92 289.99" style="fill:#214695;opacity:0.5"></polygon><polygon points="265.86 289.99 241.86 289.99 237.24 266 261.23 266 265.86 289.99" style="fill:#214695"></polygon><polygon points="235.79 289.99 211.8 289.99 207.17 266 231.17 266 235.79 289.99" style="fill:#214695"></polygon><polygon points="205.73 289.99 181.74 289.99 177.11 266 201.1 266 205.73 289.99" style="fill:#214695"></polygon><polygon points="175.67 289.99 151.68 289.99 147.05 266 171.04 266 175.67 289.99" style="fill:#214695"></polygon><polygon points="151.38 319.91 127.39 319.91 122.76 295.92 146.75 295.92 151.38 319.91" style="fill:#214695"></polygon><polygon points="331.75 319.91 307.76 319.91 303.13 295.92 327.12 295.92 331.75 319.91" style="fill:#214695"></polygon><polygon points="301.69 319.91 277.7 319.91 273.07 295.92 297.06 295.92 301.69 319.91" style="fill:#214695"></polygon><polygon points="271.63 319.91 247.64 319.91 243.01 295.92 267 295.92 271.63 319.91" style="fill:#214695"></polygon><polygon points="241.57 319.91 217.57 319.91 212.95 295.92 236.94 295.92 241.57 319.91" style="fill:#214695"></polygon><polygon points="211.5 319.91 187.51 319.91 182.88 295.92 206.88 295.92 211.5 319.91" style="fill:#214695"></polygon><polygon points="181.44 319.91 157.45 319.91 152.82 295.92 176.81 295.92 181.44 319.91" style="fill:#214695"></polygon><polygon points="157.15 349.84 133.16 349.84 128.53 325.84 152.53 325.84 157.15 349.84" style="fill:#214695"></polygon><polygon points="337.52 349.84 313.53 349.84 308.9 325.84 332.89 325.84 337.52 349.84" style="fill:#214695"></polygon><polygon points="307.46 349.84 283.47 349.84 278.84 325.84 302.83 325.84 307.46 349.84" style="fill:#214695"></polygon><polygon points="277.4 349.84 253.41 349.84 248.78 325.84 272.77 325.84 277.4 349.84" style="fill:#214695"></polygon><polygon points="247.34 349.84 223.35 349.84 218.72 325.84 242.71 325.84 247.34 349.84" style="fill:#214695"></polygon><polygon points="217.28 349.84 193.28 349.84 188.66 325.84 212.65 325.84 217.28 349.84" style="fill:#214695"></polygon><polygon points="187.22 349.84 163.22 349.84 158.6 325.84 182.59 325.84 187.22 349.84" style="fill:#214695;opacity:0.5"></polygon></g><path d="M115.59,218.08l-.31-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.45,9.27h-1.58c-1.18-6.09.9-10.85,4.72-10.85s7.74,4.76,8.91,10.85S119.41,218.08,115.59,218.08Z" style="fill:#263238"></path><path d="M139.27,218.08l-.31-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.45,9.27h-1.58c-1.18-6.09.9-10.85,4.72-10.85s7.74,4.76,8.91,10.85S143.09,218.08,139.27,218.08Z" style="fill:#263238"></path><path d="M163,218.08l-.31-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.42,4.25-3.45,9.27H154c-1.18-6.09.9-10.85,4.72-10.85s7.74,4.76,8.91,10.85S166.77,218.08,163,218.08Z" style="fill:#263238"></path><path d="M186.62,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.91-10.85,4.73-10.85s7.73,4.76,8.91,10.85S190.45,218.08,186.62,218.08Z" style="fill:#263238"></path><path d="M210.3,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.91-10.85,4.73-10.85s7.73,4.76,8.91,10.85S214.13,218.08,210.3,218.08Z" style="fill:#263238"></path><path d="M234,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.9-10.85,4.73-10.85s7.73,4.76,8.91,10.85S237.81,218.08,234,218.08Z" style="fill:#263238"></path><path d="M257.66,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.9-10.85,4.73-10.85s7.73,4.76,8.91,10.85S261.49,218.08,257.66,218.08Z" style="fill:#263238"></path><path d="M281.34,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.9-10.85,4.73-10.85s7.73,4.76,8.91,10.85S285.16,218.08,281.34,218.08Z" style="fill:#263238"></path><path d="M305,218.08l-.3-1.59c2.83,0,4.41-4.24,3.44-9.26s-4.18-9.27-7-9.27-4.41,4.25-3.44,9.27h-1.59c-1.17-6.09.9-10.85,4.73-10.85s7.73,4.76,8.9,10.85S308.84,218.08,305,218.08Z" style="fill:#263238"></path><polygon points="202.69 256.69 118.57 256.69 113.94 232.7 198.06 232.7 202.69 256.69" style="fill:#214695"></polygon><polygon points="238.54 286.62 214.54 286.62 209.92 262.62 233.91 262.62 238.54 286.62" style="fill:#214695"></polygon><path d="M313.6,317.34l-1.3-1.13a39.6,39.6,0,0,0-8.83-5.85l.83-2.45a43.18,43.18,0,0,1,8.34,5.29,54.83,54.83,0,0,1,17-16.21l1.79,2.44a52.59,52.59,0,0,0-17.06,16.71Z" style="fill:#214695"></path><polygon points="229.74 266.59 227.57 266.59 223.94 273.16 217.79 266.59 215.62 266.59 223.14 274.62 218.71 282.64 220.89 282.64 224.51 276.08 230.66 282.64 232.84 282.64 225.31 274.62 229.74 266.59" style="fill:#fff"></polygon><path d="M274.21,324.06l4,20.81H257.41l-4-20.81h20.81m1.29-1.59h-24l4.63,24h24l-4.62-24Z" style="fill:#214695"></path><polygon points="214.23 316.54 160.18 316.54 155.55 292.55 209.6 292.55 214.23 316.54" style="fill:#263238"></polygon><path d="M177,302.12a3.69,3.69,0,0,1-3.72,4.61,5.85,5.85,0,0,1-5.5-4.61,3.7,3.7,0,0,1,3.72-4.61A5.86,5.86,0,0,1,177,302.12Z" style="fill:#fff"></path><path d="M178.11,306.48a5.32,5.32,0,0,1-4.48,2.21,8,8,0,0,1-5.32-2.2,4.8,4.8,0,0,0-2.44,5.08h16.64A7.71,7.71,0,0,0,178.11,306.48Z" style="fill:#fff"></path><polygon points="205.22 303.05 186.82 303.05 186.31 300.4 204.71 300.4 205.22 303.05" style="fill:#fff"></polygon><polygon points="200.15 308.68 187.91 308.68 187.4 306.03 199.64 306.03 200.15 308.68" style="fill:#fff"></polygon><path d="M296.76,234.94c4.74,0,11.45.69,16.52,4a8,8,0,0,1,3.71,5c.89,3.93-1.2,8.22-3.51,10.55-3.65,3.68-9.33,6-16,6.46-.76.06-1.54.09-2.31.09a37.52,37.52,0,0,1-13.7-2.72c-4.29-1.71-8.84-4-10.12-8.46a7.32,7.32,0,0,1,.79-6.2,9.43,9.43,0,0,1,2.93-2.86,38.82,38.82,0,0,1,18.36-5.75c1.11-.07,2.23-.11,3.33-.11m-.3-1.54c-1.19,0-2.34,0-3.42.12a40.16,40.16,0,0,0-19,5.94,10.65,10.65,0,0,0-3.29,3.22,8.73,8.73,0,0,0-.91,7.33c1.5,5.18,6.63,7.87,11.29,9.72a39,39,0,0,0,14.33,2.84c.81,0,1.61,0,2.41-.08,6.34-.46,12.66-2.62,16.82-6.82s6.81-13.11-.74-18c-5.09-3.29-11.75-4.27-17.5-4.27Z" style="fill:#263238"></path></g><g id="freepik--Character--inject-1"><polygon points="387.02 409.16 394.18 407.26 390.69 390.42 383.53 392.33 387.02 409.16" style="fill:#b55b52"></polygon><path d="M394.41,405.94l-7.91,2.6a.53.53,0,0,0-.37.65l1.68,6.39a1.31,1.31,0,0,0,1.64.85c2.74-1,4-1.55,7.48-2.69,2.14-.71,7.32-2.3,10.27-3.27s1.92-3.86.58-3.72c-6,.66-9.51.13-12-.77A2.05,2.05,0,0,0,394.41,405.94Z" style="fill:#263238"></path><polygon points="383.53 392.33 390.69 390.42 392.49 399.1 385.32 401.01 383.53 392.33" style="opacity:0.2"></polygon><path d="M365.17,220.72s10,60.35,13,81.4c3.25,23.05,15.42,92.39,15.42,92.39l-12,4.54s-19.15-68.17-24.44-90.58c-5.75-24.33-18.41-87.75-18.41-87.75Z" style="fill:#263238"></path><path d="M349.1,245.47c5.12,12.79,5.7,34.53,3.62,43.44-3.14-14.63-6.74-32.13-9.51-45.74C344.2,239.68,346,237.69,349.1,245.47Z" style="opacity:0.30000000000000004"></path><polygon points="381.05 400.75 394.98 396.57 394.58 390.87 378 395.72 381.05 400.75" style="fill:#263238"></polygon><path d="M397.31,406.35a9.51,9.51,0,0,1-2,.36.19.19,0,0,1-.17-.08.19.19,0,0,1,0-.19c.17-.23,1.72-2.25,2.69-2.2a.66.66,0,0,1,.53.34.94.94,0,0,1,.09,1A2,2,0,0,1,397.31,406.35Zm-1.59,0c1.35-.17,2.26-.51,2.48-.94a.64.64,0,0,0-.07-.63.32.32,0,0,0-.26-.17C397.35,404.56,396.37,405.54,395.72,406.33Z" style="fill:#214695"></path><path d="M395.39,406.7a.11.11,0,0,1-.08,0,.17.17,0,0,1-.13-.1c0-.09-.86-2.06-.38-3a.91.91,0,0,1,.62-.46.66.66,0,0,1,.76.31c.42.71-.15,2.53-.71,3.17C395.44,406.68,395.42,406.7,395.39,406.7Zm0-3.17a.55.55,0,0,0-.3.26,3.84,3.84,0,0,0,.27,2.39,3.45,3.45,0,0,0,.5-2.53c-.05-.09-.14-.19-.39-.14Z" style="fill:#214695"></path><path d="M363.65,158.59c.29.47.69,1.13,1.06,1.7l1.14,1.8c.79,1.19,1.57,2.38,2.4,3.55,1.63,2.33,3.35,4.59,5.13,6.74a60,60,0,0,0,5.62,5.93,30.19,30.19,0,0,0,6,4.36l-1.58-.45a16.29,16.29,0,0,0,4.71.27c.86-.08,1.74-.19,2.64-.35s1.81-.38,2.73-.63a48.13,48.13,0,0,0,5.57-1.89c.93-.38,1.86-.77,2.79-1.19s1.88-.89,2.69-1.27l.27-.13a3.25,3.25,0,0,1,4.33,1.52,3.28,3.28,0,0,1-.59,3.65c-.91.94-1.71,1.69-2.61,2.48s-1.8,1.49-2.75,2.19a43.65,43.65,0,0,1-6.12,3.74,33.54,33.54,0,0,1-7.09,2.61,31.31,31.31,0,0,1-4,.65,25.18,25.18,0,0,1-4.25,0,4.18,4.18,0,0,1-1.17-.29l-.4-.17A38.38,38.38,0,0,1,371,187.8a60.64,60.64,0,0,1-7.33-7,85.18,85.18,0,0,1-6.14-7.64q-1.41-2-2.72-4c-.43-.69-.86-1.37-1.28-2.08s-.8-1.37-1.26-2.23a6.49,6.49,0,0,1,11.29-6.42Z" style="fill:#263238"></path><path d="M369.81,176.88c-3.9-8-10.55-7.54-13.23-5.07l.76,1.11a85.27,85.27,0,0,0,5.86,7.4,66.23,66.23,0,0,0,6.92,6.77c.78.64,1.59,1.27,2.41,1.87A32,32,0,0,0,369.81,176.88Z" style="opacity:0.30000000000000004"></path><path d="M406.77,176l5-4.17,3,6.47s-7.45,5.33-9.16,3.45l-.2-2.41A3.93,3.93,0,0,1,406.77,176Z" style="fill:#b55b52"></path><polygon points="418.44 172.62 420.01 177.62 414.73 178.27 411.75 171.8 418.44 172.62" style="fill:#b55b52"></polygon><polygon points="324.38 408.92 331.79 408.92 332.75 391.75 325.34 391.75 324.38 408.92" style="fill:#b55b52"></polygon><path d="M332.18,408.06h-8.33a.53.53,0,0,0-.55.51l-.41,6.59a1.32,1.32,0,0,0,1.3,1.32c2.9-.05,4.29-.22,7.95-.22,2.25,0,8.46.23,11.57.23s3-3.08,1.71-3.36c-5.92-1.24-9.87-3-12-4.61A2,2,0,0,0,332.18,408.06Z" style="fill:#263238"></path><polygon points="325.34 391.76 332.75 391.76 332.25 400.61 324.84 400.61 325.34 391.76" style="opacity:0.2"></polygon><path d="M350.69,220.72s-.64,64.41-1.84,85.64c-1.32,23.24-13.42,92.11-13.42,92.11H321.85s5.92-67,5.1-90c-.89-25-1.43-87.75-1.43-87.75Z" style="fill:#263238"></path><polygon points="320.76 398.47 337.32 398.47 338.13 393.32 320.06 394.12 320.76 398.47" style="fill:#263238"></polygon><path d="M334.8,409.35a9.5,9.5,0,0,1-2-.26.17.17,0,0,1-.06-.31c.24-.17,2.33-1.6,3.24-1.24a.64.64,0,0,1,.4.48,1,1,0,0,1-.21.94A2,2,0,0,1,334.8,409.35Zm-1.5-.51c1.33.26,2.31.22,2.65-.12a.62.62,0,0,0,.13-.62.3.3,0,0,0-.2-.24C335.4,407.67,334.16,408.29,333.3,408.84Z" style="fill:#214695"></path><path d="M332.87,409.09a.11.11,0,0,1-.08,0,.16.16,0,0,1-.09-.14c0-.09-.18-2.22.57-2.94a.89.89,0,0,1,.73-.24.67.67,0,0,1,.63.52c.17.81-.94,2.36-1.67,2.8A.15.15,0,0,1,332.87,409.09Zm1-3a.53.53,0,0,0-.37.15,3.82,3.82,0,0,0-.49,2.35c.65-.54,1.38-1.72,1.27-2.25,0-.1-.08-.22-.33-.25Z" style="fill:#214695"></path><path d="M362.05,160.49a7.21,7.21,0,0,0-5.47-5,45,45,0,0,0-5.55-.95,147.89,147.89,0,0,0-16.85,0c-2.94.14-5.94.5-8.33.85h-.09a4.73,4.73,0,0,0-4,5.5A232.84,232.84,0,0,1,325.45,191c.58,14.67-.21,26.19.07,29.73h39.65C367.58,184.92,364.47,168.65,362.05,160.49Z" style="fill:#e6e6e6"></path><path d="M335.3,153.88c3.12,12.66,6,44.74,5.95,69.82H324.49c-.3-3.74.54-15.88-.07-31.35a247.72,247.72,0,0,0-3.85-31.69,5,5,0,0,1,4.18-5.8h.09c2.52-.37,5.68-.75,8.78-.9Z" style="fill:#263238"></path><path d="M364.09,160.67a8.39,8.39,0,0,0-6-5.67,74.78,74.78,0,0,0-8-.82c3.17,11,9.39,44.51,7.54,69.52h10.58C370.72,186.17,366.45,167.53,364.09,160.67Z" style="fill:#263238"></path><polygon points="425.89 195.34 347 229.1 337.52 207.06 416.42 173.3 425.89 195.34" style="fill:#214695"></polygon><path d="M359.31,208.15a4.61,4.61,0,1,1-6.06-2.42A4.61,4.61,0,0,1,359.31,208.15Z" style="fill:#fff"></path><path d="M361.3,212.05a6.56,6.56,0,0,1-9,3.86,6,6,0,0,0-1.14,6l15.3-6.54A6,6,0,0,0,361.3,212.05Z" style="fill:#fff"></path><polygon points="414.67 185.48 368.56 205.21 367.52 202.77 413.63 183.04 414.67 185.48" style="fill:#fff"></polygon><polygon points="411.24 193.07 370.79 210.38 369.74 207.94 410.19 190.63 411.24 193.07" style="fill:#fff"></polygon><path d="M329.67,173.5c-.28-8.41-6.49-11.62-8.24-9.36a2.43,2.43,0,0,0-.21.29c1.09,6.48,2.42,15.4,3,24.19C327.17,186.92,329.93,181.49,329.67,173.5Z" style="opacity:0.30000000000000004"></path><path d="M350.23,154.52c-4.9-1.16-5.76-4.19-5.43-7.52a19.92,19.92,0,0,1,.39-2.48l-6.14-5.1-4.51-3.74c1.25,5.43,2.66,15.32-1,18.94,0,0,3,5,11.43,4.56C352,158.79,350.23,154.52,350.23,154.52Z" style="fill:#b55b52"></path><path d="M341.6,163.65a11.89,11.89,0,0,1,2.76-4.44,25.48,25.48,0,0,1-10-6.12l-2.57,1S332.7,160.62,341.6,163.65Z" style="fill:#fff"></path><path d="M348.46,162.53a12.41,12.41,0,0,0-4.1-3.32c2.47-.7,3.43-5.71,3.43-5.71l2.41.5S354.65,160.53,348.46,162.53Z" style="fill:#fff"></path><path d="M345.19,144.52a19.92,19.92,0,0,0-.39,2.48c-2.29-.46-5.35-2.9-5.67-5.24a10.66,10.66,0,0,1-.08-2.34Z" style="opacity:0.2"></path><path d="M348.05,117.85c3.09-.56,6.69,2.68,5,9.26S343.33,118.7,348.05,117.85Z" style="fill:#263238"></path><path d="M332.68,127.87c1.57,7.21,2.12,11.5,6.38,14.79a9.59,9.59,0,0,0,15.51-6.91c.56-6.71-2.09-17.37-9.68-19.41A9.7,9.7,0,0,0,332.68,127.87Z" style="fill:#b55b52"></path><path d="M335.58,135.68c1.06-2.5,2-9.46,1.14-12.35,3.45-.11,10.7-.75,13.72-4.11,4.64-5.16-1.48-11.26-9.18-6.4-5,3.13-15.79,2.51-14,6C322,124.61,327.91,131.15,335.58,135.68Z" style="fill:#263238"></path><path d="M327.25,119.08a.25.25,0,0,1-.19-.09c-.64-.79-.84-1.45-.62-2,.53-1.32,3.28-1.68,6.45-2.08,3-.38,6.32-.81,7.38-2.16a.26.26,0,0,1,.35,0,.24.24,0,0,1,0,.35c-1.19,1.51-4.5,1.93-7.7,2.34-2.77.36-5.63.72-6,1.78-.15.38,0,.89.53,1.52a.25.25,0,0,1,0,.35A.3.3,0,0,1,327.25,119.08Z" style="fill:#263238"></path><path d="M331.57,133.69a6.92,6.92,0,0,0,3.68,2.85c1.93.58,2.59-1.2,1.81-3.08-.71-1.7-2.57-4.05-4.38-3.8S330.48,132,331.57,133.69Z" style="fill:#b55b52"></path><path d="M343,128.59c.09.59.48,1,.87,1s.62-.56.53-1.15-.48-1-.87-1S342.91,128,343,128.59Z" style="fill:#263238"></path><path d="M349.71,127.79c.09.59.48,1,.87,1s.63-.57.53-1.16-.48-1-.86-1S349.62,127.2,349.71,127.79Z" style="fill:#263238"></path><path d="M348.68,128.34a22.46,22.46,0,0,0,3.62,4.72,3.4,3.4,0,0,1-2.76.86Z" style="fill:#a02724"></path><path d="M347.36,135.81a5.12,5.12,0,0,1-3.73-1.54.17.17,0,1,1,.26-.23,5,5,0,0,0,4.12,1.38.17.17,0,0,1,.2.15.17.17,0,0,1-.15.19A5.76,5.76,0,0,1,347.36,135.81Z" style="fill:#263238"></path><path d="M340.81,126.68a.41.41,0,0,1-.17-.05.35.35,0,0,1-.13-.48,3.36,3.36,0,0,1,2.62-1.77.35.35,0,0,1,.37.33.35.35,0,0,1-.33.37,2.66,2.66,0,0,0-2.05,1.42A.35.35,0,0,1,340.81,126.68Z" style="fill:#263238"></path><path d="M352.72,125.15a.34.34,0,0,1-.29-.16,2.94,2.94,0,0,0-2.22-1.34.35.35,0,1,1,0-.7h0a3.64,3.64,0,0,1,2.8,1.65.36.36,0,0,1-.1.49A.35.35,0,0,1,352.72,125.15Z" style="fill:#263238"></path><path d="M330.58,165.75c.05-.06,0,0,0,0l0,0-.07.11-.17.28-.36.63c-.25.45-.49.91-.73,1.39-.46,1-.91,2-1.31,3a43.43,43.43,0,0,0-1.9,6.44,48.2,48.2,0,0,0-.81,13.77,18.45,18.45,0,0,0,.39,2.88,15.61,15.61,0,0,0,.95,2.79,32.81,32.81,0,0,0,3.39,5.82,82.72,82.72,0,0,0,9.76,11l.14.14a3.24,3.24,0,0,1-3.73,5.21,52.56,52.56,0,0,1-7.18-4.43,55,55,0,0,1-6.51-5.52,37.5,37.5,0,0,1-5.6-7.11,24.78,24.78,0,0,1-2.15-4.45,26.82,26.82,0,0,1-1.21-4.83,51.17,51.17,0,0,1-.8-8.77,49.23,49.23,0,0,1,.67-8.89,47.2,47.2,0,0,1,2.33-8.74,41.39,41.39,0,0,1,1.85-4.23c.36-.7.73-1.39,1.15-2.08.21-.35.43-.7.66-1.06l.37-.54.5-.69a6.5,6.5,0,0,1,10.37,7.83Z" style="fill:#263238"></path><path d="M341.84,213.94l4.13-.22-4.79,8s-6.68-.85-6-4.26l.93-1A8.52,8.52,0,0,1,341.84,213.94Z" style="fill:#b55b52"></path><polygon points="350.25 216.59 346.65 225.09 341.18 221.75 345.97 213.72 350.25 216.59" style="fill:#b55b52"></polygon></g></svg>
         <div>There are no upcoming events<div>
	  </div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();
}

// get custom coming event
add_shortcode('coming_event', 'spring_custom_upcoming_event');

function spring_custom_upcoming_event()
{
	$today = date('Y-m-d:h:i:sa');
	$args = array(
		'post_type' => 'events',
		'post_status' => 'publish',
		'order' => 'ASC',
		'orderby' => 'eventending_date',
		'posts_per_page' => 20,
		'meta_key' => 'eventending_date',
		'meta_query'   => array(
			array(
				'key'     => 'eventending_date',
				'value'   => $today,
				'compare' => '>='
			)
		),
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
		?>
			<?php $date_formated = custom_date_format(get_post_meta(get_the_ID(), 'eventsarting_date', true));
			?>
			<?php $date = date_create(get_post_meta(get_the_ID(), 'eventsarting_date', true));
			?>
			<?php $dateending = date_create(get_post_meta(get_the_ID(), 'eventending_date', true));
			?>
			<div class='lg:grid grid-cols-3 p-5 gap-[3.25rem] shadow-sm rounded-md border group wraper-event-sortcode mb-5'>
				<div class='col-span-2'>
					<div class='flex'>
						<div class='mr-4 hidden md:inline-block'>
							<div class='bg-primary text-white p-2 rounded-md text-center w-[90px]'>
								<div class='text-[12px]'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'D');
									}
									?>
								</div>
								<div class='text-[16px] font-semibold'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'j');
									}
									?>
								</div>
								<div class='text-[12px]'>
									<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
										echo date_format($date, 'Y');
									}
									?>
								</div>
							</div>
						</div>
						<div>
							<h4 class='text-[24px] m-0 text-primary font-medium my-2'><a class='no-underline hover:text-secondary' href='<?php echo permalink_link(); ?>'><?php echo the_title() ?></a></h4>
							<div class='event-schedule flex items-center'>
								<div class='event-date mr-2 text-[14px]'>
									<span class='icon-date'>
										<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
											<path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
										</svg>
									</span>
									<span class='date-detail'>
										<?php echo $date_formated ?>
									</span>
								</div>
								<div class='event-hour text-[16px]'>
									<span class='icon-date-hour'>
										<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
											<path stroke-linecap='round' stroke-linejoin='round' d='M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' />
										</svg>
									</span>
									<span class='hour-detail'>
										<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
											echo date_format($date, 'H : i');
										}
										?>
										<?php if (get_post_meta(get_the_ID(), 'eventending_date', true)) {
											echo '- ' . date_format($dateending, 'H : i');
										}
										?>
									</span>
								</div>
							</div>
							<div class='text-[16px]'>
								<span class='icon-location'>
									<?php if (get_post_meta(get_the_ID(), 'eventlocation', true)) {
										echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
									</svg></span><span class="location-details">' . get_post_meta(get_the_ID(), 'eventlocation', true);
									}
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class='px-5 py-4'>
					<div class='relative overflow-hidden bg-no-repeat bg-cover '>
						<a class='no-underline hover:text-secondary' href='<?php echo permalink_link(); ?>'> <?php the_post_thumbnail('large', 'w-[100%] transform transition duration-500 group-hover:opacity-40 rounded-md');
																												?></a>
					</div>
				</div>
			</div>
		<?php	}
	} else {
		echo '<div class="bg-[#f3f3f3] p-5 text-center text-[18px]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
		<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
	  </svg>
	  There are no upcoming events.</div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();
}

// get custom past events
add_shortcode('past_event', 'spring_custom_past_event');

function spring_custom_past_event()
{
	$today = date('Y-m-d:h:i:sa');
	// var_dump( $today );
	$args = array(
		'post_type' => 'events',
		'post_status' => 'publish',
		'order' => 'DESC',
		'orderby' => 'eventending_date',
		'posts_per_page' => 20,
		'meta_key' => 'eventending_date',
		'meta_query'   => array(
			array(
				'key'     => 'eventending_date',
				'value'   => $today,
				'compare' => '<='
			)
		),
	);
	$loop = new WP_Query($args);
	while ($loop->have_posts()) : $loop->the_post();
		?>
		<?php $date_formated = custom_date_format(get_post_meta(get_the_ID(), 'eventsarting_date', true));
		?>
		<?php $date = date_create(get_post_meta(get_the_ID(), 'eventsarting_date', true));
		?>
		<?php $dateending = date_create(get_post_meta(get_the_ID(), 'eventending_date', true));
		?>
		<div class='lg:grid grid-cols-3 p-5 gap-[3.25rem] shadow-sm rounded-md border group wraper-event-sortcode mb-5'>
			<div class='col-span-2'>
				<div class='flex'>
					<div class='mr-4 hidden md:inline-block'>
						<div class='bg-primary text-white p-2 rounded-md text-center w-[90px]'>
							<div class='text-[12px]'>
								<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
									echo date_format($date, 'D');
								}
								?>
							</div>
							<div class='text-[16px] font-semibold'>
								<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
									echo date_format($date, 'j');
								}
								?>
							</div>
							<div class='text-[12px]'>
								<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
									echo date_format($date, 'Y');
								}
								?>
							</div>
						</div>
					</div>
					<div>
						<h4 class='text-[24px] m-0 text-primary font-medium my-2'><a class='no-underline hover:text-secondary' href='<?php echo permalink_link(); ?>'><?php echo the_title() ?></a></h4>
						<div class='event-schedule flex items-center'>
							<div class='event-date mr-2 text-[14px]'>
								<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
									<path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
								</svg>
								<?php echo $date_formated ?>
							</div>
							<div class='event-hour text-[16px]'>
								<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
									<path stroke-linecap='round' stroke-linejoin='round' d='M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' />
								</svg>
								<?php if (get_post_meta(get_the_ID(), 'eventsarting_date', true)) {
									echo date_format($date, 'H : i');
								}
								?>
								<?php if (get_post_meta(get_the_ID(), 'eventending_date', true)) {
									echo '- ' . date_format($dateending, 'H : i');
								}
								?>
							</div>
						</div>
						<div class='text-[16px]'>
							<?php if (get_post_meta(get_the_ID(), 'eventlocation', true)) {
								echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
									</svg>' . get_post_meta(get_the_ID(), 'eventlocation', true);
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class='px-5 py-4'>
				<div class='relative overflow-hidden bg-no-repeat bg-cover '>
					<a class='no-underline hover:text-secondary' href='<?php echo permalink_link(); ?>'> <?php the_post_thumbnail('large', 'w-[100%] transform transition duration-500 group-hover:opacity-40 rounded-md');
																											?></a>
				</div>
			</div>
		</div>
		<!-- pagination -->
		<?php wp_link_pages();
	endwhile;
	wp_reset_postdata();
}

//register job meta box

function rm_register_meta_box_job()
{
	add_meta_box('rm-meta-box-id', esc_html__('Job', 'text-domain'), 'rm_meta_box_callback_job', 'job', 'advanced', 'high');
}
add_action('add_meta_boxes', 'rm_register_meta_box_job');

//Add field

function rm_meta_box_callback_job($post)
{
	$salary_rank = get_post_meta($post->ID, 'salary_rank', true);
	$deadline_date = get_post_meta($post->ID, 'deadline_date', true);
	$joblocation = get_post_meta($post->ID, 'joblocation', true);
	$salary = '<label for="salary_rank" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__('Salary', 'text-domain') . '</label>';
	$salary .= '<input type="text" name="salary_rank" id="salary_rank" class="salary_rank" value="' . esc_attr($salary_rank) . '" style="width:100%;" required/>';
	// echo deadline;
	$deadline = '<label for="deadline_date" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__('Deadline', 'text-domain') . '</label>';
	$deadline .= '<input type="datetime-local" name="deadline_date" id="deadline_date" class="deadline_date" value="' . esc_attr($deadline_date) . '" style="width:100%;" required/>';
	// echo Job Location;
	$location = '<label for="joblocation" style="width:150px; display:inline-block; margin: 0 10px">' . esc_html__('Job Location', 'text') . '</label>';
	$location .= '<input type="text" name="joblocation" id="joblocation" class="joblocation" placeholder="Job Location" value="' . esc_attr($joblocation) . '" style="width:100%;" required/>';
	echo '
	  <div style="display:flex; align-items: center;">
	     <div style="margin-right: 10px">' .
		$salary .
		'</div>
		 <div>
		 ' .
		$deadline
		. '</div>
	  </div>
	  <div>
	  ' .
		$location
		. '</div>
	';
}

// save meta box

function meta_box_custom_job_save($post_id)
{
	if (array_key_exists('salary_rank', $_POST)) {
		update_post_meta(
			$post_id,
			'salary_rank',
			$_POST['salary_rank'],
		);
	}
	if (array_key_exists('deadline_date', $_POST)) {
		update_post_meta(
			$post_id,
			'deadline_date',
			$_POST['deadline_date'],
		);
	}
	if (array_key_exists('joblocation', $_POST)) {
		update_post_meta(
			$post_id,
			'joblocation',
			$_POST['joblocation'],
		);
	}
}
add_action('save_post', 'meta_box_custom_job_save');

// custom post type for job
if (!function_exists('Job')) {
	// Register Custom Post Type

	function Job()
	{

		$labels = array(
			'name'                  => _x('Jobs', 'Post Type General Name', '_scorch'),
			'singular_name'         => _x('Job', 'Post Type Singular Name', '_scorch'),
			'menu_name'             => __('Jobs', '_scorch'),
			'name_admin_bar'        => __('Jobs', '_scorch'),
			'archives'              => __('Job Archives', '_scorch'),
			'parent_item_colon'     => __('Parent Job:', '_scorch'),
			'all_items'             => __('All Jobs', '_scorch'),
			'add_new_item'          => __('Add New Job', '_scorch'),
			'add_new'               => __('Add New', '_scorch'),
			'new_item'              => __('New Job', '_scorch'),
			'edit_item'             => __('Edit Job', '_scorch'),
			'update_item'           => __('Update Job', '_scorch'),
			'view_item'             => __('View Job', '_scorch'),
			'search_items'          => __('Search Job', '_scorch'),
			'not_found'             => __('Not found', '_scorch'),
			'not_found_in_trash'    => __('Not found in Trash', '_scorch'),
			'featured_image'        => __('Featured Image', '_scorch'),
			'set_featured_image'    => __('Set featured image', '_scorch'),
			'remove_featured_image' => __('Remove featured image', '_scorch'),
			'use_featured_image'    => __('Use as featured image', '_scorch'),
			'insert_into_item'      => __('Insert into Job', '_scorch'),
			'uploaded_to_this_item' => __('Uploaded to this Job', '_scorch'),
			'items_list'            => __('Jobs list', '_scorch'),
			'items_list_navigation' => __('Jobs list navigation', '_scorch'),
			'filter_items_list'     => __('Filter jobs list', '_scorch'),
		);
		$args = array(
			'label'                 => __('Job', '_scorch'),
			'description'           => __('Create a Job Listing', '_scorch'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'author', 'thumbnail'),
			// 'taxonomies'            => array( 'category', 'post_tag' ),
			'taxonomies'            => array('post_tag'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-portfolio',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'jobs',
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array('slug' => 'jobs'),
		);
		register_post_type('job', $args);
	}
	add_action('init', 'Job', 0);
}
add_shortcode('jobslist', 'archive_job');

function archive_job()
{
	$today = date('Y-m-d:h:i:sa');
	$args = array(
		'post_type' => 'job',
		'post_status' => 'publish',
		'order' => 'DESC',
		'orderby' => 'deadline_date',
		'posts_per_page' => 20,
		'meta_key' => 'deadline_date',
		'meta_query'   => array(
			array(
				'key'     => 'deadline_date',
				'value'   => $today,
				'compare' => '>'
			)
		),
	);
	$the_query = new WP_Query($args);
	echo '
		<div class="lg:grid grid-cols-4 gap-[3.25rem] bg-primary text-white p-5 rounded-md hidden">
			<div>Vacant Position</div>
			<div>Deadline</div>
			<div>Job Location</div>
			<div></div>
		</div>
	';

	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
		?>
			<div class='lg:grid grid-cols-4 py-8 px-5 gap-[3.25rem] shadow-md font-medium'>
				<div class='text-primary'><a href='<?php echo permalink_link(); ?>'><?php echo the_title();
																					?></a></div>
				<?php $date_formated = custom_date_format(get_post_meta(get_the_ID(), 'deadline_date', true));
				?>
				<div>
					<?php if (get_post_meta(get_the_ID(), 'deadline_date', true)) {
						echo " <span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z' />
						</svg></span>" . $date_formated;
					}
					?>
				</div>
				<div>
					<?php if (get_post_meta(get_the_ID(), 'joblocation', true)) {
						echo "<span class='mr-2 font-bold'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M15 10.5a3 3 0 11-6 0 3 3 0 016 0z' />
							<path stroke-linecap='round' stroke-linejoin='round' d='M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z' />
						    </svg></span>" . get_post_meta(get_the_ID(), 'joblocation', true);
					}
					?>
				</div>
				<a href='<?php echo permalink_link(); ?>'>
					<div class='text-right text-primary'>More Details <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6 inline-block'>
							<path stroke-linecap='round' stroke-linejoin='round' d='M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3' />
						</svg>
					</div>
				</a>
			</div>
	<?php	}
	} else {
		echo '<div class=" p-5 text-center text-[18px] text-primary z-50">
	     <svg xmlns="http://www.w3.org/2000/svg" width="300px" viewBox="0 0 500 500" class="inline-block"><g id="freepik--background-complete--inject-20"><rect y="382.4" width="500" height="0.25" style="fill:#ebebeb"></rect><rect x="416.78" y="398.49" width="33.12" height="0.25" style="fill:#ebebeb"></rect><rect x="333.38" y="398.49" width="70.81" height="0.25" style="fill:#ebebeb"></rect><rect x="275.14" y="389.21" width="19.19" height="0.25" style="fill:#ebebeb"></rect><rect x="52.46" y="390.89" width="34.29" height="0.25" style="fill:#ebebeb"></rect><rect x="95.65" y="390.89" width="62.35" height="0.25" style="fill:#ebebeb"></rect><rect x="188.33" y="395.11" width="36.81" height="0.25" style="fill:#ebebeb"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill:#ebebeb"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill:#ebebeb"></path><rect x="62.05" y="89.87" width="96.69" height="266.7" style="fill:#f5f5f5"></rect><rect x="158.75" y="89.87" width="0.98" height="266.7" transform="translate(318.47 446.45) rotate(180)" style="fill:#ebebeb"></rect><rect x="71.38" y="100.05" width="78.03" height="246.35" style="fill:#fff"></rect><rect x="200.18" y="78.27" width="228.09" height="169.47" transform="translate(628.46 326.01) rotate(180)" style="fill:#e6e6e6"></rect><rect x="196.65" y="78.27" width="228.09" height="169.47" transform="translate(621.4 326.01) rotate(180)" style="fill:#f5f5f5"></rect><rect x="233.08" y="55.29" width="155.24" height="215.42" transform="translate(473.7 -147.69) rotate(90)" style="fill:#fff"></rect><rect x="126.7" y="161.67" width="155.24" height="2.67" transform="translate(367.32 -41.32) rotate(90)" style="fill:#e6e6e6"></rect><rect x="199.27" y="197.9" width="222.85" height="9.56" transform="translate(621.39 405.36) rotate(180)" style="fill:#f5f5f5"></rect><g style="opacity:0.4"><rect x="189.58" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="211.11" y="70.78" width="10.68" height="50.09" transform="translate(432.9 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="221.79" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="243.32" y="70.78" width="10.68" height="50.09" transform="translate(497.32 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="254" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="275.53" y="70.78" width="10.68" height="50.09" transform="translate(561.74 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="286.21" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="307.74" y="70.78" width="10.68" height="50.09" transform="translate(626.16 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="318.42" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="339.95" y="70.78" width="10.68" height="50.09" transform="translate(690.58 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="350.63" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="372.16" y="70.78" width="10.68" height="50.09" transform="translate(755 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="382.84" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect><rect x="404.37" y="70.78" width="10.68" height="50.09" transform="translate(819.42 191.65) rotate(180)" style="fill:#f5f5f5"></rect><rect x="415.05" y="70.78" width="21.53" height="54.47" style="fill:#e6e6e6"></rect></g><rect x="203.72" y="283" width="26.69" height="99.4" transform="translate(434.12 665.4) rotate(180)" style="fill:#e6e6e6"></rect><polygon points="208.16 382.4 203.72 382.4 203.72 373.45 212.82 373.45 208.16 382.4" style="fill:#f0f0f0"></polygon><rect x="395.75" y="283" width="26.69" height="99.4" transform="translate(818.2 665.4) rotate(180)" style="fill:#e6e6e6"></rect><rect x="203.72" y="283" width="195.91" height="95.96" transform="translate(603.35 661.96) rotate(180)" style="fill:#f0f0f0"></rect><rect x="207.16" y="287.25" width="189.02" height="26.32" transform="translate(603.35 600.82) rotate(180)" style="fill:#e6e6e6"></rect><path d="M255,295.43h93.39c4.33,0,8.48-3.25,11.46-9H243.52C246.5,292.18,250.64,295.43,255,295.43Z" style="fill:#f0f0f0"></path><polygon points="395.19 382.4 399.63 382.4 399.63 373.45 390.53 373.45 395.19 382.4" style="fill:#f0f0f0"></polygon><rect x="207.16" y="317.82" width="189.02" height="26.32" transform="translate(603.35 661.96) rotate(180)" style="fill:#e6e6e6"></rect><path d="M255,326h93.39c4.33,0,8.48-3.24,11.46-9H243.52C246.5,322.76,250.64,326,255,326Z" style="fill:#f0f0f0"></path><rect x="207.16" y="348.39" width="189.02" height="26.32" transform="translate(603.35 723.1) rotate(180)" style="fill:#e6e6e6"></rect><path d="M255,356.57h93.39c4.33,0,8.48-3.24,11.46-9H243.52C246.5,353.33,250.64,356.57,255,356.57Z" style="fill:#f0f0f0"></path></g><g id="freepik--Shadow--inject-20"><ellipse id="freepik--path--inject-20" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill:#f5f5f5"></ellipse></g><g id="freepik--character-2--inject-20"><path d="M369.88,410.53h-1.07a.92.92,0,0,1-.85-.87l-6.58-45.82h5l4.36,45.52A1,1,0,0,1,369.88,410.53Z" style="fill:#214695"></path><path d="M369.88,410.53h-1.07a.92.92,0,0,1-.85-.87l-6.58-45.82h5l4.36,45.52A1,1,0,0,1,369.88,410.53Z" style="opacity:0.30000000000000004"></path><path d="M383.6,410.53h-1.07a.92.92,0,0,1-.85-.87l-6.58-45.82h5l4.37,45.52A1,1,0,0,1,383.6,410.53Z" style="fill:#214695"></path><path d="M383.6,410.53h-1.07a.92.92,0,0,1-.85-.87l-6.58-45.82h5l4.37,45.52A1,1,0,0,1,383.6,410.53Z" style="opacity:0.30000000000000004"></path><path d="M307.16,410.53h1.07a.92.92,0,0,0,.85-.87l6.58-45.82h-5l-4.36,45.52A1,1,0,0,0,307.16,410.53Z" style="fill:#214695"></path><path d="M307.16,410.53h1.07a.92.92,0,0,0,.85-.87l6.58-45.82h-5l-4.36,45.52A1,1,0,0,0,307.16,410.53Z" style="opacity:0.30000000000000004"></path><path d="M293.44,410.53h1.07a.92.92,0,0,0,.85-.87l6.58-45.82h-5l-4.36,45.52A1,1,0,0,0,293.44,410.53Z" style="fill:#214695"></path><path d="M293.44,410.53h1.07a.92.92,0,0,0,.85-.87l6.58-45.82h-5l-4.36,45.52A1,1,0,0,0,293.44,410.53Z" style="opacity:0.30000000000000004"></path><path d="M275.66,309.51h33.68c6-20.75,27.48-37.12,49.5-37.12h10.94c23,0,37.92,17.93,33.22,40.06a44.64,44.64,0,0,1-4.29,11.67l-5.31,32.19c-.68,4.16-4,7.53-7.4,7.53H284.62c-3.4,0-6.72-3.37-7.4-7.53L270.74,317C270.05,312.88,272.26,309.51,275.66,309.51Z" style="fill:#214695"></path><path d="M275.66,309.51h33.68c6-20.75,27.48-37.12,49.5-37.12h10.94c23,0,37.92,17.93,33.22,40.06a44.64,44.64,0,0,1-4.29,11.67l-5.31,32.19c-.68,4.16-4,7.53-7.4,7.53H284.62c-3.4,0-6.72-3.37-7.4-7.53L270.74,317C270.05,312.88,272.26,309.51,275.66,309.51Z" style="fill:#fff;opacity:0.5"></path><path d="M267.23,398.68l8.34,3.82a.59.59,0,0,1,.32.76l-2.63,6.79a1.44,1.44,0,0,1-1.9.72c-2.88-1.38-4.19-2.19-7.86-3.87a98.15,98.15,0,0,1-11.22-6.5c-2.72-2-.72-4.7.63-4.1,6.1,2.69,10,2.93,12.83,2.25A2.23,2.23,0,0,1,267.23,398.68Z" style="fill:#263238"></path><path d="M326.38,296.43s-53.33.66-54.16,21.68c-1.18,30.22-5.64,80.39-5.64,80.39l9,4s15.76-50.34,16.32-73.94c15-3.72,53.57,0,58.1-12.26a40.43,40.43,0,0,0,1.71-19.87Z" style="fill:#214695"></path><path d="M326.38,296.43s-53.33.66-54.16,21.68c-1.18,30.22-5.64,80.39-5.64,80.39l9,4s15.76-50.34,16.32-73.94c15-3.72,53.57,0,58.1-12.26a40.43,40.43,0,0,0,1.71-19.87Z" style="opacity:0.2"></path><path d="M337.73,241.12c-.47,1.94-.94,3.69-1.47,5.51s-1.08,3.59-1.66,5.37c-1.17,3.56-2.46,7.1-3.94,10.6A86.64,86.64,0,0,1,325.51,273a50.64,50.64,0,0,1-3.38,5.11,29,29,0,0,1-4.65,4.9l-.15.13-.32.24a7.65,7.65,0,0,1-3.36,1.2,9.35,9.35,0,0,1-2.27,0,13.82,13.82,0,0,1-3.07-.74,32.8,32.8,0,0,1-4.47-2,75.41,75.41,0,0,1-7.43-4.72c-2.32-1.67-4.56-3.4-6.74-5.2s-4.27-3.64-6.34-5.62a3.06,3.06,0,0,1,3.6-4.88l.05,0c2.36,1.31,4.74,2.7,7.13,4s4.75,2.61,7.12,3.83,4.75,2.38,7,3.32a20.47,20.47,0,0,0,3.19,1.06,3.15,3.15,0,0,0,1,.13c.07,0,0,0-.21,0a3.15,3.15,0,0,0-1.42.53l-.48.36a17.6,17.6,0,0,0,2.59-3.19,43.19,43.19,0,0,0,2.41-4.09,95.64,95.64,0,0,0,4.11-9.28c1.23-3.22,2.38-6.52,3.45-9.86s2.07-6.77,3-10l0-.12a6.12,6.12,0,0,1,11.85,3.06Z" style="fill:#263238"></path><path d="M316.11,403h10a.63.63,0,0,1,.66.61l.49,7.91a1.59,1.59,0,0,1-1.56,1.59c-3.48-.06-5.15-.27-9.55-.27-2.7,0-8.16.28-11.9.28s-3.63-3.69-2.05-4c7.11-1.5,9.86-3.57,12.37-5.55A2.58,2.58,0,0,1,316.11,403Z" style="fill:#263238"></path><path d="M340.75,296.43s-48.37,4.08-47.18,25.09c1.3,23,22.54,81.5,22.54,81.5h9.78s-8.37-53.57-11.32-77c13.64,0,45.26,2.56,49.8-9.73a40.35,40.35,0,0,0,1.7-19.87Z" style="fill:#214695"></path><path d="M287.68,262.4a16.27,16.27,0,0,0-2.72-3.34c-2,1.86-3.09,7.27-3.09,7.27l2.73.24S287.74,265.55,287.68,262.4Z" style="fill:#214695"></path><path d="M277.64,257.54l-3.11-1.35a1.82,1.82,0,0,0-2.28.73l-1.48,2.44a1.83,1.83,0,0,0,.25,2.2l4.27,4.45,7.12-.29a2.25,2.25,0,0,0,1.93-1.23l.82-1.61a2.23,2.23,0,0,0-.71-2.89C282.14,258.47,277.64,257.54,277.64,257.54Z" style="fill:#ffc3bd"></path><path d="M325.92,239.07c-1.42,9-3.27,28.43.5,57.73l39.65-.37c-.24-20.31,2.94-39.37,6.05-58a5.54,5.54,0,0,0-4.71-6.41,147.33,147.33,0,0,0-34.23,0A8.53,8.53,0,0,0,325.92,239.07Z" style="fill:#263238"></path><path d="M372.48,235.9c1.17,2.89,2.1,5.66,3.06,8.52s1.78,5.73,2.57,8.64,1.48,5.88,2,8.91a73.06,73.06,0,0,1,1.21,9.37c.06.81.07,1.65.08,2.49v1.28a7.85,7.85,0,0,1-1,3.75,6.87,6.87,0,0,1-1.66,1.94,6.54,6.54,0,0,1-1,.66,6.09,6.09,0,0,1-1,.44,8.3,8.3,0,0,1-2.94.52,13.36,13.36,0,0,1-3.5-.55,31.1,31.1,0,0,1-4.84-1.91c-1.45-.72-2.81-1.47-4.14-2.25a109.51,109.51,0,0,1-14.67-10.49,3.05,3.05,0,0,1,3.27-5.1l.07,0c5.17,2.46,10.43,5,15.55,7.11,1.28.52,2.55,1,3.8,1.43a20.58,20.58,0,0,0,3.41.93c.46.08.87.07.82,0a1.51,1.51,0,0,0-.79.14,4.1,4.1,0,0,0-.46.21,3.36,3.36,0,0,0-.54.36,4.29,4.29,0,0,0-1,1.11,3.69,3.69,0,0,0-.52,1.64l-.05-.91c-.06-.62-.11-1.23-.2-1.87a106.62,106.62,0,0,0-3.74-16c-1.6-5.37-3.44-10.85-5.31-16.06l0-.05a6.12,6.12,0,0,1,11.43-4.36Z" style="fill:#263238"></path><path d="M356.63,211.91l-4.79,4-6.54,5.43a18.9,18.9,0,0,1,.42,2.63c.31,3.16-.38,6.06-4.21,7.53a5,5,0,0,0-3.16,3.09c-.52,1.67.09,3.54,5.35,3.54,7.73,0,11.76-3.44,13.28-5.13a1.37,1.37,0,0,0,.07-1.71C354,226.93,355.38,217.33,356.63,211.91Z" style="fill:#ffc3bd"></path><path d="M343.51,236.41a3,3,0,0,1,.67,1.36,5.49,5.49,0,0,1,1.45-1.36,5.18,5.18,0,0,1,2.77,3.24,14.61,14.61,0,0,1-4.16-1.54,7.11,7.11,0,0,1-2.78.86C341.52,237.24,343.51,236.41,343.51,236.41Z" style="fill:#214695"></path><path d="M345.63,236.41a12.16,12.16,0,0,1,2.65,5.83s12.8-3.2,12.2-11.55a13,13,0,0,0-3.55-1.09S354.18,234.6,345.63,236.41Z" style="fill:#214695"></path><path d="M343.51,236.41a13.46,13.46,0,0,0-2.82,5.83s-6.56-6-.17-11.48a17.1,17.1,0,0,1,3.39-.71S339.66,233.5,343.51,236.41Z" style="fill:#214695"></path><path d="M345.3,221.31a19.28,19.28,0,0,1,.42,2.64c2.44-.49,5.69-3.08,6-5.57a11.48,11.48,0,0,0,.09-2.49Z" style="opacity:0.2"></path><path d="M338.3,194.69c-6,4.27-2.66,14.28,2.48,10.45S343.2,191.21,338.3,194.69Z" style="fill:#263238"></path><path d="M358.61,203.61c-1.67,7.66-2.25,12.22-6.78,15.72a10.2,10.2,0,0,1-16.5-7.34c-.6-7.14,2.23-18.48,10.29-20.65A10.32,10.32,0,0,1,358.61,203.61Z" style="fill:#ffc3bd"></path><path d="M355.06,197.92c-4.25-1.17-15.21,1.62-19.1-2.53-4.17-4.45,1.91-6.62,3.71-5.07-2.27-2.6-1.43-5.38,1.79-5.13,2.35.18,3.09,2.78,3.09,2.78s-.39-4.55,3.65-4.23c3.66.28,3.67,5.22,3.67,5.22s8.74-2.47,11.66,5.87c5.5-.12,5.38,11.46-5.69,15.58C353.35,208.19,353.14,200.29,355.06,197.92Z" style="fill:#263238"></path><path d="M362.35,196.5a1.11,1.11,0,0,1-.2-2.21,1.6,1.6,0,0,0,.65-.81,2.62,2.62,0,0,0,.12-2.08,1.11,1.11,0,1,1,2-.92,4.87,4.87,0,0,1-.24,4.17,3.22,3.22,0,0,1-2.15,1.83A.65.65,0,0,1,362.35,196.5Z" style="fill:#263238"></path><path d="M359.86,210.72a7,7,0,0,1-4.21,2.6c-2.17.39-2.83-1.61-1.87-3.54.86-1.75,3-4.05,5-3.55S361.14,209,359.86,210.72Z" style="fill:#ffc3bd"></path><path d="M345.48,204.31c-.1.63-.51,1.1-.92,1.05s-.67-.6-.58-1.23.51-1.1.93-1S345.57,203.68,345.48,204.31Z" style="fill:#263238"></path><path d="M338.34,203.46c-.1.63-.51,1.1-.92,1s-.67-.6-.58-1.23.51-1.1.93-1.05S338.44,202.83,338.34,203.46Z" style="fill:#263238"></path><path d="M340.52,203.71a20.3,20.3,0,0,1-3,4.49,3.08,3.08,0,0,0,2.55.61Z" style="fill:#ed847e"></path><path d="M343,212.05a5.52,5.52,0,0,0,4-1.64.19.19,0,0,0-.28-.25,5.25,5.25,0,0,1-4.39,1.47.2.2,0,0,0-.21.16.19.19,0,0,0,.17.21A6.27,6.27,0,0,0,343,212.05Z" style="fill:#263238"></path><path d="M348.35,200.68a.35.35,0,0,0,.16-.08.37.37,0,0,0,0-.53,3.57,3.57,0,0,0-3.13-1.24.37.37,0,1,0,.12.74,2.86,2.86,0,0,1,2.46,1A.37.37,0,0,0,348.35,200.68Z" style="fill:#263238"></path><path d="M335.79,200.27a.38.38,0,0,0,.34-.07,3.09,3.09,0,0,1,2.67-.72.38.38,0,0,0,.46-.26.37.37,0,0,0-.26-.46h0a3.83,3.83,0,0,0-3.34.87.37.37,0,0,0-.05.52A.36.36,0,0,0,335.79,200.27Z" style="fill:#263238"></path><path d="M348.81,256.94l-4.38-2.72a2.77,2.77,0,0,0-3.84.92l-.51.86a2.76,2.76,0,0,0,.28,3.25l3,3.47s2.63,6.13,5.68,4.51l2.32-4Z" style="fill:#ffc3bd"></path><path d="M353.32,264.78A18.79,18.79,0,0,0,351,260.7c-2.2,1.88-4,7.88-4,7.88l2.69.58A5,5,0,0,0,353.32,264.78Z" style="fill:#214695"></path><path d="M386.83,309.51H334.91c-3.4,0-5.6,3.37-4.92,7.53l6.48,39.27c.69,4.16,4,7.53,7.41,7.53H380.4Z" style="fill:#214695"></path><path d="M386.83,309.51H334.91c-3.4,0-5.6,3.37-4.92,7.53l6.48,39.27c.69,4.16,4,7.53,7.41,7.53H380.4Z" style="fill:#fff;opacity:0.5"></path></g><g id="freepik--Table--inject-20"><path d="M147.28,413.9h1.5a1,1,0,0,0,1-1L158,289h-6.19l-5.5,123.76A1,1,0,0,0,147.28,413.9Z" style="fill:#214695"></path><path d="M147.28,413.9h1.5a1,1,0,0,0,1-1L158,289h-6.19l-5.5,123.76A1,1,0,0,0,147.28,413.9Z" style="fill:#fff;opacity:0.30000000000000004"></path><path d="M130.28,413.9h1.5a1,1,0,0,0,1-1L141,289h-6.2l-5.49,123.76A1,1,0,0,0,130.28,413.9Z" style="fill:#214695"></path><path d="M130.28,413.9h1.5a1,1,0,0,0,1-1L141,289h-6.2l-5.49,123.76A1,1,0,0,0,130.28,413.9Z" style="fill:#fff;opacity:0.30000000000000004"></path><path d="M339.93,413.9h-1.5a1,1,0,0,1-1-1L329.21,289h6.19l5.5,123.76A1,1,0,0,1,339.93,413.9Z" style="fill:#214695"></path><path d="M339.93,413.9h-1.5a1,1,0,0,1-1-1L329.21,289h6.19l5.5,123.76A1,1,0,0,1,339.93,413.9Z" style="fill:#fff;opacity:0.30000000000000004"></path><path d="M356.93,413.9h-1.5a1,1,0,0,1-1-1L346.21,289h6.2l5.49,123.76A1,1,0,0,1,356.93,413.9Z" style="fill:#214695"></path><path d="M356.93,413.9h-1.5a1,1,0,0,1-1-1L346.21,289h6.2l5.49,123.76A1,1,0,0,1,356.93,413.9Z" style="fill:#fff;opacity:0.30000000000000004"></path><rect x="122.78" y="286.48" width="241.3" height="2.55" style="fill:#214695"></rect></g><g id="freepik--character-1--inject-20"><path d="M118.76,247l-2.28,16.77c-.72,5.58-1.47,11.18-2,16.68-.07.69-.12,1.36-.18,2l-.08,1a2.52,2.52,0,0,0,0-.5,2.16,2.16,0,0,0-.11-.47,2.44,2.44,0,0,0-.15-.35,1.54,1.54,0,0,0-.14-.23c-.18-.23-.2-.2-.15-.15a2,2,0,0,0,.34.29,10.55,10.55,0,0,0,1.32.77,53.55,53.55,0,0,0,7.35,2.73c5.24,1.59,10.75,3,16.19,4.31l-.62,4.77a119.81,119.81,0,0,1-17.34-1.79,50.54,50.54,0,0,1-8.91-2.35,19.25,19.25,0,0,1-2.47-1.16,10.86,10.86,0,0,1-1.4-.95,7.83,7.83,0,0,1-1.59-1.7,6.61,6.61,0,0,1-.76-1.53,7.69,7.69,0,0,1-.24-1,10,10,0,0,1-.06-1l0-1.11c0-.74,0-1.48.06-2.21.24-5.84.77-11.54,1.39-17.24s1.34-11.35,2.23-17Z" style="fill:#7f3e3b"></path><path d="M151.41,295l-3.67,3.35a2.85,2.85,0,0,1-3.15.46l-4.05-1.95s-6-.25-6.87-3.92l1.56-2.85,9.31-1a4.38,4.38,0,0,1,2.74.61l3.84,2.35A1.88,1.88,0,0,1,151.41,295Z" style="fill:#7f3e3b"></path><path d="M129.45,212.56c1,5.76,1.76,16.27-2.36,20,0,0,10,5.26,16.63,14.44,7-5.58,1.15-13.91,1.15-13.91-6.34-1.71-6-6.44-4.79-10.85Z" style="fill:#7f3e3b"></path><path d="M148.24,236.59s-.53-4.88-3.19-7.29c-2.23-2-14-.9-17.67-.49a2.05,2.05,0,0,0-1.6,1.14l-2.68,5.6Z" style="fill:#214695"></path><path d="M148.24,236.59s-.53-4.88-3.19-7.29c-2.23-2-14-.9-17.67-.49a2.05,2.05,0,0,0-1.6,1.14l-2.68,5.6Z" style="fill:#fff;opacity:0.8"></path><path d="M115.73,234c-7.24,2.36-8.8,12.07-8.14,19.62l14.61,9s3.55-11,3.52-16.92C125.69,239.44,120.65,232.42,115.73,234Z" style="fill:#214695"></path><path d="M118.56,260.43a1.4,1.4,0,0,1-1-.39,1.46,1.46,0,0,1-.16-.21.92.92,0,0,1-.13-.24,1.83,1.83,0,0,1-.08-.25,1.15,1.15,0,0,1,0-.26,1.37,1.37,0,0,1,.4-1,1.4,1.4,0,0,1,1.92,0,1.37,1.37,0,0,1,.4,1,1.15,1.15,0,0,1,0,.26,1,1,0,0,1-.08.25.9.9,0,0,1-.12.24l-.17.21A1.36,1.36,0,0,1,118.56,260.43Z" style="fill:#fff"></path><path d="M115.75,259.51h0a1.36,1.36,0,0,1-.87-1.22h0a1.34,1.34,0,0,1-1.47.22h0a1.37,1.37,0,0,1-.79-1.26h0a1.33,1.33,0,0,1-1.48.13h0a1.35,1.35,0,0,1-.71-1.3h0a1.36,1.36,0,0,1-1.49.05h0a1.36,1.36,0,0,1-.46-1.86h0a1.37,1.37,0,0,1,1.87-.46h0a1.4,1.4,0,0,1,.65,1.27h0a1.34,1.34,0,0,1,1.42-.09h0a1.37,1.37,0,0,1,.72,1.23h0a1.35,1.35,0,0,1,1.41-.17h0a1.36,1.36,0,0,1,.79,1.18h0a1.38,1.38,0,0,1,1.4-.25h0a1.36,1.36,0,0,1,.76,1.76h0a1.35,1.35,0,0,1-1.26.86h0A1.47,1.47,0,0,1,115.75,259.51Z" style="fill:#fff"></path><path d="M107.59,255a1.24,1.24,0,0,1-.27,0,1,1,0,0,1-.25-.08.9.9,0,0,1-.24-.12l-.2-.17a1.06,1.06,0,0,1-.17-.2c0-.08-.09-.16-.13-.24a2.41,2.41,0,0,1-.08-.25,2.45,2.45,0,0,1,0-.27,2.11,2.11,0,0,1,0-.26,2.58,2.58,0,0,1,.08-.26,1,1,0,0,1,.13-.23,1.57,1.57,0,0,1,.17-.21l.2-.17a1.34,1.34,0,0,1,.24-.12l.25-.08a1.4,1.4,0,0,1,1.22.37,1.57,1.57,0,0,1,.17.21,1.71,1.71,0,0,1,.13.23,1.25,1.25,0,0,1,.07.26,1.09,1.09,0,0,1,0,.26,1.24,1.24,0,0,1,0,.27,1.17,1.17,0,0,1-.07.25c0,.08-.08.16-.13.24a1.06,1.06,0,0,1-.17.2A1.37,1.37,0,0,1,107.59,255Z" style="fill:#fff"></path><path d="M161.77,248.13c-.61,8.32-2.46,22.32-7,45.9l-39.14-1.16c1-14.45-.53-25.22-4.07-50.51a8.23,8.23,0,0,1,7.31-9.31c2.51-.26,5.37-.47,8.24-.53a125,125,0,0,1,17.78.53c1.9.23,3.87.54,5.75.86A13.42,13.42,0,0,1,161.77,248.13Z" style="fill:#214695"></path><path d="M149.7,202c.09.77.58,1.35,1.08,1.28s.84-.73.75-1.5-.58-1.35-1.08-1.29S149.61,201.2,149.7,202Z" style="fill:#263238"></path><path d="M150.23,200.54l1.79-.76S151.24,201.34,150.23,200.54Z" style="fill:#263238"></path><path d="M150,203.17a20.85,20.85,0,0,0,3.34,4.6,3.33,3.33,0,0,1-2.69.85Z" style="fill:#630f0f"></path><path d="M149.79,195.21a.47.47,0,0,0,0-.46.46.46,0,0,0-.61-.21,4.52,4.52,0,0,0-2.6,3.26.45.45,0,0,0,.39.51.45.45,0,0,0,.51-.39h0a3.64,3.64,0,0,1,2.09-2.56A.38.38,0,0,0,149.79,195.21Z" style="fill:#263238"></path><path d="M123.06,201.8c1.72,9.41,2.25,13.43,7.62,17.73,8.08,6.46,19.27,2.29,20.4-7.45,1-8.77-2-22.69-11.7-25.35A13.06,13.06,0,0,0,123.06,201.8Z" style="fill:#7f3e3b"></path><path d="M143.8,204.44c1.58,5.17,5.36,17.67-3,20.46-6.53,2.18-27,3.92-29.35-8.07-2.43-12.39,8.62-21.22,8.62-21.22s-8.76-7.18-3.15-15c7.23-10.08,24.55-4.38,29.68,2.74C151.61,190.28,143.8,204.44,143.8,204.44Z" style="fill:#263238"></path><path d="M128,226.62A29.25,29.25,0,0,1,117,224.46c-4.64-2-7.35-5.09-7.84-8.94-1.64-13.07,10.52-20.25,10.65-20.32l.48.83c-.12.07-11.73,6.94-10.17,19.37.56,4.41,4.26,6.88,7.27,8.17,5.94,2.56,13.61,2.54,15.47,1.18l.57.78C132.49,226.24,130.45,226.62,128,226.62Z" style="fill:#263238"></path><path d="M116.31,193.74c-.11,1.67-1.49,4,4.3,4.83s13.85.78,15.51-.61,3.28-4.73-.18-4.43S116.5,190.88,116.31,193.74Z" style="fill:#214695"></path><path d="M140.63,205.91a7.55,7.55,0,0,0,4.44,3.63c2.52.74,3.82-1.51,3.15-3.91-.61-2.16-2.66-5.15-5.2-4.84S139.5,203.76,140.63,205.91Z" style="fill:#7f3e3b"></path><polygon points="201.64 403.56 210.92 403.38 206.43 380.22 197.15 380.39 201.64 403.56" style="fill:#7f3e3b"></polygon><path d="M208.6,393.47c2.45,9.25,11.48,19,11.48,19l-12.88-3.28-5.63-8,1-2.12Z" style="fill:#7f3e3b"></path><path d="M199.45,397.77a19.64,19.64,0,0,0,.19,3.24c.55,3.82,2.23,14,2.23,14h.88a90.42,90.42,0,0,1-.71-9.34c.12-2.51,1.74,1.93,3.7,4.45s5.49,4.81,11.2,5c6.68.21,9.35-.07,7.21-1.74s-6.7-2.75-6.7-2.75a20.31,20.31,0,0,1-9-7.55,23.56,23.56,0,0,0-8.29-7.17C199.6,395.94,199.49,397,199.45,397.77Z" style="fill:#263238"></path><polygon points="234.51 372.09 246.35 372.46 233.1 352.76 224.9 359.77 234.51 372.09" style="fill:#7f3e3b"></polygon><path d="M237.32,363.73c8.61,4,22.39,3.22,22.39,3.22l-11.2,9-9.61-.72-1-2.13Z" style="fill:#7f3e3b"></path><path d="M235.5,373.94A19.81,19.81,0,0,0,238,376c3.14,2.19,11.63,7.8,11.63,7.8l.54-.69a90.49,90.49,0,0,1-7.29-5.83c-1.78-1.82,2.49-.05,5.55.13s6.92-1,10.57-5.4c4.29-5.11,5.72-7.4,3.18-6.86s-6.16,3.38-6.16,3.38a18,18,0,0,1-11.11,1.94,20.83,20.83,0,0,0-10.39,1.61C234.25,372.58,234.92,373.36,235.5,373.94Z" style="fill:#263238"></path><path d="M141.1,293.35S204.46,284,211,300.22c11.42,28.26,27.53,60.64,27.53,60.64l-7.78,6.44s-27.63-25.58-37.45-54c-11.74,3.8-49.09,16-62.77,16-14.61,0-20.58-12.45-15.3-33.14a4.16,4.16,0,0,1,4-3.11C128.5,293.14,141.1,293.35,141.1,293.35Z" style="fill:#263238"></path><path d="M147.17,301.6s52-1.56,52.45,16.86c.72,30.47,9.31,74.13,9.31,74.13l-9.49.88S183.93,358.74,179.83,329c-18.52,1.2-35.6.37-49.28.37-15.33,0-16.6-16.83-1.68-36.48C138,292.87,147.17,301.6,147.17,301.6Z" style="fill:#263238"></path><path d="M115.09,290.55,114,294c-.15.27.16.55.62.57l40.28,1.19c.35,0,.65-.15.68-.37l.46-3.49c0-.25-.27-.46-.66-.47l-39.63-1.18A.71.71,0,0,0,115.09,290.55Z" style="fill:#fff"></path><path d="M120.28,295.14l-1.06,0c-.21,0-.37-.12-.35-.25l.63-4.54c0-.13.21-.23.42-.23l1.06,0c.21,0,.37.12.35.25l-.63,4.53C120.68,295.05,120.49,295.15,120.28,295.14Z" style="fill:#263238"></path><path d="M151.89,296.09l-1.06,0c-.21,0-.37-.12-.35-.25l.64-4.54c0-.13.2-.23.41-.23l1.06,0c.22,0,.37.12.36.25l-.64,4.54C152.29,296,152.11,296.09,151.89,296.09Z" style="fill:#263238"></path><path d="M136.09,295.61l-1.06,0c-.22,0-.37-.12-.35-.25l.63-4.54c0-.13.21-.23.42-.23l1.06,0c.21,0,.37.12.35.25l-.63,4.54C136.49,295.52,136.3,295.62,136.09,295.61Z" style="fill:#263238"></path><path d="M184.33,251.61h25.29a1.22,1.22,0,0,1,1.17,1.55l-9.46,32.45a1.2,1.2,0,0,1-1.16.87h-25.3a1.2,1.2,0,0,1-1.16-1.55l9.45-32.45A1.21,1.21,0,0,1,184.33,251.61Z" style="fill:#214695"></path><polygon points="184.79 252.8 209.38 253.38 199.67 283.99 175.08 283.4 184.79 252.8" style="fill:#e0e0e0"></polygon><polygon points="184.02 252.5 208.61 252.6 199.5 283.39 174.91 283.29 184.02 252.5" style="fill:#fff"></polygon><path d="M161.84,253.14c0,1,.15,2.18.23,3.29s.23,2.27.38,3.4q.42,3.39,1.12,6.68a47.81,47.81,0,0,0,1.78,6.3c.37,1,.78,2,1.22,2.88.22.46.46.89.7,1.33l.37.61s-.07,0,0,0a4.44,4.44,0,0,0,1.59.93,19.64,19.64,0,0,0,2.88.87,56.77,56.77,0,0,0,6.69,1c4.62.45,9.45.67,14.17.77l.48,4.79a90.52,90.52,0,0,1-14.91,1.69,54.24,54.24,0,0,1-7.79-.32,27.33,27.33,0,0,1-4.19-.85,12.43,12.43,0,0,1-4.78-2.47,8.68,8.68,0,0,1-1.26-1.35l-.64-.9c-.41-.6-.81-1.2-1.15-1.81a30.74,30.74,0,0,1-1.89-3.7,48.2,48.2,0,0,1-2.58-7.56,65.61,65.61,0,0,1-1.49-7.64c-.17-1.27-.3-2.55-.41-3.84s-.18-2.52-.2-4Z" style="fill:#7f3e3b"></path><path d="M158.55,238.39c6.3,5.93,4.78,21.38,4.78,21.38l-12.06,2.11s-7.45-11.08-4.83-15.72C149.16,241.32,155.15,235.18,158.55,238.39Z" style="fill:#214695"></path><path d="M163.33,261.13a1.39,1.39,0,0,1-1-.4,1.2,1.2,0,0,1-.17-.21,1.67,1.67,0,0,1-.12-.23A2,2,0,0,1,162,260a2.11,2.11,0,0,1,0-.26,1.36,1.36,0,0,1,.39-1,1.73,1.73,0,0,1,.21-.17,1,1,0,0,1,.23-.12,1.29,1.29,0,0,1,.26-.08,1.36,1.36,0,0,1,1.62,1.33,1.09,1.09,0,0,1,0,.26,1.12,1.12,0,0,1-.08.26,1,1,0,0,1-.12.23,1.2,1.2,0,0,1-.17.21A1.37,1.37,0,0,1,163.33,261.13Z" style="fill:#fff"></path><path d="M152.37,261.85a1.36,1.36,0,0,1,1.24-1.47h0a1.34,1.34,0,0,1,1.27.64h0a1.38,1.38,0,0,1,1.09-.92h0a1.38,1.38,0,0,1,1.31.57h0a1.34,1.34,0,0,1,1-1h0a1.35,1.35,0,0,1,1.34.49h0a1.36,1.36,0,0,1,1-1h0a1.35,1.35,0,0,1,1.66,1h0a1.36,1.36,0,0,1-1,1.66h0a1.37,1.37,0,0,1-1.41-.47h0a1.37,1.37,0,0,1-1.06,1.05h0a1.38,1.38,0,0,1-1.38-.56h0a1.35,1.35,0,0,1-1.11,1h0a1.36,1.36,0,0,1-1.35-.63h0a1.37,1.37,0,0,1-1.17.92h-.11A1.37,1.37,0,0,1,152.37,261.85Z" style="fill:#fff"></path><path d="M151.27,263.24a1.24,1.24,0,0,1-.27,0l-.25-.08a1.79,1.79,0,0,1-.24-.12l-.2-.17a.87.87,0,0,1-.17-.21,1.71,1.71,0,0,1-.13-.23,1.25,1.25,0,0,1-.07-.26,1.09,1.09,0,0,1,0-.26,1.24,1.24,0,0,1,0-.27,1.17,1.17,0,0,1,.07-.25c0-.08.08-.16.13-.24a1.06,1.06,0,0,1,.17-.2l.2-.17a1.08,1.08,0,0,1,.24-.12,1,1,0,0,1,.25-.08,1.34,1.34,0,0,1,1.22.37,1.06,1.06,0,0,1,.17.2c.05.08.09.16.13.24a2.41,2.41,0,0,1,.08.25,2.45,2.45,0,0,1,0,.27,2.11,2.11,0,0,1,0,.26,2.58,2.58,0,0,1-.08.26,1.71,1.71,0,0,1-.13.23,1.12,1.12,0,0,1-.17.21A1.37,1.37,0,0,1,151.27,263.24Z" style="fill:#fff"></path><path d="M204.2,276.22l-4.18-.28a4.66,4.66,0,0,0-2.94.79l-7.67,5.15-.06,3.25c2.46,2.86,7.9.3,7.9.3l5.05-.17a2,2,0,0,0,1.83-1.32l1.83-5A2,2,0,0,0,204.2,276.22Z" style="fill:#7f3e3b"></path><path d="M117.59,418.41h1.13a1,1,0,0,0,.9-.92l7-48.44h-5.29l-4.61,48.12A1.05,1.05,0,0,0,117.59,418.41Z" style="fill:#214695"></path><path d="M117.59,418.41h1.13a1,1,0,0,0,.9-.92l7-48.44h-5.29l-4.61,48.12A1.05,1.05,0,0,0,117.59,418.41Z" style="opacity:0.30000000000000004"></path><path d="M103.09,418.41h1.13a1,1,0,0,0,.9-.92l7-48.44h-5.29l-4.61,48.12A1.05,1.05,0,0,0,103.09,418.41Z" style="fill:#214695"></path><path d="M103.09,418.41h1.13a1,1,0,0,0,.9-.92l7-48.44h-5.29l-4.61,48.12A1.05,1.05,0,0,0,103.09,418.41Z" style="opacity:0.30000000000000004"></path><path d="M183.89,418.41h-1.14a1,1,0,0,1-.89-.92l-7-48.44h5.28l4.61,48.12A1.05,1.05,0,0,1,183.89,418.41Z" style="fill:#214695"></path><path d="M183.89,418.41h-1.14a1,1,0,0,1-.89-.92l-7-48.44h5.28l4.61,48.12A1.05,1.05,0,0,1,183.89,418.41Z" style="opacity:0.30000000000000004"></path><path d="M198.39,418.41h-1.14a1,1,0,0,1-.89-.92l-7-48.44h5.28l4.61,48.12A1.05,1.05,0,0,1,198.39,418.41Z" style="fill:#214695"></path><path d="M198.39,418.41h-1.14a1,1,0,0,1-.89-.92l-7-48.44h5.28l4.61,48.12A1.05,1.05,0,0,1,198.39,418.41Z" style="opacity:0.30000000000000004"></path><path d="M217.18,311.63h-35.6c-6.32-21.94-29-39.24-52.32-39.24H117.7c-24.36,0-40.08,19-35.12,42.34a48.18,48.18,0,0,0,4.53,12.34l5.62,34c.72,4.39,4.23,7.95,7.82,7.95H207.71c3.59,0,7.1-3.56,7.82-7.95l6.85-41.52C223.11,315.19,220.78,311.63,217.18,311.63Z" style="fill:#214695"></path><path d="M217.18,311.63h-35.6c-6.32-21.94-29-39.24-52.32-39.24H117.7c-24.36,0-40.08,19-35.12,42.34a48.18,48.18,0,0,0,4.53,12.34l5.62,34c.72,4.39,4.23,7.95,7.82,7.95H207.71c3.59,0,7.1-3.56,7.82-7.95l6.85-41.52C223.11,315.19,220.78,311.63,217.18,311.63Z" style="fill:#fff;opacity:0.5"></path></g><g id="freepik--bubble-speech--inject-20"><rect x="204.37" y="152.15" width="8.17" height="1" style="fill:#214695"></rect><path d="M174.32,163.93h-1V159a6.87,6.87,0,0,1,6.87-6.86h18.23v1H180.19a5.87,5.87,0,0,0-5.87,5.86Z" style="fill:#214695"></path><path d="M180.19,155.65h91.17a3.36,3.36,0,0,1,3.36,3.36v35.75a3.37,3.37,0,0,1-3.37,3.37H180.19a3.37,3.37,0,0,1-3.37-3.37V159A3.36,3.36,0,0,1,180.19,155.65Z" style="fill:#214695"></path><path d="M267.05,179.15H184.5a2.26,2.26,0,0,1-2.26-2.26h0a2.26,2.26,0,0,1,2.26-2.26h82.55a2.26,2.26,0,0,1,2.26,2.26h0A2.26,2.26,0,0,1,267.05,179.15Z" style="fill:#fff"></path><path d="M249.38,188.54H184.5a2.26,2.26,0,0,1-2.26-2.26h0A2.26,2.26,0,0,1,184.5,184h64.88a2.26,2.26,0,0,1,2.26,2.26h0A2.26,2.26,0,0,1,249.38,188.54Z" style="fill:#fff"></path><path d="M212.34,169.76H184.5a2.26,2.26,0,0,1-2.26-2.26h0a2.26,2.26,0,0,1,2.26-2.26h27.84a2.26,2.26,0,0,1,2.26,2.26h0A2.26,2.26,0,0,1,212.34,169.76Z" style="fill:#fff"></path><path d="M249.24,169.76H221.4a2.26,2.26,0,0,1-2.26-2.26h0a2.26,2.26,0,0,1,2.26-2.26h27.84a2.26,2.26,0,0,1,2.26,2.26h0A2.26,2.26,0,0,1,249.24,169.76Z" style="fill:#fff"></path><path d="M182.24,195.42v10.83a2.5,2.5,0,0,0,4,2l16.6-12.84Z" style="fill:#214695"></path><path d="M322.81,102H231.64a3.37,3.37,0,0,0-3.37,3.37v35.75a3.37,3.37,0,0,0,3.37,3.37h72l13.06,10.1a2.5,2.5,0,0,0,4-2v-8.12h2.05a3.37,3.37,0,0,0,3.37-3.37V105.37A3.37,3.37,0,0,0,322.81,102Z" style="fill:#fff"></path><path d="M318.25,155.62a3.06,3.06,0,0,1-1.84-.63l-12.92-10H231.64a3.88,3.88,0,0,1-3.87-3.87V105.37a3.88,3.88,0,0,1,3.87-3.87h91.17a3.88,3.88,0,0,1,3.87,3.87v35.75a3.88,3.88,0,0,1-3.87,3.87h-1.55v7.62a3,3,0,0,1-3,3ZM231.64,102.5a2.88,2.88,0,0,0-2.87,2.87v35.75a2.88,2.88,0,0,0,2.87,2.87h72.2L317,154.19a2,2,0,0,0,3.24-1.58V144h2.55a2.88,2.88,0,0,0,2.87-2.87V105.37a2.88,2.88,0,0,0-2.87-2.87Z" style="fill:#214695"></path><path d="M275.28,125.51H318.5a2.26,2.26,0,0,0,2.26-2.26h0A2.27,2.27,0,0,0,318.5,121H275.28a2.27,2.27,0,0,0-2.26,2.27h0A2.26,2.26,0,0,0,275.28,125.51Z" style="fill:#214695"></path><path d="M245.1,125.51h21.4a2.26,2.26,0,0,0,2.26-2.26h0A2.27,2.27,0,0,0,266.5,121H245.1a2.27,2.27,0,0,0-2.26,2.27h0A2.26,2.26,0,0,0,245.1,125.51Z" style="fill:#214695"></path><rect x="251.36" y="130.37" width="69.41" height="4.52" rx="2.26" transform="translate(572.12 265.27) rotate(180)" style="fill:#214695"></rect><path d="M236,116.12H318.5a2.26,2.26,0,0,0,2.26-2.26h0a2.27,2.27,0,0,0-2.26-2.27H236a2.27,2.27,0,0,0-2.26,2.27h0A2.26,2.26,0,0,0,236,116.12Z" style="fill:#214695"></path></g></svg>
         <div>There are no jobs<div>
	  </div>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();
}
// ===  ===  ===  ===  ===  ===  ===  == Team ===  ===  ===  ===  ===  ===  ===  ===

function rm_register_meta_box_team_members()
{
	add_meta_box('rm-meta-box-id', esc_html__('Member Details', 'text-domain'), 'rm_meta_box_callback2', 'team-members', 'advanced', 'high');
}
add_action('add_meta_boxes', 'rm_register_meta_box_team_members');

//Add field

function rm_meta_box_callback2($post)
{
	$positions_value = get_post_meta($post->ID, 'positions', true);
	$positions = '<label for="positions" style="width:150px; display:inline-block; margin-bottom: 10px;">' . esc_html__('Positions', 'text-domain') . '</label>';
	$positions .= '<input type="text" name="positions" id="positions" class="positions" value="' . esc_attr($positions_value) . '" style="width:100%;" placeholder="Positions" required/>';
	echo '<div>' . $positions . '</div>';
}

//save meta box

function meta_box_custom_team_members_save($post_id)
{
	if (array_key_exists('positions', $_POST)) {
		update_post_meta(
			$post_id,
			'positions',
			$_POST['positions'],
		);
	}
}
add_action('save_post', 'meta_box_custom_team_members_save');
// Register Custom Post Type

function create_team_members()
{

	$labels = array(
		'name'                  => _x('Team Members', 'Post Type General Name', 'cw-custom-post-types'),
		'singular_name'         => _x('Team Member', 'Post Type Singular Name', 'cw-custom-post-types'),
		'menu_name'             => __('Team Members', 'cw-custom-post-types'),
		'name_admin_bar'        => __('Team Members', 'cw-custom-post-types'),
		'archives'              => __('Team Member Archives', 'cw-custom-post-types'),
		'parent_item_colon'     => __('Parent Team Member:', 'cw-custom-post-types'),
		'all_items'             => __('All Team Members', 'cw-custom-post-types'),
		'add_new_item'          => __('Add New Team Member', 'cw-custom-post-types'),
		'add_new'               => __('Add New', 'cw-custom-post-types'),
		'new_item'              => __('New Team Member', 'cw-custom-post-types'),
		'edit_item'             => __('Edit Team Member', 'cw-custom-post-types'),
		'update_item'           => __('Update Team Member', 'cw-custom-post-types'),
		'view_item'             => __('View Team Member', 'cw-custom-post-types'),
		'search_items'          => __('Search Team Member', 'cw-custom-post-types'),
		'not_found'             => __('Not found', 'cw-custom-post-types'),
		'not_found_in_trash'    => __('Not found in Trash', 'cw-custom-post-types'),
		'featured_image'        => __('Featured Image', 'cw-custom-post-types'),
		'set_featured_image'    => __('Set featured image', 'cw-custom-post-types'),
		'remove_featured_image' => __('Remove featured image', 'cw-custom-post-types'),
		'use_featured_image'    => __('Use as featured image', 'cw-custom-post-types'),
		'insert_into_item'      => __('Insert into Team Member', 'cw-custom-post-types'),
		'uploaded_to_this_item' => __('Uploaded to this Team Member', 'cw-custom-post-types'),
		'items_list'            => __('Team Members list', 'cw-custom-post-types'),
		'items_list_navigation' => __('Team Members list navigation', 'cw-custom-post-types'),
		'filter_items_list'     => __('Filter Team Members list', 'cw-custom-post-types'),
	);
	$args = array(
		'label'                 => __('Team Member', 'cw-custom-post-types'),
		'description'           => __('Chalk and Ward Team Members', 'cw-custom-post-types'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'author', 'page-attributes', 'thumbnail'),
		// 'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' => array('slug' => 'team-members'),
	);
	register_post_type('team-members', $args);
}
add_action('init', 'create_team_members', 0);

function team_members_taxonomy()
{
	$args = array(
		'labels' => array(
			'name' => 'Groups',
			'singular_name' => 'Groups'
		),
		'public' => true,
		'hierarchical' => true,
		'show_admin_column' => true

	);

	register_taxonomy('team-members', array('team-members'), $args);
}
add_filter('init', 'team_members_taxonomy');

// ===  ===  ===  ===  ===  = Listing Team Member ===  ===  ===  ===  ===  ===
add_shortcode('team_member_listing', 'team_member_listing_archive');

function team_member_listing_archive($attr)
{
	$args = shortcode_atts(array(
		'groups' => '',
	), $attr);
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'team-members',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'team-members',
				'field' => 'slug',
				'terms' => $args['groups'],
			)
		)

	);
	$loop = new WP_Query($args);
	?>

	<div class='wrapper-team-members-archive my-5'>
		<div class='lg:grid grid-cols-3 gap-4 mx-auto'>
			<?php while ($loop->have_posts()) : $loop->the_post();
			?>
				<div class='bg-[#f6f7f8] rounded-lg p-5 m-5'>
					<?php $post_id = get_the_ID();
					?>
					<div class='group w-full text-center'>
						<div class='h-[180px] w-[180px] overflow-hidden rounded-full inline-block border-4 border-primary cursor-pointer' data-bs-toggle='modal' data-bs-target="#modalViewTeams<?php echo $post_id; ?>">
							<?php the_post_thumbnail('large', 'w-[100px] m-0 inline-block scale-110');
							?>
						</div>
						<div class='p-5 text-center'>
							<h5 class='mb-2 text-base font-semibold text-primary text-[18px]'><?php the_title();
																								?></h5>
							<div style='width:30%; height: 3px;' class='bg-primary mx-auto rounded-md'></div>
							<p class='my-2'>
								<?php if (get_post_meta(get_the_ID(), 'positions', true)) {
									echo get_post_meta(get_the_ID(), 'positions', true);
								}
								?>
							</p>
							<p class='text-[18px] my-0 group-hover:text-primary cursor-pointer' data-bs-toggle='modal' data-bs-target="#modalViewTeams<?php echo $post_id; ?>">View biography</p>
						</div>
					</div>
				</div>
				<!-- Model -->
				<div class='modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto' id="modalViewTeams<?php echo  $post_id; ?>" tabindex='-1' aria-labelledby='modalViewTeamsLabel' aria-modal='true' role='dialog'>
					<div class='modal-dialog modal-xl modal-dialog-centered relative w-auto pointer-events-none'>
						<div class='modal-content border-none relative flex flex-col w-full pointer-events-auto bg-clip-padding rounded-md outline-none text-current '>
							<div class='modal-header flex flex-shrink-0 items-center justify-between p-2 rounded-t-md absolute top-2 z-50 right-2'>
								<button type='button' class='btn-close box-content w-4 h-4 p-1 text-primary border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline' data-bs-dismiss='modal' aria-label='Close'></button>
							</div>
							<div class='modal-body relative p-5 bg-white rounded-md search-model '>
								<div class='lg:flex gap-5'>
									<div class='lg:w-[30%] w-full text-center my-5'>
										<div class='h-[180px] w-[180px] overflow-hidden rounded-full inline-block border-4 border-primary cursor-pointer'>
											<?php the_post_thumbnail('large', 'w-[100px] m-0 inline-block scale-110');
											?>
										</div>
										<div class='py-5 text-center'>
											<h5 class='mb-2 text-base font-semibold text-primary'><?php the_title();
																									?></h5>
											<div style='width:30%; height: 3px;' class='bg-primary mx-auto rounded-md'></div>
											<p class='mt-2 mb-0'>
												<?php if (get_post_meta(get_the_ID(), 'positions', true)) {
													echo get_post_meta(get_the_ID(), 'positions', true);
												}
												?>
											</p>
										</div>
									</div>
									<div class='entry-content lg:w-[70%] w-full'>
										<?php
										$contentshow = apply_filters('the_content', get_the_content());
										echo $contentshow;
										?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- pagination -->
			<?php wp_link_pages();
			endwhile;
			?>

		</div>
	</div>
<?php wp_reset_postdata();
}
