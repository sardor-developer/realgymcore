<?php
/**
 * Realgymcore Elementor FAQs
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

if ( ! class_exists( 'Realgymcore_Elementor_FAQs' ) ) {
	/**
	 * Realgymcore shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_FAQs extends Widget_Base {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-elementor-faqs';
		/**
		 * Handler Stiles, Javascript files.
		 *
		 * @var string
		 */
		protected $handler = 'realgymcore-vc-faqs';
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
			return esc_html__( 'FAQs', 'realgymcore' );
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
			$styles = array(
				'style1'        => esc_html__( 'Style 1', 'realgymcore' ),
				'realgym-faq-2' => esc_html__( 'Style 2', 'realgymcore' ),
			);

			$this->add_control(
				'style',
				array(
					'label'   => esc_html__( 'Style', 'realgymcore' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'solid',
					'options' => $styles,
				)
			);

				$this->add_control(
					'faq_ids',
					array(
						'label'       => esc_html__( 'FAQs', 'realgymcore' ),
						'type'        => 'realgymcore-faqs-select',
						'default'     => '',
						'description' => esc_html__( 'Add faqs by title.', 'realgymcore' ),
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
			if ( ! empty( $atts['faq_ids'] ) ) {
				$atts['faq_ids'] = implode( ',', $atts['faq_ids'] );
			}

			if ( ! empty( $content ) ) {
				$atts['content'] = $content;
			}
			$arg_strings = realgymcore_elementor_args( $atts );
			echo do_shortcode( '[realgymcore-vc-faq-shortcode ' . $arg_strings . ']' );

		}
	}

	\Elementor\Plugin::instance()->widgets_manager->register( new Realgymcore_Elementor_FAQs() );

}
