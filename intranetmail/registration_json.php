<?php
include_once('connection.php');
$filename="registration_json.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE registration";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO registration (regId,studentId,groupId) VALUES('".$row["regId"]."','".$row["studentId"]."','".$row["groupId"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>