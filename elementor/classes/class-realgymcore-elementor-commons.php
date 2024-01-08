<?php
/**
 * Realgymcore Elementor Commons class.
 *
 * @author  Balcomsoft
 * @package Realgymcore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Elementor_Commons' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Commons {
		/**
		 * Init class.
		 *
		 * @author Balcomsoft
		 */
		public static function init() {
			add_action( 'init', 'self::set_global_elementor_colors' );
		}

		/**
		 * Get color type
		 *
		 * @param array $options Array of options.
		 *
		 * @return array
		 */
		public static function get_theme_color_type( $options = array() ) {
			$include_half_colored = isset( $options['include_half_colored'] ) && $options['include_half_colored'];
			$response             = array(
				__( 'Custom Color', 'realgymcore' ) => '',
				__( 'Dark Style', 'realgymcore' )   => 'realgymcore-vc-section-dark',
				__( 'Light Style', 'realgymcore' )  => 'realgymcore-vc-section-light',
			);
			if ( $include_half_colored ) {
				$response[ __( 'Half Colored', 'realgymcore' ) ] = 'realgymcore-vc-section-half-colored';
			}

			return $response;
		}

		/**
		 * Realgymcore Responsive Options
		 *
		 * @return string[]
		 */
		public static function get_responsive_options() {
			$response = array(
				esc_html__( '1', 'realgymcore' )  => '12',
				esc_html__( '2', 'realgymcore' )  => '6',
				esc_html__( '3', 'realgymcore' )  => '4',
				esc_html__( '4', 'realgymcore' )  => '3',
				esc_html__( '6', 'realgymcore' )  => '2',
				esc_html__( '12', 'realgymcore' ) => '1',
			);

			return $response;
		}

		/**
		 * Order Options
		 *
		 * @return string[]
		 */
		public static function get_order_options() {
			$response = array(
				__( 'Ascending', 'realgymcore' )  => 'ASC',
				__( 'Descending', 'realgymcore' ) => 'DESC',
			);

			return $response;
		}
		/**
		 * Set global colors.
		 */
		public static function set_global_elementor_colors() {
			$colors = self::get_theme_color_type();
			update_option(
				'elementor_scheme_color',
				array(
					1 => '#49484F',
					2 => '#908E99',
					3 => '#908E99',
					4 => '#FF7070',
				)
			);
		}
	}

}


