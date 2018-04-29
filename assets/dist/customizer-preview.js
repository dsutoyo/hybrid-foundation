(function($) {

	wp.customize('custom_logo_height', function(value) {
		value.bind( function(newval) {
			var ratio = ($('.site-title a').outerWidth()) / ($('.site-title a').outerHeight());
			$('.site-title a').css({'height': newval+'px', 'width': ratio*newval+'px'});
			console.log(ratio*newval+'px');
		});
	});

	wp.customize('layout_container', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('container-body-contained container-body-full-width container-body-boxed').addClass('container-body-' + newval);
		});
	});

	wp.customize('layout_container_header', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('container-header-contained container-header-full-width container-header-boxed').addClass('container-header-' + newval);
		});
	});

	wp.customize('layout_container_footer', function(value) {
		value.bind( function(newval) {
			$('body').removeClass('container-footer-contained container-footer-full-width container-footer-boxed').addClass('container-footer-' + newval);
		});
	});

	wp.customize('layout_container_page', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('singular-page') ) {
				$('body').removeClass('container-page-contained container-page-full-width container-page-boxed').addClass('container-page-' + newval);
			}
		});
	});

	wp.customize('layout_container_post', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('singular-post') ) {
				$('body').removeClass('container-post-contained container-post-full-width container-post-boxed').addClass('container-post-' + newval);
			}
		});
	});

	wp.customize('layout_container_archive', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('archive') || $('body').hasClass('blog') ) {
				$('body').removeClass('container-archive-contained container-archive-full-width container-archive-boxed').addClass('container-archive-' + newval);
			}
		});
	});

	wp.customize('layout_content_page', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('singular-page') ) {
				var classes = $('body').attr('class').replace( /\slayout-[a-zA-Z0-9_-]*/g, '' );
				$('body').attr('class', classes).addClass('layout-' + newval);

				if (newval == '1c') {
					$('.sidebar-primary').hide();
				}

				else {
					$('.sidebar-primary').show();
				}
			}
		});
	});

	wp.customize('layout_content_post', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('singular-post') ) {
				var classes = $('body').attr('class').replace( /\slayout-[a-zA-Z0-9_-]*/g, '' );
				$('body').attr('class', classes).addClass('layout-' + newval);

				if (newval == '1c') {
					$('.sidebar-secondary').hide();
				}

				else {
					$('.sidebar-secondary').show();
				}
			}
		});
	});

	wp.customize('layout_content_archive', function(value) {
		value.bind( function(newval) {
			if ( $('body').hasClass('archive') ) {
				var classes = $('body').attr('class').replace( /\slayout-[a-zA-Z0-9_-]*/g, '' );
				$('body').attr('class', classes).addClass('layout-' + newval);

				if (newval == '1c') {
					$('.sidebar-secondary').hide();
				}

				else {
					$('.sidebar-secondary').show();
				}
			}
		});
	});
	
})(jQuery);