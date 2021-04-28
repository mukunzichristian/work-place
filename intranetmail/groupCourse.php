<?php
include_once('connection.php');
$filename="groupCourse.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE groupcourse";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO groupcourse (groupId,groupName,room,startHour,endHour,courseId,lectureId,day) VALUES('".$row["groupId"]."','".$row["groupName"]."','".$row["room"]."','".$row["startHour"]."','".$row["endHour"]."','".$row["courseId"]."','".$row["lectureId"]."','".$row["day"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>