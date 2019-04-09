<?php
// DELETE code service for tblProject - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 

if(isset($_GET['projectid']))        // if HTTP request is of type GET and possesses argument projectid 
 {      // SHOULD THIS BE *POST* instead of GET ??
 $projectID=$_GET['projectid'];
 $q=mysqli_query($connection,"delete from `tblProject` where `ProjectID`='$projectID'");
 if($q)
 echo "success";
 else
 echo "error";

?>


