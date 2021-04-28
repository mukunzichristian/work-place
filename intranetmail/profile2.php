
<?php include_once('header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="home2.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="profile2.php">my account</a></li>
        <li class="active">User profile</li>
      </ol>
    </section><br>
	<?php include('leftsider.php');?>
	
  <div class="modal modal-info fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post" action="ediprofile.php" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">change your profile picture</h4>
              </div>
              <div class="modal-body">
               
               <lebel>Upload Profile</lebel>
			   <input type="hidden" name="size" value="1000000" />
                <input type='file' name='image' />
            
                       
                       <!--<input type="file" name="image" /-->
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Save changes</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <center><?php echo "<img alt='image not upload' src='userImages/$file' class='img-circle'  height='25' width='25'/>"; ?></center>
              <h3 class="profile-username text-center"><?php  $a=$_SESSION['userName']; echo @$_SESSION['userName'];?></h3>

              <p class="text-muted text-center">AUCA User</p>
           <center> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" >
               Edit profile picture
              </button></center>
              
               
        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab">Profile</a></li>
              <li><a href="#settings" data-toggle="tab">change password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->

                
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  
                  <!-- /.user-block -->
                

            
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">

                  
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <?php
error_reporting(1);
$sid=$_SESSION['credentialsId'];
$r=mysqli_query($con,"select * from credentials where credentialsId='$sid'");

$row=mysqli_fetch_object($r);

$username=$row->userName;
$usertitle=$row->userTitle;
$status=$row->status;
echo "<form method='post' action='latestupdDisp.php'>";
echo "<table border='0'>";
echo "<tr height='40'>";
echo "<td><b>UserName:</b></td>";
echo "<td><input type='text'  name='ch' value='$username'/></td>";
echo "</tr>";
echo "<tr height='40'>";
echo "<td><b>userTitle:</b></td>";
echo "<td><input type='text'  name='mob' value='$usertitle' readonly/></td>";
echo "</tr>";

echo "<tr height='40'>";
echo "<td><b>Status:</b></td>";
echo "<td><input type='text'  name='gen' value='$status' readonly/></td>";
echo "</tr>";

echo "<tr height='40'>";
echo "<td align='center' colspan='2'><input type='submit' class='btn btn-primary' value='Update'/></td>";
  
  
echo "</tr>";
echo "</table>";
echo "</form>";
?>

   </div>
              <div class="tab-pane" id="settings" >
                  
             <?php 
			 
 if(isset($_POST["submitchange"])) 	 
 {
         $id=$_SESSION["credentialsId"];	 
           $password = mysqli_real_escape_string($con, $_POST["opassword"]);
           $npassword = mysqli_real_escape_string($con, $_POST["npassword"]);
           $cpassword = mysqli_real_escape_string($con, $_POST["cpassword"]); 
           $rpassword = mysqli_real_escape_string($con, password_hash($_POST["npassword"], PASSWORD_DEFAULT)); 

           if($npassword != $cpassword)  
              {  
                   echo '<script>alert("New password and Comfirm password not matched.")</script>';  
              }  
              else  
              {
           $query = "SELECT * FROM credentials WHERE credentialsId = '$id'";  
           $result = mysqli_query($con, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                while($row = mysqli_fetch_array($result))  
                {  
                     if(password_verify($password, $row["userPassword"]))  
                     {  
                        $sql = "UPDATE credentials SET userPassword='$rpassword' WHERE credentialsId = '$id'";

                        if(mysqli_query($con, $sql)) {
                          echo '<script>alert("Password changed!")</script>';
                         }   
                     }
                     else  
                     {   
                          echo '<script>alert("Wrong username or password!")</script>';  
                     }  
                }  
           } 
       }
   } 
 ?>
<body>
<form method="post" class="form-horizontal">
<table width="365" border="0">
  <tr>
  <div class="alert alert-info"><?php echo @$err; ?></div>
    <th width="173" scope="row" >Old Pass </th>
    <td width="176">
    <input type="password" class="form-control" name="opassword"/>
  </td>
  </tr>
  <tr>
    <th scope="row">New Password </th>
    <td>
      <input type="password" class="form-control" name="npassword"/>
  </td>
  </tr>
  <tr>
      <th scope="row">Confirm Pass </th>
    <td><input type="password" class="form-control" name="cpassword"/></td>
  </tr><br>
<tr>
    <td></td>
  <td><input type="submit" class="btn btn-success" name="submitchange" value="Change Password"/></td>
  </tr>
  
</table>
</form>
</body>

                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
<?php include('footer.php');?>
