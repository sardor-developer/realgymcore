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
		'style'         => '',
		'faq_ids'       => array(),
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes = array(
	'realgym-faq',
	$style,
	$element_class,
	$unique_class,
	$vc_class,
);

?>
<?php if ( count( $faq_ids ) > 0 ) : ?>
	<?php
	$args = array(
		'post_type' => 'realgym-faqs',
		'order'     => 'ASC',
		'orderby'   => 'post__in menu_order date',
	);

	foreach ( $faq_ids as $faq_id ) {
		$args['post__in'][] = (int) $faq_id;
	}

	$faq_data = new WP_Query( $args );
	$faqs     = $faq_data->get_posts();
	?>

	<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
			class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<ul class="listing-animation">
			<?php foreach ( $faqs as $faq ) : ?>
				<li class="realgym-faq-item">
					<div class="realgym-faq-header accordion-header">
						<h4><?php echo esc_html( $faq->post_title ); ?></h4>
						<div class="realgym-faq-icon">
							<span></span>
							<span></span>
						</div>
					</div>
					<div class="realgym-faq-body accordion-body">
						<p class="realgym-desc-1"><?php echo esc_html( $faq->post_content ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
