<?php include('header2.php');?>
<?php
include_once('connection.php');

$gId=@$_REQUEST["id1"];
//session_start();
//$id=$_SESSION['credentialsId'];
if(isset($_POST["submit"]))  
{  

if (@$_REQUEST["id1"]!="") {

$message = mysqli_real_escape_string($con, $_POST["mess"]);
$file_name = "";
if(isset($_FILES['file'])){
$errors= array();
$file_name = $_FILES['file']['name'];
$file_size =$_FILES['file']['size'];
$file_tmp =$_FILES['file']['tmp_name'];
$file_type=$_FILES['file']['type'];

move_uploaded_file($file_tmp,"files/".$file_name);
$sql=mysqli_query($con,"insert into groupchat(message,attachment,groupId,credentialsId,recDT)
values('".$message."', '".$file_name."','".$gId."','".$id."',now())");


}
}

}


?>
<?php include('leftsider.php');?>
<div class="content-wrapper">
<div class="row">
<div class="col-md-6" style="margin-left: 0px;">
<!--<div class="direct-chat-messages">-->
<h1 class="btn btn-primary btn-block margin-bottom"  style="border-radius: 10px;">Groups</h1> 

<div class="box box-solid">

<div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">


<?php
include_once('connection.php');
if ( $title == 'Lecture'){ 

$query="SELECT * FROM course c,groupcourse g WHERE c.courseId=g.courseId and g.lectureId=(select regId from credentials WHERE credentialsId='$id')";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result)){
?>


<li><a href="chat.php?id1=<?php echo $row["groupId"];?>"><i class="fa fa-message" style="color: black;padding-left: 15px"><?php echo $row["courseName"]."    ".$row["groupName"];?></i> 
<span class="pull-right">
<form method="POST" action="groupProfile.php?id2=<?php echo $row["groupId"];?>">
<input type="submit" name="click" value="GroupInfo" id="details" style="background-color: MediumSeaGreen">
</form>
</span> </a> </li>


<?php
}
}
else {
include_once('connection.php');
$query="SELECT * FROM timeTable t, registration r WHERE t.groupId = r.groupId AND studentId = (SELECT regId FROM credentials WHERE credentialsId = '$id')";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result)){
?>

<li><a href="chat.php?id1=<?php echo $row["groupId"];?>"><i class="fa fa-message" style="color: black;padding-left: 15px"><?php echo $row["courseName"]."    ".$row["groupName"];?></i> 

<span class="pull-right">
<form method="POST" action="groupProfile.php?id2=<?php echo $row["groupId"];?>">
<input type="submit" name="click2" value="GroupInfo" id="details" style="background-color: MediumSeaGreen;border-radius:3px; ">

</form>
</span> </a> </li>
<?php
}
$gId=$_GET["id1"];
$curDates=date('yy-m-d');

$sql=mysqli_query($con,"SELECT * from studentparticipation where credentialsId='$id'");
$row=mysqli_fetch_array($sql);

if($gId != $row["groupId"] && $gId != null
){
$sql=mysqli_query($con,"insert into studentparticipation(credentialsId,groupId,dates) values('".$id."','".$gId."',now())");
}

}
?>







</ul>
</div>
</div>

<!-- ./col -->
<!--</div>-->
</div>
<div class="col-md-6" style="background-color: white;">
<!--<div class="direct-chat-messages">-->
<h1 class="btn btn-primary btn-block margin-bottom" style="border-radius: 10px;">Chat</h1>

<div class="chat-content p-2" id="messageBody"> 
<div class="container"> 

<div class="message-day">




<?php 
include_once('connection.php');

$id=$_SESSION["credentialsId"];
$gId=@$_REQUEST["id1"];
$sql=mysqli_query($con,"SELECT * FROM groupchat g,credentials c WHERE g.groupId='$gId' AND g.credentialsId=c.credentialsId ORDER BY chatId DESC");
$count = mysqli_num_rows($sql);
//echo "count".$count;
while ($rows=mysqli_fetch_array($sql)) {

//for ($i=0; $i < $count; $i++) { 
if( $rows['credentialsId'] != $id){
?>


<div class="message" style="font-size: 20px;">
<div class="message-wrapper">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="message-date" style="font-size: 13px;"><?php echo $rows["userTitle"].": ".$rows["userName"];?></span><br>
<div class="message-content">
<span>
<?php echo $rows["message"];?>
</span>
</div>
</div>
<div class="message-options">
<div class="avatar avatar-sm"><img alt="" src="userImages/<?php echo $rows['image'];?>"></div>
<span class="message-date" style="font-size: 13px;"><?php echo $rows["recDT"];?></span>

</div>
</div>
<?php
if ($rows["attachment"]) {
# code...


?>
<div class="document-body">
<p style="font-size: 15px;">
<a href="files/<?php echo $rows["attachment"];?>" 
class="text-reset" title="open file" target="_blank">
<?php echo $rows["attachment"];?></a>
</p>

<div class="dropdown">
<a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!-- Default :: Inline SVG -->
<svg class="hw-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg>

<!-- Alternate :: External File link -->
<!-- <img class="injectable hw-18" src="./../assets/media/heroicons/outline/dots-horizontal.svg" alt="message options"> -->
</a>
<div class="dropdown-menu" style="font-size: 15px;">
<a class="dropdown-item d-flex align-items-center"
href='files/<?php echo $rows["attachment"];?>' download>
<!-- Default :: Inline SVG -->
<svg class="hw-18 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
</svg>

<!-- Alternate :: External File link -->
<!-- <img class="injectable hw-18 mr-2" src="./../assets/media/heroicons/outline/download.svg" alt="download"> -->
<span>Download</span>
</a>
</div>
</div>  
</div>
<?php
}

?>


<?php  
} else if($rows["message"]){
?>


<div class="message self" style="margin-left: 200px;">
<div class="message-wrapper">
<div class="message-content">
<span style="font-size: 20px;">
<?php echo $rows["message"];?>
</span>
</div>
</div>
<div class="message-options">
<div class="avatar avatar-sm"><img alt="" src="userImages/<?php echo $rows['image'];?>"></div>

<span class="message-date" style="font-size: 13px;"><?php echo $rows["recDT"];?></span>


</div>

<?php
if( $rows["attachment"] != null) {
?>
<div class="document-body">
<p style="font-size: 15px;">
<a href="files/<?php echo $rows["attachment"];?>" 
class="text-reset" title="open file" target="_blank">
<?php echo $rows["attachment"];?></a>
</p>

<div class="dropdown">
<a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!-- Default :: Inline SVG -->
<svg class="hw-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg>
</a>
<!-- <div class="dropdown-menu" style="font-size: 15px;"> -->
<!-- <a class="dropdown-item d-flex align-items-center" href='files/<?php //echo $rows["attachment"];?>' download>

<svg class="hw-18 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
</svg>

<span>Download</span>
</a> -->
<!-- </div> -->
</div> 
</div>
<?php
}

?>
</div>





<?php
}

//}
?><?php }?>


</div> 



</div>
</div>  


<!--chat footer-->

<form method="POST" enctype="multipart/form-data">

<div class="chat-footer">

<div class="form-row">
<!-- Chat Input Group Start -->
<div class="col">


<!--<div class="chat-form"> -->
<div class="btn btn-default btn-file">
<i class="fa fa-paperclip"></i>
<!--<input type="hidden" name="size" value="1000000" />
<input type='file' name='image' />-->
<input type="file"  name="file" style="height: 35px;"/>
</div>                               

<!-- Textarea Start-->
<input type="text" name="mess" class="form-group" placeholder="Write your message ..." style="width: 350px;height: 35px;text-align: " />
<!-- <input type="text" id="message" name="mess" autocomplete="off" autofocus placeholder="Type message...">
<input type="submit" value="Send"> -->
<!-- Textarea End -->

<!--</div> -->

<input type="submit" name="submit" value="Send" style="height: 35px;">
</div>
<!-- Chat Input Group End -->

<!-- Submit Button End-->
</div>
</div>
</form>
<!-- ./col -->
<!--</div>-->
<!-- ./row -->
</div>
</div> 
<!-- ./content-wrapper --> 
</div>
<footer class="main-footer"> 
<center><strong>Copyright &copy; 2016-2020 <a >AUCA</a>.Intranet Mail System</strong></center>
</footer>

<div class="control-sidebar-bg"></div>
<!-- ./wrapper -->
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/parsley/parsley.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js">.load()</script>


</body>
</html>











