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
		'limit'            => 1,
		'videos'           => array(),
		'videos_max_pages' => 1,
		'current_page'     => 1,
		'unique_class'     => '',
		'element_class'    => '',
		'element_id'       => '',
		'css'              => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgym-videos-grid',
	$element_class,
	$unique_class,
	$vc_class,
);

?>
<?php if ( ! empty( $videos ) ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
		class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="section-content realgym-single-video-section">
			<div class="row">
			<?php foreach ( $videos as $video ) : ?>
				<div class="col-sm-6 col-md-4">
					<div class="realgym-loop-featured-item">
						<div class="realgym-loop-featured-image">
							<?php
							if ( ! empty( get_post_meta( $video->ID, 'realgymcore_video_url', true ) ) ) {
								get_template_part( 'partials/video/play-button', null, array( 'video_id' => $video->ID ) );
							}

							echo get_the_post_thumbnail( $video->ID, 'realgym-post-thumbnail' );
							?>
						</div>
						<div class="realgym-loop-post-title">
							<a href="<?php echo esc_url( get_the_permalink( $video->ID ) ); ?>">
								<?php echo esc_html( get_the_title( $video->ID ) ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
