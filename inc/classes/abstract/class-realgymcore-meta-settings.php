<?php
/**
 * Meta settings class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Meta_Settings' ) ) {
	/**
	 * Meta settings
	 *
	 * @return void
	 */
	abstract class Realgymcore_Meta_Settings {
		/**
		 * Construct
		 *
		 * @return void
		 */
		public function __construct() {
			if ( is_admin() ) {
				add_action( 'load-post.php', array( $this, 'init' ) );
				add_action( 'load-post-new.php', array( $this, 'init' ) );
			}
		}

		/**
		 * Init
		 *
		 * @return void
		 */
		abstract public function init();

		/**
		 * Add meta box
		 *
		 * @return void
		 */
		abstract public function adding_meta_box();

		/**
		 * Render meta field
		 *
		 * @param object $post Post object.
		 *
		 * @return void
		 */
		abstract public function render_meta_fields( $post );

		/**
		 * Save meta field
		 *
		 * @param int    $post_id Post ID.
		 *
		 * @param object $post Post object.
		 *
		 * @return void
		 */
		abstract public function save_meta_fields( $post_id, $post );
	}
}
