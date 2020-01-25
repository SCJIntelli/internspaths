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
$username = $email= $name= $mnumber="";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = trim($_SESSION["id"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $name = trim($_POST["name"]);
    $mnumber = trim($_POST["mnumber"]);


    ///////search for user name
    $sql = "SELECT id FROM admindata WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
        $param_username = $username;
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $sql = "UPDATE admindata SET name =?, mobile=? WHERE username=?";
                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sss", $param_name,$param_mnumber,$param_username);

            // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_name = $name;
                    $param_mnumber=$mnumber;
                    $param_id=$id;


            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                        $_SESSION["name"]=$name;
                        $_SESSION["mnumber"]=$mnumber;
                        header("location: editmyprofile.php");

                    } else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
                }

        // Close statement
                mysqli_stmt_close($stmt);


    // Close connection
                mysqli_close($link);

            }
            else{
                $sql = "INSERT INTO admindata (id,username,email,name,mobile) VALUES (?, ?,?,?,?)";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "issss", $param_id, $param_username,$param_email,$param_name,$param_mnumber);

            // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_name = $name;
                    $param_mnumber=$mnumber;
                    $param_id=$id;


            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                        $_SESSION["name"]=$name;
                        $_SESSION["mnumber"]=$mnumber;
                        header("location: editmyprofile.php");

                    } else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
                }

        // Close statement
                mysqli_stmt_close($stmt);
            }

    // Close connection
            mysqli_close($link);

        }

    }
}
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
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>InternsPaths Administrator Console</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $_SESSION["profileurl"]; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ($_SESSION["name"]);?></h2>
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
                      <li><a href="editmyprofile.php">Edit My Profile</a></li>
                      <li><a href="addadmin.php">Add Administrators</a></li>
                      <li><a href="manageadmin.php">Manage Administrators</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Search For a Student</a></li>
                      <li><a href="form_advanced.html">Manage Students</a></li>
                      <li><a href="addstudent.php">Add a New Student</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Companies <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">Search For a Company</a></li>
                      <li><a href="media_gallery.html">Manage Companies</a></li>
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
         
<div id="editAdminForm" style="">
        <div class="limiter" >
            <div class="container-addadmin" >
                <div class="wrapper" style="background-color: white;border-radius: 25px; width: 80% ;" >
                    <br><br>
                    <h2 style="text-align:center;font-family: Poppins-Bold;font-size:39px ;">Edit Profile Data</h2><br>
                    <p style="text-align:center">Please Fill This Form to Complete Your Profile.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-label-left input_mask"><br>
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
                            <input type="reset" class="login100-form-btn" value="Reset" style="width: 45%;position:relative;"  >
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
