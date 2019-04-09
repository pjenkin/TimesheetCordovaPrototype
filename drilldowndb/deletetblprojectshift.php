<?php
// DELETE code service for tblProjectShift - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['projectshiftid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $projectShiftID=$_GET['projectshiftid'];
 $q=mysqli_query($connection,"delete from `tblProjectShift` where `ProjectShiftID`='$projectShiftID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


