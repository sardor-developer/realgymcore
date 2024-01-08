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

if ( ! class_exists( 'Realgymcore_VC_Post' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Post extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-post';

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
			$this->name_escaped = esc_html__( 'Posts', 'realgymcore' );
		}



		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {

			$team_card_style = array(
				esc_attr__( 'Style 1', 'realgymcore' ) => 'team_card_style_1',
				esc_attr__( 'Style 2', 'realgymcore' ) => 'team_card_style_2',
				esc_attr__( 'Style 3', 'realgymcore' ) => 'team_card_style_3',
			);

			$render_type = array(
				esc_attr__( 'Grid', 'realgymcore' )   => '',
				esc_attr__( 'Slider', 'realgymcore' ) => 'slider',
			);

			$slider_navigation_options = array(
				esc_attr__( 'None', 'realgymcore' )        => '',
				esc_attr__( 'With Cursor', 'realgymcore' ) => 'slider_cursor',
				esc_attr__( 'With Dots', 'realgymcore' )   => 'slider_dots',
			);

			vc_map(
				array(
					'base'     => $this->slug . '-shortcode',
					'name'     => $this->name_escaped,
					'category' => esc_html__( 'RealGym', 'realgymcore' ),
					'icon'     => 'realgymcore-vc-icon',
					'params'   => array(
						realgymcore_vc_regular_fields( 'posts' ),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Card Style', 'realgymcore' ),
							'param_name' => 'team_card_style',
							'value'      => $team_card_style,
							'dependency' => array(
								'element' => 'post_type',
								'value'   => array( 'realgym-team' ),
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__( 'Show Image', 'realgymcore' ),
							'param_name' => 'pricing_plan_card_style',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
							'dependency' => array(
								'element' => 'post_type',
								'value'   => array( 'realgym-plan' ),
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Render Type', 'realgymcore' ),
							'param_name' => 'render_type',
							'value'      => $render_type,
						),
						realgymcore_vc_regular_fields( 'limit' ),
						realgymcore_vc_regular_fields( 'items_per_row' ),
						realgymcore_vc_regular_fields( 'ordering' ),

						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Slider Navigation Type', 'realgymcore' ),
							'param_name' => 'slider_navigation_type',
							'value'      => $slider_navigation_options,
							'dependency' => array(
								'element' => 'render_type',
								'value'   => array( 'slider' ),
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__( 'Enable Autoplay', 'realgymcore' ),
							'param_name' => 'enable_autoplay',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
							'std'        => 'yes',
							'dependency' => array(
								'element' => 'render_type',
								'value'   => array( 'slider' ),
							),
						),
						array(
							'type'       => 'realgymcore_number',
							'heading'    => esc_html__( 'Autoplay Speed (ms)', 'realgymcore' ),
							'param_name' => 'autoplay_speed',
							'value'      => 3000,
							'dependency' => array(
								'element' => 'enable_autoplay',
								'value'   => 'yes',
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__( 'Enable Loop', 'realgymcore' ),
							'param_name' => 'enable_loop',
							'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
							'std'        => 'yes',
							'dependency' => array(
								'element' => 'render_type',
								'value'   => array( 'slider' ),
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

	new Realgymcore_VC_Post();
}
