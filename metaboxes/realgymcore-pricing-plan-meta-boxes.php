<?php
/**
 * RealgymCore - Pricing Plans Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Pricing Plan Meta Options
 *
 * @return array[]
 */
function realgymcore_get_pricing_plan_meta_options() {
	$realgym_metabox_id = 'realgymcore-pricing-plan-metaboxes';

	return array(
		'id'         => $realgym_metabox_id,
		'title'      => esc_html__( 'RealGym Plan Features Settings', 'realgymcore' ),
		'post_types' => array( 'realgym-plan' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'callback'   => 'realgymcore_pricing_plan_meta_box',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-plans-general-information',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'General', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_plan_subtitle',
						'section_id' => 'realgymcore-plans-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Plan Subtitle', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_plan_price',
						'section_id' => 'realgymcore-plans-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Plan Price', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_plan_popular',
						'section_id' => 'realgymcore-plans-general-information',
						'type'       => 'switch',
						'title'      => esc_html__( 'Popular Plan', 'realgymcore' ),
					),
				),
			),
			array(
				'id'     => 'realgymcore-plans-features',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Plan Features', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_plan_support',
						'section_id' => 'realgymcore-plans-features',
						'type'       => 'switch',
						'title'      => esc_html__( '24/7 GYM manager support', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_plan_freezing',
						'section_id' => 'realgymcore-plans-features',
						'type'       => 'switch',
						'title'      => esc_html__( 'Up to 45 days of freezing', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_plan_relaxing',
						'section_id' => 'realgymcore-plans-features',
						'type'       => 'switch',
						'title'      => esc_html__( 'Fight zone & Relaxing room', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_swimming_pool_access',
						'section_id' => 'realgymcore-plans-features',
						'type'       => 'time_range',
						'title'      => esc_html__( 'Swimming pool access time period', 'realgymcore' ),
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
function realgymcore_add_pricing_plan_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_pricing_plan_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_pricing_plan_meta_options' );

/**
 * RealgymCore Render Pricing Plan Meta Box
 *
 * @return void
 */
function realgymcore_pricing_plan_meta_box() {
	$meta_fields = realgymcore_get_pricing_plan_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Pricing Plan Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_pricing_plan_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_pricing_plan_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_pricing_plan_meta_values' );

/**
 * Getting Swimming Hours Options.
 *
 * @param string $key Param key.
 *
 * @return array|mixed Return array.
 * @author Balcomsoft
 */
function realgymcore_swimming_hrs_options( $key = '' ) {
	$realgymcore_swim_hrs = array(
		'9-13'  => esc_html__( '09:00 - 13:00', 'realgymcore' ),
		'13-18' => esc_html__( '13:00 - 18:00', 'realgymcore' ),
		'9-18'  => esc_html__( '09:00 - 18:00', 'realgymcore' ),
	);

	if ( ! empty( $realgymcore_swim_hrs[ $key ] ) ) {
		return $realgymcore_swim_hrs[ $key ];
	} else {
		return $realgymcore_swim_hrs;
	}
}
