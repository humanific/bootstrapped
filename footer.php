<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
* @wordstrap http://1-up.be
 */
?>

	</div><!-- #content -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<footer id="colophon" class="site-footer" role="contentinfo">
						<div><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?></div>
				</footer><!-- #colophon -->
			</div><!-- .col-md-12 -->
		</div><!-- .row -->
	</div><!-- container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>