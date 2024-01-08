<?php
/**
 * Plugin Name: RealGym Core Plugin
 * Description: This plugin it's designed for RealGym Theme
 * Version: 1.0.1
 * Author: Balcomsoft
 * Author URI: https://www.balcomsoft.com/
 * Text Domain: realgymcore
 * Domain Path: /languages/
 * License: http://www.gnu.org/licenses/gpl.html
 * Social links widget
 *
 * @author  Balcomsoft
 * @package realgymcore
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define( 'REALGYMCORE_FILE', __FILE__ );
define( 'REALGYMCORE_DOMAIN', 'realgymcore' );
define( 'REALGYMCORE_SETTINGS_OPT', 'realgym_settings' );
define( 'REALGYMCORE_META_SETTINGS_OPT', 'realgymcore_meta_options' );
define( 'REALGYMCORE_PATH', dirname( REALGYMCORE_FILE ) );
define( 'REALGYMCORE_URL', plugin_dir_url( REALGYMCORE_FILE ) );
define( 'REALGYMCORE_VERSION', '1.0.1' );
define( 'REALGYMCORE_DB_VERSION', '1.0.0' );
define( 'REALGYMCORE_REPEATER_DATA', 'realgymcore_repeater_data' );
define( 'REALGYMCORE_ASSETS', REALGYMCORE_URL . 'assets' );
define( 'REALGYMCORE_CSS', REALGYMCORE_ASSETS . '/css' );
define( 'REALGYMCORE_JS', REALGYMCORE_ASSETS . '/js' );
define( 'REALGYMCORE_VC_ELEMENTS_OUTPUT', '/vc-components/output' );
define( 'REALGYMCORE_VC_ELEMENTS_OUTPUT_PATH', REALGYMCORE_PATH . REALGYMCORE_VC_ELEMENTS_OUTPUT );
define( 'REALGYMCORE_VIEWS_OUTPUT_PATH', REALGYMCORE_PATH . '/views' );
define( 'REALGYMCORE_ELEMENTOR_PATH', REALGYMCORE_PATH );
define( 'REALGYMCORE_ELEMENTOR_VERSION', REALGYMCORE_VERSION );
define( 'REALGYMCORE_ELEMENTOR_FILES_PATH', REALGYMCORE_PATH );
define( 'REALGYMCORE_ELEMENTOR_ELEMENTS_OUTPUT', REALGYMCORE_VC_ELEMENTS_OUTPUT );
define( 'REALGYMCORE_ELEMENTOR_ELEMENTS_OUTPUT_PATH', REALGYMCORE_PATH . REALGYMCORE_ELEMENTOR_ELEMENTS_OUTPUT );





if ( ! is_textdomain_loaded( 'realgymcore' ) ) {
	load_plugin_textdomain(
		'realgymcore',
		false,
		'realgymcore/languages'
	);
}

require_once REALGYMCORE_PATH . '/inc/helpers.php';
require_once REALGYMCORE_PATH . '/inc/gymicons.php';
require_once REALGYMCORE_PATH . '/inc/autoload.php';

if ( ! function_exists( 'realgymcore_redux_css' ) ) {
	add_action( 'redux/page/' . REALGYMCORE_SETTINGS_OPT . '/enqueue', 'realgymcore_redux_css' );
	/**
	 * Enqueue redux styles.
	 */
	function realgymcore_redux_css() {
		wp_register_style(
			'realgymcore-redux-custom-css',
			REALGYMCORE_CSS . '/redux-style.css',
			array( 'redux-admin-css' ),
			REALGYMCORE_VERSION,
			'all'
		);

		wp_enqueue_style( 'realgymcore-redux-custom-css' );
	}
}
