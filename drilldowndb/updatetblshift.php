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
 $rigID=$_POST['rigid'];     
 $q=mysqli_query($connection,"UPDATE `tblShift` SET `WorkHours`='$workHours',`WorkTypeID`='$workTypeID', `ProjectID`='$projectID',`OperatorID`='$operatorID', `Product`='$product',`Date`='$date', `StartDateTime`='$startDateTime',`EndDateTime`='$endDateTime', `rigid`='$rigID' where `ShiftID`='$shiftID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>
