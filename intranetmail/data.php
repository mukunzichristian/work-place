
<?php include('header.php');?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php include('leftsider.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home2.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="data.php">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <!--<h3 class="box-title">All AUCA Member</h3>-->
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr><th>Username</th>
                 
                  <th>userTitle</th>
				  <th>Status</th>
                  <th>Profile</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST['searchOption'])){
						$search=$_POST['search'];
						$query=mysqli_query($con,"SELECT * FROM `credentials` WHERE CONCAT (`userName`,`userTitle`,`status`) LIKE '%".$search."%'");
						while($row=mysqli_fetch_array($query)) {
                ?>

                <tr>
                  <td><?php echo $row['userName'];?></td>
                  
                  <td><?php echo $row['userTitle'];?></td>
				  <td><?php echo $row['status'];?></td>
				  
                  <td>
                    <img src="userImages/<?php echo $row['image'];?>"  width="30" height="30">
                  </td>
				  <td><a href="returnUser.php?id=<?php echo $row['credentialsId'];?>"><button class="btn btn-primary " style="background-color:MediumSeaGreen">Enable</button></a></td>
                  <td><a href="removeUser.php?id=<?php echo $row['credentialsId'];?>"><button class="btn btn-primary" style="background-color:Tomato">Disable</button></a></td>
				  
                
				</tr>
				<?php }} 
				 
				else{
					$query=mysqli_query($con,"SELECT * FROM `credentials`");
						while($row=mysqli_fetch_array($query)) {
				?>
				<tr>
                  <td><?php echo $row['userName'];?></td>
                  
                  <td><?php echo $row['userTitle'];?></td>
				  <td><?php echo $row['status'];?></td>
				  
                  <td>
                    <img src="userImages/<?php echo $row['image'];?>"  width="30" height="30">
                  </td>
                  <td><a href="returnUser.php?id=<?php echo $row['credentialsId'];?>"><button class="btn btn-primary " style="background-color:MediumSeaGreen">Enable</button></a></td>
                  <td><a href="removeUser.php?id=<?php echo $row['credentialsId'];?>"><button class="btn btn-primary" style="background-color:Tomato">Disable</button></a></td>
				</tr>
				<?php }}?> 
                </tbody>
              
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('footer.php');?>