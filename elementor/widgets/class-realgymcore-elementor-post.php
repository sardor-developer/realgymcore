<?php
/**
 * Realgymcore Elementor Posts
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

if ( ! class_exists( 'Realgymcore_Elementor_Post' ) ) {
	/**
	 * Realgymcore shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Post extends Widget_Base {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-elementor-post';
		/**
		 * Handler Stiles, Javascript files.
		 *
		 * @var string
		 */
		protected $handler = 'realgymcore-vc-post';
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
			return esc_html__( 'Posts', 'realgymcore' );
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

			$team_card_style           = array(
				'team_card_style_1' => esc_html__( 'Style 1', 'realgymcore' ),
				'team_card_style_2' => esc_html__( 'Style 2', 'realgymcore' ),
				'team_card_style_3' => esc_html__( 'Style 3', 'realgymcore' ),
			);
			$render_type               = array(
				'grid'   => esc_html__( 'Grid', 'realgymcore' ),
				'slider' => esc_html__( 'Slider', 'realgymcore' ),
			);
			$slider_navigation_options = array(
				'none'          => esc_html__( 'None', 'realgymcore' ),
				'slider_cursor' => esc_html__( 'With Cursor', 'realgymcore' ),
				'slider_dots'   => esc_html__( 'With Dots', 'realgymcore' ),
			);
			$this->start_controls_section(
				'general_section',
				array(
					'label' => esc_html__( 'General Settings', 'realgymcore' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);
			$this->add_control(
				'post_type',
				array(
					'label'   => esc_html__( 'Post Types', 'realgymcore' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => array_flip( realgymcore_vc_commons( 'post_type' ) ),
				)
			);
			$this->add_control(
				'team_card_style',
				array(
					'label'     => esc_html__( 'Team Card Style', 'realgymcore' ),
					'type'      => \Elementor\Controls_Manager::SELECT,
					'options'   => $team_card_style,
					'condition' => array(
						'post_type' => 'realgym-team',
					),
				)
			);
			$this->add_control(
				'pricing_plan_card_style',
				array(
					'label'        => esc_html__( 'Show Image', 'realgymcore' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes, please', 'realgymcore' ),
					'label_off'    => esc_html__( 'No', 'realgymcore' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition'    => array(
						'post_type' => 'realgym-plan',
					),
				)
			);
			$this->add_control(
				'render_type',
				array(
					'label'      => esc_html__( 'Render Type', 'realgymcore' ),
					'type'       => \Elementor\Controls_Manager::SELECT,
					'options'    => $render_type,
					'conditions' => array(
						'terms' => array(
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
				)
			);
			realgymcore_elementor_regular_fields( 'limit', array(), $this );
			$this->add_control(
				'items_per_row',
				array(
					'label'      => esc_html__( 'Items per Row', 'realgymcore' ),
					'type'       => \Elementor\Controls_Manager::NUMBER,
					'default'    => 3,
					'conditions' => array(
						'terms' => array(
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
				)
			);
			realgymcore_elementor_regular_fields( 'ordering', array(), $this );
			$this->add_control(
				'slider_navigation_type',
				array(
					'label'      => esc_html__( 'Slider Navigation Type', 'realgymcore' ),
					'type'       => \Elementor\Controls_Manager::SELECT,
					'options'    => $slider_navigation_options,
					'conditions' => array(
						'relation' => 'and',
						'terms'    => array(
							array(
								'name'     => 'render_type',
								'operator' => '==',
								'value'    => 'slider',
							),
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
				)
			);
			$this->add_control(
				'enable_autoplay',
				array(
					'label'        => esc_html__( 'Enable Autoplay', 'realgymcore' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes, please', 'realgymcore' ),
					'label_off'    => esc_html__( 'No', 'realgymcore' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'conditions'   => array(
						'relation' => 'and',
						'terms'    => array(
							array(
								'name'     => 'render_type',
								'operator' => '==',
								'value'    => 'slider',
							),
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
				)
			);
			$this->add_control(
				'autoplay_speed',
				array(
					'label'      => esc_html__( 'Autoplay Speed (ms)', 'realgymcore' ),
					'type'       => \Elementor\Controls_Manager::NUMBER,
					'default'    => 3000,
					'condition'  => array(
						'enable_autoplay' => 'yes',
					),
					'conditions' => array(
						'relation' => 'and',
						'terms'    => array(
							array(
								'name'     => 'enable_autoplay',
								'operator' => '==',
								'value'    => 'yes',
							),
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
				)
			);
			$this->add_control(
				'enable_loop',
				array(
					'label'        => esc_html__( 'Enable Loop', 'realgymcore' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes, please', 'realgymcore' ),
					'label_off'    => esc_html__( 'No', 'realgymcore' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'conditions'   => array(
						'relation' => 'and',
						'terms'    => array(
							array(
								'name'     => 'render_type',
								'operator' => '==',
								'value'    => 'slider',
							),
							array(
								'name'     => 'post_type',
								'operator' => '!=',
								'value'    => 'realgym-stories',
							),
						),
					),
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
			$arg_strings = realgymcore_elementor_args( $atts );
			echo do_shortcode( '[realgymcore-vc-post-shortcode ' . $arg_strings . ']' );

		}
	}

	\Elementor\Plugin::instance()->widgets_manager->register( new Realgymcore_Elementor_Post() );

}
