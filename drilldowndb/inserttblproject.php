<?php
// INSERT code service for tblProject - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST  with 'insert' specified at client end
 {
 $projectDescription=$_POST['projectdescription'];
 $projectCode=$_POST['projectcode'];     
  $q=mysqli_query($connection,"INSERT INTO `tblProject` (`ProjectDescription`,`ProjectCode`) VALUES ('$projectDescription','$projectCode')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
