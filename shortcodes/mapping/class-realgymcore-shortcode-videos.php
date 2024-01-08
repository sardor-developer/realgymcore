<?php
/**
 * RealGym Shortcode  block
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Realgymcore_Shortcode_Videos' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_Videos {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-videos';



		/**
		 *  Constructor
		 */
		public function __construct() {

			add_shortcode( $this->slug . '-shortcode', array( $this, 'render' ) );
		}

		/**
		 * Render
		 *
		 * @param array  $atts Array of attributes.
		 * @param string $content Content body.
		 * @return string
		 */
		public function render( $atts, $content ) {
			realgymcore_vc_enqueue_scripts_styles( $this->slug );

			if ( ! is_array( $atts ) ) {
				$atts = array();
			}

			ob_start();

			$atts['content'] = $content;

			$limit = isset( $atts['limit'] ) && $atts['limit'] > 0 ? intval( $atts['limit'] ) : 3;

			$args = array(
				'post_type'      => 'realgym-video',
				'order'          => 'ASC',
				'orderby'        => 'menu_order date',
				'paged'          => 1,
				'posts_per_page' => $limit,
			);

			if ( ! empty( $atts['only_featured'] ) ) {
				$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
					array(
						'key'     => 'realgymcore_video_featured',
						'value'   => 1,
						'compare' => '=',
					),
				);
			}

			$videos_query             = new WP_Query( $args );
			$atts['videos']           = $videos_query->get_posts();
			$atts['videos_max_pages'] = $videos_query->max_num_pages;
			$atts['current_page']     = 1;

			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_Videos();
}
