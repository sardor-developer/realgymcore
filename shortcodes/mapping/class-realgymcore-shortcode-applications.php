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

if ( ! class_exists( 'Realgymcore_Shortcode_Applications' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_Applications {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-applications';

		/**
		 * Name sacaped
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_shortcode( $this->slug . '-shortcode', array( $this, 'render' ) );
		}

		/**
		 * Render
		 *
		 * @param array $atts Array of attributes.
		 * @return string
		 */
		public function render( $atts ) {
			ob_start();

			if ( ! is_array( $atts ) ) {
				$atts = array();
			}

			$atts['unique_class'] = 'realgymcore-vc-' . realgymcore_generate_random_class();

			if ( isset( $atts['bg_image_id'] ) ) {
				$atts['bg_image_url'] = wp_get_attachment_url( $atts['bg_image_id'] );
			}
			if ( isset( $atts['image_id'] ) ) {
				$image_size    = isset( $atts['image_size'] ) ? $atts['image_size'] : 'large';
				$atts['image'] = realgymcore_get_image_by_size(
					array(
						'attach_id'  => $atts['image_id'],
						'thumb_size' => strtolower( $image_size ),
						'class'      => 'image',
					)
				);
			}

			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_Applications();
}
