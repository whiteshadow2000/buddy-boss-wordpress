<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if (is_single()): ?>
            <?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-post-large">
					<?php the_post_thumbnail('large'); ?>
				</div>
			<?php endif; ?>
        <?php endif; ?>
		<!-- Title -->
		<header class="entry-header">
			
			<!-- Single blog post -->
			<?php if ( is_single() ) : ?>
			
				<h1 class="entry-title"><?php the_title(); ?></h1>
	
				<div class="entry-meta">
					
					<?php buddyboss_entry_meta(); ?>
					
					<!-- reply link -->
					<?php if ( comments_open() ) : ?>
						<span class="comments-link">
							<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'buddyboss' ) . '</span>', __( '1 Reply', 'buddyboss' ), __( '% Replies', 'buddyboss' ) ); ?>
						</span><!-- .comments-link -->
					<?php endif; // comments_open() ?>

				</div><!-- .entry-meta -->

			<!-- all other templates -->
			<?php else : ?>
			
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'buddyboss' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>

			<?php endif; // is_single() ?>

		</header><!-- .entry-header -->

		<!-- Search, Blog index, archives -->
		<?php if ( is_search() || is_archive() || is_home() ) : // Only display Excerpts for Search, Blog index, and archives ?>
		
			<?php if ( has_post_thumbnail() ) : ?>
				<a class="entry-post-thumbnail" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('thumbnail'); ?>
				</a>
			<?php endif; ?>

			<div class="entry-content entry-summary <?php if ( has_post_thumbnail() ) : ?>entry-summary-thumbnail<?php endif; ?>">
				
				<?php the_excerpt(); ?>

				<footer class="entry-meta">
										
					<?php buddyboss_entry_meta(); ?>
					
					<!-- reply link -->
					<?php if ( comments_open() ) : ?>
						<span class="comments-link">
							<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'buddyboss' ) . '</span>', __( '1 Reply', 'buddyboss' ), __( '% Replies', 'buddyboss' ) ); ?>
						</span><!-- .comments-link -->
					<?php endif; // comments_open() ?>

				</footer><!-- .entry-meta -->

			</div><!-- .entry-content -->
		
		<!-- all other templates -->
		<?php else : ?>
			
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'buddyboss' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'buddyboss' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
								
				<?php edit_post_link( __( 'Edit', 'buddyboss' ), '<span class="edit-link">', '</span>' ); ?>

			</footer><!-- .entry-meta -->
		
		<?php endif; ?>


	</article><!-- #post -->
