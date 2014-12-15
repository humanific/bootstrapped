<?php
/**
 *
 */


add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );

register_nav_menu( 'primary', 'Primary Menu' );



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
	    'name' => 'footer Widgets',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

	register_sidebar(array(
	    'name' => 'navbar right',
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



add_action( 'init', 'bootstrapped_register_sidebars' );




require_once 'inc/general/class-bootstrapped_Walker_Nav_Menu.php';
require_once "inc/shortcodes.php";
require_once "inc/custom-header.php";
require_once "inc/extras.php";
require_once "inc/template-tags.php";




