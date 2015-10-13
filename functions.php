<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Load the Embed GitHub Gist plugin
include_once( get_stylesheet_directory() . '/lib/embed-github-gist.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'BG Bold' );
define( 'CHILD_THEME_VERSION', '1.0.1' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'bg_enqueue_scripts_styles' );
function bg_enqueue_scripts_styles() {

	wp_enqueue_script( 'bg-global', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'bg-retina', get_bloginfo( 'stylesheet_directory' ) . '/js/retina.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'bg-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

	if ( is_single( '2140' ) ) {
		wp_enqueue_style( 'bg-google-fonts', '//fonts.googleapis.com/css?family=Lato:700|Merriweather:300|Montserrat:700|Neuton:300|Oswald:700|Quattrocento:400|Playfair+Display:700|Open+Sans:400|Roboto+Slab:700|Roboto:300', array(), CHILD_THEME_VERSION );
		wp_enqueue_style( 'bg-google-fonts-styles', get_stylesheet_directory_uri() . '/css/google-fonts.css' );

	}

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Remove the sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Customize search form input box text
add_filter( 'genesis_search_text', 'bg_search_input_text' );
function bg_search_input_text( $text ) {

	return esc_attr( 'Search Site' );

}

//* Remove pages from search results
add_filter( 'pre_get_posts', 'bg_search_exclude' );
function bg_search_exclude($query) {

	if ($query->is_search) {
		$query->set('post_type', 'post');
	}

	return $query;

}

//* Reposition the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 7 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'bg_entry_meta_header' );
function bg_entry_meta_header($post_info) {
 
	$post_info = '[post_date format="d M Y"] [post_edit]';
	return $post_info;
 
}

//* Customize the more tag
add_filter( 'the_content_more_link', 'bg_custom_more_tag' );
function bg_custom_more_tag() {

	return '<a class="more-link" href="' . get_permalink() . '">Continue Reading</a>';

}

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Hook the split widget areas before footer
add_action( 'genesis_before_footer', 'bg_split' );
function bg_split() {

	echo '<div class="split">';

	genesis_widget_area( 'split-left', array(
		'before' => '<div class="split-left">',
		'after'  => '</div>',
	) );

	genesis_widget_area( 'split-right', array(
		'before' => '<div class="split-right">',
		'after'  => '</div>',
	) );

	echo '</div>';

}

//* Remove the site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Customize the site footer
add_action( 'genesis_footer', 'bg_site_footer' );
function bg_site_footer() {

	genesis_widget_area( 'site-footer', array(
		'before' => '<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter"><div class="wrap">',
		'after'  => '</div></footer>',
	) );

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'newsletter-signup',
	'name'        => __( 'Newsletter Signup', 'bg' ),
	'description' => __( 'This is the newsletter signup widget area.', 'bg' ),
) );
genesis_register_sidebar( array(
	'id'          => 'split-left',
	'name'        => __( 'Split Left', 'bg' ),
	'description' => __( 'This is the split left widget area.', 'bg' ),
) );
genesis_register_sidebar( array(
	'id'          => 'split-right',
	'name'        => __( 'Split Right', 'bg' ),
	'description' => __( 'This is the split right widget area.', 'bg' ),
) );
genesis_register_sidebar( array(
	'id'          => 'site-footer',
	'name'        => __( 'Site Footer', 'bg' ),
	'description' => __( 'This is the site footer widget area.', 'bg' ),
) );