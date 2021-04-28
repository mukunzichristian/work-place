<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
       <?php echo "<img alt='image not upload' src='userImages/$file' class='img-circle'  height='20' width='20'/>"; ?>
              </div>
        <div class="pull-left info">
          <p> <?php  $a=$_SESSION["credentialsId"]; echo $_SESSION["userName"];?>
                  </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        </li>
        <?php
		  
			  if($title=="Office"){
		  
		?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Announcement</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="post.php"><i class="fa fa-circle-o"></i>Post</a></li>
            <!--<li><a href="pages/forms/editors.php"><i class="fa fa-circle-o"></i> Editors</a></li>-->
          </ul>
        </li>
        <?php
			  }
		?>
        <li>
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
		
		
		<?php
		  
			  if($title=="Lecture" || $title=="Student"){
		  
		?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>Group Chat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="join_group.php"><i class="fa fa-circle-o"></i> Join Group</a></li>-->
			<li><a href="chat.php"><i class="fa fa-circle-o"></i> Chat</a></li>
			<!--<li><a href="groupbox2.php"><i class="fa fa-circle-o"></i> Group Box</a></li>-->
          </ul>
		  
        </li>
		<?php
		  
		  }
		  ?>
		  <?php 
		  if($title=="Admin"){
		  ?>
        <li>
          <a href="data.php">
            <i class="fa fa-gears"></i> <span>User Management</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
		<li>
          <a href="userAvailability.php">
            <i class="fa fa-gears"></i> <span>User Participation</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <?php
		  }
		?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile2.php"><i class="fa fa-circle-o"></i> Profile</a></li>
            
			
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>