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

if ( ! class_exists( 'Realgymcore_VC_FAQs' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_FAQs extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-faq';

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
			$this->name_escaped = esc_html__( 'FAQs', 'realgymcore' );
		}

		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			$styles = array(
				esc_attr__( 'Style 1', 'realgymcore' ) => '',
				esc_attr__( 'Style 2', 'realgymcore' ) => 'realgym-faq-2',
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
							'heading'    => __( 'Style', 'realgymcore' ),
							'param_name' => 'style',
							'value'      => $styles,
						),
						array(
							'type'        => 'autocomplete',
							'heading'     => __( 'FAQs', 'realgymcore' ),
							'param_name'  => 'faq_ids',
							'description' => __( 'Add faqs by title.', 'realgymcore' ),
							'admin_label' => true,
							'taxonomy'    => 'faqs',
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'groups'        => true,
								'unique_values' => true,
								'no_hide'       => true,
								'values'        => realgymcore_vc_get_autocomplete_post( 'realgym-faqs' ),
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

	new Realgymcore_VC_FAQs();
}
