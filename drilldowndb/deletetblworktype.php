<?php
// DELETE code service for tblWorkType - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['worktypeid']))        // if HTTP request is of type GET and possesses argument worktypeshiftid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $workTypeID=$_GET['worktypeid'];
 $q=mysqli_query($connection,"delete from `tblWorkType` where `WorkTypeID`='$workTypeid'");
 if($q)
 echo "success";
 else
 echo "error";

?>


