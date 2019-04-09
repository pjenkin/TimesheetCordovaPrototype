<?php
// DELETE code service for tblOperator - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['operatorid']))        // if HTTP request is of type GET and possesses argument operatorid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $operatorID=$_GET['operatorid'];
 $q=mysqli_query($connection,"delete from `tblOperator` where `OperatorID`='$operatorID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


