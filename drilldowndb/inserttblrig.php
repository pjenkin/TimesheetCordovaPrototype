<?php
// INSERT code service for tblrig - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST 
 {
 $rigCode=$_POST['rigcode'];     
 $rigDescription=$_POST['rigdescription'];     
 $q=mysqli_query($connection,"INSERT INTO `tblrig` (`RigCode`,`RigDescription`) VALUES ('$rigCode','$rigDescription')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
