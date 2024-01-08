<?php
/**
 * Realgymcore Elementor Timetable
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

if ( ! class_exists( 'Realgymcore_Elementor_Timetable' ) ) {
	/**
	 * Realgymcore shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Timetable extends Widget_Base {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-elementor-timetable';
		/**
		 * Handler Stiles, Javascript files.
		 *
		 * @var string
		 */
		protected $handler = 'realgymcore-vc-timetable';
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
			return esc_html__( 'Classes Timetable', 'realgymcore' );
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
				'timetable-title',
				array(
					'label' => __( 'Title', 'realgymcore' ),
					'type'  => Controls_Manager::TEXT,
				)
			);
			$this->add_control(
				'realgymcore_classes_ids',
				array(
					'label'       => esc_html__( 'Classes', 'realgymcore' ),
					'type'        => 'realgymcore-faqs-select',
					'default'     => '',
					'description' => esc_html__( 'Add Class by title..', 'realgymcore' ),
				)
			);
			$this->add_control(
				'realgymcore_table_row',
				array(
					'label' => esc_html__( 'Table Row Height', 'realgymcore' ),
					'type'  => Controls_Manager::TEXT,
				)
			);
			$this->add_control(
				'realgymcore_bk_color',
				array(
					'label'     => esc_html__( 'Weekdays header background color', 'realgymcore' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .realgymcore_timetable_bk_color' => 'background: {{VALUE}} !important',
					),
				)
			);
			$this->add_control(
				'realgymcore_txt_color',
				array(
					'label'     => esc_html__( 'Weekdays header Text color', 'realgymcore' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .realgymcore_timetable_txt_color' => 'color: {{VALUE}} !important',
					),
				)
			);
			$this->add_control(
				'realgymcore_time_bk_color',
				array(
					'label'     => esc_html__( 'Time header background color', 'realgymcore' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .realgymcore_time_bk_color' => 'background: {{VALUE}} !important',
					),
				)
			);
			$this->add_control(
				'realgymcore_time_txt_color',
				array(
					'label'     => esc_html__( 'Time header Text Color', 'realgymcore' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .realgymcore_time_txt_color' => 'color: {{VALUE}} !important',
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
			echo do_shortcode( '[realgymcore-vc-timetable-shortcode ' . $arg_strings . ']' );

		}
	}

	\Elementor\Plugin::instance()->widgets_manager->register( new Realgymcore_Elementor_Timetable() );

}
