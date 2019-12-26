<?php
session_start();
$stu_username="";
require_once "../php/config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$stext = trim($_POST["stext"]);
	$stype =trim($_POST["stype"]);
	$sql = "SELECT * FROM users WHERE $stype='$stext' ";
	$result = mysqli_query($link, $sql);


	mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en" style="background-image: url('../images/back2.png');background-size:cover;">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
		body{ font: 14px sans-serif; text-align: center; }
	</style>
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->  
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<!--===============================================================================================-->  
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
</head>
<body style="background-image: url('../images/back2.png');background-size:cover;" >
	<div class="page-header">
		<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Your <b><?php echo htmlspecialchars($_SESSION["usertype"]); ?></b> Control Center.</h1>
	</div>
	<div style="position: relative;top: -60px;left: 75%;width: 25%;">
		<p>

			<a href="reset-password.php"  class="btn btn-warning">Reset Your Password</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>

		</p> 


	</div>
	<a href="../php/adminwelcome.php" class="btn btn-danger">Back to control center</a>
	<?php 
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
			echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td> ".$row["email"]."</td></tr>";
			$stu_username=$row["username"];
			echo "</table>";
		}
	} else {
		echo "0 results";

	}  ?>
	<form action="deleteStuHnd.php" method="post">

	<input type="text" name="username" value="<?php echo $stu_username; ?>" style="visibility: hidden;">
	<div class="btn " >
		<button class="login100-form-btn" class="btn btn-primary" >Delete Student</button>
	</div>
</form>
	<div class="btn " >
		<button class="login100-form-btn" class="btn btn-primary" onclick="manageStudentsBtn()">Edit Student</button>
	</div>
</body>
</html>