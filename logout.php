<?php
session_start();
unset($_SESSION['ekaksha']);
header("Location: /ekaksha/index.php");
?>