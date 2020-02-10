<!DOCTYPE html>
<html lang="en">
<?php

date_default_timezone_set('Africa/Nairobi');
$get_curr_year = date('Y');
$get_today_date = date('d-m-Y');

session_start();
require_once 'includes/dbconnection.php';
$adminid=$_SESSION['cvmsaid'];
$res=mysqli_query($con,"select AdminName,role from tbladmin where ID='$adminid'");
$row=mysqli_fetch_array($res);
$name_session=$row['AdminName'];
$role = $row['role'];
?>

<?php
if (isset($_GET['del_result'])) {
    $del_result = mysqli_real_escape_string($con, $_GET['del_result']);
    $exp = explode('-', $del_result);
    $id = $exp['0'];
    $table = $exp['1'];
    $query=mysqli_query($con,"DELETE  FROM  $table WHERE  id='$id'");
    if ($query) {
       $del_message = "Field deleted successfully";
       echo "<script> window.alert('Field deleted successfully') </script>";
       echo "<script> window.history.back() </script>";
    }
}
?>

<?php
if (isset($_GET['confirm_result'])) {
    $confirm_result = mysqli_real_escape_string($con, $_GET['confirm_result']);
    $exp = explode('-', $confirm_result);
    $id = $exp['0'];
    $table = $exp['1'];
    $query=mysqli_query($con,"UPDATE $table SET status='done' where id='$id'");
    if ($query) {
       $del_message = "Appointment has been confirmed successfully";
       echo "<script> window.alert('Appointment has been confirmed successfully') </script>";
       echo "<script> window.history.back() </script>";
    }
}
?>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>follo-app</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Fontfaces CSS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script> -->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link type="text/css" href="vendor/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/datatable/css/buttons.dataTables.min.css">
    <!-- Bootstrap CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style type="text/css">
        .card1{
            background-color: #AA93FB;
            text-align: center;
            color: white !important; 
            font-family: sans-serif;
            font-style: italic !important;
        }
        .card2{
            background-color: orange;
            text-align: center;
            color: white !important; 
            font-family: sans-serif;
            font-style: italic !important;
        }
        .card3{
            background-color: #92D0F9;
            text-align: center;
            color: white !important; 
            font-family: sans-serif;
            font-style: italic !important;
        }
        .card4{
            background-color: #EC867C ;
            text-align: center;
            color: white !important; 
            font-family: sans-serif;
            font-style: italic !important;
        }

        .myform{
            padding: 20px;
        }
    </style>

</head>
<body>

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.yitug.org" class="simple-text">
                Follo App
            </a>
        </div>

        <?php 
if ($role=='clinician') {

         ?>

        <ul class="nav">
            <li class="active">
                <a href="dashboard.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
                <p>
                  Mothers
                  <b class="caret"></b>
              </p>

          </a>
          <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
            <li><a href="register_mother.php" >Add mothers</a></li>
            <li><a href="manage-mothers.php">Manage mothers</a></li>
            <li class="divider"></li>
            <li><a href="mother-appointments.php">Mothers Appointments</a></li>
        </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
        <p>
          Babies
          <b class="caret"></b>
      </p>

  </a>
  <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
    <li><a href="register_baby.php" >Add babies</a></li>
    <li><a href="manage-baby.php">Manage babies</a></li>
    <li class="divider"></li>
    <li><a href="#">Babies Appointments</a></li>
</ul>
</li>

</ul>

<?php } 

else if ($role=='admin') {

         ?>

        <ul class="nav">
            <li class="active">
                <a href="dashboard.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
                <p>
                  Mothers
                  <b class="caret"></b>
              </p>

          </a>
          <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
            <li><a href="register_mother.php" >Add mothers</a></li>
            <li><a href="manage-mothers.php">Manage mothers</a></li>
            <li class="divider"></li>
            <li><a href="mother-appointments.php">Mothers Appointments</a></li>
        </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
        <p>
          Babies
          <b class="caret"></b>
      </p>

  </a>
  <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
    <li><a href="register_baby.php" >Add babies</a></li>
    <li><a href="manage-baby.php">Manage babies</a></li>
    <li class="divider"></li>
    <li><a href="baby-appointments.php">Babies Appointments</a></li>
</ul>
</li>

<li>
    <a href="referrals_list.php">
        <i class="pe-7s-home"></i>
        <p>Referrals</p>
    </a>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-news-paper"></i>
    <p>
      VHTs
      <b class="caret"></b>
  </p>

</a>
<ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
    <li><a href="register_vht.php" >Add Vhts</a></li>
    <li><a href="vhts_list.php">Manage Vhts</a></li>
    <!-- <li class="divider"></li> -->
</ul>
</li>
<li>
    <a href="health_units.php">
        <i class="pe-7s-science"></i>
        <p>Health Units</p>
    </a>
</li>
<li>
    <a href="accounts.php">
        <i class="pe-7s-bell"></i>
        <p>Accounts</p>
    </a>
</li>
<li class="active-pro">
    <a href="#upgrade.html">
        <i class="pe-7s-rocket"></i>
        <p>For More Info</p>
    </a>
</li>
</ul>

<?php } 

else if ($role=='doctor') {

         ?>

        <ul class="nav">
            <li class="active">
                <a href="dashboard.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
                <p>
                  Mothers
                  <b class="caret"></b>
              </p>

          </a>
          <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
            <li><a href="register_mother.php" >Add mothers</a></li>
            <li><a href="manage-mothers.php">Manage mothers</a></li>
            <li class="divider"></li>
            <li><a href="mother-appointments.php">Mothers Appointments</a></li>
        </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
        <p>
          Babies
          <b class="caret"></b>
      </p>

  </a>
  <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
    <li><a href="register_baby.php" >Add babies</a></li>
    <li><a href="manage-baby.php">Manage babies</a></li>
    <li class="divider"></li>
    <li><a href="baby-appointments.php">Babies Appointments</a></li>
</ul>
</li>

<li>
    <a href="referrals_list.php">
        <i class="pe-7s-home"></i>
        <p>Referrals</p>
    </a>
</li>

<li>
    <a href="health_units.php">
        <i class="pe-7s-science"></i>
        <p>Health Units</p>
    </a>
</li>
<li class="active-pro">
    <a href="#upgrade.html">
        <i class="pe-7s-rocket"></i>
        <p>For More Info</p>
    </a>
</li>
</ul>

<?php } 

else if ($role=='receptionist') {

         ?>

        <ul class="nav">
            <li class="active">
                <a href="dashboard.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
                <p>
                  Mothers
                  <b class="caret"></b>
              </p>

          </a>
          <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
            <li><a href="register_mother.php" >Add mothers</a></li>
            <!-- <li><a href="manage-mothers.php">Manage mothers</a></li> -->
            <li class="divider"></li>
            <!-- <li><a href="mother-appointments.php">Mothers Appointments</a></li> -->
        </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user"></i>
        <p>
          Babies
          <b class="caret"></b>
      </p>

  </a>
  <ul class="dropdown-menu" style="margin-left: 15px;background-color: #1DC7EA;">
    <li><a href="register_baby.php" >Add babies</a></li>
    <!-- <li><a href="manage-baby.php">Manage babies</a></li> -->
    <li class="divider"></li>
    <!-- <li><a href="baby-appointments.php">Babies Appointments</a></li> -->
</ul>
</li>

<li class="active-pro">
    <a href="#upgrade.html">
        <i class="pe-7s-rocket"></i>
        <p>For More Info</p>
    </a>
</li>
</ul>

<?php } ?>

</div>
</div>



<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dashboard</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-dashboard"></i>
                            <p class="hidden-lg hidden-md">Dashboard</p>
                        </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe"></i>
                        <b class="caret hidden-lg hidden-md"></b>
                        <p class="hidden-lg hidden-md">
                          5 Notifications
                          <b class="caret"></b>
                      </p>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Notification 1</a></li>
                    <li><a href="#">Notification 2</a></li>
                    <li><a href="#">Notification 3</a></li>
                    <li><a href="#">Notification 4</a></li>
                    <li><a href="#">Another notification</a></li>
                </ul>
            </li>
            <li>
               <a href="">
                <i class="fa fa-search"></i>
                <p class="hidden-lg hidden-md">Search</p>
            </a>
        </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li>
           <a href="">
               <p><?php echo $name_session; ?></p>
           </a>
       </li>
       <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <p>
              Dropdown
              <b class="caret"></b>
          </p>

      </a>
      <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</li> -->
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <p>
        <img src="images/icon/users-vector.jpg" width="30" height="20" style="border-radius: 50%;" alt="Admin" />
        <!-- <a class="js-acc-btn" href="#"><?php //echo $name; ?></a> -->
        <b class="caret"></b>
    </p>

</a>
<ul class="dropdown-menu">
    <li><center>
        <img src="images/icon/users-vector.jpg" width="50" height="50" style="border-radius: 50%; margin-top: 5px;" alt="Admin" /></center>
        <a class="js-acc-btn" style="text-align: center;" href="#"><?php echo $name_session; ?></a>
    </li>
    <li><a href="admin-profile.php">
        <i class="zmdi zmdi-account"></i> Admin Profile</a></li>
        <li><a href="change-password.php">
            <i class="zmdi zmdi-settings"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="logout.php" style="color: red;" onclick="return confirm('Are you sure you to leave')">
                <i class="zmdi zmdi-power text-center"></i> Logout</a></li>
            </ul>
        </li>
        <li class="separator hidden-lg"></li>
    </ul>
</div>
</div>
</nav>
