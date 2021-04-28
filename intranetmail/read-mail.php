
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('header.php');?>
<?php include('leftsider.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Read Mail
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
          <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

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

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Subject</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
             <!--message -->
    <!--message -->
    <?php
    include_once('connection.php');

    $id=$_SESSION["credentialsId"];
    @$coninb=$_GET['coninb'];

  //POP3 DOWNLOAD VIEW MAIL FROM SERVER   

  $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO'; 
function decryptthis($data, $key) { 
$encryption_key = base64_decode($key); 
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null); 
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv); }
 
     
      if($coninb)
      {
      //$sql="SELECT * FROM message where rec_id='$id' and mail_id='$coninb'";
	  $sql="SELECT sen_id,sub,recDT,mail_id, rec_id,msg,attachement, (SELECT userName FROM credentials WHERE credentialsId = (SELECT sen_id FROM message WHERE rec_id = '$id' LIMIT 1)) AS userName FROM credentials c, message i
WHERE c.credentialsId = i.rec_id AND  i.mail_id='$coninb' AND i.status='inbox'";

$dd=mysqli_query($con,$sql);
      $row=mysqli_fetch_object($dd);
	  
        echo "<div class='box-body no-padding'>";
         echo "<div class='mailbox-read-info'>";      
         echo "<h3>".decryptthis($row->sub,$key)."</h3>";      
          
             echo "</div>"; 
              
              
             echo "<div class='mailbox-read-message'>"; 
                  echo "<h4>".decryptthis($row->msg,$key)."<h2>";

              echo"</div>";
              echo"<a href='reply.php?mail=$row->userName' class='btn btn-info ' > Reply</a>";
                  echo"<div class='pull-right'><a href='forward.php?msge=$row->msg' class='btn btn-info btn-block margin-bottom'>Forward</a></div>";
            echo "</div>";
          if($row->attachement != null) {
      echo "<a href='images/".$row->attachement."' download>Download</a>";

	  }
	  
                          
      }
       @$cheklist=$_REQUEST['ch'];
  if(isset($_GET['delete']))
  {
    foreach($cheklist as $v)
    {
    
    $d="DELETE from usermail where mail_id='$v'";
    mysqli_query($con,$d);
    }
    echo "msg deleted";
  }

  ?>

<!--sent box-->
   <?php
    include_once('connection.php');

     $id=$_SESSION['sid'];
    @$consent=$_GET['consent'];
      
      if($consent)
      {
      $sql="SELECT * FROM usermail where sen_id='$id' and mail_id='$consent'";
      $dd=mysqli_query($con,$sql);
      $row=mysqli_fetch_object($dd);
      echo "<div class='box-body no-padding'>";
         echo "<div class='mailbox-read-info'>";      
         echo "<h3>".$row->sub."</h3>";      
          
             echo "</div>"; 
              
             
             echo "<div class='mailbox-read-message'>"; 
                  echo "<h2>".$row->msg."<h2><br>";
                    
              echo"</div>";
              
            echo "</div>";

             if($row->attachement != null) {
      echo "<a href='images/".$row->attachement."' download>Download</a>";
    }
          
          
      }
       @$cheklist=$_REQUEST['ch'];
  if(isset($_GET['delete']))
  {
    foreach($cheklist as $v)
    {
    $d="DELETE from usermail where mail_id='$v'";
    mysqli_query($con,$d);
    }
    echo "message deleted";
  }

  ?>
       </li>
                
              </ul>
            </div>
            
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
		 </section>
        <!-- /.col -->
      </div>
     
      <!-- /.row -->
   
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  <?php include('footer.php');?>
