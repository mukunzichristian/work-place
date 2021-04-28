<?php
include_once('connection.php');
$gId=$_GET["id1"];
session_start();
$id=$_SESSION['credentialsId'];
 if(isset($_POST["submit"]))  
 {  
      $message = mysqli_real_escape_string($con, $_POST["mess"]);
      if ($message=="") {
      	echo "Enter message";
      }else{
      	$sql=mysqli_query($con,"insert into groupchat(message,attachment,groupId,credentialsId,recDT)
      	values('".$message."', '"."NULL"."','".$gId."','".$id."')");
      	echo "Data Saved";
      }

  }

  ?>