<?php
include_once('connection.php');
$filename="course.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE course";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO course (courseId,courseCode,courseName,credit,hours) VALUES('".$row["courseId"]."','".$row["courseCode"]."','".$row["courseName"]."','".$row["credit"]."','".$row["hours"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>