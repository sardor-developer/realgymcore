<?php
/**
 * RealgymCore - Team Meta settings
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * RealgymCore Team Meta Options
 *
 * @return array[]
 */
function realgymcore_get_team_meta_options() {
	$realgym_metabox_id = 'realgymcore-team-metaboxes';
	$post_args          = array(
		'post_type'      => 'realgym-class',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	$socials               = Realgymcore_Constants::get_team_member_social_options();
	$social_section_fields = array();
	foreach ( $socials as $label => $value ) {
		$social_section_fields[] = array(
			'id'         => esc_attr( 'realgymcore_social_link_' . $value ),
			'section_id' => 'realgymcore-team-social-network',
			'type'       => 'text',
			'title'      => esc_attr( $label ),
		);
	}

	return array(
		'id'         => 'realgymcore_team_meta_box',
		'title'      => esc_html__( 'Team Settings', 'realgymcore' ),
		'callback'   => 'realgymcore_team_meta_box',
		'post_types' => array( 'realgym-team' ),
		'position'   => 'normal',
		'priority'   => 'high',
		'sections'   => array(
			array(
				'id'     => 'realgymcore-team-general-information',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'General Information', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_subtitle',
						'section_id' => 'realgymcore-team-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Subtitle', 'realgymcore' ),
					),
					array(
						'id'          => 'realgymcore_joining_date',
						'type'        => 'date',
						'section_id'  => 'realgymcore-team-general-information',
						'title'       => esc_html__( 'Joining Date', 'realgymcore' ),
						'placeholder' => 'Enter Joining Date',
					),
					array(
						'id'         => 'realgymcore_experience',
						'section_id' => 'realgymcore-team-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Experience', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_training',
						'section_id' => 'realgymcore-team-general-information',
						'type'       => 'text',
						'title'      => esc_html__( 'Type of Training', 'realgymcore' ),
					),
					array(
						'id'         => 'realgymcore_trainer_classes',
						'section_id' => 'realgymcore-team-general-information',
						'type'       => 'select',
						'title'      => esc_html__( 'Classes', 'realgym' ),
						'data'       => 'posts',
						'multi'      => true,
						'args'       => $post_args,
					),
				),
			),
			array(
				'id'     => 'realgymcore-team-personal-skills',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Personal Skills', 'realgymcore' ),
				'fields' => array(
					array(
						'id'         => 'realgymcore_weight_lifting',
						'section_id' => 'realgymcore-team-personal-skills',
						'type'       => 'number',
						'title'      => esc_html__( 'Weight lifting', 'realgymcore' ),
						'desc'       => esc_html__( 'Numbers counted as percentage(%), will be between 0 to 100, default: 50', 'realgymcore' ),
						'default'    => '50',
						'min'        => '0',
						'step'       => '5',
						'max'        => '100',
					),
					array(
						'id'         => 'realgymcore_cardio_training',
						'section_id' => 'realgymcore-team-personal-skills',
						'type'       => 'number',
						'title'      => esc_html__( 'Cardio training', 'realgymcore' ),
						'desc'       => esc_html__( 'Numbers counted as percentage(%), will be between 0 to 100, default: 50', 'realgymcore' ),
						'default'    => '50',
						'min'        => '0',
						'step'       => '5',
						'max'        => '100',
					),
					array(
						'id'         => 'realgymcore_fat_loss',
						'section_id' => 'realgymcore-team-personal-skills',
						'type'       => 'number',
						'title'      => esc_html__( 'Fat loss', 'realgymcore' ),
						'desc'       => esc_html__( 'Numbers counted as percentage(%), will be between 0 to 100, default: 50', 'realgymcore' ),
						'default'    => '50',
						'min'        => '0',
						'step'       => '5',
						'max'        => '100',
					),
					array(
						'id'         => 'realgymcore_activity',
						'section_id' => 'realgymcore-team-personal-skills',
						'type'       => 'number',
						'title'      => esc_html__( 'Activity', 'realgymcore' ),
						'desc'       => esc_html__( 'Numbers counted as percentage(%), will be between 0 to 100, default: 50', 'realgymcore' ),
						'default'    => '50',
						'min'        => '0',
						'step'       => '5',
						'max'        => '100',
					),
				),
			),
			array(
				'id'     => 'realgymcore_team_social_network',
				'box_id' => $realgym_metabox_id,
				'title'  => esc_html__( 'Social Network', 'realgymcore' ),
				'fields' => $social_section_fields,
			),
		),
	);
}

/**
 * Zero Gym Add Team Meta Options
 *
 * @return void
 */
function realgymcore_add_team_meta_options() {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}

	$meta_box = realgymcore_get_team_meta_options();
	realgymcore_add_meta_box( $meta_box );

}
add_action( 'add_meta_boxes', 'realgymcore_add_team_meta_options' );

/**
 * RealgymCore Render Team Meta Box
 *
 * @return void
 */
function realgymcore_team_meta_box() {
	$meta_fields = realgymcore_get_team_meta_options();
	realgymcore_render_meta_box( $meta_fields );
}

/**
 * RealgymCore Save Team Meta Options
 *
 * @param integer $post_id Post ID.
 * @return void
 */
function realgymcore_save_team_meta_values( $post_id ) {
	if ( ! function_exists( 'get_current_screen' ) ) {
		return;
	}
	$screen = get_current_screen();

	$meta_options = realgymcore_get_team_meta_options();
	$post_types   = $meta_options['post_types'];

	if ( $screen && 'post' === $screen->base && in_array( $screen->id, $post_types, true ) ) {
		realgymcore_save_meta_value( $post_id, $meta_options['sections'] );
	}
}
add_action( 'save_post', 'realgymcore_save_team_meta_values' );
