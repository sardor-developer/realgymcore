<?php
/**
 * Classes Class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Team_Post_Type' ) ) {
	/**
	 * Register Classes Post Type
	 *
	 * @return void
	 */
	class Realgymcore_Team_Post_Type {
		/**
		 * Slug
		 *
		 * @var string
		 */
		private $slug = 'realgym-team';

		/**
		 * Name
		 *
		 * @var string
		 */
		private $name = 'Team';

		/**
		 * Singular name
		 *
		 * @var string
		 */
		private $singular_name = 'Team Member';

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register' ) );
			add_action( 'realgym_get_team_member_social_links_html', array( $this, 'realgym_get_team_member_social_links_html' ), 10, 1 );
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
				'description'         => esc_html__( 'Team', 'realgymcore' ), // Description.
				'supports'            => $supports,
				'taxonomies'          => array(), // Allowed taxonomies.
				'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page.
				'public'              => true,  // Makes the post type public.
				'show_ui'             => true,  // Displays an interface for this post type.
				'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel).
				'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus.
				'show_in_admin_bar'   => true,  // Displays in the black admin bar.
				'menu_position'       => 53.4,     // The position number in the left menu.
				'menu_icon'           => true,  // The URL for the icon used for this post type.
				'can_export'          => true,  // Allows content export using Tools -> Export.
				'has_archive'         => false,  // Enables post type archive (by month, date, or year).
				'exclude_from_search' => true, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false.
				'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true.
				'capability_type'     => 'post', // Allows read, edit, delete like “Post”.
				'rewrite'             => array(
					'slug'       => 'team',
					'with_front' => false,
				),
			);
			register_post_type( $this->slug, $args );
		}


		/**
		 * Get Team Member Social Links
		 *
		 * @param int $post_id Post ID.
		 * @return void
		 */
		public function realgym_get_team_member_social_links_html( $post_id = null ) {
			global $post;

			if ( ! $post_id && ! $post ) {
				return;
			}

			$post_id = $post->ID;

			$socials = Realgymcore_Constants::get_team_member_social_options();
			echo '<ul class="social-links">';
			foreach ( $socials as $label => $value ) {
				$url = realgymcore_get_meta_field( $post_id, 'realgymcore_social_link_' . $value );
				if ( ! empty( $url ) ) {
					echo "<li class='" . esc_attr( $value ) . "'><a href='" . esc_url( $url ) . "' target='_blank' title='" . esc_html( $label ) . "'><i class='fi fi-brands-" . esc_attr( strtolower( $value ) ) . "'></i></a></li>";
				}
			}
			echo '</ul>';
		}
	}

	new Realgymcore_Team_Post_Type();
}
