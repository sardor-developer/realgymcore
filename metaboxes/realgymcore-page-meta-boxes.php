<?php
/**
 * RealgymCore - Page Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Page Meta Options
 *
 * @return array[]
 */
function realgymcore_get_page_meta_options() {
	return array(
		'id'         => 'realgymcore_page_meta_box',
		'title'      => esc_html__( 'Page Settings', 'realgymcore' ),
		'callback'   => 'realgymcore_page_meta_box',
		'post_types' => array( 'page', 'post', 'realgym-team', 'realgym-class', 'realgym-plan', 'realgym-faqs', 'realgym-video', 'realgym-stories' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-page-header-section',
				'title'  => esc_html__( 'Header', 'realgymcore' ),
				'icon'   => 'el el-screen',
				'fields' => array(
					array(
						'id'    => 'realgymcore_custom_header_bg',
						'type'  => 'color',
						'title' => esc_html__( 'Header Background Color', 'realgym' ),
						'desc'  => esc_html__( 'Pick a header background color for the theme. Otherwise it will take color from theme options', 'realgym' ),
					),
					array(
						'id'      => 'realgymcore_header_position',
						'type'    => 'select',
						'title'   => esc_html__( 'Choose Header Position', 'realgymcore' ),
						'desc'    => esc_html__( 'When Transparent style is applied, Header Background settings above will not work and it will ignore any background color.', 'realgym' ),
						'options' => array(
							'static'   => 'Default',
							'absolute' => 'Absolute',
						),
					),
					array(
						'id'      => 'realgymcore_is_header_sticky',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Sticky Header', 'realgymcore' ),
						'default' => false,
					),
					array(
						'id'      => 'realgymcore_is_header_sticky_tablet',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Sticky Header on Tablet (width < 992px)', 'realgymcore' ),
						'default' => true,
					),
					array(
						'id'      => 'realgymcore_is_header_sticky_mobile',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Sticky Header on Mobile  (width < 576px)', 'realgymcore' ),
						'default' => true,
					),
				),
			),
			array(
				'id'     => 'realgymcore-page-title-section',
				'title'  => esc_html__( 'Page Title', 'realgymcore' ),
				'icon'   => 'el el-font',
				'fields' => array(
					array(
						'id'      => 'realgymcore_enable_page_title',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Page Title Section', 'realgym' ),
						'default' => true,
					),
					array(
						'id'       => 'realgymcore_page_title_bg',
						'type'     => 'background',
						'title'    => esc_html__( 'Page Title Background Color', 'realgym' ),
						'desc'     => esc_html__( 'Pick a page title background image or color for the theme. Otherwise it will take color from theme options', 'realgym' ),
						'required' => array( 'realgymcore_enable_page_title', '=', true ),
					),
					array(
						'id'       => 'realgymcore_disable_page_title_bg',
						'type'     => 'switch',
						'title'    => esc_html__( 'Hide Page Title Background Image (Only Background Color)', 'realgym' ),
						'default'  => false,
						'required' => array( 'realgymcore_enable_page_title', '=', true ),
					),
					array(
						'id'       => 'realgymcore_show_page_title_breadcrumb',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Breadcrumbs', 'realgym' ),
						'default'  => true,
						'required' => array( 'realgymcore_enable_page_title', '=', true ),
					),
					array(
						'id'       => 'realgymcore_page_title_type',
						'type'     => 'select',
						'title'    => esc_html__( 'Choose one of option', 'realgymcore' ),
						'options'  => array(
							'page-title'   => 'Page Title',
							'custom-title' => 'Custom',
						),
						'default'  => 'page-title',
						'required' => array( 'realgymcore_enable_page_title', '=', true ),
					),
					array(
						'id'       => 'realgymcore_custom_page_title',
						'type'     => 'editor',
						'title'    => esc_html__( 'Custom Title', 'realgym' ),
						'required' => array( 'realgymcore_page_title_type', '=', 'custom-title' ),
						'args'     => array(
							'teeny'         => true,
							'media_buttons' => false,
							'textarea_rows' => 10,
						),
					),
				),
			),
			array(
				'id'     => 'realgymcore-page-footer-section',
				'title'  => esc_html__( 'Footer', 'realgymcore' ),
				'icon'   => 'el el-screen-alt',
				'fields' => array(
					array(
						'id'      => 'realgymcore_show_applications_section',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Applications Section', 'realgymcore' ),
						'default' => true,
					),
					array(
						'id'       => 'realgymcore_application_block_section_template',
						'type'     => 'select',
						'title'    => esc_html__( 'Select Block Template', 'realgym' ),
						'data'     => 'posts',
						'args'     => array(
							'post_type'      => 'realgymcore-block',
							'posts_per_page' => -1,
							'orderby'        => 'title',
							'order'          => 'ASC',
						),
						'required' => array( 'realgymcore_show_applications_section', '=', '1' ),
					),
				),
			),
		),
	);
}

/**
 * Zero Gym Add Page Meta Options
 *
 * @return void
 */
function realgymcore_add_page_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_page_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_page_meta_options' );

/**
 * RealgymCore Render Page Meta Box
 *
 * @return void
 */
function realgymcore_page_meta_box() {
	$meta_fields = realgymcore_get_page_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Page Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_page_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_page_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_page_meta_values' );
