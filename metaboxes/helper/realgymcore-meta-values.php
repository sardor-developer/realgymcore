<?php
/**
 * REALGYMCore Function - Meta Values
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_get_default_attributes' ) ) :
	/**
	 * REALGYMCore - Get Default Attributes
	 *
	 * @return array
	 */
	function realgymcore_get_default_attributes() {

		return array(
			'id'          => '',
			'type'        => '',
			'name'        => '',
			'title'       => '',
			'subtitle'    => '',
			'desc'        => '',
			'default'     => '',
			'required'    => '',
			'placeholder' => '',
			'class'       => '',
			'options'     => '',
			'attributes'  => '',
			'hide_title'  => false,
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_repeat_options' ) ) :
	/**
	 * REALGYMCore - Get Background Repeat Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_repeat_options() {
		return array(
			''          => __( 'Default', 'realgymcore' ),
			'no-repeat' => __( 'No Repeat', 'realgymcore' ),
			'repeat'    => __( 'Repeat All', 'realgymcore' ),
			'repeat-x'  => __( 'Repeat Horizontally', 'realgymcore' ),
			'repeat-y'  => __( 'Repeat Vertically', 'realgymcore' ),
			'inherit'   => __( 'Inherit', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_size_options' ) ) :
	/**
	 * REALGYMCore - Get Background Size Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_size_options() {
		return array(
			''        => __( 'Default', 'realgymcore' ),
			'inherit' => __( 'Inherit', 'realgymcore' ),
			'cover'   => __( 'Cover', 'realgymcore' ),
			'contain' => __( 'Contain', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_attachments' ) ) :
	/**
	 * REALGYMCore - Get Background Attachment Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_attachments() {

		return array(
			''        => __( 'Default', 'realgymcore' ),
			'fixed'   => __( 'Fixed', 'realgymcore' ),
			'scroll'  => __( 'Scroll', 'realgymcore' ),
			'inherit' => __( 'Inherit', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_position_options' ) ) :
	/**
	 * REALGYMCore - Get Background Position Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_position_options() {

		return array(
			''              => __( 'Default', 'realgymcore' ),
			'left top'      => __( 'Left Top', 'realgymcore' ),
			'left center'   => __( 'Left Center', 'realgymcore' ),
			'left bottom'   => __( 'Left Bottom', 'realgymcore' ),
			'center top'    => __( 'Center Top', 'realgymcore' ),
			'center center' => __( 'Center Center', 'realgymcore' ),
			'center bottom' => __( 'Center Bottom', 'realgymcore' ),
			'right top'     => __( 'Right Top', 'realgymcore' ),
			'right center'  => __( 'Right Center', 'realgymcore' ),
			'right bottom'  => __( 'Right Bottom', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_origin_options' ) ) :
	/**
	 * REALGYMCore - Get Background Origin Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_origin_options() {
		return array(
			'inherit'     => esc_html__( 'Inherit', 'realgymcore' ),
			'border-box'  => esc_html__( 'Border Box', 'realgymcore' ),
			'content-box' => esc_html__( 'Content Box', 'realgymcore' ),
			'padding-box' => esc_html__( 'Padding Box', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_background_clip_options' ) ) :
	/**
	 * REALGYMCore - Get Background Clip Options
	 *
	 * @return array
	 */
	function realgymcore_get_background_clip_options() {
		return array(
			'inherit'     => esc_html__( 'Inherit', 'realgymcore' ),
			'border-box'  => esc_html__( 'Border Box', 'realgymcore' ),
			'content-box' => esc_html__( 'Content Box', 'realgymcore' ),
			'padding-box' => esc_html__( 'Padding Box', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_class_pricing_types' ) ) :
	/**
	 * REALGYMCore - Get Class Pricing Types
	 *
	 * @return array
	 */
	function realgymcore_get_class_pricing_types() {
		return array(
			'weekly'  => esc_html__( 'Weekly', 'realgymcore' ),
			'monthly' => esc_html__( 'Monthly', 'realgymcore' ),
			'yearly'  => esc_html__( 'Yearly', 'realgymcore' ),
		);
	}
endif;

if ( ! function_exists( 'realgymcore_get_weekdays' ) ) :
	/**
	 * REALGYMCore - Get Weekdays
	 *
	 * @return array
	 */
	function realgymcore_get_weekdays() {
		return array(
			'monday'    => esc_html__( 'Monday', 'realgymcore' ),
			'tuesday'   => esc_html__( 'Tuesday', 'realgymcore' ),
			'wednesday' => esc_html__( 'Wednesday', 'realgymcore' ),
			'thursday'  => esc_html__( 'Thursday', 'realgymcore' ),
			'friday'    => esc_html__( 'Friday', 'realgymcore' ),
			'saturday'  => esc_html__( 'Saturday', 'realgymcore' ),
			'sunday'    => esc_html__( 'Sunday', 'realgymcore' ),
		);
	}
endif;
