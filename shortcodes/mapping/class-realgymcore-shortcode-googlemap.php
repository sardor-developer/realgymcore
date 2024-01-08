<?php
/**
 * RealGym Shortcode  block
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Realgymcore_Shortcode_GoogleMap' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_GoogleMap {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-googlemap';

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_shortcode( $this->slug . '-shortcode', array( $this, 'render' ) );
		}

		/**
		 * Render
		 *
		 * @param array  $atts Array of attributes.
		 * @param string $content Content body.
		 * @return string
		 */
		public function render( $atts, $content ) {
			realgymcore_vc_enqueue_scripts_styles( $this->slug );

			$script_key = 'realgymcore-google-maps';

			if ( ! wp_script_is( $script_key, 'registered' ) ) {
				$settings       = ( function_exists( 'realgym_check_theme_options' ) ? realgym_check_theme_options() : array() );
				$google_api_key = ( ! empty( $settings['googlemap_api'] ) ) ? esc_attr( $settings['googlemap_api'] ) : '';

				if ( ! empty( $google_api_key ) ) {
					$google_api_map = 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&';
				} else {
					$google_api_map = 'https://maps.googleapis.com/maps/api/js?';
				}

				wp_register_script( $script_key, $google_api_map, array( 'jquery' ), REALGYM_VERSION, true );
				wp_enqueue_script( $script_key );
			}

			ob_start();
			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_GoogleMap();
}
