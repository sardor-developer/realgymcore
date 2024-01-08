<?php
/**
 * RealGym Shortcode output
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

wp_enqueue_style( 'realgymcore-vc-post-global', REALGYMCORE_CSS . '/components/realgymcore-vc-post-global.css', array(), REALGYMCORE_VERSION );
wp_enqueue_style( 'realgymcore-vc-pricing-plans', REALGYMCORE_CSS . '/components/realgymcore-vc-pricing-plans.css', array(), REALGYMCORE_VERSION );
$result = shortcode_atts(
	array(
		'post_type'        => 'realgym-plan',
		'limit'            => 3,
		'items_per_row'    => 4,
		'ordering'         => 'ASC',
		'unique_class'     => '',
		'element_class'    => '',
		'element_id'       => '',
		'css'              => '',
		'card_style'       => 'plan_card_style',
		'team_slider_type' => '',
		'add_opacity'      => '',
		'post_id'          => '',
		'hide_category'    => '',
	),
	$atts
);
extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgymcore-plan',
	$element_class,
	$unique_class,
	$vc_class,
);

$settings   = ( function_exists( 'realgym_check_theme_options' ) ? realgym_check_theme_options() : array() );
$fill_color = ( ! empty( $settings['primary_color'] ) ) ? esc_attr( $settings['primary_color'] ) : '#BCFE2F';

$args = array(
	'type'         => $post_type,
	'child_of'     => 0,
	'parent'       => '',
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => 1,
	'hierarchical' => 1,
	'taxonomy'     => 'realgym-plan-category',
	'pad_counts'   => false,
);

$realgymcore_categories = get_categories( $args );
if ( empty( $post_id ) ) {
	$args = array(
		'post_type'      => $post_type,
		'order'          => $ordering,
		'orderby'        => 'date',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
} else {
	$args = array(
		'post_type' => $post_type,
		'post__in'  => array( $post_id ),
	);
}

$realgymcore_display_n = '';

if ( ! empty( $hide_category ) ) {
	$realgymcore_display_n = 'd-none';
	$classes[]             = 'mt-0';
}

$realgymcore_items        = new WP_Query( $args );
$realgymcore_items        = $realgymcore_items->get_posts();
$pricing_plans_item_class = ( ! empty( $pricing_plans_item_class ) ) ? $pricing_plans_item_class : '';

if ( ! empty( $add_opacity ) ) {
	$pricing_plans_item_class .= ' realgym-pricing-opacity';
}

if ( count( $realgymcore_items ) > 0 ) :
	?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="realgym-margin-bottom <?php echo esc_attr( $realgymcore_display_n ); ?>">

			<ul class="nav nav-pills mb-3 justify-content-end" id="pills-tab" role="tablist">
				<?php foreach ( $realgymcore_categories as $k => $realgymcore_cat ) : ?>
					<li class="nav-item" role="presentation">
						<button class="realgymcore-btn-border nav-link
					<?php
					if ( 0 === $k ) {
						echo esc_attr__( 'active', 'realgymcore' );
					}
					?>
					" id="<?php echo esc_attr( $realgymcore_cat->slug ); ?>-tab" data-bs-toggle="pill"
								data-bs-target="#<?php echo esc_attr( $realgymcore_cat->slug ); ?>" type="button" role="tab"
								aria-controls="<?php echo esc_attr( $realgymcore_cat->slug ); ?>"
								aria-selected="true"><span><?php echo esc_attr( $realgymcore_cat->name ); ?></span></button>
					</li>
				<?php endforeach; ?>
			</ul>

		</div>
		<?php foreach ( $realgymcore_categories as $k => $realgymcore_cat ) : ?>
			<div class="tab-pane fade show
			<?php
			if ( 0 === $k ) {
				echo esc_attr__( 'active', 'realgymcore' );
			}
			?>
	" id="<?php echo esc_attr( $realgymcore_cat->slug ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $realgymcore_cat->slug ); ?>-tab">
				<div class="row">
					<?php
					$realgymcore_count = 0;

					foreach ( $realgymcore_items as $item ) :
						?>
						<?php
						$realgymcore_terms      = get_the_terms( $item->ID, 'realgym-plan-category' );
						$realgymcore_terms_slug = array();
						foreach ( $realgymcore_terms as $realgymcore_term ) {
							$realgymcore_terms_slug[] = $realgymcore_term->slug;
						}
						if ( in_array( $realgymcore_cat->slug, $realgymcore_terms_slug, true ) && $realgymcore_count < $limit ) :
							if ( 'plan_card_style' === $card_style || 'plan_card_style_1' === $card_style ) :
								?>
								<?php
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
								<div class="col-xl-<?php echo esc_attr( $items_per_row ); ?> col-lg-6 col-12">
									<div class="realgymcore-card realgymcore-pricing-item">
										<?php if ( 'plan_card_style' === $card_style ) : ?>
											<div class="realgymcore-card-img position-relative">
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
										<div class="realgymcore-card-content
								<?php
								if ( ! empty( $pricing_plans_item_class ) ) {
									echo esc_attr( $pricing_plans_item_class );
								}
								?>
								">
											<div class="realgymcore-status realgym-display-3"><?php echo esc_html( wp_strip_all_tags( $item->post_title ) ); ?></div>
											<div>
												<div class="realgymcore-card-info">
													<h3 class="realgymcore-card-title"><?php echo esc_html( $plan_meta_data['realgymcore_plan_subtitle'] ); ?></h3>
													<ul class="realgymcore-card-list realgym-text-2">
														<?php if ( $plan_meta_data['realgymcore_plan_support'] ) : ?>
															<li>
											<span class="realgymcore-plan-card-icon">
															<?php realgymcore_get_circle_check_icon( $fill_color ); ?>
											</span>
																<span><?php echo esc_html__( '24/7 GYM manager support', 'realgymcore' ); ?></span>
															</li>
															<?php
														endif;
														if ( $plan_meta_data['realgymcore_plan_freezing'] ) :
															?>
															<li>
											<span class="realgymcore-plan-card-icon">
															<?php realgymcore_get_circle_check_icon( $fill_color ); ?>
											</span>
																<span><?php echo esc_html__( 'Up to 45 days of freezing', 'realgymcore' ); ?></span>
															</li>
															<?php
														endif;
														if ( $plan_meta_data['realgymcore_swimming_pool_access'] ) :
															?>
															<li>
											<span class="realgymcore-plan-card-icon">
															<?php realgymcore_get_circle_check_icon( $fill_color ); ?>
											</span>
																<span>
															<?php
															echo esc_html__( 'Swimming pool', 'realgymcore' );

															if ( is_array( $plan_meta_data['realgymcore_swimming_pool_access'] ) ) {
																echo ' ' . esc_html( implode( ' - ', $plan_meta_data['realgymcore_swimming_pool_access'] ) );
															}
															?>
														</span>
															</li>
															<?php
														endif;
														if ( $plan_meta_data['realgymcore_plan_relaxing'] ) :
															?>
															<li>
											<span class="realgymcore-plan-card-icon">
															<?php realgymcore_get_circle_check_icon( $fill_color ); ?>
											</span>
																<span><?php echo esc_html__( 'Fight zone & Relaxing room', 'realgymcore' ); ?></span>
															</li>
														<?php endif; ?>
													</ul>
													<div class="d-flex justify-content-between align-items-center">

												<span class="realgymcore-card-price realgym-heading-2">
												<?php
												if ( $plan_meta_data['realgymcore_plan_price'] ) {
													echo esc_html( $plan_meta_data['realgymcore_plan_price'] );
												}
												?>
												</span>
														<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="realgymcore-card-btn realgym-button realgym-text-2"><span><?php echo esc_html__( 'Join us', 'realgymcore' ); ?></span></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php
							endif;
							$realgymcore_count++;
							?>
							<?php
						endif;
					endforeach;
					?>

				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
endif;
