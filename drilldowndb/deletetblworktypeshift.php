<?php
// DELETE code service for tblWorkTypeShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['worktypeshiftid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $WorkTypeShiftID=$_GET['worktypeshiftid'];
 $q=mysqli_query($connection,"delete from `tblWorkTypeShift` where `WorkTypeShiftID`='$workTypeShiftID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


