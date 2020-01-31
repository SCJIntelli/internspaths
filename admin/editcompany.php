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


$name = $email = $mnumber =$error= "";
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
                $address=$row["address"];
                $descrip=$row["description"];
                $location=$row["location"];
                $facebook=$row["facebook"];
                $linkedin=$row["linkedin"];
                $twitter=$row["twitter"];
                $fields=$row["fields"];
                $mission=$row["mission"];
                $vision=$row["vision"];
                $curemail=$email;


            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                exit();
            }
            
        } else{
            header("location: error.php?id=$id & return=editcompany.php & error=Please Try Again ");
        }


    // Close statement
        mysqli_stmt_close($stmt);

    // Close connection

    } else{
    // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php?id=$id & return=editcompany.php & error=Please Try Again ");
        exit();
    }



    if($_SERVER["REQUEST_METHOD"] == "POST"){



// Processing form data when form is submitted
        if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
            $id = $_POST["id"];
            $address=$_POST["address"];

    // Validate name
            $input_name = trim($_POST["name"]);
            if(empty($input_name)){
                $name_err = "Please enter a name.";
            } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $name_err = "Please enter a valid name.";
            } else{
                $name = $input_name;

            }

    // Validate address address
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
                            $email = trim($_POST["email"]);
                            mysqli_stmt_close($stmt);


                            $sql = "INSERT INTO users (email) VALUES ('$email')";
                            if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_execute($stmt);
                            }
                         else{
                            $email_err= "Oops! Something went wrong. Please try again later.";
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }

    $input_mnumber = trim($_POST["mnumber"]);
                if(empty($input_mnumber)){
                    $mnumber_err = "Please enter the Mobile Number.";     
                } 
                elseif(preg_match('/^\d{10}$/',$input_mnumber)){
                    $mnumber = $input_mnumber;
                } else{
                    $mnumber_err = "Please enter a valid mobile number.(0123456789)";

                    
                }
    $description = trim($_POST["descrip"]);
    $location = trim($_POST["location"]);
    $facebook = trim($_POST["facebook"]);
    $linkedin = trim($_POST["linkedin"]);
    $twitter = trim($_POST["twitter"]);
    $fields = trim($_POST["fields"]);
    $mission = trim($_POST["mission"]);
    $vision = trim($_POST["vision"]);

    // Check input errors before inserting in database
            if(empty($name_err) && empty($email_err) && empty($mnumber_err)){
        // Prepare an update statement
                $sql = "UPDATE company SET name=?, email=?, mobile=?,address=? WHERE id=?";

                if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssssssssssi", $param_name, $param_email, $param_mnumber,$param_address ,$param_description,$param_location,$param_facebook,$param_linkedin,$param_twitter,$param_fields,$param_mission,$param_vision, $param_id);

            // Set parameters
                    $param_name = $name;
                    $param_email = $email;
                    $param_mnumber = $mnumber;
                    $param_id = $id;
                    $param_address=$address;
                    $param_description=$description;
                    $param_location=$location;
                    $param_facebook=$facebook;
                    $param_linkedin=$linkedin;
                    $param_twitter=$twitter;
                    $param_fields=$fields;
                    $param_mission=$mission;
                    $param_vision=$vision;



            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                        header("location: managecompany.php");
                        exit();
                    } else{
                      $error.= "Something went wrong. Please try again later.";
                      header("location: error.php?id=$id & return=editcompany.php & error=$error ");
                    }
                }
                else{
                    $error.="Connection Error";
                    header("location: error.php?id=$id & return=editcompany.php & error=$error ");
                }
            }
            else{
                $error.=$name_err.=$mnumber_err.=$email_err;
                header("location: error.php?id=$id & return=editcompany.php & error=$error ");
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
        <!-- <style type="text/css">
            .circular--portrait {
      position: relative;
      width: 200px;
      height: 200px;
      overflow: hidden;
      border-radius: 50%;
    }

    .circular--portrait img {
      width: 100%;
      height: auto;
    }
    </style> -->

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

<body class="nav-md" >
    <div class="container body" style="height: 780px">
      <div class="main_container">
        <div class="col-md-3 left_col" style="height: 790px" >
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
<div class="right_col" role="main" style="height: 790px">
  <div class="col-md-12 col-sm-12" style="display: inline-block;">
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-head" >

                    <h5>
                        <?php echo $name; ?> 
                    </h5>
                    <!-- <h6>
                        Company
                    </h6>
 -->
                </div>
                <div class="circular--portrait ">
                    <img src="<?php echo $profileurl; ?>" class="col-md-12" alt="" style="border-radius: 50%; max-width: 500px;max-height: 500px;width: 350px;height: 350px;"/>
                </div>  
                <br><br><br>
                <div class="col-md-12 ">
                    <form  action="imagecom.php" method="post" enctype="multipart/form-data"  >
                       <div class="" >
                        <div class="profile-img">
                            <div class="file btn-primary  " style="margin-left: auto;margin-right: auto;" >
                                Add Logo
                                <input  type="file"  name="fileToUpload" id="fileToUpload" >                          
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn-primary btn  col-md-12 col-sm-12 pull-right"  value="Click to Change Logo" name="submit" >
                </form>
            </div>
        </div>
        <div class="col-md-8">

            <div class="col-md-12" >
                <a href="index.php?id=<?php echo $id?>" class="btn btn-success pull-right">Back</a>
            </div>
            <br><br><br>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" >
            <div class="row">
                

                
                
            </div>
            <div class="row">
                
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >User ID <span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="id" required="required" class="form-control " value="<?php echo $id ?>" readonly>
                              </div>
                          </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >User Name <span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="username" name="username"  required="required" class="form-control " value="<?php echo $username ?>" readonly>
                              </div>
                          </div> -->
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >Name <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="name" name="name"  required="required" class="form-control " value="<?php echo $name ?>" >
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >Email <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="email" id="email" name="email" required="required" class="form-control " value="<?php echo $email ?>" >
                              </div>
                          </div>
                        <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >Mobile Number <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="mnumber" name="mnumber" required="required" class="form-control " value="<?php echo $mnumber ?>" >
                              </div>
                          </div>
                        <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >Address <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="address" name="address" required="required" class="form-control " value="<?php echo $address ?>" >
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >description <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <textarea class="resizable_textarea form-control" name="descrip" value="<?php echo $descrip ?>"  spellcheck="false"><?php echo $descrip ?></textarea>
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >vision <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <textarea class="resizable_textarea form-control" name="vision" placeholder="enter your vision statement" value="<?php echo $vision ?>"  spellcheck="false"><?php echo $vision ?></textarea>
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >mission <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <textarea class="resizable_textarea form-control" name="mission" placeholder="enter your mission statement" value="<?php echo $mission ?>"  spellcheck="false"><?php echo $mission ?></textarea>
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >skill requirnments <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="fields" name="fields"  class="form-control " placeholder="eg: machine learning,javascript,.." value="<?php echo $fields ?>" >
                              </div>
                          </div>

                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" ><li style="display: inline;"><strong><i style="font-size: 30px" class="fa fa-map-marker"></i></a></strong></li> <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="location" name="location" required="required" placeholder="www.example.com" class="form-control " value="<?php echo $location ?>" >
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" ><li style="display: inline;"><strong><i style="font-size: 30px" class="fa fa-facebook-square"></i></a></strong></li> <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="facebook" name="facebook" placeholder="www.example.com" class="form-control " value="<?php echo $facebook ?>" >
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" ><li style="display: inline;"><strong><i style="font-size: 30px" class="fa fa-linkedin-square"></i></a></strong></li> <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="linkedin" name="linkedin" placeholder="www.example.com"class="form-control " value="<?php echo $linkedin ?>" >
                              </div>
                          </div>
                          <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" ><li style="display: inline;"><strong><i style="font-size: 30px" class="fa fa-twitter-square"></i></a></strong></li> <span class="required"></span>
                                </label>
                                <div class="col-md-12 col-sm-8 ">
                                  <input type="text" id="twitter" name="twitter" placeholder="www.example.com" class="form-control " value="<?php echo $twitter ?>" >
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
