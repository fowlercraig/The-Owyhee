<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Scripts
function gp_frontend_additionals() {
	
	if (!is_admin()) {
	
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		
		if (is_front_page() && is_page_template('page-home.php')) {
		
			wp_register_script('slider', get_template_directory_uri() . '/js/supersized.js', 'jquery');
			wp_enqueue_script('slider');
			
			wp_register_script('shutter', get_template_directory_uri() . '/js/supersized.shutter.js', 'jquery');
			wp_enqueue_script('shutter');
			
			wp_register_script('easing', get_template_directory_uri() . '/js/easing.js', 'jquery');
			wp_enqueue_script('easing');
			
		}
			
		wp_register_script('sticky', get_template_directory_uri() . '/js/sticky.js', 'jquery');
		wp_enqueue_script('sticky');
		
		wp_register_script('datepicker', get_template_directory_uri() . '/js/datepicker.js', 'jquery');
		wp_enqueue_script('datepicker');
		
		wp_register_script('tweet', get_template_directory_uri() . '/js/tweet.js', 'jquery');
		wp_enqueue_script('tweet');
		
		wp_register_script('prettyphoto', get_template_directory_uri() . '/js/prettyphoto.js', 'jquery');
		wp_enqueue_script('prettyphoto');
		
		wp_register_script('form', get_template_directory_uri() . '/js/form.js', 'jquery');
		wp_enqueue_script('form');
		
		wp_register_script('validate', get_template_directory_uri() . '/js/validate.js', 'jquery');
		wp_enqueue_script('validate');
		
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery');
		wp_enqueue_script('custom');
	}
	
	if (is_singular()) { 
	
		wp_enqueue_script('comment-reply'); 
		
	}
	
}
add_action('wp_enqueue_scripts', 'gp_frontend_additionals');
// END // Scripts

// Styles
function gp_frontend_styles() {
	if (!is_admin()) {
		wp_enqueue_style('gp_components', get_template_directory_uri() .'/css/components.css');
		if (get_option('gp_responsive') != 'No') {
			wp_enqueue_style('gp_responsive', get_template_directory_uri() .'/css/responsive.css');
		}
	}
}
add_action('init', 'gp_frontend_styles');
// END // Styles

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Automatic Feed Links
add_theme_support('automatic-feed-links');
// END // Automatic Feed Links

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// WP Head - Remove
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
// END // WP Head - Remove

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Menus
function gp_menus() {
	register_nav_menus(
		array(
			'primary_navigation' => __('Primary navigation', 'gp')
		)
	);
}
add_action('init', 'gp_menus');
// END // Register Menus

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Widget Areas
if (function_exists('register_sidebar')) {
	
// - - - - - - - - - - - - - - - - - - - - - - -
	
// Sidebar: Left
	register_sidebar(array(
		'name' 			=> __('Sidebar: Left', 'gp'),
		'description' 	=> __('Left sidebar widget area displayed on almost all pages.', 'gp'),
		'id' 			=> 'widget_sidebar_left_area',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
// END // Sidebar: Left
	
// - - - - - - - - - - - - - - - - - - - - - - -

// Sidebar: Right
	register_sidebar(array(
		'name' 			=> __('Sidebar: Right', 'gp'),
		'description' 	=> __('Right sidebar widget area displayed on page template called Page - Right.', 'gp'),
		'id' 			=> 'widget_sidebar_right_area',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
// END // Sidebar: Right
	
// - - - - - - - - - - - - - - - - - - - - - - -
	
// Sidebar: Right
	register_sidebar(array(
		'name' 			=> __('Sidebar: Blog - Top', 'gp'),
		'description' 	=> __('Right sidebar widget area displayed on blog pages (category, post, archives) on the top of the sidebar.', 'gp'),
		'id' 			=> 'widget_sidebar_right_area_top',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
	register_sidebar(array(
		'name' 			=> __('Sidebar: Blog - Bottom', 'gp'),
		'description' 	=> __('Right sidebar widget area displayed on blog pages (category, post, archives) on the bottom of the sidebar.', 'gp'),
		'id' 			=> 'widget_sidebar_right_area_bottom',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
// END // Sidebar: Right

// - - - - - - - - - - - - - - - - - - - - - - -

// Footer
	register_sidebar(array(
		'name' 			=> __('Footer: Left', 'gp'),
		'description' 	=> __('First footer widget area.', 'gp'),
		'id' 			=> 'widget_area_footer_left',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
	register_sidebar(array(
		'name' 			=> __('Footer: Center', 'gp'),
		'description' 	=> __('Second Footer widget area.', 'gp'),
		'id' 			=> 'widget_area_footer_center',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
	register_sidebar(array(
		'name' 			=> __('Footer: Right', 'gp'),
		'description' 	=> __('Third Footer widget area.', 'gp'),
		'id' 			=> 'widget_area_footer_right',
		'before_widget' => '<div id="%1$s" class="widget-block left %2$s">',
		'after_widget'  => '<br class="clear" /></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	));
// END // Footer
	
}
// END // Register Widget Areas

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Max Content Width
if (!isset($content_width)) $content_width = 988;
// END // Max Content Width

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Favicon
function gp_favicon() {
	if (get_option('gp_favicon') != '') { 
	?>
	<link rel="shortcut icon" href="<?php echo get_option('gp_favicon'); ?>"/>
	<?php } else { ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<?php 
	}
}
add_action('wp_head', 'gp_favicon');
// END // Custom Favicon

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Automatic Feed Links
add_theme_support('automatic-feed-links');
// END // Automatic Feed Links

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Remove WordPress Version to Increase Security
function gp_kill_wp_version() {
	return '';
}
add_filter('the_generator', 'gp_kill_wp_version');
// END // Remove WordPress Version to Increase Security

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Excerpt
function gp_excerpt_more($more) {
	return ' ...';
}
add_filter('excerpt_more', 'gp_excerpt_more');

function gp_excerpt_length($length) {
	return 60; 
}
add_filter('excerpt_length', 'gp_excerpt_length');
// END // Excerpt

// - - - - - - - - - - - - - - - - - - - - - - -

// Custom Excerpt for Posts
function gp_excerpt($words = 30) {
	global $post;
	
	$text = preg_replace('/\[.*\]/', '', strip_tags($post->post_excerpt));
	$text = explode(' ', $text);
	$tot = count($text);
	
	for ( $i=0; $i<$words; $i++ ) : $output .= $text[$i] . ' '; endfor; 
	?>
    <p class="post-excerpt"><?php echo force_balance_tags($output) ?><?php if ( $i < $tot ) : ?> ...</p>
	<?php else : ?>
    </p>
	<?php endif;
}
// END // Custom Excerpt for Posts

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(988, 9999);

function theme_setup() {
	add_image_size('small', 100, 70, true);
	add_image_size('medium', 232, 162, true);
	add_image_size('large', 988, 9999, true);
	add_image_size('menucard-small', 100, 70, true);
	add_image_size('menucard-medium', 232, 162, true);
	add_image_size('menucard-large', 988, 9999);
	add_image_size('photos-small', 100, 70, true);
	add_image_size('photos-medium', 232, 162, true);
	add_image_size('photos-large', 988, 9999);
	add_image_size('post-small', 226, 120, true);
	add_image_size('post-medium', 716, 260, true);
	add_image_size('post-large', 988, 9999);
	add_image_size('callout', 316, 120, true);
}
add_action( 'after_setup_theme', 'theme_setup' );
// END // Thumbnails

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Styles
function gp_colors_css() {
	
	?>

	<style type="text/css">
		
		/* Body: background-color -> BG color */
		body {
			<?php if (get_option('gp_bg_color') != "") { ?>
			background-color: <?php echo get_option('gp_bg_color'); ?>;
			<?php } else { ?>
			background-color: #2d1912;
			<?php } ?>
		}
		
		/* Layout: background-color -> BG color */
		header.header,
		.content-home,
		footer.footer,
		.widget-area-footer,
		.content { background-color: <?php if ( get_option('gp_bg_color') != "") { ?><?php echo get_option('gp_bg_color'); ?><?php } else { ?>#2d1912<?php } ?>; }
		
		/* Primary navigation: color -> BG color */		
		nav.navigation ul li li a,
		nav.navigation ul li li li a,
		nav.navigation ul li li:hover li a,
		nav.navigation ul li:hover li:hover li a,
		nav.navigation-mobile li li a,
		nav.navigation-mobile .menu li .sub-menu li a,
		nav.navigation-mobile .menu li .children li a { color: <?php if ( get_option('gp_bg_color') != "") { ?><?php echo get_option('gp_bg_color'); ?><?php } else { ?>#2d1912<?php } ?> !important; }
		
		/* White alert: color -> BG color */
		.alert-box.white,
		.alert-box.white a { color: <?php if ( get_option('gp_bg_color') != "") { ?><?php echo get_option('gp_bg_color'); ?><?php } else { ?>#2d1912<?php } ?> !important; }
		
		/* Callouts: color -> BG color */
		.callouts .callout-content { <?php if (get_option('gp_bg_color') != "") { ?>color: <?php echo get_option('gp_bg_color'); ?>;<?php } else { ?>color: #2d1912;<?php } ?> }
		
		/* Callouts: background-color -> BG color */
		.callouts .callout-image { <?php if (get_option('gp_bg_color') != "") { ?>background-color: <?php echo get_option('gp_bg_color'); ?>;<?php } else { ?>background-color: #2d1912;<?php } ?> }
		
		/* Link: background-color -> Primary color */
		a:hover { background-color: <?php if ( get_option('gp_primary_color') != "") { ?><?php echo get_option('gp_primary_color'); ?><?php } else { ?>#d2552d<?php } ?>; }
		
		/* Various: color -> Primary color */
		h3,
		label,
		p.featured,
		nav.navigation ul li:hover a,
		nav.navigation ul li a:hover,
		nav.navigation-mobile li:hover a,
		nav.navigation-mobile li a:hover,
		nav.navigation-categories li .children a,
		.widget_reservation h4,
		.widget_testimonial .testimonial-content,
		.list-menucard-block .post-price,
		.comments .comment-author .fn,
		.comments .comment-author .fn a,
		.single-menucard .post-description,
		.widget_categories .children a,
		.widget_nav_menu .sub-menu a,
		.widget-area-footer .post-info,
		.widget-area-footer .post-info a,
		.widget-area-sidebar .post-info,
		.widget-area-sidebar .post-info a,
		.list-posts .post-header h2 a:hover,
		.list-menucard-block .post-header h3 a,
		.list-menucard-block .post-header h3,
		.list-photos-block .list-photos-block-header h2 a,
		blockquote { <?php if ( get_option('gp_primary_color') != "") { ?>color: <?php echo get_option('gp_primary_color'); ?>;<?php } else { ?>color: #d2552d;<?php } ?> }
		
		/* Various: background-color -> Primary color */
		.callouts .callout-title a,
		.callouts .callout-title.without-link,
		.list-posts .post-info .post-date,
		.list-posts .post-info .post-comments:hover,
		.page-header h1 .post-price,
		.alert-box.custom { background-color: <?php if ( get_option('gp_primary_color') != "") { ?><?php echo get_option('gp_primary_color'); ?><?php } else { ?>#d2552d<?php } ?>; }
		
		/* Various: border -> Primary color */
		.callouts .callout-content .button a,
		.bypostauthor .avatar,
		blockquote { border-color: <?php if ( get_option('gp_primary_color') != "") { ?><?php echo get_option('gp_primary_color'); ?><?php } else { ?>#d2552d<?php } ?>; }
		
		/* Button: background-color -> Primary color */
		button,
		.button a,
		button.button-standard,
		.button-standard a,
		button.standard,
		.standard a,
		.comments .reply a,
		a#cancel-comment-reply-link,
		.widget_tag_cloud a:hover,
		.comments #submit { background-color: <?php if ( get_option('gp_primary_color') != "") { ?><?php echo get_option('gp_primary_color'); ?><?php } else { ?>#d2552d<?php } ?>; }
		
		/* Primary navigation: border -> Primary color */
		nav.navigation ul li:hover,
		nav.navigation-mobile li:hover { border-color: <?php if ( get_option('gp_primary_color') != "") { ?><?php echo get_option('gp_primary_color'); ?><?php } else { ?>#d2552d<?php } ?>; }
		
		/* Primary navigation: background-color -> Primary color */
		nav.navigation ul li li:hover a,
		nav.navigation ul li:hover li:hover li:hover a,
		nav.navigation-mobile .menu li:hover a,
		nav.navigation-mobile .menu li .sub-menu li:hover a,
		nav.navigation-mobile .menu li .children li:hover a { <?php if ( get_option('gp_primary_color') != "") { ?>background-color: <?php echo get_option('gp_primary_color'); ?> !important;<?php } else { ?>background-color: #d2552d !important;<?php } ?> }
		
		/* Primary navigation: color -> Primary color */
		nav.navigation li.current-menu-item a { <?php if ( get_option('gp_primary_color') != "") { ?>color: <?php echo get_option('gp_primary_color'); ?>;<?php } else { ?>color: #d2552d;<?php } ?> }

		/* UI components -> Primary color */
		.ui-widget-header { <?php if ( get_option('gp_primary_color') != "") { ?>background-color: <?php echo get_option('gp_primary_color'); ?>;<?php } else { ?>background-color: #d2552d;<?php } ?> }
		.ui-state-highlight,
		.ui-widget-content .ui-state-highlight,
		.ui-widget-header .ui-state-highlight { <?php if ( get_option('gp_primary_color') != "") { ?>background-color: <?php echo get_option('gp_primary_color'); ?> !important;<?php } else { ?>background-color: #d2552d !important;<?php } ?> background-image: none !important; }
		.ui-state-hover,
		.ui-widget-content .ui-state-hover,
		.ui-widget-header .ui-state-hover,
		.ui-state-focus,
		.ui-widget-content
		.ui-state-focus,
		.ui-widget-header .ui-state-focus { <?php if ( get_option('gp_primary_color') != "") { ?>background: <?php echo get_option('gp_primary_color'); ?> !important;<?php } else { ?>background: #d2552d !important;<?php } ?> }
		.ui-state-active,
		.ui-widget-content .ui-state-active,
		.ui-widget-header .ui-state-active { <?php if ( get_option('gp_primary_color') != "") { ?>border: 1px solid <?php echo get_option('gp_primary_color'); ?>;<?php } else { ?>border: 1px solid #d2552d;<?php } ?> <?php if ( get_option('gp_primary_color') != "") { ?>color: <?php echo get_option('gp_primary_color'); ?>;<?php } else { ?>color: #d2552d;<?php } ?> }
		
		<?php if (get_option('gp_field_style') == 'White') { ?>
		.form input,
		.form textarea,
		.form select {
			background-color: white;
			border: 1px solid white;
			<?php if (get_option('gp_bg_color') != "") { ?>
			color: <?php echo get_option('gp_bg_color'); ?>;
			<?php } else { ?>
			color: #2d1912;
			<?php } ?>
		}
		<?php } ?>
	
		<?php if (get_option('gp_custom_css') != "") { echo stripslashes(htmlspecialchars(get_option('gp_custom_css'))); } ?>
    
    </style>
    
	<?php
	
}
add_action('wp_head', 'gp_colors_css');
// END // Custom Styles

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom WordPress Login Logo
if (get_option('gp_login_logo_image') != "") {
	
	function gp_custom_login_logo() {
		
		?>
	
		<style type="text/css">
			
			#login h1 a { background-image: url("<?php echo get_option('gp_login_logo_image'); ?>") !important; }
			
		</style>
		
		<?php
		
	}
	add_action('login_head', 'gp_custom_login_logo');
	
	function gp_login_logo_url() {
		return home_url();
	}
	add_filter( 'login_headerurl', 'gp_login_logo_url' );
	
	function gp_login_logo_title() {
		return get_option('blogname');
	}
	add_filter( 'login_headertitle', 'gp_login_logo_title' );
	
}
// END // Custom WordPress Login Logo

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Slideshow Scripts
function gp_slideshow_scripts() {

	if (is_front_page() && is_page_template('page-home.php')) {
	?>
		<script type="text/javascript">
		
			jQuery(function($){
				
				jQuery.supersized({				
					slide_interval: <?php if (get_option('gp_slideshow_time_pause') != "") { echo get_option('gp_slideshow_time_pause'); } else { echo 8000; } ?>,
					transition: '<?php if (get_option('gp_slideshow_effect') != "") { echo get_option('gp_slideshow_effect'); } else { echo 'fade'; } ?>',
					transition_speed: <?php if (get_option('gp_slideshow_time_transition') != "") { echo get_option('gp_slideshow_time_transition'); } else { echo 800; } ?>,
					new_window: 0,
					horizontal_center: 1,
					progress_bar: 0,
					mouse_scrub: 0,
															   
					slides: [
					<?php
						$query = new WP_Query();
						$query->query('post_type=slides&posts_per_page=9999');
		
						if ($query->have_posts()) { 
							while ($query->have_posts()) {
								global $post;
								$query->the_post();
					?>
					
								<?php 
								if (has_post_thumbnail()) {
									$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
									$slide_caption = stripslashes(__(get_post_meta($post->ID, 'gp_slide_caption', true)));
									$replace = array("\r\n", "\n", "\r"); 
									$slide_caption = str_replace($replace, "", $slide_caption);
									$slide_caption = str_replace("'", "\'", $slide_caption);
									$slide_url = get_post_meta($post->ID, 'gp_slide_url', true);
								?>
									{image: '<?php echo $image_src[0]; ?>', title : '<?php if ($slide_url != '') { ?><h2><a href="<?php echo $slide_url; ?>"><?php the_title(); ?></a></h2><?php } else { ?><h2><?php the_title(); ?></h2><?php } ?><p><?php echo $slide_caption; ?></p>'}<?php if ($query->current_post + 1 != $query->post_count) { ?>,<?php } ?>
								<?php 
								} //if 
								?>

					<?php
							} //while
						} //if
					?>
					]

				});
		    });
			
		</script>
	<?php
    }
}
add_action('wp_head', 'gp_slideshow_scripts');
// END // Slideshow Scripts

// - - - - - - - - - - - - - - - - - - - - - - -

// Preloading Images Scripts
function gp_preloading_images_scripts() {
	?>
		<script type="text/javascript">
		// Preloading Images
		//<![CDATA[
			jQuery(function () {
				jQuery('.image img').css("display","none");
			});
			var i = 0;
			var int=0;
			jQuery(window).bind("load", function() {
				var int = setInterval("loadImage(i)",100);
			});
			function loadImage() {
				var imgs = jQuery('.image img').length;
				if (i >= imgs) {
					clearInterval(int);
				}
				jQuery('.image img:hidden').eq(0).fadeIn(200);
				i++;
			}
		//]]>
		</script>
	<?php
}
add_action('wp_head', 'gp_preloading_images_scripts');
// END // Preloading Images Scripts

// - - - - - - - - - - - - - - - - - - - - - - -

// Reservation Form Scripts
function gp_reservation_scripts() {
	if (is_page_template('page-reservation.php')) { 
	?>
		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function() {
				jQuery("#form-reservation").validate({
					messages: {
						reservation_datepicker: '<?php _e('Please select a date.', 'gp'); ?>',
						reservation_hour: '<?php _e('Please select the hour.', 'gp'); ?>',
						reservation_minutes: '<?php _e('Please select a minutes.', 'gp'); ?>',
						reservation_persons: '<?php _e('Please fill the number of persons.', 'gp'); ?>',
						reservation_name: '<?php _e('Please fill your name.', 'gp'); ?>',
						reservation_phone: '<?php _e('Please fill your phone number.', 'gp'); ?>',
						reservation_email: {
							required: '<?php _e('Please fill your email address.', 'gp'); ?>',
							email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
						}
					}
				});
			});
			jQuery(function() {
				jQuery("#reservation_datepicker").datepicker({ 
					firstDay: 1,
					dateFormat: "mm/dd/yy",
					dayNames: ['<?php _e('Sunday', 'gp'); ?>', '<?php _e('Monday', 'gp'); ?>', '<?php _e('Tuesday', 'gp'); ?>', '<?php _e('Wednesday', 'gp'); ?>', '<?php _e('Thursday', 'gp'); ?>', '<?php _e('Friday', 'gp'); ?>', '<?php _e('Saturday', 'gp'); ?>'],
					dayNamesMin: ['<?php _e('Su', 'gp'); ?>', '<?php _e('Mo', 'gp'); ?>', '<?php _e('Tu', 'gp'); ?>', '<?php _e('We', 'gp'); ?>', '<?php _e('Th', 'gp'); ?>', '<?php _e('Fr', 'gp'); ?>', '<?php _e('Sa', 'gp'); ?>'],
					monthNames: ['<?php _e('January', 'gp'); ?>', '<?php _e('February', 'gp'); ?>', '<?php _e('March', 'gp'); ?>', '<?php _e('April', 'gp'); ?>', '<?php _e('May', 'gp'); ?>', '<?php _e('June', 'gp'); ?>', '<?php _e('July', 'gp'); ?>', '<?php _e('August', 'gp'); ?>', '<?php _e('September', 'gp'); ?>', '<?php _e('October', 'gp'); ?>', '<?php _e('November', 'gp'); ?>', '<?php _e('December', 'gp'); ?>'],
					nextText: '<?php _e('Next', 'gp'); ?>',
					prevText: '<?php _e('Prev', 'gp'); ?>'
				});
			});
		//]]>
		</script>
	<?php
    }
}
add_action('wp_head', 'gp_reservation_scripts');
// END // Reservation Form Scripts

// - - - - - - - - - - - - - - - - - - - - - - -

// Contact Form Scripts
function gp_contact_scripts() {
	if (is_page_template('page-contact.php')) { 
	?>
		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function() {
				jQuery("#form-contact").validate({
					messages: {
						contact_name: '<?php _e('Please fill your name.', 'gp'); ?>',
						contact_email: {
							required: '<?php _e('Please fill your email address.', 'gp'); ?>',
							email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
						},
						contact_message: '<?php _e('Please fill your message.', 'gp'); ?>',
						captcha_message: '<?php _e('Please fill valid captcha.', 'gp'); ?>'
					}
				});
			});
		//]]>
		</script>
	<?php
    }
}
add_action('wp_head', 'gp_contact_scripts');
// END // Contact Form Scripts

// - - - - - - - - - - - - - - - - - - - - - - -

// Image (removing width and height) Scripts
function gp_image_scripts() {
	?>
		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function(){
				jQuery('.content img').each(function(){
					jQuery(this).removeAttr('width')
					jQuery(this).removeAttr('height');
				});
			});
		//]]>
		</script>
	<?php
}
add_action('wp_head', 'gp_image_scripts');
// END // Image (removing width and height) Scripts

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Shortcodes in Widgets
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
// END // Shortcodes in Widgets

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Languages
add_action('after_setup_theme', 'gp_theme_setup');
function gp_theme_setup(){
    load_theme_textdomain('gp', get_template_directory() . '/languages');
}
// END // Languages

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reCaptcha
if (!class_exists("reCAPTCHA")) { // If is activated reCaptcha plugin // http://wordpress.org/extend/plugins/wp-recaptcha/
	require_once(TEMPLATEPATH . '/forms/recaptchalib.php');
}

if (!class_exists("gp_recaptcha")) {
	
	function gp_recaptcha() {
		
		// reCaptcha Keys
		$gp_recaptcha_public_key = get_option('gp_recaptcha_public_key');
		$gp_recaptcha_private_key = get_option('gp_recaptcha_private_key');
		
		?>
        
        <div class="captcha input-box-wide left">
			<?php echo recaptcha_get_html($gp_recaptcha_public_key); ?>
            <?php if (isset($error_message['contact_captcha_error'])) { ?>
                <label for="recaptcha_challenge_field" class="error"><?php echo $error_message['contact_captcha_error']; ?></label>
            <?php } ?>
        </div>
        
        <?php
	
	}
	
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Create Admin
require_once (TEMPLATEPATH . '/admin/admin-functions.php');
// END // Create Admin

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

?>