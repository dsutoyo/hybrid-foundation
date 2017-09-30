// Initialize Foundation
jQuery(document).foundation();

/*
 * Popup Nav
 */
jQuery('.popup-navigation-trigger').on('click', function(e) {
	jQuery('body').addClass('popup-active');
	e.preventDefault();
});

jQuery('.popup-navigation-close').on('click', function(e) {
	jQuery('body').removeClass('popup-active');
	e.preventDefault();
});

jQuery(document).ready(function($) {
	$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(function() {
		var parent_class = $(this).parent().attr('class');

		if ( $(this).innerWidth() / $(this).innerHeight() > 1.5 ) {
			$(this).wrap("<div class='widescreen responsive-embed'/>");
		}

		else {
			$(this).wrap("<div class='responsive-embed'/>");
		}
	});
});