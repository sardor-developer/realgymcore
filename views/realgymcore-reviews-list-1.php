<?php
/**
 * Realgymcore Testimonials view.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$settings   = ( function_exists( 'realgym_check_theme_options' ) ? realgym_check_theme_options() : array() );
$fill_color = ( ! empty( $settings['secondary_color_inverse'] ) ) ? esc_attr( $settings['secondary_color_inverse'] ) : '#FFFFFF';
?>

<section class="realgymcore-swiper-container realgymcore-testimonials-slider">
	<div class="container">
		<div class="swiper-pagination"></div>
		<div class="slider position-relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					foreach ( $testimonials as $key => $testimonial ) :
						$realgymcore_atts = array( 'id' => $testimonial->ID );
						?>
						<div class="swiper-slide">
							<div class="testimonials-item">
								<div class="image-wrapper">
									<img class="realgymcore-full-width" src="<?php echo esc_url( realgymcore_testimonials_image( $realgymcore_atts ) ); ?>" alt="image">
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="testimonials-content">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php
						foreach ( $testimonials as $key => $testimonial ) :
							$review_count            = realgymcore_get_meta_field( $testimonial->ID, 'realgymcore_review_count' );
							$author_name             = realgymcore_get_meta_field( $testimonial->ID, 'realgymcore_author_name' );
							$realgymcore_rating      = realgymcore_get_meta_field( $testimonial->ID, 'realgymcore_rating' );
							$realgymcore_client_type = realgymcore_get_meta_field( $testimonial->ID, 'realgymcore_client_type' );
							?>
							<div class="swiper-slide">
								<div class="wrapper">
									<div class="testimonials-content-body">
										<h2 class="realgym-display-3"><?php echo esc_html( $testimonial->post_title ); ?></h2>
										<p class="realgym-text-1"><?php echo esc_html( $testimonial->post_content ); ?></p>
									</div>
									<div class="testimonials-content-footer d-flex">
										<div class="testimonials-author-img">
											<?php if ( has_post_thumbnail( $testimonial->ID ) ) : ?>
												<div class="img">
													<?php echo get_the_post_thumbnail( $testimonial->ID, 'realgym-post-thumbnail' ); ?>
												</div>
											<?php endif; ?>
										</div>
										<div class="content-footer-texts">
											<h4 class="realgym-heading-4"><?php echo esc_html( $author_name ); ?>
												<?php if ( ! empty( $realgymcore_client_type ) ) : ?>
													<span class="vip realgym-desc-1"><?php echo esc_html( $realgymcore_client_type ); ?></span>
												<?php endif; ?>
											</h4>
											<div class="rate realgym-text-3">
												<span>
													<?php if ( ! empty( $realgymcore_rating ) ) : ?>
														<span class="testimonials-star">
															<?php realgymcore_get_star_icon( $fill_color ); ?>
														</span>
														<span><?php echo esc_html( $realgymcore_rating ); ?></span>
													<?php endif; ?>
													<?php if ( ! empty( $review_count ) ) : ?>
														<span class="testimonials-review"><?php echo esc_html( $review_count ); ?>&nbsp;<?php echo esc_html__( 'review', 'realgymcore' ); ?></span>
													<?php endif; ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
