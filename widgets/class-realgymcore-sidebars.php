<?php
/**
 * Realgymcore_ sidebars
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Sidebars' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Sidebars extends Realgymcore_Register_Items {
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
				array(
					'name'          => esc_html__( 'Realgym Footer', 'realgymcore' ),
					'id'            => 'realgymcore-footer',
					'description'   => esc_html__( 'Widgets will be shown on footer left area . ', 'realgymcore' ),
					'before_widget' => ' <li id = "%1$s" class = "widget %2$s"> ',
					'after_widget'  => ' </li> ',
					'before_title'  => ' <h2 class = "widgettitle" > ',
					'after_title'   => ' </h2 > ',
				),
				array(
					'name'          => esc_html__( 'Realgym Footer Bottom', 'realgymcore' ),
					'id'            => 'realgymcore-footer-bottom',
					'description'   => esc_html__( 'Widgets in this area will be shown footer bottom . ', 'realgymcore' ),
					'before_widget' => ' <div id = "%1$s" class = "widget footer-terms %2$s" > ',
					'after_widget'  => ' </div > ',
					'before_title'  => '',
					'after_title'   => '',
				),
				array(
					'name'          => esc_html__( 'Realgym Single Blog Sidebar', 'realgymcore' ),
					'id'            => 'realgymcore-single-blog-sidebar',
					'description'   => esc_html__( 'Widgets in this area will be shown on single blog post.', 'realgymcore' ),
					'before_widget' => '<div id="%1$s" class="widget single-blog-sidebar %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '',
					'after_title'   => '',
				),
				array(
					'name'          => esc_html__( 'Realgym Single Video Sidebar', 'realgymcore' ),
					'id'            => 'realgymcore-single-video-sidebar',
					'description'   => esc_html__( 'Widgets in this area will be shown on single video page.', 'realgymcore' ),
					'before_widget' => '<div id="%1$s" class="widget single-video-sidebar %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '',
					'after_title'   => '',
				),
				array(
					'name'          => esc_html__( 'Realgym Single Class Sidebar', 'realgymcore' ),
					'id'            => 'realgymcore-single-class-sidebar',
					'description'   => esc_html__( 'Widgets in this area will be shown on single class page.', 'realgymcore' ),
					'before_widget' => '<div id="%1$s" class="widget realgym-single-class-sidebar %2$s">',
					'after_widget'  => ' </div> ',
					'before_title'  => '',
					'after_title'   => '',
				),
				array(
					'name'          => esc_html__( 'Realgym Single Plan Sidebar', 'realgymcore' ),
					'id'            => 'realgymcore-single-plan-sidebar',
					'description'   => esc_html__( 'Widgets in this area will be shown on single plan page.', 'realgymcore' ),
					'before_widget' => '<div id="%1$s" class="widget realgym-single-plan-sidebar %2$s">',
					'after_widget'  => ' </div> ',
					'before_title'  => '',
					'after_title'   => '',
				),
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
				register_sidebar( $widget );
			}
		}


	}

	new Realgymcore_Sidebars();
}
