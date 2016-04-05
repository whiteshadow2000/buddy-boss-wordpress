<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>

<?php
/**
 * Get page title & content
 */
global $bp;

$custom_title = $custom_content = false;

$bp_title = get_the_title();

if ( bp_is_directory() )
{
  foreach ( (array) $bp->pages as $page_key => $bp_page )
  {
  	if ( is_page( $page_key ) )
  	{
  		$page_id = $bp_page->id;

  		$page_query = new WP_query( array(
  			'post_type' => 'page',
  			'page_id' => $page_id
  		) );

  		while( $page_query->have_posts() )
  		{
  			$page_query->the_post();

				$custom_title = get_the_title();
				$custom_content = wpautop( get_the_content() );
			}

			wp_reset_postdata();
    }
  }

  $pattern = '/([\s]*|&nbsp;)<a/im';

  // If we have a custom title and need to grab a BP title button
  if ( $custom_title != false && (int)preg_match( $pattern, $bp_title ) > 0 )
  {
    $token = md5('#b#u#d#d#y#b#o#s#s#');

    $bp_title_parsed = preg_replace( $pattern, $token, $bp_title );
    $bp_title_parts = explode( $token, $bp_title_parsed, 2 );

    $custom_title .= '&nbsp;<a' . $bp_title_parts[1];
  }
}

// Fall back to BP generated title if we didn't grab a custom one above
if ( ! $custom_title )
	$custom_title = $bp_title;
?>

		<header class="entry-header">
			<h1 class="entry-title">
				<?php echo $custom_title; ?>
			</h1>
		</header>

		<div class="entry-content">
			<?php if ( $custom_content ) echo $custom_content; ?>

			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'buddyboss' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

