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
		'count_number'      => '',
		'items_per_row'     => '4',
		'counter'           => '',
		'count_addition'    => '',
		'count_description' => '',
		'element_class'     => '',
		'element_id'        => '',
		'css'               => '',
		'unique_class'      => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$counter              = realgymcore_param_parse_atts( $counter );
$unique_class_escaped = ( ! empty( $unique_class ) ) ? esc_attr( $unique_class ) : '';
$vc_class             = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	$element_class,
	$unique_class_escaped,
	$vc_class,
);

$array_defaults = array(
	'classes' => array(),
	'source'  => '',
);

?>
<?php if ( ! empty( $counter ) && count( $counter ) > 0 ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( realgymcore_esc_attr_check( $element_id ) ) . '"' : ''; ?>
			class="realgym-counter <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="row g-0">
			<?php foreach ( $counter as $counters ) : ?>
				<div class="col-lg-<?php echo esc_attr( $items_per_row ); ?> col-md-6 col-6">
					<div class="realgym-item">
						<div class="realgym-display-2">
							<?php if ( ! empty( $counters['count_number'] ) ) : ?>
								<span class="count"><?php echo esc_attr( $counters['count_number'] ); ?></span>
							<?php endif; ?>
							<?php echo ( ! empty( $counters['count_addition'] ) ) ? esc_html( $counters['count_addition'] ) . '' : ''; ?>
						</div>
						<p><?php echo ( ! empty( $counters['count_description'] ) ) ? esc_html( $counters['count_description'] ) . '' : ''; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
