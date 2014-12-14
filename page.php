<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
* @bootstrapped http://humanific.be
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
			</div>
			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- .container -->
<?php get_footer(); ?>
