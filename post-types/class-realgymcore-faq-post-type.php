<?php
/**
 * FAQ class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_FAQ_Post_Type' ) ) {
	/**
	 * Register FAQ post type
	 *
	 * @return void
	 */
	class Realgymcore_FAQ_Post_Type {
		/**
		 * Slug
		 *
		 * @var string
		 */
		private $slug = 'realgym-faqs';

		/**
		 * Name
		 *
		 * @var string
		 */
		private $name = 'FAQs';

		/**
		 * Singular name
		 *
		 * @var string
		 */
		private $singular_name = 'FAQ';

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register' ) );
			add_action( 'wp_ajax_realgymcore_ajax_faqs_request', array( $this, 'get_ajax_faqs' ) );
			add_action( 'wp_ajax_nopriv_realgymcore_ajax_faqs_request', array( $this, 'get_ajax_faqs' ) );
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
				'excerpt',      // Allows short description.
				'thumbnail',    // Allows feature images.
				'editor',       // Content.
			);
			$args     = array(
				'labels'              => $labels,
				'description'         => __( 'FAQS', 'realgymcore' ), // Description.
				'supports'            => $supports,
				'taxonomies'          => array(), // Allowed taxonomies.
				'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page.
				'public'              => false,  // Makes the post type public.
				'show_ui'             => true,  // Displays an interface for this post type.
				'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel).
				'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus.
				'show_in_admin_bar'   => true,  // Displays in the black admin bar.
				'menu_position'       => 53.6,     // The position number in the left menu.
				'menu_icon'           => true,  // The URL for the icon used for this post type.
				'can_export'          => true,  // Allows content export using Tools -> Export.
				'has_archive'         => true,  // Enables post type archive (by month, date, or year).
				'exclude_from_search' => true, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false.
				'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true.
				'capability_type'     => 'post', // Allows read, edit, delete like “Post”.
				'rewrite'             => array(
					'slug'       => 'faqs',
					'with_front' => false,
				),
			);
			register_post_type( $this->slug, $args );
		}

		/**
		 * Get faqs by AJAX call
		 *
		 * @return void
		 */
		public function get_ajax_faqs() {
			check_ajax_referer( 'realgymcore_ajax_faqs_nonce', 'nonce' );
			$response = array();
			$term     = ( ! empty( $_GET['term'] ) ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';

			$args = array(
				'post_type'      => $this->slug,
				'order'          => 'ASC',
				'orderby'        => 'menu_order date',
				'posts_per_page' => -1,
				'post_status'    => array( 'publish' ),
				's'              => $term,
			);

			$posts = new WP_Query( $args );
			$faqs  = $posts->get_posts();
			foreach ( $faqs as $faq ) {
				$response['faqs'][] = array(
					'post_title' => $faq->post_title,
					'ID'         => $faq->ID,
				);
			}
			wp_reset_postdata();
			wp_send_json_success( $response );
		}
	}

	new Realgymcore_FAQ_Post_Type();
}