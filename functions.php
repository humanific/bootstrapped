<?php
/**
 *
 */


add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
register_nav_menu( 'primary', 'Primary Menu' );

function bootstrapped_admin_modifications(){
	add_editor_style( 'bootstrap.css' );
}

add_action('admin_menu', 'bootstrapped_admin_modifications');

function bootstrapped_deregister_styles() {
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/bootstrap.css');
}

function bootstrapped_enqueue_script(){
	wp_enqueue_script( 'bootstrapped_jquery', get_stylesheet_directory_uri().'/js/jquery.js' , false );
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js' , false );
}


add_action( 'wp_enqueue_scripts', 'bootstrapped_enqueue_script' );
add_action( 'wp_print_styles', 'bootstrapped_deregister_styles', 100 );


add_filter( 'wp_title', 'filter_wp_title' );

function filter_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}

function bootstrapped_register_sidebars (){
	register_sidebar(array(
	    'name' => 'Sidebar Widgets',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));
	
	register_sidebar(array(
	    'name' => 'Footer Widgets',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

	register_sidebar(array(
	    'name' => 'logo',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

}

require 'inc/general/class-bootstrapped_Walker_Nav_Menu.php';

add_action( 'init', 'bootstrapped_register_sidebars' );

include "utils/shortcodes.php";
include "utils/ajax_login.php";



