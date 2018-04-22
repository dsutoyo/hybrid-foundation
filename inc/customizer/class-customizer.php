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
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		/**
		 * Register our customizer options.
		 *
		 * @since 4.0.0
		 * @access public
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/sections/site-identity/site-identity.php';
			require HYBRID_FOUNDATION_THEME_DIR . 'inc/customizer/sections/colors/colors.php';
		}
	}
}

$hybrid_foundation_customer = Hybrid_Foundation_Customizer::get_instance();