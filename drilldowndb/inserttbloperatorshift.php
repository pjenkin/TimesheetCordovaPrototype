<?php
// INSERT code service for tblOperatorShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST  with 'insert' specified at client end
 {
 $operatorID=$_POST['operatorid'];
 $shiftID=$_POST['shiftid'];     
  $q=mysqli_query($connection,"INSERT INTO `tblOperatorShift` (`OperatorID`,`ShiftID`) VALUES ('$operatorID','$shiftID')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
