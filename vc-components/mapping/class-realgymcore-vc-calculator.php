<?php
/**
 * RealGym VC block
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Realgymcore_VC_Calculator' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Calculator extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-calculator';

		/**
		 * Name escaped
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 *  Constructor
		 */
		public function __construct() {
			$this->set_name();
			add_action( 'init', array( $this, 'mapping' ), 999 );

		}
		/**
		 *  Set name
		 */
		private function set_name() {
			$this->name_escaped = esc_html__( 'Calculator', 'realgymcore' );
		}
		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			vc_map(
				array(
					'base'     => $this->slug . '-shortcode',
					'name'     => $this->name_escaped,
					'category' => esc_html__( 'RealGym', 'realgymcore' ),
					'icon'     => 'realgymcore-vc-icon',
					'params'   => array(
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
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
			if ( ! empty( $content ) ) {
				$atts['content'] = $content;
			}

			include realgymcore_vc_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_VC_Calculator();
}
