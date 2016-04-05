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
