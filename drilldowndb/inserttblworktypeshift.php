<?php
// INSERT code service for tblWorkTypeShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST 
 {
 $workTypeID=$_POST['worktypeid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"INSERT INTO `tblWorkTypeShift` (`WorkTypeID`,`ShiftID`) VALUES ('$workTypeID','$shiftID')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
