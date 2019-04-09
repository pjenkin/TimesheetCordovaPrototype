var NewShiftView = function() {     // no argument needed as this is new shift, with no parameters pre-defined

    this.initialize = function() {
        this.$el = $('<div/>');
    };

    this.render = function() {
        this.$el.html(this.template());
        return this;
    };

    this.initialize();

}
