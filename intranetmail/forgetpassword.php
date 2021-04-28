<?php
$con = mysqli_connect("localhost", "root", "", "mailserver"); 
 session_start();

if(isset($_POST["send"]))  
 { 
if(empty($_POST["regno"]))  
      {  
           //echo '<script>alert("Both Fields are required")</script>'; 
$err= "<font color='red'>Fill regNo</font>";		   
      }else{
		  
		  $regno = mysqli_real_escape_string($con, $_POST["regno"]); 
		  $query = "SELECT * FROM credentials WHERE regno = '$regno'";  
          $result = mysqli_query($con, $query);
		  if(mysqli_num_rows($result) > 0)  
           {  
                while($row = mysqli_fetch_array($result))  
		   { 
	   
	   
	   }}
	  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Forget password</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="assets/css/style.css">

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
			<div class="col-md-12 col-lg-12 login-right">
										<div class="login-header">
											<h3>Forgot Password?</h3>
											<p class="small text-muted">Enter your email to get a password reset link</p>
										</div>
										
										<!-- Forgot Password Form -->
										<form action="https://doccure-html.dreamguystech.com/template/login.html">
											<div class="form-group form-focus">
												<input type="email" class="form-control floating">
												<label class="focus-label">Email</label>
											</div><br>
											<div class="text-right">
												<a class="forgot-link" href="loginsample.php">Remember your password?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Reset Password</button>
										</form>
										<!-- /Forgot Password Form -->
										
									</div>
			
		</div>
		</div>
		
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