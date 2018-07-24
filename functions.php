<?php

add_theme_support( 'post-thumbnails' ); 

include 'core/archive_type_loader.php';
include 'core/single_page_loader.php';
include 'core/helpers.php';
include 'core/filters.php';
include 'core/shortcodes.php';
include 'core/endpoints.php';
include 'core/widgets.php';
include 'core/nav-walker.php';

// Theme specific functionality
include 'core/theme/theme-filters.php';

// admin pages
include 'core/settings.php';
new BRG_Theme_Settings_Admin_Interface_Controller();

// Post types
include 'core/post-types/notices.php';
include 'core/post-types/events.php';

function load_theme_info() {
	// Header 		- baloo thambi
	// Body 		- ubuntu
	// code snippet	- orbitron
	$font_names = array (
		'Baloo+Thambi', 'Ubuntu', 'Orbitron'
	);

	foreach( $font_names as $file ): ?>
	    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=<?php echo $file; ?>" />
	<?php endforeach;
}

add_action( 'wp_enqueue_scripts', function() {
	// Styles first 
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/main.css' );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/assets/theme-styles.css' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'main_script', get_template_directory_uri() . '/js/scripts.js', array(), '1.3', true );

	// Search Shortcode Script
	wp_enqueue_script( 'ajax_search', get_template_directory_uri() . '/js/search.js', array(), '1.0', true );

	// Vendors
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/vendors/slick/slick.js', true );
});

add_action( 'init', function() {
	add_theme_support( 'post-formats', array( 
		'gallery',
		'link',
		'video',
		'quote',
	) );
} );

add_filter( 'pre_get_posts', function( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'bgpt_project' ) );
	}
	return $query;
} );


add_action( 'rest_api_init', function() {
	register_rest_route( 'search', 'get-posts/(?P<on>[0-9-]+)', array(
		'methods'	=> 'GET',
		'callback'	=> 'get_more_search_posts',
	) );
} );

function get_more_search_posts( $data ) {
	$loader = new BG_Post_Archive_Delegator(
		'search',
		$data['on']
	);	
	ob_start();
	$loader->get_next_posts();
	return ob_get_clean();	
}