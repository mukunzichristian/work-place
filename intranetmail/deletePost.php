<?php
session_start();
if($_SESSION["credentialsId"]=="")
{
header('Location:loginsample.php');
}
$id=$_SESSION["credentialsId"];

include_once('connection.php');
 
$fid=$_GET['del'];

 $dlt="DELETE FROM post WHERE post_id=$fid"; 
 mysqli_query($con,$dlt);

 header("Location:post.php");
  
?>