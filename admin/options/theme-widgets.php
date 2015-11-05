<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Widgets
// - - - - - - - - - - - - - - - - - - - - - - -

function register_widgets() {
	register_widget('widget_about_box');
	register_widget('widget_tweets');
	register_widget('widget_contact');
	register_widget('widget_opening_hours');
	register_widget('widget_testimonial');
	register_widget('widget_reservation');
}
add_action( 'widgets_init', 'register_widgets' );

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Register Widgets

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Unregister Widgets
// - - - - - - - - - - - - - - - - - - - - - - -

function unregister_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
}
add_action('widgets_init', 'unregister_wp_widgets', 1);

// - - - - - - - - - - - - - - - - - - - - - - -
// END // Unregister Widgets

?>
