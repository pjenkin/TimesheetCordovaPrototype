
<head>
<style>
    td.subreport {
        font-weight: bold;
        font-style: italic;
    }

</style>
<!--
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
-->
<!-- above needed for Google charts/visualisation -->
    <script src="../../../application/Chart.bundle.js" type="text/javascript"> </script>
    <script src="../../../application/Chart.Scatter.js" type="text/javascript"> </script>
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
                    
                    var shiftValues = [];
                    
                    for (var i=0; i< records.length; i++)       // for each record, get the data attributes (these values also in fields - hopefully not needing escaping)
                        {
                            drillerNames[i] = records[i].getAttribute('data-drillername');      // driller's name
                            drillerIDs[i] = records[i].getAttribute('data-drillerid')           // driller's id
                            dates[i] = records[i].getAttribute('data-date');                    // date of this shift
                            metres[i] = records[i].getAttribute('data-metres');                 // metres drilled by this driller in this shift
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

                    var records = document.getElementsByName("shiftrecord");        // get <tr> elements showing date/total-metres records in shiftsetcreport.php                    
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
                
                
                /*
                var shiftChart = new Chart(context,
                {
                type:'scatter',
                data: dateMetresxy,
                options: 
                }
                  */  
                 
            }       // end of function drawShiftChartJSChart

/*
            function drawShiftGoogleChart() 
            {
                // https://developers.google.com/chart/interactive/docs/quick_start
                // https://developers.google.com/chart/interactive/docs/basic_load_libs
        
                var shiftValues = fetchShiftValues();   // get shift values from DOM document
                
                var drillerNames = shiftValues[0];
                var drillerIDs = shiftValues[1];
                var dates = shiftValues[2];
                var metres = shiftValues[3];

        
                var shiftData = new google.visualization.DataTable();
                shiftData.addColumn('date','date');
                shiftData.addColumn('number','metres');
                shiftData.addColumn('string','drillerName');
                shiftData.addColumn('number','drillerID');
                

                // https://developers.google.com/chart/interactive/docs/gallery/scatterchart

                for (i = 0; i < drillerNames.length; i++)
                    {
                        shiftData.addRow([new Date(dates[i]),new Number(metres[i]),drillerNames[i],new Number(drillerIDs[i])]);    // add row to chart data table
                //        shiftData.addRow([new Date(dates[i]),metres[i]]);    // add row to chart data table
                    }

                // https://developers.google.com/chart/interactive/docs/datesandtimes#dates-using-the-date-constructor
                
                // https://developers.google.com/chart/interactive/docs/gallery/linechart#curving-the-lines
                
                var options = {'tile':'Shifts chart','width':400,'height':300}
                
                var shiftsChart = new google.visualization.Scatter(document.getElementById('shiftchart'));shiftsChart.draw(shiftData,options);
            }       // end of drawShiftChart function 
  */          
            
            </script>

        <script type="text/javascript">
            google.charts.load('current',{packages:['corechart']});
            google.charts.setOnLoadCallback(drawShiftChart);
        </script>
            
</head>
<body onload="drawDateMetresChartJSChart()">
<h1>Shifts etc report <?php if (isset($startdate)) {echo $startdate . ' - ' . $enddate;} else {echo "date not set";} /* display date range if date parameters supplied/used  */ ?>
</h1>
<table border="1" width="100%">
    <tr><td>Driller Name</td><td>Work Hours</td><td>Metres</td><td>Date of Shift</td><td>Project Description</td><td>Work Type Description</td><td>SEP / Rig Description</td></tr>
<?php

$drillerCount = 0;
$recordCount = 0;
$DrillerID = null; // could be 0; no record should have an ID value of 0
$drillerName = "";
$metres = [];
$drillerNames = [];

foreach ($records as $record):  ?>

    
    
     <?php if ($DrillerID != $record['DrillerID'] && $DrillerID != null) {echo "<tr><td class='subreport' width='30px'>Total Metres (" . $drillerName . ")</td><td class='subreport' width='100px'>" . $drillermetressum[$drillerCount]['SumMetres'] ."</td>"; $drillerCount++;} /* if DrillerID different from previous record and if DrillerID not null (not first record) then must be a new record - summarise previous (in sub-report manner) - cf getSumAllShiftsMetresGroupedByDriller() function */?>

   
   <?php echo '<tr name="shiftrecord" data-metres="' . $record['Metres'] . '" data-drillername="' . $record['DrillerName'] . '" data-date="' . $record['Date'] . '" data-drillerid="' . $record['DrillerID'] . '">'; ?>


        <td><?php echo $record['DrillerName']; array_push($drillerNames,$record['DrillerName']); /* store in variable for use in chart */ ?></td>
        <td><?php echo $record['WorkHours'] ?></td>
        <td><?php echo $record['Metres']; array_push($metres,$record['Metres']); /* store in variable for use in chart */ ?></td>
        <td><?php echo getdate(strtotime($record['Date']))['mday'] . '-' . getdate(strtotime($record['Date']))['month'] . '-' . getdate(strtotime($record['Date']))['year'] ?></td>
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

<canvas id="shiftchart" width="400" height ="400"></canvas>
<canvas id="datemetreschart" width="400" height ="400"></canvas>

<!-- <div id="shiftchart"></div> -->
</body>