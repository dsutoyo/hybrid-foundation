<?php
/**
 * Custom Filters.
 *
 * @package    Hybrid Foundation
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

# Add a class to the body
add_filter( 'hybrid_attr_body', 'hybrid_base_attr_body', 6 );

# Add a class to the branding
add_filter( 'hybrid_attr_branding', 'hybrid_base_attr_branding', 6 );

# Filter the theme layout class
add_filter( 'theme_mod_theme_layout', 'hybrid_base_theme_layout', 5 );

# Filter the default form options
add_filter( 'comment_form_defaults', 'hybrid_base_comment_form_defaults' );

# Add support for breadcrumbs
add_filter( 'breadcrumb_trail_args', 'hybrid_base_breadcrumb_trail_args' );
add_filter( 'breadcrumb_trail', 'hybrid_base_breadcrumb_trail', 5, 2 );

/**
 * Filter the body attributes.
 *
 * @since  1.1.0
 * @access public
 * @return array
 */
function hybrid_base_attr_body( $attr ) {
	global $post;

	$attr['class'] .= ' no-js';

	if ( current_theme_supports( 'fixed-width-header' ) ) {
		$attr['class'] .= ' fixed-width-header';
	}

	if ( current_theme_supports( 'fixed-width-footer' ) ) {
		$attr['class'] .= ' fixed-width-footer';
	}

	if ( hybrid_foundation_get_option( 'layout_container' ) ) {
		$attr['class'] .= ' container-body-' . hybrid_foundation_get_option( 'layout_container' );
	}

	if ( $singular_layout = get_post_meta( $post->ID, 'hybrid-foundation-container-post-layout', true ) ) {
		$attr['class'] .= ' container-singular-' . $singular_layout;
	}

	else if ( is_page() && hybrid_foundation_get_option( 'layout_container_page' ) ) {
		$attr['class'] .= ' container-page-' . hybrid_foundation_get_option( 'layout_container_page' );
	}

	else if ( is_single() && hybrid_foundation_get_option( 'layout_container_post' ) ) {
		$attr['class'] .= ' container-post-' . hybrid_foundation_get_option( 'layout_container_post' );
	}

	else if ( is_archive() && hybrid_foundation_get_option( 'layout_container_archive' ) ) {
		$attr['class'] .= ' container-archive-' . hybrid_foundation_get_option( 'layout_container_archive' );
	}

	if ( hybrid_foundation_get_option( 'layout_container_header' ) ) {
		$attr['class'] .= ' container-header-' . hybrid_foundation_get_option( 'layout_container_header' );
	}

	if ( hybrid_foundation_get_option( 'layout_container_footer' ) ) {
		$attr['class'] .= ' container-footer-' . hybrid_foundation_get_option( 'layout_container_footer' );
	}

	return $attr;
}

/**
 * Filter the branding attributes.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_attr_branding( $attr ) {
	$attr['class'] = 'title-area menu';
	return $attr;
}

/**
 * Filters the default theme layout. Metaboxes options should still be able
 * to override these.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_theme_layout( $theme_layout ) {

	/* If viewing a singular post, get the post layout. */
	if ( is_singular() )
		$layout = hybrid_get_post_layout( get_queried_object_id() );

	/* If viewing an author archive, get the user layout. */
	elseif ( is_author() )
		$layout = hybrid_get_user_layout( get_queried_object_id() );

	/* If a layout was found, set it. */
	if ( !empty( $layout ) && 'default' !== $layout ) {
		$theme_layout = $layout;
	}

	else {
		if ( is_page() ) {
			$theme_layout = hybrid_foundation_get_option( 'layout_content_page' );
		}

		elseif ( is_single() ) {
			$theme_layout = hybrid_foundation_get_option( 'layout_content_post' );
		}

		elseif ( is_archive() ) {
			$theme_layout = hybrid_foundation_get_option( 'layout_content_archive' );
		}
	}

	return $theme_layout;
}

/**
 * Filters the default comment form options.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_comment_form_defaults( $defaults ) {

	/* Change the defaults depending on your requirements */
	//$defaults['title_reply'] = __( 'Submit a Comment', 'hybrid-base' );

	return $defaults;
}

/**
 * Adjust the args for breadcrumbs
 *
 * @since  2.0.0
 * @access public
 * @return array
 */
function hybrid_base_breadcrumb_trail_args( $args ) {
	$args['show_browse'] = false;
	return $args;
}

/**
 * Filter the class names for the breadcrumbs
 *
 * @since  2.0.0
 * @access public
 * @return array
 */
function hybrid_base_breadcrumb_trail( $breadcrumb, $args ) {
	$breadcrumb = str_replace( 'breadcrumb-trail breadcrumbs', 'breadcrumb-trail', $breadcrumb );
	$breadcrumb = str_replace( 'ul class="trail-items"', 'ul class="breadcrumbs trail-items', $breadcrumb );
	return $breadcrumb;
}