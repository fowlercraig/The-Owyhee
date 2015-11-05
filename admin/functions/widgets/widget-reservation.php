<?php

// Widget - Reservation

class widget_reservation extends WP_Widget {

	function widget_reservation() {
		$widget_ops = array (
			'classname' => 'widget_reservation',
			'description' => __('Widget that displays reservation form.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_reservation'
		);
		$this->WP_Widget (
			'widget_reservation',
			__('Linguini: Quick reservation', 'gp'),
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		$box_title = apply_filters('widget_title', $instance['box_title'] );
		$box_content = '<p>' . do_shortcode($instance['box_content']) . '</p>';
		echo $before_widget;
		if ( $box_title )
			echo $before_title . $box_title . $after_title;
		if ( $box_content )
			printf( __('%1$s', 'widget_reservation'), $box_content );
    
	?>
    
    <?php
	
	// Titles
	$reservation_quick_datepicker_title = __('Date', 'gp');
	$reservation_quick_time_title = __('Time', 'gp');
	$reservation_quick_persons_title = __('Number of Persons', 'gp');
	$reservation_quick_name_title = __('Name', 'gp');
	$reservation_quick_phone_title = __('Phone', 'gp');
	$reservation_quick_email_title = __('Email', 'gp');
	
	// Error Messages
	$reservation_quick_datepicker_error = __('Please select a date.', 'gp');
	$reservation_quick_time_error = __('Please fill the time.', 'gp');
	$reservation_quick_persons_error = __('Please fill the number of persons.', 'gp');
	$reservation_quick_name_error = __('Please fill your name.', 'gp');
	$reservation_quick_phone_error = __('Please fill your phone number.', 'gp');
	$reservation_quick_email_error = __('Please fill your email address.', 'gp');
	$reservation_quick_email_invalid_error = __('Please fill the valid email address.', 'gp');

	if(isset($_POST['reservation_quick_submitted'])) {
	
		if (trim($_POST['reservation_quick_datepicker']) === '' || trim($_POST['reservation_quick_datepicker']) == $reservation_quick_datepicker_title) {
			$quick_error_message['reservation_quick_datepicker_error'] = $reservation_quick_datepicker_error;
			$has_reservation_quick_error = true;
		} else {
			$date_field = trim($_POST['reservation_quick_datepicker']);
		}
		
		if(trim($_POST['reservation_quick_time']) === '' || trim($_POST['reservation_quick_time']) == $reservation_quick_time_title) {
			$quick_error_message['reservation_quick_datepicker_error'] = $reservation_quick_time_error;
			$has_error = true;
		} else {
			$time_field = trim($_POST['reservation_quick_time']);
		}
		
		if (trim($_POST['reservation_quick_persons']) === '' || trim($_POST['reservation_quick_persons']) == $reservation_quick_persons_title) {
			$quick_error_message['reservation_quick_persons_error'] = $reservation_quick_persons_error;
			$has_reservation_quick_error = true;
		} else {
			$persons_field = trim($_POST['reservation_quick_persons']);
		}
		
		if (trim($_POST['reservation_quick_name']) === '' || trim($_POST['reservation_quick_name']) == $reservation_quick_name_error) {
			$quick_error_message['reservation_quick_name_error'] = $reservation_quick_name_error;
			$has_reservation_quick_error = true;
		} else {
			$name_field = trim($_POST['reservation_quick_name']);
		}
		
		if (trim($_POST['reservation_quick_phone']) === '' || trim($_POST['reservation_quick_phone']) == $reservation_quick_phone_title) {
			$quick_error_message['reservation_quick_phone_error'] = $reservation_quick_phone_error;
			$has_reservation_quick_error = true;
		} else {
			$phone_field = trim($_POST['reservation_quick_phone']);
		}
	
		if (trim($_POST['reservation_quick_email']) === '') {
			$quick_error_message['reservation_quick_email_error'] = $reservation_quick_email_error;
			$has_reservation_quick_error = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['reservation_quick_email']))) {
			$quick_error_message['reservation_quick_email_invalid_error'] = $reservation_quick_email_invalid_error;
			$has_reservation_quick_error = true;
		} else {
			$email_field = trim($_POST['reservation_quick_email']);
		}
		
		if (trim($_POST['reservation_quick_protection']) === '') {
			$protection_field = trim($_POST['reservation_quick_protection']);
		} else {
			$has_reservation_quick_error = true;
		}
	
		if(!isset($has_reservation_quick_error)) {
			
			$date_title = __('Date and time:', 'gp');
			$persons_title = __('Number of Persons:', 'gp');
			$name_title = __('Name:', 'gp');
			$phone_title = __('Phone:', 'gp');
			$email_title = __('Email:', 'gp');
			$message_title = __('Message:', 'gp');
		
			$to = get_option('gp_form_reservations_email');
			if (!isset($to) || ($to == '') ){
				$to = get_option('admin_email');
			}
			if (get_option('gp_form_reservations_subject' != '')) {
				$subject = get_option('gp_form_reservations_subject');	
			} else {
				$subject = __('Reservation Form', 'gp');
			}
			$body = "
	
			<html>
			<body style='font-family:Arial, Verdana, Tahoma, sans-serif;margin:0;padding:0;font-size:12px;color:#50505a;'>
			
				<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f5fa'>
		
					<tr>
						<td style='background:#f5f5fa;' align='center'>
							
							<table width='600' border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='padding:15px 30px 30px 30px; margin:30px 0;'>
					
								<tr>
									<th colspan='2' style='text-align: left;'><h1 style='font-size:22px;padding-bottom:10px;'>$subject</h1></th>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$date_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$date_field, $time_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$persons_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$persons_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$name_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$name_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$phone_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$phone_field
									</td>
								</tr>
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$email_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$email_field
									</td>
								</tr>
								
							</table>
							
						</td>
					</tr>
				
				</table>
			
			</body>
			</html>
			
			";
			
			$headers = array('From: ' . $name_field . ' <' . $email_field . '>', 'Content-Type: text/html', 'Reply-To:' . $email_field);
			$h = implode("\r\n",$headers) . "\r\n";
	
			wp_mail($to, $subject, $body, $h);
			$has_reservation_quick_sent = true;
			
		}
	}
	
	?>
    
		<script type="text/javascript">
        //<![CDATA[
			jQuery(document).ready(function() {
				jQuery("#form-reservation-quick").validate({
					messages: {
						reservation_quick_datepicker: '',
						reservation_quick_time: '',
						reservation_quick_persons: '',
						reservation_quick_name: '',
						reservation_quick_phone: '',
						reservation_quick_email: '',
						reservation_quick_email: {
							required: '',
							email: ''
						}
					},
					onkeyup: false,
					onblur: false,
					onclick: false,
					ignoreTitle: true,
					rules: {
						reservation_quick_datepicker: 'reservation_quick_datepicker',
						reservation_quick_time: 'reservation_quick_time',
						reservation_quick_persons: 'reservation_quick_persons',
						reservation_quick_name: 'reservation_quick_name',
						reservation_quick_phone: 'reservation_quick_phone',
						reservation_quick_email: 'reservation_quick_email'
					}
				});
				jQuery.validator.addMethod("reservation_quick_datepicker", function(value) { return value != '<?php echo $reservation_quick_datepicker_title; ?>'; });
				jQuery.validator.addMethod("reservation_quick_hour", function(value) { return value != '<?php echo $reservation_quick_hour_title; ?>'; });
				jQuery.validator.addMethod("reservation_quick_minutes", function(value) { return value != '<?php echo $reservation_quick_minutes_title; ?>'; });
				jQuery.validator.addMethod('reservation_quick_persons', function(value) { return value != '<?php echo $reservation_quick_persons_title; ?>'; });
				jQuery.validator.addMethod('reservation_quick_name', function(value) { return value != '<?php echo $reservation_quick_name_title; ?>'; });
				jQuery.validator.addMethod('reservation_quick_phone', function(value) { return value != '<?php echo $reservation_quick_phone_title; ?>'; });
				jQuery.validator.addMethod('reservation_quick_email', function(value) { return value != '<?php echo $reservation_quick_email_title; ?>'; });
			});
			jQuery(function() {
				jQuery("#reservation_quick_datepicker").datepicker({ 
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
        
        <?php if (isset($has_reservation_quick_sent) && $has_reservation_quick_sent == true) { ?>
                                    
            <div class="validation-success-quick validation-success">
                <h4>
                    <?php _e('Thank you. Email has been sent. Our staff will confirm you the booking by email or SMS.', 'gp'); ?>
                </h4>
            </div>
            
        <?php } else {  ?>
        
            <?php if (isset($has_reservation_quick_error)) { ?>
            
                <div class="validation-error-quick validation-error">
                    <h4>
						<?php _e('Sorry, an error occurred, email hasn\'t been sent.', 'gp') ?>
                    </h4>
                </div>
                
            <?php } ?>

            <div class="form-reservation-quick">
                
                <form action="" id="form-reservation-quick" class="form form-widget" method="post">
                    
                    <fieldset>
    
                        <div class="form-block left">
                            
                            <h4><?php _e('Reservation information', 'gp'); ?></h4>
                            
                            <div class="input-box-thin left">
                                
                                <input name="reservation_quick_datepicker" id="reservation_quick_datepicker" class="required<?php if (isset($quick_error_message['reservation_quick_datepicker_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_datepicker'])) { echo $_POST['reservation_quick_datepicker']; } else { echo $reservation_quick_datepicker_title; } ?>" />
                            
                            </div>
                            
                            <div class="input-box-quick left">
                            
                                <input name="reservation_quick_time" id="reservation_quick_time" class="required<?php if (isset($quick_error_message['reservation_quick_time_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_time'])) { echo $_POST['reservation_quick_time']; } else { echo $reservation_quick_time_title; } ?>" />
                                
                            </div>
                                    
                            <div class="input-box-thin last left">
                                
                                <input name="reservation_quick_persons" id="reservation_quick_persons" class="required number<?php if (isset($quick_error_message['reservation_quick_minutes_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_persons'])) { echo $_POST['reservation_quick_persons']; } else { echo $reservation_quick_persons_title; } ?>" />
                                
                            </div>
                                      
                        </div>
                        
                        <div class="form-block left">
                                    
                            <h4><?php _e('Personal Information', 'gp'); ?></h4>
                            
                            <div class="input-box-thin left">
                            
                                <input name="reservation_quick_name" id="reservation_quick_name" class="required<?php if (isset($quick_error_message['reservation_quick_minutes_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_name'])) { echo $_POST['reservation_quick_name']; } else { echo $reservation_quick_name_title; } ?>" />
                            
                            </div>
                            
                            <div class="input-box-thin left">
                            
                                <input name="reservation_quick_phone" id="reservation_quick_phone" class="required<?php if (isset($quick_error_message['reservation_quick_phone_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_phone'])) { echo $_POST['reservation_quick_phone']; } else { echo $reservation_quick_phone_title; } ?>" />
                                
                            </div>
                            
                            <div class="input-box-thin last left">
                            
                                <input name="reservation_quick_email" id="reservation_quick_email" class="required email<?php if (isset($error_message['reservation_quick_email_error']) ||  isset($error_message['reservation_quick_email_invalid_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['reservation_quick_email'])) { echo $_POST['reservation_quick_email']; } else { echo $reservation_quick_email_title; } ?>" />
                                
                            </div>
                            
                            <input name="reservation_quick_protection" id="reservation_quick_protection" type="text" class="no-display" value="" />
                            
                        </div>
    
                        <div class="buttons left">
                        
                            <input type="hidden" name="reservation_quick_submitted" id="reservation_quick_submitted" value="true" />
                            <button type="submit" name="button-submit" class="button-standard">
                                <?php _e('Make a reservation', 'gp'); ?>
                            </button>
                            
                        <br class="clear" />
                        </div>
                    
                    </fieldset>
                    
                <br class="clear" />	
                </form>
                
            </div><!-- form-reservation-quick -->
                
        <?php } ?>

		<script type="text/javascript">
            // Date
            jQuery('input[name=reservation_quick_datepicker]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_datepicker_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_datepicker]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_datepicker_title; ?>'); });
            // Time
            jQuery('input[name=reservation_quick_time]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_time_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_time]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_time_title; ?>'); });
            // Number of Persons
            jQuery('input[name=reservation_quick_persons]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_persons_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_persons]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_persons_title; ?>'); });
            // Name
            jQuery('input[name=reservation_quick_name]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_name_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_name]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_name_title; ?>'); });
            // Phone
            jQuery('input[name=reservation_quick_phone]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_phone_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_phone]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_phone_title; ?>'); });
            // Email
            jQuery('input[name=reservation_quick_email]').focus(function(){ if (jQuery(this).val() == '<?php echo $reservation_quick_email_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=reservation_quick_email]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $reservation_quick_email_title; ?>'); });
        </script>
    
    <?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['box_title'] = $new_instance['box_title'];
		$instance['box_content'] = $new_instance['box_content'];
		$instance['email'] = $new_instance['email'];
		$instance['subject'] = $new_instance['subject'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'box_title' => __('Quick reservation', 'gp')
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		 
		$box_title = isset($instance['box_title']) ? esc_attr($instance['box_title']) : '';
		$box_content = isset($instance['box_content']) ? esc_attr($instance['box_content']) : '';
		
		?>

            <p>
                <label for="<?php echo $this->get_field_id('box_title'); ?>"><?php _e('Title', 'gp'); ?>:</label>
                <input id="<?php echo $this->get_field_id('box_title'); ?>" name="<?php echo $this->get_field_name('box_title'); ?>" value="<?php echo $box_title; ?>" style="width:100%;" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('box_content'); ?>"><?php _e('Content', 'gp'); ?>:</label>
                <textarea id="<?php echo $this->get_field_id('box_content'); ?>" name="<?php echo $this->get_field_name('box_content'); ?>" style="width:100%;height:150px;"><?php echo $box_content; ?></textarea>
            </p>
	
    	<?php
	}
}

// END // Widget - Reservation

?>