<?php
/**
 * Autoload.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * GymIcons styles
 */
function realgymcore_gymicons() {
	wp_enqueue_style( 'realgymcore-gymicons', REALGYMCORE_ASSETS . '/gymicons.css', array(), REALGYMCORE_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'realgymcore_gymicons' );


/**
 * GymIcons tabs
 *
 * @param array $tabs Icon tabs.
 */
function realgymcore_register_gymicons_tab( $tabs ) {
	$upload_dir = wp_upload_dir();

	if ( ! file_exists( $upload_dir['basedir'] . '/gymicons_charmap.json' ) ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$json_content  = json_decode( file_get_contents( REALGYMCORE_ASSETS . '/selection.json', true ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$icons_collect = array();

		foreach ( $json_content->icons as $k => $icon ) {
			$icons_collect['icons'][] = $icon->properties->name;
		}

		$icons_json = wp_json_encode( $icons_collect );
		$file       = $upload_dir['basedir'] . '/gymicons_charmap.json';
		$status     = $wp_filesystem->put_contents( $file, $icons_json );
	}

	$tabs['gymicons'] = array(
		'label'         => __( 'GymIcons', 'realgymcore' ),
		'name'          => 'gymicons',
		'prefix'        => 'gymicons-',
		'labelIcon'     => 'fas fa-dumbbell',
		'ver'           => REALGYMCORE_VERSION,
		'enqueue'       => array( REALGYMCORE_ASSETS . '/gymicons.css' ),
		'fetchJson'     => $upload_dir['baseurl'] . '/gymicons_charmap.json',
		'displayPrefix' => '',
		'url'           => '',
	);

	return $tabs;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'realgymcore_register_gymicons_tab' );
