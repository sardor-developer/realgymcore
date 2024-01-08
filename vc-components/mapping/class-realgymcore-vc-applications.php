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

if ( ! class_exists( 'Realgymcore_VC_Applications' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Applications extends WPBakeryShortCode {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-applications';

		/**
		 * Name sacaped
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
			$this->name_escaped = esc_html__( 'Applications Section', 'realgymcore' );
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
							'type'       => 'textfield',
							'heading'    => __( 'Title', 'realgymcore' ),
							'param_name' => 'title',
							'desc'       => __( 'If Title is empty, default Title will be shown from Theme Options', 'realgymcore' ),
						),
						array(
							'type'       => 'textarea',
							'heading'    => __( 'Description', 'realgymcore' ),
							'param_name' => 'description',
							'desc'       => __( 'If Description is empty, default Description will be shown from Theme Options', 'realgymcore' ),
						),
						array(
							'type'       => 'attach_image',
							'heading'    => __( 'Background Image', 'realgymcore' ),
							'param_name' => 'bg_image_id',
						),
						array(
							'type'       => 'attach_image',
							'heading'    => __( 'Screen Image', 'realgymcore' ),
							'param_name' => 'image_id',
						),
						array(
							'type'        => 'textfield',
							'heading'     => __( 'Image Size', 'realgymcore' ),
							'param_name'  => 'image_size',
							'value'       => 'full',
							'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'realgymcore' ),
						),
						realgymcore_vc_regular_fields( 'element_class' ),
						realgymcore_vc_regular_fields( 'element_id' ),
						realgymcore_vc_regular_fields( 'css' ),
					),
				)
			);
		}

	}

	new Realgymcore_VC_Applications();
}
