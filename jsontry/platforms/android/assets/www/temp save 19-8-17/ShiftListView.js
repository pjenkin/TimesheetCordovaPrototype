var ShiftListView = function (shifts) {
    // code for the list of shifts brought up (after querying for all of an operator's shifts, for example)
    // 1542 18/8/17 added 'shifts' as argument - 1544: shifts displaying in list - bingo! - thas ubm! - what a dumbass, going round in circles for about 2 hours

//    var shifts;       // 1542 18/8/17 REMmed var shifts 

    this.initialize = function() {
        this.$el = $('<div/>');
//alert("in ShiftListsView initialize()");        
        this.render();
    };

    this.setOperatorShifts = function(list) {
        shifts = list;
        this.render();
    }

    this.render = function() {
        this.$el.html(this.template(shifts));
//alert("in ShiftListsView render()" + shifts);
        return this;
    };

    this.initialize();

}