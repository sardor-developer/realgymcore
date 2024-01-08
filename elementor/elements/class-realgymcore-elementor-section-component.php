<?php
/**
 * Section Component
 *
 * @author    Balcomsoft
 * @package   Realgymcore
 * @version   1.0.0
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

use Elementor\Embed;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Element_Section;

/**
 * Section Component Class.
 *
 * @author    Balcomsoft
 */
class Realgymcore_Elementor_Section_Component extends Elementor\Element_Section {

	/**
	 * Before render
	 */
	public function before_render() {
		$settings = $this->get_settings_for_display();

		$extra_classes = array( 'realgymcore-elementor-section' );

		$spacing_style = '';
		if ( isset( $settings['spacing_style'] ) && ! empty( $settings['spacing_style'] ) ) {
			$spacing_style = 'realgym_vc_section ' . $settings['spacing_style'];
		}

		$this->add_render_attribute( '_wrapper', 'class', implode( ' ', $extra_classes ) );
		echo '<';
		// PHPCS - the method get_html_tag is safe.
		echo $this->get_html_tag(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<?php $this->print_render_attribute_string( '_wrapper' ); ?>>

		<?php
		if ( 'video' === $settings['background_background'] ) :
			if ( $settings['background_video_link'] ) :
				$video_properties = Embed::get_video_properties( $settings['background_video_link'] );

				$this->add_render_attribute( 'background-video-container', 'class', 'elementor-background-video-container' );

				if ( ! $settings['background_play_on_mobile'] ) {
					$this->add_render_attribute( 'background-video-container', 'class', 'elementor-hidden-phone' );
				}
				?>
				<div <?php $this->print_render_attribute_string( 'background-video-container' ); ?>>
					<?php if ( $video_properties ) : ?>
						<div class="elementor-background-video-embed"></div>
						<?php
					else :
						$video_tag_attributes = 'autoplay muted playsinline';
						if ( 'yes' !== $settings['background_play_once'] ) :
							$video_tag_attributes .= ' loop';
						endif;
						?>
						<video class="elementor-background-video-hosted elementor-html5-video"
						<?php
						// PHPCS - the variable $video_tag_attributes is a plain string.
						echo $video_tag_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
						></video>
					<?php endif; ?>
				</div>
				<?php
			endif;
		endif;

		$has_background_overlay = in_array( $settings['background_overlay_background'], array( 'classic', 'gradient' ), true ) ||
			in_array( $settings['background_overlay_hover_background'], array( 'classic', 'gradient' ), true );

		if ( $has_background_overlay ) :
			?>
			<div class="elementor-background-overlay"></div>
			<?php
		endif;

		if ( $settings['shape_divider_top'] ) {
			$this->print_shape_divider( 'top' );
		}

		if ( $settings['shape_divider_bottom'] ) {
			$this->print_shape_divider( 'bottom' );
		}
		?>
		<div class="elementor-container elementor-column-gap-<?php echo esc_attr( $settings['gap'] ); ?> <?php echo esc_attr( $spacing_style ); ?>">
		<?php if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) { ?>
		<div class="elementor-row">
			<?php
		}
	}

	/**
	 * After render.
	 */
	public function after_render() {
		if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) {
			?>
			</div>
		<?php } ?>
		</div>
		</<?php // phpcs:ignore Squiz
		// PHPCS - the method get_html_tag is safe.
		echo $this->get_html_tag(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		>
		<?php
	}
}

add_action( 'elementor/frontend/section/before_render', 'realgymcore_elementor_section_add_custom_attrs', 10, 1 );
add_filter( 'elementor/section/print_template', 'realgymcore_elementor_print_section_template', 10, 2 );

/**
 * Add section custom attributes.
 *
 * @param object $self self object.
 */
function realgymcore_elementor_section_add_custom_attrs( $self ) {
	$self->add_render_attribute( '_wrapper', 'class', 'realgymcore-elementor-section' );
}

/**
 * Print section template.
 *
 * @param string $content Content.
 *
 * @return false|string
 */
function realgymcore_elementor_print_section_template( $content ) {
	ob_start();

	$content = str_replace(
		'<div class="elementor-container',
		'<div class="elementor-container realgym_vc_section {{{ settings.spacing_style }}} ',
		$content
	);

	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	return ob_get_clean();
}
