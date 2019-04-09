
<head>
<style>
    td.subreport {
        font-weight: bold;
        font-style: italic;
    }

</style>
  
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
            google.charts.load('current',{packages:['corechart']});
        </script>
  
<!-- above needed for Google charts/visualisation -->
<!--
    <script src="../../../application/Chart.bundle.js" type="text/javascript"> </script>
    <script src="../../../application/Chart.Scatter.js" type="text/javascript"> </script>
-->
<!-- above needed for Chart.js -->        
    <script type="text/javascript">

    function xyValue (x,y)		// constructor for xy value (could be point coordinates; or offset, for example)
    {
            this.x = x;
            this.y = y;

            this.setX = function (x)
            {
                    this.x = x;	
            };

            this.getX = function ()
            {
                    return this.x;	
            };

            this.setY = function (y)
            {
                    this.y = y;	
            };

            this.getY = function ()
            {
                    return this.y;	
            };

    }	// end of xyValue 'class'

    // borrowed from Prosodic Harmony project
    
    
    
                function fetchShiftValues ()
                {
                        // fetch values for each individual shift
                        // for the moment, do this from data-attributes in DOM doc - could be done via AJAX call to a PHP file querying db
                    var records = document.getElementsByName("shiftrecord");        // get <tr> elements showing records in shiftsetcreport.php
                    var operatorNames = [];
                    var operatorIDs = []
                    var dates = [];
                    var product = [];
                    var shiftIDs = [];
                    
                    var shiftValues = [];
                    
                    for (var i=0; i< records.length; i++)       // for each record, get the data attributes (these values also in fields - hopefully not needing escaping)
                        {
                            operatorNames[i] = records[i].getAttribute('data-operatorname');      // operator's name
                            operatorIDs[i] = records[i].getAttribute('data-operatorid')           // operator's id
                            dates[i] = records[i].getAttribute('data-date');                    // date of this shift
                            product[i] = records[i].getAttribute('data-product');                 // product drilled by this operator in this shift
                            shiftIDs[i] = records[i].getAttribute('data-shiftid');                 // this shift's ID number
                        }
                    
                    shiftValues[0] = operatorNames;
                    shiftValues[1] = operatorIDs;
                    shiftValues[2] = dates;
                    shiftValues[3] = product;
                    
                    return shiftValues;
                }       // end of fetchShiftValues function

                function fetchDateProductValues()
                {
                        // fetch values for each individual date, where date recorded
                        // for the moment, do this from data-attributes in DOM doc - could be done via AJAX call to a PHP file querying db

                    var records = document.getElementsByName("dateproductrecord");        // get <tr> elements showing date/total-product records in shiftsetcreport.php                    
                    var dates = [];
                    var product = [];
                    
                    var dateProductValues = [];
                    
                    for (var i=0; i< records.length; i++)       // for each record, get the data attributes (these values also in fields - hopefully not needing escaping)
                        {
                            dates[i] = records[i].getAttribute('data-date-product');         // each date
                            product[i] = records[i].getAttribute('data-date-sumproduct');     // sum of product for this date
                        }
                    
                    dateProductValues[0] = dates;
                    dateProductValues[1] = product;
                    
                    return dateProductValues;
                    
                }

/*

            function drawDateProductChartJSChart()
            {
                
                var dateProductValues = fetchDateProductValues();
                
                var dates = dateProductValues[0];
                var product = dateProductValues[1];
                
                var dateProductxy = [];      // put dates into x, product into y


                for (var i = 0; i > dates.length; i++)
                    {
                        dateProductxy[i] = new xyValue(dates[i],product[i]);
                    }


                var options = {showScale:true};

                var context = document.getElementById('dateproductchart').getContext('2d');   
                //.getContext('2d')?
                
                new Chart(context).Scatter(dateProductxy,options);
                
                
                 
            }       // end of function drawdateProductChartJSChart

*/


// .find(function) may not be suitable

    function drawShiftChartGoogleChart() 
    {
        // https://developers.google.com/chart/interactive/docs/quick_start
        // https://developers.google.com/chart/interactive/docs/basic_load_libs

        var shiftValues = fetchShiftValues();   // get shift values from DOM document

        var operatorNames = shiftValues[0];
        var operatorIDs = shiftValues[1];
        var dates = shiftValues[2];
        var product = shiftValues[3];
        var shiftID = shiftValues[4];

        // TODO: give each operator a data table of their own
        // TODO: add their shift records to their data table

        // need a sort of sparse array ?
        // 
        // start operatorTablesCount at minus one (-1) (false, no records &c)

        var operatorTableIndex = [];
        var operatorTablesCount = -1;
        var operatorDataTables = [];

        var combined 

        for (var i = 0; i< operatorNames.length;i++)// for each record
        {//
            //if  (operatorTableIndex.find(Number(operatorIDs[i])) == undefined) // if that operatorid not found (Array.find) in operatorTableIndex array, operatorTablesCount emplty array ([])
            if  (operatorTableIndex.indexOf(parseInt(operatorIDs[i])) == -1) // if that operatorid not found (not Array.find) in operatorTableIndex array, operatorTablesCount emplty array ([]) (NB parseInt to try to fore cast as integer, not string or substring)
                {
                    operatorTablesCount++;                                           // (1) operatorTableIndexincrement operatorTablesCount
                    operatorTableIndex[operatorTablesCount] = operatorIDs[i];          // (2) store operatorID  in array of operatorIDs [operatorTablesCount] = operatorID
                    var operatorDataTable = new google.visualization.DataTable();     // (3) declare a new dataTable, push to array of operator dataTables (dataTablesArray)
                    operatorDataTable.addColumn('date','date');
                    operatorDataTable.addColumn('number','product');
                    operatorDataTables[operatorTablesCount] = operatorDataTable;                                   // (4) push (could .push) to array of operators' dataTables (will have index of index number of operatorID value stored in operatorTableIndex array in step (2))

        // (4) add a row to the table (?)
                }   // end of if-operatorid-not-already-found
            //else // else if operator id found ???
            // either way, add a row representing the record's date/metre to the appropriate table

//                    operatorDataTables[operatorTableIndex.find(operatorIDs[i])].addRow([new Date(dates[i]), Number(product[i])]);
                    operatorDataTables[operatorTableIndex.indexOf(operatorIDs[i])].addRow([new Date(dates[i]), Number(product[i])]);
                    // the operatorTableIndex's index for the stored operatorID is the index for the operatorDataTable for this operator (i hope!)

        }           // end of for-every-record(operatorID) loop       



        //                var shiftData = new google.visualization.DataTable();
        //                shiftData.addColumn('date','date');
        //                shiftData.addColumn('number','product');
        //                shiftData.addColumn('string','operatorName');
        //                shiftData.addColumn('number','operatorID');
        //                shiftData.addColumn('number','shiftID');


                    // https://developers.google.com/chart/interactive/docs/gallery/scatterchart

        var joinedShiftData = operatorDataTables[0];

        if (operatorTablesCount > 1)
            {
                // now that all shift records have been recorded so that each operator has their own distinct dataTale, join together these series ready for graphing
                // can only join 2 tables at once 
                for (var i = 1; i < operatorTablesCount; i++)
                    {
//                        var joinedShiftData = google.visualization.data.join(joinedShiftData,operatorDataTables[i],'full',[[0,0]],[1],[1]);
                        var joinedShiftData = google.visualization.data.join(joinedShiftData,operatorDataTables[i],'full',[[0,0]]    ,[1],[1]);
                    }   // end of for-every-operator-table-from-2nd-to-last
            }   // end of if-more-than-one-operator-table
          
                // http://stackoverflow.com/questions/18037925/google-chart-two-date-series-on-the-same-chart

                // https://developers.google.com/chart/interactive/docs/datesandtimes#dates-using-the-date-constructor
                
                // https://developers.google.com/chart/interactive/docs/gallery/linechart#curving-the-lines
                
                var options = {'tile':'Shifts chart','width':400,'height':300}
                
                var shiftsChart = new google.visualization.ScatterChart(document.getElementById('shiftchart'));shiftsChart.draw(joinedShiftData,options);
                shiftsChart.draw(joinedShiftData,options);                
                
            }       // end of drawShiftGoogleChart function 






            function drawDateProductChartGoogleChart()
            {
                
                var dateProductValues = fetchDateProductValues();
                
                var dates = dateProductValues[0];
                var product = dateProductValues[1];
                
                var dateProductxy = [];      // put dates into x, product into y

                var shiftData = new google.visualization.DataTable();
                shiftData.addColumn('date','date');
                shiftData.addColumn('number','product');
                

                // https://developers.google.com/chart/interactive/docs/gallery/scatterchart

                for (i = 0; i < dates.length; i++)
                    {
                        //shiftData.addRow([new Date(dates[i]),new Number(product[i]),operatorNames[i],new Number(operatorIDs[i])]);    // add row to chart data table
                        //shiftData.addRow([new Date(dates[i]),new Number(product[i])]);    // add row to chart data table
                        shiftData.addRow([new Date(dates[i]),Number(product[i])]);    // add row to chart data table
                //        shiftData.addRow([new Date(dates[i]),product[i]]);    // add row to chart data table
                    }

                // https://developers.google.com/chart/interactive/docs/datesandtimes#dates-using-the-date-constructor
                
                // https://developers.google.com/chart/interactive/docs/gallery/linechart#curving-the-lines


                    var options = {
                        title: 'product/date',
                        //width:600,
                        //height:600,
                        hAxis: {
                            format:'dd MMM yyyy',
                        //    viewWindow: {
                        //        min: new Date(2014, 11, 31, 18),
                        //        max: new Date(2016, 0, 1, 1)                
                        //    }
                        }
                              
                    };
                
                var dateProductChart = new google.visualization.LineChart(document.getElementById('dateproductchart'));
                
                dateProductChart.draw(shiftData,options);
                
  //              drawShiftChartGoogleChart();
                 
            }       // end of function drawdateProductChartGoogleChart

    
    google.charts.setOnLoadCallback(drawDateProductChartGoogleChart);
    google.charts.setOnLoadCallback(drawShiftChartGoogleChart);
            
            </script>


            
</head>
<body>
<h1>Shifts etc report <?php if (isset($startdate)) {echo $startdate . ' - ' . $enddate;} else {echo "date not set";} /* display date range if date parameters supplied/used  */ ?>
</h1>
<table border="1" width="100%">
    <tr><td>Operator Name</td><td>Work Hours</td><td>Product</td><td>Date of Shift</td><td>Project Description</td><td>Work Type Description</td><td>SEP / Rig Description</td></tr>
<?php

$operatorCount = 0;
$recordCount = 0;
$OperatorID = null; // could be 0; no record should have an ID value of 0
$operatorName = "";
//$product = array();
//$operatorNames = array();

$product = array();
$operatorNames = array();


foreach ($records as $record):  ?>

    
    
     <?php if ($OperatorID != $record['OperatorID'] && $OperatorID != null) {echo "<tr><td class='subreport' width='30px'>Total Product (" . $operatorName . ")</td><td class='subreport' width='100px'>" . $operatorproductsum[$operatorCount]['SumProduct'] ."</td>"; $operatorCount++;} /* if OperatorID different from previous record and if OperatorID not null (not first record) then must be a new record - summarise previous (in sub-report manner) - cf getSumAllShiftsProductGroupedByOperator() function */?>

   
   <?php echo '<tr name="shiftrecord" data-product="' . $record['Product'] . '" data-operatorname="' . $record['OperatorName'] . '" data-date="' . $record['Date'] . '" data-shiftid="' . $record['ShiftID']  . '" data-operatorid="' . $record['OperatorID'] . '">'; ?>


        <td><?php echo $record['OperatorName']; array_push($operatorNames,$record['OperatorName']); /* store in variable for use in chart */ ?></td>
        <td><?php echo $record['WorkHours'] ?></td>
        <td><?php echo $record['Product']; array_push($product,$record['Product']); /* store in variable for use in chart */ ?></td>
        <td><?php echo date('d',strtotime($record['Date'])) . '-' . date('m',strtotime($record['Date'])) . '-' . date('Y',strtotime($record['Date'])) ?></td>
    <!-- date() function here with single unit (eg 'Y')instead of array dereferencing here e.g. getdate(...)['year'] for version problems (pre- PHP 5.4) ? -->
        <td><?php echo $record['ProjectDescription'] ?></td>
        <td><?php echo $record['WorkTypeDescription'] ?></td>
        <td><?php echo $record['RigDescription'] ?></td>

<!-- might want product/hours for efficiency measure? -->
<!-- http://www.chartjs.org/docs/#line-chart-data-points
http://stackoverflow.com/questions/23740548/how-to-pass-variables-and-data-from-php-to-javascript
-->

</tr>        

    
<?php  $OperatorID = $record['OperatorID']; $operatorName = $record['OperatorName']; $recordCount++;  ?>

     <?php if ($recordCount == count($records)) {echo "<tr><td class='subreport' width='30px'>Total Product (" . $operatorName . ")</td><td class='subreport' width='100px'>" . $operatorproductsum[$operatorCount]['SumProduct'] ."</td>"; $operatorCount++;} /* if OperatorID different from previous record and if OperatorID not null (not first record) then must be a new record - summarise previous (in sub-report manner) - cf getSumAllShiftsProductGroupedByOperator() function */?>

<?php endforeach ?>

<?php echo '<tr><td class="subreport">Total Product (All)</td><td class="subreport">' .  $producttotal['SumProduct'] .  '</td></tr>' ?>


<?php /*for ($i = 0; $i < sizeof($operatorNames); $i++){echo $operatorNames[$i];} /* use this?*/ ?>
</table>

    <table border="1">
        <tr><td>Date</td>
            <?php foreach ($dateproductsum as $dateproduct):
            ?>
             <td><?php echo $dateproduct['Date'] ?></td>
        <?php endforeach ?>
        </tr>
        <tr><td>Product</td>
            <?php foreach ($dateproductsum as $dateproduct):
            ?>
            <td<?php echo ' name="dateproductrecord" data-date-product="' . $dateproduct['Date'] . '" data-date-sumproduct="' . $dateproduct['SumProduct'] .'">' . $dateproduct['SumProduct'] ?></td>
        <?php endforeach ?>
        </tr>
        
    </table>   
    
<A href="../../../ ">Table View</A>

<!--
<canvas id="shiftchart" width="400" height ="400"></canvas>
<canvas id="dateproductchart" width="400" height ="400"></canvas>
<!-- for Chartjs -->
-->


<div id="shiftchart"></div>
<div id="dateproductchart"></div>
<!-- for Google Chart -->

</body>