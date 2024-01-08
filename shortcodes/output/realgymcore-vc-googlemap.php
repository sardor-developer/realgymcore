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
		'map_height'            => 450,
		'map_zoom'              => 18,
		'disable_mouse_whell'   => false,
		'disable_control_tools' => false,
		'map_center'            => '47.116386, -101.299591',
		'map_style'             => '',
		'locations'             => '',
		'element_class'         => '',
		'element_id'            => '',
		'css'                   => '',
	),
	$atts
);

extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

if ( empty( $map_center ) ) {
	$map_center = '47.116386, -101.299591'; // geographical center of the USA.
}

$locations = realgymcore_param_parse_atts( $locations );

$locs = array();

if ( ! empty( $locations ) ) {
	foreach ( $locations as $location ) {
		$array   = array();
		$array[] = $location['name'];
		$array[] = $location['latitude'];
		$array[] = $location['longitude'];
		$locs[]  = $array;
	}
}

$classes = array(
	'realgym-google-map',
	$element_class,
	$vc_class,
);

$unique_id = 'map_' . wp_rand( 1, 999 );

$pin_url = get_template_directory_uri() . '/assets/images/pin.png';

?>
<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?> class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div id="<?php echo esc_attr( $unique_id ); ?>" style="width: 100%; height: <?php echo esc_attr( intval( $map_height ) ); ?>px;"></div>
</div>
<script type="text/javascript">
	(function ($) {
		$(document).on('ready', function () {
			var locations = <?php echo wp_json_encode( $locs ); ?>;
			console.log(locations);
			var mapStyles = [
				{
					"featureType": "all",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				}
			];

			<?php if ( ! empty( $map_style ) ) : ?>
				mapStyles = <?php echo rawurldecode( base64_decode( wp_strip_all_tags( $map_style ) ) ); // phpcs:ignore WordPress ?>;
			<?php endif; ?>

			center = new google.maps.LatLng(<?php echo esc_js( $map_center ); ?>);
			var map = new google.maps.Map(document.getElementById('<?php echo esc_attr( $unique_id ); ?>'), {
				zoom: <?php echo esc_js( $map_zoom ); ?>,
				center: center,
				styles: mapStyles,
				scrollwheel: <?php echo ( 'disable' === $disable_mouse_whell ) ? 'false' : 'true'; ?>,
				zoomControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>,
				mapTypeControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>,
				scaleControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>,
				streetViewControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>,
				rotateControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>,
				fullscreenControl: <?php echo ( 'disable' === $disable_control_tools ) ? 'false' : 'true'; ?>
			});

			var infowindow = new google.maps.InfoWindow();

			var marker, i;

			for (i = 0; i < locations.length; i++) {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					icon: '<?php echo esc_url( $pin_url ); ?>',
					map: map
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				}
				})(marker, i));
			}
		});
	})(jQuery);
</script>
<style>
	.gm-style-iw-d {
		color: #000;
	}
</style>
