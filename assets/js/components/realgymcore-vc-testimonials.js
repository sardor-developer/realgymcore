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
	$(
		function () {
			// Swiper
			if (document.querySelector(".realgymcore-testimonials-slider")) {
				let zrcore_testimonials_1 = new Swiper(".realgymcore-testimonials-slider .swiper", {
					slidesPerView: 1,
					fadeEffect: {crossFade: true},
					virtualTranslate: true,
					allowTouchMove: false,
					autoplay: {
						delay: 3500,
						disableOnInteraction: true,
					},
					speed: 1000,
					slidersPerView: 1,
					effect: "fade",
					pagination: {
						el: ".swiper-pagination",
						clickable: true
					},
				});
			}

			if (document.querySelector(".realgymcore-testimonials-slider-2")) {
				let zrcore_testimonials_2 = new Swiper(".realgymcore-testimonials-slider-2 .swiper", {
					slidesPerView: 1,
					fadeEffect: {crossFade: true},
					virtualTranslate: true,
					allowTouchMove: false,
					autoplay: {
						delay: 25000,
						disableOnInteraction: true,
					},
					speed: 1000,
					slidersPerView: 1,
					effect: "fade",
					navigation: {
						nextEl: ".slider-next",
						prevEl: ".slider-prev",
					},
					on: {
						init: function (ev) {
							// initalize
						},
						slideChange: function (ev) {
							// do stuff
						}
					}
				});
			}
		}
	);
})(jQuery);
