
    <br class="clear" />
    </div><!-- canvas -->
    
    <div class="widget-area-footer left">
        <div class="widget-area-footer-container">
            
		<?php if (is_active_sidebar('widget_area_footer_left')) { ?>
            <div class="widget-area-footer-left widget-area left">
                <?php dynamic_sidebar('widget_area_footer_left'); ?>
            </div>
        <?php } ?>
        
        <?php if (is_active_sidebar('widget_area_footer_center')) { ?>
            <div class="widget-area-footer-center widget-area left">
                <?php dynamic_sidebar('widget_area_footer_center'); ?>
            </div>
        <?php } ?>
        
        <?php if (is_active_sidebar('widget_area_footer_right')) { ?>
            <div class="widget-area-footer-right widget-area left">
                <?php dynamic_sidebar('widget_area_footer_right'); ?>
            </div>
        <?php } ?>
        
        <?php if (is_active_sidebar('widget_area_footer_left') || is_active_sidebar('widget_area_footer_center') || is_active_sidebar('widget_area_footer_right')) { ?>
        <br class="clear" />
        <?php } ?>
        </div>
    </div><!-- footer-areas -->
    
    <footer class="footer">
        <div class="footer-container">
                    
            <div class="copyright left">
				<?php _e('Copyright', 'gp'); ?> &copy; <?php echo the_date('Y'); ?> <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a>. <?php _e('All rights reserved.', 'gp'); ?>
						</div>
						<div class="footer-nav right">
				<?php wp_nav_menu( array('menu' => 'Footer Navigation', 'container' => false, 'menu_class' => 'menu-footer', 'after' => '&nbsp;|&nbsp;' )); ?>
            </div>
            
            <?php if (get_option('gp_socials_new_window') != 'No') {
				$new_window = ' target="_blank"';	
			} else {
				$new_window = '';
			}
			?>
            <div class="socials right hidden">
                <ul>
					<?php if (get_option('gp_twitter') != '') { ?>
                    <li class="twitter left"><a href="<?php echo get_option('gp_twitter'); ?>" title="<?php _e('Twitter', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_facebook') != '') { ?>
                    <li class="facebook left"><a href="<?php echo get_option('gp_facebook'); ?>" title="<?php _e('Facebook', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_linkedin') != '') { ?>
                    <li class="linkedin left"><a href="<?php echo get_option('gp_linkedin'); ?>" title="<?php _e('LinkedIn', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_googleplus') != '') { ?>
                    <li class="googleplus left"><a href="<?php echo get_option('gp_googleplus'); ?>" title="<?php _e('Google+', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_flickr') != '') { ?>
                    <li class="flickr left"><a href="<?php echo get_option('gp_flickr'); ?>" title="<?php _e('Flickr', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_vimeo') != '') { ?>
                    <li class="vimeo left"><a href="<?php echo get_option('gp_vimeo'); ?>" title="<?php _e('Vimeo', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_qype') != '') { ?>
                    <li class="qype left"><a href="<?php echo get_option('gp_qype'); ?>" title="<?php _e('Qype', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_tripadvisor') != '') { ?>
                    <li class="tripadvisor left"><a href="<?php echo get_option('gp_tripadvisor'); ?>" title="<?php _e('TripAdvisor', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_foursquare') != '') { ?>
                    <li class="foursquare left"><a href="<?php echo get_option('gp_foursquare'); ?>" title="<?php _e('Foursquare', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_xing') != '') { ?>
                    <li class="xing left"><a href="<?php echo get_option('gp_xing'); ?>" title="<?php _e('Xing', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                    <?php if (get_option('gp_rss_footer') != 'No') { ?>
                    <li class="rss left"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS', 'gp'); ?>"<?php echo $new_window; ?>></a></li>
                    <?php } ?>
                </ul>
            </div>
            
            <br class="clear" />
        </div>
    </footer><!-- footer -->

	<?php if (get_option('gp_googleanalytics') != ''){ echo stripslashes(get_option('gp_googleanalytics')); } ?>
    <?php wp_footer(); ?>

</body>
</html>
