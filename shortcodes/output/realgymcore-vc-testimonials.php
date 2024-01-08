<?php
/**
 * RealGym Shortcode output
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

wp_enqueue_script( 'realgym-swiper', REALGYMCORE_JS . '/swiper.min.js', array( 'jquery' ), REALGYMCORE_VERSION, true );
wp_enqueue_style( 'realgym-swiper', REALGYMCORE_CSS . '/swiper.min.css', array(), REALGYMCORE_VERSION );
wp_enqueue_style( 'realgymcore-vc-testimonials', REALGYMCORE_CSS . '/components/realgymcore-vc-testimonials.css', array(), REALGYMCORE_VERSION );
wp_enqueue_script( 'realgymcore-vc-testimonials', REALGYMCORE_JS . '/components/realgymcore-vc-testimonials.js', array( 'jquery', 'realgym-swiper' ), REALGYMCORE_VERSION, true );
$result = shortcode_atts(
	array(
		'limit'                           => 4,
		'testimonials'                    => array(),
		'testimonials_max_pages'          => 1,
		'enable_load_more'                => false,
		'current_page'                    => 1,
		'unique_class'                    => '',
		'element_class'                   => '',
		'element_id'                      => '',
		'css'                             => '',
		'realgymcore_testimonials_slider' => 'testimonials_slider_1',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgymcore-review',
	$element_class,
	$unique_class,
	$vc_class,
);
?>
<?php if ( count( $testimonials ) > 0 ) : ?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php if ( 'testimonials_slider_1' === $realgymcore_testimonials_slider ) : ?>
			<?php include realgymcore_views_template( 'realgymcore-reviews-list-1' ); ?>
		<?php elseif ( 'testimonials_slider_2' === $realgymcore_testimonials_slider ) : ?>
			<?php include realgymcore_views_template( 'realgymcore-reviews-list-2' ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
