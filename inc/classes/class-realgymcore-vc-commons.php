<?php
/**
 * Social links widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_VC_Commons' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_VC_Commons {
		/**
		 * Get color type
		 *
		 * @return array
		 */
		public static function get_post_types() {
			return array(
				esc_html__( 'Post', 'realgymcore' )    => 'post',
				esc_html__( 'Team', 'realgymcore' )    => 'realgym-team',

				esc_html__( 'Video', 'realgymcore' )   => 'realgym-video',
				esc_html__( 'Classes', 'realgymcore' ) => 'realgym-class',
				esc_html__( 'Pricing Plan', 'realgymcore' ) => 'realgym-plan',
				esc_html__( 'Success Stories', 'realgymcore' ) => 'realgym-stories',

			);
		}

		/**
		 * Get color type
		 *
		 * @return array
		 */
		public static function get_theme_color_type() {
			return array(
				esc_html__( 'Default', 'realgymcore' )   => '',
				esc_html__( 'Primary', 'realgymcore' )   => 'realgym-vc-section-primary',
				esc_html__( 'Secondary', 'realgymcore' ) => 'realgym-vc-section-secondary',
				esc_html__( 'Gradient', 'realgymcore' )  => 'realgym-vc-section-gradient',
			);
		}

		/**
		 * Get Row Spacing Options
		 *
		 * @return array
		 */
		public static function get_row_spacing_options() {
			return array(
				esc_html__( 'Default', 'realgymcore' )   => '',
				esc_html__( 'No Padding Top', 'realgymcore' ) => 'realgym-vc-no-padding-top',
				esc_html__( 'No Padding Bottom', 'realgymcore' ) => 'realgym-vc-no-padding-bottom',
				esc_html__( 'Hide Both', 'realgymcore' ) => 'realgym-vc-no-padding',
			);
		}

		/**
		 * Get Background Position Options
		 *
		 * @return array
		 */
		public static function get_background_position_options() {
			return array(
				esc_html__( 'Theme Default', 'realgymcore' ) => '',
				esc_html__( 'Top Left', 'realgymcore' )    => 'realgym-vc-background-top-left',
				esc_html__( 'Top Center', 'realgymcore' )  => 'realgym-vc-background-top-center',
				esc_html__( 'Top Right', 'realgymcore' )   => 'realgym-vc-background-top-right',
				esc_html__( 'Center Left', 'realgymcore' ) => 'realgym-vc-background-left-center',
				esc_html__( 'Center', 'realgymcore' )      => 'realgym-vc-background-center',
				esc_html__( 'Center Right', 'realgymcore' ) => 'realgym-vc-background-right-center',
				esc_html__( 'Bottom Left', 'realgymcore' ) => 'realgym-vc-background-bottom-left',
				esc_html__( 'Bottom Center', 'realgymcore' ) => 'realgym-vc-background-bottom-center',
				esc_html__( 'Bottom Right', 'realgymcore' ) => 'realgym-vc-background-bottom-right',
			);
		}

		/**
		 * RealGym Responsive Options
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
				esc_html__( 'Ascending', 'realgymcore' )  => 'ASC',
				esc_html__( 'Descending', 'realgymcore' ) => 'DESC',
			);

			return $response;
		}


		/**
		 * VC REALGYM Options
		 *
		 * @return string[]
		 */
		public static function get_btn_options() {
			return array(
				esc_html__( 'Filled', 'realgymcore' )   => 'realgym_btn_filled',
				esc_html__( 'Outlined', 'realgymcore' ) => 'realgym_btn_outlined',
			);
		}

		/**
		 * VC REALGYM Options
		 *
		 * @return string[]
		 */
		public static function get_heading_style_options() {
			return array(
				esc_html__( 'Default', 'realgymcore' )   => '',
				esc_html__( 'Display 1', 'realgymcore' ) => 'realgym-display-1',
				esc_html__( 'Display 2', 'realgymcore' ) => 'realgym-display-2',
				esc_html__( 'Display 3', 'realgymcore' ) => 'realgym-display-3',
				esc_html__( 'Display 4', 'realgymcore' ) => 'realgym-display-4',
				esc_html__( 'Text 1', 'realgymcore' )    => 'realgym-text-1',
				esc_html__( 'Text 2', 'realgymcore' )    => 'realgym-text-2',
				esc_html__( 'Text 3', 'realgymcore' )    => 'realgym-text-3',
				esc_html__( 'Text 4', 'realgymcore' )    => 'realgym-text-4',
				esc_html__( 'Desc 1', 'realgymcore' )    => 'realgym-desc-1',
				esc_html__( 'Desc 2', 'realgymcore' )    => 'realgym-desc-2',
			);
		}

		/**
		 * VC REALGYM Text Transform Options
		 *
		 * @return string[]
		 */
		public static function get_heading_text_transform_options() {
			return array(
				esc_html__( 'Default', 'realgymcore' ) => '',
				esc_html__( 'Text Uppercase', 'realgymcore' ) => 'text-uppercase',
				esc_html__( 'Text Lowercase', 'realgymcore' ) => 'text-lowercase',
				esc_html__( 'Text Capitalize', 'realgymcore' ) => 'text-capitalize',
				esc_html__( 'Text Initial', 'realgymcore' ) => 'realgym-text-initial',
			);
		}
	}
}
