<?php
/**
 * Register items class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Register_Items' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	abstract class Realgymcore_Register_Items {

		/**
		 * Construct
		 *
		 * @return void
		 */
		public function __construct() {}

		/**
		 * Prepare items
		 *
		 * @return void
		 */
		abstract public function prepare_items();
	}
}
