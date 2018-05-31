<?php
/**
 * Output the custom CSS.
 *
 * @package    Hybrid Foundation
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Hybrid_Foundation_Custom_CSS' ) ) {

	/**
	 * Theme Custom CSS.
	 *
	 * @since  4.0.0
	 * @access public
	 */
	class Hybrid_Foundation_Custom_CSS {
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
			add_action( 'wp_head', array( $this, 'wp_head_callback' ) );
			add_action( 'embed_head', array( $this, 'wp_head_callback' ), 25 );
		}

		/**
		 * Callback for 'wp_head' that outputs the CSS for this feature.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return void
		 */
		public function wp_head_callback() {

			$stylesheet = get_stylesheet();

			// Get the cached style.
			$style = wp_cache_get( "{$stylesheet}_custom_css" );

			// If the style is available, output it and return.
			if ( ! empty( $style ) ) {
				echo $style;
				return;
			}

			$style = $this->get_custom_styles();

			// Put the final style output together.
			$style = "\n" . '<style type="text/css" id="' . $stylesheet . '-custom-css">' . trim( $style ) . '</style>' . "\n";

			// Cache the style, so we don't have to process this on each page load.
			wp_cache_set( "{$stylesheet}_custom_css", $style );

			// Output the custom style.
			echo $style;
		}

		/**
		 * Formats the custom styles for output.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return string
		 */
		public function get_custom_styles() {
			$theme_options = get_option( 'theme_mods_' . get_stylesheet() );

			$style = '';

			if ( has_custom_logo() ) {
				$style .= '.site-title a { background: url(' . Hybrid_Foundation_Custom_CSS::get_custom_logo_src() . ') center center no-repeat; }';

				$logo_size = Hybrid_Foundation_Custom_CSS::get_custom_logo_ratio( $theme_options['custom_logo'], $theme_options['custom_logo_height'] );

				$style .= '.site-title a { width: ' . $logo_size['width'] . 'px; height: ' . $logo_size['height'] . 'px; }';
			}

			return $style;
		}

		/**
		 * Gets the custom logo source.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return string
		 */
		public function get_custom_logo_src() {
			$id = get_theme_mod( 'custom_logo' );
			$src = wp_get_attachment_image_src( $id , 'full' );
			return $src[0];
		}

		/**
		 * Gets the custom logo size ratio.
		 *
		 * @since  4.0.0
		 * @access public
		 * @return array
		 */
		public function get_custom_logo_ratio( $attachment_id, $custom_logo_height ) {
			$size = array(
				'width' => 0,
				'height' => 0
			);

			if ( has_custom_logo() ) {
				$image = wp_get_attachment_metadata( $attachment_id );
				$size['height'] = $custom_logo_height;
				$size['width'] = $image['width'] / $image['height'] * $custom_logo_height;
			}

			return $size;
		}
	}
}

$hybrid_foundation_custom_css = Hybrid_Foundation_Custom_CSS::get_instance();