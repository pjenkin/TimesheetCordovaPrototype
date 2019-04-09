<?php
// INSERT code service for tblWorkType - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)

// need to make sure SQL injection / proper escaping is carried out
// bind parameters http://bobby-tables.com/php
// maybe use PDO


 include "drilldowndbconnect.php";
 if(isset($_POST['insert']))        // if HTTP request is of type POST 
 {
 $workTypeCode=$_POST['worktypecode'];
 $workTypeDescription=$_POST['worktypedescription'];
 $q=mysqli_query($connection,"INSERT INTO `tblWorkType` (`workTypeCode`,`workTypeDescription`) VALUES ('$workTypeCode','$workTypeDescription')");
     // apostrophes on values??
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
