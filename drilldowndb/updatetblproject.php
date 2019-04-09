<?php
// UPDATE code service for tblProject - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $projectID=$_POST['projectid'];
 $projectDescription=$_POST['projectdescription'];
 $projectCode=$_POST['projectcode'];     
 $q=mysqli_query($connection,"UPDATE `tblProject` SET `ProjectDescription`='$projectDescription',`ProjectCode`='$projectCode' WHERE `ProjectID`='$projectID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>
