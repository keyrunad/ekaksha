<?php
$mysql_hostname = "localhost";
$mysql_user = "ekaksha";
$mysql_password = "asdfghjkl!@#123";
$mysql_database = "ekaksha";
$conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Something went wrong.");
mysqli_select_db($conn, $mysql_database) or die("Opps some thing went wrong");
?>