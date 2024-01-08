<?php
/**
 * RealGym VC Posts
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Realgymcore_Shortcode_Post' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_Post {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-post';



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

			wp_enqueue_style( 'realgym-flat-icon', REALGYMCORE_CSS . '/flaticon.css', array(), REALGYMCORE_VERSION );

			ob_start();

			if ( ! empty( $content ) ) {
				$atts['content'] = $content;
			}

			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_Post();
}
