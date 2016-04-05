<?php
/**
 * Template Name: Three Columns (two sidebars)
 *
 * Description: Use this page template for a page with two sidebars.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
get_header(); ?>

<div class="page-three-columns">

	<?php get_sidebar('left'); ?>

	<div id="primary" class="site-content">
	
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

</div><!-- .page-left-column -->
<?php get_footer(); ?>