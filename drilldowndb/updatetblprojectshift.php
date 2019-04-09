<?php
// UPDATE code service for tblProjectShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $projectShiftID=$_POST['projectshiftid'];
 $projectID=$_POST['projectid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"UPDATE `tblProjectShift` SET `ProjectID`='$projectID', `ShiftID`='$shiftID',  WHERE `ProjectShiftID`='$projectShiftID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>

