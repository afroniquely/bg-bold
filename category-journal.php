<?php

//* Add post classes
add_filter( 'post_class', 'bg_even_odd_post_class' );
function bg_even_odd_post_class( $classes ) {

	global $wp_query;

	$current_page = is_paged() ? get_query_var('paged') : 1;

	$post_counter = $wp_query->current_post;

		if ( 0 == $post_counter && 1 == $current_page ) {
			$classes[] = 'first-featured';
		}

		if ( ( $post_counter & 1 ) && 1 == $current_page ) {
			$classes[] = 'row';
		} elseif ( ( $post_counter % 2 == 0 ) && 1 !== $current_page ) {
			$classes[] = 'row';
		}

		if ( ( $wp_query->current_post + 1 ) == $wp_query->post_count ) {
			$classes[] = 'last';
		}

	return $classes;

}

//* Add first-page body class
add_filter( 'body_class', 'no_sidebar_body_class' );
function no_sidebar_body_class( $classes ) {

	$current_page = is_paged() ? get_query_var('paged') : 1;

	if ( 1 == $current_page ) {
		$classes[] = 'first-page';
	}

	$classes[] = 'front-page';

	return $classes;

}

//* Add featured image above the entry content
add_action( 'genesis_entry_header', 'bg_featured_image', 4 );
function bg_featured_image() {

	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => 'bg-featured', ) ) ) {

		printf( '<a class="bg-featured-image" href="' . get_permalink() . '" style="background-image: url(%s)"></a>', $image );

	}

}

//* Remove entry content elements
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Run the Genesis loop
genesis();
