<?php
/**
 * RealgymCore Video Meta Boxes
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Video Meta Options
 *
 * @return array[]
 */
function realgymcore_get_video_meta_options() {
	$realgym_metabox_id = 'realgymcore-video-metaboxes';

	return array(
		'id'         => 'realgym-video-metaboxes',
		'title'      => esc_html__( 'Video Settings', 'realgymcore' ),
		'post_types' => array( 'realgym-video' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'callback'   => 'realgymcore_video_meta_box',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-video-source',
				'title'  => esc_html__( 'Video', 'realgymcore' ),
				'box_id' => $realgym_metabox_id,
				'fields' => array(
					array(
						'id'       => 'realgymcore_video_url',
						'type'     => 'text',
						'title'    => esc_html__( 'Video URL', 'realgymcore' ),
						'subtitle' => __( 'You can enter direct link to video file. YouTube and Vimeo URL also supported.', 'realgymcore' ),
					),
					array(
						'id'      => 'realgymcore_video_featured',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show this video as featured', 'realgymcore' ),
						'default' => false,
					),
				),
			),
		),
	);
}

/**
 * Zero Gym Add Video Meta Options
 *
 * @return void
 */
function realgymcore_add_video_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_video_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_video_meta_options' );

/**
 * RealgymCore Render Video Meta Box
 *
 * @return void
 */
function realgymcore_video_meta_box() {
	$meta_fields = realgymcore_get_video_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Video Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_video_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_video_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_video_meta_values' );
