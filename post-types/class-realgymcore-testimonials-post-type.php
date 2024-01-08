<?php
/**
 * Testimonials post type
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Testimonials_Post_Type' ) ) {
	/**
	 * Post type class
	 *
	 * @return void
	 */
	class Realgymcore_Testimonials_Post_Type {
		/**
		 * Slug
		 *
		 * @var string
		 */
		private $slug = 'realgym-testimonials';

		/**
		 * Name
		 *
		 * @var string
		 */
		private $name = 'Testimonials';

		/**
		 * Singular name
		 *
		 * @var string
		 */
		private $singular_name = 'Testimonial';

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register' ) );
			add_action( 'init', array( $this, 'register_taxonomy' ) );
			add_action( 'wp_ajax_realgymcore_ajax_testimonials_request', array( $this, 'get_ajax_testimonials' ) );
			add_action( 'wp_ajax_nopriv_realgymcore_ajax_testimonials_request', array( $this, 'get_ajax_testimonials' ) );
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
				'title',        // Post title.
				'editor',       // Allows feature images.
				'thumbnail',    // Allows feature images.
			);
			$args     = array(
				'labels'              => $labels,
				'description'         => esc_html__( 'Testimonials', 'realgymcore' ), // Description.
				'supports'            => $supports,
				'taxonomies'          => array(), // Allowed taxonomies.
				'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page.
				'public'              => false,  // Makes the post type public.
				'show_ui'             => true,  // Displays an interface for this post type.
				'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel).
				'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus.
				'show_in_admin_bar'   => true,  // Displays in the black admin bar.
				'menu_position'       => 52,     // The position number in the left menu.
				'menu_icon'           => true,  // The URL for the icon used for this post type.
				'can_export'          => true,  // Allows content export using Tools -> Export.
				'has_archive'         => true,  // Enables post type archive (by month, date, or year).
				'exclude_from_search' => true, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false.
				'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true.
				'capability_type'     => 'post', // Allows read, edit, delete like “Post”.
				'rewrite'             => array(
					'slug'       => 'testimonials',
					'with_front' => false,
				),
			);
			register_post_type( $this->slug, $args );
		}

		/**
		 * Get testimonials by AJAX call
		 *
		 * @return void
		 */
		public function get_ajax_testimonials() {
			check_ajax_referer( 'realgymcore_testimonials_nonce', 'nonce' );
			$response = array();

			$page = 1;
			if ( isset( $_POST['page'] ) ) {
				$page = intval( $_POST['page'] ) + 1;
			}

			$limit = 4;
			if ( isset( $_POST['limit'] ) ) {
				$limit = intval( $_POST['limit'] ) > 0 ? intval( $_POST['limit'] ) : $limit;
			}

			$args = array(
				'post_type'      => $this->slug,
				'order'          => 'ASC',
				'orderby'        => 'menu_order date',
				'paged'          => $page,
				'posts_per_page' => $limit,
			);

			$posts        = new WP_Query( $args );
			$testimonials = $posts->get_posts();

			ob_start();

			include realgymcore_views_template( 'realgymcore-reviews-list' );

			$response['html']        = ob_get_clean();
			$response['count']       = $posts->found_posts;
			$response['next_page']   = $page;
			$response['load_more']   = intval( $page ) !== intval( $posts->max_num_pages );
			$response['total_pages'] = $posts->max_num_pages;

			wp_send_json_success( $response );
		}

		/**
		 * Register Testimonials Category
		 *
		 * @return void
		 */
		public function register_taxonomy() {
			register_taxonomy(
				'realgym-testimonials-category',
				$this->slug,
				array(
					'label'        => esc_html__( 'Testimonials category', 'realgymcore' ),
					'hierarchical' => true,
				)
			);
		}
	}

	new Realgymcore_Testimonials_Post_Type();
}
