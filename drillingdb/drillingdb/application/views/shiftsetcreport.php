
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
                    var drillerNames = [];
                    var drillerIDs = []
                    var dates = [];
                    var metres = [];
                    var shiftIDs = [];
                    
                    var shiftValues = [];
                    
                    for (var i=0; i< records.length; i++)       // for each record, get the data attributes (these values also in fields - hopefully not needing escaping)
                        {
                            drillerNames[i] = records[i].getAttribute('data-drillername');      // driller's name
                            drillerIDs[i] = records[i].getAttribute('data-drillerid')           // driller's id
                            dates[i] = records[i].getAttribute('data-date');                    // date of this shift
                            metres[i] = records[i].getAttribute('data-metres');                 // metres drilled by this driller in this shift
                            shiftIDs[i] = records[i].getAttribute('data-shiftid');                 // this shift's ID number
                        }
                    
                    shiftValues[0] = drillerNames;
                    shiftValues[1] = drillerIDs;
                    shiftValues[2] = dates;
                    shiftValues[3] = metres;
                    
                    return shiftValues;
                }       // end of fetchShiftValues function

                function fetchDateMetresValues()
                {
                        // fetch values for each individual date, where date recorded
                        // for the moment, do this from data-attributes in DOM doc - could be done via AJAX call to a PHP file querying db

                    var records = document.getElementsByName("datemetresrecord");        // get <tr> elements showing date/total-metres records in shiftsetcreport.php                    
                    var dates = [];
                    var metres = [];
                    
                    var dateMetresValues = [];
                    
                    for (var i=0; i< records.length; i++)       // for each record, get the data attributes (these values also in fields - hopefully not needing escaping)
                        {
                            dates[i] = records[i].getAttribute('data-date-metres');         // each date
                            metres[i] = records[i].getAttribute('data-date-summetres');     // sum of metres for this date
                        }
                    
                    dateMetresValues[0] = dates;
                    dateMetresValues[1] = metres;
                    
                    return dateMetresValues;
                    
                }

/*

            function drawDateMetresChartJSChart()
            {
                
                var dateMetresValues = fetchDateMetresValues();
                
                var dates = dateMetresValues[0];
                var metres = dateMetresValues[1];
                
                var dateMetresxy = [];      // put dates into x, metres into y


                for (var i = 0; i > dates.length; i++)
                    {
                        dateMetresxy[i] = new xyValue(dates[i],metres[i]);
                    }


                var options = {showScale:true};

                var context = document.getElementById('datemetreschart').getContext('2d');   
                //.getContext('2d')?
                
                new Chart(context).Scatter(dateMetresxy,options);
                
                
                 
            }       // end of function drawdateMetresChartJSChart

*/


// .find(function) may not be suitable

    function drawShiftChartGoogleChart() 
    {
        // https://developers.google.com/chart/interactive/docs/quick_start
        // https://developers.google.com/chart/interactive/docs/basic_load_libs

        var shiftValues = fetchShiftValues();   // get shift values from DOM document

        var drillerNames = shiftValues[0];
        var drillerIDs = shiftValues[1];
        var dates = shiftValues[2];
        var metres = shiftValues[3];
        var shiftID = shiftValues[4];

        // TODO: give each driller a data table of their own
        // TODO: add their shift records to their data table

        // need a sort of sparse array ?
        // 
        // start drillerTablesCount at minus one (-1) (false, no records &c)

        var drillerTableIndex = [];
        var drillerTablesCount = -1;
        var drillerDataTables = [];

        var combined 

        for (var i = 0; i< drillerNames.length;i++)// for each record
        {//
            //if  (drillerTableIndex.find(Number(drillerIDs[i])) == undefined) // if that drillerid not found (Array.find) in drillerTableIndex array, drillerTablesCount emplty array ([])
            if  (drillerTableIndex.indexOf(parseInt(drillerIDs[i])) == -1) // if that drillerid not found (not Array.find) in drillerTableIndex array, drillerTablesCount emplty array ([]) (NB parseInt to try to fore cast as integer, not string or substring)
                {
                    drillerTablesCount++;                                           // (1) drillerTableIndexincrement drillerTablesCount
                    drillerTableIndex[drillerTablesCount] = drillerIDs[i];          // (2) store drillerID  in array of drillerIDs [drillerTablesCount] = drillerID
                    var drillerDataTable = new google.visualization.DataTable();     // (3) declare a new dataTable, push to array of driller dataTables (dataTablesArray)
                    drillerDataTable.addColumn('date','date');
                    drillerDataTable.addColumn('number','metres');
                    drillerDataTables[drillerTablesCount] = drillerDataTable;                                   // (4) push (could .push) to array of drillers' dataTables (will have index of index number of drillerID value stored in drillerTableIndex array in step (2))

        // (4) add a row to the table (?)
                }   // end of if-drillerid-not-already-found
            //else // else if driller id found ???
            // either way, add a row representing the record's date/metre to the appropriate table

//                    drillerDataTables[drillerTableIndex.find(drillerIDs[i])].addRow([new Date(dates[i]), Number(metres[i])]);
                    drillerDataTables[drillerTableIndex.indexOf(drillerIDs[i])].addRow([new Date(dates[i]), Number(metres[i])]);
                    // the drillerTableIndex's index for the stored drillerID is the index for the drillerDataTable for this driller (i hope!)

        }           // end of for-every-record(drillerID) loop       



        //                var shiftData = new google.visualization.DataTable();
        //                shiftData.addColumn('date','date');
        //                shiftData.addColumn('number','metres');
        //                shiftData.addColumn('string','drillerName');
        //                shiftData.addColumn('number','drillerID');
        //                shiftData.addColumn('number','shiftID');


                    // https://developers.google.com/chart/interactive/docs/gallery/scatterchart

        var joinedShiftData = drillerDataTables[0];

        if (drillerTablesCount > 1)
            {
                // now that all shift records have been recorded so that each driller has their own distinct dataTale, join together these series ready for graphing
                // can only join 2 tables at once 
                for (var i = 1; i < drillerTablesCount; i++)
                    {
//                        var joinedShiftData = google.visualization.data.join(joinedShiftData,drillerDataTables[i],'full',[[0,0]],[1],[1]);
                        var joinedShiftData = google.visualization.data.join(joinedShiftData,drillerDataTables[i],'full',[[0,0]]    ,[1],[1]);
                    }   // end of for-every-driller-table-from-2nd-to-last
            }   // end of if-more-than-one-driller-table
          
                // http://stackoverflow.com/questions/18037925/google-chart-two-date-series-on-the-same-chart

                // https://developers.google.com/chart/interactive/docs/datesandtimes#dates-using-the-date-constructor
                
                // https://developers.google.com/chart/interactive/docs/gallery/linechart#curving-the-lines
                
                var options = {'tile':'Shifts chart','width':400,'height':300}
                
                var shiftsChart = new google.visualization.ScatterChart(document.getElementById('shiftchart'));shiftsChart.draw(joinedShiftData,options);
                shiftsChart.draw(joinedShiftData,options);                
                
            }       // end of drawShiftGoogleChart function 






            function drawDateMetresChartGoogleChart()
            {
                
                var dateMetresValues = fetchDateMetresValues();
                
                var dates = dateMetresValues[0];
                var metres = dateMetresValues[1];
                
                var dateMetresxy = [];      // put dates into x, metres into y

                var shiftData = new google.visualization.DataTable();
                shiftData.addColumn('date','date');
                shiftData.addColumn('number','metres');
                

                // https://developers.google.com/chart/interactive/docs/gallery/scatterchart

                for (i = 0; i < dates.length; i++)
                    {
                        //shiftData.addRow([new Date(dates[i]),new Number(metres[i]),drillerNames[i],new Number(drillerIDs[i])]);    // add row to chart data table
                        //shiftData.addRow([new Date(dates[i]),new Number(metres[i])]);    // add row to chart data table
                        shiftData.addRow([new Date(dates[i]),Number(metres[i])]);    // add row to chart data table
                //        shiftData.addRow([new Date(dates[i]),metres[i]]);    // add row to chart data table
                    }

                // https://developers.google.com/chart/interactive/docs/datesandtimes#dates-using-the-date-constructor
                
                // https://developers.google.com/chart/interactive/docs/gallery/linechart#curving-the-lines


                    var options = {
                        title: 'metres/date',
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
                
                var dateMetresChart = new google.visualization.LineChart(document.getElementById('datemetreschart'));
                
                dateMetresChart.draw(shiftData,options);
                
  //              drawShiftChartGoogleChart();
                 
            }       // end of function drawdateMetresChartGoogleChart

    
    google.charts.setOnLoadCallback(drawDateMetresChartGoogleChart);
    google.charts.setOnLoadCallback(drawShiftChartGoogleChart);
            
            </script>


            
</head>
<body>
<h1>Shifts etc report <?php if (isset($startdate)) {echo $startdate . ' - ' . $enddate;} else {echo "date not set";} /* display date range if date parameters supplied/used  */ ?>
</h1>
<table border="1" width="100%">
    <tr><td>Driller Name</td><td>Work Hours</td><td>Metres</td><td>Date of Shift</td><td>Project Description</td><td>Work Type Description</td><td>SEP / Rig Description</td></tr>
<?php

$drillerCount = 0;
$recordCount = 0;
$DrillerID = null; // could be 0; no record should have an ID value of 0
$drillerName = "";
//$metres = array();
//$drillerNames = array();

$metres = array();
$drillerNames = array();


foreach ($records as $record):  ?>

    
    
     <?php if ($DrillerID != $record['DrillerID'] && $DrillerID != null) {echo "<tr><td class='subreport' width='30px'>Total Metres (" . $drillerName . ")</td><td class='subreport' width='100px'>" . $drillermetressum[$drillerCount]['SumMetres'] ."</td>"; $drillerCount++;} /* if DrillerID different from previous record and if DrillerID not null (not first record) then must be a new record - summarise previous (in sub-report manner) - cf getSumAllShiftsMetresGroupedByDriller() function */?>

   
   <?php echo '<tr name="shiftrecord" data-metres="' . $record['Metres'] . '" data-drillername="' . $record['DrillerName'] . '" data-date="' . $record['Date'] . '" data-shiftid="' . $record['ShiftID']  . '" data-drillerid="' . $record['DrillerID'] . '">'; ?>


        <td><?php echo $record['DrillerName']; array_push($drillerNames,$record['DrillerName']); /* store in variable for use in chart */ ?></td>
        <td><?php echo $record['WorkHours'] ?></td>
        <td><?php echo $record['Metres']; array_push($metres,$record['Metres']); /* store in variable for use in chart */ ?></td>
        <td><?php echo date('d',strtotime($record['Date'])) . '-' . date('m',strtotime($record['Date'])) . '-' . date('Y',strtotime($record['Date'])) ?></td>
    <!-- date() function here with single unit (eg 'Y')instead of array dereferencing here e.g. getdate(...)['year'] for version problems (pre- PHP 5.4) ? -->
        <td><?php echo $record['ProjectDescription'] ?></td>
        <td><?php echo $record['WorkTypeDescription'] ?></td>
        <td><?php echo $record['SEPRigDescription'] ?></td>

<!-- might want metres/hours for efficiency measure? -->
<!-- http://www.chartjs.org/docs/#line-chart-data-points
http://stackoverflow.com/questions/23740548/how-to-pass-variables-and-data-from-php-to-javascript
-->

</tr>        

    
<?php  $DrillerID = $record['DrillerID']; $drillerName = $record['DrillerName']; $recordCount++;  ?>

     <?php if ($recordCount == count($records)) {echo "<tr><td class='subreport' width='30px'>Total Metres (" . $drillerName . ")</td><td class='subreport' width='100px'>" . $drillermetressum[$drillerCount]['SumMetres'] ."</td>"; $drillerCount++;} /* if DrillerID different from previous record and if DrillerID not null (not first record) then must be a new record - summarise previous (in sub-report manner) - cf getSumAllShiftsMetresGroupedByDriller() function */?>

<?php endforeach ?>

<?php echo '<tr><td class="subreport">Total Metres (All)</td><td class="subreport">' .  $metrestotal['SumMetres'] .  '</td></tr>' ?>


<?php /*for ($i = 0; $i < sizeof($drillerNames); $i++){echo $drillerNames[$i];} /* use this?*/ ?>
</table>

    <table border="1">
        <tr><td>Date</td>
            <?php foreach ($datemetressum as $datemetres):
            ?>
             <td><?php echo $datemetres['Date'] ?></td>
        <?php endforeach ?>
        </tr>
        <tr><td>Metres</td>
            <?php foreach ($datemetressum as $datemetres):
            ?>
            <td<?php echo ' name="datemetresrecord" data-date-metres="' . $datemetres['Date'] . '" data-date-summetres="' . $datemetres['SumMetres'] .'">' . $datemetres['SumMetres'] ?></td>
        <?php endforeach ?>
        </tr>
        
    </table>   
    
<A href="../../../ ">Table View</A>

<!--
<canvas id="shiftchart" width="400" height ="400"></canvas>
<canvas id="datemetreschart" width="400" height ="400"></canvas>
<!-- for Chartjs -->
-->


<div id="shiftchart"></div>
<div id="datemetreschart"></div>
<!-- for Google Chart -->

</body>