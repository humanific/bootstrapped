<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
* @bootstrapped http://humanific.be
 */

/**
 * display stylesheet in editor.
 */
function bootstrapped_admin_modifications(){
	add_editor_style( 'bootstrap.css' );
}

add_action('admin_menu', 'bootstrapped_admin_modifications');



function bootstrapped_mce_before_init_insert_formats( $init_array ) {  

	$style_formats = array(  
		array( 'title' => 'well', 'block' => 'div',  'classes' => 'well','wrapper' => true),
		array( 'title' => 'small', 'inline' => 'small'),  
		array( 'title' => 'Big Text', 'inline' => 'span','classes' => 'lead'),  
		
		array( 'title' => 'primary', 'inline' => 'span',  'classes' => 'text-primary'), 
		array( 'title' => 'success', 'inline' => 'span',  'classes' => 'text-success'), 
		array( 'title' => 'warning', 'inline' => 'span',  'classes' => 'text-warning'), 
		array( 'title' => 'danger', 'inline' => 'span',  'classes' => 'text-danger'),

		array( 'title' => 'label primary', 'inline' => 'span',  'classes' => 'label label-primary'), 
		array( 'title' => 'label success', 'inline' => 'span',  'classes' => 'label label-success'), 
		array( 'title' => 'label warning', 'inline' => 'span',  'classes' => 'label label-warning'), 
		array( 'title' => 'label danger', 'inline' => 'span',  'classes' => 'label label-danger'), 

		array( 'title' => 'button primary', 'selector' => 'a',  'classes' => 'btn btn-primary'), 
		array( 'title' => 'button success', 'selector' => 'a',  'classes' => 'btn btn-success'), 
		array( 'title' => 'button warning', 'selector' => 'a',  'classes' => 'btn btn-warning'), 
		array( 'title' => 'button danger', 'selector' => 'a',  'classes' => 'btn btn-danger'),
	);  

	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 

add_filter( 'tiny_mce_before_init', 'bootstrapped_mce_before_init_insert_formats' );  

// Callback function to insert 'styleselect' into the $buttons array
function bootstrapped_mce_styledropdown( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'bootstrapped_mce_styledropdown');





/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function bootstrapped_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'bootstrapped_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function bootstrapped_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'bootstrapped_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function bootstrapped_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'bootstrapped_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function bootstrapped_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'bootstrapped' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bootstrapped_wp_title', 10, 2 );



