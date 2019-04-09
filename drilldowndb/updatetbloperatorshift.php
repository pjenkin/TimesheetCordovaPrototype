<?php
// UPDATE code service for tblOperatorShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $operatorShiftID=$_POST['operatorshiftid'];
 $operatorID=$_POST['operatorid'];
 $shiftID=$_POST['shiftid'];     
 $q=mysqli_query($connection,"UPDATE `tblOperatorShift` SET `OperatorID`='$workHours',`ShiftID`='$shiftID' where `OperatorShiftID`='$operatorShiftID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>
