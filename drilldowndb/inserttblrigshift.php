<?php
// INSERT code service for tblRigShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST 
 {
 $rigID=$_POST['rigid'];
 $shiftID=$_POST['shiftid'];
 $q=mysqli_query($connection,"INSERT INTO `tblRigShift` (`RigID`,`ShiftID`) VALUES ('$rigID','$shiftID')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
