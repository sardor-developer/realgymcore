/**
 * VC javascript file.
 *
 * RealgymCore plugin javascript file.
 *
 * @package RealgymCore
 * @author Balcomsoft
 * @since  1.0.0
 */

(function ($) {
	'use strict';
	// Anything here can only immediately reference the DOM above it.
	// Values
	const roundingValue = 1;
	const heightUnitDiff = 0.3048;
	const weightUnitDiff = 2.2;
	let activeUnit = 'metric';
	let calcBtn = document.querySelector('#realgymcore-calc-btn');

// Input labels
	let heightLabel = document.querySelector('#realgymcore-metric-height-input');
	let weightLabel = document.querySelector('#realgymcore-metric-weight-input');
	let ageLabel = document.querySelector('#realgymcore-metric-age-input')
// Bmi Indicator and labels
	let progressIndicator = document.querySelector('.progress-ring:first-child');
	let bmiLabel = document.querySelector('.realgymcore-bmi-result');
	let bmiStatusLabel = document.querySelector('.realgymcore-bmi-status');
// Bmi bottom labels
	let bmiRangeLabel = document.querySelector('.realgymcore-bmi-range');
	let weightRangeLabel = document.querySelector('.realgymcore-weight-range');
	let metricErrorLabel = document.querySelector('.realgymcore-metric-error');
	let piLabel = document.querySelector('.PI');

	if(calcBtn) {
		calcBtn.addEventListener('click', function (ev) {
			ev.preventDefault();
	
			// Metrics
			let height = heightLabel.value;
			let weight = weightLabel.value;
			let age = ageLabel.value;
	
			// BMI, Ponderal index values
			let bmi, pi;
	
			// Metric display
			let weightDisplay, heightDisplay;
			// Base conditions
			if (activeUnit !== 'metric') {
				heightDisplay = (height * heightUnitDiff).toFixed();
				weightDisplay = (weight / weightUnitDiff).toFixed();
				bmi = calculateBmi(heightDisplay, weightDisplay);
				pi = calculatePI(heightDisplay, weightDisplay)
			} else {
				bmi = calculateBmi(height, weight);
				pi = calculatePI(height, weight)
			}
			if (validateValues(ageLabel.value, heightLabel.value, weightLabel.value)) {
				if (metricErrorLabel.classList.contains('active')) {
					metricErrorLabel.classList.remove('active');
				}
				displayResults(bmi, pi, age, activeUnit);
			} else {
				metricErrorLabel.classList.add('active');
			}
	
			function validateValues(age, height, weight) {
				if (+weight === 0 || +height === 0 || age > 100) return false;
				const ageRegExp = /^(\d+)$/;
				const WHRegExp = /^(\d+)$/;
				return !!(ageRegExp.test(age) && WHRegExp.test(height) && WHRegExp.test(weight));
			}
	
			function calculateBmi(height, weight) {
				let bmi = +weight / (Math.pow(+height / 100, 2));
				bmi = bmi.toFixed(roundingValue);
				return bmi;
			}
	
			function calculatePI(height, weight) {
				let pi = +weight / (Math.pow(+height / 100, 3)).toFixed(roundingValue);
				pi = pi.toFixed(roundingValue);
				return pi;
			}
	
			function calculateWeightRange(height, activeUnit) {
				let min, max;
				if (activeUnit !== 'metric') {
					height = (height * heightUnitDiff).toFixed(roundingValue);
				}
				min = (height * 0.351).toFixed(roundingValue);
				max = (height * 0.475).toFixed(roundingValue);
				return `${min} kgs - ${max} kgs`;
			}
	
			function displayResults(bmi, pi, age, activeUnit) {
				bmiRangeLabel.innerHTML = '18.5 kg/m2 - 25 kg/m2';
				bmiLabel.innerHTML = bmi;
				piLabel.innerHTML = pi;
				weightRangeLabel.innerHTML = calculateWeightRange(height, activeUnit);
				if (activeUnit !== 'metric') {
					weightRangeLabel.innerHTML = calculateWeightRange(height);
					weightRangeLabel.innerHTML.replace(/(\d+.\d)\skgs\s-\s(\d+.\d)\skgs/g, function (values, min, max) {
						let minDif = (min * weightUnitDiff).toFixed(roundingValue);
						let maxDif = (max * weightUnitDiff).toFixed(roundingValue);
						weightRangeLabel.innerHTML = `${minDif} lbs - ${maxDif} lbs`;
					})
				}
	
				progressIndicator.classList = 'progress-ring';
				if (age > 20) {
					if (bmi < 18.5) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Underweight'];
						progressIndicator.classList.add('underweight');
					} else if (18.5 <= bmi && bmi <= 24.9) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Healthy'];
						progressIndicator.classList.add('healthy');
					} else if (25 <= bmi && bmi <= 29.9) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Overweight'];
						progressIndicator.classList.add('overweight');
					} else if (30 <= bmi && bmi <= 34.9) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Obese'];
						progressIndicator.classList.add('obese');
					} else {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Extremely obese'];
						progressIndicator.classList.add('ex-obese');
					}
				} else {
					bmiRangeLabel.innerHTML = '16 kg/m2 - 22.6 kg/m2';
					if (bmi < 16) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Underweight'];
						progressIndicator.classList.add('underweight');
					} else if (16 <= bmi && bmi <= 22.6) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Healthy'];
						progressIndicator.classList.add('healthy');
					} else if (22.7 <= bmi && bmi <= 27.7) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Overweight'];
						progressIndicator.classList.add('overweight');
					} else if (27.8 <= bmi && bmi <= 32.8) {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Obese'];
						progressIndicator.classList.add('obese');
					} else {
						bmiStatusLabel.innerHTML = realgymcore_calculator_obj['Extremely obese'];
						progressIndicator.classList.add('ex-obese');
					}
				}
			}
	
		});
	}

// Anim Indicator
	function indicatorInit(navWrapper, indicatorName, navItems) {
		const nav = document.querySelector(navWrapper);
		const indicator = document.querySelector(indicatorName);
		const items = document.querySelectorAll(navItems);

		function indicatorHandler(el) {
			/* Remove active status from all navigation link */
			items.forEach(item => {
				item.classList.remove('active');
				item.removeAttribute('style');
			});
			if (nav.classList.contains('realgymcore-units-list')) {
				indicator.style.width = `${el.offsetWidth}px`;
				indicator.style.left = `${el.offsetLeft}px`;
				/* Changes color of indicator by attribute data-color */
				indicator.style.backgroundColor = el.getAttribute('data-color');
			}
			el.classList.add('active');
		}

		function convertUnits(value, heightLabel, weightLabel) {
			if (value !== activeUnit) {
				if (value !== 'metric') {
					heightLabel.value = (heightLabel.value / heightUnitDiff).toFixed();
					weightLabel.value = (weightLabel.value * weightUnitDiff).toFixed();
					weightRangeLabel.innerHTML.replace(/(\d+.\d)\skgs\s-\s(\d+.\d)\skgs/g, function (values, min, max) {
						let minDif = (min * weightUnitDiff).toFixed(roundingValue);
						let maxDif = (max * weightUnitDiff).toFixed(roundingValue);
						weightRangeLabel.innerHTML = `${minDif} ${realgymcore_calculator_obj['lbs']} - ${maxDif} ${realgymcore_calculator_obj['lbs']}`;
					})
				} else {
					heightLabel.value = (heightLabel.value * heightUnitDiff).toFixed();
					weightLabel.value = (weightLabel.value / weightUnitDiff).toFixed();
					weightRangeLabel.innerHTML.replace(/(\d+.\d)\slbs\s-\s(\d+.\d)\slbs/g, function (values, min, max) {
						let minDif = (min / weightUnitDiff).toFixed(roundingValue);
						let maxDif = (max / weightUnitDiff).toFixed(roundingValue);
						weightRangeLabel.innerHTML = `${minDif} ${realgymcore_calculator_obj['kgs']} - ${maxDif} ${realgymcore_calculator_obj['kgs']}`;
					})

				}
				if (+heightLabel.value === 0) heightLabel.value = "";
				if (+weightLabel.value === 0) weightLabel.value = "";

				displayUnit(value, heightLabel, weightLabel);
			}
		}

		function displayUnit(type, heightLabel, weightLabel) {
			const heightUnitLabel = document.querySelector('.realgymcore-metric-height');
			const weightUnitLabel = document.querySelector('.realgymcore-metric-weight');
			if (type === 'metric') {
				heightUnitLabel.innerHTML = realgymcore_calculator_obj['cm'];
				weightUnitLabel.innerHTML = realgymcore_calculator_obj['kg'];

				heightLabel.placeholder = realgymcore_calculator_obj['cm'];
				weightLabel.placeholder = realgymcore_calculator_obj['kg'];
			} else {
				heightUnitLabel.innerHTML = realgymcore_calculator_obj['ft.'];
				weightUnitLabel.innerHTML = realgymcore_calculator_obj['lbs'];

				heightLabel.placeholder = realgymcore_calculator_obj['ft.'];
				weightLabel.placeholder = realgymcore_calculator_obj['lbs'];
			}

		}

		items.forEach((item, index) => {
			if(item) {
				item.addEventListener('click', (e) => {
					e.preventDefault();
					indicatorHandler(e.target);
					convertUnits(e.target.getAttribute('data-value'), heightLabel, weightLabel);
					activeUnit = e.target.getAttribute('data-value');
				});
				item.classList.contains('active') && indicatorHandler(item);
			}
		});
	}

	indicatorInit('.realgymcore-units-list', '.realgymcore-nav-indicator', '.realgymcore-units')
})(jQuery);
