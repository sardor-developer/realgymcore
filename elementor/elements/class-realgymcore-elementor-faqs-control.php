<?php
/**
 * Elementor FAQ Control
 *
 * @author    Balcomsoft
 * @package   Realgymcore
 * @version   1.0.0
 * @since     1.0.0
 */

/**
 * Elementor FAQ Control Class.
 *
 * @author    Balcomsoft
 */
class Realgymcore_Elementor_FAQs_Control extends Elementor\Base_Control {

	/**
	 * Control Slug
	 *
	 * @var string
	 */
	private $slug = 'realgymcore-faqs-select';

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
		wp_enqueue_script( 'realgymcore-elementor-faqs-select', REALGYMCORE_ASSETS . '/js/controls/realgymcore-elementor-faqs-select.js', array( 'jquery' ), REALGYMCORE_ELEMENTOR_VERSION, 'all' );
		wp_localize_script(
			'realgymcore-elementor-faqs-select',
			'realgymcore_elementor_faqs_select',
			array(
				'nonce'    => wp_create_nonce( 'realgymcore_ajax_faqs_nonce' ),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Content template.
	 *
	 * @return void
	 */
	public function content_template() {
		?>
		<div class="realgymcore-elementor-faqs-select-container">
			<label class="elementor-control-title">{{{ data.label }}}</label>

			<select class="realgymcore-faqs-select-field" placeholder="{{data.placeholder}}" style="width:100%">
			</select>

			<input type="hidden" class="realgymcore-faqs-select-save-value" data-setting="{{ data.name }}"/>

			<# if(data.description) { #>
			<div class="elementor-control-field-description">
				{{{ data.description }}}
			</div>
			<# } #>
		</div>
		<?php
	}
}
