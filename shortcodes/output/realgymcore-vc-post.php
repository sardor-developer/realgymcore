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
wp_enqueue_style( 'realgymcore-vc-post-global', REALGYMCORE_CSS . '/components/realgymcore-vc-post-global.css', array(), REALGYMCORE_VERSION );
wp_enqueue_style( 'realgymcore-vc-post', REALGYMCORE_CSS . '/components/realgymcore-vc-post.css', array(), REALGYMCORE_VERSION );
wp_enqueue_style( 'realgymcore-vc-pricing-plans', REALGYMCORE_CSS . '/components/realgymcore-vc-pricing-plans.css', array(), REALGYMCORE_VERSION );
$result = shortcode_atts(
	array(
		'post_type'               => 'post',
		'team_card_style'         => 'team_card_style_1',
		'pricing_plan_card_style' => '',
		'render_type'             => '',
		'limit'                   => 3,
		'items_per_row'           => 4,
		'ordering'                => 'ASC',
		'slider_navigation_type'  => '',
		'enable_autoplay'         => 'yes',
		'autoplay_speed'          => 3000,
		'enable_loop'             => 'yes',
		'unique_class'            => '',
		'element_class'           => '',
		'element_id'              => '',
		'css'                     => '',
		'team_slider_type'        => '',
		'post_ids'                => '',
		'items_per_page'          => 4,
	),
	$atts
);
extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
$post_ids = ( ! empty( $post_ids ) ) ? explode( ',', $post_ids ) : '';
$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgymcore-posts',
	$element_class,
	$unique_class,
	$vc_class,
);

if ( empty( $post_ids ) ) {
	$args = array(
		'post_type'      => $post_type,
		'order'          => $ordering,
		'orderby'        => 'date',
		'posts_per_page' => (int) $limit,
	);
} else {
	$args = array(
		'post_type'      => $post_type,
		'order'          => $ordering,
		'orderby'        => 'date',
		'post__in'       => $post_ids,
		'posts_per_page' => (int) $limit,
	);
}

$items               = new WP_Query( $args );
$items               = $items->get_posts();
$settings            = ( function_exists( 'realgym_check_theme_options' ) ? realgym_check_theme_options() : array() );
$fill_color          = ( ! empty( $settings['primary_color'] ) ) ? esc_attr( $settings['primary_color'] ) : '#BCFE2F';
$swiper_unique_class = 'realgymcore-swiper-' . wp_rand( 1, 9999 );
$slider_class        = $swiper_unique_class;

switch ( $slider_navigation_type ) {
	case 'slider_cursor':
		$slider_class .= ' realgymcore-swiper-cursor';
		break;
	case 'slider_dots':
		$slider_class .= ' realgymcore-swiper-dots';
		break;
}

$is_slider = 'slider' === $render_type;

$slides_to_show = 3;
switch ( $items_per_row ) {
	case 12:
		$slides_to_show = 1;
		break;
	case 6:
		$slides_to_show = 2;
		break;
	case 4:
		$slides_to_show = 3;
		break;
	case 3:
		$slides_to_show = 4;
		break;
	case 2:
		$slides_to_show = 6;
		break;
	case 1:
		$slides_to_show = 12;
		break;
}


?>

<?php
if ( count( $items ) > 0 ) :
	?>
	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?> class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php if ( $is_slider ) : ?>
			<div class="<?php echo esc_attr( $slider_class ); ?> realgymcore-swiper-slider">
				<div class="swiper">
					<div class="realgymcore-swiper-pagination"></div>
					<div class="swiper-wrapper">
			<?php else : ?>
			<div class="row">
		<?php endif; ?>

		<?php foreach ( $items as $item ) : ?>
			<?php if ( $is_slider ) : ?>
				<div class="swiper-slide realgymcore-swiper-item">
			<?php else : ?>
					<?php if ( 'realgym-plan' === $post_type ) : ?>
						<div class="col-xl-<?php echo esc_attr( $items_per_row ); ?> col-lg-6 col-12">
					<?php elseif ( 'realgym-stories' === $post_type ) : ?>
						<div class="col-12">
					<?php else : ?>
						<div class="col-lg-<?php echo esc_attr( $items_per_row ); ?> col-md-6 col-12">
					<?php endif; ?>
				<?php
			endif;

			if ( 'posts' === $post_type ) :
				// Posts style.
				include realgymcore_views_template( 'realgymcore-posts-loop-item-1' );
			elseif ( 'realgym-team' === $post_type ) :
				// Team style.
				if ( 'team_card_style_2' === $team_card_style ) :
					include realgymcore_views_template( 'realgymcore-team-loop-item-2' );
				elseif ( 'team_card_style_3' === $team_card_style ) :
					include realgymcore_views_template( 'realgymcore-team-loop-item-3' );
				else :
					include realgymcore_views_template( 'realgymcore-team-loop-item-1' );
				endif;
			elseif ( 'realgym-video' === $post_type ) :
				// Video style.
				include realgymcore_views_template( 'realgymcore-video-loop-item' );
			elseif ( 'realgym-class' === $post_type ) :
				// Class style.
				include realgymcore_views_template( 'realgymcore-class-loop-item' );
			elseif ( 'realgym-plan' === $post_type ) :
				// Plan style.
				include realgymcore_views_template( 'realgymcore-plans-loop-item' );
			elseif ( 'realgym-stories' === $post_type ) :
				// Stories style.
				include realgymcore_views_template( 'realgymcore-stories-loop-item' );
			else :
				include realgymcore_views_template( 'realgymcore-posts-loop-item-2' );
			endif;
			?>
			</div>
		<?php endforeach; ?>

		<?php if ( 'slider' === $render_type ) : ?>
					</div>
				</div>
			</div>
		<?php else : ?>
			</div>
		<?php endif; ?>
	</div>
	<?php	if ( 'realgym-stories' === $post_type ) : ?>
		<div class="row appendables-wrap" id="collections"></div>
		<?php realgym_pagination( $post_type, 'list', $limit, $ordering ); ?>
	<?php endif; ?>
	<script>
		jQuery(document).ready(function ($) {
			'use strict';

			let swiper = new Swiper(".<?php echo esc_html( $swiper_unique_class ); ?> .swiper", {
				grabCursor: true,
				spaceBetween: 30,
				<?php if ( $is_slider && 'yes' === $enable_loop ) : ?>
				loop: true,
				<?php endif; ?>

				<?php if ( $is_slider && 'yes' === $enable_autoplay ) : ?>
				autoplay: {
					<?php if ( ! empty( $autoplay_speed ) && is_numeric( $autoplay_speed ) ) : ?>
					delay: <?php echo esc_attr( $autoplay_speed ); ?>,
					<?php else : ?>
					delay: 3000,
					<?php endif; ?>
				},
				<?php endif; ?>

				slidesPerView: 1,

				breakpoints: {
					640: {
						slidesPerView: 2,
					},
					992: {
						<?php if ( ! empty( $slides_to_show ) && is_numeric( $slides_to_show ) ) : ?>
						slidesPerView: <?php echo esc_attr( $slides_to_show ); ?>,
						<?php else : ?>
						slidesPerView: 3,
						<?php endif; ?>
					}
				},
				pagination: {
					el: ".<?php echo esc_html( $swiper_unique_class ); ?> .realgymcore-swiper-pagination",
					clickable: true
				},
			});
		});
	</script>
<?php endif; ?>
