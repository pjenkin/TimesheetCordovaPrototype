<?php
// INSERT code service for tblShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
// INSERT new records in table to represent/record a new shift's declaration
 include "drilldowndbconnect.php";
 
 if(isset($_POST['insert']))        // if HTTP request is of type POST (and insert specifically requested (=1) in POST data)
 {
 $workHours=$_POST['workhours'];
 $workTypeID=$_POST['worktypeid'];
 $projectID=$_POST['projectid'];
 $operatorID=$_POST['operatorid'];
 $product=$_POST['product'];
 $date=$_POST['date'];
 $startDateTime=$_POST['startdatetime'];
 $endDateTime=$_POST['enddatetime'];
 $operatorShiftID=$_POST['operatorshiftid'];
 $projectShiftID=$_POST['projectshiftid'];
 $rigShiftID=$_POST['rigshiftid'];
 $workTypeShiftID=$_POST['worktypeshiftid'];
     
 $rigID=$_POST['rigid'];     
 //$q1=mysqli_query($connection,"UPDATE `tblShift` SET `WorkHours`='$workHours',`WorkTypeID`='$workTypeID', `ProjectID`='$projectID',`OperatorID`='$operatorID', `Product`='$product',`Date`='$date', `StartDateTime`='$startDateTime',`EndDateTime`='$endDateTime', `rigid`='$rigID' where `ShiftID`='$shiftID'");

//echo "got here,";
     
// make sure date data are in a format compatible with MySQL (yyyy-mm-dd hh:mm:ss.f)
$parsedStartDateTime = date_parse($startDateTime);
     
$parsedEndDateTime = date_parse($endDateTime);     
     
$parsedDate = date_parse($date);     
     
$strStartDateTime = $parsedStartDateTime[year] . "-" . $parsedStartDateTime[month] . "-" . $parsedStartDateTime[day] . " " .      
     
$parsedStartDateTime[hour] . ":" . $parsedStartDateTime[minute] . ":" . $parsedStartDateTime[second] . "." . $parsedStartDateTime[fraction];
     
$strEndDateTime = $parsedEndDateTime[year] . "-" . $parsedEndDateTime[month] . "-" . $parsedEndDateTime[day] . " " .      
     
$parsedEndDateTime[hour] . ":" . $parsedEndDateTime[minute] . ":" . $parsedEndDateTime[second] . "." . $parsedEndDateTime[fraction];

$strDate = $parsedEndDateTime[year] . "-" . $parsedEndDateTime[month] . "-" . $parsedEndDateTime[day];     

//echo "starting inserts, " . strDate . "," . $strStartDateTime . "," . $strEndDateTimes . ",";

// a, ty woky! ple'th yw declarys 'shiftid' y'n POST ?!
     
     
$q1=mysqli_query($connection,"INSERT INTO tblShift (WorkHours, Product, Date, StartDateTime, EndDateTime) VALUES ($workHours , $product, '$strDate', '$strStartDateTime', '$strEndDateTime')");
 if($q1)
 echo "success tblShift - ";
 else
 echo "error tblShift - ";

$shiftID = mysqli_insert_id($connection);      // get the last primary key id (i.e ShiftID, from tblShift insert, above) resulting from an insert via this db connection, for use in relational tables' records
//echo "shiftID=$shiftID, operatorid=$operatorID, ";     

// for some reason MySQL appears not keen on apostrophes around table names and field names, (ok with values) even though ok in preceding tblShift query (strange!)
     
     
$q2=mysqli_query($connection,"INSERT INTO tblOperatorShift (OperatorID, ShiftID) VALUES ('$operatorID', '$shiftID')");     
 if($q2)
 echo "success tblOperatorShift - ";
 else
 echo "error tblOperatorShift - ";
$q3=mysqli_query($connection,"INSERT INTO tblProjectShift (ProjectID, ShiftID) VALUES ('$projectID', '$shiftID')");     
 if($q3)
 echo "success tblProjectShift - ";
 else
 echo "error tblProjectShift - ";
     
$q4=mysqli_query($connection,"INSERT INTO tblRigShift (RigID, ShiftID) VALUES ($rigID, $shiftID)");
 if($q4)
 echo "success tblRigShift - ";
 else
 echo "error tblRigShift - ";
     
$q5=mysqli_query($connection,"INSERT INTO tblWorkTypeShift (WorkTypeID, ShiftID) VALUES ($workTypeID, $shiftID)");     
 if($q5)
 echo "success tblWorkTypeShift - ";
 else
 echo "error tblWorkTypeShift - ";
     
 }
 ?>
