<?php
/**
 * Recent posts widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Recent_Posts_Widget' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Recent_Posts_Widget extends WP_Widget {

		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgym-recent-posts-widget',
				esc_html__( 'RealGym Recent posts', 'realgymcore' ),
				array( 'description' => esc_html__( 'Display Recent posts as a Widget', 'realgymcore' ) )
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
			if ( ! empty( $instance['limit'] ) ) {
				$limit = intval( $instance['limit'] );
			} else {
				$limit = 4;
			}
			$widget_title = apply_filters( 'widget_title', $instance['title'] );
			$recent_posts = $this->get_recent_posts( $limit );

			?>
			<div class="realgym-sidebar-item realgym-about">
				<div class="realgym-sidebar-card realgym-card">
					<?php if ( $widget_title ) : ?>
						<div class="realgym-card-head">
							<h3 class="realgym-heading-3"><?php echo wp_kses_post( $args['before_title'] ) . esc_html( $widget_title ) . wp_kses_post( $args['after_title'] ); ?></h3>
						</div>
					<?php endif; ?>
					<div class="realgym-sidebar-card realgym-card">
						<div class="realgym-card-body">
							<?php if ( ! empty( $recent_posts ) ) : ?>
								<div class="realgym-recent-posts-widget">
									<?php foreach ( $recent_posts as $recent_post ) : ?>
										<div class="recent-post">
											<div class="image">
												<?php if ( ! empty( $recent_post['image'] ) ) : ?>
													<a href="<?php echo esc_url( $recent_post['link'] ); ?>">
														<img src="<?php echo esc_url( $recent_post['image'] ); ?>" alt="<?php esc_attr_e( 'Recent post image', 'realgymcore' ); ?>">
													</a>
												<?php endif; ?>
											</div>
											<div class="content">
												<div class="title">
													<a href="<?php echo esc_url( $recent_post['link'] ); ?>">
														<h5><?php echo esc_html( $recent_post['title'] ); ?></h5>
													</a>
												</div>
												<div class="date">
													<p><?php echo esc_html( $recent_post['date'] ); ?></p>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
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
				$widget_title = esc_attr__( 'Recent posts', 'realgymcore' );
			}

			if ( isset( $instance['limit'] ) ) {
				$limit_escaped = esc_attr( $instance['limit'] );
			} else {
				$limit_escaped = 4;
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Limit:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" value="<?php echo esc_attr( $limit_escaped ); ?>" />
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
			$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? wp_strip_all_tags( $new_instance['limit'] ) : '';
			return $instance;
		}

		/**
		 * Widget form
		 *
		 * @param int $limit Number of posts to show.
		 * @return array
		 */
		protected function get_recent_posts( $limit ) {
			$response = array();

			$numberposts = 4;
			if ( ! empty( $limit ) && is_numeric( $limit ) && 0 < $limit ) {
				$numberposts = intval( $limit );
			}

			$recent_posts = get_posts(
				array(
					'post_type'   => 'post',
					'post_status' => 'publish',
					'numberposts' => $numberposts,
				)
			);

			if ( ! empty( $recent_posts ) ) {
				foreach ( $recent_posts as $recent_post ) {
					$response[ $recent_post->ID ]['title'] = $recent_post->post_title;
					$response[ $recent_post->ID ]['link']  = get_post_permalink( $recent_post->ID );
					$response[ $recent_post->ID ]['date']  = get_the_date( get_option( 'date_format' ), $recent_post->ID );
					if ( has_post_thumbnail( $recent_post->ID ) && ! empty( get_the_post_thumbnail_url( $recent_post->ID, 'thumbnail' ) ) ) {
						$response[ $recent_post->ID ]['image'] = get_the_post_thumbnail_url( $recent_post->ID, 'thumbnail' );
					}
				}
			}

			return $response;
		}
	}

	new Realgymcore_Recent_Posts_Widget();
}
