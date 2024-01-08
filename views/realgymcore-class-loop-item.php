<?php
/**
 * Realgymcore Class Loop Item.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$realgymcore_class_full = ( get_post_meta( $item->ID, 'realgymcore_class_full_type' ) ) ? get_post_meta( $item->ID, 'realgymcore_class_full_type', true ) : 0;
$realgymcore_class_icon = ( get_post_meta( $item->ID, 'realgymcore_class_icon' ) ) ? get_post_meta( $item->ID, 'realgymcore_class_icon', true ) : '';
?>
<div class="realgymcore-card realgymcore-classes-item realgym-box-shadow">
	<div class="realgymcore-card-img">
		<?php if ( has_post_thumbnail( $item->ID ) ) : ?>
			<?php echo get_the_post_thumbnail( $item->ID, 'realgym-card-thumbnail' ); ?>
		<?php elseif ( function_exists( 'realgymcore_get_placeholder_image_url' ) ) : ?>
			<img src="<?php echo esc_url( realgymcore_get_placeholder_image_url( 'realgym-card-thumbnail' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item->post_title ) ); ?>"/>
		<?php endif; ?>
		<div class="realgymcore-card-icon">
			<i class="<?php echo esc_attr( $realgymcore_class_icon ); ?>"></i>
		</div>
	</div>
	<div class="realgymcore-card-content">
		<div class="d-flex justify-content-between">
			<a class="realgymcore-card-info" href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
				<h3 class="realgymcore-card-title"><?php echo esc_html( $item->post_title ); ?></h3>
				<p class="realgymcore-card-text realgym-desc-1"><?php echo esc_html( wp_trim_words( $item->post_excerpt, 12 ) ); ?></p>
			</a>
		</div>
		<?php do_action( 'realgym_progress_bar_html', esc_html__( 'Class Full', 'realgymcore' ), $realgymcore_class_full ); ?>
	</div>
</div>
