<?php
include_once('connection.php');
$filename="office.json";
$data=file_get_contents($filename);
$array=json_decode($data, true);

$sql="TRUNCATE TABLE office";
mysqli_query($con,$sql);
foreach($array as $row){
$sql="INSERT INTO office (officeId,officeRegno,officeName) VALUES('".$row["officeId"]."','".$row["officeRegno"]."','".$row["officeName"]."')";
mysqli_query($con,$sql);
}
echo"Data saved";
?>