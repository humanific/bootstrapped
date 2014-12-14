<?php
/**
 *
 */


function deregister_styles() {
    wp_deregister_style( 'bootstrapped-css' );
	wp_enqueue_style( 'bootstrapped-css', get_stylesheet_directory_uri().'/bootstrap.css', array(), '20130908');
}

add_action( 'wp_print_styles', 'deregister_styles', 100 );
add_theme_support( 'post-thumbnails' );
register_nav_menu( 'primary', 'Primary Menu' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );

add_image_size( 'square', 500, 500, true );


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
}

require 'inc/general/class-bootstrapped_Walker_Nav_Menu.php';

add_action( 'init', 'bootstrapped_register_sidebars' );

include "utils/shortcodes.php";
include "utils/ajax_login.php";



