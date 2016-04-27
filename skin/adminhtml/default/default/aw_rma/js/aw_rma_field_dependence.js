var awRMAFieldDependence = Class.create({
    initialize:function (config) {
        this.mainFiled = $(config.mainFieldId);
        this.dependenceField = $(config.dependenceFieldId);
        if (this.mainFiled && this.dependenceField) {
            this.dependenceField = this.dependenceField.up().up();
            this.config = {};
            this.config.available = config.available;
            this.init();
        }
    },

    init:function () {
        this.process();
        Event.observe(this.mainFiled, 'change', this.process.bind(this));
    },

    process:function() {
        console.log(this.mainFiled.value);
        if (this.config.available.indexOf(parseInt(this.mainFiled.value))) {
            this.dependenceField.hide();
            this.dependenceField.removeClassName('required-entry');
            this.dependenceField.removeClassName('validate-digit');
        } else {
            this.dependenceField.show();
            this.dependenceField.addClassName('required-entry');
            this.dependenceField.addClassName('validate-digit');
        }
    }
});