<?php
// DELETE code service for tblShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['shiftid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $shiftID=$_GET['shiftid'];
 $q=mysqli_query($connection,"delete from `tblShift` where `ShiftID`='$shiftID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


