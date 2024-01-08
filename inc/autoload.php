<?php
/**
 * Autoload
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

realgymcore_core_autoload( REALGYMCORE_PATH . '/inc/classes' );
realgymcore_core_autoload( REALGYMCORE_PATH . '/admin/classes' );
realgymcore_core_autoload( REALGYMCORE_PATH . '/widgets' );
realgymcore_core_autoload( REALGYMCORE_PATH . '/post-types' );

realgymcore_core_autoload( REALGYMCORE_PATH . '/inc/taxonomies' );
realgymcore_core_autoload( REALGYMCORE_PATH . '/inc/functions' );
realgymcore_core_autoload( REALGYMCORE_PATH . '/metaboxes' );

if ( realgymcore_is_realgymcore_active_theme() ) {
	realgymcore_core_autoload( REALGYMCORE_PATH . '/shortcodes/mapping' );
}

if ( defined( 'WPB_VC_VERSION' ) && realgymcore_is_realgymcore_active_theme() ) {
	realgymcore_core_autoload( REALGYMCORE_PATH . '/vc-components/params' );
	realgymcore_core_autoload( REALGYMCORE_PATH . '/vc-components/mapping' );
}



require_once REALGYMCORE_PATH . '/elementor/helpers.php';
require_once REALGYMCORE_PATH . '/elementor/class-realgymcore-elementor-elements.php';
realgymcore_elementor_autoload( REALGYMCORE_PATH . '/elementor/classes/' );

if ( ! class_exists( 'Realgymcore_Elementor_Widgets' ) ) {
	require_once REALGYMCORE_PATH . '/elementor/class-realgymcore-elementor-widgets.php';
}
