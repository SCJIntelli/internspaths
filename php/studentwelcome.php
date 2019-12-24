<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
</head>
<body style="background-image: url('back2.png');background-size:cover; ">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Your <b><?php echo htmlspecialchars($_SESSION["usertype"]); ?></b> Control Center.</h1>
    </div>
    <div style="position: relative;top: -60px;left:75%;width: 25%;">
         <p>

            <a href="reset-password.php"  class="btn btn-warning">Reset Your Password</a>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p> 
    </div>
    <div style=" position:relative;left: 50%;width: 50%;top: -5%">

    <div class="btn " >
        <button class="login100-form-btn" class="btn btn-primary" onclick="addAdminBtn()">Make your profile</button>
    </div>
    <div id="addAdminForm"  style="display: none;">
        <?php
// Include config file
        require_once "config.php";

// Define variables and initialize with empty values
        $fullname = $password = $confirm_password = $Email= $userType=$Description="";
        $fullname_err = $password_err = $confirm_password_err =$email_err=$discri_err= "";

// Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
            if(empty(trim($_POST["username"]))){
                $fullname_err = "Please enter your fullname.";
            } else{
        // Prepare a select statement
                $sql = "SELECT id FROM users WHERE username = ?";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
                    $param_fullname = trim($_POST["fullname"]);

            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $fullname_err = "This fullname is already taken.";
                        } else{
                            $fullname = trim($_POST["fullname"]);
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
            
            $userType = "Admin";
    // Check input errors before inserting in database
            if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($email_err)){

        // Prepare an insert statement
                $sql = "INSERT INTO users (username, password,usertype,email) VALUES (?, ?,?,?)";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password,$param_userType,$param_email);

            // Set parameters
                    $param_fullname = $fullname;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_userType = $userType;
            $param_email = $Email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: adminwelcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<div class="limiter" >
    <div class="container-addadmin" >
        <div class="wrapper" style="background-color: white;border-radius: 25px; width: 750px ;" >
            <br><br>
            <h2 style="text-align:center;font-family: Poppins-Bold;font-size:39px ;"><?php echo htmlspecialchars($_SESSION["username"]); ?></h2><br>
            <p style="text-align:center">Please fill this form to make your profile.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"><br>
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <p style="text-align: left;">
                     &nbsp;&nbsp;&nbsp;Full name -
                    </p>
                    <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>"style="border-radius: 25px; width: 80% ;position: relative;right: -85px;top: -35px;">
                    <span class="help-block"><?php echo $fullname_err; ?></span>
                    
                </div>

                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <p style="text-align: left;">
                     &nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-
                    </p>
                    <input type="Email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>"style="border-radius: 25px;width: 500px;position: relative;left: 85px;top:-35px;">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <p style="text-align: left;">
                     &nbsp;&nbsp;&nbsp;Description-
                    </p>
                    <input type="text" name="Description" class="form-control" value="<?php echo $Description; ?>"style="border-radius: 25px;width: 80%;position: relative;left: 85px;top:-35px;size: ">
                    <span class="help-block"><?php echo $descri_err; ?></span>
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
</div>

</body>

<script >
    function addAdminBtn() {
      var x = document.getElementById("addAdminForm");
      if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
</html>