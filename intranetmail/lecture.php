<?php
include_once('connection.php');
$filename="lecture.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE lecture";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO lecture (lectureId,regno,name,email,tel) VALUES('".$row["lectureId"]."','".$row["regno"]."','".$row["name"]."',
'".$row["email"]."','".$row["tel"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>