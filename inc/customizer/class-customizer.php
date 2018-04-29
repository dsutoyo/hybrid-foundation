<?php
/**
 * Hybrid Foundation Customizer
 *
 * @package     Hybrid Foundation
 * @since       4.0.0
 */

/**
 * Customizer Loader
 */
if ( ! class_exists( 'Hybrid_Foundation_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 4.0.0
	 */
	class Hybrid_Foundation_Customizer {
		
		/**
		 * Holds the instance of this class.
		 *
		 * @since  4.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance;

		/**
		 * Returns the instance.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  4.0.0
		 * @access private
		 * @return void
		 */
		private function __construct() {
			add_action( 'customize_preview_init', array( $this, 'preview_init' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_save_after', array( $this, 'customize_save' ) );
		}

		/**
		 * Register our customizer options.
		 *
		 * @since 4.0.0
		 * @access public
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/defaults-override.php';

			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/controls/divider.php';

			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/sections/site-identity/site-identity.php';
			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/sections/layout/layout.php';
			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/sections/colors/colors.php';
		}

		/**
		 * Customizer preview init.
		 *
		 * @since 4.0.0
		 * @access public
		 * @return void
		 */
		public function preview_init() {
			Hybrid_Foundation_Theme_Options::refresh();

			wp_enqueue_script( 'hybrid-foundation-customizer-preview', HYBRID_FOUNDATION_THEME_URI . 'assets/dist/customizer-preview.js', array( 'jquery' ), null, HYBRID_FOUNDATION_THEME_VERSION );
		}

		/**
		 * Refresh the options on save.
		 *
		 * @since 4.0.0
		 * @access public
		 * @return void
		 */
		public function customize_save() {
			// Update variables.
			Hybrid_Foundation_Theme_Options::refresh();
		}
	}
}

$hybrid_foundation_customizer = Hybrid_Foundation_Customizer::get_instance();