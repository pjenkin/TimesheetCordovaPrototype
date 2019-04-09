<?php
// DELETE code service for tblOperatorShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['operatorshiftid']))        // if HTTP request is of type GET and possesses argument operatorshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $operatorShiftID=$_GET['operatorshiftid'];
 $q=mysqli_query($connection,"delete from `tblOperatorShift` where `OperatorShiftID`='$operatorShiftID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


