<?php


include_once('connection.php');
 $mid  = $_GET['id'];


$sql=mysqli_query($con,"SELECT * FROM message where  mail_id='$mid' and status='inbox'");
echo $num = mysqli_num_rows($sql);


while($dd=mysqli_fetch_array($sql))
	{
	$rec=$dd['rec_id'];
	$sen=$dd['sen_id'];
	$sub=$dd['sub'];
	$msg=$dd['msg'];
	$att=$dd['attachement'];
	//store into trash table
	$exec = mysqli_query($con,"insert into trash (rec_id,sen_id,sub,msg,recDT) values('$rec','$sen','$sub','$msg',now())");


	// if ($exec) {
	// 	echo "Trashed";
	// }

	// else{

	// 	echo "not Trashed";
	// }


	}


$dele  = mysqli_query($con,"delete FROM message where  mail_id='$mid'");

if ($dele) {
	header("location:mailbox.php");
}
 else{
	echo "trashed";
}

?>