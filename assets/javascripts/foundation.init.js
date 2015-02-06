// Initialize Foundation
jQuery(document).foundation();

/*
 * Making things work with Foundation
 */
jQuery(document).ready(function() {

	/*
	 * Name the wide dropdowns. Not really used, but here just in case
	 */
	var topLevelItems = jQuery('.top-bar-section > ul > li.has-dropdown').map( function() {
		var topWidth = jQuery('#' + this.id).width();
		var childWidth = jQuery('#' + this.id + ' .dropdown').width();
		//console.log(childWidth);console.log(topWidth);console.log(this.id);
		if ( childWidth > topWidth ) {
			jQuery('#' + this.id + ' .dropdown').addClass('wide');
		}
	});

	/*
	 * Off-canvas
	 */
	jQuery('.left-off-canvas-menu .menu-item-has-children > a').after('<span><i></i></span>');

	jQuery('.left-off-canvas-menu .menu-item-has-children > span').on('click', function() {
		jQuery(this).children('i').toggleClass('open');
		jQuery(this).parent().children('.sub-menu').slideToggle();
	});

	/*
	 * Video and other embeds.  Let's make them more responsive.	
	 */

	/* Overrides WP's <div> wrapper around videos, which mucks with flexible videos. */
	jQuery( 'div[style*="max-width: 100%"] > video' ).parent().css( 'width', '100%' );

	/* Responsive videos. */
	/* blip.tv adds a second <embed> with "display: none".  We don't want to wrap that. */
	jQuery( '.entry object, .entry embed, .entry iframe' ).not( 'embed[style*="display"], [src*="soundcloud.com"], [src*="amazon"], [name^="gform_"]' ).wrap( '<div class="flex-video" />' );

	/* Removes the 'width' attribute from embedded videos and replaces it with a max-width. */
	jQuery( '.embed-wrap object, .embed-wrap embed, .embed-wrap iframe' ).attr( 
		'width',
		function( index, value ) {
			jQuery( this ).attr( 'style', 'max-width: ' + value + 'px;' );
			jQuery( this ).removeAttr( 'width' );
		}
	);
});