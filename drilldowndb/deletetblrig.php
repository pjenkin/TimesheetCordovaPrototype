<?php
// DELETE code service for tblrig - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['rigid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $rigID=$_GET['rigid'];
 $q=mysqli_query($connection,"delete from `tblrig` where `RigID`='$rigID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


