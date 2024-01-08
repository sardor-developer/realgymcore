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
		'timetable-title'            => '',
		'realgymcore_classes_ids'    => array(),
		'unique_class'               => '',
		'element_class'              => '',
		'element_id'                 => '',
		'css'                        => '',
		'realgymcore_txt_color'      => '',
		'realgymcore_bk_color'       => '',
		'realgymcore_time_bk_color'  => '',
		'realgymcore_time_txt_color' => '',
		'realgymcore_table_row'      => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgymcore-timetable',
	$element_class,
	$unique_class,
	$vc_class,
);

$args = array(
	'post_type' => 'realgym-class',
	'order'     => 'ASC',
	'orderby'   => 'post__in menu_order date',
);
foreach ( $realgymcore_classes_ids as $realgymcore_classes_id ) {
	$args['post__in'][] = (int) $realgymcore_classes_id;
}
$realgymcore_classes_data      = new WP_Query( $args );
$realgymcore_classes           = $realgymcore_classes_data->get_posts();
$realgymcore_weekdays          = Realgymcore_Constants::get_weekdays();
$realgymcore_colors            = array(
	'color' => 'realgymcore-classes-timeslot-text-color',
);
$realgymcore_timetable_classes = array();
foreach ( $realgymcore_classes as $realgymcore_class ) {
	// get class timeslots.
	$realgymcore_timetable = get_post_meta( $realgymcore_class->ID, 'realgymcore_class_timeslots_fields', true );

	$realgymcore_trainer      = ( get_post_meta( $realgymcore_class->ID, 'realgymcore_class_trainer' ) ) ? get_post_meta( $realgymcore_class->ID, 'realgymcore_class_trainer', true ) : '';
	$realgymcore_trainer      = ( get_post( $realgymcore_trainer ) ) ? get_post( $realgymcore_trainer ) : '';
	$realgymcore_trainer_name = ( ! empty( $realgymcore_trainer->post_title ) && 'realgym-team' === $realgymcore_trainer->post_type && 'publish' === $realgymcore_trainer->post_status ) ? $realgymcore_trainer->post_title : '';


	if ( ! empty( $realgymcore_timetable ) && is_array( $realgymcore_timetable ) ) {
		foreach ( $realgymcore_timetable as $item ) {
			foreach ( $realgymcore_weekdays as $wkey => $wday ) {
				if ( isset( $item['week_day'] ) && $wkey === $item['week_day'] ) {
					$realgymcore_timetable_classes[ $item['start_time'] ][ $wkey ] = array(
						'realgymcore_data' => $realgymcore_class,
						'end_time'         => $item['end_time'],
						'trainer'          => $realgymcore_trainer_name,
					);
				}
			}
		}
	}
}
?>
<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
		class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<div class="table-responsive-xl realgymcore-timetable">
		<table class="table">
			<thead>
			<tr>
				<th style="background: <?php echo esc_attr( $realgymcore_bk_color ); ?>;
						color: <?php echo esc_attr( $realgymcore_txt_color ); ?>;"
					scope="col"><i class="fi fi-rr-clock-three"></i>
				</th>
				<?php foreach ( $realgymcore_weekdays as $realgymcore_weekday ) : ?>
					<th class="realgymcore_timetable_bk_color realgymcore_timetable_txt_color" style="background: <?php echo esc_attr( $realgymcore_bk_color ); ?>;
							color: <?php echo esc_attr( $realgymcore_txt_color ); ?>;"
						scope="col"><?php echo esc_html( $realgymcore_weekday ); ?></th>
				<?php endforeach; ?>
			</tr>
			</thead>
			<tbody>
			<?php
			ksort( $realgymcore_timetable_classes );
			foreach ( $realgymcore_timetable_classes as $start_time => $realgymcore_timetable_class ) :
				?>
				<tr>
					<th  class="realgymcore_time_bk_color realgymcore_time_txt_color" style="background: <?php echo esc_attr( $realgymcore_time_bk_color ); ?>;
							color: <?php echo esc_attr( $realgymcore_time_txt_color ); ?>;"
						scope="row"><?php echo esc_html( $start_time ); ?></th>
					<?php
					foreach ( $realgymcore_weekdays as $wk_key => $wk_day ) {

						$realgymcore_tclass = ( ! empty( $realgymcore_timetable_class[ $wk_key ] ) ) ? $realgymcore_timetable_class[ $wk_key ] : array();
						$style              = '';
						foreach ( $realgymcore_colors as $kstyle => $realgymcore_color ) {
							if ( ! empty( $realgymcore_tclass['realgymcore_data']->ID ) ) {
								$realgymcore_style = ( get_post_meta( $realgymcore_tclass['realgymcore_data']->ID, $realgymcore_color, true ) ) ? get_post_meta( $realgymcore_tclass['realgymcore_data']->ID, $realgymcore_color, true ) : '';
								$style            .= "{$kstyle} : {$realgymcore_style};";
							}
						}
						?>
						<td class="text-truncate realgymcore_time_bk_color" style="<?php echo esc_attr( $style ); ?> background: <?php echo esc_attr( $realgymcore_time_bk_color ); ?>;">
							<?php
							if ( ! empty( $realgymcore_tclass['realgymcore_data']->post_title ) ) :
								?>
								<a class="realgymcore_link realgym-text-2" style="<?php echo esc_attr( $style ); ?> background: none;" href="<?php echo esc_url( get_permalink( $realgymcore_tclass['realgymcore_data']->ID ) ); ?>">
									<?php echo esc_html( $realgymcore_tclass['realgymcore_data']->post_title ); ?>
								</a>
								<div class="realgymcore_title realgym-text-3"><?php echo esc_html( $realgymcore_tclass['trainer'] ); ?></div>
							<?php endif; ?>
						</td>
					<?php } ?>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>
