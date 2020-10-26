<?php
include("includes/config.php");
include('includes/header.php'); 
include("includes/functions.php");

$id=$_GET['id'];
if (isset($id)) 
{

$msg='';$msg1='';$msg2='';

if(isset($_POST['submit']))
{

	$password=$_POST['pass'];
	$cpassword=$_POST['cpass'];
	if(empty($password))
	{
		$msg="<div class='error' >Please enter your Password!!</div>";
	}
	else if (strlen($password)<5)
	{
		$msg="<div class='error' >Password must contain atleast 5 characters!!</div>";
	}	
	else if(empty($cpassword))
	{
		$msg2="<div class='error' >Please Re-enter your Password!!</div>";
	}
	else if ($password!=$cpassword)
	{
		$msg2="<div class='error' >Password does not Match!!</div>";
	}
	else
	{
		$pass=md5($password);
		mysqli_query($con,"UPDATE users SET password='$password' WHERE id='$id'");
			$msg1="<div class='success'><center>Password Changed Successfully !!</center></div>" ;
	}
	
}

?>
<title>Change Password</title>

<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
</head>
<style type="text/css">
	#body-bg
	{
		background-color: #efefef;
	}
	.box
	{
       border: 1px solid grey;
       padding: 20px;
       border-radius: 5px;
       box-shadow: 3px 3px 3px black;
       background-color: grey;
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

	<div class="container" style=" padding-top: 50px; background-color: #fff; margin-top: 20px;margin-bottom: 20px;width: 1200px;height: 640px;">
		
		<a href="profile.php"><button class="btn btn-outline-danger" style="float: right;">Back</button></a>

		<div class="col-md-4 offset-md-4"> 
			<div class="box">
		<h2 align="center">Change Password</h2>
		<br>
		<center><?php echo $msg1; ?></center>
		<form method="post">

					<div class="form-group">
						<label>NEW PASSWORD :</label>
						<input type="password" name="pass" placeholder="Enter new Password" class="form-control">
						<?php echo $msg; ?>
					</div>
					<div class="form-group">
						<label>RE-ENTER PASSWORD :</label>
						<input type="password" name="cpass" placeholder="Re-Enter new Password" class="form-control">
						<?php echo $msg2; ?>
					</div>
					<br>
					<center><button class="btn btn-success" name="submit">Submit</button></center>
					<center><a href="forgot.php">FORGOT PASSWORD?? </a></center>
				</form>
		 </div>	
		 </div>	

	</div>
</body>
</html>

<?php 

}
else
{
header("location:login.php");
}

?>