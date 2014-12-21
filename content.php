<?php
/**
* @bootstrapped https://github.com/humanific/bootstrapped
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php bootstrapped_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->







	<?php if ( is_search() || is_home() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary media">
		<?php if ( has_post_thumbnail() ) :?>
	<a class="media-left" href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail('thumbnail');?>
</a>
<?php endif;?>
	<div class="media-body">
		<?php the_excerpt(); ?>
	</div>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bootstrapped')); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bootstrapped' ),
				'after'  => '</div>',
			));
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'bootstrapped' ) );
				if ( $categories_list ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'bootstrapped' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'bootstrapped' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'bootstrapped' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bootstrapped' ), __( '1 Comment', 'bootstrapped' ), __( '% Comments', 'bootstrapped' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'bootstrapped' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
