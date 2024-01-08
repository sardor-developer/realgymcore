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

if ( ! class_exists( 'Realgymcore_VC_Timetable' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Timetable extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-timetable';

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
			$this->name_escaped = esc_html__( 'Classes Timetable', 'realgymcore' );
		}
		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			$colors_group     = esc_html__( 'Colors', 'realgymcore' );
			$typography_group = esc_html__( 'Typography', 'realgymcore' );

			vc_map(
				array(
					'base'     => $this->slug . '-shortcode',
					'name'     => $this->name_escaped,
					'category' => esc_html__( 'RealGym', 'realgymcore' ),
					'icon'     => 'realgymcore-vc-icon',
					'params'   => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Title', 'realgymcore' ),
							'param_name' => 'timetable-title',
						),
						array(
							'type'        => 'autocomplete',
							'heading'     => __( 'Classes', 'realgymcore' ),
							'param_name'  => 'realgymcore_classes_ids',
							'description' => esc_html__( 'Add Class by title.', 'realgymcore' ),
							'admin_label' => true,
							'taxonomy'    => 'class',
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'groups'        => true,
								'unique_values' => true,
								'no_hide'       => true,
								'values'        => realgymcore_vc_get_autocomplete_post( 'classes' ),
							),
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Table Row Height', 'realgymcore' ),
							'param_name' => 'realgymcore_table_row',
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Weekdays header background color', 'realgymcore' ),
							'param_name' => 'realgymcore_bk_color',
							'group'      => $colors_group,
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Weekdays header Text color', 'realgymcore' ),
							'param_name' => 'realgymcore_txt_color',
							'group'      => $colors_group,
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Time header background color', 'realgymcore' ),
							'param_name' => 'realgymcore_time_bk_color',
							'group'      => $colors_group,
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Time header Text Color', 'realgymcore' ),
							'param_name' => 'realgymcore_time_txt_color',
							'group'      => $colors_group,
						),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Timetable();
}
