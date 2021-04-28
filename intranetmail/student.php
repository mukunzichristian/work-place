<?php
include_once('connection.php');
$filename="students.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE student";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO student (studentId,regno,name,email,tel,faculty,department) VALUES('".$row["studentId"]."','".$row["regno"]."','".$row["name"]."',
'".$row["email"]."','".$row["tel"]."','".$row["faculty"]."','".$row["department"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>