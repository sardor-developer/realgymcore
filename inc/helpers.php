<?php
/**
 * Autoload.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_core_autoload' ) ) {
	/**
	 * Locate class files to load
	 *
	 * @param string $path path to class file.
	 *
	 * @return void
	 */
	function realgymcore_core_autoload( $path ) {
		$items = glob( $path . DIRECTORY_SEPARATOR . '*' );

		foreach ( $items as $item ) {
			if ( is_file( $item ) ) {
				$basename = basename( $item );
				if ( 'php' === pathinfo( $item )['extension'] && ( false !== strpos( $basename, 'class-realgymcore' ) || strpos( $basename, 'realgymcore-' ) !== false
						|| false !== strpos( $basename, 'realgymcore-' ) || false !== strpos( $basename, 'class-realgym' ) ) ) {
					require_once $item;
				}
			}
		}

		// Load files in subdirectories.
		foreach ( $items as $item ) {
			if ( is_dir( $item ) ) {
				realgymcore_core_autoload( $item );
			}
		}
	}
}


if ( ! function_exists( 'realgymcore_wp_kses_allowed_html' ) ) {
	add_filter( 'wp_kses_allowed_html', 'realgymcore_wp_kses_allowed_html' );
	/**
	 * Add extra kses support
	 *
	 * @param array $allowed_html default allowed html tags.
	 *
	 * @return array
	 */
	function realgymcore_wp_kses_allowed_html( $allowed_html ) {
		$allowed_atts = array(
			'align'       => array(),
			'class'       => array(),
			'type'        => array(),
			'id'          => array(),
			'dir'         => array(),
			'lang'        => array(),
			'style'       => array(),
			'xml:lang'    => array(),
			'src'         => array(),
			'alt'         => array(),
			'href'        => array(),
			'rel'         => array(),
			'rev'         => array(),
			'target'      => array(),
			'novalidate'  => array(),
			'type'        => array(),
			'value'       => array(),
			'name'        => array(),
			'tabindex'    => array(),
			'action'      => array(),
			'method'      => array(),
			'for'         => array(),
			'width'       => array(),
			'height'      => array(),
			'data'        => array(),
			'title'       => array(),
			'placeholder' => array(),
			'role'        => array(),
		);

		$allowed_html['select'] = $allowed_atts;
		$allowed_html['input']  = $allowed_atts;
		$allowed_html['option'] = $allowed_atts;

		return $allowed_html;
	}
}

if ( ! function_exists( 'realgymcore_style_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'realgymcore_style_css' );
	/**
	 * Enqueue general styles.
	 */
	function realgymcore_style_css() {
		wp_enqueue_style(
			'realgymcore_style_css',
			REALGYMCORE_CSS . '/styles.css',
			array(),
			REALGYMCORE_VERSION,
			'all'
		);
	}
}

add_action( 'admin_enqueue_scripts', 'realgymcore_admin_enqueue_scripts' );
/**
 * Admin Enqueue Scripts
 *
 * @return void
 */
function realgymcore_admin_enqueue_scripts() {
	wp_enqueue_style(
		'realgymcore-metaboxes-css',
		REALGYMCORE_CSS . '/metaboxes.css',
		array(),
		REALGYMCORE_VERSION,
		'all'
	);

	$page = '';
	if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification
		$page = sanitize_text_field( wp_unslash( $_GET['page'] ) ); //phpcs:ignore WordPress.Security.NonceVerification
	}

	if ( ! wp_style_is( 'wp-color-picker' ) ) {
		wp_enqueue_style( 'wp-color-picker' );
	}

	if ( 'realgym_settings' !== $page ) {

		wp_enqueue_script( 'realgymcore-repeater', REALGYMCORE_JS . '/repeater.js', array( 'jquery' ), REALGYMCORE_VERSION, true );

		wp_enqueue_style( 'realgymcore-select2', REALGYMCORE_CSS . '/select2.css', false, REALGYMCORE_VERSION, 'all' );
		wp_enqueue_script( 'realgymcore-select2', REALGYMCORE_JS . '/select2.js', array( 'jquery' ), REALGYMCORE_VERSION, true );

		wp_enqueue_style( 'realgymcore-jquery-ui', REALGYMCORE_CSS . '/jquery-ui.css', false, REALGYMCORE_VERSION, 'all' );
		wp_enqueue_script( 'realgymcore-jquery-ui', REALGYMCORE_JS . '/jquery-ui.js', array( 'jquery' ), REALGYMCORE_VERSION, true );

		wp_enqueue_script( 'realgymcore-mask', REALGYMCORE_JS . '/jquery.mask.min.js', array( 'jquery' ), REALGYMCORE_VERSION, true );

		wp_enqueue_script( 'realgymcore-admin-metaboxes', REALGYMCORE_JS . '/admin/realgymcore-metaboxes.js', array( 'jquery', 'realgymcore-jquery-ui' ), REALGYMCORE_VERSION, true );

	}
}

