<?php
/**
 * Search widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Search_Widget' ) ) {
	/**
	 * Register items
	 *
	 * @return void
	 */
	class Realgymcore_Search_Widget extends WP_Widget {

		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgym-search-widget',
				esc_html__( 'RealGym Search', 'realgymcore' ),
				array( 'description' => esc_html__( 'Display Search as a Widget', 'realgymcore' ) )
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
							<div class="realgym-search-widget">
								<form id="searchform" role="search" method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input name="s" type="text" placeholder="<?php echo esc_attr__( 'Search here', 'realgymcore' ); ?>">
									<button type="submit"><i class="fi fi-rr-search"></i></button>
								</form>
							</div>
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
				$widget_title = esc_attr__( 'Search', 'realgymcore' );
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
	}

	new Realgymcore_Search_Widget();
}
