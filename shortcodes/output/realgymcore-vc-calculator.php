<?php
/**
 * RealGym Shortcode output
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

$result = shortcode_atts(
	array(
		'unique_class'  => '',
		'element_class' => '',
		'element_id'    => '',
		'css'           => '',
	),
	$atts
);
extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

$vc_class = realgymcore_shortcode_custom_css_class( $css, ' ' );

$classes    = array(
	$element_class,
	$unique_class,
	$vc_class,
);
$fill_color = 'var(--realgym-primary-color)';
realgymcore_vc_enqueue_scripts_styles( 'realgymcore-vc-calculator' );
wp_localize_script(
	'realgymcore-vc-calculator',
	'realgymcore_calculator_obj',
	array(
		'cm'              => esc_html__( 'cm', 'realgymcore' ),
		'kg'              => esc_html__( 'kg', 'realgymcore' ),
		'kgs'             => esc_html__( 'kgs', 'realgymcore' ),
		'ft.'             => esc_html__( 'ft.', 'realgymcore' ),
		'lbs'             => esc_html__( 'lbs', 'realgymcore' ),
		'Underweight'     => esc_html__( 'Underweight', 'realgymcore' ),
		'Healthy'         => esc_html__( 'Healthy', 'realgymcore' ),
		'Overweight'      => esc_html__( 'Overweight', 'realgymcore' ),
		'Obese'           => esc_html__( 'Obese', 'realgymcore' ),
		'Extremely obese' => esc_html__( 'Extremely obese', 'realgymcore' ),
	)
);

?>
<div <?php echo ( ! empty( $element_id ) ) ? 'id="' . esc_attr( $element_id ) . '"' : ''; ?>
		class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="section">
		<div class="realgymcore-bmi">
			<div class="bmi-header">
				<ul class="realgymcore-units-list">
					<li class="realgymcore-units active" data-color="<?php echo esc_attr( $fill_color ); ?>" data-value="metric"><?php echo esc_html__( 'Metric Units', 'realgymcore' ); ?></li>
					<li class="realgymcore-units" data-color="<?php echo esc_attr( $fill_color ); ?>" data-value="us"><?php echo esc_html__( 'US Units', 'realgymcore' ); ?></li>
					<li><span class="realgymcore-nav-indicator"></span></li>
				</ul>
				<div class="row">
					<div class="col-lg-7">
						<div class="fluid">
							<form action="#">
								<div class="row position-relative">
									<div class="col-md-4">
										<label class="realgymcore-metric">
											<span class="realgym-heading-4"><?php echo esc_html__( 'Age (years)', 'realgymcore' ); ?></span>
											<input type="number" min="2" max="100" value="25" id="realgymcore-metric-age-input"
												placeholder="<?php echo esc_attr__( 'Ages: 2-100', 'realgymcore' ); ?>" class="realgym-text-2">
										</label>
									</div>
									<div class="col-md-4">
										<label class="realgymcore-metric">
											<span class="realgym-heading-4"><?php echo esc_html__( 'Height', 'realgymcore' ); ?> (<span class="realgymcore-metric-height"><?php echo esc_html__( 'cm', 'realgymcore' ); ?></span>)</span>
											<input type="number" min="1" value="180" max="500" placeholder="cm" id="realgymcore-metric-height-input"
												class="realgym-text-2">
										</label>
									</div>
									<div class="col-md-4">
										<label class="realgymcore-metric">
											<span class="realgym-heading-4"><?php echo esc_html__( 'Weight', 'realgymcore' ); ?> (<span class="realgymcore-metric-weight"><?php echo esc_html__( 'kg', 'realgymcore' ); ?></span>)</span>
											<input type="number" value="70" min="1" max="500" placeholder="<?php echo esc_html__( 'kg', 'realgymcore' ); ?>" id="realgymcore-metric-weight-input"
												class="realgym-text-2 ">
										</label>
									</div>
									<div class="realgymcore-metric-error error"><?php echo esc_html__( 'Please enter a valid information', 'realgymcore' ); ?></div>
								</div>
								<div class="realgymcore-gender d-flex">
									<h4 class="realgym-heading-4"><?php echo esc_html__( 'Gender', 'realgymcore' ); ?></h4>
									<label class="d-flex align-items-center">
										<input type="radio" name="gender" value="male" checked>
										<span><?php echo esc_html__( 'Male', 'realgymcore' ); ?></span>
									</label>
									<label class="d-flex align-items-center">
										<input type="radio" name="gender" value="female">
										<span><?php echo esc_html__( 'Female', 'realgymcore' ); ?></span>
									</label>
								</div>
								<div class="bmi-btn-wrapper">
									<button type="submit" id="realgymcore-calc-btn" class="realgym-text-2 realgymcore-bmi-btn realgym-button"><span><?php echo esc_html__( 'Calculate', 'realgymcore' ); ?></span></button>
									<input type="reset" value="<?php echo esc_html__( 'Clear', 'realgymcore' ); ?>" class="realgym-text-2 realgymcore-bmi-btn reset-wrapper">
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-5 d-flex align-items-end justify-content-center position-relative">
						<div class="fluid">
							<div class="realgymcore-stats">
								<div class="realgymcore-stats-progress">
									<svg class="progress-ring progress-indicator healthy">
										<circle r="0" class="progress-ring-circle" stroke-width="26" fill="transparent"></circle>
									</svg>
									<svg class="progress-ring">
										<circle r="0" class="progress-ring-circle" stroke-width="26" fill="transparent"></circle>
									</svg>
									<div class="realgymcore-stats-content">
										<h3 class="text-center realgym-display-3"><?php echo esc_html__( 'BMI', 'realgymcore' ); ?> = <span><span class="realgymcore-bmi-result">21.6</span> <span class="realgymcore-bmi-result-unit">
														<?php echo esc_html__( 'kg/m', 'realgymcore' ); ?></span></span></h3>
										<p class="realgym-heading-4 text-center realgymcore-bmi-status"><?php echo esc_html__( 'Healthy', 'realgymcore' ); ?></p>
									</div>
								</div>

								<div class="realgymcore-content">
									<ul class="realgym-text-2">
										<li><?php echo esc_html__( 'Healthy BMI range:', 'realgymcore' ); ?> <span class="realgymcore-bmi-range"><?php echo esc_html__( '18.5 kg/m2 - 25 kg/m2', 'realgymcore' ); ?></span></li>
										<li><?php echo esc_html__( 'Healthy weight for the height:', 'realgymcore' ); ?> <span class="realgymcore-weight-range"><?php echo esc_html__( '63.2 kgs - 85.5 kgs', 'realgymcore' ); ?></span></li>
										<li><?php echo esc_html__( 'Ponderal Index:', 'realgymcore' ); ?> <span class="PI"><?php echo esc_html__( '12.1', 'realgymcore' ); ?></span> <?php echo esc_html__( 'kg/m3', 'realgymcore' ); ?></li>
									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
