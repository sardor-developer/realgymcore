<?php
/**
 * Global plugin functions
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_generate_random_class' ) ) {
	/**
	 * RealGym Generate Random Class
	 *
	 * @param int $length Length.
	 *
	 * @return bool|string
	 */
	function realgymcore_generate_random_class( $length = 10 ) {
		$x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr( str_shuffle( str_repeat( $x, ceil( $length / strlen( $x ) ) ) ), 1, $length );
	}
}
/**
 * Line brake tag
 *
 * @return string
 */
function realgymcore_add_linebreak_shortcode() {
	return '<br />';
}

add_shortcode( 'br', 'add_linebreak_shortcode' );
if ( ! function_exists( 'realgymcore_get_meta_field' ) ) {
	/**
	 * RealGym Get Meta Field
	 *
	 * @param int    $post_id  Post ID.
	 * @param string $meta_key Meta key.
	 *
	 * @return null
	 */
	function realgymcore_get_meta_field( $post_id, $meta_key ) {
		$response = null;

		$add_domain = strpos( $meta_key, REALGYMCORE_DOMAIN . '_' );

		$key = ( false === $add_domain ) ? REALGYMCORE_DOMAIN . '_' . $meta_key : $meta_key;

		if ( metadata_exists( 'post', $post_id, $key ) ) {
			$response = get_post_meta( $post_id, $key, true );
		}

		return $response;
	}
}
if ( ! function_exists( 'realgymcore_is_realgymcore_active_theme' ) ) {
	/**
	 * Check IFRealGymTheme is Active Theme
	 *
	 * @return bool
	 */
	function realgymcore_is_realgymcore_active_theme() {
		$current_theme = get_option( 'stylesheet' );

		return 'realgym-child' === $current_theme || 'realgym' === $current_theme;
	}
}
if ( ! function_exists( 'realgymcore_filtered_image' ) ) {
	/**
	 * RealGym filtered image
	 *
	 * @param string $image Image.
	 *
	 * @return mixed
	 */
	function realgymcore_filtered_image( $image ) {
		return apply_filters( 'realgymcore_filtered_image', $image );
	}
}
if ( ! function_exists( 'realgymcore_wp_date' ) ) {
	/**
	 * RealGym date format.
	 *
	 * @param string $date Image.
	 *
	 * @return mixed
	 */
	function realgymcore_wp_date( $date ) {
		if ( empty( $date ) ) {
			return '';
		}

		$date_format = get_option( 'date_format' );

		if ( ! empty( $date_format ) ) {
			return wp_date( get_option( 'date_format' ), strtotime( $date ) );
		}

		return wp_date( 'j F Y', strtotime( $date ) );
	}

	add_filter( 'realgymcore_wp_date', 'realgymcore_wp_date' );
}
if ( ! function_exists( 'realgymcore_get_placeholder_image_url' ) ) {
	/**
	 * Get Placeholder image url.
	 *
	 * @param string $size size of the image.
	 *
	 * @return string
	 * @author  Balcomsoft
	 */
	function realgymcore_get_placeholder_image_url( $size = 'realgym-post-thumbnail' ) {
		global $realgym_settings;
		$realgym_placeholder_url = REALGYMCORE_ASSETS . '/images/placeholder-1024x573.png';
		if ( isset( $realgym_settings['article_default_logo'] ) ) {
			$placeholder = $realgym_settings['article_default_logo'];
			if ( isset( $placeholder['url'] ) && ! empty( $placeholder['url'] ) ) {
				$realgym_placeholder_url = $placeholder['url'];
			}
		}

		return $realgym_placeholder_url;
	}
}
if ( ! function_exists( 'realgymcore_get_modal_cf7' ) ) {

	/**
	 * Get Modal Contact form.
	 *
	 * @author Balcomsoft
	 */
	function realgymcore_get_modal_cf7() {
		global $post;
		$realgymcore_shortcode = realgym_get_string_option( 'realgym_cf7_contact_us' );
		?>

		<!-- Modal -->
		<div class="modal fade" id="realgymcore-join-class" class="realgymcore-join-class"
			tabindex="-1" aria-labelledby="realgymcore-join-classLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content realgymcore-modal-content">
					<div class="modal-header">
						<h3 class="modal-title realgym-heading-3" ><?php echo esc_html__( 'Join Class Form', 'realgymcore' ); ?></h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo esc_html__( 'Close', 'realgymcore' ); ?>"></button>
					</div>
					<div class="modal-body"> 
					<?php
						echo ( ! empty( $realgymcore_shortcode ) ) ? do_shortcode( $realgymcore_shortcode ) : '';
					?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

add_filter(
	'wpcf7_form_elements',
	function ( $form ) {
		global $post;
		$form = str_replace( 'CLASS_VALUE', $post->post_title, $form );

		return $form;
	}
);

if ( ! function_exists( 'realgymcore_safe_base64decode' ) ) {
	/**
	 * RealGym Base64 Decode
	 *
	 * @param string $text Encoded Text.
	 *
	 * @return string
	 */
	function realgymcore_safe_base64decode( $text ) {
		if ( empty( $text ) ) {
			return '';
		}
		return base64_decode( $text ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
	}
}

if ( ! function_exists( 'realgymcore_filtered_output' ) ) {
	/**
	 * RealGym Output
	 *
	 * @param string $output Output.
	 *
	 * @return string
	 */
	function realgymcore_filtered_output( $output ) {
		return $output;
	}
}

if ( ! function_exists( ' realgymcore_param_parse_atts' ) ) {
	/**
	 * Parce attributes.
	 *
	 * @param string $atts_string attributes_string.
	 *
	 * @return array|mixed
	 */
	function realgymcore_param_parse_atts( $atts_string ) {
		$array = json_decode( urldecode( $atts_string ), true );

		return $array;
	}
}

if ( ! function_exists( ' realgymcore_shortcode_custom_css_class' ) ) {

	/**
	 *
	 * Filter Css class.
	 *
	 * @param string $params parameters.
	 * @param string $pr prefix.
	 *
	 * @return string
	 */
	function realgymcore_shortcode_custom_css_class( $params, $pr = '' ) {
		$filtered_css = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $params ) ? $pr . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $params ) : '';

		return $filtered_css;
	}
}

if ( ! function_exists( 'realgymcore_bmst_display_embedded_video' ) ) {
	/**
	 * Echoes appropriate video embed
	 *
	 * @param int  $post_id Video post id.
	 * @param bool $show_poster Show poster.
	 * @param bool $trigger_modal Trigger modal.
	 */
	function realgymcore_bmst_display_embedded_video( $post_id, $show_poster = false, $trigger_modal = true ) {
		global $realgym_settings;
		$response   = '';
		$video_logo = '';
		$video_url  = get_post_meta( $post_id, 'realgymcore_video_url', true );

		if ( empty( $video_url ) ) {
			return false;
		}

		if ( ! empty( $realgym_settings['video_logo_enabled'] ) && ! empty( $realgym_settings['video_logo']['url'] ) ) {
			$video_logo = '<img alt="' . esc_html__( 'Video Player', 'realgymcore' ) . '"  class="realgym-video-player-logo" src="' . $realgym_settings['video_logo']['url'] . '" />';
		}

		if ( ! empty( $video_url ) && false === $trigger_modal ) {
			$vendor = realgymcore_bmst_get_vendor_by_video_url( $video_url );
			switch ( $vendor ) {
				case 'youtube':
					$embed_url = realgymcore_bmst_embedify_youtube_url( $video_url );
					$response  = '<iframe width="100%" height="460" src="' . $embed_url . '" title="' . esc_html__( 'YouTube Video player', 'realgymcore' ) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					break;
				case 'vimeo':
					$embed_url = realgymcore_bmst_embedify_vimeo_url( $video_url );
					$response  = '<div id="realgym-vimeo-iframe-wrap"><iframe src="' . $embed_url . '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>';
					break;
				case 'local':
					$response = do_shortcode( '[video src="' . $video_url . '" height="460"]' );
					break;
				default:
					// could not identify the vendor.
					break;
			}
		}

		// prepend video poster.
		if ( true === $show_poster && has_post_thumbnail( $post_id ) ) {
			$the_video = $response;
			$the_image = '';
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

			if ( ! empty( $image_src ) && ! empty( $image_src[0] ) ) {
				$the_image = $image_src[0];
			}

			$only_class = '';
			if ( true === $trigger_modal ) {
				$only_class = 'only-poster';
			}
			$response = '<div class="realgym-video-poster ' . $only_class . '" style="position:relative;background:url(' . $the_image . ');">';
			if ( ! empty( $video_logo ) ) {
				$response .= $video_logo;
			}

			if ( $trigger_modal ) {
				$response .= '<span class="realgym-play-button" data-video="' . $post_id . '"><i class="fi fi-sr-play"></i></span>';
			} else {
				$response .= '<span class="realgym-play-button reveal-real-player"><i class="fi fi-sr-play"></i></span>';
			}

			$response .= $the_video;
			$response .= '</div>';
		}

		return $response;
	}
}


if ( ! function_exists( 'realgymcore_bmst_get_vendor_by_video_url' ) ) {
	/**
	 * Identify video service by video URL
	 *
	 * @param string $video_url Video URL.
	 */
	function realgymcore_bmst_get_vendor_by_video_url( $video_url ) {
		$vendor = 'unknown';
		if ( ! empty( $video_url ) ) {
			if ( false !== strpos( $video_url, 'youtu.be' ) || false !== strpos( $video_url, 'youtube.com' ) ) {
				$vendor = 'youtube';
			} elseif ( false !== strpos( $video_url, 'vimeo.com' ) ) {
				$vendor = 'vimeo';
			} elseif ( in_array( substr( trim( $video_url ), -3 ), array( 'mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv' ), true ) ) {
				$vendor = 'local';
			}
		}

		return $vendor;
	}
}


if ( ! function_exists( 'realgymcore_bmst_embedify_youtube_url' ) ) {
	/**
	 * Youtube regular to embed URL
	 *
	 * @param string $video_url Video URL.
	 */
	function realgymcore_bmst_embedify_youtube_url( $video_url ) {
		$pre_url = 'https://www.youtube.com/embed/';
		if ( false !== strpos( $video_url, 'watch?v=' ) ) {
			$exploded = explode( 'watch?v=', $video_url );
			$video_id = array_pop( $exploded );
		} elseif ( false !== strpos( $video_url, 'youtu.be/' ) ) {
			$exploded = explode( 'youtu.be/', $video_url );
			$video_id = array_pop( $exploded );
		}

		if ( ! empty( $video_id ) ) {
			$video_url = $pre_url . $video_id;
		}

		return $video_url;
	}
}


if ( ! function_exists( 'realgymcore_bmst_embedify_vimeo_url' ) ) {
	/**
	 * Vimeo regular to embed URL
	 *
	 * @param string $video_url Video URL.
	 */
	function realgymcore_bmst_embedify_vimeo_url( $video_url ) {
		$pre_url = 'https://player.vimeo.com/video/';
		if ( false !== strpos( $video_url, 'vimeo.com/' ) ) {
			$exploded  = explode( 'vimeo.com/', $video_url );
			$video_id  = array_pop( $exploded );
			$video_url = $pre_url . $video_id;
		}

		return $video_url;
	}
}


if ( ! function_exists( 'realgymcore_get_array_value' ) ) {
	/**
	 * RealgymCore Get Array Value
	 *
	 * @param string $key Array Key.
	 * @param array  $array Array Element.
	 * @param string $default_value Default value.
	 * @return mixed
	 */
	function realgymcore_get_array_value( $key, $array, $default_value = '' ) {
		if ( ! isset( $array[ $key ] ) ) {
			return $default_value;
		}

		return $array[ $key ];
	}
}

if ( ! function_exists( 'realgymcore_get_required_attr' ) ) {
	/**
	 * RealgymCore Get Required Attribute
	 *
	 * @param array $array Array Element.
	 * @return string
	 */
	function realgymcore_get_required_attr( $array = array() ) {
		$required = '';
		if ( is_array( $array ) && 3 === count( $array ) ) {
			$required .= 'data-required=' . REALGYMCORE_META_SETTINGS_OPT . '[' . $array[0] . '] ';
			$required .= 'data-value=' . $array[2];
		}
		return $required;
	}
}

if ( ! function_exists( 'generate_background_media_inline_css' ) ) {
	/**
	 * RealgymCore Generate Inline Media Css for Background
	 *
	 * @param array $values Input Values.
	 * @return string
	 */
	function realgymcore_generate_background_media_inline_css( $values = array() ) {
		$css = '';

		if ( ! empty( $values ) && is_array( $values ) ) {
			foreach ( $values as $key => $val ) {
				if ( ! empty( $val ) && 'media' !== $key ) {
					if ( 'background-image' === $key ) {
						$css .= $key . ":url('" . esc_url( $val ) . "');";
					} else {
						$css .= $key . ':' . esc_attr( $val ) . ';';
					}
				}
			}
		}

		return $css;
	}
}

if ( ! function_exists( 'realgymcore_get_autocomplete_posts' ) ) {
	/**
	 * RealGym VC function
	 *
	 * @param array $args array Arguments.
	 * @return array
	 */
	function realgymcore_get_autocomplete_posts( $args = array() ) {
		$query1 = new WP_Query( $args );
		$values = array();

		$posts = $query1->get_posts();
		foreach ( $posts as $post ) {
			$values[ $post->ID ] = $post->post_title;
		}

		wp_reset_postdata();
		return $values;
	}
}
?>
