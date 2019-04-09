<?php
// DELETE code service for tblRigShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['rigshiftid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $rigShiftID=$_GET['rigshiftid'];
 $q=mysqli_query($connection,"delete from `tblRigShift` where `RigShiftID`='$rigShiftID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


