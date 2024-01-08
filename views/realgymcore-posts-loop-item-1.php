<?php
/**
 * Realgymcore Posts Loop Item.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

?>
<div class="realgymcore-card realgymcore-blog-item">
	<div class="realgymcore-card-img">
		<div class="realgymcore-post-img">
			<?php if ( has_post_thumbnail( $item->ID ) ) : ?>
				<?php echo get_the_post_thumbnail( $item->ID, 'realgym-team-thumbnail' ); ?>
			<?php elseif ( function_exists( 'realgymcore_get_placeholder_image_url' ) ) : ?>
				<img src="<?php echo esc_url( realgymcore_get_placeholder_image_url( 'post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item->post_title ) ); ?>"/>
			<?php endif; ?>
		</div>
	</div>
	<div class="content">
		<div class="realgymcore-date realgym-text-2"><?php echo esc_html( wp_date( get_option( 'date_format' ), get_post_timestamp( $item->ID ) ) ); ?> </div>
		<h3>
			<a class="realgym-heading-3" href="<?php echo esc_url( get_the_permalink( $item->ID ) ); ?>">
				<?php echo esc_html( $item->post_title ); ?>
			</a>
		</h3>
	</div>
</div>
