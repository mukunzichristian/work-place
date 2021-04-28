<?php




include_once('connection.php');
$id=$_REQUEST['id'];

		         	  $id=$_REQUEST['id'];
		              $dlt="update credentials set status='Active' WHERE credentialsId=$id";
		              $cute=mysqli_query($con,$dlt);
		              header("location:data.php");
		              ?>