var EmployeeView = function(employee) {

    var shiftListView;
    
    this.initialize = function() {
        this.$el = $('<div/>');
        
         shiftListView = new ShiftListView();       // declare, on initialisation of operator/employee view, a new ShiftListView ready to show this operator's shifts
    };

    this.render = function() {
        this.$el.html(this.template(employee));
        return this;
    };
    
/*    
    this.renderOperatorShiftsListView = function(operatorid) {
        this.$el.html(this.template());
        this.findShiftsByOperator(operatorid);      // my own function, to set up shiftListView instance with data
        $('.content', this.$el).html(shiftListView.$el);
alert("in renderOperatorShiftsListView before return");
        return this;
    };
    
    this.findShiftsByOperator(operatorid) = function (operatorid) {
        service.findShiftsByOperator(parseInt(operatorid)).done(function(shifts) {
        alert("in route, after findShiftsByOperator - shifts=" + shifts);
                    var parsedShifts = JSON.parse(shifts);
        //alert("shifts=" + shifts + ", parsedShifts=" + parsedShifts);            
alert("parsedShifts=" + parsedShifts);          

            shiftListView.setOperatorShifts(parsedShifts);  // set content of shiftListView instance to parsedShifts data (using operatorid argument)
alert("set shiftListView instance to "+ parsedShifts);
////        $('body').html(new ShiftListView(parsedShifts).render().$el);        
                        
        }); // end of done function for findShiftsByOperator        
    };      // end of findShiftsByOperator
*/
    this.initialize();

}
