<?php
include_once('connection.php');
// error_reporting();
// $y=$_POST['y'];
// $m=$_POST['m'];
// $d=$_POST['d'];
// $dob=$y."-".$m."-".$d;
// $ch=$_POST['ch'];
// $hobbies=implode(",",$ch);
// $un=$_POST['un'];

session_start();
$id=$_SESSION['credentialsId'];
$a=$_POST['un'];


// echo $h=$_FILES['file1']['name'];




$query=mysqli_query($con,"UPDATE credentials SET userName='$a' WHERE credentialsId='$id'");
mysqli_close($con);
if(!$query)
{
echo '<script type="text/javascript">alert("User Not Updated");window.location=\'profile2.php\';</script>';

}
else
{
echo '<script type="text/javascript">alert("User Updated Succesfully");window.location=\'profile2.php\';</script>';

}

?>

