<?php
/**
 * RealGym VC FlatIcon Add-on
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_VC_Flaticon' ) ) {
	/**
	 * RealGym VC FlatIcon Class
	 *
	 * @return void
	 */
	class Realgymcore_VC_Flaticon {


		/**
		 * RealGym Constructor
		 *
		 * @return void
		 */
		public function __construct() {
			add_filter( 'vc_after_init', array( $this, 'flaticon_add_to_iconbox' ), 40 );
			add_filter( 'vc_after_init', array( $this, 'flaticon_add_font_picker' ), 50 );
			add_filter( 'vc_iconpicker-type-flicon', array( $this, 'vc_iconpicker_type_flaticon' ) );

			add_action( 'vc_base_register_front_css', array( $this, 'flaticon_register_base_style' ) );
			add_action( 'vc_base_register_admin_css', array( $this, 'flaticon_register_base_style' ) );

			add_action( 'vc_backend_editor_enqueue_js_css', array( $this, 'enqueue_flaticon_font' ) );
			add_action( 'vc_frontend_editor_enqueue_js_css', array( $this, 'enqueue_flaticon_font' ) );
			add_action( 'vc_enqueue_font_icon_element', array( $this, 'enqueue_flaticon_font_on_frontend' ) );
		}

		/**
		 * Add Flat Icon Option to VC_Icon Element.
		 *
		 * @return void
		 */
		public function flaticon_add_to_iconbox() {
			$param = WPBMap::getParam( 'vc_icon', 'type' );
			$param['value'][ __( 'FlatIcon icons', 'js_composer' ) ] = 'flicon';

			vc_update_shortcode_param( 'vc_icon', $param );
		}

		/**
		 * Add Flat Icon Picker.
		 *
		 * @return void
		 */
		public function flaticon_add_font_picker() {
			$settings = array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'js_composer' ),
				'param_name'  => 'icon_flaticon',
				'settings'    => array(
					'emptyIcon'    => false,
					'type'         => 'flicon',
					'iconsPerPage' => 100,
				),
				'dependency'  => array(
					'element' => 'type',
					'value'   => 'flicon',
				),
				'weight'      => 15,
				'description' => __( 'Choose icon from library.', 'js_composer' ),
			);

			vc_add_param( 'vc_icon', $settings );
		}


		/**
		 * List of Flat Icons.
		 *
		 * @return array[]
		 */
		public function vc_iconpicker_type_flaticon() {
			return Realgymcore_Constants::get_flaticon_options();
		}

		/**
		 * Register Flat Icon CSS
		 *
		 * @return void
		 */
		public function flaticon_register_base_style() {
			wp_register_style( 'realgym-flat-icon', REALGYMCORE_CSS . '/flaticon.css', array(), REALGYMCORE_VERSION );
		}

		/**
		 * Enqueue Flat Icon CSS on WpBakery Admin.
		 *
		 * @return void
		 */
		public function enqueue_flaticon_font() {
			wp_enqueue_style( 'realgym-flat-icon' );
		}

		/**
		 * Enqueue Flat Icon CSS on Frontend.
		 *
		 * @param string $font Chosen font.
		 * @return void
		 */
		public function enqueue_flaticon_font_on_frontend( $font ) {
			if ( 'flicon' === $font ) {
				wp_enqueue_style( 'realgym-flat-icon' );
			}
		}
	}

	new Realgymcore_VC_Flaticon();
}
