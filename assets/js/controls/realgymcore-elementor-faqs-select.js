'use strict';

let realgymcore_faqs_select_control = elementor.modules.controls.BaseData.extend({
    onReady: function() {
        var self = this;
        this.control_select = this.$el.find('.realgymcore-faqs-select-field');

        this.initilize();

        this.control_select.select2({
            multiple: true,
            minimumInputLength: 2,
            defaultResults: [{id: 1, text: " test1"}, {id: 2, text: " test2"}],
            ajax: {
                url: realgymcore_elementor_faqs_select.ajax_url,
                dataType: 'json',
                data: function (params) {
                    return {
                        action: 'realgymcore_ajax_faqs_request',
                        nonce: realgymcore_elementor_faqs_select.nonce,
                        term: params['term'],
                    }
                },
                processResults: function(response){
                    var data = response.data;

                    var results = data.faqs ? self.processResults(data.faqs) : [];

                    return { results }
                }
            }
        });

        this.control_select.on('change', () => {
            this.saveValue();
        } )
    },


    initilize: function() {
        var initialValue = this.getControlValue();
        var self = this;

        if(initialValue && initialValue.length > 0) {
            var request = {
                'action': 'realgymcore_ajax_faqs_request',
                'ids': initialValue ? initialValue.join(',') : '',
                'nonce': realgymcore_elementor_faqs_select.nonce,
            };

            jQuery.ajax(
                {
                    method: "post",
                    url: realgymcore_elementor_faqs_select.ajax_url,
                    data: request,
                }
            ).success(
                function (response) {
                    var data = response.data;
                    var results = data.faqs ? self.processResults(data.faqs) : [];

                    if(results.length > 0) {
                        results.forEach(function(item) {
                            var option = new Option(item.text, item.id, true, true);
                            self.control_select.append(option);
                        })
                        self.control_select.trigger('change');
                    }
                }
            )
        }
    },

    processResults: function(items) {
        var results = [];

        if(items) {
            items.forEach(function (item) {
                results.push({
                    id: item.ID,
                    text: item.post_title
                })
            })
        }

        return results;
    },

    isEmpty: function (value) {
        return (value == null || value.length === 0);
    },

    saveValue: function() {
        this.setValue(this.control_select.val());
    },
    onBeforeDestroy: function() {
    },
})

elementor.addControlView('realgymcore-faqs-select', realgymcore_faqs_select_control);