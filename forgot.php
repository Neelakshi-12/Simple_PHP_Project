<?php
include("includes/config.php");
include('includes/header.php'); 
include("includes/functions.php");
$msg='';$msg1='';$msg2='';$msg3='';$msg4='';$email='';$date='';$password='';$cpassword='';
if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$date=$_POST['dob'];
	$password=$_POST['pass'];
	$cpassword=$_POST['cpass'];
	if (empty($email)) 
	{
		$msg="<div class='error' >Please enter your email!!</div>";

	}
	else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
	{
		$msg="<div class='error' >Enter Valid Email!!</div>";
	}	
	else if(empty($date))
	{
		$msg2="<div class='error' >Please enter the date of birth!!</div>";
	}
	else if(empty($password))
	{
		$msg3="<div class='error' >Please enter your Password!!</div>";
	}
	else if (strlen($password)<5)
	{
		$msg3="<div class='error' >Password must contain atleast 5 characters!!</div>";
	}		
	else if(empty($cpassword))
	{
		$msg4="<div class='error' >Please Re-enter your Password!!</div>";
	}
	else if ($password!=$cpassword)
	{
		$msg4="<div class='error' >Password does not Match!!</div>";
	}
	else if (email_exists($email,$con))
	{
		$result=mysqli_query($con,"SELECT dob FROM users WHERE mail='$email'");
		$retrive=mysqli_fetch_array($result);
		$DOB=$retrive['dob'];
		if($date==$DOB)
		{
			//$msg2="<div class='error' >COrrecT DOB!!</div>";
			
			$pass=md5($password);		    
		    mysqli_query($con,"UPDATE users SET password='$pass'");
			$msg1="<div class='success'><center>Password Changed Successfully !!</center></div>" ;
            $firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
		}  
		
		else
		{
			$msg2="<div class='error' >WRONG DOB!!</div>";

		}
	}
	else
		{
			$msg2="<div class='error' >email no exsit!!</div>";

		}	
}
?>
<title>Forgot Password??</title>
</head>
<style type="text/css">
	#body-bg
	{
		background: url(images/background.jpg)center no-repeat fixed;
	}
	.error{
		color: red;
	}
	.success{
		color: green;
		font-weight: bold;
	}
</style>
<body id="body-bg">
	<div class="container">
		<div class="col-md-4 login-form offset-md-4">
			<div class="jumbotron" style="margin-top: 20px;padding-top: 20px;padding-bottom: 30px;">
				<h3 align="center">Forgot Password??</h3>
				
				<center><?php echo $msg1; ?></center>
				<br>
				<form method="post">
					<div class="form-group">
						<label>Email : </label>
						<input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="<?php echo $email; ?>">
					<?php echo $msg; ?>
					</div>					
					<div class="form-group">
						<label>Date Of Birth : </label>
						<input type="date" name="dob" class="form-control" value="<?php echo $date; ?>">
						<?php echo $msg2; ?>
					</div>
					<div class="form-group">
						<label>New Password : </label>
						<input type="password" name="pass" class="form-control" placeholder="Enter your New Password" value="<?php echo $password; ?>">
						<?php echo $msg3; ?>
					</div>
					<div class="form-group">
						<label>Confirm Password : </label>
						<input type="password" name="cpass" class="form-control" placeholder="Enter your Password Again" value="<?php echo $cpassword; ?>">
						<?php echo $msg4; ?>
					</div>
					<center><button class="btn btn-success" name="submit">
						SUBMIT
					</button></center>
					<br>
					<center><a href="login.php">Back -></a></center>

				</form>
			</div>			
		</div>
	</div>
</body>
</html>