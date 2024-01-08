<?php
/**
 * RealGym Shortcode output
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$result = shortcode_atts(
	array(
		'block_id'      => '',
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$unique_class_escaped = ( ! empty( $unique_class ) ) ? esc_attr( $unique_class ) : '';

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	$element_class,
	$unique_class_escaped,
	$vc_class,
);

$block_id = absint( $block_id );

if ( $block_id > 0 ) {
	echo do_shortcode( '[realgymcore-block-template id="' . $block_id . '"]' );
}
