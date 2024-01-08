<?php
/**
 * VC Elements
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_load_vc_shortcodes' ) ) {
	/**
	 * Load VC shortcodes
	 *
	 * @return void
	 */
	function realgymcore_load_vc_shortcodes() {
		if ( function_exists( 'vc_map' ) ) {

			$base_group = esc_html__( 'RealGym Options', 'realgymcore' );

			// START: Customize Sections.
			vc_add_param(
				'vc_section',
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Swap with Div tag instead of Section?', 'realgymcore' ),
					'param_name' => 'is_div_tag',
					'value'      => array( esc_html__( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
				)
			);
			vc_add_param(
				'vc_section',
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Wrap with Container?', 'realgymcore' ),
					'param_name' => 'is_container',
					'value'      => array( esc_html__( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
				)
			);
			vc_add_param(
				'vc_section',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Color Style', 'realgymcore' ),
					'param_name'  => 'background_color_class',
					'value'       => realgymcore_vc_commons( 'color_type' ),
					'description' => esc_html__( 'Background Color based on Theme Color Configuration. It should not be used when custom background color is active', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_section',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Position', 'realgymcore' ),
					'param_name'  => 'realgym_background_position',
					'value'       => realgymcore_vc_commons( 'background_position_options' ),
					'description' => esc_html__( 'Background Image Positions', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_section',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Spacing Style', 'realgymcore' ),
					'param_name'  => 'realgym_spacing_style',
					'value'       => realgymcore_vc_commons( 'padding_options' ),
					'description' => esc_html__( 'Padding sizes are based on Theme Color Configuration.', 'realgymcore' ),
				)
			);
			// END: Customize Sections.

			// START: Customize Rows.
			vc_add_param(
				'vc_row',
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Row as a Section?', 'realgymcore' ),
					'param_name' => 'is_section',
					'value'      => array( esc_html__( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
				)
			);
			vc_add_param(
				'vc_row',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Color Style', 'realgymcore' ),
					'param_name'  => 'background_color_class',
					'value'       => realgymcore_vc_commons( 'color_type' ),
					'description' => esc_html__( 'Background Color based on Theme Color Configuration. It should not be used when custom background color is active', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_row',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Position', 'realgymcore' ),
					'param_name'  => 'realgym_background_position',
					'value'       => realgymcore_vc_commons( 'background_position_options' ),
					'description' => esc_html__( 'Background Image Positions', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_row',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Spacing Style', 'realgymcore' ),
					'param_name'  => 'realgym_spacing_style',
					'value'       => realgymcore_vc_commons( 'padding_options' ),
					'description' => esc_html__( 'Padding sizes are based on Theme Color Configuration.', 'realgymcore' ),
				)
			);
			// END: Customize Rows.

			// START: Customize Rows Inner.
			vc_add_param(
				'vc_row_inner',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Color Style', 'realgymcore' ),
					'param_name'  => 'background_color_class',
					'value'       => realgymcore_vc_commons( 'color_type' ),
					'description' => esc_html__( 'Background Color based on Theme Color Configuration. It should not be used when custom background color is active', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_row_inner',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Position', 'realgymcore' ),
					'param_name'  => 'realgym_background_position',
					'value'       => realgymcore_vc_commons( 'background_position_options' ),
					'description' => esc_html__( 'Background Image Positions', 'realgymcore' ),
				)
			);
			vc_add_param(
				'vc_row_inner',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Spacing Style', 'realgymcore' ),
					'param_name'  => 'realgym_spacing_style',
					'value'       => realgymcore_vc_commons( 'padding_options' ),
					'description' => esc_html__( 'Padding sizes are based on Theme Color Configuration.', 'realgymcore' ),
				)
			);
			// END: Customize Rows Inner.

			// START: Customize Column.
			vc_add_param(
				'vc_column',
				array(
					'type'        => 'dropdown',
					'group'       => $base_group,
					'heading'     => esc_html__( 'Background Position', 'realgymcore' ),
					'param_name'  => 'realgym_background_position',
					'value'       => realgymcore_vc_commons( 'background_position_options' ),
					'description' => esc_html__( 'Background Image Positions', 'realgymcore' ),
				)
			);
			// END: Customize Column.

			// START: Customize Custom Heading.
			vc_add_param(
				'vc_custom_heading',
				array(
					'type'        => 'textarea_raw_html',
					'heading'     => esc_html__( 'Text (HTML)', 'realgymcore' ),
					'param_name'  => 'realgymcore_html_text',
					'description' => esc_html__( 'Only supports: span, p, br, em and strong tags', 'realgymcore' ),
					'weight'      => 2,
					'dependency'  => array(
						'element' => 'source',
						'value'   => array( 'realgymcore_custom_html' ),
					),
				)
			);

			vc_add_param(
				'vc_custom_heading',
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Zero Gym Heading Style', 'realgymcore' ),
					'param_name' => 'realgym_heading_style',
					'value'      => realgymcore_vc_commons( 'heading_vc_styles' ),
					'group'      => $base_group,
				)
			);

			vc_add_param(
				'vc_custom_heading',
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Zero Gym Text Transform', 'realgymcore' ),
					'param_name' => 'realgym_heading_text_transform',
					'value'      => realgymcore_vc_commons( 'heading_vc_text_transform' ),
					'group'      => $base_group,
				)
			);
			// END: Customize Custom Heading.

			// START: Custom Button Params.
			vc_add_param(
				'vc_btn',
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Zero Gym Button Style', 'realgymcore' ),
					'param_name' => 'realgym_btn_style',
					'group'      => $base_group,
					'value'      => realgymcore_vc_commons( 'btn_vc_options' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'realgym-vc-btn-default' ),
					),
				)
			);
			vc_add_param(
				'vc_btn',
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Default Margin?', 'realgymcore' ),
					'param_name' => 'realgym_hide_margin_bottom',
					'value'      => array( esc_html__( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'realgym-vc-btn-default' ),
					),
				)
			);
			vc_add_param(
				'vc_btn',
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Add shadow', 'realgymcore' ),
					'param_name' => 'add_shadow',
					'value'      => array( __( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
				),
			);
			// END: Custom Button Params.

			// START: Photo gallery.
			vc_add_param(
				'vc_gallery',
				array(
					'type'       => 'autocomplete',
					'heading'    => esc_html__( 'Zero Gym Videos', 'realgymcore' ),
					'param_name' => 'realgym_videos',
					'group'      => $base_group,
					'settings'   => array(
						'multiple'      => true,
						'sortable'      => false,
						'groups'        => false,
						'unique_values' => true,
						'no_hide'       => true,
						'values'        => realgymcore_vc_get_autocomplete_post( 'realgym-video' ),
					),
				)
			);
			// END: Photo gallery.

			// START: Single Image.
			vc_add_param(
				'vc_single_image',
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Image Responsive?', 'realgymcore' ),
					'param_name' => 'realgym_is_responsive',
					'value'      => array( esc_html__( 'Yes, please', 'realgymcore' ) => 'yes' ),
					'group'      => $base_group,
				)
			);
			// END: Single Image.
		}
	}

	add_action( 'vc_after_init', 'realgymcore_load_vc_shortcodes' );


	/**
	 * Add Custom Options to the WBakery Button Element for Zero Gym.
	 *
	 * @return void
	 */
	function realgymcore_vc_btn_custom_options() {
		if ( class_exists( 'WPBMap' ) ) {
			try {
				$style = WPBMap::getParam( 'vc_btn', 'style' );

				$style['value'][ esc_html__( 'Zero Gym Default Style', 'realgymcore' ) ] = 'realgym-vc-btn-default';
				$style['value'][ esc_html__( 'Zero Gym Custom Style', 'realgymcore' ) ]  = 'realgym-vc-btn-custom';

				vc_update_shortcode_param( 'vc_btn', $style );

				$params = array( 'shape', 'color', 'size', 'align' );
				foreach ( $params as $el_param ) {
					$param = WPBMap::getParam( 'vc_btn', $el_param );
					if ( ! empty( $param ) ) {
						$conditions = array( 'realgym-vc-btn-default' );
						if ( 'color' === $el_param ) {
							$conditions[] = 'realgym-vc-btn-custom';
						}
						$param['dependency'] = array(
							'element'            => 'style',
							'value_not_equal_to' => $conditions,
						);
						vc_update_shortcode_param( 'vc_btn', $param );
					}
				}
			} catch ( Exception $e ) {
				echo 'Caught exception: ', wp_kses_post( $e->getMessage() ), "\n";
			}
		}
	}

	add_action( 'vc_after_init', 'realgymcore_vc_btn_custom_options' );

	/**
	 * Add Custom Options to the WBakery iconpicker element for Zero Gym.
	 *
	 * @return void
	 */
	function realgymcore_vc_icon_options() {
		if ( class_exists( 'WPBMap' ) ) {
			try {
				$type = WPBMap::getParam( 'vc_icon', 'type' );

				$type['weight'] = 20;

				vc_update_shortcode_param( 'vc_icon', $type );
			} catch ( Exception $e ) {
				echo 'Caught exception: ', wp_kses_post( $e->getMessage() ), "\n";
			}
		}
	}

	add_action( 'vc_after_init', 'realgymcore_vc_icon_options' );


	/**
	 * Add custom option to Source of Custom Heading Element
	 *
	 * @return void
	 */
	function realgymcore_vc_custom_heading_options() {
		if ( class_exists( 'WPBMap' ) ) {
			try {
				$source = WPBMap::getParam( 'vc_custom_heading', 'source' );

				$source['value'][ esc_html__( 'Custom Text (Supports Simple HTML Tags)', 'realgymcore' ) ] = 'realgymcore_custom_html';
				$source['weight'] = 3;

				vc_update_shortcode_param( 'vc_custom_heading', $source );
			} catch ( Exception $e ) {
				echo 'Caught exception: ', wp_kses_post( $e->getMessage() ), "\n";
			}
		}
	}

	add_action( 'vc_after_init', 'realgymcore_vc_custom_heading_options' );
}
