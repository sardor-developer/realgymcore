<?php
/**
 * Post categories widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Categories_Widget' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Categories_Widget extends WP_Widget {

		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgym-categories-widget',
				esc_html__( 'RealGym Post Categories', 'realgymcore' ),
				array( 'description' => esc_html__( 'Display Post Categories as a Widget', 'realgymcore' ) )
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
			$post_cats    = $this->get_post_categories();

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
						if ( ! empty( $post_cats ) ) {
							echo '<ul class="realgym-categories-widget">';
							foreach ( $post_cats as $cat_id => $cat ) {
								echo '<li>';
								echo '<a href="' . esc_url( $cat['link'] ) . '">';
								echo '<span class="label-count">';
								echo esc_html( $cat['name'] ) . ' (' . esc_html( $cat['count'] ) . ')';
								echo '</span>';
								if ( ! empty( $cat['children'] ) ) {
									echo '<div class="toggler-arrow-wrap" data-child="' . esc_attr( $cat_id ) . '">';
									echo '<div class="toggler-arrow"></div>';
									echo '</div>';
								}
								echo '</a>';
								echo '</li>';
								if ( ! empty( $cat['children'] ) ) {
									echo '<li>';
									echo '<ul class="children child-' . esc_attr( $cat_id ) . '">';
									foreach ( $cat['children'] as $child ) {
										echo '<li>';
										echo '<a href="' . esc_url( $child['link'] ) . '">';
										echo '<span class="label-count">';
										echo esc_html( $child['name'] ) . ' (' . esc_html( $child['count'] ) . ')';
										echo '</span>';
										echo '</a>';
										echo '</li>';
									}
									echo '</ul>';
									echo '</li>';
								}
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
				$widget_title = esc_attr__( 'Post categories', 'realgymcore' );
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
		protected function get_post_categories() {
			$response  = array();
			$post_cats = get_terms(
				'category',
				array(
					'hide_empty' => false,
					'parent'     => 0,
				)
			);

			if ( ! empty( $post_cats ) && ! is_wp_error( $post_cats ) ) {
				foreach ( $post_cats as $cat ) {
					$response[ $cat->term_id ]['name']  = $cat->name;
					$response[ $cat->term_id ]['count'] = $cat->count;
					$response[ $cat->term_id ]['link']  = '#!';
					$term_link                          = get_term_link( $cat );

					if ( ! is_wp_error( $term_link ) ) {
						$response[ $cat->term_id ]['link'] = $term_link;
					}

					// get children.
					$children = get_term_children( $cat->term_id, 'category' );

					if ( ! is_wp_error( $children ) && ! empty( $children ) ) {
						foreach ( $children as $term_id ) {
							$child           = get_term( $term_id, 'category' );
							$child_link      = '#!';
							$child_term_link = get_term_link( $term_id );

							if ( ! is_wp_error( $term_link ) ) {
								$child_link = $child_term_link;
							}

							if ( ! is_wp_error( $child ) && ! empty( $child ) ) {
								$response[ $cat->term_id ]['children'][] = array(
									'name'  => $child->name,
									'count' => $child->count,
									'link'  => $child_link,
								);
							}
						}
					}
				}
			}

			return $response;
		}
	}

	new Realgymcore_Categories_Widget();
}
