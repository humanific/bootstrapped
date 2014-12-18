<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
* @bootstrapped https://github.com/humanific/bootstrapped
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container" role="banner">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				        <div class="navbar-header">
				            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
							</button>
				            <?php if ( ! dynamic_sidebar( 'logo' ) ) : ?>
				            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"  class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
				            <?php endif; // end logo area ?>
				        </div>
						<div class="navbar-collapse collapse navbar-left">
						<?php 
						$args = array('theme_location' => 'primary', 
									  'container_class' => '', 
									  'menu_class' => 'nav navbar-nav',
									  'fallback_cb' => '',
			                          'menu_id' => 'main-menu',
			                          'walker' => new bootstrapped_Walker_Nav_Menu()); 
						wp_nav_menu($args);
						?>
						 </div>
						 <div class="navbar-collapse collapse navbar-right">
		            <?php dynamic_sidebar( 'navbar right' ) ?>
						 </div>
					</div><!-- .col-md-12 -->
				</div><!-- row -->
			</div><!-- container -->
		</nav>
	</header><!-- #masthead -->
	<div id="content" class="site-content">