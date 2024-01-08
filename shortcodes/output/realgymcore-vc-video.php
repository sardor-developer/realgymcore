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
		'video_id'      => null,
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgym-video-player',
	$element_class,
	$vc_class,
);

if ( ! empty( $video_id ) ) :
	?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?> class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php echo realgymcore_bmst_display_embedded_video( $video_id, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<?php
endif;
