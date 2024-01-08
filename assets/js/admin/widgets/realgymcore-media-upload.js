/**
 * Contact Us Widget javscript.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

jQuery( document ).ready(
	function ($) {
		"use strict";
		$( document ).on(
			"click",
			".realgymcore_upload_image_button",
			function (e) {
				e.preventDefault();
				let $realgymcore_button = $( this );

				let realgymcore_file_frame = wp.media.frames.file_frame = wp.media(
					{
						title: 'Select or upload image',
						library: {
							type: 'image'
						},
						button: {
							text: 'Select'
						},
						multiple: false
					}
				);

				realgymcore_file_frame.on(
					'select',
					function () {

						var attachment = realgymcore_file_frame.state().get( 'selection' ).first().toJSON();

						$realgymcore_button.siblings( 'input' ).val( attachment.url );

					}
				);

				realgymcore_file_frame.open();
			}
		);
	}
);
