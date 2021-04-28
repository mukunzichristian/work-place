<?php
include_once('connection.php');
$filename="admin.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE admin";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO admin (adminId,regno,name,email) VALUES('".$row["adminId"]."','".$row["regno"]."','".$row["name"]."',
'".$row["email"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>