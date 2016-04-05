<?php
/**
 * The Template for displaying course archives, including the course page template.
 *
 * Override this template by copying it to yourtheme/sensei/archive-course.php
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
?>

<?php  get_sensei_header();  ?>

<?php
/**
 * This hook fire inside learner-profile.php before the content
 *
 * @since 1.9.0
 *
 * @hooked Sensei_Learner_Profiles::deprecate_sensei_learner_profile_content_hook   - 10
 * @hooked Sensei_Templates::fire_sensei_complete_course_hook                      - 20
 */
do_action( 'sensei_learner_profile_content_before' ); ?>

        <?php
        /**
         * This hook fire inside learner-profile.php inside directly before the content
         *
         * @since 1.9.0
         *
         * @hooked  Sensei_Templates::fire_frontend_messages_hook
         */
        do_action( 'sensei_learner_profile_inside_content_before' );
        ?>

        <?php  $learner_user = get_user_by( 'slug', get_query_var('learner_profile') );  // get requested learner object ?>

        <?php if(  is_a( $learner_user, 'WP_User' ) ){ ?>

            <?php

            // show the user information
            Sensei_Learner_Profiles::user_info( $learner_user );

            ?>
            <!--show the user courses-->
            <article class="post">
                    <section id="learner-info" class="learner-info entry fix">
                            <?php

                            do_action( 'sensei_frontend_messages' );

                            do_action( 'sensei_learner_profile_info', $learner_user );

                            if( isset( $woothemes_sensei->settings->settings[ 'learner_profile_show_courses' ] ) && $woothemes_sensei->settings->settings[ 'learner_profile_show_courses' ] ) {

                                    $manage = ( $learner_user->ID == $current_user->ID ) ? true : false;

                                    do_action( 'sensei_before_learner_course_content', $learner_user );

                                    echo $boss_sensei->boss_edu_load_user_courses_content( $learner_user, $manage );

                                    do_action( 'sensei_after_learner_course_content', $learner_user );
                            }

                            ?>
                    </section>
            </article>

        <?php }else{  ?>

            <p class="sensei-message">

                <?php _e( 'The user requested does not exist.', 'woothemes-sensei'); ?>

            </p>

        <?php } ?>

        <?php
        /**
         * This hook fire inside learner-profile.php inside directly after the content
         *
         * @since 1.9.0
         */
        do_action( 'sensei_learner_profile_inside_content_after' );
        ?>

<?php
/**
 * This hook fire inside learner-profile.php after the content
 *
 * @since 1.9.0
 */
do_action( 'sensei_learner_profile_content_after' );
?>

<?php get_sensei_footer(); ?>