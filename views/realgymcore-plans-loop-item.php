<?php
/**
 * Realgymcore Pricing Plans Loop Item.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$plan_meta_data = array();
$plan_meta_keys = array(
	'realgymcore_swimming_pool_access',
	'realgymcore_plan_relaxing',
	'realgymcore_plan_freezing',
	'realgymcore_plan_support',
	'realgymcore_plan_price',
	'realgymcore_plan_subtitle',
	'realgymcore_plan_popular',
);
foreach ( $plan_meta_keys as $plan_meta_key ) {
	$plan_meta_data[ $plan_meta_key ] = ( get_post_meta( $item->ID, $plan_meta_key ) ) ? get_post_meta( $item->ID, $plan_meta_key, true ) : '';
}
?>
<div class="realgymcore-card realgymcore-pricing-item">
	<?php if ( 'yes' === $pricing_plan_card_style ) : ?>
		<div class="realgymcore-card-img">
			<?php if ( has_post_thumbnail( $item->ID ) ) : ?>
				<?php echo get_the_post_thumbnail( $item->ID, 'realgym-post-thumbnail' ); ?>
			<?php elseif ( function_exists( 'realgymcore_get_placeholder_image_url' ) ) : ?>
				<img src="<?php echo esc_url( realgymcore_get_placeholder_image_url( 'realgym-post-thumbnail' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $item->post_title ) ); ?>"/>
			<?php endif; ?>
			<?php if ( $plan_meta_data['realgymcore_plan_popular'] ) : ?>
				<div class="realgymcore-popular-content">
					<h5><?php echo esc_html__( 'Popular Plan', 'realgymcore' ); ?></h5>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="realgymcore-card-content">
		<div class="realgymcore-status"><?php echo esc_html( wp_strip_all_tags( $item->post_title ) ); ?></div>
		<div class="realgymcore-card-info">
			<h3 class="realgymcore-card-title"><?php echo esc_html( $plan_meta_data['realgymcore_plan_subtitle'] ); ?></h3>
			<ul class="realgymcore-card-list realgym-text-2">
				<?php if ( $plan_meta_data['realgymcore_plan_support'] ) : ?>
					<li>
											<span class="realgymcore-plan-card-icon">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.0063 21.7511C8.29832 21.7514 4.87907 19.6267 3.24145 16.2824C1.58432 12.8973 2.08607 8.67557 4.49057 5.7772C6.89245 2.88182 10.7973 1.61845 14.4378 2.55857C14.8387 2.66207 15.0798 3.0712 14.9767 3.47245C14.8732 3.8737 14.4637 4.11445 14.0628 4.01132C10.9833 3.21595 7.67807 4.2847 5.6452 6.73532C3.6112 9.18745 3.1867 12.7593 4.58882 15.6236C5.9857 18.4766 9.06707 20.3351 12.2298 20.2488C15.3922 20.1626 18.2621 18.2392 19.5412 15.3491C20.2923 13.6518 20.4513 11.7299 19.9882 9.93707C19.8847 9.5362 20.1258 9.12707 20.5271 9.0232C20.9272 8.91932 21.3371 9.16082 21.441 9.56207C21.9877 11.6804 21.8006 13.9514 20.9133 15.9562C19.4013 19.3724 16.0087 21.6461 12.2711 21.7481C12.1826 21.7499 12.0941 21.7511 12.0063 21.7511Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M11.9999 14.34C11.8079 14.34 11.6159 14.2669 11.4697 14.1202C11.1768 13.8274 11.1768 13.3526 11.4697 13.0597L20.4697 4.05974C20.7622 3.76687 21.2377 3.76687 21.5302 4.05974C21.823 4.35262 21.823 4.82737 21.5302 5.12024L12.5302 14.1202C12.3839 14.2665 12.1919 14.34 11.9999 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M12.0001 14.34C11.8081 14.34 11.6161 14.2669 11.4699 14.1202L8.28802 10.9384C7.99514 10.6455 7.99514 10.1707 8.28802 9.87786C8.58052 9.58498 9.05602 9.58498 9.34852 9.87786L12.5304 13.0597C12.8233 13.3526 12.8233 13.8274 12.5304 14.1202C12.3841 14.2665 12.1921 14.34 12.0001 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
												</svg>
											</span>
						<span><?php echo esc_html__( '24/7 GYM manager support', 'realgymcore' ); ?></span>
					</li>
					<?php
				endif;
				if ( $plan_meta_data['realgymcore_plan_freezing'] ) :
					?>
					<li>
											<span class="realgymcore-plan-card-icon">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.0063 21.7511C8.29832 21.7514 4.87907 19.6267 3.24145 16.2824C1.58432 12.8973 2.08607 8.67557 4.49057 5.7772C6.89245 2.88182 10.7973 1.61845 14.4378 2.55857C14.8387 2.66207 15.0798 3.0712 14.9767 3.47245C14.8732 3.8737 14.4637 4.11445 14.0628 4.01132C10.9833 3.21595 7.67807 4.2847 5.6452 6.73532C3.6112 9.18745 3.1867 12.7593 4.58882 15.6236C5.9857 18.4766 9.06707 20.3351 12.2298 20.2488C15.3922 20.1626 18.2621 18.2392 19.5412 15.3491C20.2923 13.6518 20.4513 11.7299 19.9882 9.93707C19.8847 9.5362 20.1258 9.12707 20.5271 9.0232C20.9272 8.91932 21.3371 9.16082 21.441 9.56207C21.9877 11.6804 21.8006 13.9514 20.9133 15.9562C19.4013 19.3724 16.0087 21.6461 12.2711 21.7481C12.1826 21.7499 12.0941 21.7511 12.0063 21.7511Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M11.9999 14.34C11.8079 14.34 11.6159 14.2669 11.4697 14.1202C11.1768 13.8274 11.1768 13.3526 11.4697 13.0597L20.4697 4.05974C20.7622 3.76687 21.2377 3.76687 21.5302 4.05974C21.823 4.35262 21.823 4.82737 21.5302 5.12024L12.5302 14.1202C12.3839 14.2665 12.1919 14.34 11.9999 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M12.0001 14.34C11.8081 14.34 11.6161 14.2669 11.4699 14.1202L8.28802 10.9384C7.99514 10.6455 7.99514 10.1707 8.28802 9.87786C8.58052 9.58498 9.05602 9.58498 9.34852 9.87786L12.5304 13.0597C12.8233 13.3526 12.8233 13.8274 12.5304 14.1202C12.3841 14.2665 12.1921 14.34 12.0001 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
												</svg>
											</span>
						<span><?php echo esc_html__( 'Up to 45 days of freezing', 'realgymcore' ); ?></span>
					</li>
					<?php
				endif;
				if ( $plan_meta_data['realgymcore_swimming_pool_access'] ) :
					?>
					<li>
											<span class="realgymcore-plan-card-icon">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.0063 21.7511C8.29832 21.7514 4.87907 19.6267 3.24145 16.2824C1.58432 12.8973 2.08607 8.67557 4.49057 5.7772C6.89245 2.88182 10.7973 1.61845 14.4378 2.55857C14.8387 2.66207 15.0798 3.0712 14.9767 3.47245C14.8732 3.8737 14.4637 4.11445 14.0628 4.01132C10.9833 3.21595 7.67807 4.2847 5.6452 6.73532C3.6112 9.18745 3.1867 12.7593 4.58882 15.6236C5.9857 18.4766 9.06707 20.3351 12.2298 20.2488C15.3922 20.1626 18.2621 18.2392 19.5412 15.3491C20.2923 13.6518 20.4513 11.7299 19.9882 9.93707C19.8847 9.5362 20.1258 9.12707 20.5271 9.0232C20.9272 8.91932 21.3371 9.16082 21.441 9.56207C21.9877 11.6804 21.8006 13.9514 20.9133 15.9562C19.4013 19.3724 16.0087 21.6461 12.2711 21.7481C12.1826 21.7499 12.0941 21.7511 12.0063 21.7511Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M11.9999 14.34C11.8079 14.34 11.6159 14.2669 11.4697 14.1202C11.1768 13.8274 11.1768 13.3526 11.4697 13.0597L20.4697 4.05974C20.7622 3.76687 21.2377 3.76687 21.5302 4.05974C21.823 4.35262 21.823 4.82737 21.5302 5.12024L12.5302 14.1202C12.3839 14.2665 12.1919 14.34 11.9999 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
													<path d="M12.0001 14.34C11.8081 14.34 11.6161 14.2669 11.4699 14.1202L8.28802 10.9384C7.99514 10.6455 7.99514 10.1707 8.28802 9.87786C8.58052 9.58498 9.05602 9.58498 9.34852 9.87786L12.5304 13.0597C12.8233 13.3526 12.8233 13.8274 12.5304 14.1202C12.3841 14.2665 12.1921 14.34 12.0001 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
												</svg>
											</span>
						<span><?php echo esc_html__( 'Swimming pool', 'realgymcore' ); ?>
						<?php
						if ( is_array( $plan_meta_data['realgymcore_swimming_pool_access'] ) ) {
							echo esc_html( implode( ' - ', $plan_meta_data['realgymcore_swimming_pool_access'] ) );}
						?>
						</span>
					</li>
					<?php
				endif;
				if ( $plan_meta_data['realgymcore_plan_relaxing'] ) :
					?>
					<li>
						<span class="realgymcore-plan-card-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12.0063 21.7511C8.29832 21.7514 4.87907 19.6267 3.24145 16.2824C1.58432 12.8973 2.08607 8.67557 4.49057 5.7772C6.89245 2.88182 10.7973 1.61845 14.4378 2.55857C14.8387 2.66207 15.0798 3.0712 14.9767 3.47245C14.8732 3.8737 14.4637 4.11445 14.0628 4.01132C10.9833 3.21595 7.67807 4.2847 5.6452 6.73532C3.6112 9.18745 3.1867 12.7593 4.58882 15.6236C5.9857 18.4766 9.06707 20.3351 12.2298 20.2488C15.3922 20.1626 18.2621 18.2392 19.5412 15.3491C20.2923 13.6518 20.4513 11.7299 19.9882 9.93707C19.8847 9.5362 20.1258 9.12707 20.5271 9.0232C20.9272 8.91932 21.3371 9.16082 21.441 9.56207C21.9877 11.6804 21.8006 13.9514 20.9133 15.9562C19.4013 19.3724 16.0087 21.6461 12.2711 21.7481C12.1826 21.7499 12.0941 21.7511 12.0063 21.7511Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
								<path d="M11.9999 14.34C11.8079 14.34 11.6159 14.2669 11.4697 14.1202C11.1768 13.8274 11.1768 13.3526 11.4697 13.0597L20.4697 4.05974C20.7622 3.76687 21.2377 3.76687 21.5302 4.05974C21.823 4.35262 21.823 4.82737 21.5302 5.12024L12.5302 14.1202C12.3839 14.2665 12.1919 14.34 11.9999 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
								<path d="M12.0001 14.34C11.8081 14.34 11.6161 14.2669 11.4699 14.1202L8.28802 10.9384C7.99514 10.6455 7.99514 10.1707 8.28802 9.87786C8.58052 9.58498 9.05602 9.58498 9.34852 9.87786L12.5304 13.0597C12.8233 13.3526 12.8233 13.8274 12.5304 14.1202C12.3841 14.2665 12.1921 14.34 12.0001 14.34Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
							</svg>
						</span>
						<span><?php echo esc_html__( 'Fight zone & Relaxing room', 'realgymcore' ); ?></span>
					</li>
				<?php endif; ?>
			</ul>

			<div class="d-flex justify-content-between align-items-center">
				<span class="realgymcore-card-price realgym-heading-2"> 
				<?php
				if ( ! empty( $plan_meta_data['realgymcore_plan_price'] ) ) {
					echo esc_html( $plan_meta_data['realgymcore_plan_price'] );
				}
				?>
				</span>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="realgymcore-card-btn realgym-text-2"><?php echo esc_html__( 'Join us', 'realgymcore' ); ?></a>
			</div>
		</div>
	</div>
</div>
