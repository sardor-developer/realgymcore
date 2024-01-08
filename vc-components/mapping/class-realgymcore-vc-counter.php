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

if ( ! class_exists( 'Realgymcore_VC_Counter' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Counter extends WPBakeryShortCode {

		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-counter';

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
			$this->name_escaped = esc_html__( 'Counter', 'realgymcore' );
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
						realgymcore_vc_regular_fields( 'items_per_row' ),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						array(
							'type'       => 'param_group',
							'heading'    => '',
							'param_name' => 'counter',
							'group'      => esc_html__( 'Items', 'realgymcore' ),
							'params'     => array(
								array(
									'type'       => 'realgymcore_number',
									'heading'    => esc_html__( 'Count', 'realgymcore' ),
									'param_name' => 'count_number',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Addition', 'realgymcore' ),
									'param_name' => 'count_addition',
								),
								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Description', 'realgymcore' ),
									'param_name' => 'count_description',
								),
							),
						),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Counter();
}
