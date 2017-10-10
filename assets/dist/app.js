// Initialize Foundation
jQuery(document).foundation();

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