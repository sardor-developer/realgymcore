<?php
/**
 * Elementor Wdigets.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 *  Realgymcore_Elementor_widgets.
 *
 * @return void
 */
final class Realgymcore_Elementor_Widgets {

	/**
	 * Instance
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'realgymcore_elementor_init' ) );
		add_action(
			'elementor/editor/after_enqueue_styles',
			array( $this, 'realgymcore_elementor_edit_styles' )
		);
		add_action( 'elementor/controls/controls_registered', array( $this, 'realgymcore_elementor_controls_registered' ) );
		add_action(
			'elementor/elements/categories_registered',
			array( $this, 'realgymcore_elementor_widgets_category' )
		);
	}

	/**
	 * Load text domain
	 */
	public function i18n() {
		load_plugin_textdomain( 'realgymcore' );
	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 */
	public function realgymcore_elementor_init() {
		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', array( $this, 'realgymcore_elementor_widgets_registered' ) );
		}
	}

	/**
	 * Compatibility Check
	 *
	 * Check if Elementor installed and activated.
	 */
	public function is_compatible() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action(
				'admin_notices',
				array(
					$this,
					'realgymcore_elementor_admin_notice_missing_elementor_plugin',
				)
			);

			return false;
		}

		return true;
	}

	/**
	 * Initialize Elementor
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 *
	 * Fired by `plugins_loaded` action hook.
	 */
	public function realgymcore_elementor_widgets_registered() {
		$this->i18n();
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'realgymcore_elementor_widgets' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'realgymcore_elementor_functions' ) );
	}

	/**
	 * Enqueue
	 *
	 * Enqueue scripts and styles
	 */
	public function realgymcore_elementor_edit_styles() {
		if ( file_exists( REALGYMCORE_PATH . '/assets/css/editor.css' ) ) {
			wp_enqueue_style(
				'realgymcore_elementor_editor',
				REALGYMCORE_ASSETS . '/css/editor.css',
				array(),
				REALGYMCORE_ELEMENTOR_VERSION,
				false
			);
		}
	}

	/**
	 * Init Widgets Category
	 *
	 *  @param string $realgymcore_category category.
	 * @return string.
	 */
	public function realgymcore_elementor_widgets_category( $realgymcore_category ) {
		$category = esc_html__( 'Realgym Widgets', 'realgymcore' );
		$realgymcore_category->add_category(
			'realgymcore-widgets',
			array(
				'title' => $category,
				'icon'  => 'eicon-font',
			)
		);

		return $realgymcore_category;
	}

	/**
	 * Register elementor controls.
	 *
	 * @author Balcomsoft.
	 */
	public function realgymcore_elementor_controls_registered() {
		require_once REALGYMCORE_ELEMENTOR_PATH . '/elementor/elements/class-realgymcore-elementor-exploded-textarea-control.php';
		require_once REALGYMCORE_ELEMENTOR_PATH . '/elementor/elements/class-realgymcore-elementor-faqs-control.php';
		require_once REALGYMCORE_ELEMENTOR_PATH . '/elementor/elements/class-realgymcore-elementor-videos-control.php';
		\Elementor\Plugin::instance()->controls_manager->register( new Realgymcore_Elementor_Exploded_Textarea_Control() );
		\Elementor\Plugin::instance()->controls_manager->register( new Realgymcore_Elementor_FAQs_Control() );
		\Elementor\Plugin::instance()->controls_manager->register( new Realgymcore_Elementor_Videos_Control() );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 */
	public function realgymcore_elementor_widgets() {
		// Include Widget files.
		realgymcore_elementor_autoload( REALGYMCORE_ELEMENTOR_PATH . '/elementor/widgets/' );
	}

	/**
	 * Init Elementor Functions
	 *
	 * Include widgets files and register them
	 */
	public function realgymcore_elementor_functions() {
		// Include Functions files.
		realgymcore_elementor_autoload( REALGYMCORE_ELEMENTOR_PATH . '/elementor/functions/' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 */
	public function realgymcore_elementor_admin_notice_missing_elementor_plugin() {
		$elementor_path = 'elementor/elementor.php';
		if ( realgymcore_elementor_status() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}
			$activation_url
					= wp_nonce_url(
						'plugins.php?action=activate&amp;plugin='
									. $elementor_path
									. '&amp;plugin_status=all&amp;paged=1&amp;s',
						'activate-plugin_' . $elementor_path
					);
			$message        = '<p>'
					. esc_html__(
						'Elementor Website Builder is required to start using the Realgymcore Elementor Widgets. Please activate the Elementor Website Builder.',
						'realgymcore'
					) . '</p>';
			$message       .= '<p>'
						. sprintf(
							'<a href="%s" class="button-primary">%s</a>',
							$activation_url,
							esc_html__( 'Activate Elementor Now', 'realgymcore' )
						)
						. '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}
			$install_url
					= wp_nonce_url(
						self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ),
						'install-plugin_elementor'
					);
			$message     = '<p>'
					. esc_html__(
						'Elementor Website Builder is required to start using the Realgymcore Elementor Widgets. Please install and activate the Elementor Website Builder.',
						'realgymcore'
					) . '</p>';
			$message    .= '<p>'
						. sprintf(
							'<a href="%s" class="button-primary">%s</a>',
							$install_url,
							esc_html__( 'Install Elementor Now', 'realgymcore' )
						)
						. '</p>';
		}
		echo '<div class="notice notice-error is-dismissible">'
			. wp_kses_post( $message ) . '</div>';
	}
}

Realgymcore_Elementor_Widgets::instance();
