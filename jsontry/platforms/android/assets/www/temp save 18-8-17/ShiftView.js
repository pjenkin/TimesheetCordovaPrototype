var ShiftView = function(shift) {

    this.initialize = function() {
        this.$el = $('<div/>');
    };

    this.render = function() {
        this.$el.html(this.template(shift));
        return this;
    };

    this.initialize();

}
