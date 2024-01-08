<?php
/**
 * Helpers function.
 *
 * @author    Balcomsoft
 * @package   Realgymcore
 * @version   1.0.0
 * @since     1.0.0
 */

if ( ! function_exists( 'realgymcore_elementor_autoload' ) ) {
	/**
	 * Locate class files to load
	 *
	 * @param string $path path to class file.
	 *
	 * @return void
	 */
	function realgymcore_elementor_autoload( $path ) {
		$items = glob( $path . DIRECTORY_SEPARATOR . '*' );
		foreach ( $items as $item ) {
			if ( is_file( $item ) ) {
				if ( 'php' === pathinfo( $item )['extension'] || false !== strpos( $item, 'realgymcore-' ) || false !== strpos( $item, 'class-realgymcore' ) ) {
					require_once $item;
				}
			}
		}
		// Load files in subdirectories.
		foreach ( $items as $item ) {
			if ( is_dir( $item ) ) {
				realgymcore_elementor_autoload( $item );
			}
		}
	}
}
if ( ! function_exists( 'realgymcore_elementor_locate_template' ) ) {
	/**
	 * Realgymcore Elementor Templaete locate function
	 *
	 * @param string $template_name Template name.
	 * @param array  $args          Hide Arguments.
	 *
	 * @return mixed
	 */
	function realgymcore_elementor_locate_template( $template_name, $args ) {
		$plugin_path         = REALGYMCORE_ELEMENTOR_ELEMENTS_OUTPUT_PATH . '/' . $template_name . '.php';
		$theme_template_name = 'framework' . REALGYMCORE_ELEMENTOR_ELEMENTS_OUTPUT . '/' . $template_name . '.php';

		return ( locate_template( $theme_template_name ) ) ? locate_template( $theme_template_name ) : $plugin_path;
	}
}
if ( ! function_exists( 'realgymcore_get_image_by_size' ) ) {

	/**
	 * Get image with sizes.
	 *
	 * @param array $params params.
	 *
	 * @return false
	 * @author Balcomsoft
	 */
	function realgymcore_get_image_by_size( $params = array() ) {
		$params = array_merge(
			array(
				'post_id'    => null,
				'attach_id'  => null,
				'thumb_size' => 'thumbnail',
				'class'      => '',
			),
			$params
		);
		if ( ! $params['thumb_size'] ) {
			$params['thumb_size'] = 'thumbnail';
		}
		if ( ! $params['attach_id'] && ! $params['post_id'] ) {
			return false;
		}
		$post_id     = $params['post_id'];
		$attach_id   = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
		$attach_id   = apply_filters( 'wpml_object_id', $attach_id, 'attachment', true );
		$thumb_size  = $params['thumb_size'];
		$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';
		global $_wp_additional_image_sizes;
		$thumbnail = '';
		$sizes     = array(
			'thumbnail',
			'thumb',
			'medium',
			'large',
			'full',
		);
		if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
			$attachment = get_post( $attach_id );
			$title      = trim( wp_strip_all_tags( $attachment->post_title ) );
			$attributes = array(
				'class' => $thumb_class . 'attachment-' . $thumb_size,
				'title' => $title,
			);
			$thumbnail  = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
		} elseif ( $attach_id ) {
			if ( is_string( $thumb_size ) ) {
				preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
				if ( isset( $thumb_matches[0] ) ) {
					$thumb_size = array();
					$count      = count( $thumb_matches[0] );
					if ( $count > 1 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width.
						$thumb_size[] = $thumb_matches[0][1]; // height.
					} elseif ( 1 === $count ) {
						$thumb_size[] = $thumb_matches[0][0]; // width.
						$thumb_size[] = $thumb_matches[0][0]; // height.
					} else {
						$thumb_size = false;
					}
				}
			}
			if ( is_array( $thumb_size ) ) {
				// Resize image to custom size.
				$p_img      = realgymcore_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
				$alt        = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
				$attachment = get_post( $attach_id );
				if ( ! empty( $attachment ) ) {
					$title = trim( wp_strip_all_tags( $attachment->post_title ) );
					if ( empty( $alt ) ) {
						$alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption.
					}
					if ( empty( $alt ) ) {
						$alt = $title;
					}
					if ( $p_img ) {

						$attributes = realgymcore_stringify_attributes(
							array(
								'class'  => $thumb_class,
								'src'    => $p_img['url'],
								'width'  => $p_img['width'],
								'height' => $p_img['height'],
								'alt'    => $alt,
								'title'  => $title,
							)
						);
						$thumbnail  = '<img ' . $attributes . ' />';
					}
				}
			}
		}
		$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

		return apply_filters(
			'realgymcore_elementor_getimagesize',
			array(
				'thumbnail'   => $thumbnail,
				'p_img_large' => $p_img_large,
			),
			$attach_id,
			$params
		);
	}
}
if ( ! function_exists( 'realgymcore_resize' ) ) {
	/**
	 * Realgymcore resize image.
	 *
	 * @param   int    $attach_id attach_id.
	 * @param   string $img_url image url.
	 * @param   string $width width.
	 * @param   string $height height.
	 * @param false  $crop crop.
	 *
	 * @return array|false|string[]
	 * @author Balcomsoft
	 */
	function realgymcore_resize( $attach_id, $img_url, $width, $height, $crop = false ) {
		// this is an attachment, so we have the ID.
		$image_src = array();
		if ( $attach_id ) {
			$image_src        = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
			// this is not an attachment, let's use the image url.
		} elseif ( $img_url ) {
			$file_path        = wp_parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size        = getimagesize( $actual_file_path );
			$image_src[0]     = $img_url;
			$image_src[1]     = $orig_size[0];
			$image_src[2]     = $orig_size[1];
		}
		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];
			// the image path without the extension.
			$no_ext_path      = $file_info['dirname'] . '/' . $file_info['filename'];
			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
			// checking if the file size is larger than the target size.
			// if it is smaller or the same size, stop right here and return.
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match).
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image        = array(
						'url'    => $cropped_img_url,
						'width'  => $width,
						'height' => $height,
					);

					return $vt_image;
				}
				if ( ! $crop ) {
					// calculate the size proportionaly.
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;
					// checking if the file already exists.
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
						$vt_image        = array(
							'url'    => $resized_img_url,
							'width'  => $proportional_size[0],
							'height' => $proportional_size[1],
						);

						return $vt_image;
					}
				}
				// no cache files - let's finally resize it.
				$img_editor = wp_get_image_editor( $actual_file_path );
				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}
				$new_img_path = $img_editor->generate_filename();
				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}
				if ( ! is_string( $new_img_path ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}
				$new_img_size = getimagesize( $new_img_path );
				$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
				// resized output.
				$vt_image = array(
					'url'    => $new_img,
					'width'  => $new_img_size[0],
					'height' => $new_img_size[1],
				);

				return $vt_image;
			}
			// default output - without resizing.
			$vt_image = array(
				'url'    => $image_src[0],
				'width'  => $image_src[1],
				'height' => $image_src[2],
			);

			return $vt_image;
		}

		return false;
	}
}
if ( ! function_exists( 'realgymcore_stringify_attributes' ) ) {
	/**
	 * Realgymcore stringify attributes.
	 *
	 * @param array $attributes attributes.
	 *
	 * @return string
	 * @author Balcomsoft
	 */
	function realgymcore_stringify_attributes( $attributes ) {
		$atts = array();
		foreach ( $attributes as $name => $value ) {
			$atts[] = $name . '="' . esc_attr( $value ) . '"';
		}

		return implode( ' ', $atts );
	}
}
if ( ! function_exists( 'realgymcore_elementor_regular_fields' ) ) {
	/**
	 * Realgymcore Elementor function
	 *
	 * @param string $asset   Asset.
	 * @param array  $options Array of options.
	 * @param string $element Element.
	 *
	 * @return mixed
	 */
	function realgymcore_elementor_regular_fields( $asset, $options = array(), $element = '' ) {
		$response         = array();
		$animations       = array();
		$animations_types = array( 'fadeIn', 'fadeInUp', 'fadeInUpBig', 'fadeInRight', 'fadeInRightBig', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig' );

		switch ( $asset ) {
			case 'exploded_title':
				$element->add_control(
					'exploded_title',
					array(
						'label'       => esc_html__( 'Title', 'realgymcore' ),
						'type'        => 'realgymcore-exploded-textarea',
						'rows'        => 5,
						'description' => __( 'Each Line will be known as different element', 'realgymcore' ),
					)
				);
				break;
			case 'limit':
				$element->add_control(
					'limit',
					array(
						'label'   => __( 'Limit', 'realgymcore' ),
						'type'    => \Elementor\Controls_Manager::NUMBER,
						'default' => 3,
					)
				);
				break;
			case 'items_per_row':
				$element->add_control(
					'items_per_row',
					array(
						'label'   => __( 'Items per Row', 'realgymcore' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'solid',
						'options' => realgymcore_elementor_commons( 'per_row' ),
					)
				);
				break;
			case 'ordering':
				$element->add_control(
					'order',
					array(
						'label'   => __( 'Order', 'realgymcore' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'solid',
						'options' => realgymcore_elementor_commons( 'ordering' ),
					)
				);
				break;
			case 'element_class':
				$element->add_control(
					'element_class',
					array(
						'label'       => __( 'HTML Class', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'realgymcore' ),
					)
				);
				break;
			case 'element_id':
				$element->add_control(
					'element_id',
					array(
						'label'       => __( 'HTML ID', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'description' => __( 'Style particular content element differently - add a ID and refer to it in custom ID.', 'realgymcore' ),
					)
				);
				break;
			case 'css':
				$element->add_control(
					'css',
					array(
						'label' => __( 'CSS', 'realgymcore' ),
						'type'  => \Elementor\Controls_Manager::TEXTAREA,
					)
				);
				break;
			case 'enable_animation':
				$element->add_control(
					'enable_animation',
					array(
						'label'        => esc_html__( 'Enable Animation', 'realgymcore' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label_on'     => esc_html__( 'Yes, please', 'realgymcore' ),
						'label_off'    => esc_html__( 'No', 'realgymcore' ),
						'return_value' => 'yes',
						'default'      => 'no',
					)
				);
				break;
			case 'animation_type':
				$element->add_control(
					'realgymcore_animation_type',
					array(
						'label'     => __( 'Animation Type', 'realgymcore' ),
						'type'      => \Elementor\Controls_Manager::SELECT,
						'default'   => '',
						'options'   => $animations_types,
						'condition' => array(
							'enable_animation' => 'yes',
						),
					)
				);
				break;
			case 'animation_delay':
				$element->add_control(
					'animation_delay',
					array(
						'label'       => __( 'Animation Delay', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::NUMBER,
						'description' => __( 'Only Numeric values (in Milliseconds).', 'realgymcore' ),
						'default'     => '0',
						'condition'   => array(
							'enable_animation' => 'yes',
						),
					)
				);
				break;
			case 'lordicon_icon':
				$element->add_control(
					'lordicon_icon',
					array(
						'label'       => __( 'Lordicon Icon', 'realgymcore' ),
						'type'        => 'realgymcore-lordicon',
						'description' => wp_kses_post( 'Click Add Button and Choose one of Lordicon Icon, More info: <a href="https://lordicon.com/" target="_blank">lordicon.com</a>' ),
					)
				);
				break;
			case 'lordicon_icon_size':
				$element->add_control(
					'lordicon_icon_size',
					array(
						'label'       => __( 'Icon Size', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::NUMBER,
						'description' => __( 'Enter icon size (Width, Height in pixel.', 'realgymcore' ),
						'default'     => 75,
					)
				);
				break;
			case 'lordicon_animation':
				$element->add_control(
					'lordicon_animation',
					array(
						'label'   => __( 'Lordicon Animation', 'realgymcore' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'default' => 'solid',
						'options' => $animations,
					)
				);
				break;
			case 'lordicon_color_primary':
				$element->add_control(
					'lordicon_color_primary',
					array(
						'label'       => esc_html__( 'Lordicon Primary Color', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::COLOR,
						'selectors'   => array(
							'{{WRAPPER}} .title' => 'color: {{VALUE}}',
						),
						'description' => __( 'Select Primary Color of Lordicon', 'realgymcore' ),
					)
				);
				break;
			case 'lordicon_color_secondary':
				$element->add_control(
					'lordicon_secondary_primary',
					array(
						'label'       => esc_html__( 'Lordicon Secondary Color', 'realgymcore' ),
						'type'        => \Elementor\Controls_Manager::COLOR,
						'selectors'   => array(
							'{{WRAPPER}} .title' => 'color: {{VALUE}}',
						),
						'description' => __( 'Select Secondary Color of Lordicon', 'realgymcore' ),
					)
				);
				break;
		}
	}
}
if ( ! function_exists( 'realgymcore_elementor_commons' ) ) {
	/**
	 * Realgymcore Eelementor function
	 *
	 * @param string $asset   Asset.
	 * @param array  $options Array of options.
	 *
	 * @return mixed
	 */
	function realgymcore_elementor_commons( $asset = '', $options = array() ) {
		switch ( $asset ) {
			case 'color_type':
				return Realgymcore_Elementor_Commons::get_theme_color_type( $options );
			case 'per_row':
				return Realgymcore_Elementor_Commons::get_responsive_options();
			case 'ordering':
				return Realgymcore_Elementor_Commons::get_order_options();
			default:
				return array();
		}
	}
}
if ( ! function_exists( 'realgymcore_elementor_build_link' ) ) {

	/**
	 * Build link.
	 *
	 * @param array $value value.
	 *
	 * @return array
	 */
	function realgymcore_elementor_build_link( $value ) {
		return realgymcore_elementor_parse_multi_attribute(
			$value,
			array(
				'url'    => '',
				'title'  => '',
				'target' => '',
				'rel'    => '',
			)
		);
	}
}
if ( ! function_exists( 'realgymcore_elementor_param_group_parse_atts' ) ) {

	/**
	 * Group parce attributes.
	 *
	 * @param mixed $atts_string attribute string.
	 *
	 * @return mixed
	 */
	function realgymcore_elementor_param_group_parse_atts( $atts_string ) {
		return $atts_string;
	}
}
if ( ! function_exists( 'realgymcore_elementor_parse_multi_attribute' ) ) {

	/**
	 * Parse string like "title:Hello world|weekday:Monday" to array('title' => 'Hello World', 'weekday' => 'Monday')
	 *
	 * @param array $value value.
	 * @param array $default default.
	 *
	 * @return array
	 */
	function realgymcore_elementor_parse_multi_attribute( $value, $default = array() ) {

		return $value;
	}
}

if ( ! function_exists( 'realgymcore_elementor_if_legacy_enabled' ) ) :
	/**
	 * Legacy enabled elementor.
	 *
	 * @return bool
	 */
	function realgymcore_elementor_if_legacy_enabled() {
		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return false;
		}
		if ( version_compare( ELEMENTOR_VERSION, '3.1.0', '>=' ) ) {
			return \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' );
		} elseif ( version_compare( ELEMENTOR_VERSION, '3.0', '>=' ) ) {
			return ( ! \Elementor\Plugin::instance()->get_legacy_mode( 'elementWrappers' ) );
		}

		return false;
	}
endif;
if ( ! function_exists( 'realgymcore_elementor_parse_exploded_string' ) ) :
	/**
	 * Parce exploded string.
	 *
	 * @param string $content content.
	 * @param string $separator separator.
	 *
	 * @return string
	 */
	function realgymcore_elementor_parse_exploded_string( $content, $separator = 'br' ) {
		if ( ! empty( $content ) ) {
			$html = '';
			if ( 'br' === $separator ) {
				return str_replace( ',', '<br/>', $content );
			}
			$content_array = explode( ',', $content );
			foreach ( $content_array as $line ) {
				$html .= '<' . $separator . '>' . $line . '</' . $separator . '>';
			}

			return $html;
		}

		return $content;
	}
endif;

/**
 * Checking Elementor plugin status
 *
 * Check when the site doesn't have Elementor installed or activated.
 */
if ( ! function_exists( 'realgymcore_elementor_status' ) ) {
	/**
	 * Elementor status check
	 *
	 * @return bool
	 * @author Balcomsoft
	 */
	function realgymcore_elementor_status() {
		$elementor_path    = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $elementor_path ] );
	}
}

if ( ! function_exists( 'realgymcore_elementor_font' ) ) {
	/**
	 * Elementor font
	 *
	 * @param mixed $controls_registry .
	 *
	 * @return mixed
	 */
	function realgymcore_elementor_font( $controls_registry ) {
		$fonts     = $controls_registry->get_control( 'font' )->get_settings( 'options' );
		$new_fonts = array_merge( array( 'Anybody' => 'system' ), $fonts );
		$controls_registry->get_control( 'font' )->set_settings( 'options', $new_fonts );
	}
	add_action( 'elementor/controls/controls_registered', 'realgymcore_elementor_font', 10, 1 );
}
