<?php
// INSERT code service for tblShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST  with 'insert' specified at client end
 {
 $workHours=$_POST['workhours'];
 $workTypeID=$_POST['worktypeid'];
 $projectID=$_POST['projectid'];
 $operatorID=$_POST['operatorid'];
 $product=$_POST['product'];
 $date=$_POST['date'];
 $startDateTime=$_POST['startdatetime'];
 $endDateTime=$_POST['enddatetime'];
 $rigID=$_POST['rigid'];     
  $q=mysqli_query($connection,"INSERT INTO `tblShift` (`WorkHours`,`WorkType`,'ProjectID','OperatorID','Product','Date','StartDateTime','EndDateTime','RigID') VALUES ('$workHours','$workTypeID','$projectID','$operatorID','$product','$date','$startDateTime','$endDateTime','$rigID')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
