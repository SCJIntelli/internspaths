<?php
// Initialize the session
session_start();
// Define variables and initialize with empty values


// Check if the user is already logged in, if yes then redirect him to welcome page


// Include config file
require_once "config.php";
$username = $usertype= "";
$username_err = $email_err =  "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($email_err)){
        // Prepare a select statement
        $sql = "SELECT id,usertype,email FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                $result = mysqli_stmt_get_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_num_rows($result) == 1){ 
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $dbemail= $row["email"];
                                $id=$row["id"];
                                if($email==$dbemail){
                                    mysqli_stmt_close($stmt);
                                    header("location: reset-password.php?id=$id");

                                }
                                else{
                                    $email_err="Email does't match with username";
                                }
                    }
                else{
                    // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
        // Close statement
            mysqli_stmt_close($stmt);
        }
        
    // Close connection
        mysqli_close($link);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>InternsPaths</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
        <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
        <!--===============================================================================================-->
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
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>

    <body>
     <div class="limiter">
      <div class="container-login100" style="background-image: url('../images/bg-01.jpg')" >
       <!-- <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30"> -->
        <div class="wrapper" style="background-color: white;border-radius: 25px;">
            <span class="login100-form-title ">
              Reset Password
          </span>

          <p>Fill to reset your password.</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" style="border-radius: 25px">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" style="border-radius: 25px">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="login100-form-btn" class="btn btn-primary"  value="Reset Password">
            </div>
            <p style="text-align: center;"><span class="txt1">
                Don’t remember details?
            </span> <a href="register.php" class="txt2"><br>Contact an Admin Now</a>.</p>
        </form>
        <!--     </div> -->    
    </div>
</div>
</div>
</body>
</html>

