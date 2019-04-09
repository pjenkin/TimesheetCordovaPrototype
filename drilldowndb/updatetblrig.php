<?php
// UPDATE code service for tblrig - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)

// need to make sure SQL injection / proper escaping is carried out
// bind parameters http://bobby-tables.com/php

 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $rigID=$_POST['rigid'];
 $rigCode=$_POST['rigcode'];     
 $rigDescription=$_POST['rigdescription'];     
 $q=mysqli_query($connection,"UPDATE `tblrig` SET `RigCode`='$rigCode', `RigDescription`='$rigDescription',  WHERE `RigID`='$rigID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>

