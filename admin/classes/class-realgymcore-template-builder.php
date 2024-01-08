<?php
/**
 * Template builder class
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Template_Builder' ) ) {
	/**
	 * Template builder
	 *
	 * @return void
	 */
	class Realgymcore_Template_Builder {

		/**
		 *  Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register' ), 0 );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 20 );
			add_action( 'wp_footer', array( $this, 'footer_custom_styles' ) );
			add_shortcode( 'realgymcore-block-template', array( $this, 'render_shortcode' ) );
			add_filter( 'manage_realgymcore-block_posts_columns', array( $this, 'manage_posts_columns' ) );
			add_action( 'manage_realgymcore-block_posts_custom_column', array( $this, 'render_posts_columns' ), 10, 2 );
		}

		/**
		 * Register Post Type
		 *
		 * @return void
		 */
		public function register() {
			$labels = array(
				'name'                  => _x( 'RealGym Template Builder', 'Post Type General Name', 'realgymcore' ),
				'singular_name'         => _x( 'RealGym Template Builder', 'Post Type Singular Name', 'realgymcore' ),
				'menu_name'             => __( 'RealGym Block Templates', 'realgymcore' ),
				'name_admin_bar'        => __( 'RealGym Block Template', 'realgymcore' ),
				'archives'              => __( 'Item Archives', 'realgymcore' ),
				'attributes'            => __( 'Item Attributes', 'realgymcore' ),
				'parent_item_colon'     => __( 'Parent Item:', 'realgymcore' ),
				'all_items'             => __( 'All Items', 'realgymcore' ),
				'add_new_item'          => __( 'Add New Item', 'realgymcore' ),
				'add_new'               => __( 'Add New', 'realgymcore' ),
				'new_item'              => __( 'New Item', 'realgymcore' ),
				'edit_item'             => __( 'Edit Item', 'realgymcore' ),
				'update_item'           => __( 'Update Item', 'realgymcore' ),
				'view_item'             => __( 'View Item', 'realgymcore' ),
				'view_items'            => __( 'View Items', 'realgymcore' ),
				'search_items'          => __( 'Search Item', 'realgymcore' ),
				'not_found'             => __( 'Not found', 'realgymcore' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'realgymcore' ),
				'featured_image'        => __( 'Featured Image', 'realgymcore' ),
				'set_featured_image'    => __( 'Set featured image', 'realgymcore' ),
				'remove_featured_image' => __( 'Remove featured image', 'realgymcore' ),
				'use_featured_image'    => __( 'Use as featured image', 'realgymcore' ),
				'insert_into_item'      => __( 'Insert into item', 'realgymcore' ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', 'realgymcore' ),
				'items_list'            => __( 'Items list', 'realgymcore' ),
				'items_list_navigation' => __( 'Items list navigation', 'realgymcore' ),
				'filter_items_list'     => __( 'Filter items list', 'realgymcore' ),
			);
			$args   = array(
				'label'               => esc_html__( 'RealGym Template Builder', 'realgymcore' ),
				'description'         => esc_html__( 'Template Builder', 'realgymcore' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'revisions' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 75,
				'menu_icon'           => 'dashicons-welcome-widgets-menus',
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'rewrite'             => array(
					'slug'       => 'realgymcore-block',
					'with_front' => false,
				),
			);

			register_post_type( 'realgymcore-block', $args );
		}

		/**
		 * Add Meta Box
		 *
		 * @return void
		 */
		public function add_meta_box() {
			global $post;

			if ( $post && 'publish' === $post->post_status ) {
				add_meta_box(
					'realgymcore-block-template-meta-box',
					__( 'Block Shortcode', 'realgymcore' ),
					array( $this, 'render_meta_box' ),
					'realgymcore-block',
					'normal',
					'high'
				);
			}
		}

		/**
		 * Footer custom styles
		 *
		 * @return void
		 */
		public function footer_custom_styles() {
			$custom_css = '';

			$blocks = get_posts(
				array(
					'post_type'   => 'realgymcore-block',
					'post_status' => 'publish',
					'fields'      => 'ids',
					'numberposts' => -1,
				)
			);

			if ( ! empty( $blocks ) ) {
				foreach ( $blocks as $block_id ) {
					$meta_style = get_post_meta( $block_id, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $meta_style ) ) {
						$custom_css .= $meta_style;
					}
				}
			}

			if ( ! empty( $custom_css ) ) {
				$custom_css = wp_strip_all_tags( $custom_css );
				echo '<style>';
				echo esc_attr( $custom_css );
				echo '</style>';
			}
		}

		/**
		 * Render Meta Box
		 *
		 * @param object $post Post object.
		 * @return void
		 */
		public function render_meta_box( $post ) {
			echo "<div class='realgymcore-shortcode-wrapper'>";
			echo esc_html__( 'Copy this shortcode and paste it into your post, page, or mega menu:', 'realgymcore' );
			echo "<div style='margin-top: 10px; margin-bottom: 10px'>";
			echo "<code style='padding: 10px'>";
			echo '[realgymcore-block-template id="' . intval( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '"]';
			echo '</code>';
			echo '</div>';
			echo '</div>';
		}

		/**
		 * Manage Posts Columns, Add  Shortcode Column
		 *
		 * @param array $columns Columns.
		 * @return mixed
		 */
		public function manage_posts_columns( $columns ) {
			return array(
				'cb'        => $columns['cb'],
				'title'     => $columns['title'],
				'shortcode' => __( 'Shortcode', 'realgymcore' ),
				'date'      => $columns['date'],
			);
		}

		/**
		 * Render Shortcode Content on the column
		 *
		 * @param string $column Column slug.
		 * @param int    $post_id Post ID.
		 * @return void
		 */
		public function render_posts_columns( $column, $post_id ) {
			if ( 'shortcode' === $column ) {
				$post = get_post( $post_id );

				if ( $post && 'publish' === $post->post_status ) {
					echo "<code style='padding: 10px; display: inline-block'>";
					echo '[realgymcore-block-template id="' . intval( $post_id ) . '" title="' . esc_attr( $post->post_title ) . '"]';
					echo '</code>';
				}
			}
		}

		/**
		 * Get Block Templates
		 *
		 * @return array
		 */
		public function get_block_templates() {
			$blocks = array();

			$query = new WP_Query(
				array(
					'post_type'      => 'realgymcore-block',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
				)
			);

			if ( is_array( $query->posts ) && ! empty( $query->posts ) ) {
				foreach ( $query->posts as $post ) {
					$post_id            = $post->ID;
					$blocks[ $post_id ] = $post->post_title;
				}
			}

			return $blocks;
		}

		/**
		 * Render Template Shortcode
		 *
		 * @param array $atts Shortcode attributes.
		 * @return string
		 */
		public function render_shortcode( $atts ) {
			$default  = array(
				'id'    => 0,
				'title' => '',
			);
			$atts     = shortcode_atts( $default, $atts );
			$post_id  = intval( $atts['id'] );
			$response = '';
			if ( $post_id > 0 ) {
				$post = get_post( $post_id );
				if ( $post && 'realgymcore-block' === $post->post_type ) {
					if ( class_exists( 'Elementor\Plugin' ) ) {
						$response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
					}
					if ( '' === $response ) {
						$response = do_shortcode( $post->post_content );
					}
				}
			}
			return $response;
		}
	}

	new Realgymcore_Template_Builder();
}
