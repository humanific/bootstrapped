<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
* @bootstrapped http://humanific.be
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function bootstrapped_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'bootstrapped_jetpack_setup' );
