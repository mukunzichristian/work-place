


<?php include('header.php');?>
<?php include('leftsider.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  

  <div class="content-wrapper">
  
    <section class="content">
      <!-- Info boxes -->
      <div class="row">

        <div class="clearfix visible-sm-block"></div>
      </div>
    
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
 
          </div>
    
        <p style="text-align:right;"><?php echo"Today is  ".date('l F d, Y   h:m:s');?></p>
     
          <div class="row">
             <div class="col-md-6" >
         

              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border" style="background-color:MediumSeaGreen;">
                  <center><h3 class="box-title" style="color:white;">Announcement Board</h3></center>
                  <div class="box-tools pull-right">
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    <!--</button>-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    <!--</button>-->
                  </div> 
                </div>
                
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <!--<div class="direct-chat-messages">-->
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        
                      </div>
                    </div>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
            <?php
            $slct="SELECT * FROM post";
			
            
			$cute=mysqli_query($con,$slct);
            while ($row=mysqli_fetch_object($cute)) {
            ?>
            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <center><label>POSTED BY:<h3> <?php echo $row->userId;?></h3></label></center>
                  
                </div>
               <div class="form-group">
                  <center><label style="font-size:16px;">Date&nbsp;&nbsp;</label>
                  <?php echo $row->date; ?>
				  <!--<input type="hidden" class="form-control"   name="fId" value="<?php //echo $row['post_id']; ?>">-->
                </center>
				</div>
                <div class="form-group">
				<center>
                  <label style="font-size:16px;">Subject:&nbsp;&nbsp;</label>
                 <?php echo $row->title; ?>
				 </center>
				</div>
                <div class="form-group">
                 
                 <center><p style="font-size:14px;"><?php echo $row->content; ?></p> </center>
				 </div>
                
                <br>
                <div class="form-group">
				<?php if($row->image)
				{?>
                  
                 <img src="images/<?php echo $row->image;?>" width="540" height="300">
				 <?php
				 }?>
                </div>
                
              </div>
              <!-- /.box-body -->
              </form>
            <div class="box-footer">
              
            </div>
            
            <?php
          }
          ?>
                      </div>
                
                    </div>

                  <!--</div>-->
              
                </div>
                <!-- /.box-body -->
              </div>
              <!--/.direct-chat -->
              <section>
      <div class="container">
        <div class="row">
          <div class="col-12" style="margin-top: -5%;">
            <div class="slide-one-item home-slider owl-carousel">
            </div>
          </div>
        </div>
      </div>
       <!--<img src="images/ml.jpeg" alt="Image" class="img-fluid img col-md-12"  >-->
    </section>

            </div>
            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <!--<h3 class="box-title" style="margin-left: 150px;"><b>AUCA User Account</b></h3>-->
				  <form method="POST">
				  <input type="text" name="search" class="search" placeholder="Search here..." style=" 
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width:75%;height:35px;"/>
				  <input type="submit" value="Search" name="searchOption" style="border-radius: 5px; width:15%;height:35px; font-size: 16px; border: 2px solid #ccc;"/>
				  </form>

                  <div class="box-tools pull-right">
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>-->
                    </button>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>-->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
				<!--<div class="direct-chat-messages">-->
                <div class="box-body no-padding">
				
                  <ul class="users-list clearfix">

                    <?php
					if(isset($_POST['searchOption'])){
						$search=$_POST['search'];
						$query=mysqli_query($con,"SELECT * FROM `credentials` WHERE `userName` LIKE '%".$search."%'");
						while($row=mysqli_fetch_array($query)) { 
                    
                    
                    echo"<li>
                      <img  src='userImages/".$row['image']."' alt='User Image' width='30' height='30'>
            <a class='users-list-name' style='color: Gray' href='reply.php?mail=".$row['userName']."'>".$row['userName']."</a>
                      <a class='users-list-name' href='#'>".$row['userTitle']."</a>
                    </li>";
					}
					}else{

                    $query=mysqli_query($con,"select * from credentials");
                    while($row=mysqli_fetch_array($query)) { 
                    
                    
                    echo"<li>
                      <img  src='userImages/".$row['image']."' alt='User Image' width='30' height='30'>
            <a class='users-list-name' style='color: Gray' href='reply.php?mail=".$row['userName']."'>".$row['userName']."</a>
                      <a class='users-list-name' href='#'>".$row['userTitle']."</a>
                    </li>";
					}
					
					}
					
					
                    ?>
					
                  </ul>
				  
                  <!-- /.users-list -->
                </div>
				<!--</div>-->
                <!-- /.box-body -->
                
                <!-- /.box-footer -->
              </div>
              <!-- <img src="images/mn.gif" alt="Image" class="img-fluid img col-md-12"  >-->
              <!--/.box -->
            </div>
        </div>
			</section>
        </div>
 
          
         
        
      <!-- /.row -->
    
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

   <?php include('footer.php');?>