
<?php
error_reporting(1);
session_start();
$id=$_SESSION['credentialsId'];
include_once('connection.php');
//$imgpath=$_FILES['file'];
//mysqli_query($con,"INSERT INTO credentials (image) values('$imgpath')");

$temp = explode(".", $_FILES['image']['name']);
      $extension = end($temp);
      $newfilename = round(microtime(true)) . '.' . end($temp);
	  $te="sam";
      move_uploaded_file($_FILES['image']['tmp_name'], "userImages/".$newfilename);
$query=mysqli_query($con,"UPDATE credentials SET image='$newfilename' WHERE credentialsId='$id'");
//opendir("userImages/");
    //move_uploaded_file($_FILES["file"]["tmp_name"], "userImages/" . $_FILES["file"]["name"]);
    //$_SESSION['sname']=$_POST['sid'];

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



