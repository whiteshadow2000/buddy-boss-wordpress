<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
?>
                        </div><!-- #main .wrapper -->

                    </div><!-- #page -->

                </div> <!-- #inner-wrap -->

            </div><!-- #main-wrap (Wrap For Mobile) -->

            <footer id="colophon" role="contentinfo">

                <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) : ?>

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

                        </div><!-- .footer-inner -->
                    </div><!-- .footer-inner-top -->

                <?php endif; ?>

                <div class="footer-inner-bottom">
                    <div class="footer-inner">
                        <p class="footer-credits <?php if ( !has_nav_menu( 'secondary-menu' ) ) : ?>footer-credits-single<?php endif; ?>">
                            <?php _e( "&copy;", 'boss' ); ?> <?php echo date('Y'); ?> <?php bloginfo('name'); ?> <?php _e( "<span class='buddyboss-credit'>&middot; Powered by <a href='http://www.themes24x7.com/' title='BuddyPress themes' target='_blank'>BuddyBoss</a></span><span class='buddyboss-credit'>&middot; Shared by <a href='http://www.themes24x7.com/' title='BuddyPress themes' target='_blank'>Themes24x7</a></span>", 'boss' ); ?> 
                        </p>
						
                        <div id="footer-links">

                            <ul class="footer-menu">
                                <?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
                                    <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'secondary-menu', 'items_wrap' => '%3$s', 'depth' => -1 ) ); ?>
                                <?php endif; ?>
                            </ul>
                            
                             <div id="footer-icons">
                                <ul class="social-icons">

                                    <!-- display social icons if added in Theme Customizer -->
                                    <?php if ( get_theme_mod( 'boss_link_facebook' ) && get_theme_mod( 'boss_link_facebook' ) !== '') : ?>
                                        <li><a class="link-facebook" title="<?php _e( "Facebook", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_facebook' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_twitter' ) && get_theme_mod( 'boss_link_twitter' ) !== '') : ?>
                                        <li><a class="link-twitter" title="<?php _e( "Twitter", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_twitter' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_linkedin' ) && get_theme_mod( 'boss_link_linkedin' ) !== '') : ?>
                                        <li><a class="link-linkedin" title="<?php _e( "LinkedIn", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_linkedin' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_googleplus' ) && get_theme_mod( 'boss_link_googleplus' ) !== '') : ?>
                                        <li><a class="link-googleplus" title="<?php _e( "Google+", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_googleplus' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_youtube' ) && get_theme_mod( 'boss_link_youtube' ) !== '') : ?>
                                        <li><a class="link-youtube" title="<?php _e( "Youtube", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_youtube' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_instagram' ) && get_theme_mod( 'boss_link_instagram' ) !== '') : ?>
                                        <li><a class="link-instagram" title="<?php _e( "Instagram", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_instagram' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_pinterest' ) && get_theme_mod( 'boss_link_pinterest' ) !== '') : ?>
                                        <li><a class="link-pinterest" title="<?php _e( "Pinterest", 'buddyboss' ); ?>" href="<?php echo esc_url( get_theme_mod( 'boss_link_pinterest' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>

                                    <?php if ( get_theme_mod( 'boss_link_email' ) && get_theme_mod( 'boss_link_email' ) !== '') : ?>
                                        <li><a class="link-email" title="<?php _e( "Email", 'buddyboss' ); ?>" href="mailto:<?php echo esc_attr( get_theme_mod( 'boss_link_email' ) ); ?>" target="_blank"><span></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            
                            <?php if(get_option( 'boss_layout_switcher' ) != 'no') { ?>
                               <form id="switch-mode" name="switch-mode" method="post">
                                    <input type="submit" value="View as Desktop" tabindex="1" id="switch_submit" name="submit" />
                                    <input type="hidden" id="switch_mode" name="switch_mode" value="desktop" />
                                    <?php wp_nonce_field( 'switcher_action', 'switcher_nonce_field' ); ?>
                                </form>
                            <?php } else { ?>
                                <a href="#scroll-to" class="to-top fa fa-angle-up scroll"></a>
                            <?php } ?>
                        </div>

                    </div><!-- .footer-inner -->
                </div><!-- .footer-inner-bottom -->

                <?php do_action( 'bp_footer' ) ?>

            </footer><!-- #colophon -->
        </div><!-- #right-panel-inner -->
    </div><!-- #right-panel -->

</div><!-- #panels -->


<?php wp_footer(); ?>


</body>
</html>
