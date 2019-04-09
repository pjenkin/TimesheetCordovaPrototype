<?php
header("Access-Control-Allow-Origin: *");       // allow all origin-points of connections - https://www.w3schools.com/php/func_http_header.asp / https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
$connection = mysqli_connect("localhost","guidegaz_drilldb","1720demo","guidegaz_drilldowndb") or die("PHP (database) mysql_connect attempt failed");
?>