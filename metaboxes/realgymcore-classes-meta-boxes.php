<?php
/**
 * RealgymCore - Classes Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Classes Meta Options
 *
 * @return array[]
 */
function realgymcore_get_classes_meta_options() {
	$realgym_metabox_id = 'realgymcore-classes-metaboxes';

	return array(
		'id'         => $realgym_metabox_id,
		'title'      => esc_html__( 'RealGym Classes Settings', 'realgymcore' ),
		'post_types' => array( 'realgym-class' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'callback'   => 'realgymcore_classes_meta_box',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-classes-general-information',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'General', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_class_period',
						'section_id' => 'realgymcore-classes-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Class Period', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_class_training_type',
						'section_id' => 'realgymcore-classes-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Type of Training', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_class_price_type',
						'type'       => 'select',
						'section_id' => 'realgymcore-classes-general-information',
						'title'      => esc_html__( 'Select Pricing Type', 'realgymcore' ),
						'options'    => realgymcore_get_class_pricing_types(),
						'default'    => 'monthly',
					),
					array(
						'id'         => 'realgymcore_class_full_type',
						'section_id' => 'realgymcore-classes-general-information',
						'type'       => 'text',
						'attributes' => array( 'type' => 'number' ),
						'title'      => esc_html__( 'Class Fullness', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_class_price',
						'section_id' => 'realgymcore-classes-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Price', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_class_icon',
						'section_id' => 'realgymcore-classes-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Class Icon', 'realgymcore' ),
					),
				),
			),
			array(
				'id'     => 'realgymcore-contact-details',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Contact Details', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_class_trainer',
						'section_id' => 'realgymcore-classes-contact-details',
						'title'      => esc_html__( 'Trainer', 'realgymcore' ),
						'data'       => 'posts',
						'type'       => 'select',
						'args'       => array(
							'posts_per_page' => -1,
							'orderby'        => 'title',
							'post_type'      => 'realgym-team',
							'post_status'    => 'publish',
							'order'          => 'ASC',
						),
					),
					array(
						'id'         => 'realgymcore_class_phone',
						'section_id' => 'realgymcore-classes-contact-details',
						'type'       => 'text',
						'title'      => esc_html__( 'Phone Number', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_class_email',
						'section_id' => 'realgymcore-classes-contact-details',
						'type'       => 'text',
						'title'      => esc_html__( 'Email', 'realgymcore' ),
						'attributes' => array( 'type' => 'email' ),
					),
				),
			),
			array(
				'title'  => __( 'Timeslots', 'realgymcore' ),
				'id'     => 'realgymcore-classes-timeslot-section',
				'box_id' => $realgym_metabox_id,
				'desc'   => esc_html__( 'Please set Class week day and time.', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_class_timeslots_fields',
						'type'       => 'repeater',
						'title'      => esc_html__( 'Timeslots', 'realgymcore' ),
						'full_width' => true,
						'item_name'  => '',
						'fields'     => array(
							array(
								'id'          => 'week_day',
								'type'        => 'select',
								'multi'       => false,
								'title'       => esc_html__( 'Select Week Day', 'realgymcore' ),
								'options'     => realgymcore_get_weekdays(),
								'placeholder' => esc_html__( 'Week day', 'realgymcore' ),
							),
							array(
								'id'    => 'start_time',
								'type'  => 'time',
								'title' => esc_html__( 'Start time', 'realgymcore' ),
							),
							array(
								'id'    => 'end_time',
								'type'  => 'time',
								'title' => esc_html__( 'End Time', 'realgymcore' ),
							),
						),
					),
				),
			),
			array(
				'title'  => __( 'Timetable styles', 'realgymcore' ),
				'id'     => 'realgymcore-classes-timeslot-styles',
				'box_id' => $realgym_metabox_id,
				'desc'   => esc_html__( 'Please set class colors in timetable ', 'realgymcore' ),
				'fields' => array(
					array(
						'title'   => esc_html__( 'Timetable Background Color', 'realgymcore' ),
						'id'      => 'realgymcore_class_timeslot_background_color',
						'type'    => 'color',
						'default' => '#BCFE2F',
					),
					array(
						'title'   => esc_html__( 'Timetable Background Hover Color', 'realgymcore' ),
						'id'      => 'realgymcore_class_timeslot_background_hover_color',
						'type'    => 'color',
						'default' => '#BCFE2F',
					),
					array(
						'title'   => esc_html__( 'Timetable Text Color', 'realgymcore' ),
						'id'      => 'realgymcore_class_timeslot_text_color',
						'type'    => 'color',
						'default' => '#0E1722',
					),
					array(
						'title'   => esc_html__( 'Timetable Text Hover Color', 'realgymcore' ),
						'id'      => 'realgymcore_class_timeslot_text_hover_color',
						'type'    => 'color',
						'default' => '#0B1117',
					),
				),
			),
		),
	);
}

/**
 * Zero Gym Add Pricing Plan Meta Options
 *
 * @return void
 */
function realgymcore_add_classes_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_classes_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_classes_meta_options' );

/**
 * RealgymCore Render Pricing Plan Meta Box
 *
 * @return void
 */
function realgymcore_classes_meta_box() {
	$meta_fields = realgymcore_get_classes_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}


/**
 * * RealgymCore Save Pricing Plan Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_classes_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_classes_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_classes_meta_values' );
