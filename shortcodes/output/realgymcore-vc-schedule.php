<?php
/**
 * RealGym Shortcode output
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

wp_enqueue_style( 'realgymcore-vc-schedule', REALGYMCORE_CSS . '/components/realgymcore-vc-schedule.css', array(), REALGYMCORE_VERSION );

$result = shortcode_atts(
	array(
		'shedule-title' => '',
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$args
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgymcore-shedule',
	$element_class,
	$unique_class,
	$vc_class,
);

$realgymcore_weekdays = Realgymcore_Constants::get_weekdays();

global $post;

if ( $post ) {
	// get class timeslots.
	$realgymcore_trainer      = ( get_post_meta( $post->ID, 'realgymcore-classes-trainer' ) ) ? get_post_meta( $post->ID, 'realgymcore-classes-trainer', true ) : '';
	$realgymcore_trainer      = ( get_post( $realgymcore_trainer ) ) ? get_post( $realgymcore_trainer ) : '';
	$realgymcore_trainer_name = ( ! empty( $realgymcore_trainer->post_title ) && 'realgym-team' === $realgymcore_trainer->post_type && 'publish' === $realgymcore_trainer->post_status ) ? $realgymcore_trainer->post_title : '';

	$realgymcore_timetable = get_post_meta( $post->ID, 'realgymcore_class_timeslots_fields', true );

	$realgymcore_timetable_classes = array();
	if ( ! empty( $realgymcore_timetable ) && is_array( $realgymcore_timetable ) ) {
		foreach ( $realgymcore_timetable as $key => $item ) {
			if ( ! empty( $item['week_day'] ) && ! empty( $item['start_time'] ) ) {
				$realgymcore_timetable_classes[ $item['week_day'] ][ $key ] = array(
					'realgymcore_data' => $post,
					'start_time'       => $item['start_time'],
					'end_time'         => $item['end_time'],
				);
			}
		}
	}
	?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<div class="row">
			<?php
			foreach ( $realgymcore_weekdays as $wk_key => $wk_day ) {

				?>
				<div class="col-lg-4 col-6 g-4">
					<div class="realgymcore-schedule-item">
						<h3 class="realgym-heading-3"><?php echo esc_html( $wk_day ); ?></h3>
						<?php
						if ( ! empty( $realgymcore_timetable_classes[ $wk_key ] ) ) {
							foreach ( $realgymcore_timetable_classes[ $wk_key ] as $timeslots ) {
								$start_time = ( ! empty( $timeslots['start_time'] ) ) ? $timeslots['start_time'] : '';
								$end_time   = ( ! empty( $timeslots['end_time'] ) ) ? $timeslots['end_time'] : '';
								?>
								<p class="realgym-heading-5">
									<?php
									if ( ! empty( $start_time ) ) {
										echo esc_html( wp_date( 'g:i', strtotime( $timeslots['start_time'] ) ) );}
									?>
									<span class="realgymcore-schedule-time">
									<?php
									if ( $start_time ) {
										echo esc_html( wp_date( 'A', strtotime( $timeslots['start_time'] ) ) );}
									?>
									</span>
									—
									<?php
									if ( $end_time ) {
										echo esc_html( wp_date( 'g:i', strtotime( $timeslots['end_time'] ) ) );}
									?>
									<span class="realgymcore-schedule-time">
									<?php
									if ( $end_time ) {
										echo esc_html( wp_date( 'A', strtotime( $timeslots['end_time'] ) ) );}
									?>
									</span>
								</p>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>
<?php } ?>
