<?php
$id=$_GET["id"];
include_once('connection.php');
 
 $dlt="DELETE FROM trash WHERE trash_id='$id'"; 
 mysqli_query($con,$dlt);

 header("Location:mailtrash.php");

?>