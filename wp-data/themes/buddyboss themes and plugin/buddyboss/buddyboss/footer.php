<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage BuddyBoss
 * @since BuddyBoss 3.0
 */
?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->

<footer id="colophon" role="contentinfo">

    <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5') ) : ?>

        <div class="footer-inner-top">
            <div class="footer-inner widget-area">

                <?php if ( is_active_sidebar('footer-1') ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div><!-- .footer-widget -->
                <?php endif; ?>

                <?php if ( is_active_sidebar('footer-2') ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div><!-- .footer-widget -->
                <?php endif; ?>

                <?php if ( is_active_sidebar('footer-3') ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div><!-- .footer-widget -->
                <?php endif; ?>

                <?php if ( is_active_sidebar('footer-4') ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    </div><!-- .footer-widget -->
                <?php endif; ?>

                <?php if ( is_active_sidebar('footer-5') ) : ?>
                    <div class="footer-widget last">
                        <?php dynamic_sidebar( 'footer-5' ); ?>
                    </div><!-- .footer-widget -->
                <?php endif; ?>

            </div><!-- .footer-inner -->
        </div><!-- .footer-inner-top -->

    <?php endif; ?>

    <div class="footer-inner-bottom">
        <div class="footer-inner">

            <div id="footer-links">
                
                <p class="footer-credits <?php if ( !has_nav_menu( 'secondary-menu' ) ) : ?>footer-credits-single<?php endif; ?>">
                    <?php _e( "Copyright &copy;", 'buddyboss' ); ?> <?php echo date('Y'); ?> <?php bloginfo('name'); ?> <?php _e( '&nbsp;&middot;&nbsp; Designed by <a href="http://www.buddyboss.com/" target="_blank" title="responsive BuddyPress theme">BuddyBoss</a>Shared by <a href="http://www.themes24x7.com/" id="sd">Themes24x7</a>', 'buddyboss' ); ?>
                </p>
                
                <ul class="footer-menu">
                    <?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
                        <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'secondary-menu', 'items_wrap' => '%3$s' ) ); ?>
                    <?php endif; ?>
                </ul>

            </div>

            <div id="footer-icons">
                <ul class="social-icons">
                    
                    <!-- display social icons if added in Theme Customizer -->
                    <?php if ( get_theme_mod( 'boss_link_facebook' ) !== '') : ?>
                        <li><a class="link-facebook" title="<?php _e( "Facebook", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_facebook' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_twitter' ) !== '') : ?>
                        <li><a class="link-twitter" title="<?php _e( "Twitter", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_twitter' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_linkedin' ) !== '') : ?>
                        <li><a class="link-linkedin" title="<?php _e( "LinkedIn", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_linkedin' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_googleplus' ) !== '') : ?>
                        <li><a class="link-googleplus" title="<?php _e( "Google+", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_googleplus' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_youtube' ) !== '') : ?>
                        <li><a class="link-youtube" title="<?php _e( "Youtube", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_youtube' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_instagram' ) !== '') : ?>
                        <li><a class="link-instagram" title="<?php _e( "Instagram", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_instagram' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'boss_link_pinterest' ) !== '') : ?>
                        <li><a class="link-pinterest" title="<?php _e( "Pinterest", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_pinterest' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>
                    
                    <?php if ( get_theme_mod( 'boss_link_email' ) !== '') : ?>
                        <li><a class="link-email" title="<?php _e( "Email", 'buddyboss' ); ?>" href="mailto:<?php echo esc_attr( get_theme_mod( 'boss_link_email' ) ); ?>" target="_blank"><span></span></a></li>
                    <?php endif; ?>
                </ul>
            </div>

    	</div><!-- .footer-inner -->
    </div><!-- .footer-inner-bottom -->

    <?php do_action( 'bp_footer' ) ?>

</footer><!-- #colophon -->

</div> <!-- #inner-wrap -->

</div><!-- #main-wrap (Wrap For Mobile) -->

<?php wp_footer(); ?>


</body>
</html>