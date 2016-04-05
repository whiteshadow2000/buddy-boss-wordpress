<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */

get_header();?>
<?php if ( is_active_sidebar('sidebar') ) : ?>
	<div class="page-right-sidebar">
<?php else : ?>
	<div class="page-full-width">
<?php endif; ?>
    
	<section id="primary" class="site-content">
		<div id="content" role="main">
        <header class="archive-header page-header smaller-padding">
            <h1 class="archive-title main-title">
               <?php printf( __( 'Author Archives: %s', 'boss' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
            </h1>
        </header><!-- .archive-header -->
		<?php if ( have_posts() ) : ?>
           
            <?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info table smaller-padding">
				<div class="author-avatar table-cell">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'buddyboss_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description table-cell">
					<h2><?php printf( __( 'About %s', 'boss' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
			<?php endif; ?>

			<?php 
            global $post;
            $courses = []; 
            $others = []; ?>
			<?php while ( have_posts() ) : the_post(); ?>
                <?php if(get_post_type() == 'course'){
                    $courses[] = $post;
                } else {
                    $others[] = $post;
                } ?>
				<?php //get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			
			<?php //wp_reset_postdata(); ?>
			
           
            <div id="author-tabs">
                <ul>
                    <li>
                        <a href="#main-course"><?php _e('Courses', 'boss-sensei'); ?>
                        <span class="tab-course-count"><?php echo count($courses); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#blog-posts"><?php _e('Posts', 'boss-sensei'); ?>
                        <span class="tab-course-count"><?php echo count($others); ?></span>
                        </a>
                    </li>
                </ul>
        
            
                <section id="main-course" class="course-container">
                <?php //do_action( 'sensei_course_archive_header', $query_type ); ?>

                <?php foreach($courses as $post) {
                    setup_postdata($post);


                    // Meta data
                    $post_id = absint( $post_item->ID );
                    $post_title = $post_item->post_title;
                    $user_info = get_userdata( absint( $post_item->post_author ) );
                    $author_link = get_author_posts_url( absint( $post_item->post_author ) );
                    $author_avatar = get_avatar( $post_item->post_author, 75 );
                    $author_display_name = $user_info->display_name;
                    $author_id = $post_item->post_author;
                    $category_output = get_the_term_list( $post_id, 'course-category', '', ', ', '' );
                    $preview_lesson_count = intval( $woothemes_sensei->post_types->course->course_lesson_preview_count( $post_id ) );

                    $is_user_taking_course = WooThemes_Sensei_Utils::user_started_course( $post_id, $current_user->ID );
                ?>

                <article class="<?php echo esc_attr( join( ' ', get_post_class( array( 'course', 'post' ), get_the_ID() ) ) ); ?>">
                    <!-- Modification -->
                    <div class="course-inner">
                        <div class="course-image">
                            <div class="course-mask"></div>
                            <div class="course-overlay">
                                <a href="<?php echo $author_link; ?>" title="<?php echo esc_attr( $author_display_name ); ?>">
                                <?php echo $author_avatar; ?>
                                </a>
                                <a href="<?php echo get_permalink( $post_id ); ?>" title="<?php echo esc_attr( $post_title ); ?>" class="play">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <?php
                            if ( has_post_thumbnail( $post_id ) ) {
                                // Get Featured Image
                                $img = get_the_post_thumbnail( $post_id, 'course-archive-thumb', array( 'class' => 'woo-image thumbnail alignleft') );

                            } else {
                                $img = '<img src="http://placehold.it/360x250&text=Course">';
                            }
                            echo '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( $post_title ) . '">' . $img . '</a>';
                            ?>
                        </div>
                        <section class="entry">
                            <div class="course-flexible-area">
                                <?php do_action( 'sensei_course_archive_course_title', $post ); ?>

                                <p class="sensei-course-meta">
                                    <?php if ( 0 < $preview_lesson_count && !$is_user_taking_course ) {
                                        $preview_lessons = sprintf( __( '(%d preview lessons)', 'boss-sensei' ), $preview_lesson_count ); ?>
                                        <span class="sensei-free-lessons"><a href="<?php echo get_permalink( $post_id ); ?>"><?php _e( 'Preview this course', 'boss-sensei' ) ?></a> - <?php echo $preview_lessons; ?></span>
                                    <?php } ?>
                                    <?php if ( isset( $woothemes_sensei->settings->settings[ 'course_author' ] ) && ( $woothemes_sensei->settings->settings[ 'course_author' ] ) ) { ?>
                                    <span class="course-author"><?php _e( 'by ', 'boss-sensei' ); ?><?php the_author_link(); ?></span>
                                    <?php } ?>
                                </p>
                            </div>

                            <p class="sensei-course-meta">
                                <span class="course-lesson-count"><?php echo $woothemes_sensei->post_types->course->course_lesson_count( $post_id ) . '&nbsp;' . apply_filters( 'sensei_lessons_text', __( 'Lessons', 'boss-sensei' ) ); ?></span>
                                <?php if ( '' != $category_output ) { ?>
                                <span class="course-category"><?php echo sprintf( __( 'in %s', 'boss-sensei' ), $category_output ); ?></span>
                                <?php } // End If Statement ?>
                                <?php sensei_simple_course_price( $post_id ); ?>
                            </p>
                            <!-- Modification -->
                            <!-- <p class="course-excerpt"><?php // echo apply_filters( 'get_the_excerpt', $post->post_excerpt ); ?></p>-->
                        </section>   

                    </div>

                </article>

                <?php wp_reset_postdata();
                }   ?>

                </section>

                <section id="blog-posts">
                    <?php foreach($others as $post) {
                        setup_postdata($post);
                        get_template_part( 'content', get_post_format() );
                        wp_reset_postdata();
                    } ?>
                </section>

			<div class="pagination-below">
				<?php buddyboss_pagination(); ?>
			</div>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

    <?php if ( is_active_sidebar('sidebar') ) : 
        get_sidebar('sidebar'); 
    endif; ?>
    </div>
<?php get_footer(); ?>
