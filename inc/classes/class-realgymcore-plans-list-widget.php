<?php
/**
 * Plans list Widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Plans_List_Widget' ) ) {
	/**
	 * Plans list Widget Class
	 *
	 * @return void
	 */
	class Realgymcore_Plans_List_Widget extends WP_Widget {
		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgymcore-plans-list-widget',
				esc_html__( 'Realgym Plans list', 'realgymcore' ),
				array( 'description' => esc_html__( 'Display Plans list as a Widget', 'realgymcore' ) )
			);
		}

		/**
		 * Widget Frontend Render
		 *
		 * @param array $args     Arguments.
		 * @param array $instance Widget instance.
		 *
		 * @return void
		 * @see WP_Widget
		 */
		public function widget( $args, $instance ) {
			global $post;

			$title             = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$classes           = $this->get_classes();
			$instance['title'] = '';
			if ( ! empty( $classes ) ) { ?>
				<div class="realgym-sidebar-item realgym-nav-menu">
					<?php echo wp_kses_post( $args['before_widget'] ); ?>
					<?php if ( $title ) { ?>
						<div class="realgym-card-head">
							<h3 class="realgym-heading-3"><?php echo esc_html( $title ); ?></h3>
						</div>
					<?php } ?>
					<nav class="fluid">
						<ul class="realgym-sidebar-nav-list">
							<?php
							$realgymcore_active = 'active';
							foreach ( $classes as $class_id => $class ) {
								?>
								<li class="realgym-sidebar-list-item">
									<a href="<?php echo esc_attr( $class['link'] ); ?>" class="realgym-sidebar-list-link realgym-text-2 d-flex justify-content-between
									text-decoration-none 
									<?php
									if ( $post->ID === $class_id ) {
										echo esc_attr( $realgymcore_active );}
									?>
									">
										<span><?php echo esc_html( $class['name'] ); ?></span>
										<span class="left-arrow">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
													<g opacity="0.5">
													<path d="M8.3485 7.00296L3.11113 1.76537C2.96692 1.6215 2.88759 1.42914 2.88759 1.22403C2.88759 1.01881 2.96692 0.826569 3.11113 0.682472L3.57006 0.223772C3.71404 0.0794472 3.90651 0 4.11162 0C4.31672 0 4.50897 0.0794472 4.65307 0.223772L10.889 6.45958C11.0337 6.60413 11.1129 6.79728 11.1123 7.00262C11.1129 7.20886 11.0338 7.40179 10.889 7.54646L4.65887 13.7762C4.51477 13.9206 4.32253 14 4.11731 14C3.9122 14 3.71996 13.9206 3.57575 13.7762L3.11694 13.3175C2.81838 13.019 2.81838 12.533 3.11694 12.2345L8.3485 7.00296Z" fill="white"/>
													</g>
												</svg>
										</span>
									</a>
								</li>
							<?php } ?>
						</ul>
					</nav>
					<?php echo wp_kses_post( $args['after_widget'] ); ?>
				</div>

				<?php
			}

		}

		/**
		 * Widget form fields
		 *
		 * @param object $instance Instance of a widget.
		 *
		 * @return void
		 */
		public function form( $instance ) {
			if ( isset( $instance['title'] ) ) {
				$title_escaped = esc_attr( $instance['title'] );
			} else {
				$title_escaped = esc_attr__( 'Plans list', 'realgymcore' );
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title_escaped ); ?>"/>
			</p>
			<?php
		}

		/**
		 * Widget Form Update
		 *
		 * @param object $new_instance Instance of a widget.
		 * @param object $old_instance Instance of a widget.
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance          = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';

			return $instance;
		}

		/**
		 * Get Classes
		 *
		 * @return array
		 */
		public function get_classes() {
			$response = array();
			$args     = array(
				'post_type'      => 'realgym-plan',
				'order'          => 'ABC',
				'orderby'        => 'date',
				'posts_per_page' => 30,
			);
			$items    = new WP_Query( $args );
			$items    = $items->get_posts();
			if ( ! empty( $items ) && ! is_wp_error( $items ) ) {
				foreach ( $items as $item ) {
					$response[ $item->ID ]['name'] = $item->post_title;
					$response[ $item->ID ]['link'] = esc_url( get_permalink( $item->ID ) );
				}
			}

			return $response;
		}
	}

	new Realgymcore_Plans_List_Widget();
}
