<?php
// UPDATE code service for tblShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $shiftID=$_POST['shiftid'];
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

// NB 'date' not used at present 21/8/17     
     
// make sure date/time data are in a format compatible with MySQL (yyyy-mm-dd hh:mm:ss.f)
$parsedStartDateTime = date_parse($startDateTime);
     
$parsedEndDateTime = date_parse($endDateTime);     
     
$parsedDate = date_parse($date);    // parse date data from date picker, prior to their putting into string form compatible with MySQL (yyyy-mm-dd)
     
$strStartDateTime = $parsedStartDateTime[year] . "-" . $parsedStartDateTime[month] . "-" . $parsedStartDateTime[day] . " " .      
     
$parsedStartDateTime[hour] . ":" . $parsedStartDateTime[minute] . ":" . $parsedStartDateTime[second] . "." . $parsedStartDateTime[fraction];    // startdatetime field string
     
$strEndDateTime = $parsedEndDateTime[year] . "-" . $parsedEndDateTime[month] . "-" . $parsedEndDateTime[day] . " " .      
     
$parsedEndDateTime[hour] . ":" . $parsedEndDateTime[minute] . ":" . $parsedEndDateTime[second] . "." . $parsedEndDateTime[fraction];            // enddatetime field string

$strDate = $parsedDate[year] . "-" . $parsedDate[month] . "-" . $parsedDate[day];      // plain old date field string
     
     
$q1=mysqli_query($connection,"UPDATE `tblShift` SET `WorkHours`='$workHours', `Product`='$product',`Date`='$strDate', `StartDateTime`='$strStartDateTime',`EndDateTime`='$strEndDateTime' where `ShiftID`='$shiftID'");     
 if($q1)
 echo "success tblShift - ";
 else
 echo "error tblShift - ";

$q2=mysqli_query($connection,"UPDATE `tblOperatorShift` SET `OperatorID`='$operatorID' where `OperatorShiftID`='$operatorShiftID'");     
 if($q2)
 echo "success tblOperatorShift - ";
 else
 echo "error tblOperatorShift - ";

$q3=mysqli_query($connection,"UPDATE `tblProjectShift` SET `ProjectID`='$projectID' where `ProjectShiftID`='$projectShiftID'");     
 if($q3)
 echo "success tblProjectShift - ";
 else
 echo "error tblProjectShift - ";
     
$q4=mysqli_query($connection,"UPDATE `tblRigShift` SET `RigID`='$rigID' where `RigShiftID`='$rigShiftID'");     
 if($q4)
 echo "success tblRigShift - ";
 else
 echo "error tblRigShift - ";
     
$q5=mysqli_query($connection,"UPDATE `tblWorkTypeShift` SET `WorkTypeID`='$workTypeID' where `WorkTypeShiftID`='$workTypeShiftID'");     
 if($q5)
 echo "success tblWorkTypeShift - ";
 else
 echo "error tblWorkTypeShift - ";
     
 }
 ?>
