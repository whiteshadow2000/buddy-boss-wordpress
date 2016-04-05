<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
   <?php 
    $is_photo = '';
    $style = '';
    if ( has_post_thumbnail() ){ 
        $id = get_post_thumbnail_id($post->ID); 
        $style = 'style="background-image: url('.wp_get_attachment_url($id).')"';
        $is_photo = 'data-photo="yes"';
    } 
    ?>
    <header class="page-cover table" <?php echo $is_photo; ?> <?php echo $style; ?>>
        <div class="table-cell page-header">
            <div class="cover-content">
                <h1 class="post-title main-title"><?php the_title(); ?></h1>
                <div class="table">
                    <div class="table-cell entry-meta">
                        <?php buddyboss_entry_meta(); ?>
                    </div>
                    <div class="table-cell">
                        <!-- Socials -->
                        <div class="btn-group social">

                        <?php foreach(buddyboss_get_user_social_array() as $social => $name):
                        $url = buddyboss_get_user_social(get_the_author_meta( 'ID' ) , $social );
                        ?>

                        <?php if(!empty($url)): ?>			
                        <a class="btn" href="<?php echo $url; ?>" title="<?php echo esc_attr($name); ?>"><i class="alt-social-icon alt-<?php echo $social; ?>"></i> </a>
                        <?php endif; ?>

                        <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- .archive-header -->
<?php if ( is_active_sidebar('sidebar') ) : ?>
	<div class="page-right-sidebar">
<?php else : ?>
	<div class="page-full-width">
<?php endif; ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php comments_template( '', true ); ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php endwhile; // end of the loop. ?>

<?php if ( is_active_sidebar('sidebar') ) : 
    get_sidebar('sidebar'); 
endif; ?>
</div>
<?php get_footer(); ?>
