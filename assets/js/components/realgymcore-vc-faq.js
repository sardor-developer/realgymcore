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
			$( ".realgym-faq-header" ).on(
				"click",
				function () {
					$( this ).toggleClass( "active" )
					$( this ).siblings( ".realgym-faq-body" ).slideToggle();
				}
			)
		}
	);
})( jQuery );
