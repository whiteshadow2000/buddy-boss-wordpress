<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in BuddyBoss consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */

get_header(); ?>

<?php if ( is_active_sidebar('home-left') && is_active_sidebar('home-right') ) : ?>
	<div class="page-three-columns">
<?php elseif ( is_active_sidebar('home-left') && !is_active_sidebar('home-right') ) : ?>
	<div class="page-left-sidebar">
<?php elseif ( !is_active_sidebar('home-left') && is_active_sidebar('home-right') ) : ?>
	<div class="page-right-sidebar">
<?php else : ?>
	<div class="page-full-width">
<?php endif; ?>


		<!-- Frontpage Slider -->
		<?php get_template_part( 'content', 'slides' ); ?>

	    <!-- Frontpage Content -->
		<?php get_sidebar('home-left'); ?>

		<div id="primary" class="site-content">
		
			<div id="content" role="main">
				
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php if( is_home() ) : ?>
						<?php get_template_part( 'content' ); ?>
					<?php else : ?>
						<?php get_template_part( 'content', 'page' ); ?>
					<?php endif; ?>

					<?php comments_template( '', true ); ?>
					
				<?php endwhile; // end of the loop. ?>

				<?php buddyboss_pagination(); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

		<?php get_sidebar('home-right'); ?>

	</div><!-- .page-left-sidebar -->
	
<?php get_footer(); ?>