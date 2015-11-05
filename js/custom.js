// Hovers
jQuery(document).ready(function() {
	jQuery('.image-overlay a').hover(function() { jQuery(this).find('span').stop(false,true).fadeIn(400); },
    function() { jQuery(this).find('span').stop(false,true).fadeOut(200); });
});
// Pretty Photo
jQuery(document).ready(function(){ jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({show_title: false}); });
jQuery(document).ready(function(){ jQuery("a[rel^='prettyPhoto']").prettyPhoto({show_title: false}); });

// Scroll
jQuery(document).ready(function() {
	jQuery(".scroll").click(function(event){		
		event.preventDefault();
		jQuery('html,body').animate({scrollTop: jQuery(this.hash).offset().top}, 400);
	});
});

// Fixed Navigation
jQuery(document).ready(function() {
	jQuery('.navigation-menucard').stickySidebar({ 
		speed: 400,
		padding: 0,
		constrain: true
	});
});

// Dropdown Navigation for Mobile Devices
jQuery(document).ready(function() {

	jQuery('nav.navigation-mobile .select a').click(function(event){
		jQuery('nav.navigation-mobile .menu').fadeToggle(300);
	});

	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
		jQuery('nav.navigation-mobile .select a').bind('tap', function(event){
			jQuery('nav.navigation-mobile .menu').fadeToggle(300);
		});
	}
	
});