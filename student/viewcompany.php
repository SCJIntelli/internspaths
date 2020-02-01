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
$id = $_SESSION["id"];
$sql = "SELECT * FROM student WHERE id = ?";
if($stmt = mysqli_prepare($link,$sql)){
  mysqli_stmt_bind_param($stmt,"i",$param_id);
  $param_id = $id;

   if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
           $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $username = $row["username"];
                $email = $row["email"];
                $name=$row["name"];
                $lname=$row["lastname"];
                $mnumber=$row["mobile"];
                $profileurl=$row["profileurl"];
                $address=$row["address"];
                $gender=$row["gender"];
                $linkin = $row["linkedin"];
                $perweb = $row["personalweb"];
                $descrip = $row["descrip"];
                $field =$row["field"];
                $gpa = $row["gpa"];
                $cvurl = $row["cvurl"];

                



        }
    }
}
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
                 $cusername = $row["username"];
                 $cemail = $row["email"];
                 $cname=$row["name"];
                 $ccomnum=$row["comnum"];
                 $cprofileurl=$row["profileurl"];
                 $caddress=$row["address"];
                 $cmnumber=$row["mobile"];
                 $cid=$row["id"];
                 $cdescrip=$row["description"];
                 $clocation=$row["location"];
                 $cfacebook=$row["facebook"];
                 $clinkedin=$row["linkedin"];
                 $ctwitter=$row["twitter"];
                 $cfields=$row["fields"];
                 $cmission=$row["mission"];
                 $cvision=$row["vision"];



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
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
        <title>InternsPaths</title>

        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>


        
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>InternsPaths | <?php echo $name." ".$lname ?></title>
 <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
  <!-- Bootstrap core CSS -->

  <!-- Font Awesome CSS -->

  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
  <!-- Animate css -->
  <link href="../assets/css/animate.css" rel="stylesheet">
  <!-- Magnific css -->
  <link href="../assets/css/magnific-popup.css" rel="stylesheet">
  <!-- Custom styles CSS -->
  <link href="../assets/css/style.css" rel="stylesheet" media="screen">
  <!-- Responsive CSS -->
  <link href="../assets/css/responsive.css" rel="stylesheet">

  <link rel="shortcut icon" href="assets/images/ico/favicon.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/images/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/images/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/images/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="../assets/images/ico/apple-touch-icon-57-precomposed.png">
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
  <div class="container body" style="height:1000px;">
    <div class="main_container">
      <div class="col-md-3 left_col" style="height:1000px;">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="../index.php" class="site_title"><i class="fa fa-paw"></i> <span>InternsPaths</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo $profileurl ?>" alt="..." class="img-circle profile_img" style="width:50px; height: 50px">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <a href="../index.php?id=<?php echo $_SESSION["id"]?>"><h2 style = "font-size: 14px; color: #ECF0F1; margin: 0;font-weight: 300; font-family: Arial; text-transform: unset;"><?php echo $name." ".$lname?></h2></a>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <!-- <li class="active"><a><i class="fa fa-beer"></i> Console <span class="fa fa-chevron-down"></span></a> -->
                <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="editmyprofile.php?id=<?php echo $_SESSION["id"]?>"><i class="fa fa-cogs"></i>Edit My Profile</a></li>
                <li class="active"><a href="searchcompanies.php"><i class="fa fa-search"></i>Search Companies</a></li>
                <li><a href="viewrequests.php"><i class="fa fa-send"></i>Sent Requests</a></li>
                <li><a href="receivedrequests.php"><i class="fa fa-bell"></i>Received Requests</a></li>
                <li><a href="security.php"><i class="fa fa-lock"></i>Security</a></li>
                  <!-- <ul class="nav child_menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="editmyprofile.php?id=<?php echo $_SESSION["id"]?>">Edit My Profile</a></li>
                    <li><a href="searchcompany.php">Search Companies</a></li>
                    <li><a href="manageadmin.php">Manage Administrators</a></li> -->

                  </ul>
                </li>
                <!-- <li><a><i class="fa fa-edit"></i> Students <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="form.html">Search For a Student</a></li>
                    <li><a href="form_advanced.html">Manage Students</a></li>
                    <li><a href="addstudent.php">Add a New Student</a></li>
                  </ul>
                </li> -->
                <!-- <li><a><i class="fa fa-desktop"></i> Companies <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="general_elements.html">Search For a Company</a></li>
                    <li><a href="managecompany.php">Manage Companies</a></li>
                    <li><a href="addcompany.php">Add a New Company</a></li>
                  </ul>
                </li> -->

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
                  <img src="<?php echo $profileurl ?>" alt=""><?php echo $name." ".$lname?>
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
        <div class="col-md-12" >
            <a href="searchcompanies.php" class="btn btn-success pull-right">Back</a>
            <a href="applyconfirmation.php?id=<?php echo $cid ?>" class="btn btn-success pull-right">Apply</a>
            
        </div>
        <!-- top tiles -->
        <div class="row" style="display: inline-block;" >
          <section id="about" class="about-section col-md-12" style="margin-left: auto;margin-right: auto;">
            <div class="container  ">
              <h2 class="section-title wow fadeInUp animated col-md-12" style="visibility: visible; animation-name:fadeInUp; "><?php echo $cname ?></h2>

              <div class="row">

                <div class="col-md-4 col-md-push-8">
                  <div class="biography">
                    <div class="">
                      <img src=<?php echo $cprofileurl ?> >
                    </div>
                    <ul>
                      <li><strong>Name: </strong> <?php echo $cname?></li>

                      <li ><strong>Address: </strong><?php echo $caddress?></span></li>

                      <li><strong>Contact Us:</strong> <?php echo $cmnumber?></li>
                      <li><strong>Email:</strong> <?php echo $cemail?></li>
                      <li style="display: inline;"><strong><a href=<?php echo $clocation?>><i style="font-size: 50px" class="fa fa-map-marker"></i></a></strong></li>
                      <li style="display: inline;"><strong><a href=<?php echo $cfacebook?>><i style="font-size: 50px" class="fa fa-facebook-square"></i></a></strong></li>
                      <li style="display: inline;"><strong><a href=<?php echo $clinkedin?>><i style="font-size: 50px" class="fa fa-linkedin-square"></i></a></strong></li>
                      <li style="display: inline;"><strong><a href=<?php echo $ctwitter?>><i style="font-size: 50px" class="fa fa-twitter-square"></i></a></strong></li>


                    </ul>
                  </div>
                </div> <!-- col-md-4 -->

                <div class="col-md-8 col-md-pull-4">
                  <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <h3>Our vision </h3>
                    <p>
                      <?php echo $cvision ?>
                    </p>
                  </div>
                  <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <h3>Our mission </h3>
                    <p>
                      <?php echo $cmission ?>
                    </p>
                  </div>
                  <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <h3>Who are we ?</h3>
                    <p>
                      <?php echo $cdescrip?>
                    </p>
                  </div>
                  
                  <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">

                    <h3>what are we looking for..</h3>
                    <p>
                      <?php $text=(explode(",", $cfields));?>
                      <?php
                      $sizea = sizeof($text);
                      for ($x = 0; $x < $sizea; $x+=1) {
                        echo '<p class="fa fa-angle-double-right" style="font-size:200%">  '.$text[$x]."</p><br>";
                      }

                      ?>

                    </p>
                  </div>



            <!-- <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
              <h3>What I Do ?</h3>
              <p>I have been working as a web interface designer since. I have a love of clean, elegant styling, and I have lots of experience in the production of CSS3 and HTML5 for modern websites. I loving creating awesome as per my clients’ need. I think user experience when I try to craft something for my clients. Making a design awesome.</p>

              <ul class="list-check">
                <li>User Experience Design</li>
                <li>Interface Design</li>
                <li>Product Design</li>
                <li>Branding Design</li>
                <li>Digital Painting</li>
                <li>Video Editing</li>
              </ul>
            </div> -->



            <!-- <div class="download-button">
              <a class="btn btn-primary btn-lg" target = "_blank"  href= ><i class="fa fa-download"></i>view my cv</a>
            </div> -->
          </div>


        </div> <!-- /.row -->
      </div> <!-- /.container -->
    </section>          
  </div>
</div>

            <!-- <div class="short-info wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
              <h3>What I Do ?</h3>
              <p>I have been working as a web interface designer since. I have a love of clean, elegant styling, and I have lots of experience in the production of CSS3 and HTML5 for modern websites. I loving creating awesome as per my clients’ need. I think user experience when I try to craft something for my clients. Making a design awesome.</p>

              <ul class="list-check">
                <li>User Experience Design</li>
                <li>Interface Design</li>
                <li>Product Design</li>
                <li>Branding Design</li>
                <li>Digital Painting</li>
                <li>Video Editing</li>
              </ul>
            </div> -->

            <!-- 

            <div class="download-button">
              <a class="btn btn-primary btn-lg" target = "_blank"  href=<?php echo $cvurl ?> ><i class="fa fa-download"></i>view my cv</a>
            </div> -->
          </div>


        </div> <!-- /.row -->
      </div> <!-- /.container -->
    </section>          
  </div>
</div>
<!-- /top tiles -->




</div>
        </div>
      
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
