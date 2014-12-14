<?php
/*
Template Name: Homepage
*/

get_header(); ?>
	<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
	</div><!-- .container -->
<?php get_footer(); ?>