var ShiftView = function(shift) {       // argument "shift" d provide data for the Handlebars {{}} expressions

    this.initialize = function() {
        this.$el = $('<div/>');
    };

    this.render = function() {
        this.$el.html(this.template(shift));
        return this;
    };

    this.initialize();

}
