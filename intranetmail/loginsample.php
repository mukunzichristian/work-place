

<?php
 $con = mysqli_connect("localhost", "root", "", "mailserver"); 
 session_start();

if(isset($_POST["login"]))  
 {  

      if(empty($_POST["userName"]))  
      {  
           //echo '<script>alert("Both Fields are required")</script>'; 
$err= "<font color='red'>Fill userName</font>";		   
      } 
 if(empty($_POST["userPassword"])){
	$er= "<font color='red'>Fill password</font>";	
}	  
      else  
      {  
           $username = mysqli_real_escape_string($con, $_POST["userName"]);  
           $password = mysqli_real_escape_string($con, $_POST["userPassword"]); 
           //$_SESSION['userName'] = $username; 
           $query = "SELECT * FROM credentials WHERE userName = '$username'";  
           $result = mysqli_query($con, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                while($row = mysqli_fetch_array($result))  
                {  
			
                     if(password_verify($password, $row["userPassword"]) && $row["status"] != "Inactive")  
                     {  
                          //return true;  
                         $_SESSION["userName"] = $username;  
                     
                         $_SESSION["userTitle"]=$row['userTitle'];
						 $_SESSION["credentialsId"]=$row['credentialsId'];
						 
						 if($row["userTitle"]=="Admin"){
						 header("location:home2.php");
						 }else{
							 $id=$_SESSION["credentialsId"];
							 
		  $sql="SELECT * FROM logeduser WHERE credentialsId=(select credentialsId from credentials where userName='$username')";  
           $result1= mysqli_query($con, $sql);  
           $row = mysqli_fetch_array($result1);
		   $curDates=date('yy-m-d');
		   if($curDates!=$row["dates"] && $id!=$row["credentialsId"]){
		   $query="insert into logeduser(credentialsId,dates) VALUES('".$id."',now())";
		   mysqli_query($con, $query);
		                  
		   }
		   header("location:home2.php");
						  
						 }						  
                     }
                     elseif(password_verify($password, $row["userPassword"]) && $row["status"] == "Inactive")  {
                       	echo '<script>alert("Your account is locked contact an administrator for details!")</script>';
                       }  
                     else  
                     {  
                          //return false;  
                          echo '<script>alert("Wrong username or password!")</script>';  
                     }  
                }  
           }  
      }  
 }
if(isset($_POST['cancel'])){
	 $_POST["type"]="";
       $_POST["regno"]=""; 
      $_POST["userName"]="";  
      $_POST["userPassword"]=""; 
       $_POST["confirmpassword"]="";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="csss/css/bootstrap.min.css">
	<link rel="stylesheet" href="csss/css/azzara.min.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container-login animated fadeIn">
			<h3 class="text-center">Sign In To IntraMail</h3>
			
			<div class="login-form">
				<form method="post">
				<div class="form-group form-floating-label">
					<input id="userName" name="userName" type="email" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Email</label>
					<?php //echo @$err; ?>
				</div>
				<div class="form-group form-floating-label">
					<input id="userPassword" name="userPassword" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
					<?php //echo @$er; ?>
				</div>
				
				<div class="text-right">
				<a class="forgot-link" href="forgetpassword.php">Forgot Password?</a>
				</div>
				
				<div class="form-action mb-3">
					<input type="submit" value="Sign In" id="login" name="login" class="btn btn-primary btn-rounded btn-login mr-3">
				</div>
				
				<div class="login-account">
					<span class="msg">Don't have an account yet?</span>
					<a href="#" id="show-signup" class="link">Sign Up</a>
				</div>
				</form>
			</div>
		</div>

		
		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up to IntraMail</h3>
			<div class="login-form">
				<form action="registrationsample.php" method="POST">
				
				<div class="form-group form-floating-label">
					<input  id="regno" name="regno" type="text" class="form-control input-border-bottom" required>
					<label for="regno" class="placeholder">regNo</label>
				</div>
				
				
				<div class="form-group form-floating-label">
				
		   <select class="form-control input-border-bottom" id="sel1" name="type" required>
          <option selected >Select User Type</option>		   
              <option>Lecture</option>  
              <option>Student</option>  
              <option>Office</option>
              <option>Admin</option>			  
           </select>  
	   
				</div>
				
				
				<!--<div class="form-group form-floating-label">
					<input  id="file" name="file" type="file" class="form-control input-border-bottom" required>
					<label for="file" class="placeholder">Upload  Profile</label>
				</div>-->
				
				<div class="form-group form-floating-label">
					<input  id="userName" name="userName" type="email" class="form-control input-border-bottom" required>
					<label for="userName" class="placeholder">Email</label>
				</div>
				<div class="form-group form-floating-label">
					<input  id="userPassword" name="userPassword" type="password" class="form-control input-border-bottom" required>
					<label for="passwordsignin" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="form-group form-floating-label">
					<input  id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom" required>
					<label for="confirmpassword" class="placeholder">Confirm Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="form-action">
					<button type="reset" name="cancel" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</button>
					<input type="submit" value="Sign Up" name="submit" class="btn btn-primary btn-rounded btn-login mr-3">
				</div>
					<div class="login-account">
					<span class="msg">Already have an account?</span>
					<a href="#" id="show-signin" class="link">Sign In</a>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script src="javascript/js/jquery-3.2.0.min.js"></script>
	<script src="javascript/js/jquery-ui.min.js"></script>
	<script src="javascript/js/popper.min.js"></script>
	<script src="javascript/js/bootstrap.min.js"></script>
	<script src="javascript/js/ready.js"></script>
</body>
</html>
<script>  
 $(document).ready(function(){  
      $('#submit').click(function(){  
           var userName = $('#userName').val();  
           var userPassword = $('#userPassword').val();
           var confirmpassword = $('#confirmpassword').val();   
           if(userName == '' || userPassword == '' || confirmpassword == '')  
           {  
                $('#error_message').html("All Fields are required");  
           }  
           else  
           {  
                $('#error_message').html('');  
                $.ajax({  
                     url:"login1.php",  
                     method:"POST",  
                     data:{userName:userName, userPassword:userPassword, confirmpassword:confirmpassword},  
                     success:function(data){  
                          $("form").trigger("reset");  
                          $('#success_message').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#success_message').fadeOut("Slow");  
                          }, 2000);  
                     }  
                });  
           }  
      });  
 });  
 </script> 