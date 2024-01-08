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

if ( ! class_exists( 'Realgymcore_VC_IconBox' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_IconBox extends WPBakeryShortCode {

		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-icon-box';

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
			$this->name_escaped = esc_html__( 'Icon box', 'realgymcore' );
		}

		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			$iconbox_style = array(
				esc_html__( 'Style 1', 'realgymcore' ) => 'first',
				esc_html__( 'Style 2', 'realgymcore' ) => 'second',
				esc_html__( 'Style 3', 'realgymcore' ) => 'third',
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
							'heading'    => esc_html__( 'Icon box Style', 'realgymcore' ),
							'param_name' => 'box_style',
							'value'      => $iconbox_style,
						),
						realgymcore_vc_regular_fields( 'items_per_row' ),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Add shadow', 'realgymcore' ),
							'param_name' => 'add_shadow',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Add Opacity', 'realgymcore' ),
							'param_name' => 'add_opacity',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
						),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						array(
							'type'       => 'param_group',
							'heading'    => '',
							'param_name' => 'iconbox',
							'group'      => esc_html__( 'Items', 'realgymcore' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'value'      => '',
									'heading'    => esc_html__( 'Title', 'realgymcore' ),
									'param_name' => 'box_title',
									'dependency' => array(
										'element' => 'box_style',
										'value'   => array( 'third' ),
									),
								),
								array(
									'type'        => 'exploded_textarea',
									'heading'     => esc_html__( 'Description', 'realgymcore' ),
									'param_name'  => 'box_description',
									'admin_label' => true,
								),
								array(
									'type'       => 'iconpicker',
									'value'      => '',
									'heading'    => esc_html__( 'Icon', 'realgymcore' ),
									'param_name' => 'box_icon',
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
									'description' => __( 'Choose text color', 'realgymcore' ),
								),

							),
						),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_IconBox();
}
