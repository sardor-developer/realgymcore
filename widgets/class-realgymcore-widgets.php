<?php
/**
 * Realgym widgets
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Widgets' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Widgets extends Realgymcore_Register_Items {
		/**
		 * Construct
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		}

		/**
		 * Prepare items
		 *
		 * @return array
		 */
		public function prepare_items() {
			return array(
				'Realgymcore_Video_Categories_Widget',
				'Realgymcore_Classes_List_Widget',
				'Realgymcore_Class_Info_Widget',
				'Realgymcore_Contact_Us_Widget',
				'Realgymcore_Tag_Cloud_Widget',
				'Realgymcore_Categories_Widget',
				'Realgymcore_Search_Widget',
				'Realgymcore_Recent_Posts_Widget',
				'Realgymcore_Plans_List_Widget',
			);
		}

		/**
		 * Register widgets
		 *
		 * @return void
		 */
		public function register_widgets() {
			$widgets = $this->prepare_items();
			foreach ( $widgets as $widget ) {
				register_widget( $widget );
			}
		}
	}

	new Realgymcore_Widgets();
}
