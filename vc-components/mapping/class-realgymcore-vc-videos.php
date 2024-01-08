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

if ( ! class_exists( 'Realgymcore_VC_Videos' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Videos extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-videos';

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
			$this->name_escaped = esc_html__( 'Videos Grid', 'realgymcore' );
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
						realgymcore_vc_regular_fields( 'limit' ),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Only featured videos', 'realgymcore' ),
							'param_name' => 'only_featured',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
						),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Videos();
}
