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

if ( ! class_exists( 'Realgymcore_VC_List' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_List extends WPBakeryShortCode {

		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-list';

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
			$this->name_escaped = esc_html__( 'List', 'realgymcore' );
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
						array(
							'type'       => 'param_group',
							'heading'    => '',
							'param_name' => 'list',
							'group'      => 'List',
							'params'     => array(
								array(
									'type'        => 'exploded_textarea',
									'heading'     => esc_html__( 'List text', 'realgymcore' ),
									'param_name'  => 'list_text',
									'admin_label' => true,
								),
								array(
									'type'        => 'iconpicker',
									'value'       => '',
									'heading'     => esc_html__( 'List icon', 'realgymcore' ),
									'description' => esc_html__( 'Leave empty to disable', 'realgymcore' ),
									'param_name'  => 'list_icon',
								),
								array(
									'type'       => 'realgymcore_number',
									'heading'    => esc_html__( 'Icon size', 'realgymcore' ),
									'param_name' => 'size_icon',
								),
								array(
									'type'        => 'colorpicker',
									'heading'     => esc_html__( 'Icon color', 'realgymcore' ),
									'param_name'  => 'color_icon',
									'description' => esc_html__( 'Choose text color', 'realgymcore' ),
								),
							),
						),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_List();
}
