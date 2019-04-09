var EmployeeService = function() {

    var url;

    this.initialize = function(serviceURL) {

        //url = serviceURL ? serviceURL : "http://localhost:5000/employees";
        url = serviceURL ? serviceURL : "http://www.guidebookplus.com/drilldowndb/jsonoperatorsquery.php";
        var deferred = $.Deferred();
        deferred.resolve();
//alert(url);        
        return deferred.promise();
    }

    this.findById = function(id) {
        //return $.ajax({url: url + "/" + id});
        url = "http://www.guidebookplus.com/drilldowndb/jsonoperatorquerybyid.php?operatorid=" + id;    // use id argument in query of Operators table
//alert($.ajax({url: url}));        
        return $.ajax({url: url});
    }       // end of findById

    this.findByName = function(searchKey) {
        //return $.ajax({url: url + "?name=" + se archKey});
//alert($.ajax({url: url}));                
        return $.ajax({url: url});  // actually just find all at the mo
    }   // end of findByName
    
    
    
    this.findShiftsByOperator = function (operatorid) {
        
        url = "http://www.guidebookplus.com/drilldowndb/jsonshiftquerybyoperatorid.php?operatorid=" + operatorid;
//alert("in findShiftsByOperator, before " + url);        
        return $.ajax({url: url});
        
    }       // end of findShiftsByOperator



    this.findShiftByShift = function (shiftid) {
        
        url = "http://guidebookplus.com/drilldowndb/jsonshiftquerybyshiftid.php?shiftid=" + shiftid;
//alert("in findShiftsByOperator, before " + url);        
        return $.ajax({url: url});
        
    }       // end of findShiftsByOperator
    
    

}       // end of EmployeeService