<?php
/*
Template Name: Page: Contact
*/
?>
<?php

// Error Messages
$contact_name_error = __('Please fill your name.', 'gp');
$contact_email_error = __('Please fill your email address.', 'gp');
$contact_email_invalid_error = __('Please fill the valid email address.', 'gp');
$contact_message_error = __('Please fill your message.', 'gp');
$contact_captcha_error = __('Please fill the valid captcha.', 'gp');

// reCaptcha Keys
$gp_recaptcha_public_key = get_option('gp_recaptcha_public_key');
$gp_recaptcha_private_key = get_option('gp_recaptcha_private_key');

if(isset($_POST['contact_submitted'])) {

	if (trim($_POST['contact_name']) === '') {
		$error_message['contact_name_error'] = $contact_name_error;
		$has_contact_error = true;
	} else {
		$name_field = trim($_POST['contact_name']);
	}
	
	$phone_field = trim($_POST['contact_phone']);

	if (trim($_POST['contact_email']) === '') {
		$error_message['contact_email_error'] = $contact_email_error;
		$has_contact_error = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contact_email']))) {
		$error_message['contact_email_invalid_error'] = $contact_email_invalid_error;
		$has_contact_error = true;
	} else {
		$email_field = trim($_POST['contact_email']);
	}

	if (trim($_POST['contact_message']) === '') {
		$error_message['contact_message_error'] = $contact_message_error;
		$has_contact_error = true;
	} else {
		if (function_exists('stripslashes')) {
			$message_field = stripslashes(trim($_POST['contact_message']));
		} else {
			$message_field = trim($_POST['contact_message']);
		}
	}
	
	if (get_option('gp_recaptcha') == 'Yes' && get_option('gp_recaptcha_public_key') != '' && get_option('gp_recaptcha_private_key') != '') {
		
		if (trim($_POST["recaptcha_response_field"])) {
			$resp = recaptcha_check_answer(
				$gp_recaptcha_private_key,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]
			);
		}
		
		if (!$resp->is_valid) {
			$error = $resp->error;
			$has_captcha_error = true;
			$error_message['contact_captcha_error'] = $contact_captcha_error;
		}
		
	}
	
	if(!isset($has_contact_error) && !isset($has_captcha_error)) {
		
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
							
							<tr style='border-bottom:1px solid #f5f5fa;'> 
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
		$h = implode("\r\n", $headers) . "\r\n";

		wp_mail($to, $subject, $body, $h);
		$has_contact_sent = true;
		
	}
}

?>
<?php get_header(); ?>
		
        <header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header><!-- page-header -->
        		
		<div class="content shadow-top left">
            <div class="content-container">
                
                <div class="page-full left">
                	<div class="page-full-container">
    
						<?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                        ?>
                                <?php if (!empty($post->post_content)) { ?>
                                <div class="content-page left">
                                    <div class="content-page-container">
                                        <?php the_content(); ?>
                                    </div><!-- content-page-container -->
                                </div><!-- content-page -->
                                <?php } ?>
                                
                                <?php if (isset($has_contact_sent) && $has_contact_sent == true) { ?>
                                    
                                    <div class="validation-success">
                                        <h4>
                                            <?php _e('Thank you. Email has been sent. We will contact you as soon as possible.', 'gp'); ?>
                                        </h4>
                                    </div>
                                    
                                <?php } else {  ?>
                                
                                    <?php if (isset($has_reservation_error)) { ?>
                                    
                                        <div class="validation-error">
                                            <h4>
												<?php _e('Sorry, an error occurred, email hasn\'t been sent.', 'gp'); ?>
                                            </h4>
                                        </div>
                                        
                                    <?php } else if (isset($has_captcha_error)) { ?>
                                    	
                                        <div class="validation-error">
                                            <h4>
												<?php _e('Please fill the valid captcha.', 'gp'); ?>
                                            </h4>
                                        </div>
                                        
                                    <?php } ?>
                    
                                    <div class="form-contact">
                                    	
                                        <?php if (get_option('gp_recaptcha_theme') != '') { 
											$gp_recaptcha_theme = get_option('gp_recaptcha_theme');
										} else {
											$gp_recaptcha_theme = 'clean';
										}
										?>
                                        
                                    	<script type="text/javascript">
											var RecaptchaOptions = {
												theme : '<?php echo $gp_recaptcha_theme; ?>'
											};
										</script>
                                        
                                        <form action="<?php the_permalink(); ?>" id="form-contact" class="form" method="post">
                                            
                                            <fieldset>
                                            
                                                <header class="form-header">
                                                    <h2><?php _e('Contact form', 'gp'); ?></h2>
                                                </header><!-- form-header -->
                                                    
                                                <div class="form-block first left">
                                            
                                                    <div class="input-box left">
                                                    
                                                        <label for="contact_name"><?php _e('Name', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                        <input name="contact_name" id="contact_name" class="required<?php if (isset($error_message['contact_name_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_name'])) { echo $_POST['contact_name']; } ?>" />
                                                        
                                                        <?php if (isset($error_message['contact_name_error'])) { ?>
                                                            <label for="contact_name" class="error"><?php echo $error_message['contact_name_error']; ?></label>
                                                        <?php } ?>
                                                        
                                                    </div><!-- input-box -->
                                                    
                                                    <div class="input-box left">
                                                    
                                                        <label for="contact_phone"><?php _e('Phone', 'gp'); ?>:</label><br />
                                                        <input name="contact_phone" id="contact_phone" type="text"  />
                                                    
                                                    </div><!-- input-box -->
                                                    
                                                    <div class="input-box last left">
                                                    
                                                        <label for="contact_email"><?php _e('Email', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                        <input name="contact_email" id="contact_email" class="required email<?php if (isset($error_message['contact_email_error']) ||  isset($error_message['contact_email_invalid_error'])) { ?> error<?php } ?>" type="text" value="<?php if (isset($_POST['contact_email'])) { echo $_POST['contact_email']; } ?>" />
                                                        
                                                        <?php if (isset($error_message['contact_email_error'])) { ?>
                                                            <label for="contact_email" class="error"><?php echo $error_message['contact_email_error']; ?></label>
                                                        <?php } ?>
                                                        <?php if (isset($error_message['contact_email_invalid_error'])) { ?>
                                                            <label for="contact_email" class="error"><?php echo $error_message['contact_email_invalid_error']; ?></label>
                                                        <?php } ?>
                                                        
                                                    </div><!-- input-box -->
                                                
                                                    <div class="input-box-wide left">
                                                    
                                                        <label for="contact_message"><?php _e('Message', 'gp'); ?>:</label> <span class="required-star">*</span><br />
                                                        <textarea name="contact_message" id="contact_message" class="required<?php if (isset($error_message['contact_message_error'])) { ?> error<?php } ?>" cols="110" rows="5"><?php if (isset($_POST['contact_message'])) { if (function_exists('stripslashes')) { echo stripslashes($_POST['contact_message']); } else { echo $_POST['contact_message']; } } ?></textarea>
                                                        
                                                        <?php if (isset($error_message['contact_message_error'])) { ?>
                                                            <label for="contact_message" class="error"><?php echo $error_message['contact_message_error']; ?></label>
                                                        <?php } ?>
                                                        
                                                    </div><!-- input-box-wide -->

                                                <br class="clear" />
                                                </div><!-- form-block -->
            									
                                                <?php
												if (get_option('gp_recaptcha') == 'Yes' && get_option('gp_recaptcha_public_key') != '' && get_option('gp_recaptcha_private_key') != '') {
													if (function_exists('gp_recaptcha')) { gp_recaptcha(); } 
												}
												?>
                                                 
                                                <div class="buttons left">

                                                	<input type="hidden" name="contact_submitted" id="contact_submitted" value="true" />
                                                    <button type="submit" name="button-submit" class="button-standard left" title="<?php _e('Send email', 'gp'); ?>">
														<?php _e('Send email', 'gp'); ?>
													</button>
                                                    <div class="required-star-info">* <?php _e('Required fields', 'gp'); ?></div>
                                                    
                                                <br class="clear" />
                                                </div><!-- buttons -->
    
                                            </fieldset>
                                            
                                        <br class="clear" />
                                        </form>
                                        
                                    </div><!-- form-contact -->
                            
                                <?php } ?>
                                
                        <?php 
                            } //while
                        } //if
                        wp_reset_query();
                        ?>
    					
                    <br class="clear" />
                    </div><!-- page-full-container -->
                </div><!-- page-full -->
                
            <br class="clear" />
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>