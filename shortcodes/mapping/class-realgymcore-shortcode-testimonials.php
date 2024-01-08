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

if ( ! class_exists( 'Realgymcore_Shortcode_Testimonials' ) ) {
	/**
	 * RealGym shortcode class
	 *
	 * @return void
	 */
	class Realgymcore_Shortcode_Testimonials {
		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'realgymcore-vc-testimonials';

		/**
		 * Name escapeds
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 * Nonce
		 *
		 * @var string
		 */
		protected $nonce;

		/**
		 *  Constructor
		 */
		public function __construct() {
			$this->nonce = 'realgymcore_testimonials_nonce';
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

			if ( ! is_array( $atts ) ) {
				$atts = array();
			}
			ob_start();

			$atts['content'] = $content;

			$limit = isset( $atts['limit'] ) && $atts['limit'] > 0 ? intval( $atts['limit'] ) : 3;

			$args = array(
				'post_type'      => 'realgym-testimonials',
				'order'          => 'ASC',
				'orderby'        => 'menu_order date',
				'paged'          => 1,
				'posts_per_page' => $limit,
			);

			$testimonials_query             = new WP_Query( $args );
			$atts['testimonials']           = $testimonials_query->get_posts();
			$atts['testimonials_max_pages'] = $testimonials_query->max_num_pages;

			$atts['current_page'] = 1;

			include realgymcore_shortcode_locate_template( $this->slug, $atts );
			return ob_get_clean();
		}
	}

	new Realgymcore_Shortcode_Testimonials();
}
