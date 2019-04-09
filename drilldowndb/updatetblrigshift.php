<?php
// UPDATE code service for tblRigShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $rigShiftID=$_POST['rigshiftid'];
 $rigID=$_POST['rigid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"UPDATE `tblRigShift` SET `RigID`='$rigID', `ShiftID`='$shiftID',  WHERE `RigShiftID`='$rigShiftID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>

