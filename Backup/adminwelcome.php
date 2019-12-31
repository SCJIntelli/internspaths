<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$username = $password = $confirm_password = $Email= $userType="";
$username_err = $password_err = $confirm_password_err =$email_err=$_SESSION["result"]= "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This Email is already taken.";
                } else{
                    $Email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    $userType = "Admin";
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($email_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password,usertype,email) VALUES (?, ?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password,$param_userType,$param_email);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_userType = $userType;
            $param_email = $Email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               mysqli_stmt_close($stmt);
               $sql = "SELECT id FROM users WHERE username='$username'";
               $result = mysqli_query($link, $sql);
               $row = mysqli_fetch_assoc($result);
               $id=$row["id"];
                               //header("location: adminwelcome.php");
               $sql = "INSERT INTO admindata (id,username,email) VALUES ('$id','$username','$Email')";
               if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_execute($stmt);
                mysqli_close($link);
            }
        }} else{
            echo "Something went wrong. Please try again later.";
            mysqli_close($link);
        }
    }

        // Close statement

}

    // Close connection


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
<div style=" position:relative;left: 50%;width: 50%;top: -5%; max-height: 500px">

    <div class="btn " >
        <button class="login100-form-btn" class="btn btn-primary" onclick="addAdminBtn()">Add Admin</button>
    </div>
    <div class="btn " >
        <button class="login100-form-btn" class="btn btn-primary" onclick="adminEditBtn()">Edit Profile Info</button>
    </div>
    <div class="btn " >
        <button class="login100-form-btn" class="btn btn-primary" onclick="manageStudentsBtn()">Manage Students</button>
    </div>
    <div id="addAdminForm"  style="visibility: hidden;">

        <div class="limiter" >
            <div class="container-addadmin" >
                <div class="wrapper" style="background-color: white;border-radius: 25px; width: 80% ;" >
                    <br><br>
                    <h2 style="text-align:center;font-family: Poppins-Bold;font-size:39px ;">Add New Admin</h2><br>
                    <p style="text-align:center">Please fill this form to create an admin account.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"><br>
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label >Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"required oninvalid="this.setCustomValidity('Enter User Name Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"required oninvalid="this.setCustomValidity('Enter Password Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" style="border-radius: 25px;width: 50%;position: relative;left: 150px;"required oninvalid="this.setCustomValidity('Enter Password Here Again')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="Email" name="email" class="form-control" value="<?php echo $Email; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"required oninvalid="this.setCustomValidity('Enter Your Email Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group"style="align">
                            <br><br>
                            <input type="submit"  class="login100-form-btn"   value="Submit" style="width: 45% ; position: relative;left: 5%">
                            <input type="reset" class="login100-form-btn" value="Reset" style="width: 45%;position:relative; top:-50px;left:50%"  >
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="editAdminForm" style="visibility: hidden;position: relative;top: -560px">
        <div class="limiter" >
            <div class="container-addadmin" >
                <div class="wrapper" style="background-color: white;border-radius: 25px; width: 80% ;" >
                    <br><br>
                    <h2 style="text-align:center;font-family: Poppins-Bold;font-size:39px ;">Edit Profile Data</h2><br>
                    <p style="text-align:center">Please Fill This Form to Complete Your Profile.</p>
                    <form action="editadminHnd.php" method="post" ><br>
                        <div class="form-group ">
                            <label >Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $_SESSION["name"]; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;" required oninvalid="this.setCustomValidity('Enter Your Name Here')"
                            oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="form-group">
                            <label >Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $_SESSION["username"]; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"readonly required>

                        </div>

                        <div class="form-group ">
                            <label>Email</label>
                            <input type="Email" name="email" class="form-control" value="<?php echo $_SESSION["email"]; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"readonly required>

                        </div>
                        <div class="form-group ">
                            <label >Mobile Number</label>
                            <input type="text" name="mnumber" class="form-control" value="<?php echo $_SESSION["mnumber"]; ?>"style="border-radius: 25px;width: 50%;position: relative;left: 150px;"required oninvalid="this.setCustomValidity('Enter Your Mobile Number Here')"
                            oninput="this.setCustomValidity('')">

                        </div>

                        <div class="form-group"style="align">
                            <br><br>
                            <input type="submit"  class="login100-form-btn"   value="Submit" style="width: 45% ; position: relative;left: 5%">
                            <input type="reset" class="login100-form-btn" value="Reset" style="width: 45%;position:relative; top:-50px;left:50%"  >
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="manageStudents" style="visibility: hidden;position: relative;top: -1120px">
        <div class="limiter" >
            <div class="container-addadmin" >
                <div class="wrapper" style="background-color: white;border-radius: 25px; width: 80% ;" >
                    <br><br>
                    <h2 style="text-align:center;font-family: Poppins-Bold;font-size:39px ;">Manage Student Data</h2><br>
                    <p style="text-align:center">Select the Function You Need to Execute</p>
                    <form action="../handlers/searchStuHnd.php" method="post">
                        <div>
                            <select name="stype">
                              <option value="username">Name</option>
                              <option value="index">Index</option>
                              <option value="department">Department</option>
                              <option value="uni">University</option>
                          </select>
                          <div class="form-group ">
                            <label ></label>
                            <input type="text" name="stext" class="form-control" value="Enter Data to Search"style="border-radius: 25px;width: 50%;position: relative;left: 150px;" required oninvalid="this.setCustomValidity('Enter Your Name Here')"
                            oninput="this.setCustomValidity('')" >
                        </div>

                        <div class="btn">
                        <input type="submit" class="login100-form-btn" class="btn btn-primary" name="submit" value="Search Student">
                    </div>
                    </div>
                </form>



                <form action="studata.php" method="post">
                <div class="btn " >
                    <button class="login100-form-btn" class="btn btn-primary" >View All Students</button>
                </div>
            </form>
               
                <br><br>


            </div>
        </div>
    </div>
</div>
</div>

<div id="viewProfile" style="align-content: center;position: absolute;left: 15%; top:20%">
    <span class="login100-form-avatar">
        <img src="<?php echo $_SESSION["profileurl"]; ?>" alt="AVATAR">
    </span>
    <span class="profiletext">
        User Name : <?php echo ($_SESSION["username"]);?><br>
    </span>
    <span class="profiletext">
        Email : <?php echo ($_SESSION["email"]);?><br>
    </span>
    <span class="profiletext">
        User Type : <?php echo ($_SESSION["usertype"]);?><br>
    </span>
    <span class="profiletext">
        Name : <?php echo ($_SESSION["name"]);?><br>
    </span>
    <span class="profiletext">
        Mobile Number: <?php echo ($_SESSION["mnumber"]);?>
    </span>

</div>
<div style="position: absolute;top: 300px;left:450px">
    <form action="uploadimageHnd.php" method="post" enctype="multipart/form-data">

        <input  type="file"  name="fileToUpload" id="fileToUpload" >
        <input type="submit" class="login100-form-btn" value="Click to Change Image" name="submit">
    </form>
</div>





</body>

<script >
    function addAdminBtn() {
      var x = document.getElementById("addAdminForm");
      var y = document.getElementById("editAdminForm");
      var z = document.getElementById("manageStudents");
      if (x.style.visibility === "hidden") {
        x.style.visibility= "visible";
        y.style.visibility = "hidden";
        z.style.visibility = "hidden";
    } else {
        x.style.visibility = "hidden";
    }
}
function adminEditBtn() {
  var x = document.getElementById("editAdminForm");
  var y = document.getElementById("manageStudents");
  var z = document.getElementById("addAdminForm");
  if (x.style.visibility === "hidden") {
    x.style.visibility= "visible";
    y.style.visibility = "hidden";
    z.style.visibility = "hidden";

} else {
    x.style.visibility = "hidden";
}
}
function manageStudentsBtn() {
  var x = document.getElementById("manageStudents");
  var z = document.getElementById("addAdminForm");
  var y = document.getElementById("editAdminForm");
  if (x.style.visibility === "hidden") {
    x.style.visibility= "visible";
    y.style.visibility = "hidden";
    z.style.visibility = "hidden";

} else {
    x.style.visibility = "hidden";
}
}

</script>
</html>