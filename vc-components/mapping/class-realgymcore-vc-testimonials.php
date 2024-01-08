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

if ( ! class_exists( 'Realgymcore_VC_Testimonials' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Testimonials extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-testimonials';

		/**
		 * Name escapeds
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 * Nonce
		 *
		 * @var string
		 */
		protected $nonce;

		/**
		 *  Constructor
		 */
		public function __construct() {
			$this->set_name();
			$this->nonce = 'realgymcore_testimonials_nonce';
			add_action( 'init', array( $this, 'mapping' ), 999 );

		}

		/**
		 *  Set name
		 */
		private function set_name() {
			$this->name_escaped = esc_html__( 'Testimonials', 'realgymcore' );
		}

		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			$testimonials_slider_types = array(
				esc_attr__( 'Testimonials Slider 1', 'realgymcore' ) => 'testimonials_slider_1',
				esc_attr__( 'Testimonials Slider 2', 'realgymcore' ) => 'testimonials_slider_2',
			);

			vc_map(
				array(
					'base'     => $this->slug . '-shortcode',
					'name'     => $this->name_escaped,
					'category' => esc_html__( 'RealGym', 'realgymcore' ),
					'icon'     => 'realgymcore-vc-icon',
					'params'   => array(
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Testimonials Slider Type', 'realgymcore' ),
							'param_name' => 'realgymcore_testimonials_slider',
							'value'      => $testimonials_slider_types,
						),
						realgymcore_vc_regular_fields( 'limit' ),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Testimonials();
}
