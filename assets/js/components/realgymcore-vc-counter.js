/**
 * VC javascript file.
 *
 * RealgymCore plugin javascript file.
 *
 * @package RealgymCore
 * @author Balcomsoft
 * @since  1.0.0
 */

(function($) {
	'use strict';
	$(
		function(){
			$.fn.isInViewport = function() {
				var elementTop = $(this).offset().top;
				var elementBottom = elementTop + $(this).outerHeight();
				var viewportTop = $(window).scrollTop();
				var viewportBottom = viewportTop + $(window).height();
				var result = elementBottom > viewportTop && elementTop < viewportBottom;
				return result;
			}

			$(window).on('resize scroll', function() {
				$('.realgym-counter:not(.shown)').each(function(){
					if ($(this).isInViewport()) {
						// animate only once
						$(this).addClass('shown');

						// do animation
						$(this).find('.count').each(function () {
							$(this).prop('Counter',0).animate({
								Counter: $(this).text()
							}, {
								duration: 4000,
								easing: 'swing',
								step: function (now) {
									$(this).text(Math.ceil(now));
								}
							});
						});
					}
				});
			});
		}
	);
})( jQuery );
