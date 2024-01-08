<?php
/**
 * RealgymCore - Success Stories Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Success Stories Meta Options
 *
 * @return array[]
 */
function realgymcore_get_success_stories_meta_options() {
	$realgym_metabox_id = 'realgymcore-stories-metaboxes';

	return array(
		'id'         => $realgym_metabox_id,
		'title'      => esc_html__( 'RealGym Success Stories Settings', 'realgymcore' ),
		'post_types' => array( 'realgym-stories' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'callback'   => 'realgymcore_success_stories_meta_box',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-stories-general-section',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'General Section', 'realgymcore' ),
				'fields' => array(
					array(
						'id'       => 'realgymcore_author_name',
						'type'     => 'text',
						'title'    => esc_html__( 'Author Name', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Name', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_author_age',
						'type'     => 'number',
						'title'    => esc_html__( 'Author Age', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Age', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_author_occupation',
						'type'     => 'text',
						'title'    => esc_html__( 'Author Occupation', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Occupation', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_author_starting_weight',
						'type'     => 'text',
						'title'    => esc_html__( 'Starting Weight', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Starting Weight', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_author_current_weight',
						'type'     => 'text',
						'title'    => esc_html__( 'Current Weight', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Current Weight', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_training_duration',
						'type'     => 'text',
						'title'    => esc_html__( 'Training Duration', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Training Duration', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_fitness_trainer',
						'type'     => 'text',
						'title'    => esc_html__( 'Fitness Trainer', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Fitness Trainer', 'realgymcore' ),
					),
				),
			),
			array(
				'id'     => 'realgymcore-stories-description-section',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Success Stories Section', 'realgymcore' ),
				'fields' => array(
					array(
						'id'       => 'realgymcore_story_title',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Success Story Title', 'realgymcore' ),
						'subtitle' => esc_html__( 'Success Story Title', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_description',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Success Story Description', 'realgymcore' ),
						'subtitle' => esc_html__( 'Success Story Description', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_quotation_text',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Success Story Quotation text', 'realgymcore' ),
						'subtitle' => esc_html__( 'Enter Success Story text', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_first_title',
						'type'     => 'textarea',
						'title'    => esc_html__( 'The First Few Months Story Title', 'realgymcore' ),
						'subtitle' => esc_html__( 'The First Few Months Story Title', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_first_desc',
						'type'     => 'textarea',
						'title'    => esc_html__( 'The First Few Months Story Description', 'realgymcore' ),
						'subtitle' => esc_html__( 'The First Few Months Story Description', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_first_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'The First Few Months Image', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_six_title',
						'type'     => 'textarea',
						'title'    => esc_html__( 'The Six Months in Story Title', 'realgymcore' ),
						'subtitle' => esc_html__( 'The Six Months in Story Title', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_six_desc',
						'type'     => 'textarea',
						'title'    => esc_html__( 'The Six Months in Story Description', 'realgymcore' ),
						'subtitle' => esc_html__( 'The Six Months in Story Description', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_six_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'The Six Months in Image', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
				),
			),
			array(
				'id'     => 'realgymcore-images-fields',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Images', 'realgymcore' ),
				'fields' => array(
					array(
						'id'       => 'realgymcore_story_before_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Success Story Before Image', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_after_image',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Success Story After Image', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_gallery_image_1',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Success Story Gallery Image 1', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_gallery_image_2',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Success Story Gallery Image 2', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
					array(
						'id'       => 'realgymcore_story_gallery_image_3',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Success Story Gallery Image 3', 'realgymcore' ),
						'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader', 'realgymcore' ),
					),
				),
			),
		),
	);
}

/**
 * Success Stories Meta Options
 *
 * @return void
 */
function realgymcore_add_success_stories_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$meta_box = realgymcore_get_success_stories_meta_options();
	realgymcore_add_meta_box( $meta_box );

}

add_action( 'add_meta_boxes', 'realgymcore_add_success_stories_meta_options' );
/**
 * RealgymCore Render Success Stories Meta Box
 *
 * @return void
 */
function realgymcore_success_stories_meta_box() {
	$meta_fields = realgymcore_get_success_stories_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Success Stories Meta Options
 *
 * @param integer $post_id Post ID.
 *
 * @return void
 */
function realgymcore_save_success_stories_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen       = get_current_screen();
	$meta_options = realgymcore_get_success_stories_meta_options();
	$post_types   = $meta_options['post_types'];
	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}

add_action( 'save_post', 'realgymcore_save_success_stories_meta_values' );
/**
 * RealgymCore Get story images.
 *
 * @param int    $post_id Post id.
 * @param string $image_meta_key Meta key.
 *
 * @return string
 * @author Balcomsoft
 */
function realgymcore_success_stories_image( $post_id, $image_meta_key = '' ) {
	$post_id  = ( ! empty( $post_id ) ) ? $post_id : 0;
	$image    = ( get_post_meta( $post_id, $image_meta_key ) ) ? get_post_meta( $post_id, $image_meta_key, true ) : '';
	$response = REALGYMCORE_ASSETS . '/images/placeholder-1024x573.png';
	if ( ! empty( $image['id'] ) && intval( $image['id'] ) > 0 ) {
		$image_id = intval( $image['id'] );
		$image    = wp_get_attachment_image_url( $image_id, 'full' );
		if ( ! empty( $image ) ) {
			return $image;
		}
	}

	return $response;
}
