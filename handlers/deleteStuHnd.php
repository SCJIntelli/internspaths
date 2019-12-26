<?php
session_start();
require_once "../php/config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$udelete = trim($_POST["username"]);
	$sql = "DELETE FROM users WHERE username='$udelete'";
	echo $sql;
	mysqli_query($link, $sql);
	mysqli_close($link);
	header("location: ../php/adminwelcome.php");
}

?>

