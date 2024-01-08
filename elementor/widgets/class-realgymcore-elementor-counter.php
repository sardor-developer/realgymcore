<?php
/**
 * Realgymcore Elementor Counter
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

if ( ! class_exists( 'Realgymcore_Elementor_Counter' ) ) {
	/**
	 * Realgymcore shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Counter extends Widget_Base {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-elementor-counter';

		/**
		 * Handler Stiles, Javascript files.
		 *
		 * @var string
		 */
		protected $handler = 'realgymcore-vc-counter';
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
			return esc_html__( 'Counter', 'realgymcore' );
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
				'items_per_row',
				array(
					'label'   => esc_html__( 'Items per Row', 'realgymcore' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'min'     => 0,
					'max'     => 100,
					'step'    => 1,
					'default' => 1,
				)
			);
			realgymcore_elementor_regular_fields( 'element_class', array(), $this );
			realgymcore_elementor_regular_fields( 'element_id', array(), $this );
			$this->end_controls_section();
			// Items.
			$this->start_controls_section(
				'content_items',
				array(
					'label' => esc_html__( 'Items', 'realgymcore' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);

				$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'count_number',
					array(
						'label'   => esc_html__( 'Count', 'realgymcore' ),
						'type'    => \Elementor\Controls_Manager::NUMBER,
						'min'     => 1,
						'max'     => 10000,
						'step'    => 1,
						'default' => 10,
					)
				);

			$repeater->add_control(
				'count_addition',
				array(
					'label'       => esc_html__( 'Addition', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__( 'Default Addition', 'realgymcore' ),
					'placeholder' => esc_html__( 'Type your Addition here', 'realgymcore' ),
				)
			);

			$repeater->add_control(
				'count_description',
				array(
					'label'       => esc_html__( 'Description', 'realgymcore' ),
					'type'        => \Elementor\Controls_Manager::TEXTAREA,
					'rows'        => 10,
					'default'     => esc_html__( 'Default Description', 'realgymcore' ),
					'placeholder' => esc_html__( 'Type your Description here', 'realgymcore' ),
				)
			);

			$this->add_control(
				'counter',
				array(
					'label'  => esc_html__( 'Items', 'realgymcore' ),
					'type'   => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
				)
			);
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

			echo do_shortcode( '[realgymcore-vc-counter-shortcode ' . $arg_strings . ']' );

		}
	}

	\Elementor\Plugin::instance()->widgets_manager->register( new Realgymcore_Elementor_Counter() );

}
