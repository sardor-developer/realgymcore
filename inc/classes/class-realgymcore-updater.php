<?php
/**
 * Updater.
 *
 * @author  Balcomsoft
 * @package realgymcore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'RealgymCore_Updater' ) ) {
	/**
	 * Plugin updater
	 */
	class RealgymCore_Updater {
		/**
		 * Plugin slug
		 *
		 * @var string $plugin_slug Plugin slug
		 */
		public $plugin_slug;

		/**
		 * Plugin current version
		 *
		 * @var string $version Plugin version
		 */
		public $version;

		/**
		 * Cache key
		 *
		 * @var string $cache_key Cache key
		 */
		public $cache_key;

		/**
		 * Init class
		 */
		public function __construct() {
			$this->plugin_slug = REALGYMCORE_DOMAIN;
			$this->version     = REALGYMCORE_VERSION;
			$this->cache_key   = REALGYMCORE_DOMAIN . '_update';

			add_filter( 'plugins_api', array( $this, 'info' ), 20, 3 );
			add_filter( 'site_transient_update_plugins', array( $this, 'update' ) );
			add_filter( 'transient_update_plugins', array( $this, 'update' ) );
			add_action( 'upgrader_process_complete', array( $this, 'purge' ), 10, 2 );
		}

		/**
		 * Request
		 */
		public function request() {
			$remote = get_transient( $this->cache_key );

			if ( false === $remote ) {

				$remote = wp_remote_post(
					'https://api.balcomsoft.com/update',
					array(
						'timeout' => 45,
						'body'    => array(
							'domain' => wp_parse_url( get_site_url(), PHP_URL_HOST ),
							'uid'    => 'realgym_core', // unique ID in remote system - this is NOT the plugin slug!
						),
					)
				);

				if (
					is_wp_error( $remote )
					|| 204 === wp_remote_retrieve_response_code( $remote )
					|| 200 !== wp_remote_retrieve_response_code( $remote )
					|| empty( wp_remote_retrieve_body( $remote ) )
				) {
					$remote = array(
						'version'      => $this->version,
						'tested'       => '6.0',
						'requires'     => '5.0',
						'requires_php' => '7.0',
						'last_updated' => '2022-01-01 12:00:00',
						'download_url' => '',
					);
				}

				set_transient( $this->cache_key, $remote, DAY_IN_SECONDS );
			}

			$remote = json_decode( wp_remote_retrieve_body( $remote ) );

			return $remote;
		}

		/**
		 * Information
		 *
		 * @param object $res Result.
		 * @param string $action Action.
		 * @param object $args Arguments.
		 */
		public function info( $res, $action, $args ) {
			// do nothing if you're not getting plugin information right now.
			if ( 'plugin_information' !== $action ) {
				return $res;
			}

			// do nothing if it is not our plugin.
			if ( $this->plugin_slug !== $args->slug ) {
				return $res;
			}

			// get updates.
			$remote = $this->request();

			if ( ! $remote ) {
				return $res;
			}

			$res = new stdClass();

			$res->name           = 'RealGym Core Plugin';
			$res->author         = 'Balcomsoft';
			$res->author_profile = 'https://balcomsoft.com';
			$res->slug           = $this->plugin_slug;
			$res->version        = $remote->version;
			$res->tested         = $remote->tested;
			$res->requires       = $remote->requires;
			$res->download_link  = $remote->download_url;
			$res->trunk          = $remote->download_url;
			$res->requires_php   = $remote->requires_php;
			$res->last_updated   = $remote->last_updated;

			$res->sections = array(
				'description' => 'This plugin is designed for RealGym Theme',
			);

			$res->banners = array(
				'low'  => REALGYMCORE_ASSETS . '/images/banner-772x250.jpg',
				'high' => REALGYMCORE_ASSETS . '/images/banner-1544x500.jpg',
			);

			return $res;
		}

		/**
		 * Update
		 *
		 * @param object $transient Transient.
		 */
		public function update( $transient ) {
			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			$remote = $this->request();

			if (
				$remote
				&& version_compare( $this->version, $remote->version, '<' )
				&& version_compare( $remote->requires, get_bloginfo( 'version' ), '<=' )
				&& version_compare( $remote->requires_php, PHP_VERSION, '<' )
			) {
				$res              = new stdClass();
				$res->slug        = $this->plugin_slug;
				$res->plugin      = 'realgymcore/realgymcore.php';
				$res->new_version = $remote->version;
				$res->tested      = $remote->tested;
				$res->package     = $remote->download_url;

				$transient->response[ $res->plugin ] = $res;

			}

			return $transient;
		}

		/**
		 * Purge
		 *
		 * @param mixed $upgrader Upgrader.
		 * @param array $options Options.
		 */
		public function purge( $upgrader, $options ) {
			if (
				'update' === $options['action']
				&& 'plugin' === $options['type']
			) {
				// just clean the cache when new plugin version is installed.
				delete_transient( $this->cache_key );
			}
		}
	}

	new RealgymCore_Updater();
}
