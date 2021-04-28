<?php include('header.php');?>
<?php include('leftsider.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Maildraft
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="home2.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Maildraft</li>
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
                <li><a href="mailbox.php"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-success pull-right"><?php

      $Query = "select * from message where rec_id ='$a' and status ='inbox'";
      $check = mysqli_query($con,$Query);
      $count = mysqli_num_rows($check);
      echo $count;


     ?></li>
                <li class="active"><a href="mailsent.php"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Draft</h3>

              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
<?php
include_once('connection.php');

$id=$_SESSION["credentialsId"];
 		  
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO'; 
function decryptthis($data, $key) { 
$encryption_key = base64_decode($key); 
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null); 
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv); }		  
		  
$sql="SELECT * FROM credentials c, message i
WHERE c.credentialsId = i.sen_id AND credentialsId = '$id' and i.status='draft'";
$dd=mysqli_query($con,$sql);

             echo "<div class='table-responsive mailbox-messages'>";
                echo "<table class='table table-hover table-striped>"; 
                echo "<table id='table_fetch' >";
                 echo "<tbody>";
				 
while($rows=mysqli_fetch_object($dd))
{ 
$mid=$rows->mail_id;
$name=$rows->userName;
$sub=$rows->sub;
$sub=decryptthis($sub, $key);
$date=$rows->recDT;

                  echo "<tr>";
                  echo "<td><input type='checkbox' name='ch[]' value='$mid'></td>";
                  echo "<td class='mailbox-star'><a href='#'><i class='fa fa-star text-yellow'></i></a></td>";
                  echo "<td class='mailbox-name'><a href='read-mail.php?coninb=$mid'>".$name."</a></td>";
                  echo "<td class='mailbox-subject'><b>".$sub."</b></td>"; 
                  echo "<td class='mailbox-attachment'></td>";
                  echo "<td class='mailbox-date'>".$date."</td>";  
                  echo "<td class='mailbox-date'><a href='deleteMSG.php?id=$mid' class='btn btn-primary' style='background-color:Tomato'>Delete</td>";  
                  echo "</tr>";
                  }
              echo "</tbody>";    
              echo "</table>"; 
                
              echo "</div>";
              ?>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include('footer.php');?>