<?php
/**
 * RealGym VC functions
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_vc_commons' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param string $asset Asset.
	 * @return mixed
	 */
	function realgymcore_vc_commons( $asset = '' ) {
		switch ( $asset ) {
			case 'post_type':
				return Realgymcore_VC_Commons::get_post_types();
			case 'color_type':
				return Realgymcore_VC_Commons::get_theme_color_type();
			case 'padding_options':
				return Realgymcore_VC_Commons::get_row_spacing_options();
			case 'background_position_options':
				return Realgymcore_VC_Commons::get_background_position_options();
			case 'per_row':
				return Realgymcore_VC_Commons::get_responsive_options();
			case 'ordering':
				return Realgymcore_VC_Commons::get_order_options();
			case 'btn_vc_options':
				return Realgymcore_VC_Commons::get_btn_options();
			case 'heading_vc_styles':
				return Realgymcore_VC_Commons::get_heading_style_options();
			case 'heading_vc_text_transform':
				return Realgymcore_VC_Commons::get_heading_text_transform_options();
			default:
				return array();
		}
	}
}

if ( ! function_exists( 'realgymcore_vc_regular_fields' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param string $asset Asset.
	 * @param array  $options Array of options.
	 * @return mixed
	 */
	function realgymcore_vc_regular_fields( $asset, $options = array() ) {
		$response = array();

		switch ( $asset ) {
			case 'posts':
				$response = array(
					'type'       => 'dropdown',
					'heading'    => __( 'Post Types', 'realgymcore' ),
					'param_name' => 'post_type',
					'value'      => realgymcore_vc_commons( 'post_type' ),
				);
				break;

			case 'exploded_title':
				$response = array(
					'type'        => 'exploded_textarea',
					'heading'     => __( 'Title', 'realgymcore' ),
					'param_name'  => 'heading_title',
					'description' => __( 'Each Line will be known as different element', 'realgymcore' ),
				);
				break;

			case 'limit':
				$response = array(
					'type'       => 'realgymcore_number',
					'heading'    => __( 'Limit', 'realgymcore' ),
					'param_name' => 'limit',
					'value'      => '3',
				);
				break;

			case 'items_per_row':
				$response = array(
					'type'       => 'dropdown',
					'heading'    => __( 'Items per Row', 'realgymcore' ),
					'param_name' => 'items_per_row',
					'value'      => realgymcore_vc_commons( 'per_row' ),
				);
				break;

			case 'slider_items_per_row':
				$response = array(
					'type'       => 'realgymcore_number',
					'heading'    => __( 'Items Per Row', 'realgymcore' ),
					'param_name' => 'slider_items_per_row',
					'value'      => '3',
				);
				break;

			case 'ordering':
				$response = array(
					'type'       => 'dropdown',
					'heading'    => __( 'Order', 'realgymcore' ),
					'param_name' => 'order',
					'value'      => realgymcore_vc_commons( 'ordering' ),
				);
				break;

			case 'element_class':
				$response = array(
					'type'        => 'textfield',
					'heading'     => __( 'HTML Class', 'realgymcore' ),
					'param_name'  => 'element_class',
					'admin_label' => true,
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'realgymcore' ),
				);
				break;

			case 'element_id':
				$response = array(
					'type'        => 'textfield',
					'heading'     => __( 'HTML ID', 'realgymcore' ),
					'param_name'  => 'element_id',
					'admin_label' => true,
				);
				break;

			case 'css':
				$response = array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS', 'realgymcore' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'realgymcore' ),
				);
				break;

			case 'vc_flaticon':
				$response = array(
					'type'        => 'iconpicker',
					'heading'     => __( 'Icon', 'js_composer' ),
					'param_name'  => 'icon_flaticon',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'flicon',
						'iconsPerPage' => 100,
					),
					'weight'      => 15,
					'description' => __( 'Choose icon from library.', 'js_composer' ),
				);
				break;
		}

		return array_merge( $response, $options );
	}
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'realgymcore_number', 'realgymcore_vc_number_field' );
	vc_add_shortcode_param( 'realgymcore_animation', 'realgymcore_vc_animation_field' );
}

if ( ! function_exists( 'realgymcore_vc_number_field' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param array  $settings Array of options.
	 * @param string $value Value.
	 * @return string
	 */
	function realgymcore_vc_number_field( $settings, $value ) {
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = 'realgymcore-vc-number-container';

		$output = '<div class="' . esc_attr( $class ) . '">';
		ob_start();
		?>
		<label>
			<input type="number" name="<?php echo esc_attr( $param_name ); ?>"
				class="wpb_vc_param_value <?php echo esc_attr( $param_name ) . ' ' . esc_attr( $type ); ?>_field realgymcore-vc-number"
				value="<?php echo esc_attr( $value ); ?>"/>
		</label>
		<?php
		$output .= ob_get_clean();
		$output .= '</div>';

		return $output;
	}
}

if ( ! function_exists( 'realgymcore_vc_animation_field' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param array  $settings Array of options.
	 * @param string $value Value.
	 * @return string
	 */
	function realgymcore_vc_animation_field( $settings, $value ) {
		$output = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

		$output .= '<optgroup label="' . __( 'Fading Animation', 'realgymcore' ) . '">';
		$options = array( 'fadeIn', 'fadeInUp', 'fadeInUpBig', 'fadeInRight', 'fadeInRightBig', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig' );
		foreach ( $options as $option ) {
			$selected = '';
			if ( $option === $value ) {
				$selected = ' selected="selected"';
			}
			$output .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
		}
		$output .= '</optgroup>';

		$output .= '</select>';

		return $output;
	}
}


/**
 * Get Posts for VC
 *
 * @param string $post_type
 * @return array
 */
if ( ! function_exists( 'realgymcore_vc_get_autocomplete_post' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param string $post_type Post type name.
	 * @return mixed
	 */
	function realgymcore_vc_get_autocomplete_post( $post_type = 'page' ) {
		$args   = array(
			'post_type'      => $post_type,
			'posts_per_page' => -1,
		);
		$query1 = new WP_Query( $args );
		$values = array();

		$posts = $query1->get_posts();
		foreach ( $posts as $post ) {
			$values[] = array(
				'label' => $post->post_title,
				'value' => $post->ID,
			);
		}

		wp_reset_postdata();
		return $values;
	}
}


/**
 * Get Terms for VC
 *
 * @param $term
 * @param bool $hide_empty
 * @return array
 */
if ( ! function_exists( 'realgymcore_vc_get_autocomplete_term' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param object $term WP Term object.
	 * @param bool   $hide_empty Hide empty.
	 * @return mixed
	 */
	function realgymcore_vc_get_autocomplete_term( $term, $hide_empty = true ) {
		$terms  = get_terms(
			array(
				'taxonomy'   => $term,
				'hide_empty' => $hide_empty,
			)
		);
		$values = array();
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$values[] = array(
					'label' => $term->name,
					'value' => $term->term_id,
				);
			}
		}

		return $values;
	}
}

if ( ! function_exists( 'realgymcore_vc_locate_template' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param string $template_name Template name.
	 * @param array  $args Hide Arguments.
	 * @return mixed
	 */
	function realgymcore_vc_locate_template( $template_name, $args ) {
		$plugin_path         = REALGYMCORE_VC_ELEMENTS_OUTPUT_PATH . '/' . $template_name . '.php';
		$theme_template_name = 'framework' . REALGYMCORE_VC_ELEMENTS_OUTPUT . '/' . $template_name . '.php';
		return ( locate_template( $theme_template_name ) ) ? locate_template( $theme_template_name ) : $plugin_path;
	}
}

if ( ! function_exists( 'realgymcore_shortcode_locate_template' ) ) {
	/**
	 * RealGym Shortcode template view function
	 *
	 * @param string $template_name Template name.
	 * @param array  $args Hide Arguments.
	 * @return mixed
	 */
	function realgymcore_shortcode_locate_template( $template_name, $args ) {
		$plugin_path         = REALGYMCORE_PATH . '/shortcodes/output/' . $template_name . '.php';
		$theme_template_name = REALGYMCORE_VC_ELEMENTS_OUTPUT . '/' . $template_name . '.php';
		return ( locate_template( $theme_template_name ) ) ? locate_template( $theme_template_name ) : $plugin_path;
	}
}

if ( ! function_exists( 'realgymcore_views_template' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param string $template_name Template name.
	 * @return mixed
	 */
	function realgymcore_views_template( $template_name ) {
		return REALGYMCORE_VIEWS_OUTPUT_PATH . '/' . $template_name . '.php';
	}
}

if ( ! function_exists( 'realgymcore_esc_attr_check' ) ) {
	/**
	 * RealGym check escape var
	 *
	 * @param string $var Variable.
	 *
	 * @return string
	 */
	function realgymcore_esc_attr_check( $var ) {
		return ! empty( $var ) ? esc_attr( $var ) : '';
	}
}

if ( ! function_exists( 'realgymcore_vc_add_inline_style' ) ) {
	/**
	 * RealGym Add Custom Styles as Inline Style
	 *
	 * @param string $css Style.
	 * @param string $custom_title Title.
	 * @return void
	 */
	function realgymcore_vc_add_inline_style( $css, $custom_title = 'realgymcore_vc_inline' ) {
		$name = 'realgymcore_vc_inline-' . $custom_title;
		wp_register_style( $name, false, array(), REALGYMCORE_VERSION );
		wp_enqueue_style( $name );
		wp_add_inline_style( $name, $css );
	}
}

if ( ! function_exists( 'realgymcore_vc_enqueue_scripts_styles' ) ) {
	/**
	 * RealGym Enqueue Scripts & Styles
	 *
	 * @param string $shortcode_slug VC shortcode slug.
	 * @return void
	 */
	function realgymcore_vc_enqueue_scripts_styles( $shortcode_slug ) {
		if ( file_exists( REALGYMCORE_PATH . '/assets/css/components/' . $shortcode_slug . '.css' ) ) {
			wp_enqueue_style( $shortcode_slug, REALGYMCORE_CSS . '/components/' . $shortcode_slug . '.css', array(), REALGYMCORE_VERSION );
		}

		if ( file_exists( REALGYMCORE_PATH . '/assets/js/components/' . $shortcode_slug . '.js' ) ) {
			wp_enqueue_script( $shortcode_slug, REALGYMCORE_JS . '/components/' . $shortcode_slug . '.js', array( 'jquery' ), REALGYMCORE_VERSION, true );
		}
	}
}
