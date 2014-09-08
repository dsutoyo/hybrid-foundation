// Initialize Foundation
jQuery(document).foundation();

jQuery(document).ready(function() {

	// name the wide dropdowns
	var topLevelItems = jQuery('.top-bar-section > ul > li.has-dropdown').map( function() {
		var topWidth = jQuery('#' + this.id).width();
		var childWidth = jQuery('#' + this.id + ' .dropdown').width();
		//console.log(childWidth);console.log(topWidth);console.log(this.id);
		if ( childWidth > topWidth ) {
			jQuery('#' + this.id + ' .dropdown').addClass('wide');
		}
	});

	jQuery('.left-off-canvas-menu ul > li > a + span').on('click', function() {
		jQuery(this).children('i').toggleClass('open');
		jQuery(this).parent().children('.submenu').slideToggle();
	});
});