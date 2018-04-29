<?php
/**
 * Scripts and styles.
 *
 * @package    Hybrid Foundation
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

# Add custom scripts and styles
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_scripts', 5 );
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_styles', 5 );

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_scripts() {
	// ===== Foundation
	wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/assets/dist/foundation.min.js', '', FOUNDATION_VERSION, true );

	// ===== Initialize Foundation
	wp_enqueue_script( 'foundation-init', get_stylesheet_directory_uri() . '/assets/dist/app.min.js', array( 'jquery' ), FOUNDATION_VERSION, true );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_styles() {

	// Load gallery style if 'cleaner-gallery' is active.
	if ( current_theme_supports( 'cleaner-gallery' ) )
		wp_enqueue_style( 'hybrid-gallery' );

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() )
		wp_enqueue_style( 'hybrid-parent' );

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'style', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/dist/style.min.css', array(), filemtime( get_stylesheet_directory() . '/assets/dist/style.min.css' ) );
}