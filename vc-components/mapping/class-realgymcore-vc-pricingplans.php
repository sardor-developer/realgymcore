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

if ( ! class_exists( 'Realgymcore_VC_PricingPlans' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_PricingPlans extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-pricing-plans';

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
			$this->name_escaped = esc_html__( 'Pricing Plans', 'realgymcore' );
		}
		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {

			$types = array(
				esc_attr__( 'Plan Card Style 1', 'realgymcore' ) => 'plan_card_style',
				esc_attr__( 'Plan Card Style 2', 'realgymcore' ) => 'plan_card_style_1',
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
							'heading'    => esc_html__( 'Card Style', 'realgymcore' ),
							'param_name' => 'card_style',
							'value'      => $types,
						),
						realgymcore_vc_regular_fields( 'limit' ),
						realgymcore_vc_regular_fields( 'items_per_row' ),
						realgymcore_vc_regular_fields( 'ordering' ),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Add Opacity', 'realgymcore' ),
							'param_name' => 'add_opacity',
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

	new Realgymcore_VC_PricingPlans();
}
