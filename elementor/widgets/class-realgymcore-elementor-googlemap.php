<?php
/**
 * Realgymcore Elementor Google Map
 *
 * @author  Balcomsoft
 * @package Realgymcore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Icons_Manager;

if ( ! class_exists( 'Realgymcore_Elementor_Googlemap' ) ) {
	/**
	 * Realgymcore shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Googlemap extends Widget_Base {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-elementor-googlemap';

		/**
		 * Handler Stiles, Javascript files.
		 *
		 * @var string
		 */
		protected $handler = 'realgymcore-vc-googlemap';
		/**
		 * Name escaped
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 * Get style depends
		 *
		 * @return string[]
		 */
		public function get_style_depends() {

			if ( file_exists( REALGYMCORE_PATH . '/assets/css/components/' . $this->handler . '.css' ) ) {
					wp_register_style( $this->handler, REALGYMCORE_CSS . '/components/' . $this->handler . '.css', array(), REALGYMCORE_VERSION );
			}

			return array( $this->slug, $this->handler );

		}

		/**
		 * Get javascript depends
		 *
		 * @return string[]
		 */
		public function get_script_depends() {
			if ( file_exists( REALGYMCORE_PATH . '/assets/js/components/' . $this->handler . '.js' ) ) {
				wp_register_script( $this->handler, REALGYMCORE_JS . '/components/' . $this->handler . '.js', array( 'jquery' ), REALGYMCORE_VERSION, true );
			}
			return array( $this->slug, $this->handler );
		}

		/**
		 * Get Name.
		 *
		 * @return string
		 */
		public function get_name() {
			return $this->slug;
		}

		/**
		 *  Get Title
		 */
		public function get_title() {
			return esc_html__( 'Google Map', 'realgymcore' );
		}

		/**
		 * Get Icon.
		 *
		 * @return string
		 */
		public function get_icon() {
			return 'realgymcore-elementor-icon';
		}

		/**
		 * Get Categories.
		 *
		 * @return string[]
		 */
		public function get_categories() {
			return array( 'realgymcore-widgets' );
		}

		/**
		 * Get General options.
		 *
		 * @author Balcomsoft
		 */
		protected function get_general_options() {
			$this->start_controls_section(
				'general_section',
				array(
					'label' => esc_html__( 'General Settings', 'realgymcore' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);
			$this->add_control(
				'map_height',
				array(
					'label'       => esc_html__( 'Map height', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'min'         => 1,
					'max'         => 10000,
					'step'        => 1,
					'default'     => 450,
					'description' => esc_html__( 'Map height in pixels', 'realgymcore' ),
				)
			);
			$this->add_control(
				'map_zoom',
				array(
					'label'       => esc_html__( 'Map zoom', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'min'         => 1,
					'max'         => 10000,
					'step'        => 1,
					'default'     => 15,
					'description' => esc_html__( 'Map zoom level', 'realgymcore' ),
				)
			);
			$this->add_control(
				'map_center',
				array(
					'label'       => esc_html__( 'Map center coordinates', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'row'         => '2',
					'default'     => '47.116386, -101.299591',
					'description' => esc_html__( 'Show this location as center of the map', 'realgymcore' ),
				)
			);
			$this->add_control(
				'disable_mouse_whell',
				array(
					'label'        => esc_html__( 'Mouse wheel zoom', 'realgymcore' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Enable, please', 'realgymcore' ),
					'label_off'    => esc_html__( 'Disable', 'realgymcore' ),
					'return_value' => 'disable',
					'default'      => 'disable',
					'description'  => esc_html__( 'Disable map zoom on mouse wheel scroll', 'realgymcore' ),
				)
			);
			$this->add_control(
				'disable_control_tools',
				array(
					'label'        => esc_html__( 'Map controls', 'realgymcore' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Enable, please', 'realgymcore' ),
					'label_off'    => esc_html__( 'Disable', 'realgymcore' ),
					'return_value' => 'disable',
					'default'      => 'disable',
					'description'  => esc_html__( 'Disable controls (rotate, scale, zoom, street view, full screen, map type', 'realgymcore' ),
				)
			);
			$map_style = '[
							{
							        "featureType": "all",
							        "elementType": "geometry",
							        "stylers": [
							            {
							                "color": "#202c3e"
							            }
							        ]
							    },
							    {
							        "featureType": "all",
							        "elementType": "labels.text.fill",
							        "stylers": [
							            {
							                "gamma": 0.01
							            },
							            {
							                "lightness": 20
							            },
							            {
							                "weight": "1.39"
							            },
							            {
							                "color": "#ffffff"
							            }
							        ]
							    },
							    {
							        "featureType": "all",
							        "elementType": "labels.text.stroke",
							        "stylers": [
							            {
							                "weight": "0.96"
							            },
							            {
							                "saturation": "9"
							            },
							            {
							                "visibility": "on"
							            },
							            {
							                "color": "#000000"
							            }
							        ]
							    },
							    {
							        "featureType": "all",
							        "elementType": "labels.icon",
							        "stylers": [
							            {
							                "visibility": "off"
							            }
							        ]
							    },
							    {
							        "featureType": "landscape",
							        "elementType": "geometry",
							        "stylers": [
							            {
							                "lightness": 30
							            },
							            {
							                "saturation": "9"
							            },
							            {
							                "color": "#29446b"
							            }
							        ]
							    },
							    {
							        "featureType": "poi",
							        "elementType": "geometry",
							        "stylers": [
							            {
							                "saturation": 20
							            }
							        ]
							    },
							    {
							        "featureType": "poi.park",
							        "elementType": "geometry",
							        "stylers": [
							            {
							                "lightness": 20
							            },
							            {
							                "saturation": -20
							            }
							        ]
							    },
							    {
							        "featureType": "road",
							        "elementType": "geometry",
							        "stylers": [
							            {
							                "lightness": 10
							            },
							            {
							                "saturation": -30
							            }
							        ]
							    },
							    {
							        "featureType": "road",
							        "elementType": "geometry.fill",
							        "stylers": [
							            {
							                "color": "#193a55"
							            }
							        ]
							    },
							    {
							        "featureType": "road",
							        "elementType": "geometry.stroke",
							        "stylers": [
							            {
							                "saturation": 25
							            },
							            {
							                "lightness": 25
							            },
							            {
							                "weight": "0.01"
							            }
							        ]
							    },
							    {
							        "featureType": "water",
							        "elementType": "all",
							        "stylers": [
							            {
							                "lightness": -20
							            }
							        ]
							    }
							]';
			$this->add_control(
				'map_style',
				array(
					'label'       => esc_html__( 'Map style', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'row'         => '3',
					'default'     => $map_style,
					'description' => esc_html__( '<a href="https://snazzymaps.com" target="_blank">SnazzyMaps</a> is a free tool for you to create and explore map styles', 'realgymcore' ),
				)
			);

			$repeater = new \Elementor\Repeater();
			$repeater->add_control(
				'name',
				array(
					'label' => esc_html__( 'Location name', 'realgymcore' ),
					'type'  => Controls_Manager::TEXT,
				)
			);
			$repeater->add_control(
				'latitude',
				array(
					'label'       => esc_html__( 'Latitude', 'realgymcore' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Example: 51.507351. You can use <a href="https://www.latlong.net/" target="_blank">this tool</a> to look up Latitude and Longitude for a location.', 'realgymcore' ),
				)
			);
			$repeater->add_control(
				'longitude',
				array(
					'label'       => esc_html__( 'Longitude', 'realgymcore' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Example: -0.127758. You can use <a href="https://www.latlong.net/" target="_blank">this tool</a> to look up Latitude and Longitude for a location.', 'realgymcore' ),
				)
			);
			$this->add_control(
				'locations',
				array(
					'label'  => esc_html__( 'Map Locations', 'realgymcore' ),
					'type'   => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
				)
			);
			realgymcore_elementor_regular_fields( 'element_class', array(), $this );
			realgymcore_elementor_regular_fields( 'element_id', array(), $this );
			realgymcore_elementor_regular_fields( 'css', array(), $this );
			$this->end_controls_section();

		}

		/**
		 * Register Controls.
		 *
		 * @author Balcomsoft
		 */
		protected function register_controls() {
			$this->get_general_options();
		}

		/**
		 * Render.
		 */
		protected function render() {
			$atts = $this->get_settings_for_display();

			if ( ! empty( $content ) ) {
				$atts['content'] = $content;
			}
			$atts['map_style'] = base64_encode( $atts['map_style'] ); // phpcs:ignore WordPress
			$arg_strings       = realgymcore_elementor_args( $atts );
			echo do_shortcode( '[realgymcore-vc-googlemap-shortcode ' . $arg_strings . ']' );
		}
	}

	\Elementor\Plugin::instance()->widgets_manager->register( new Realgymcore_Elementor_Googlemap() );

}
