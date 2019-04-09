<?php
// INSERT code service for tblProjectShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST 
 {
 $projectID=$_POST['projectid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"INSERT INTO `tblProjectShift` (`ProjectID`,`ShiftID`) VALUES ('$projectID','$shiftID')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
