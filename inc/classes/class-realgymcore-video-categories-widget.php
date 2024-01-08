<?php
/**
 * Video categories widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Video_Categories_Widget' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Video_Categories_Widget extends WP_Widget {

		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgym-video-categories-widget',
				esc_html__( 'RealGym Video Categories', 'realgymcore' ),
				array( 'description' => esc_html__( 'Display Video Categories as a Widget', 'realgymcore' ) )
			);
		}

		/**
		 * Widget
		 *
		 * @param array  $args Arguments.
		 * @param object $instance Instance of a widget.
		 * @return void
		 */
		public function widget( $args, $instance ) {
			echo wp_kses_post( $args['before_widget'] );
			$widget_title = apply_filters( 'widget_title', $instance['title'] );
			$video_cats   = $this->get_video_categories();

			?>
			<div class="realgym-sidebar-item realgym-about">
				<div class="realgym-sidebar-card realgym-card">
					<?php if ( $widget_title ) : ?>
						<div class="realgym-card-head">
							<h3 class="realgym-heading-3"><?php echo wp_kses_post( $args['before_title'] ) . esc_html( $widget_title ) . wp_kses_post( $args['after_title'] ); ?></h3>
						</div>
					<?php endif; ?>
					<div class="realgym-sidebar-card realgym-card">
						<div class="realgym-card-body realgym-categories-card-body">
						<?php
						if ( ! empty( $video_cats ) ) {
							echo '<ul class="realgym-categories-widget">';
							foreach ( $video_cats as $cat_id => $cat ) {
								echo '<li>';
								echo '<a href="' . esc_url( $cat['link'] ) . '">';
								echo esc_html( $cat['name'] );
								echo '</a>';
								echo '</li>';
							}
							echo '</ul>';
						}
						?>
						</div>
					</div>
				</div>
			</div>
			<?php
			echo wp_kses_post( $args['after_widget'] );
		}

		/**
		 * Widget form
		 *
		 * @param object $instance Instance of a widget.
		 * @return void
		 */
		public function form( $instance ) {
			if ( isset( $instance['title'] ) ) {
				$widget_title = esc_attr( $instance['title'] );
			} else {
				$widget_title = esc_attr__( 'Video categories', 'realgymcore' );
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
			</p>
			<?php
		}

		/**
		 * Widget form
		 *
		 * @param object $new_instance Instance of a widget.
		 * @param object $old_instance Instance of a widget.
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance          = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
			return $instance;
		}

		/**
		 * Widget form
		 *
		 * @return array
		 */
		protected function get_video_categories() {
			$response   = array();
			$video_cats = get_terms(
				'realgym-video-category',
				array(
					'hide_empty' => false,
				)
			);

			if ( ! empty( $video_cats ) && ! is_wp_error( $video_cats ) ) {
				foreach ( $video_cats as $cat ) {
					$response[ $cat->term_id ]['name'] = $cat->name;
					$response[ $cat->term_id ]['link'] = '#!';
					$term_link                         = get_term_link( $cat );

					if ( ! is_wp_error( $term_link ) ) {
						$response[ $cat->term_id ]['link'] = $term_link;
					}
				}
			}

			return $response;
		}
	}

	new Realgymcore_Video_Categories_Widget();
}
