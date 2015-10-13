<?php
	
/*
Template Name: Front Page
*/

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'atmosphere_enqueue_atmosphere_script' );
function atmosphere_enqueue_atmosphere_script() {

	wp_enqueue_script( 'bg-front-script', get_bloginfo( 'stylesheet_directory' ) . '/js/front-page.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'bg-front-styles', get_stylesheet_directory_uri() . '/style-front.css' );

}

//* Remove entry header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Run the Genesis function
genesis();
