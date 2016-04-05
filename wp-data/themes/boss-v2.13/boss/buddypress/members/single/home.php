<div id="buddypress" >
    
    <?php if(!bp_is_current_component('events') || ( bp_is_current_component('events') && 'profile' == bp_current_action() ) ): //show if not Events Manager page or My Profile of Events ?> 
    
	<?php do_action( 'bp_before_member_home_content' ); ?>

	<div id="item-header" role="complementary">

		<?php bp_get_template_part( 'members/single/member-header' ) ?>

	</div><!-- #item-header -->
   
    <?php endif; ?>
    
    <div class="<?php echo ( boss_get_option( 'boss_layout_style' ) == 'boxed' && is_active_sidebar( 'profile' ) && bp_is_user() ) ? 'right-sidebar' : 'full-width'; ?>">
        <div id="item-main-content">
            <?php if(!bp_is_current_component('events') || ( bp_is_current_component('events') && 'profile' == bp_current_action() ) ): //show if not Events Manager page or My Profile of Events ?>  
            <div id="item-nav">
                <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                    <ul id="nav-bar-filter">

                        <?php bp_get_displayed_user_nav(); ?>

                        <?php do_action( 'bp_member_options_nav' ); ?>

                    </ul>
                </div>
            </div><!-- #item-nav -->
            <?php endif; ?>

            <div id="item-body" role="main">

                <?php
                do_action( 'bp_before_member_body' );

                if ( bp_is_user_activity() || !bp_current_component() ) :
                    bp_get_template_part( 'members/single/activity' );

                elseif ( bp_is_user_blogs() ) :
                    bp_get_template_part( 'members/single/blogs' );

                elseif ( bp_is_user_friends() ) :
                    bp_get_template_part( 'members/single/friends' );

                elseif ( bp_is_user_groups() ) :
                    bp_get_template_part( 'members/single/groups' );

                elseif ( bp_is_user_messages() ) :
                    bp_get_template_part( 'members/single/messages' );

                elseif ( bp_is_user_profile() ) :
                    bp_get_template_part( 'members/single/profile' );

                elseif ( bp_is_user_forums() ) :
                    bp_get_template_part( 'members/single/forums' );

                elseif ( bp_is_user_notifications() ) :
                    bp_get_template_part( 'members/single/notifications' );

                elseif ( bp_is_user_settings() ) :
                    bp_get_template_part( 'members/single/settings' );

                // If nothing sticks, load a generic template
                else :
                    bp_get_template_part( 'members/single/plugins' );

                endif;

                do_action( 'bp_after_member_body' );
                ?>

            </div><!-- #item-body -->

            <?php do_action( 'bp_after_member_home_content' ); ?>

        </div>
        <!-- /.item-main-content -->
        <?php
        // Boxed layout sidebar
        if ( boss_get_option( 'boss_layout_style' ) == 'boxed' ) {
            get_sidebar( 'buddypress' );
        }
        ?>
    </div>

</div><!-- #buddypress -->