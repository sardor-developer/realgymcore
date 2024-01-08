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
		'list'          => '',
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$list                  = realgymcore_param_parse_atts( $list );
$element_class_escaped = ( ! empty( $element_class ) ) ? esc_attr( $element_class ) : '';
$unique_class_escaped  = ( ! empty( $unique_class ) ) ? esc_attr( $unique_class ) : '';
$vc_class              = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgym-list',
	$element_class_escaped,
	$unique_class_escaped,
	$vc_class,
);


if ( ! empty( $list ) && count( $list ) > 0 ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( realgymcore_esc_attr_check( $element_id ) ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<ul>
			<?php
			foreach ( $list as $lists ) :
				$icon_style = 'style="';
				if ( ! empty( $lists['color_icon'] ) || ! empty( $lists['size_icon'] ) ) {
					$icon_style .= ( ! empty( $lists['color_icon'] ) ) ? 'color: ' . esc_attr( $lists['color_icon'] ) . ';' : '';
					$icon_style .= ( ! empty( $lists['size_icon'] ) ) ? 'font-size: ' . esc_attr( $lists['size_icon'] ) . 'px;' : '';
				}
				$icon_style .= '"';
				?>
				<li class="realgym-list-item">
					<span <?php echo wp_kses_post( $icon_style ); ?>>
						<i class="<?php echo ( ! empty( $lists['list_icon'] ) ) ? esc_attr( $lists['list_icon'] ) . '' : ''; ?>"></i>
					</span>
					<?php echo ( ! empty( $lists['list_text'] ) ) ? wp_kses_post( $lists['list_text'] ) . '' : ''; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
endif;
