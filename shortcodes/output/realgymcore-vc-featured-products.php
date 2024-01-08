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
		'limit'            => 3,
		'items_per_row'    => 3,
		'related_products' => array(),
		'unique_class'     => '',
		'element_class'    => '',
		'element_id'       => '',
		'css'              => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$unique_class_escaped = ( ! empty( $unique_class ) ) ? esc_attr( $unique_class ) : '';

$classes = array(
	$element_class,
	$unique_class_escaped,
	$vc_class,
);

if ( class_exists( 'Woocommerce' ) && $related_products ) :
	?>
	<div class="woocommerce">
		<section class="related products">
			<div class="products realgym-featured-products-slider swiper realgym-products-container">
				<ul class="swiper-wrapper">
					<?php foreach ( $related_products as $related_product ) : ?>
						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'content', 'related-product' );
						?>
					<?php endforeach; ?>

					<?php woocommerce_product_loop_end(); ?>
					<div class="featured-swiper-button-next"></div>
					<div class="featured-swiper-button-prev"></div>
			</div>
		</section>
	</div>
	<?php
	wp_reset_postdata();
endif;
