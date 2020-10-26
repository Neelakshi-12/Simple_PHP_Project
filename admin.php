<?php
include("includes/header.php");
include("includes/functions.php");
include("includes/config.php");

session_start();

$msg='';$msg2='';$fname='';
if(isset($_POST['submit']))
{
	$fname=$_POST['name'];
	$password=$_POST['pass'];

	if(empty($fname))
	{
		$msg='<div class="error">PLEASE ENTER YOUR NAME!!</div>';
	}
	else if(empty($password))
	{
		$msg2='<div class="error">PLEASE ENTER YOUR PASSWORD!!</div>';
	}
	else 
	{
		$pass=mysqli_query($con,"SELECT password FROM admin WHERE name='$fname'");
		$pass_w=mysqli_fetch_array($pass);
		$dpass=$pass_w['password'];
		if ($password!==$dpass)
		{
			$msg2='<div class="error">PASSWORD IS WRONG!!</div>';
		}
		else
		{
			$_SESSION['name']=$fname;			
			header("location:admin-panel.php");
		}
	}
	
}
?>
<title>ADMIN LOGIN</title>
<style type="text/css">
	.error
	{
		color: red;
	}
	#body-bg
	{
		background: url(images/background.jpg)center no-repeat fixed;
	}
</style>

<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="body-bg">
	
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="images/pic.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="images/logo.png" alt="logo" class="logo">
              </div>
              <p class="login-card-description" style="color: red;">ADMIN <b style="color: black;">LOGIN</b></p>
              <form method="post">
			       <div class="form-group">
						<label>User Name :</label>
						<input type="text" name="name" class="form-control" value="<?php echo $fname ; ?>" placeholder="User Name" >
						<?php echo $msg; ?>
					</div>
					<div class="form-group">
						<label>PASSWORD :</label>
						<input type="password" name="pass" class="form-control" placeholder="Password">
						<?php echo $msg2; ?>
					</div>					
					<div class="form-group">
						<center><input type="submit" name="submit" value="LOGIN" class="btn btn-success"></center>
					</div>
                </form>
                
            </div>
          </div>
        </div>
      </div>
      
    </div>
</main>
</body>
</html>