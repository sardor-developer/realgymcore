<?php
/**
 * Realgymcore Video Loop Item.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

?>
<div class="realgymcore-card realgymcore-video-item">
	<div class="realgymcore-card-img">
		<div class="realgymcore-post-img">
			<?php if ( has_post_thumbnail( $item->ID ) ) : ?>
				<?php echo get_the_post_thumbnail( $item->ID, 'realgym-team-thumbnail' ); ?>
			<?php elseif ( function_exists( 'realgymcore_get_placeholder_image_url' ) ) : ?>
				<img src="<?php echo esc_url( realgymcore_get_placeholder_image_url( 'post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item->post_title ) ); ?>"/>
			<?php endif; ?>
			<span class="realgym-play-button" data-video="<?php echo esc_attr( $video_id ); ?>">
								<i class="fi fi-sr-play"></i>
							</span>
		</div>
	</div>
	<div class="content">
		<h3>
			<a class="realgym-heading-3" href="<?php echo esc_url( get_the_permalink( $item->ID ) ); ?>">
				<?php echo esc_html( $item->post_title ); ?>
			</a>
		</h3>
	</div>
</div>
