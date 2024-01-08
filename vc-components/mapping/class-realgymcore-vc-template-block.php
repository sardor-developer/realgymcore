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

if ( ! class_exists( 'Realgymcore_VC_Template_Block' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Template_Block extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-template-block';

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
			$this->set_name();
			add_action( 'init', array( $this, 'mapping' ), 999 );

		}
		/**
		 *  Set name
		 */
		private function set_name() {
			$this->name_escaped = esc_html__( 'Zero Gym Templates Block', 'realgymcore' );
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
						array(
							'type'        => 'autocomplete',
							'heading'     => __( 'Template Block', 'realgymcore' ),
							'param_name'  => 'block_id',
							'description' => __( 'Choose Template Block', 'realgymcore' ),
							'admin_label' => true,
							'settings'    => array(
								'multiple'      => false,
								'sortable'      => true,
								'groups'        => true,
								'unique_values' => true,
								'no_hide'       => true,
								'values'        => realgymcore_vc_get_autocomplete_post( 'realgymcore-block' ),
							),
						),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Template_Block();
}
