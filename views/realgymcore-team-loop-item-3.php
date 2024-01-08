<?php
/**
 * Realgymcore Team Loop Item - Style 3.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$realgymcore_subtitle  = ( get_post_meta( $item->ID, 'realgymcore_subtitle' ) ) ? get_post_meta( $item->ID, 'realgymcore_subtitle', true ) : 0;
$realgymcore_linkedin  = ( get_post_meta( $item->ID, 'realgymcore_social_link_linkedin' ) ) ? get_post_meta( $item->ID, 'realgymcore_social_link_linkedin', true ) : '';
$realgymcore_instagram = ( get_post_meta( $item->ID, 'realgymcore_social_link_instagram' ) ) ? get_post_meta( $item->ID, 'realgymcore_social_link_instagram', true ) : '';
$realgymcore_facebook  = ( get_post_meta( $item->ID, 'realgymcore_social_link_facebook' ) ) ? get_post_meta( $item->ID, 'realgymcore_social_link_facebook', true ) : '';
?>
<div class="realgymcore-card realgymcore-team-slider-item">
	<div class="realgymcore-card-img">
		<?php if ( has_post_thumbnail( $item->ID ) ) : ?>
			<?php echo get_the_post_thumbnail( $item->ID, 'realgym-team-thumbnail' ); ?>
		<?php elseif ( function_exists( 'realgymcore_get_placeholder_image_url' ) ) : ?>
			<img src="<?php echo esc_url( realgymcore_get_placeholder_image_url( 'realgym-team-thumbnail' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item->post_title ) ); ?>"/>
		<?php endif; ?>
	</div>
	<div class="content">
		<div class="d-flex justify-content-between">
			<div class="realgymcore-info">
				<h3 class="realgymcore-card-title">
					<a href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>" class="realgym-heading-3">
						<?php echo esc_html( $item->post_title ); ?>
					</a>
				</h3>
			</div>
		</div>
	</div>
</div>
