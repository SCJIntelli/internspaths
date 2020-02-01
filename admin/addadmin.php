<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "../php/config.php";


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
                header("location: manageadmin.php");
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
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>InternsPaths | Admin Console</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index.html" class="site_title"><i class="fa fa-mortar-board"></i> <span>InternsPaths Administrator Console</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $_SESSION["profileurl"]; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <a href="viewadmin.php?id=<?php echo $_SESSION["id"]?>"><h2><?php echo ($_SESSION["name"]);?></h2></a>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Administrators <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="editmyprofile.php?id=<?php echo $_SESSION["id"]?>">Edit My Profile</a></li>
                      <li><a href="addadmin.php">Add Administrators</a></li>
                      <li><a href="manageadmin.php">Manage Administrators</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="managestudent.php">Manage Students</a></li>
                      <li><a href="addstudent.php">Add a New Student</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Companies <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="managecompany.php">Manage Companies</a></li>
                      <li><a href="addcompany.php">Add a New Company</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

           
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION["profileurl"]; ?>" alt=""><?php echo ($_SESSION["name"]);?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="../php/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="col-md-12 col-sm-12" style="display: inline-block;" >

<div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Administrator</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required oninvalid="this.setCustomValidity('Enter User Name Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required oninvalid="this.setCustomValidity('Enter Password Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"> Confirm Password </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required oninvalid="this.setCustomValidity('Enter Password Here Again')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align"> Email </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="Email" name="email" class="form-control" value="<?php echo $Email; ?>"required oninvalid="this.setCustomValidity('Enter Your Email Here')"
                            oninput="this.setCustomValidity('')">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <a href="index.php">
                          <button class="btn btn-primary" type="button">Back</button>
                          </a>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
         
          </div>
        </div>
          <!-- /top tiles -->

          <!-- /////////////contend///////// -->

          <!-- /////////////contend///////// -->



      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>
