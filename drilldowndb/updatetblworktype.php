<?php
// UPDATE code service for tblWorkType - PNJ 27/7/17 (after https://codesundar.com/lesson/phonegap-php-mysql-example/)
 include "drilldowndbconnect.php";
 
 if(isset($_POST['update']))        // if HTTP request is of type POST 
 {
 $workTypeID=$_POST['worktypeid'];
 $workTypeCode=$_POST['worktypecode'];
 $workTypeDescription=$_POST['worktypedescription'];
 $q=mysqli_query($connection,"UPDATE `tblWorkTypeShift` SET `WorkTypeCode`='$workTypeCode', `WorkTypeDescription`='$workTypeDescription',  WHERE `WorkTypeID`='$workTypeID'");
 if($q)
 echo "success";
 else
 echo "error";
 }
 ?>

