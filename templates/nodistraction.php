<?php
/*
Template Name: nodistraction
*/

get_header(); ?>
	<div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
      </div>
    </div>
	</div><!-- .container -->
<?php get_footer(); ?>