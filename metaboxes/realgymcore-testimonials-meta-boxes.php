<?php
/**
 * RealgymCore - Testimonials Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Testimonials Meta Options
 *
 * @return array[]
 */
function realgymcore_get_testimonials_meta_options() {
	$realgym_metabox_id = 'realgymcore-testimonials-metaboxes';

	return array(
		'id'         => $realgym_metabox_id,
		'title'      => esc_html__( 'RealGym Testimonials Settings', 'realgymcore' ),
		'post_types' => array( 'realgym-testimonials' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'callback'   => 'realgymcore_testimonials_meta_box',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-testimonials-author-section',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Author Block', 'realgymcore' ),
				'fields' => array(
					array(
						'id'       => 'realgymcore_author_name',
						'type'     => 'text',
						'title'    => esc_html__( 'Author Name', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Author Name', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_author_description',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Author Description', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Author Description', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_client_type',
						'type'     => 'text',
						'title'    => esc_html__( 'Client Type', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Client Type', 'realgymcore' ),
					),
				),
			),
			array(
				'id'     => 'realgymcore-reviews-fields',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Reviews Block', 'realgymcore' ),
				'fields' => array(
					array(
						'id'       => 'realgymcore_testimonial_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Testimonial Image', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_review_count',
						'type'     => 'text',
						'title'    => esc_html__( 'Reviews Count Text', 'realgymcore' ),
						'subtitle' => __( 'Enter Reviews Count Text', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_rating',
						'type'     => 'text',
						'title'    => esc_html__( 'Rating', 'realgymcore' ),
						'subtitle' => __( 'Enter Rating', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_review_description',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Review Description', 'realgymcore' ),
						'subtitle' => __( 'Enter Review Description', 'realgymcore' ),
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
function realgymcore_add_testimonials_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_testimonials_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_testimonials_meta_options' );

/**
 * RealgymCore Render Pricing Plan Meta Box
 *
 * @return void
 */
function realgymcore_testimonials_meta_box() {
	$meta_fields = realgymcore_get_testimonials_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Pricing Plan Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_testimonials_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_testimonials_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_testimonials_meta_values' );

/**
 * Shortcode function image.
 *
 * @param array $atts Array of attributes.
 *
 * @return mixed
 * @author Balcomsoft
 */
function realgymcore_testimonials_image( $atts ) {
	$post_id = ( ! empty( $atts['id'] ) ) ? $atts['id'] : 0;
	$image   = ( get_post_meta( $post_id, 'realgymcore_testimonial_image' ) ) ? get_post_meta( $post_id, 'realgymcore_testimonial_image', true ) : '';

	$response = REALGYMCORE_ASSETS . '/images/placeholder-1024x573.png';
	if ( ! empty( $image['id'] ) && intval( $image['id'] ) > 0 ) {
		$image_id = intval( $image['id'] );

		$image = wp_get_attachment_image_url( $image_id, 'full' );
		if ( ! empty( $image ) ) {
			return $image;
		}
	}

	return $response;
}
add_shortcode( 'realgymcore_testimonials_image', 'realgymcore_testimonials_image' );
