<?php
/**
 * Elementor Exploded Textarea Control
 *
 * @author    Balcomsoft
 * @package   Realgymcore
 * @version   1.0.0
 * @since     1.0.0
 */

/**
 * Elementor Exploded Textarea Control Class.
 *
 * @author    Balcomsoft
 */
class Realgymcore_Elementor_Exploded_Textarea_Control extends Elementor\Base_Control {

	/**
	 * Control Slug
	 *
	 * @var string
	 */
	private $slug = 'realgymcore-exploded-textarea';

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function get_type() {
		return $this->slug;
	}

	/**
	 * Enqueue
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'realgymcore-elementor-exploded-textarea', REALGYMCORE_ASSETS . '/js/controls/exploded-textarea.js', array( 'jquery' ), REALGYMCORE_ELEMENTOR_VERSION, 'all' );
	}

	/**
	 * Content template.
	 *
	 * @return void
	 */
	public function content_template() {
		?>
		<div class="realgymcore-elementor-exploded-texterea">
			<label class="elementor-control-title">{{{ data.label }}}</label>

			<textarea data-name="{{ data.name }}" class="elementor-control-tag-area realgymcore-exploded-textarea-field" rows="{{data.rows || 5}}"
					placeholder="{{data.placeholder}}" spellcheck="false" data-settings="{{ data.name }}">{{{data.value}}}</textarea>

			<div class="elementor-control-field-description">
				<# if(data.description) { #>
				{{{ data.description }}} -
				<# } #>
				<?php echo esc_html__( 'Each Line will be known as different element ', 'realgymcore' ); ?>
			</div>
		</div>
		<?php
	}
}
