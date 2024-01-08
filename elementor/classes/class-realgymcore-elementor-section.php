<?php
/**
 * Section Class.
 *
 * @author    Balcomsoft
 * @package   Realgymcore
 * @version   1.0.0
 * @since     1.0.0
 */

if ( ! class_exists( 'Realgymcore_Elementor_Section' ) ) {

	/**
	 * Realgymcore Elementor Section
	 *
	 * @return void
	 */
	class Realgymcore_Elementor_Section {

		/**
		 * Constructor.
		 *
		 * @author Balcomsoft
		 */
		public function __construct() {
			add_filter( 'elementor/widget/render_content', array( $this, 'section_render' ), 10, 2 );
		}

		/**
		 * Sections render.
		 *
		 * @param string $content Content.
		 * @param array  $widget widget.
		 *
		 * @return array|string|string[]
		 * @author Balcomsoft
		 */
		public function section_render( $content, $widget ) {

			if ( 'section' === $widget->get_name() ) {

				$settings = $widget->get_settings();
				$args     = $this->eael_get_query_args( $settings );
				if ( isset( $settings['nitro_carousel_link_title'] ) && 'yes' !== $settings['nitro_carousel_link_title'] ) {

					$query = new \WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$title_link = '';
							$title_text = '';
							if ( $settings['eael_show_title'] ) {

								$title_link .= '<a class="eael-grid-post-link" href="' . get_permalink() . '" title="' . get_the_title() . '">';
								if ( empty( $settings['eael_title_length'] ) ) {
									$title_text .= get_the_title();
								} else {
									$title_text .= implode( ' ', array_slice( explode( ' ', get_the_title() ), 0, $settings['eael_title_length'] ) );
								}
								$title_link .= $title_text;
								$title_link .= '</a>';
							}
							$content = str_replace( $title_link, $title_text, $content );

						}
					}
					wp_reset_postdata();
				}
			}

			return $content;
		}
	}

	new Realgymcore_Elementor_Section();
}

add_action(
	'elementor/element/section/section_advanced/after_section_end',
	function ( $element, $args ) {
		$color_style      = array(
			'section-transparent'  => esc_html__( 'Transparent', 'realgymcore' ),
			'section-dark'         => esc_html__( 'Dark Style', 'realgymcore' ),
			'section-light'        => esc_html__( 'Light Style', 'realgymcore' ),
			'section-half-colored' => esc_html__( 'Half Colored', 'realgymcore' ),
		);
		$half_color_style = array(
			'section-dark'  => esc_html__( 'Dark Style', 'realgymcore' ),
			'section-light' => esc_html__( 'Light Style', 'realgymcore' ),
		);
		$spacing_style    = array(
			'realgym_vc_section'           => esc_html__( 'Default', 'realgymcore' ),
			'realgym-vc-no-padding-top'    => esc_html__( 'No Padding Top', 'realgymcore' ),
			'realgym-vc-no-padding-bottom' => esc_html__( 'No Padding Bottom', 'realgymcore' ),
			'realgym-vc-no-padding'        => esc_html__( 'Hide Both', 'realgymcore' ),
		);
		$element->start_controls_section(
			'realgymcore_section_settings',
			array(
				'label' => esc_html__( 'Realgymcore Settings', 'realgymcore' ),
				'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
			)
		);

		$element->add_control(
			'spacing_style',
			array(
				'label'       => esc_html__( 'Spacing Style', 'realgymcore' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '',
				'options'     => $spacing_style,
				'description' => esc_html__( 'Padding sizes are based on Theme Color Configuration.', 'realgymcore' ),
			)
		);

		$element->end_controls_section();
	},
	10,
	3
);
