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
 * @package    Hybrid Foundation
 * @subpackage Functions
 * @version    4.1.0
 * @author     David Sutoyo <david@smallharbor.com>
 * @copyright  Copyright (c) 2013 - 2015, David Sutoyo
 * @link       https://github.com/dsutoyo/hybrid-foundation
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/**
 * Singleton class for launching the theme and setup configuration.
 *
 * @since  4.0.0
 * @access public
 */
final class Hybrid_Foundation_Theme {

	/**
	 * Directory path to the theme folder.
	 *
	 * @since  4.0.0
	 * @access public
	 * @var    string
	 */
	public $dir = '';

	/**
	 * Directory URI to the theme folder.
	 *
	 * @since  4.0.0
	 * @access public
	 * @var    string
	 */
	public $uri = '';

	/**
	 * Returns the instance.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  4.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Initial theme setup.
	 *
	 * @since  4.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {

		$this->dir = trailingslashit( get_template_directory()     );
		$this->uri = trailingslashit( get_template_directory_uri() );

		/* Define Constants. */
		// Theme Version
		define( 'HYBRID_FOUNDATION_THEME_VERSION', '4.0.0' );

		// Settings
		define( 'HYBRID_FOUNDATION_THEME_SETTINGS', 'hybrid-foundation-settings' );

		// Theme Directory
		define( 'HYBRID_FOUNDATION_THEME_DIR', trailingslashit( get_template_directory() ) );

		// Theme Directory URI
		define( 'HYBRID_FOUNDATION_THEME_URI', trailingslashit( get_template_directory_uri() ) );

		// Specify our Foundation version
		define( 'FOUNDATION_VERSION', '6.4.3');
	}

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  4.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		// Load the Hybrid Core framework and theme files.
		require_once( $this->dir . 'library/hybrid.php' );

		// Load theme includes.
		require_once( $this->dir . 'inc/walker.php' );
		require_once( $this->dir . 'inc/functions-scripts.php' );
		require_once( $this->dir . 'inc/functions-filters.php' );
		require_once( $this->dir . 'inc/core/functions.php' );
		require_once( $this->dir . 'inc/core/class-theme-options.php' );
		require_once( $this->dir . 'inc/customizer/class-customizer.php' );
		require_once( $this->dir . 'inc/customizer/class-custom-css.php' );
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  4.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Theme setup.
		add_action( 'after_setup_theme', array( $this, 'theme_setup'             ),  5 );

		// Register menus.
		add_action( 'init', array( $this, 'register_menus' ) );

		// Register image sizes.
		add_action( 'init', array( $this, 'register_image_sizes' ) );

		// Register sidebars.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ), 5 );

		// Register layouts.
		add_action( 'hybrid_register_layouts', array( $this, 'register_layouts' ) );
	}

	/**
	 * The theme setup function.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return void
	 */
	public function theme_setup() {

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

		// Handle content width for embeds and images.
		hybrid_set_content_width( 1280 );

		/* Hybrid Foundation Features */

		// Off-canvas Transition - Overlap
		// add_theme_support( 'offcanvas-overlap' );

		// Fixed-width header
		// add_theme_support( 'fixed-width-header' );

		// Fixed-width footer
		// add_theme_support( 'fixed-width-footer' );

		require_once( $this->dir . 'inc/admin/class-post-layout.php' );
	}

	/**
	 * Registers nav menus.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return void
	 */
	public function register_menus() {

		register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'hybrid-foundation' ) );
		register_nav_menu( 'secondary', _x( 'Secondary', 'nav menu location', 'hybrid-foundation' ) );
		register_nav_menu( 'social',    _x( 'Social',    'nav menu location', 'hybrid-foundation' ) );
	}

	/**
	 * Registers image sizes.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return void
	 */
	public function register_image_sizes() {

		// Adds the 'hybrid-foundation-full' image size.
		add_image_size( 'hybrid-foundation-full', 1200, 500, false );
	}

	/**
	 * Registers sidebars.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return void
	 */
	function register_sidebars() {

		hybrid_register_sidebar(
			array(
				'id'          => 'primary',
				'name'        => _x( 'Page Sidebar', 'sidebar', 'hybrid-foundation' ),
				'description' => __( 'The main sidebar for pages. It is displayed on either the left or right side of the page based on the chosen layout.', 'hybrid-foundation' )
			)
		);

		hybrid_register_sidebar(
			array(
				'id'          => 'secondary',
				'name'        => _x( 'Blog Sidebar', 'sidebar', 'hybrid-foundation' ),
				'description' => __( 'The main sidebar for single blog posts and blog archives. It is displayed on either the left or right side of the page based on the chosen layout.', 'hybrid-foundation' )
			)
		);
	}

	/**
	 * Registers layouts.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return void
	 */
	public function register_layouts() {

		hybrid_register_layout( '1c',        array( 'label' => __( '1 Column Wide',                'hybrid-foundation' ), 'image' => '%s/images/layouts/1c.png' ) );
		hybrid_register_layout( '2c-l',      array( 'label' => __( '2 Columns: Content / Sidebar', 'hybrid-foundation' ), 'image' => '%s/images/layouts/2c-l.png' ) );
		hybrid_register_layout( '2c-r',      array( 'label' => __( '2 Columns: Sidebar / Content', 'hybrid-foundation' ), 'image' => '%s/images/layouts/2c-r.png' ) );
	}
}

/**
 * Gets the instance of the `Stargazer_Theme` class.  This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  4.0.0
 * @access public
 * @return object
 */
function hybrid_foundation_theme() {
	return Hybrid_Foundation_Theme::get_instance();
}

hybrid_foundation_theme();
