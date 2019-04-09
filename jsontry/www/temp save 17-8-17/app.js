// We use an "Immediate Function" to initialize the application to avoid leaving anything behind in the global scope
(function () {

    /* ---------------------------------- Local Variables ---------------------------------- */
    HomeView.prototype.template = Handlebars.compile($("#home-tpl").html());
    EmployeeListView.prototype.template = Handlebars.compile($("#employee-list-tpl").html());
    EmployeeView.prototype.template = Handlebars.compile($("#operator-tpl").html());

    var service = new EmployeeService();
    service.initialize().done(function () {

        $('body').html(new HomeView(service).render().$el);
//        $('body').html(new EmployeeView(service.findByName("a")).render().$el);  // start with findByName (actually find-all at the mo)
        $('.search-key').keyup();   // bit dopey, but this is to trigger the findByName function to populate with names (by simulating key up of search box (whose class is 'search-key'))
        
//alert("before adding 1st route");        
        
        router.addRoute('', function() {
            console.log('empty');
            //slider.slidePage(new HomeView(service).render().$el); // REM pageslide for the mo (pageslide hardware acceleration left)
            $('body').html(new HomeView(service).render().$el);
        }); // end of empty/Home route
//alert('before adding employee route');
        router.addRoute('employees/:id', function(id) {
//alert("trying employee/operator route");            
            console.log('details');
            service.findById(parseInt(id)).done(function(employee) {
//                slider.slidePage(new EmployeeView(employee).render().$el);    // REM pageslide for now in favour of old skool body.html
                var parsedEmployee = JSON.parse(employee)
alert("employee=" + employee + ", parsedEmployee=" + parsedEmployee);                

                $('body').html(new EmployeeView(parsedEmployee).render().$el);
                 //$('body').html(new EmployeeView(employee).render().$el);
            });
        }); // end of addRoute for employees
//alert('after adding employee route');
        router.start();        
        
        
        
    });     // end of initialize() done function

    /* --------------------------------- Event Registration -------------------------------- */
    document.addEventListener('deviceready', function () {
        StatusBar.overlaysWebView( false );
        StatusBar.backgroundColorByHexString('#ffffff');
        StatusBar.styleDefault();
        FastClick.attach(document.body);
        if (navigator.notification) { // Override default HTML alert with native dialog
            window.alert = function (message) {
                navigator.notification.alert(
                    message,    // message
                    null,       // callback
                    "Workshop", // title
                    'OK'        // buttonName
                );
            };
        }
    }, false);

    /* ---------------------------------- Local Functions ---------------------------------- */

}());