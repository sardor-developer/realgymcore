<?php
/**
 * Elementor elements.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Elementor_Elements' ) ) :
	/**
	 *  Realgymcore_Elementor_Elements
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Elements {

		/**
		 *  Constructor
		 */
		public function __construct() {

			if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
				return;
			}
			add_action( 'elementor/elements/elements_registered', array( $this, 'customize_elements' ) );
		}


		/**
		 * Customize elements.
		 *
		 * @return void
		 */
		public function customize_elements() {
			include_once REALGYMCORE_ELEMENTOR_PATH . '/elementor/elements/class-realgymcore-elementor-section-component.php';
			Elementor\Plugin::$instance->elements_manager->unregister_element_type( 'section' );
			Elementor\Plugin::$instance->elements_manager->register_element_type( new Realgymcore_Elementor_Section_Component() );
		}
	}

	new Realgymcore_Elementor_Elements();
endif;
