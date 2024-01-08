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
		'iconbox'       => '',
		'box_style'     => 'first',
		'items_per_row' => '3',
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
		'add_shadow'    => '',
		'add_opacity'   => '',

	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$iconbox_items         = realgymcore_param_parse_atts( $iconbox );
$element_class_escaped = ( ! empty( $element_class ) ) ? esc_attr( $element_class ) : '';
$unique_class_escaped  = ( ! empty( $unique_class ) ) ? esc_attr( $unique_class ) : '';
$vc_class              = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgym-icon-box',
	$element_class_escaped,
	$unique_class_escaped,
	$vc_class,
);

$array_defaults      = array(
	'classes' => array(),
	'source'  => '',
);
$icon_box_item_class = '';
if ( ! empty( $add_shadow ) ) {
	$icon_box_item_class .= ' realgym-box-shadow';
}
if ( ! empty( $add_opacity ) ) {
	$icon_box_item_class .= ' realgym-box-opacity';
}

?>

<?php if ( 'first' === $box_style ) : ?>
	<?php if ( ! empty( $iconbox_items ) && count( $iconbox_items ) > 0 ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( realgymcore_esc_attr_check( $element_id ) ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="">
		<div class="row">
			<?php
			foreach ( $iconbox_items as $iconbox ) :
				$icon_style = 'style="';
				if ( ! empty( $iconbox['color_icon'] ) || ! empty( $iconbox['size_icon'] ) ) {
					$icon_style .= ( ! empty( $iconbox['color_icon'] ) ) ? 'color: ' . esc_attr( $iconbox['color_icon'] ) . ';' : '';
					$icon_style .= ( ! empty( $iconbox['size_icon'] ) ) ? 'font-size: ' . esc_attr( $iconbox['size_icon'] ) . 'px;' : '';
				}
				$icon_style .= '"';
				?>
				<div class="col-lg-<?php echo esc_attr( $items_per_row ); ?>">
					<div class="realgym-icon-box-item <?php echo esc_attr( $icon_box_item_class ); ?>">
						<i <?php echo wp_kses_post( $icon_style ); ?>
								class="<?php echo ( ! empty( $iconbox['box_icon'] ) ) ? esc_attr( $iconbox['box_icon'] ) : ''; ?>"></i>
						<div class="realgym-icon-box-text">
							<h3><?php echo ( ! empty( $iconbox['box_title'] ) ) ? esc_html( $iconbox['box_title'] ) : ''; ?></h3>
							<p><?php echo ( ! empty( $iconbox['box_description'] ) ) ? esc_html( $iconbox['box_description'] ) : ''; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>

<?php elseif ( 'second' === $box_style ) : ?>
	<?php if ( ! empty( $iconbox_items ) && count( $iconbox_items ) > 0 ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( realgymcore_esc_attr_check( $element_id ) ) . '"' : ''; ?>
			class="realgym-icon-box-second realgym-icon-box-round <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="row">
			<?php
			foreach ( $iconbox_items as $iconbox ) :
				$icon_style = 'style="';
				if ( ! empty( $iconbox['color_icon'] ) || ! empty( $iconbox['size_icon'] ) ) {
					$icon_style .= ( ! empty( $iconbox['color_icon'] ) ) ? 'color: ' . esc_attr( $iconbox['color_icon'] ) . ';' : '';
					$icon_style .= ( ! empty( $iconbox['size_icon'] ) ) ? 'font-size: ' . esc_attr( $iconbox['size_icon'] ) . 'px;' : '';
				}
				$icon_style .= '"';
				?>
				<div class="col-lg-12">
					<div class="realgym-icon-box-item">
						<i <?php echo wp_kses_post( $icon_style ); ?>
								class="<?php echo ( ! empty( $iconbox['box_icon'] ) ) ? esc_attr( $iconbox['box_icon'] ) . '' : ''; ?>"></i>
						<div class="realgym-icon-box-text">
							<div class="realgym-text-1"><?php echo ( ! empty( $iconbox['box_title'] ) ) ? esc_html( $iconbox['box_title'] ) . '' : ''; ?></div>
							<p><?php echo ( ! empty( $iconbox['box_description'] ) ) ? esc_html( $iconbox['box_description'] ) . '' : ''; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?php elseif ( 'third' === $box_style ) : ?>
	<?php if ( ! empty( $iconbox_items ) && count( $iconbox_items ) > 0 ) : ?>
<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( realgymcore_esc_attr_check( $element_id ) ) . '"' : ''; ?>
		class="realgym-icon-box-third realgym-icon-box-round <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="row">
			<?php
			foreach ( $iconbox_items as $iconbox ) :
				$icon_style = 'style="';
				if ( ! empty( $iconbox['color_icon'] ) || ! empty( $iconbox['size_icon'] ) ) {
					$icon_style .= ( ! empty( $iconbox['color_icon'] ) ) ? 'color: ' . esc_attr( $iconbox['color_icon'] ) . ';' : '';
					$icon_style .= ( ! empty( $iconbox['size_icon'] ) ) ? 'font-size: ' . esc_attr( $iconbox['size_icon'] ) . 'px;' : '';
				}
				$icon_style .= '"';
				?>
			<div class="col-lg-<?php echo esc_attr( $items_per_row ); ?> col-12">
				<div class="realgym-icon-box-item">
					<i <?php echo wp_kses_post( $icon_style ); ?>
							class="<?php echo ( ! empty( $iconbox['box_icon'] ) ) ? esc_attr( $iconbox['box_icon'] ) . '' : ''; ?>"></i>
					<div class="realgym-icon-box-text">
						<div class="realgym-text-2"><?php echo ( ! empty( $iconbox['box_description'] ) ) ? wp_kses_post( $iconbox['box_description'] ) . '' : ''; ?></div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	</div>
</div>
	<?php endif; ?>
	<?php endif; ?>
