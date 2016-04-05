<?php
/**
 * The template for displaying bbPress content.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */

get_header(); ?>

	<!-- if widgets are loaded in the Forums sidebar, display it -->	
	<?php if ( is_active_sidebar('forums') ) : ?>		
		<div class="page-right-sidebar">

	<!-- if not, hide the sidebar -->
	<?php else: ?>
		<div class="page-full-width">
	<?php endif; ?>


			<!-- bbPress template content -->
			<div id="primary" class="site-content">
			
				<div id="content" role="main">

					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>

				</div><!-- #content -->
			</div><!-- #primary -->

			<?php get_sidebar('bbpress'); ?>


		</div><!-- closing div -->

<?php get_footer(); ?>