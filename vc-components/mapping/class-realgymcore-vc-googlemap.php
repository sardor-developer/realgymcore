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

if ( ! class_exists( 'Realgymcore_VC_GoogleMap' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_GoogleMap extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-googlemap';

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
			$this->name_escaped = esc_html__( 'Google Map', 'realgymcore' );
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
							'type'        => 'realgymcore_number',
							'heading'     => __( 'Map height', 'realgymcore' ),
							'param_name'  => 'map_height',
							'group'       => 'Map',
							'value'       => '450',
							'description' => __( 'Map height in pixels', 'realgymcore' ),
						),
						array(
							'type'        => 'realgymcore_number',
							'heading'     => __( 'Map zoom', 'realgymcore' ),
							'param_name'  => 'map_zoom',
							'group'       => 'Map',
							'value'       => 18,
							'description' => __( 'Map zoom level', 'realgymcore' ),
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Map center coordinates', 'realgymcore' ),
							'param_name'  => 'map_center',
							'group'       => 'Map',
							'value'       => '47.116386, -101.299591',
							'description' => __( 'Show this location as center of the map', 'realgymcore' ),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Mouse wheel zoom', 'realgymcore' ),
							'param_name' => 'disable_mouse_whell',
							'group'      => 'Map',
							'value'      => array(
								esc_html__( 'Disable map zoom on mouse wheel scroll', 'realgymcore' ) => 'disable',
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Map controls', 'realgymcore' ),
							'param_name' => 'disable_control_tools',
							'group'      => 'Map',
							'value'      => array(
								esc_html__( 'Disable controls (rotate, scale, zoom, street view, full screen, map type)', 'realgymcore' ) => 'disable',
							),
						),
						array(
							'type'        => 'textarea_raw_html',
							'heading'     => __( 'Map style', 'realgymcore' ),
							'param_name'  => 'map_style',
							'group'       => 'Map',
							'description' => __( '<a href="https://snazzymaps.com" target="_blank">SnazzyMaps</a> is a free tool for you to create and explore map styles', 'realgymcore' ),
						),
						array(
							'type'       => 'param_group',
							'heading'    => '',
							'param_name' => 'locations',
							'group'      => 'Map',
							'params'     => array(
								array(
									'type'       => 'textfield',
									'value'      => '',
									'heading'    => __( 'Location name', 'realgymcore' ),
									'param_name' => 'name',
								),
								array(
									'type'        => 'textfield',
									'value'       => '',
									'heading'     => __( 'Latitude', 'realgymcore' ),
									'param_name'  => 'latitude',
									'description' => __( 'Example: 51.507351. You can use <a href="https://www.latlong.net/" target="_blank">this tool</a> to look up Latitude and Longitude for a location.', 'realgymcore' ),
								),
								array(
									'type'        => 'textfield',
									'value'       => '',
									'heading'     => __( 'Longitude', 'realgymcore' ),
									'param_name'  => 'longitude',
									'description' => __( 'Example: -0.127758. You can use <a href="https://www.latlong.net/" target="_blank">this tool</a> to look up Latitude and Longitude for a location.', 'realgymcore' ),
								),
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

	new Realgymcore_VC_GoogleMap();
}
