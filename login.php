<?php
include("includes/header.php");
include("includes/functions.php");
include("includes/config.php");

session_start();
$msg='';$msg2='';$email='';
if(isset($_POST['submit']))
{
	$email=$_POST['mail'];
	$password=$_POST['pass'];
	$checkbox=isset($_POST['check']);

	if(empty($email))
	{
		$msg='<div class="error">PLEASE ENTER YOUR EMAIL!!</div>';
	}
	else if(empty($password))
	{
		$msg2='<div class="error">PLEASE ENTER YOUR PASSWORD!!</div>';
	}
	else if(email_exists($email,$con))
	{
		$pass=mysqli_query($con,"SELECT password FROM users WHERE mail='$email'");
		$pass_w=mysqli_fetch_array($pass);
		$dpass=$pass_w['password'];
		$password=md5($password);
		if ($password!==$dpass)
		{
			$msg2='<div class="error">PASSWORD IS WRONG!!</div>';
		}
		else
		{
			$_SESSION['mail']=$email;
			if ($checkbox=='on') {
				# code...
				setcookie('name',$email,time()+3000);
			}
			header("location:profile.php");
		}
	}
	else{
		$msg='<div class="error">EMAIL DOES NOT EXIST!!</div>';
	}
}
?>
<title>Login Form</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<style type="text/css">
	#body-bg
	{
		background-color: #000000b0;
	}
	.error{
		color: red;
	}
	.success{
		color: green;
		font-weight: bold;
	}
</style>
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
              <p class="login-card-description" style="color: red;">Sign into <b style="color: black;">your account</b></p>
              <form method="post">
                  <div class="form-group">
                    <label ><b>EMAIL :</b></label>
                    <input  id="email" type="email" name="mail" class="form-control" value="<?php echo $email ; ?>" placeholder="Email address" style="background-color: black;color: white;">
                    <?php echo $msg; ?>
                  </div>
                  <div class="form-group mb-4">
                    <label ><b>PASSWORD :</b></label>
                    <input  id="password"  placeholder="***********" type="password" name="pass" class="form-control" style="background-color: black;color: white;">
                    <?php echo $msg2; ?>
                  </div>
                  <div class="form-group  mb-4">
						<input type="checkbox" name="check">
						&nbsp; <b>Keep me logged In</b>
					</div><br>
                  <div class="form-group  mb-4">
						<center><input type="submit" name="submit" value="LOGIN" class="btn btn-success" style="background-color: #bf0603;width: 20rem;"></center>
					</div>
                </form>
                <a href="forgot.php" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text" style="color: green;">Don't have an account? <a href="signup.php" class="text-reset"><b style="color: red;">Register here</b></a></p>
              
            </div>
          </div>
        </div>
      </div>
      
    </div>
</main>
</body>
</html>