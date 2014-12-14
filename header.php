<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
* @bootstrapped http://humanific.be
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container" role="banner">
		<nav class="navbar navbar-default navbar-top" role="navigation">
		


		
		
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				        <div class="navbar-header">
				            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
							</button>
				            
				            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"  class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
				            
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
						<ul class="nav navbar-nav ">
						<li class="dropdown">
							<?php if ( is_user_logged_in() ): 
								global $current_user;
								get_currentuserinfo();

							?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"  id="usermenu"><?php echo __('Hi','sdvu').' '.$current_user->display_name;?> <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="usermenu">
							<li><a href="<?php echo wp_logout_url( '/' ); ?>" title="Logout"><?php _e('Log out','sdvu');?></a></li>
							</ul>
							<?php else:?>
							<a href="#"  data-toggle="modal" data-target="#login_modal"><?php _e('Log in','sdvu');?></a>
							<?php endif;?>
						</li><?php 
						global $polylang;
						if(isset($polylang)):?>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="langmenu">Language <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="langmenu">
							<?php
							$langs = pll_the_languages(array('raw' =>true,'hide_current'=>true));
							foreach($langs as $k => $lang){
								echo '<li><a href="'.$lang['url'].'">'.$lang['name'].'</a></li>';
							}
							?>
							<?php endif;?>
							</ul>
						</li>
						</ul>
						</div>
						
					</div><!-- .col-md-12 -->
				</div><!-- row -->
			</div><!-- container -->
		</nav>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
