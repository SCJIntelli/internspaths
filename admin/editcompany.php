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


$name = $email = $mnumber = "";
$name_err = $email_err = $mnumber_err = "";

$sql = "SELECT * FROM company WHERE id = ?";

if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
    $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $id=$row["id"];
                $username = $row["username"];
                $email = $row["email"];
                $name=$row["name"];
                $mnumber=$row["mobile"];
                $profileurl=$row["profileurl"];



            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }


    // Close statement
        mysqli_stmt_close($stmt);

    // Close connection

    } else{
    // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }



    if($_SERVER["REQUEST_METHOD"] == "POST"){



// Processing form data when form is submitted
        if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
            $id = $_POST["id"];

    // Validate name
            $input_name = trim($_POST["name"]);
            if(empty($input_name)){
                $name_err = "Please enter a name.";
                echo "Detected";
            } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $name_err = "Please enter a valid name.";
                echo "Detected";
            } else{
                $name = $input_name;

            }

    // Validate address address
            $input_email = trim($_POST["email"]);
            if(empty($input_email)){
                $email_err = "Please enter an address.";     
            } else{
                $email = $input_email;
            }

    // Validate salary
            $input_mnumber = trim($_POST["mnumber"]);
            if(empty($input_mnumber)){
                $mnumber_err = "Please enter the salary amount.";     
            } elseif(!ctype_digit($input_mnumber)){
                $mnumber_err = "Please enter a positive integer value.";
            } else{
                $mnumber = $input_mnumber;
            }

    // Check input errors before inserting in database
            if(empty($name_err) && empty($email_err) && empty($mnumber_err)){
        // Prepare an update statement
                $sql = "UPDATE company SET name=?, email=?, mobile=? WHERE id=?";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_mnumber, $param_id);

            // Set parameters
                    $param_name = $name;
                    $param_email = $email;
                    $param_mnumber = $mnumber;
                    $param_id = $id;

            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                        header("location: managecompany.php");
                        exit();
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }

        // Close statement

            }

    // Close connection

        } else{
    // Check existence of id parameter before processing further
            if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
                $id =  trim($_GET["id"]);

        // Prepare a select statement
                $sql = "SELECT * FROM admindata WHERE id = ?";
                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
                    $param_id = $id;

            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        $result = mysqli_stmt_get_result($stmt);

                        if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $email = $row["email"];
                    $mnumber = $row["mobile"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    echo "Detected form last";
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        
        
        // Close connection
        
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        exit();
    }
}

mysqli_close($link);
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
    <link href="css/viewprof.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../index.html" class="site_title"><i class="fa fa-paw"></i> <span>InternsPaths Administrator Console</span></a>
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
              <li><a href="form.html">Search For a Student</a></li>
              <li><a href="managestudent.php">Manage Students</a></li>
              <li><a href="addstudent.php">Add a New Student</a></li>
          </ul>
      </li>
      <li><a><i class="fa fa-desktop"></i> Companies <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="general_elements.html">Search For a Company</a></li>
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
  <div class="col-md-8 col-sm-8" style="display: inline-block;" >
    <div class="container emp-profile">
        
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" >
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="<?php echo $profileurl; ?>" alt=""/>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            <?php echo $name; ?>
                        </h5>
                        <h6>
                            Company
                        </h6>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="viewcompany.php?id=<?php echo $id?>" class="btn btn-success pull-right">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $id; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                    <span class="help-block"><?php echo $name_err;?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                    <span class="help-block"><?php echo $email_err;?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="mnumber" class="form-control" value="<?php echo $mnumber; ?>">
                                    <span class="help-block"><?php echo $mnumber_err;?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profession</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Web Developer and Designer</p>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit">
                       

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>    
    <form action="imagecom.php" method="post" enctype="multipart/form-data" style="position: relative;top:-250px; left: 10px">
         <div class="col-md-4" >
                    <div class="profile-img">
                        <div class="file btn btn-lg btn-primary" >
                            Select Image
                            <input  type="file"  name="fileToUpload" id="fileToUpload" >                          
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" class="login100-form-btn" value="Click to Change Image" name="submit"style="position: relative;top:20px; left: -210px">
        </form>       
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
