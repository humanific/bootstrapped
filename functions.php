<?php
/**
 * The main theme functions file.
 *
 *
 * @bootstrapped https://github.com/humanific/bootstrapped
 */


add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );

add_action( 'after_setup_theme', 'bootstrapped_register_menu' );

function bootstrapped_register_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
}

function bootstrapped_excerpt_more( $more ) {
	return ' <p class="text-right"><a class="btn btn-default btn-sm" href="'. get_permalink( get_the_ID() ) . '"><i class="glyphicon glyphicon-play-circle"></i> ' . __('Read More', 'bootstrapped') . '</a></p>';
}
add_filter( 'excerpt_more', 'bootstrapped_excerpt_more' );

function bootstrapped_deregister_styles() {
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/bootstrap.css');
}

function bootstrapped_enqueue_script(){
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js' , array( 'jquery' ) );
}


add_action( 'wp_enqueue_scripts', 'bootstrapped_enqueue_script' );
add_action( 'wp_enqueue_scripts', 'bootstrapped_deregister_styles', 11 );


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
	    'id'            => 'footer-widgets',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

	register_sidebar(array(
	    'name' => 'Navbar right',
	    'id'            => 'navbar-right',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

	register_sidebar(array(
	    'name' => 'logo',
	    'id'            => 'logo',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widgettitle">',
	    'after_title' => '</h2>',
	));

}

add_action( 'init', 'bootstrapped_register_sidebars' );

function bootstrapped_theme_setup(){
    load_theme_textdomain('bootstrapped', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'bootstrapped_theme_setup');




require_once 'inc/general/class-bootstrapped_Walker_Nav_Menu.php';
require_once "inc/extras.php";
require_once "inc/template-tags.php";




