<?php
/**
 * Classes Class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Classes_Post_Type' ) ) {
	/**
	 * Register Classes Post Type
	 *
	 * @return void
	 */
	class Realgymcore_Classes_Post_Type {
		/**
		 * Slug
		 *
		 * @var string
		 */
		private $slug = 'realgym-class';

		/**
		 * Name
		 *
		 * @var string
		 */
		private $name = 'Classes';

		/**
		 * Singular name
		 *
		 * @var string
		 */
		private $singular_name = 'Class';

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register' ) );
		}

		/**
		 * Register Post type
		 *
		 * @return void
		 */
		public function register() {
			$labels   = array(
				'name'          => esc_html( $this->name ),
				'singular_name' => esc_html( $this->singular_name ),
			);
			$supports = array(
				'title',
				'excerpt',
				'thumbnail',
				'editor',
			);
			$args     = array(
				'labels'              => $labels,
				'description'         => esc_html__( 'Class', 'realgymcore' ), // Description.
				'supports'            => $supports,
				'taxonomies'          => array(), // Allowed taxonomies.
				'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page.
				'public'              => true,  // Makes the post type public.
				'show_ui'             => true,  // Displays an interface for this post type.
				'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel).
				'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus.
				'show_in_admin_bar'   => true,  // Displays in the black admin bar.
				'menu_position'       => 53.3,     // The position number in the left menu.
				'menu_icon'           => true,  // The URL for the icon used for this post type.
				'can_export'          => true,  // Allows content export using Tools -> Export.
				'has_archive'         => false,  // Enables post type archive (by month, date, or year).
				'exclude_from_search' => true, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false.
				'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true.
				'capability_type'     => 'post', // Allows read, edit, delete like “Post”.
				'rewrite'             => array(
					'slug'       => 'class',
					'with_front' => false,
				),
			);
			register_post_type( $this->slug, $args );
		}
	}

	new Realgymcore_Classes_Post_Type();
}
