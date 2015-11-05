<?php

// Widget - contact

class widget_contact extends WP_Widget {

	function widget_contact() {
		$widget_ops = array (
			'classname' => 'widget_contact',
			'description' => __('Widget that displays contact form.', 'gp')
		);
		$control_ops = array (
			'width' => 500,
			'heigth' => 500,
			'id_base' => 'widget_contact'
		);
		$this->WP_Widget (
			'widget_contact',
			__('Linguini: Contact form', 'gp'),
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
			printf( __('%1$s', 'widget_contact'), $box_content );
    
	?>
    
    <?php
	
	// Titles
	$contact_quick_name_title = __('Name', 'gp');
	$contact_quick_phone_title = __('Phone', 'gp');
	$contact_quick_email_title = __('Email', 'gp');
	$contact_quick_message_title = __('Message', 'gp');
	
	// Error Messages
	$contact_quick_name_error = __('Please fill your name.', 'gp');
	$contact_quick_phone_error = __('Please fill your phone number.', 'gp');
	$contact_quick_email_error = __('Please fill your email address.', 'gp');
	$contact_quick_email_invalid_error = __('Please fill the valid email address.', 'gp');
	$contact_quick_message_error = __('Please fill your message.', 'gp');
    
	if (isset($_POST['contact_quick_submitted'])) {
		
		if (trim($_POST['contact_quick_name']) === '' || trim($_POST['contact_quick_name']) == $contact_quick_name_title) {
			$quick_error_message['contact_quick_name_error'] = $contact_quick_name_error;
			$has_contact_quick_error = true;
		} else {
			$name_field = trim($_POST['contact_quick_name']);
		}
		
		$phone_field = trim($_POST['contact_quick_phone']);
	
		if (trim($_POST['contact_quick_email']) === '') {
			$quick_error_message['contact_quick_email_error'] = $contact_quick_email_error;
			$has_contact_quick_error = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contact_quick_email']))) {
			$quick_error_message['contact_quick_email_invalid_error'] = $contact_quick_email_invalid_error;
			$has_contact_quick_error = true;
		} else {
			$email_field = trim($_POST['contact_quick_email']);
		}
		
		if(trim($_POST['contact_quick_message']) === '' || trim($_POST['contact_quick_message']) == $contact_quick_message_title) {
			$quick_error_message['contact_quick_message_error'] = $contact_quick_message_error;
			$has_contact_quick_error = true;
		} else {
			$message_field = trim($_POST['contact_quick_message']);
		}
		
		if (trim($_POST['contact_quick_protection']) === '') {
			$protection_field = trim($_POST['contact_quick_protection']);
		} else {
			$has_contact_quick_error = true;
		}
	
		if(!isset($has_contact_quick_error)) {
			
			$name_title = __('Name:', 'gp');
			$phone_title = __('Phone:', 'gp');
			$email_title = __('Email:', 'gp');
			$message_title = __('Message:', 'gp');
		
			$to = get_option('gp_form_contact_email');
			if (!isset($to) || ($to == '') ){
				$to = get_option('admin_email');
			}
			if (get_option('gp_form_contact_subject' != '')) {
				$subject = get_option('gp_form_contact_subject');	
			} else {
				$subject = __('Contact Form', 'gp');
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
								
								<tr> 
									<th style='text-align:left;width:150px;padding:7px 0;border-bottom:1px solid #f5f5fa;'>
										$message_title
									</th>
									<td style='padding:7px 0;border-bottom:1px solid #f5f5fa;'> 
										$message_field
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
			$has_contact_quick_sent = true;
			
		}
	}
	
	?>
    
		<script type="text/javascript">
        //<![CDATA[
			jQuery(document).ready(function() {
				jQuery("#form-contact-quick").validate({
					onkeyup: false,
					onblur: false,
					onclick: false,
					ignoreTitle: true,
					rules: {
						contact_quick_name: 'contact_quick_name',
						contact_quick_email: 'contact_quick_email',
						contact_quick_message: 'contact_quick_message'
					},
					messages: {
						contact_quick_name: '',
						contact_quick_email: {
							required: '',
							email: ''
						},
						contact_quick_phone: '',
						contact_quick_message: ''
					}
				});
				jQuery.validator.addMethod('contact_quick_name', function(value) { return value != '<?php echo $contact_quick_name_title; ?>'; });
				jQuery.validator.addMethod('contact_quick_email', function(value) { return value != '<?php echo $contact_quick_email_title; ?>'; });
				jQuery.validator.addMethod('contact_quick_message', function(value) { return value != '<?php echo $contact_quick_message_title; ?>'; });
			});
		//]]>
		</script>
        
        <?php if (isset($has_contact_quick_sent) && $has_contact_quick_sent == true) { ?>
                                    
            <div class="validation-success-quick validation-success">
                <h4>
                    <?php _e('Thank you. Email has been sent. We will contact you as soon as possible.', 'gp'); ?>
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

            <div class="form-contact-quick">
                
                <form action="" id="form-contact-quick" class="form form-widget" method="post">
                    
                    <fieldset>
                        
                        <div class="form-block left">
                            
                            <div class="input-box-quick left">
                            
                                <input name="contact_quick_name" id="contact_quick_name" class="required<?php if (isset($quick_error_message['contact_quick_name_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_quick_name'])) { echo $_POST['contact_quick_name']; } else { echo $contact_quick_name_title; } ?>" />
                                
                            </div><!-- input-box -->
                            
                            <div class="input-box-quick left">
                            
                                <input name="contact_quick_phone" id="contact_quick_phone" type="text" value="<?php if (isset($_POST['contact_quick_phone'])) { echo $_POST['contact_quick_phone']; } else { echo $contact_quick_phone_title; } ?>" />
                                
                            </div><!-- input-box -->
                            
                            <div class="input-box-quick left">
                            
                                <input name="contact_quick_email" id="contact_quick_email" class="required email<?php if (isset($error_message['contact_quick_email_error']) ||  isset($error_message['contact_quick_email_invalid_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_quick_email'])) { echo $_POST['contact_quick_email']; } else { echo $contact_quick_email_title; } ?>" />
                            
                            </div><!-- input-box -->
                            
                            <div class="input-box-quick left">
                            
                                <textarea name="contact_quick_message" id="contact_quick_message" class="required<?php if (isset($quick_error_message['contact_quick_message_error'])) { ?> error<?php } ?>" cols="110" rows="5"><?php if (isset($_POST['contact_quick_message'])) { echo $_POST['contact_quick_message']; } else { echo $contact_quick_message_title; } ?></textarea>
                                
                            </div><!-- input-box -->
                            
                            <input name="contact_quick_protection" id="contact_quick_protection" type="text" class="no-display" value="" />
                            
                        </div><!-- form-block -->
    
                        <div class="buttons left">
                        	
                            <input type="hidden" name="contact_quick_submitted" id="contact_quick_submitted" value="true" />
                            <button type="submit" name="button-submit" class="button-standard">
								<?php _e('Send email', 'gp'); ?>
							</button>
                            
                        <br class="clear" />
                        </div>
                    
                    </fieldset>
                    
                <br class="clear" />	
                </form>
                
			</div><!-- form-contact-quick -->
            
		<?php } ?>

		<script type="text/javascript">
            // Name
            jQuery('input[name=contact_quick_name]').focus(function(){ if (jQuery(this).val() == '<?php echo $contact_quick_name_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=contact_quick_name]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $contact_quick_name_title; ?>'); });
            // Phone
            jQuery('input[name=contact_quick_phone]').focus(function(){ if (jQuery(this).val() == '<?php echo $contact_quick_phone_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=contact_quick_phone]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $contact_quick_phone_title; ?>'); });
            // Email
            jQuery('input[name=contact_quick_email]').focus(function(){ if (jQuery(this).val() == '<?php echo $contact_quick_email_title; ?>') jQuery(this).val(''); });
            jQuery('input[name=contact_quick_email]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $contact_quick_email_title; ?>'); });
            // Message
            jQuery('textarea[name=contact_quick_message]').focus(function(){ if (jQuery(this).val() == '<?php echo $contact_quick_message_title; ?>') jQuery(this).val(''); });
            jQuery('textarea[name=contact_quick_message]').blur(function(){ if (jQuery(this).val() == '') jQuery(this).val('<?php echo $contact_quick_message_title; ?>'); });
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
			'box_title' => __('Quick contact', 'gp')
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

// END // Widget - contact

?>