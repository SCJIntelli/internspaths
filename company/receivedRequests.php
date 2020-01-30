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
$sql = "SELECT * FROM company WHERE id = ?";
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
     $comnum=$row["comnum"];
     $profileurl=$row["profileurl"];
     $address=$row["address"];
     $mnumber=$row["mobile"];
     $id=$row["id"];
     $descrip=$row["description"];
     $location=$row["location"];
     $facebook=$row["facebook"];
     $linkedin=$row["linkedin"];
     $twitter=$row["twitter"];
     $fields=$row["fields"];
     $mission=$row["mission"];
     $vision=$row["vision"];





   }
 }
}
$sql = "SELECT requests FROM company WHERE id=$id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $applied=$row["requests"];
    $appliedx=(explode(",", $applied));
    $appliedset=array_unique($appliedx);
    mysqli_free_result($result);
  } else{
    echo "<p class='lead'><em>No records were found.</em></p>";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
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

  <title>InternsPaths | <?php echo $name ?></title>
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
            <a href="../index.php" class="site_title"><i class="fa fa-mortar-board"></i> <span>InternsPaths</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo $profileurl ?>" alt="..." class="img-circle profile_img" style="width:50px; height: 50px ">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <a href="../index.php?id=<?php echo $_SESSION["id"]?>"><h2 style = "font-size: 14px; color: #ECF0F1; margin: 0;font-weight: 300; font-family: Arial; text-transform: unset;"><?php echo $name?></h2></a>
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
                  <li><a href="editmyprofile.php?id=<?php echo $_SESSION["id"]?>"><i class="fa fa-cogs"></i>Edit Company Profile</a></li>
                  <li><a href="searchStudents.php"><i class="fa fa-search"></i>Search Students</a></li>
                  <li ><a href="viewrequests.php"><i class="fa fa-send"></i>Sent Requests</a></li>
                   <li><a href="receivedRequests.php"><i class="fa fa-bell"></i>Applied students</a></li>
                  

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
                  <img src="<?php echo $profileurl ?>" alt=""><?php echo $name?>
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

            <div class="page-header clearfix">
              <h2 class="pull-left">Students</h2>
            </div>


            <?php 
            echo "<table id='datatable' class='table table-bordered table-striped'>";
                  echo "<thead>";
                  echo "<tr>";
                  echo "<th>#</th>";
                  echo "<th>Userame</th>";
                  echo "<th>Name</th>";
                  echo "<th>Email Address</th>";
                  echo "<th>Mobile Number</th>";
                  echo "<th>Action</th>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";

            foreach ($appliedset as $key) {
              
              $sql = "SELECT * FROM student WHERE id=$key";
              if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>";
                    echo "<a href='searchview.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span> &nbsp;&nbsp; </a>";
                                // echo "<a href='editcompany.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span> &nbsp;&nbsp;  </a>";
                                // echo "<a href='deletecom.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                                //  echo "<a href='reset-password.php?id=". $row['id'] ."&return=managecompany.php' title='Reset Password' data-toggle='tooltip'><span class='glyphicon glyphicon-link'></span> &nbsp;&nbsp; </a>";
                    echo "</td>";
                    echo "</tr>";
                    mysqli_free_result($result);
                    mysqli_stmt_close($stmt);
                  }
                  
                            // Free result set
                  
                } else{
                  
                }
              


            }
            echo "</tbody>";                            
                  echo "</table>";
          mysqli_close($link);

            ?>
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
