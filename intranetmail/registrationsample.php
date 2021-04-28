 <?php   
 include_once('connection.php');
 
 if(isset($_POST["submit"]))  
 {  
      $type = mysqli_real_escape_string($con, $_POST["type"]);
      $regno = mysqli_real_escape_string($con, $_POST["regno"]); 
      $userName = mysqli_real_escape_string($con, $_POST["userName"]);  
      $userPass = mysqli_real_escape_string($con, $_POST["userPassword"]); 
      $confirmpassword = mysqli_real_escape_string($con, $_POST["confirmpassword"]); 
	  //$img = "immmm";
      $userPassword = mysqli_real_escape_string($con, password_hash($_POST["userPassword"], PASSWORD_DEFAULT));
	  
      if ($userPass != $confirmpassword) {
            echo '<script>alert("Password not match")</script>';
            include "loginsample.php";
      }
	  else if($type=="Select User Type"){
		  echo '<script>alert("Select user type")</script>';
		    include "loginsample.php";
	  }
	  
	  else{
	  
	   if($type=="Lecture"){
		  $d=mysqli_query($con,"SELECT * FROM lecture where regno=$regno");
		  $d1=mysqli_query($con,"SELECT * FROM credentials where regId=(SELECT lectureId FROM lecture WHERE regno=$regno)");
		   $d2=mysqli_query($con,"SELECT * FROM credentials where userName=$userName");
		  $t1=mysqli_num_rows($d1);
		  $t=mysqli_num_rows($d);
        if($t!=1)
        {
			
			echo '<script>alert("Regno not Registered")</script>';
            include "loginsample.php";  
		  }
		  else if($t1==1){
			 echo '<script>alert("Regno exist")</script>';
            include "loginsample.php"; 
		  }
		 
		  else{

      $query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,status,regId,image) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."Active"."',(SELECT lectureId FROM lecture where regno=$regno LIMIT 1), '"."img.png"."')");
	  
	  }
      if($query)  
      {  
  

  echo "<script>window.location='welcome.php'</script>";  

      } else{
           echo '<script>alert("userName exist")</script>';
            include "loginsample.php";
      } 
		  
	  }
	   if($type=="Student"){
		  $d=mysqli_query($con,"SELECT * FROM student where regno=$regno");
		  $d1=mysqli_query($con,"SELECT * FROM credentials where regId=(SELECT studentId FROM student WHERE regno=$regno)");
		  $t1=mysqli_num_rows($d1);
		 $t=mysqli_num_rows($d);
        if($t!=1)
        {
			echo '<script>alert("Regno not Registered")</script>';
            include "loginsample.php";  
		  }
		  else if($t1==1){
			 echo '<script>alert("Regno exist")</script>';
            include "loginsample.php"; 
		  }
		 
		  else{

     $query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,status,regId,image) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."Active"."',(SELECT studentId FROM student where regno=$regno LIMIT 1), '"."studentIcon.png"."')");
	  	 
	 }
      if($query)  
      {  
   
           echo "<script>window.location='welcome.php'</script>"; 

      } else{
            echo '<script>alert("userName exist")</script>';
            include "loginsample.php";
      } 
	  }
      
	   if($type=="Office"){
		  $d=mysqli_query($con,"SELECT * FROM office where officeRegno=$regno");
		  $d1=mysqli_query($con,"SELECT * FROM credentials where regId=(SELECT officeId FROM office WHERE officeRegno=$regno)");
		  $t1=mysqli_num_rows($d1);
		 $t=mysqli_num_rows($d);
        if($t!=1)
        {
			echo '<script>alert("Regno not Registered")</script>';
            include "loginsample.php";  
		  }
		  else if($t1==1){
			 echo '<script>alert("Regno exist")</script>';
            include "loginsample.php"; 
		  }
		 
		  else{

      //$query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,imagee,status,regId) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."imgg"."', '"."Active"."',(SELECT officeId FROM office where officeRegno=$regno LIMIT 1))");
	   $query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,status,regId,image) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."Active"."',(SELECT officeId FROM office where officeRegno=$regno LIMIT 1), '"."officeIcon.png"."')");
	  
	  }
      if($query)  
      {  
           echo "<script>window.location='welcome.php'</script>"; 

      } else{
          echo '<script>alert("userName exist")</script>';
            include "loginsample.php";
      } 
	  }
	  
	  if($type=="Admin"){
		  $d=mysqli_query($con,"SELECT * FROM admin where regno=$regno");
		  $d1=mysqli_query($con,"SELECT * FROM credentials where regId=(SELECT adminId FROM admin WHERE regno=$regno)");
		  $t1=mysqli_num_rows($d1);
		 $t=mysqli_num_rows($d);
        if($t!=1)
        {
			echo '<script>alert("Regno not Registered")</script>';
            include "loginsample.php";  
		  }
		  else if($t1==1){
			 echo '<script>alert("Regno exist")</script>';
            include "loginsample.php"; 
		  }
		 
		  else{

      //$query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,imagee,status,regId) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."imgg"."', '"."Active"."',(SELECT officeId FROM office where officeRegno=$regno LIMIT 1))");
	   $query =mysqli_query($con, "INSERT INTO credentials(userName,userPassword,userTitle,status,regId,image) VALUES ('".$userName."', '".$userPassword."', '".$type."', '"."Active"."',(SELECT adminId FROM admin where regno=$regno LIMIT 1), '"."img.png"."')");
	  
	  }
      if($query)  
      {  
            echo "<script>window.location='welcome.php'</script>"; 

      } else{
            echo '<script>alert("userName exist")</script>';
            include "loginsample.php";
      } 
	  }
	  
	  }  
	 
 }  
 ?>
