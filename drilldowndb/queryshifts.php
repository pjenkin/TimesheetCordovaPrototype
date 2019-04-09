<?php
// after https://codesundar.com/lesson/phonegap-php-mysql-example/ - PHP step 5
include "drilldowndbconnect.php";
$data=array();
$q=mysqli_query($con,"select * from ``"); // ahhh - need to do this for every PHP query?
while ($row=mysqli_fetch_object($q)){
 $data[]=$row;
}
echo json_encode($data);
?>
