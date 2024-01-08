<?php
/**
 * REALGYMCore Function - Meta Fields
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'realgymcore_render_meta_field_title' ) ) :
	/**
	 * RealgymCore Render Meta Field Title
	 *
	 * @param string $title Meta Field Title.
	 * @return void
	 */
	function realgymcore_render_meta_field_title( $title ) {
		?>
		<div class="realgymcore-metabox__label">
			<div class="realgymcore-metabox__title"><?php echo esc_html( $title ); ?></div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_render_meta_field_description' ) ) :
	/**
	 * RealgymCore Render Meta Field Description
	 *
	 * @param string $id Meta Field ID.
	 * @param string $desc Description.
	 * @return void
	 */
	function realgymcore_render_meta_field_description( $id, $desc ) {
		if ( $desc ) :
			?>
			<div class="realgymcore-metabox__desc">
				<label for="<?php echo esc_attr( $id ); ?>">
					<?php
					echo wp_kses(
						$desc,
						array(
							'em'     => array(),
							'i'      => array(),
							'strong' => array(),
							'a'      => array(
								'class' => array(),
								'href'  => array(),
							),
						)
					);
					?>
				</label>
			</div>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'realgymcore_select_meta_field' ) ) :
	/**
	 * RealgymCore Select Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_select_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'data'  => '',
			'args'  => '',
			'multi' => false,
		);
		$meta_field            = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		$default_option = $meta_field['default'];
		if ( ! empty( $meta_field['data'] ) && empty( $meta_field['options'] ) ) {
			if ( empty( $meta_field['args'] ) ) {
				$meta_field['args'] = array();
			}

			$default_option        = true;
			$meta_field['options'] = realgymcore_get_autocomplete_posts( $meta_field['args'] );
		}

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-select-box">
					<select
							name="<?php echo esc_attr( $meta_field['name'] ) . esc_attr( true === $meta_field['multi'] ? '[]' : '' ); ?>"
							data-name="<?php echo esc_attr( $meta_field['id'] ); ?>"
							id="<?php echo esc_attr( $meta_field['id'] ); ?>"
							data-type="select"
						<?php echo esc_html( true === $meta_field['multi'] ? 'multiple="true"' : '' ); ?>
					>
						<?php if ( $default_option ) : ?>
							<option value=""><?php echo esc_html__( 'Select', '' ); ?></option>
						<?php endif; ?>
						<?php
						if ( is_array( $meta_field['options'] ) ) :
							foreach ( $meta_field['options'] as $key => $option ) :
								$selected = '';
								if ( true === $meta_field['multi'] ) {
									if ( is_array( $meta_value ) ) {
										$selected = in_array( strval( $key ), $meta_value, true ) ? ' selected="selected"' : '';
									}
								} else {
									$selected = selected( $meta_value, $key, false );
								}
								?>
								<option value="<?php echo esc_attr( $key ); ?>"<?php echo esc_attr( $selected ); ?>>
									<?php echo esc_html( $option ); ?>
								</option>
								<?php
							endforeach;
						endif
						?>
					</select>
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_color_meta_field' ) ) :
	/**
	 * RealgymCore Color Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_color_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-color-box">
					<input type="text" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>" size="50%" class="realgymcore-color-field"/>
					<label class="realgymcore-transparency-check" for="<?php echo esc_attr( $meta_field['id'] ); ?>-transparency">
						<input type="checkbox" value="1" id="<?php echo esc_attr( $meta_field['id'] ); ?>-transparency" class="realgymcore-checkbox realgymcore-color-transparency"<?php echo 'transparent' === $meta_value ? ' checked="checked"' : ''; ?>>
						<?php esc_html_e( 'Transparent', 'realgymcore' ); ?>
					</label>
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_editor_meta_field' ) ) :
	/**
	 * RealgymCore Editor Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_editor_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-editor-box">
					<?php
					wp_editor(
						$meta_value,
						$meta_field['id'],
						array(
							'media_buttons' => false,
							'textarea_name' => $meta_field['name'],
							'textarea_rows' => 10,
						)
					);
					?>
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_switch_meta_field' ) ) :
	/**
	 * RealgymCore Switch Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_switch_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'on'  => '',
			'off' => '',
		);

		$meta_field = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		if ( 1 === (int) $meta_value ) {
			$cb_enabled = 'selected';
		} else {
			$cb_disabled = 'selected';
		}

		$on  = ! empty( $on ) ? $on : esc_html__( 'On', 'realgymcore' );
		$off = ! empty( $off ) ? $off : esc_html__( 'Off', 'realgymcore' );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-switch-box">
					<label class="cb-enable <?php echo esc_attr( $cb_enabled ); ?>" data-id="<?php echo esc_attr( $meta_field['id'] ); ?>"><span><?php echo esc_html( $on ); ?></span></label>
					<label class="cb-disable <?php echo esc_attr( $cb_disabled ); ?>" data-id="<?php echo esc_attr( $meta_field['id'] ); ?>"><span><?php echo esc_html( $off ); ?></span></label>
					<input type="hidden" class="checkbox checkbox-input <?php echo esc_attr( $meta_field['class'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" data-type="switch">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_background_meta_field' ) ) :
	/**
	 * RealgymCore Background Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_background_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'background-color'      => true,
			'background-repeat'     => true,
			'background-attachment' => true,
			'background-position'   => true,
			'background-image'      => true,
			'background-gradient'   => false,
			'background-clip'       => false,
			'background-origin'     => false,
			'background-size'       => true,
			'preview'               => true,
			'transparent'           => true,
		);

		$meta_field = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		$defaults = array(
			'background-color'      => '',
			'background-repeat'     => '',
			'background-attachment' => '',
			'background-position'   => '',
			'background-image'      => '',
			'background-clip'       => '',
			'background-origin'     => '',
			'background-size'       => '',
			'media'                 => array(),
		);

		$meta_value = wp_parse_args( $meta_value, $defaults );

		$defaults = array(
			'id'        => '',
			'width'     => '',
			'height'    => '',
			'thumbnail' => '',
		);

		$meta_value['media'] = wp_parse_args( $meta_value['media'], $defaults );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-background-box">
					<?php
					if ( true === $meta_field['background-color'] ) {
						?>
						<div class="realgymcore-color-box">
							<input type="text" id="<?php echo esc_attr( $meta_field['name'] ); ?>-background-color" name="<?php echo esc_attr( $meta_field['name'] ) . '[background-color]'; ?>" value="<?php echo esc_attr( $meta_value['background-color'] ); ?>" size="50%" class="realgymcore-color-field"/>
							<label class="realgymcore-transparency-check" for="<?php echo esc_attr( $meta_field['id'] ); ?>-transparency">
								<input type="checkbox" value="1" id="<?php echo esc_attr( $meta_field['id'] ); ?>-transparency" class="realgymcore-checkbox realgymcore-color-transparency"<?php echo 'transparent' === $meta_value['background-color'] ? ' checked="checked"' : ''; ?>>
								<?php esc_html_e( 'Transparent', 'realgymcore' ); ?>
							</label>
						</div>
						<?php
					}
					?>

					<?php if ( true === $meta_field['background-image'] ) : ?>
						<div class="background-select-wrapper">
							<?php if ( true === $meta_field['background-repeat'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-repeat]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-repeat" data-css-name="background-repeat">
											<?php foreach ( realgymcore_get_background_repeat_options() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-repeat'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( true === $meta_field['background-size'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-size]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-size" data-css-name="background-size">
											<?php foreach ( realgymcore_get_background_size_options() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-size'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( true === $meta_field['background-attachment'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-attachment]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-attachment" data-css-name="background-attachment">
											<?php foreach ( realgymcore_get_background_attachments() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-attachment'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( true === $meta_field['background-position'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-position]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-position" data-css-name="background-position">
											<?php foreach ( realgymcore_get_background_position_options() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-position'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( true === $meta_field['background-origin'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-origin]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-origin" data-css-name="background-origin">
											<?php foreach ( realgymcore_get_background_origin_options() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-origin'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( true === $meta_field['background-clip'] ) : ?>
								<div class="background-item">
									<div class="realgymcore-select-box">
										<select name="<?php echo esc_attr( $meta_field['name'] ) . '[background-clip]'; ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>-background-clip" data-css-name="background-clip">
											<?php foreach ( realgymcore_get_background_clip_options() as $key => $option ) : ?>
												<option value="<?php echo esc_attr( $key ); ?>"<?php echo $meta_value['background-clip'] === $key ? ' selected="selected"' : ''; ?>>
													<?php echo esc_html( $option ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="background-image-wrapper">
							<input type="text" class="realgymcore-admin-input realgymcore-admin-background-image-input" id="<?php echo esc_attr( $meta_field['name'] ); ?>[background-image]" name="<?php echo esc_attr( $meta_field['name'] ) . '[background-image]'; ?>" value="<?php echo esc_attr( $meta_value['background-image'] ); ?>" placeholder="<?php echo esc_html__( 'No Media Selected', 'realgymcore' ); ?>">
							<input type="hidden" class="background-media-id" name="<?php echo esc_attr( $meta_field['name'] ) . '[media][id]'; ?>" value="<?php echo esc_attr( $meta_value['media']['id'] ); ?>">
							<div class="background-image-wrapper__actions">
								<button id="page-title-bg-media" class="button realgymcore-image-upload-button" data-type="background">
									<?php echo esc_html__( 'Upload', 'realgymcore' ); ?>
								</button>
								<?php
								$hide_remove = '';
								if ( empty( $meta_value['background-image'] ) ) {
									$hide_remove = 'hide';
								}
								?>
								<button id="reset-page-title-bg-media" class="button realgymcore-button-reset realgymcore-image-remove-button <?php echo esc_attr( $hide_remove ); ?>" data-type="background">
									<?php echo esc_html__( 'Remove', 'realgymcore' ); ?>
								</button>
							</div>
						</div>

						<?php
						if ( $meta_field['preview'] ) :
							$css          = realgymcore_generate_background_media_inline_css( $meta_value );
							$is_bg_exists = strpos( $css, 'background-image' );

							if ( empty( $css ) || ! $is_bg_exists ) {
								$css = 'display:none;';
							}
							?>
							<div class="realgymcore-background-preview" style="<?php echo esc_attr( $css ); ?>"></div>
						<?php endif; ?>
					<?php endif; ?>

					<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
				</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_media_meta_field' ) ) :
	/**
	 * RealgymCore Media Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_media_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'url' => '',
		);

		$meta_field = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		$defaults = array(
			'id'        => '',
			'width'     => '',
			'height'    => '',
			'thumbnail' => '',
		);

		$meta_value = wp_parse_args( $meta_value, $defaults );

		$required = realgymcore_get_required_attr( $meta_field['required'] );

		$image = '';
		if ( ! empty( $meta_value['id'] ) ) {
			$image = wp_get_attachment_image_url( $meta_value['id'] );
		}

		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-media-box">
						<div class="media-image-wrapper">
							<?php if ( $meta_field['url'] ) : ?>
								<input type="text" readonly class="realgymcore-admin-input realgymcore-admin-media-input" id="<?php echo esc_attr( $meta_field['name'] ); ?>[thumbnail]" name="<?php echo esc_attr( $meta_field['name'] ) . '[thumbnail]'; ?>" value="<?php echo esc_attr( $meta_value['thumbnail'] ); ?>" placeholder="<?php echo esc_html__( 'No Media Selected', 'realgymcore' ); ?>">
							<?php endif; ?>
							<input type="hidden" class="background-media-id" name="<?php echo esc_attr( $meta_field['name'] ) . '[id]'; ?>" value="<?php echo esc_attr( $meta_value['id'] ); ?>">

							<?php
							$hide_preview = '';
							if ( empty( $image ) ) {
								$hide_preview = 'hide';
							}
							?>
							<div class="realgymcore-media-preview <?php echo esc_attr( $hide_preview ); ?>">
								<a href="<?php echo esc_url( $meta_value['thumbnail'] ); ?>" target="_blank">
									<img class="realgymcore-preview-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html__( 'Media Preview', 'realgymcore' ); ?>" />
								</a>
							</div>

							<div class="media-image-wrapper__actions">
								<button id="page-title-bg-media" class="button realgymcore-image-upload-button" data-type="media">
									<?php echo esc_html__( 'Upload', 'realgymcore' ); ?>
								</button>
								<?php
								$hide_remove = '';
								if ( empty( $meta_value['id'] ) ) {
									$hide_remove = 'hide';
								}
								?>
								<button id="reset-page-title-bg-media" class="button realgymcore-button-reset realgymcore-image-remove-button <?php echo esc_attr( $hide_remove ); ?>" data-type="media">
									<?php echo esc_html__( 'Remove', 'realgymcore' ); ?>
								</button>
							</div>
						</div>

					<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
				</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_text_meta_field' ) ) :
	/**
	 * RealgymCore Text Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_text_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$default = array(
			'type' => 'text',
		);

		$meta_field['attributes'] = wp_parse_args( $meta_field['attributes'], $default );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-text-box">
					<input class="regular-text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" type="<?php echo esc_attr( $meta_field['attributes']['type'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_textarea_meta_field' ) ) :
	/**
	 * RealgymCore Text Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_textarea_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'rows' => 6,
		);

		$meta_field = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-text-box">
					<textarea class="large-text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>" placeholder="<?php echo esc_attr( $meta_field['placeholder'] ); ?>" rows="<?php echo esc_attr( $meta_field['rows'] ); ?>"
					><?php echo esc_html( $meta_value ); ?></textarea>
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_number_meta_field' ) ) :
	/**
	 * RealgymCore Number Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_number_meta_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'min'  => '',
			'max'  => '',
			'step' => 1,
		);
		$meta_field            = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-text-box">
					<input class="regular-text" type="number" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" min="<?php echo esc_attr( $meta_field['min'] ); ?>" max="<?php echo esc_attr( $meta_field['max'] ); ?>" step="<?php echo esc_attr( $meta_field['step'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_date_meta_field' ) ) :
	/**
	 * RealgymCore Date Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_date_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-date-box">
					<input class="regular-text realgymcore-date-input" type="text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_time_meta_field' ) ) :
	/**
	 * RealgymCore Time Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_time_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-time-box">
					<input class="regular-text realgymcore-time-input" type="text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>" id="<?php echo esc_attr( $meta_field['id'] ); ?>" name="<?php echo esc_attr( $meta_field['name'] ); ?>" value="<?php echo esc_attr( $meta_value ); ?>">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_time_range_meta_field' ) ) :
	/**
	 * RealgymCore Time Range Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_time_range_meta_field( $meta_field, $meta_value ) {
		$meta_field = wp_parse_args( $meta_field, realgymcore_get_default_attributes() );

		$start_time = '';
		$end_time   = '';
		if ( is_array( $meta_value ) ) {
			$start_time = $meta_value['start_time'] ?? '';
			$end_time   = $meta_value['end_time'] ?? '';
		}

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-time-box">
					<input class="regular-text realgymcore-time-input" type="text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>[start_time]" id="<?php echo esc_attr( $meta_field['id'] ); ?>_start_time" name="<?php echo esc_attr( $meta_field['name'] ); ?>[start_time]" value="<?php echo esc_attr( $start_time ); ?>">
					<input class="regular-text realgymcore-time-input" type="text" data-name="<?php echo esc_attr( $meta_field['id'] ); ?>[end_time]" id="<?php echo esc_attr( $meta_field['id'] ); ?>_end_time" name="<?php echo esc_attr( $meta_field['name'] ); ?>[end_time]" value="<?php echo esc_attr( $end_time ); ?>">
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;

if ( ! function_exists( 'realgymcore_repeater_field' ) ) :
	/**
	 * RealgymCore Repeater Meta Field
	 *
	 * @param array $meta_field Meta Field.
	 * @param mixed $meta_value Meta Value.
	 * @return void
	 */
	function realgymcore_repeater_field( $meta_field, $meta_value ) {
		$additional_attributes = array(
			'fields'     => array(),
			'item_name'  => '',
			'full_width' => false,
		);
		$meta_field            = wp_parse_args( $meta_field, array_merge( realgymcore_get_default_attributes(), $additional_attributes ) );

		if ( ! is_array( $meta_value ) ) {
			$meta_value = array();
		}

		$required = realgymcore_get_required_attr( $meta_field['required'] );
		?>
		<fieldset class="realgymcore-field-container <?php echo esc_attr( $meta_field['full_width'] ? 'realgymcore-full-width' : '' ); ?>" <?php echo esc_attr( $required ); ?>>
			<?php
			if ( ! $meta_field['hide_title'] ) {
				realgymcore_render_meta_field_title( $meta_field['title'] );
			}
			?>
			<div class="realgymcore-field-container__inner">
				<div class="realgymcore-box-option realgymcore-repeater-box">
					<div class="realgymcore-repeater-inner">
						<?php
						if ( is_array( $meta_value ) && count( $meta_value ) > 0 ) :
							foreach ( $meta_value as $meta_field_value ) {
								?>
								<div class="realgymcore-repeater-items" data-group="<?php echo esc_attr( $meta_field['name'] ) . '[' . esc_attr( REALGYMCORE_REPEATER_DATA ) . ']'; ?>">
									<?php
									foreach ( $meta_field['fields'] as $field ) {
										$field['name'] = $meta_field['name'];

										$value = '';
										if ( isset( $meta_field_value[ $field['id'] ] ) ) {
											$value = $meta_field_value[ $field['id'] ];
										}

										realgymcore_render_field( $field, $value );
									}
									?>
									<div class="realgymcore-remove-item-wrapper">
										<button class="realgymcore-remove-btn"><i class="el el-remove-sign"></i></button>
									</div>
								</div>
								<?php } ?>
						<?php else : ?>
							<div class="realgymcore-repeater-items" data-empty="true" data-group="<?php echo esc_attr( $meta_field['name'] ) . '[' . esc_attr( REALGYMCORE_REPEATER_DATA ) . ']'; ?>">
								<?php
								foreach ( $meta_field['fields'] as $field ) {
									$field['name'] = $meta_field['name'];
									$default       = isset( $field['default'] ) ? $field['default'] : '';

									realgymcore_render_field( $field, $default );
								}
								?>
								<div class="realgymcore-remove-item-wrapper"><button class="realgymcore-remove-btn"><i class="el el-remove-sign"></i></button></div>
							</div><?php endif; ?>
					</div>
					<div class="repeater-heading">
						<button class="button button-primary button-large repeater-add-btn"><?php echo esc_html__( 'Add Row', 'realgymcore' ); ?></button>
					</div>
				</div>
				<?php realgymcore_render_meta_field_description( $meta_field['id'], $meta_field['desc'] ); ?>
			</div>
		</fieldset>
		<?php
	}
endif;
