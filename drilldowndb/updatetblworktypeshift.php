<?php
// UPDATE code service for tblWorkTypeShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $workTypeShiftID=$_POST['worktypeshiftid'];
 $workTypeID=$_POST['worktypeid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"UPDATE `tblWorkTypeShift` SET `WorkTypeID`='$workTypeID',`ShiftID`='$shiftID' where `WorkTypeShiftID`='$workTypeShiftID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>
