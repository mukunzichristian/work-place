


<?php include('header.php');?>
<?php include('leftsider.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Announcement
      </h1>
      <ol class="breadcrumb">
        <li><a href="home2.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="post.php">Post</a></li>
        <li class="active">User post</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Write your Announcement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label >Title</label>
                  <input type="title" class="form-control"  placeholder="Enter your title" name="title" required>
                </div>
                <div class="form-group">
                  <label >Content</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="contents" required></textarea>
                </div>
                
                <br>
                <div class="form-group">
                  <label for="exampleInputFile">File post</label>
                  <input type="file"  name="pic">

                  <p class="help-block">post file related to your contents</p>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                 <button type="submit" class="btn btn-primary" name="SAVE">Submit</button>
              </div>
            </form>


            <?php 
if(isset($_POST['SAVE']))
{
$a=$_POST['title'];
$b=$_POST['contents'];
$c=$_POST['date'];
$file_name = "";


if(isset($_FILES['pic'])){
      $errors= array();
      $file_name =$_FILES['pic']['name'];
      $file_size =$_FILES['pic']['size'];
      $file_tmp =$_FILES['pic']['tmp_name'];
      $file_type=$_FILES['pic']['type'];
      

      if($file_size >= 2050505){
         $send = false;
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         // echo "";
         }}


      $qry="INSERT INTO post SET userId='$uname',title='$a', content ='$b',image='$file_name',date=sysdate()";
      $exc=mysqli_query($con,$qry);
      if(!$exc)
      {
        echo"error";
      }
      else
      {
        echo"done";
      }
    }
?>
          </div>
        

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6" >
          <!-- Horizontal Form -->
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">MY POST</h3> 
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        
                      </div>
                    </div>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
            <?php
            $slct="SELECT * FROM post  WHERE userId='$uname'";
            $cute=mysqli_query($con,$slct);
            while ($row=mysqli_fetch_array($cute)) {
            ?>
            <form role="form" method="POST" action="deletePost.php" enctype="multipart/form-data">
              <div class="box-body">
               <div class="form-group">
                  <label >Date</label>
                  <input type="title" class="form-control"   name="date" value="<?php echo $row['date']; ?>" readonly >
                  <input type="hidden" class="form-control"   name="fId" value="<?php echo $row['upd_id']; ?>"  readonly>
                </div>
                <div class="form-group">
                  <label >Title</label>
                  <input type="title" class="form-control" readonly  name="title" value="<?php echo $row['title']; ?>">
                </div>
                <div class="form-group">
                  <label >Content</label>
                  <textarea class="form-control" readonly rows="3" ><?php echo $row['content']; ?></textarea>
                </div>
                
                <br>
                <div class="form-group">
                  <label for="exampleInputFile">File post</label>
                 <img src="images/<?php echo $row['image'];?>" width="480" height="300">

                </div>
                
              </div>
              <!-- /.box-body -->
              </form>
              <div class="box-footer">
               <a href="deletePost.php?del=<?php echo $row['post_id'];?>"> <button  class="btn btn-primary" name="delete">Delete</button></a>
              </div>
            
            <?php
          }
          ?>
                      </div>
                
                    </div>
                    <!-- /.direct-chat-msg -->

                   

                 <!-- </div>-->
                  <!--/.direct-chat-messages-->

                 
                </div>
                <!-- /.box-body -->
              </div>
              <!--/.direct-chat -->
            </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include('footer.php');?>