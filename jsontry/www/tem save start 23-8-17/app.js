// We use an "Immediate Function" to initialize the application to avoid leaving anything behind in the global scope
(function () {

    /* ---------------------------------- Local Variables ---------------------------------- */
    
    //  https://stackoverflow.com/questions/13046401/how-to-set-selected-select-option-in-handlebars-template
    //  https://stackoverflow.com/questions/40604067/handlebar-select-box-populate
    //  https://stackoverflow.com/questions/43420354/handlebars-select-list
    
    Handlebars.registerHelper('select', function( value, options ){
        var $el = $('<select />').html( options.fn(this) );
        $el.find('[value="' + value + '"]').attr({'selected':'selected'});
        return $el.html();
    });
    
    
    
    
    
    
    HomeView.prototype.template = Handlebars.compile($("#home-tpl").html());
    EmployeeListView.prototype.template = Handlebars.compile($("#employee-list-tpl").html());
    EmployeeView.prototype.template = Handlebars.compile($("#operator-tpl").html());

    ShiftListView.prototype.template = Handlebars.compile($("#operator-shift-tpl").html());
    ShiftView.prototype.template = Handlebars.compile($("#shift-tpl").html());
    //NewShiftView.prototype.template = Handlebars.compile($("new-shift-tpl").html());
    
    var service = new EmployeeService();
    service.initialize().done(function () {

        $('body').html(new HomeView(service).render().$el);
//        $('body').html(new EmployeeView(service.findByName("a")).render().$el);  // start with findByName (actually find-all at the mo)
        
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
                var parsedEmployee = JSON.parse(employee);
////alert("employee=" + employee + ", parsedEmployee=" + parsedEmployee);                

                $('body').html(new EmployeeView(parsedEmployee).render().$el);
                 //$('body').html(new EmployeeView(employee).render().$el);
            });
        }); // end of addRoute for employees
//alert('after adding employee route');
        
        
        
        
        //add routes, for operator-shifts view and for shift view
        
        router.addRoute('operatorshifts/:operatorid', function (operatorid) {
        
                service.findShiftsByOperator(parseInt(operatorid)).done(function(shifts) {
                    var parsedShifts = JSON.parse(shifts);        // parse the JSON shift data resulting from the done findSHiftByShift
                    $('body').html(new ShiftListView(parsedShifts).render().$el);       // inject (?) the view's HTML using the handlebars template               
                });     // end of 'done' function for findShiftsByOperator            
        }); // end of route for operator shifts

        
        
            router.addRoute('shiftview/:shiftid', function (shiftid) {
                service.findShiftByShift(parseInt(shiftid)).done(function(shift) {
//alert("shift=" + shift);
                    var parsedShift = JSON.parse(shift);        // parse the JSON shift data resulting from the done findShiftByShift
//alert("parsedShift=" + parsedShift);
                    $('body').html(new ShiftView(parsedShift).render().$el);        // inject (?) the view's HTML using the handlebars template   
                    
                              $('#startdatetimeinput').click(function(){   // set up newly added element's click

// https://www.npmjs.com/package/skwas-cordova-plugin-datetimepicker
                                    var myDate = new Date($('#startdatetimeinput').val()); // get date from form input 
//alert("startdatetime" + myDate); 
// NB if time ever at 0000-00-00 00:00:00 then the plugin dialogue won't work (field value must be set to non-zero at database)
                                    cordova.plugins.DateTimePicker.show({
                                        mode: "datetime",
                                        date: myDate,
                                        allowOldDates: true,
                                        allowFutureDates: true,
                                        minuteInterval: 15,
                                        locale: "EN",
                                        okText: "Select",
                                        cancelText: "Cancel",
                                        android: {
                                            theme: 16974126, // Theme_DeviceDefault_Dialog 
                                            calendar: false,
                                            is24HourView: true
                                        },
                                        success: function(newDate) {
                                            // Handle new date. 
                                            console.info(newDate);
                                            myDate = newDate;
                                            $('#startdatetimeinput').val(myDate);       // set form input's date value from user action on datetime picker
//alert(myDate);                                            
                                        },
                                        cancel: function() {
                                            console.info("Cancelled");
                                        },
                                        error: function (err) {
                                            // Handle error. 
                                            console.error(err);
                                        }
                                    });     // end of DateTimePicker.show
                                                                    
                                });     // end of setting up startdatetime click

                              $('#enddatetimeinput').click(function(){   // set up newly added element's click

// https://www.npmjs.com/package/skwas-cordova-plugin-datetimepicker
                                    var myDate = new Date($('#enddatetimeinput').val()); // get date from form input 
//alert("enddatetime" + myDate); 
// NB if time ever at 0000-00-00 00:00:00 then the plugin dialogue won't work (field value must be set to non-zero at database)                                  
                                    cordova.plugins.DateTimePicker.show({
                                        mode: "datetime",
                                        date: myDate,
                                        allowOldDates: true,
                                        allowFutureDates: true,
                                        minuteInterval: 15,
                                        locale: "EN",
                                        okText: "Select",
                                        cancelText: "Cancel",
                                        android: {
                                            theme: 16974126, // Theme_DeviceDefault_Dialog 
                                            calendar: false,
                                            is24HourView: true
                                        },
                                        success: function(newDate) {
                                            // Handle new date. 
                                            console.info(newDate);
                                            myDate = newDate;
                                            $('#enddatetimeinput').val(myDate);       // set form input's date value from user action on datetime picker
//alert(myDate);                                            
                                        },
                                        cancel: function() {
                                            console.info("Cancelled");
                                        },
                                        error: function (err) {
                                            // Handle error. 
                                            console.error(err);
                                        }
                                    });     // end of DateTimePicker.show
                                                                    
                                });     // end of setting up enddatetime click
                    
                    
                    
                    $('#btn-saveshiftchanges').click(function(){   // set up newly added element's click (button to save chages to shift's record)
                            // $('#frm-shiftupdate').submit();      // trigger the shift's form's submit action (a post to updateallshifttables.php)
                        // https://www.w3schools.com/jquery/ajax_post.asp
                                $.post("http://www.guidebookplus.com/drilldowndb/updateallshifttables.php",
                        
                                    {
                                        shiftid : $('#shiftidinput').val(),
                                        projectid : $('#projectidselect').val(),
                                        rigid : $('#rigidselect').val(),
                                        worktypeid : $('#worktypeidselect').val(),
                                        product : $('#productinput').val(),
                                        startdatetime : $('#startdatetimeinput').val(),
                                        enddatetime : $('#enddatetimeinput').val(),
                                        workhours : $('#workhoursinput').val(),
                                        operatorshiftid : $('#operatorshiftidhidden').val(),
                                        projectshiftid : $('#projectshiftidhidden').val(),
                                        rigshiftid : $('#rigshiftidhidden').val(),
                                        worktypeshiftid : $('#worktypeshiftidhidden').val(),
                                        operatorid : $('#operatoridhidden').val(),
                                        update : $('#updatehidden').val()
            /*                            id : $('#').val(),
                                        id : $('#').val(),          */                                
                                    },
                                       function (response, status){
//alert(response + ", status:" + status);
                                }
                                      );    // end of jquerypost function
                                      
                                      
                        
                            // window.location.href = "operatorshifts/" + $('#operatoridhidden').val();     // take route back to showing all operator's shifts
                    });     // end of btn-saveshiftchanges click event setup
                    
                    
                });     // end of service.findShiftByShift.done's function                           
                           
            });     // end of shift by shiftid route

        
/*        
            router.addRoute('shiftview/new', function (shiftid) {
                service.findShiftByShift(parseInt(shiftid)).done(function(shift) {
//alert("shift=" + shift);
                    var parsedShift = JSON.parse(shift);        // parse the JSON shift data resulting from the done findShiftByShift
//alert("parsedShift=" + parsedShift);
                    $('body').html(new ShiftView(parsedShift).render().$el);        // inject (?) the view's HTML using the handlebars template   
                    
                              $('#startdatetimeinput').click(function(){   // set up newly added element's click

// https://www.npmjs.com/package/skwas-cordova-plugin-datetimepicker
                                    var myDate = new Date($('#startdatetimeinput').val()); // get date from form input 
//alert("startdatetime" + myDate); 
// NB if time ever at 0000-00-00 00:00:00 then the plugin dialogue won't work (field value must be set to non-zero at database)
                                    cordova.plugins.DateTimePicker.show({
                                        mode: "datetime",
                                        date: myDate,
                                        allowOldDates: true,
                                        allowFutureDates: true,
                                        minuteInterval: 15,
                                        locale: "EN",
                                        okText: "Select",
                                        cancelText: "Cancel",
                                        android: {
                                            theme: 16974126, // Theme_DeviceDefault_Dialog 
                                            calendar: false,
                                            is24HourView: true
                                        },
                                        success: function(newDate) {
                                            // Handle new date. 
                                            console.info(newDate);
                                            myDate = newDate;
                                            $('#startdatetimeinput').val(myDate);       // set form input's date value from user action on datetime picker
//alert(myDate);                                            
                                        },
                                        cancel: function() {
                                            console.info("Cancelled");
                                        },
                                        error: function (err) {
                                            // Handle error. 
                                            console.error(err);
                                        }
                                    });     // end of DateTimePicker.show
                                                                    
                                });     // end of setting up startdatetime click

                              $('#enddatetimeinput').click(function(){   // set up newly added element's click

// https://www.npmjs.com/package/skwas-cordova-plugin-datetimepicker
                                    var myDate = new Date($('#enddatetimeinput').val()); // get date from form input 
//alert("enddatetime" + myDate); 
// NB if time ever at 0000-00-00 00:00:00 then the plugin dialogue won't work (field value must be set to non-zero at database)                                  
                                    cordova.plugins.DateTimePicker.show({
                                        mode: "datetime",
                                        date: myDate,
                                        allowOldDates: true,
                                        allowFutureDates: true,
                                        minuteInterval: 15,
                                        locale: "EN",
                                        okText: "Select",
                                        cancelText: "Cancel",
                                        android: {
                                            theme: 16974126, // Theme_DeviceDefault_Dialog 
                                            calendar: false,
                                            is24HourView: true
                                        },
                                        success: function(newDate) {
                                            // Handle new date. 
                                            console.info(newDate);
                                            myDate = newDate;
                                            $('#enddatetimeinput').val(myDate);       // set form input's date value from user action on datetime picker
//alert(myDate);                                            
                                        },
                                        cancel: function() {
                                            console.info("Cancelled");
                                        },
                                        error: function (err) {
                                            // Handle error. 
                                            console.error(err);
                                        }
                                    });     // end of DateTimePicker.show
                                                                    
                                });     // end of setting up enddatetime click
                    
                    
                    
                    $('#btn-saveshiftchanges').click(function(){   // set up newly added element's click (button to save chages to shift's record)
                            // $('#frm-shiftupdate').submit();      // trigger the shift's form's submit action (a post to updateallshifttables.php)
                        // https://www.w3schools.com/jquery/ajax_post.asp
                                $.post("http://www.guidebookplus.com/drilldowndb/updateallshifttables.php",
                        
                                    {
                                        shiftid : $('#shiftidinput').val(),
                                        projectid : $('#projectidselect').val(),
                                        rigid : $('#rigidselect').val(),
                                        worktypeid : $('#worktypeidselect').val(),
                                        product : $('#productinput').val(),
                                        startdatetime : $('#startdatetimeinput').val(),
                                        enddatetime : $('#enddatetimeinput').val(),
                                        workhours : $('#workhoursinput').val(),
                                        operatorshiftid : $('#operatorshiftidhidden').val(),
                                        projectshiftid : $('#projectshiftidhidden').val(),
                                        rigshiftid : $('#rigshiftidhidden').val(),
                                        worktypeshiftid : $('#worktypeshiftidhidden').val(),
                                        operatorid : $('#operatoridhidden').val(),
                                        update : $('#updatehidden').val()
                                        //id : $('#').val(),
                                        //id : $('#').val(),          
                                    },
                                       function (response, status){
//alert(response + ", status:" + status);
                                }
                                      );    // end of jquerypost function
                                      
                                      
                        
                            // window.location.href = "operatorshifts/" + $('#operatoridhidden').val();     // take route back to showing all operator's shifts
                    });     // end of btn-saveshiftchanges click event setup
                    
                    
                });     // end of service.findShiftByShift.done's function                           
                           
            });     // end of new shift route
*/        
        
        
        router.start();        

        $('.search-key').keyup();   // bit dopey, but this is to trigger the findByName function to populate with names (by simulating key up of search box (whose class is 'search-key'))
// not working???        
        
        
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
        

        
    }, false);      // end of deviceready
    

    /* ---------------------------------- Local Functions ---------------------------------- */

}());