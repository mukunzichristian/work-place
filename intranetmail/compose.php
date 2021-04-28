
<?php include('header.php');?>
<?php include('leftsider.php');?>
<?php

//session_start();
include_once('connection.php');

$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO'; 
function encryptthis($data, $key) { 
$encryption_key = base64_decode($key); 
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
 $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv); 
return base64_encode($encrypted . '::' . $iv); }
$to=$_POST['to'];
$sub=$_POST['sub'];
$msg=$_POST['msg'];
$file=$_FILES['file']['name'];

//encrypt sub and messsage
$msg=encryptthis($msg, $key);
$sub=encryptthis($sub, $key);


$send = true;
// MESSAGE SEND SMTP

if(@$_REQUEST['send'])
{
  if($to=="" || $sub=="" || $msg=="")
  {
  $err= "<font color='red'>Fill the related information first</font>";
  }
  
  else
  {
  $d=mysqli_query($con,"SELECT * FROM credentials where userName='$to'");
  $row=mysqli_num_rows($d);
  if($row==1)
    {
		
		
$file_name = "";
if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      

      if($file_size >= 2050505){
         $send = false;
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         // echo "";
mysqli_query($con,"INSERT INTO message (rec_id,sen_id,sub,msg,attachement,recDT,status) values((SELECT credentialsId FROM credentials where userName='$to' LIMIT 1),'$id','$sub','$msg','$file_name',sysdate(),'"."inbox"."')");
 $err= "<font color='green'>Message sent Success</font>";
      }else{
         foreach($errors as $e){
              echo $e;
          }
      }
   }
    
    }else{
		$err= "<font color='red'>Incorrect userName</font>";
		
	}
 
  }
} 


if(@$_REQUEST['save'])
{
  if($sub=="" || $msg=="")
  {
  $err= "<font color='red'>Fill related information first</font>";
  }
  
  else
  {
 mysqli_query($con,"INSERT INTO message (rec_id,sen_id,sub,msg,attachement,recDT,status) values((SELECT credentialsId FROM credentials where userName='$to' LIMIT 1),'$id','$sub','$msg','$file_name',sysdate(),'"."draft"."')");
 mysqli_query($con,$query);
  $err= "<font color='green'>Message saved</font>";
  }
}

if(isset($_POST['cancel'])){
	$_POST['to']="";
$_POST['sub']="";
$_POST['msg']="";
} 
/*

//echo $v;
$sql=mysqli_query($con,"SELECT * FROM draft where id='$id' ");
while($dd=mysqli_fetch_array($sql))
  {
  $rec=$dd['uid'];
  $sen=$dd['sid'];
  $sub=$dd['sub'];
  $msg=$dd['msg'];
  $att=$dd['fill'];
  
  //store into usermail table
  mysqli_query($con,"insert into usermail (rec_id,sen_id,sub,msg,attachment,date) values('','$sen','$sub','$msg','$att','')");
  
  //delete form draft
  
  mysqli_query($con,"delete from draft where id='$id' and id='$v'");

  }*/
  




  
?>



  <!-- Left side column. contains the logo and sidebar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home2.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="mailbox.php" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mails</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="mailbox.php"><i class="fa fa-message"></i> Inbox
                <span class="label label-success pull-right"><?php

      $Query = "select * from message where rec_id ='$a' and status='inbox'";
      $check = mysqli_query($con,$Query);
      $count = mysqli_num_rows($check);
      echo $count;

     ?></span></a></li>
                <li><a href="mailsent.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="maildraft.php"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="mailtrash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
       
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <form method="post" enctype="multipart/form-data">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <?php echo @$err; ?>
                <input type="text" name="to" class="form-control" placeholder="To:" >
              </div>
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Subject:" name="sub"  >
              </div>
              <div class="form-group">
                    <textarea name="msg" type="text"  id="compose-textarea" class="form-control" style="height: 150px">
                      
                    </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file"  name="file" id="file">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-default" name="save" value="save" style='background-color:MediumSeaGreen;color:white'><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" class="btn btn-primary" name="send" value="send"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default" name="cancel" value="Cancel" style='background-color:Tomato;color:white'><i class="fa fa-times"></i> Cancel</button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php');?>