<?php
include('config.php');
session_start();
$check=$_SESSION['ekaksha'];
$session=mysqli_query($conn, "SELECT user_id FROM user WHERE email='$check' ");
$row=mysqli_fetch_array($session, MYSQL_ASSOC);
$ekaksha_session=$row['user_id'];
if(!isset($ekaksha_session))
{
header("Location:accessdenied.php");
}

?>