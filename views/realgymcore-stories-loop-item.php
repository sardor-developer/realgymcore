<?php
/**
 * Realgymcore Success Stories Loop Item.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$succes_stories_meta_data = array();
$succes_stories_meta_keys = array(
	'realgymcore_author_name',
	'realgymcore_author_age',
	'realgymcore_author_occupation',
	'realgymcore_story_title',
);
foreach ( $succes_stories_meta_keys as $succes_stories_meta_key ) {
	$succes_stories_meta_data[ $succes_stories_meta_key ] = ( get_post_meta( $item->ID, $succes_stories_meta_key ) ) ? get_post_meta( $item->ID, $succes_stories_meta_key, true ) : '';
}
?>
<div class="realgymcore-success-item realgym-box-shadow">
	<div class="row">
		<div class="col-lg-5 m-lg-0 mb-4">
			<div class="realgymcore-success-wrapper">
				<div class="row g-1 position-relative">
					<div class="col-md-6 realgymcore-pxc">
						<img src="<?php echo esc_url( realgymcore_success_stories_image( $item->ID, 'realgymcore_story_before_image' ) ); ?>" alt="before">
					</div>
					<div class="col-md-6 realgymcore-pxc">
						<img src="<?php echo esc_url( realgymcore_success_stories_image( $item->ID, 'realgymcore_story_after_image' ) ); ?>" alt="before">
					</div>
					<div class="realgymcore-success-rect"></div>
					<div class="realgymcore-success-round d-flex align-items-center justify-content-center">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7">
			<div class="realgymcore-success-content">
				<div class="realgymcore-success-fluid">
					<h3 class="realgym-display-3 realgymcore-success-title">
						<?php echo esc_html( $succes_stories_meta_data['realgymcore_story_title'] ); ?>
					</h3>
					<div class="row">
						<div class="col-lg-4">
							<div class="fluid">
								<span class="realgym-text-3 realgym-opacity60"><?php echo esc_html__( 'Name:', 'realgymcore' ); ?></span>
								<p class="realgym-text-1"><?php echo esc_html( $succes_stories_meta_data['realgymcore_author_name'] ); ?></p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="fluid">
								<span class="realgym-text-3 realgym-opacity60"><?php echo esc_html__( 'Age:', 'realgymcore' ); ?></span>
								<p class="realgym-text-1"><?php echo esc_html( $succes_stories_meta_data['realgymcore_author_age'] ); ?>
									<?php echo esc_html__( 'years', 'realgymcore' ); ?>
								</p>
							</div>
						</div>
						<div class="col-lg-4 p-lg-0">
							<div class="fluid">
								<span class="realgym-text-3 realgym-opacity60"><?php echo esc_html__( 'Occupation:', 'realgymcore' ); ?></span>
								<p class="realgym-text-1"><?php echo esc_html( $succes_stories_meta_data['realgymcore_author_occupation'] ); ?></p>
							</div>
						</div>
					</div>
					<a class="realgym-button" href="<?php echo esc_attr( get_post_permalink( $item->ID ) ); ?>"> 
						<?php echo esc_html__( 'Show More', 'realgymcore' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
