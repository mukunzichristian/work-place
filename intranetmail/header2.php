<?php
session_start();
if($_SESSION["credentialsId"]=="")
{
header('Location:loginsample.php');
}
$id=$_SESSION["credentialsId"];
$title=$_SESSION["userTitle"];
$uname=$_SESSION["userName"];
//echo "title".$title;
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from frontendmatters.org/quicky/light-skin/chat-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jul 2020 14:40:51 GMT -->
<head>
    <meta charset="UTF-8">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

  
    <!-- SEO Meta Tags-->
    <meta name="keywords" content="quicky, chat, messenger, conversation, social, communication" />
    <meta name="description" content="Quicky is a Bootstrap based modern and fully responsive Messaging template to help build Messaging or Chat application fast and easy." />
    <meta name="subject" content="communication">
    <meta name="copyright" content="frontendmatters">
    <meta name="revised" content="Sunday, July 18th, 2010, 5:15 pm" />
    <title>AUCA| MY ACOUNT</title>
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="shortcut icon" href="http://frontendmatters.org/quicky/favicon.ico" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="assets/webfonts/inter/inter.css"> 
    <link rel="stylesheet" href="assets/css/app.min1.css">


   <link rel = "icon" href = "images/rp.png" type = "image/icon"> 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" type="text/css" href="style/styles.css">
<style>
#details{
  background-color: #4CAF50;
  border: none;
  color: white;
  text-decoration: none;
  margin: 2px 2px 2px 2px;
  cursor: pointer;
}
.clickli li:active{
border-left-style: solid;
border-color: green;
}
</style>
  
  

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="home2.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Intranet</b>Mail</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          
          <?php
  include_once('connection.php');
  error_reporting(1);
  
  $chk=$_GET['chk'];
  if($chk=="logout")
  {
  unset($_SESSION["credentialsId"]);
  header('Location:./loginsample.php');
  }
  $r=mysqli_query($con,"select * from credentials where credentialsId=$id");
  
  $row=mysqli_fetch_object($r);
  @$file=$row->image;
  //echo $file;
  
?>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo "<img alt='image not upload' src='userImages/$file' class='img-circle'  height='25' width='25'/>"; ?>
              <span class="hidden-xs"> <?php  $a=$_SESSION["credentialsId"]; echo $_SESSION["userName"];?></span>
                  </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <?php echo "<img alt='image not upload' src='userImages/$file' class='img-circle'  height='25' width='25'/>"; ?>
             
                <p>
                  <?php  $a=$_SESSION["credentialsId"]; echo $_SESSION["userName"];?>
                  <small>AUCA User</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile2.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="home2.php?chk=logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
