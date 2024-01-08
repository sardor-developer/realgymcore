var tigonExplodedTextareaControl = elementor.modules.controls.BaseData.extend({
    onReady: function() {
        var self = this;
        this.control_select = this.$el.find('.tigon-exploded-textarea-field');

        this.control_select.on("change", function () {
            self.saveValue();
        })

        this.initilize()
    },

    initilize: function() {
        var initialValue = this.getControlValue();

        if(! this.isEmpty(initialValue) ) {
            initialValue = initialValue.replace(',', '\n');
        }

        this.control_select.val(initialValue)
    },

    isEmpty: function (value) {
        return (value == null || value.length === 0);
    },

    saveValue: function() {
        var value = this.control_select.val();

        if(! this.isEmpty(value) ) {
            value = value.replace(/\n/g,',');
        }

        this.setValue(value)
    },
    onBeforeDestroy: function() {
    },
})

elementor.addControlView('tigon-exploded-textarea', tigonExplodedTextareaControl);