/**
 * RealgymCore Metaboxes Javascript.
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

jQuery(document).ready(
    function ($) {
        "use strict";

        function style_background_box_preview($el, $css, $val) {
            var $preview = $el.closest('.realgymcore-background-box').find('.realgymcore-background-preview');
            if($preview.length > 0) {
                $preview.css($css, $val).show();
            }
        }

        // MetaBox Tabs
        $(".realgymcore-meta [data-tab-id]").on("click", function (e) {
            e.preventDefault();
            let id = $(this).attr("data-tab-id");

            $(".realgymcore-meta [data-tab-group='" + $(this).attr("data-tab-group") + "']").removeClass("active");

            $(this).addClass("active");
            $(".realgymcore-meta [data-tab-content='" + id + "']").addClass("active");
        })

        // Required Fields
        $( '.realgymcore-field-container[data-required]' ).each( function () {
            var $el = $( this ),
                id = $el.attr( 'data-required' ),
                value = $el.attr( 'data-value' ),
                $target = $('.realgymcore-field-container [name="' + id + '"]' ),
                $type = $target.attr( 'data-type' );

            if ( $type === 'switch' ) {
                // If Target Field is Switch
                $target.on( 'change', function () {
                    if ( $target.val() === value ) {
                        $el.show();
                    } else {
                        $el.hide();
                    }
                } );
                $target.trigger('change');
            } else if( $type === 'select' ) {
                $target.on( 'change', function () {
                    if ( $.inArray( $target.val(), value.split( ',' ) ) !== -1 ) {
                        $el.show();
                    } else {
                        $el.hide();
                    }
                } );
                $target.trigger('change');
            }
        })

        // Color Box
        $(document).on('plugin_init', '.realgymcore-color-box', function () {
            var $el = $(this),
                $cf = $el.find('.realgymcore-color-field'),
                $ct = $el.find('.realgymcore-color-transparency');

            $cf.wpColorPicker({
                change: function (e, ui) {
                    $(this).val(ui.color.toString());
                    style_background_box_preview($el, 'background-color', ui.color.toString());
                    $ct.prop('checked', false);
                },
                clear: function (e, ui) {
                    style_background_box_preview($el, 'background-color', '');
                    $ct.prop('checked', false);
                }
            });
            $ct.on('click', function () {
                if ($(this).is(":checked")) {
                    $cf.attr('data-old-color', $cf.val());
                    $cf.val('transparent');
                    $el.find('.wp-color-result').css('background-color', 'transparent');
                    style_background_box_preview($el, 'background-color', 'transparent');
                } else {
                    if ($cf.val() === 'transparent') {
                        var oc = $cf.attr('data-old-color');
                        $el.find('.wp-color-result').css('background-color', oc);
                        $cf.val(oc);
                        style_background_box_preview($el, 'background-color', oc);
                    }
                }
            });
        })

        $('.realgymcore-color-box').each(function () {
            $(this).trigger('plugin_init');
        });

        // Select2
        if (window.Select2) {
            $('.realgymcore-select-box > select').each(function() {
                if($(this).closest('.realgymcore-repeater-box').length === 0) {
                    $(this).select2();
                }
            });
        }

        // Switch Box
        $('.realgymcore-switch-box').each(function () {
            var el = $(this);
            el.find('.cb-enable').on(
                'click',
                function () {
                    var parent;
                    var obj;
                    var $fold;

                    if ($(this).hasClass('selected')) {
                        return;
                    }

                    parent = $(this).parents('.realgymcore-switch-box');

                    $('.cb-disable', parent).removeClass('selected');
                    $(this).addClass('selected');
                    $('.checkbox-input', parent).val(1).trigger('change');

                    // Fold/unfold related options.
                    obj = $(this);
                    $fold = '.f_' + obj.data('id');

                    el.find($fold).slideDown('normal', 'swing');
                }
            );

            el.find('.cb-disable').on(
                'click',
                function () {
                    var parent;
                    var obj;
                    var $fold;

                    if ($(this).hasClass('selected')) {
                        return;
                    }

                    parent = $(this).parents('.realgymcore-switch-box');

                    $('.cb-enable', parent).removeClass('selected');
                    $(this).addClass('selected');
                    $('.checkbox-input', parent).val(0).trigger('change');

                    // Fold/unfold related options.
                    obj = $(this);
                    $fold = '.f_' + obj.data('id');

                    el.find($fold).slideUp('normal', 'swing');
                }
            );

            el.find('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
        });

        // Background Media Box
        var $ff;
        $( document )
            .off( 'click', '.realgymcore-image-upload-button' )
            .on( 'click', '.realgymcore-image-upload-button', function ( e ) {
                e.preventDefault();

                var $el = $(this);
                var $mediaType = $el.attr('data-type');

                if ( !$ff ) {
                    $ff = wp.media.frames.downloadable_file = wp.media( {
                        title: 'Choose an image',
                        button: {
                            text: 'Use image'
                        },
                        multiple: false
                    } );
                }

                $ff.open();

                $ff.on( 'select', function () {
                    var $attachment = $ff.state().get( 'selection' ).first().toJSON();

                    if($mediaType === 'background') {
                        $el.closest('.background-image-wrapper').find('.realgymcore-admin-background-image-input').val( $attachment.url );
                        $el.closest('.background-image-wrapper').find('input.background-media-id').val( $attachment.id );

                        style_background_box_preview($el, 'background-image', 'url('+$attachment.url+')');

                        $el.closest('.background-image-wrapper').find('.realgymcore-button-reset').removeClass('hide');
                    } else {
                        $el.closest('.media-image-wrapper').find('.realgymcore-admin-media-input').val( $attachment.url );
                        $el.closest('.media-image-wrapper').find('.realgymcore-media-preview > a').attr( 'href', $attachment.url );
                        $el.closest('.media-image-wrapper').find('input.background-media-id').val( $attachment.id );

                        var $image_url =  $attachment.url;
                        if($attachment.sizes && $attachment.sizes.thumbnail && $attachment.sizes.thumbnail.url) {
                            $image_url = $attachment.sizes.thumbnail.url;
                        }

                        $el.closest('.media-image-wrapper').find('.realgymcore-preview-image').attr( 'src', $image_url );
                        $el.closest('.media-image-wrapper').find('.realgymcore-button-reset').removeClass('hide');
                        $el.closest('.media-image-wrapper').find('.realgymcore-media-preview').removeClass('hide');
                    }

                    $ff.close();
                } );
            })
            .on( 'click', '.realgymcore-image-remove-button', function ( e ) {
                e.preventDefault();
                var $mediaType = $(this).attr('data-type');

                if($mediaType === 'background') {
                    $(this).closest('.background-image-wrapper').find('.realgymcore-admin-background-image-input').val('');
                    $(this).closest('.background-image-wrapper').find('input.background-media-id').val('');
                    $(this).addClass('hide');

                    style_background_box_preview($(this), 'background-image', '');
                } else {
                    $(this).closest('.media-image-wrapper').find('.realgymcore-admin-media-input').val('');
                    $(this).closest('.media-image-wrapper').find('input.background-media-id').val('');

                    $(this).closest('.media-image-wrapper').find('.realgymcore-media-preview > a').attr( 'href', '#' );
                    $(this).closest('.media-image-wrapper').find('.realgymcore-media-preview img').attr( 'src', '' );
                    $(this).closest('.media-image-wrapper').find('.realgymcore-media-preview').addClass('hide');

                    $(this).addClass('hide');
                }
                return false;
            })

            $('.realgymcore-background-box .realgymcore-select-box > select').on('change', function (e) {
                e.preventDefault();
                var $css = $(this).attr('data-css-name');
                style_background_box_preview($(this), $css, this.value);
            });

        // Date Picker
        $('.realgymcore-date-box > input.realgymcore-date-input').datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true
        });

        // Time Picker
        $('.realgymcore-time-box > input.realgymcore-time-input').mask('00:00', {placeholder: "__:__"});

        // Repeater Box
        $('.realgymcore-repeater-box > .realgymcore-repeater-inner').createRepeater({
            showFirstItemToDefault: false,
        }, function() {
            $('.realgymcore-select-box > select').each(function() {
                if ($(this).closest('.realgymcore-repeater-box').length > 0) {
                    $(this).select2();
                }
            })

            $('.realgymcore-time-box > input.realgymcore-time-input').mask('00:00', {placeholder: "__:__"});
        });

    }
);