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

if ( ! class_exists( 'Realgymcore_Shortcode_IconBox' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_IconBox {

		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-icon-box';



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

			ob_start();

			if ( ! is_array( $atts ) ) {
				$atts = array();
			}
			$atts['unique_class'] = 'realgymcore-vc-' . realgymcore_generate_random_class();

			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_IconBox();
}
