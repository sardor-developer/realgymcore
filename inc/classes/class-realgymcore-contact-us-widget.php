<?php
/**
 * Contact Us Widget
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Contact_Us_Widget' ) ) {
	/**
	 * Contact us Class Widget Class
	 *
	 * @return void
	 */
	class Realgymcore_Contact_Us_Widget extends WP_Widget {
		/**
		 *  Constructor
		 */
		public function __construct() {
			parent::__construct(
				'realgymcore-contact-us-widget',
				esc_html__( 'Realgym Contact us info', 'realgymcore' ),
				array( 'description' => esc_html__( 'Realgym Contact us as a Widget.', 'realgymcore' ) )
			);

			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
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
			$realgymcore_title = ( ! empty( $instance['realgymcore-title'] ) ) ? $instance['realgymcore-title'] : '';
			$realgymcore_tel   = ( ! empty( $instance['realgymcore-tel'] ) ) ? wp_strip_all_tags( $instance['realgymcore-tel'] ) : '';
			$realgymcore_email = ( ! empty( $instance['realgymcore-email'] ) ) ? wp_strip_all_tags( $instance['realgymcore-email'] ) : '';
			$realgymcore_image = ! empty( $instance['realgymcore-image'] ) ? $instance['realgymcore-image'] : '';
			?>
			<div class="realgym-sidebar-item realgym-about">
				<div class="realgym-sidebar-card realgym-card">
					<?php echo wp_kses_post( $args['before_widget'] ); ?>
					<?php if ( $realgymcore_title ) { ?>
						<div class="realgym-card-head">
							<h3 class="realgym-heading-3"><?php echo esc_html( $realgymcore_title ); ?></h3>
						</div>
					<?php } ?>
					<div class="realgym-sidebar-card realgym-card">
						<?php if ( $realgymcore_image ) : ?>
							<div class="realgym-card-img">
								<img class="realgym-image-responsive" src="<?php echo esc_url( $realgymcore_image ); ?>" alt="image">
							</div>
						<?php endif; ?>
						<div class="realgym-card-body">
							<h3 class="realgym-help-title realgym-heading-3">
								<?php echo esc_html__( 'How can we help?', 'realgymcore' ); ?></h3>
							<p class="realgym-help-text realgym-text-3">
								<?php echo esc_html__( 'If you need any help from us, you can contact us now', 'realgymcore' ); ?>
							</p>
							<ul class="realgym-margin-top">
								<li class="realgym-iconed-item">
									<a href="tel:+1(007)123456789" class="realgym-help-link d-flex align-items-center">
												<span class="realgym-iconed-icon">
													<?php $this->get_svg( 'help-tel', '#0E1722' ); ?>
												</span>
										<span class="text-2"><?php echo esc_html( $realgymcore_tel ); ?></span>
									</a>
								</li>
								<li class="realgym-iconed-item">
									<a href="mailto:someone@example.com"
										class="realgym-help-link d-flex align-items-center">
											<span class="realgym-iconed-icon">
												<?php $this->get_svg( 'help-tel', '#0E1722' ); ?>
											</span>
										<span class="text-2"><?php echo esc_html( $realgymcore_email ); ?></span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<?php echo wp_kses_post( $args['after_widget'] ); ?>
				</div>
			</div>
			<?php
		}

		/**
		 * Widget form fields
		 *
		 * @param object $instance Instance of a widget.
		 *
		 * @return void
		 */
		public function form( $instance ) {
			$form_fields = array(
				'realgymcore-title' => esc_attr__( 'Contact Us', 'realgymcore' ),
				'realgymcore-tel'   => esc_attr__( '888888888', 'realgymcore' ),
				'realgymcore-email' => esc_attr__( 'info.gym@example.com', 'realgymcore' ),
				'realgymcore-image' => esc_url( REALGYMCORE_ASSETS . '/images/placeholder-1024x573.png' ),
			);

			$value_escaped = array();
			foreach ( $form_fields as $key => $field ) {
				if ( isset( $instance[ $key ] ) ) {
					$value_escaped[ $key ] = $instance[ $key ];
				} else {
					$value_escaped[ $key ] = $form_fields[ $key ];
				}
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'realgymcore-title' ) ); ?>"><?php echo esc_html__( 'Title:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'realgymcore-title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'realgymcore-title' ) ); ?>" type="text" value="<?php echo esc_attr( $value_escaped['realgymcore-title'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'realgymcore-tel' ) ); ?>"><?php echo esc_html__( 'Phone:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'realgymcore-tel' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'realgymcore-tel' ) ); ?>" type="tel" value="<?php echo esc_attr( $value_escaped['realgymcore-tel'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'realgymcore-email' ) ); ?>"><?php echo esc_html__( 'Email:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'realgymcore-email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'realgymcore-email' ) ); ?>" type="email" value="<?php echo esc_attr( $value_escaped['realgymcore-email'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'realgymcore-image' ) ); ?>"><?php echo esc_html__( 'Image:', 'realgymcore' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'realgymcore-image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'realgymcore-image' ) ); ?>" type="text" value="<?php echo esc_url( $value_escaped['realgymcore-image'] ); ?>"/>
				<button class="realgymcore_upload_image_button button button-primary"><?php echo esc_html__( 'Upload Image', 'realgymcore' ); ?></button>
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
			$instance                      = array();
			$instance['realgymcore-title'] = ( ! empty( $new_instance['realgymcore-title'] ) ) ? wp_strip_all_tags( $new_instance['realgymcore-title'] ) : '';
			$instance['realgymcore-tel']   = ( ! empty( $new_instance['realgymcore-tel'] ) ) ? wp_strip_all_tags( $new_instance['realgymcore-tel'] ) : '';
			$instance['realgymcore-email'] = ( ! empty( $new_instance['realgymcore-email'] ) ) ? wp_strip_all_tags( $new_instance['realgymcore-email'] ) : '';
			$instance['realgymcore-image'] = ( ! empty( $new_instance['realgymcore-image'] ) ) ? wp_strip_all_tags( $new_instance['realgymcore-image'] ) : '';

			return $instance;
		}

		/**
		 * Get svg path.
		 *
		 * @param string $key metabox key.
		 * @param string $fill_color fill color.
		 *
		 * @return string
		 * @author Balcomsoft
		 */
		public function get_svg( $key, $fill_color ) {
			$svg_path = '';
			switch ( $key ) {
				case 'help-tel':
					?>
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g>
							<path d="M19.4557 14.678L16.6646 11.8869C15.6678 10.8901 13.9732 11.2889 13.5745 12.5847C13.2754 13.4819 12.2786 13.9803 11.3815 13.7809C9.3879 13.2825 6.69652 10.6908 6.19812 8.59746C5.89907 7.7003 6.49716 6.70349 7.39428 6.40448C8.69013 6.00576 9.08886 4.31119 8.09205 3.31438L5.30099 0.523324C4.50354 -0.174441 3.30738 -0.174441 2.60961 0.523324L0.715678 2.41726C-1.17826 4.41087 0.915039 9.69395 5.60003 14.3789C10.285 19.0639 15.5681 21.2569 17.5617 19.2633L19.4557 17.3694C20.1535 16.5719 20.1535 15.3757 19.4557 14.678Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
						</g>
						<defs>
							<clipPath>
								<rect width="20" height="20" fill="<?php echo esc_attr( $fill_color ); ?>"/>
							</clipPath>
						</defs>
					</svg>
					<?php
					break;
				case 'help-tel':
					?>
					<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M22.0073 5.84764V6.43766L13.4073 15.2577C12.6773 16.0176 11.3473 16.0176 10.6073 15.2577L2.00732 6.43766V5.84764C2.00732 5.29766 2.45732 4.84766 3.00731 4.84766H21.0073C21.5573 4.84766 22.0073 5.29766 22.0073 5.84764ZM14.8373 16.6577L22.0073 9.30767V19.8477C22.0073 20.3976 21.5573 20.8476 21.0073 20.8476H3.00731C2.45732 20.8476 2.00732 20.3976 2.00732 19.8477V9.30767L9.16729 16.6476C9.91729 17.4276 10.9273 17.8476 12.0073 17.8476C13.0873 17.8476 14.0973 17.4277 14.8373 16.6577Z" fill="<?php echo esc_attr( $fill_color ); ?>"/>
					</svg>
					<?php
			}

			return $svg_path;
		}

		/**
		 * Scripts load.
		 *
		 * @author Balcomsoft
		 */
		public function scripts() {
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_media();
			wp_enqueue_script( 'realgymcore-media-upload', REALGYMCORE_ASSETS . '/js/admin/widgets/realgymcore-media-upload.js', array( 'jquery' ), REALGYMCORE_VERSION, true );
		}

	}

	new Realgymcore_Contact_Us_Widget();
}
