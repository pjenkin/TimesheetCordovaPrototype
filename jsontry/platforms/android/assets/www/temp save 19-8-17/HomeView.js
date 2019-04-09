var HomeView = function (service) {

    var employeeListView;

    this.initialize = function() {
        this.$el = $('<div/>');
        this.$el.on('keyup', '.search-key', this.findByName);
        employeeListView = new EmployeeListView();
        this.render();
    };

    this.render = function() {
        this.$el.html(this.template());
        $('.content', this.$el).html(employeeListView.$el);
        return this;
    };

    this.findByName = function() {
        service.findByName($('.search-key').val()).done(function(employees) {
//alert(service.findByName($('.search-key').val()));            
////alert("homeview findbyname operators: " + employees);
            var parsedEmployees = JSON.parse(employees);
////alert("homeview findbyname operators (parsed): " + parsedEmployees);            
            employeeListView.setEmployees(parsedEmployees); // ansum - turns out to work - that's all for tonight 15/8/17
////            employeeListView.setEmployees(employees);
        });
    };

    this.initialize();
}