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
 * @version    4.1.0
 * @author     David Sutoyo <david@smallharbor.com>
 * @copyright  Copyright (c) 2013 - 2015, David Sutoyo
 * @link       https://github.com/dsutoyo/hybrid-foundation
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Get the template directory and make sure it has a trailing slash.
$hybrid_base_dir = trailingslashit( get_template_directory() );

// Load the Hybrid Core framework and theme files.
require_once( $hybrid_base_dir . 'library/hybrid.php' );

/* Define Constants. */
// Theme Version
define( 'HYBRID_FOUNDATION_THEME_VERSION', '4.0.0' );

// Settings
define( 'HYBRID_FOUNDATION_THEME_SETTINGS', 'hybrid-foundation-settings' );

// Theme Directory
define( 'HYBRID_FOUNDATION_THEME_DIR', trailingslashit( get_template_directory() ) );

// Theme Directory
define( 'HYBRID_FOUNDATION_THEME_URI', trailingslashit( get_template_directory_uri() ) );

// Specify our Foundation version
define( 'FOUNDATION_VERSION', '6.4.3');

require_once( $hybrid_base_dir . 'inc/theme.php' );
require_once( $hybrid_base_dir . 'inc/walker.php' );
require_once( $hybrid_base_dir . 'inc/core/functions.php' );
require_once( $hybrid_base_dir . 'inc/core/class-theme-options.php' );
require_once( $hybrid_base_dir . 'inc/customizer/class-customizer.php' );
require_once( $hybrid_base_dir . 'inc/customizer/class-custom-css.php' );

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'hybrid_base_theme_setup', 5 );

// Register the required plugins
// add_action( 'tgmpa_register', 'hybrid_base_register_required_plugins' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_theme_setup() {

	// Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
    ) );

	// Theme layouts.
	add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) );

	// Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// The best thumbnail/image script ever.
	add_theme_support( 'get-the-image' );

	// Breadcrumbs. Yay!
	add_theme_support( 'breadcrumb-trail' );

	// Nicer [gallery] shortcode implementation.
	add_theme_support( 'cleaner-gallery' );

	// Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Post formats.
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	// Editor styles.
	add_editor_style( hybrid_base_get_editor_styles() );

	// Handle content width for embeds and images.
	hybrid_set_content_width( 1280 );

	/* Hybrid Foundation Features */

	// Off-canvas Transition - Overlap
	// add_theme_support( 'offcanvas-overlap' );

	// Fixed-width header
	// add_theme_support( 'fixed-width-header' );

	// Fixed-width footer
	// add_theme_support( 'fixed-width-footer' );
}
