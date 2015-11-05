jQuery(document).ready(function() {
								
	// GP Options Uploaders
	
	jQuery('#gp_logo_image_button').click(function() {
	
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#gp_logo_image').val(imgurl);
			tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		return false;
	
	});
	
	jQuery('#gp_body_bg_image_button').click(function() {
	
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#gp_body_bg_image').val(imgurl);
			tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		return false;
	
	});
	
	jQuery('#gp_favicon_button').click(function() {
	
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#gp_favicon').val(imgurl);
			tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		return false;
	
	});
	
	jQuery('#gp_login_logo_image_button').click(function() {
	
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#gp_login_logo_image').val(imgurl);
			tb_remove();
		}
		
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		return false;
	
	});
	
});