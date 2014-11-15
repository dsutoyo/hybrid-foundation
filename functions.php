<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    HybridFoundation
 * @subpackage Functions
 * @version    0.1
 * @author     David Sutoyo <david@smallharbor.com>
 * @copyright  Copyright (c) 2013 - 2014, David Sutoyo
 * @link       https://github.com/dsutoyo/hybrid-base
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get the template directory and make sure it has a trailing slash. */
$hybrid_base_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and theme files. */
require_once( $hybrid_base_dir . 'library/hybrid.php'        );
require_once( $hybrid_base_dir . 'inc/custom-background.php' );
require_once( $hybrid_base_dir . 'inc/custom-header.php'     );
require_once( $hybrid_base_dir . 'inc/theme.php'             );
require_once( $hybrid_base_dir . 'inc/walker.php'             );

/* Launch the Hybrid Core framework. */
new Hybrid();

/* Define Constants. */
// Theme Version
define( 'THEME_VERSION', '0.1' );
// Specify our Foundation version
define( 'FOUNDATION_VERSION', '5.4.7');

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'hybrid_base_theme_setup', 5 );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_theme_setup() {

	/* Theme layouts. */
	add_theme_support( 
		'theme-layouts', 
		array(
			'1c'        => __( '1 Column',                     'hybrid-base' ),
			'2c-l'      => __( '2 Columns: Content / Sidebar', 'hybrid-base' ),
			'2c-r'      => __( '2 Columns: Sidebar / Content', 'hybrid-base' )
		),
		array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) 
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Breadcrumbs. Yay! */
	add_theme_support( 'breadcrumb-trail' );

	/* Pagination. */
	add_theme_support( 'loop-pagination' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	add_theme_support( 'foundation-base' );
	add_theme_support( 'foundation-topbar' );
	add_theme_support( 'foundation-offcanvas' );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 1280 );

	add_filter( 'hybrid_attr_branding', 'hybrid_base_attr_branding', 6 );


	// ===== Foundation
	if ( current_theme_supports( 'foundation-base' ) ) {
		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/assets/javascripts/foundation/foundation.js', 'jquery', FOUNDATION_VERSION, true );
	}

	// ===== Load Foundation components if supported by the theme
	$foundation_components = array(
		'abide', 'accordion', 'alert', 'clearing', 'dropdown', 'equalizer', 'interchange', 'joyride', 'magellan', 'offcanvas', 'orbit', 'reveal', 'slider', 'tab', 'tooltip', 'topbar'
	);

	foreach ( $foundation_components as $component ) {	
		if ( current_theme_supports( 'foundation-' . $component ) ) {
			wp_enqueue_script( 'foundation-' . $component, get_stylesheet_directory_uri() . '/assets/javascripts/foundation/foundation.' . $component . '.js', array( 'jquery' ), FOUNDATION_VERSION, true );
		}
	}

	// ===== Initialize Foundation
	if ( current_theme_supports( 'foundation-base' ) ) {
		wp_enqueue_script( 'foundation-init', get_stylesheet_directory_uri() . '/assets/javascripts/foundation.init.js', array( 'jquery' ), FOUNDATION_VERSION, true );
	}
}

function hybrid_base_attr_branding( $attr ) {
	$attr['class'] = 'title-area';
	return $attr;
}