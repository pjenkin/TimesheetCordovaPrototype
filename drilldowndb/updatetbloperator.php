<?php
// UPDATE code service for tblOperator - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $operatorID=$_POST['operatorid'];
 $operatorName=$_POST['operatorname'];
 $q=mysqli_query($connection,"UPDATE `tblOperator` SET `OperatorName`='$operatorName' WHERE `OperatorID`='$operatorID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>
