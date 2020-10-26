<?php
include("includes/config.php");
include('includes/header.php'); 
include("includes/functions.php");

$msg='';$msg2='';$msg3='';$msg4='';
$firstname='';$lastname='';$email='';$date='';
$id=$_GET['user'];

if (isset($id)) 
{

	$result=mysqli_query($con,"SELECT first_name,last_name,dob,mail FROM users WHERE id='$id' ");
    
    $retrive=mysqli_fetch_array($result) or die(mysqli_error($result)); 


  	$name=$retrive['first_name'];
  	$last=$retrive['last_name'];
  	$mail=$retrive['mail'];
  	$dob=$retrive['dob'];
 } 	
if (isset($_POST['submit'])) 
{
	
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$email=$_POST['mail2'];
	$date=$_POST['dob2'];

	if (strlen($firstname)<3) {
		$msg="<div class='error' >First name must contain atleast 3 characters.!!</div>";
	}
	else if (strlen($lastname)<3) {
		$msg2="<div class='error' >Last name must contain atleast 3 characters.!!</div>";
	}
	else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$msg3="<div class='error' >Enter Valid Email!!</div>";
	}

	else if(empty($date))
	{
		$msg4="<div class='error' >Please enter the date of birth!!</div>";
	}
	else
	{
	
		mysqli_query($con,"UPDATE  users SET first_name='$firstname',last_name='$lastname',mail='$email',dob='$date'  WHERE id='$id'");
			
			header("location:admin-panel.php");
            $firstname='';$lastname='';$email='';$date='';
	}   
		
}
?>
<title>UPDATE USER DETAILS</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<style type="text/css">
	#body-bg
	{
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
			  <p class="login-card-description" style="color: red;">UPDATE USER  <b style="color: black;">DETAILS HERE!!</b></p>
			
              <form method="post">
			  <div class="form-group mb-4">
					<label>First Name : </label>
					<input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $name; ?>">
					<?php echo $msg; ?>
					</div>
					<div class="form-group mb-4">
					<label>Last Name : </label>
					<input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $last; ?>">
					<?php echo $msg2; ?>
					</div>
					<div class="form-group mb-4">
					<label>Email : </label>
					<input type="email" name="mail2" class="form-control" placeholder="Email Address" value="<?php echo $mail; ?>">
					<?php echo $msg3; ?>
					</div>
					<div class="form-group mb-4">
					<label>Date of Birth : </label>
					<input type="date" name="dob2" class="form-control" placeholder="Birth date" value="<?php echo $dob; ?>">
					<?php echo $msg4; ?>
					</div> 
					<div class="form-group  mb-4">
					<center><input type="submit" name="submit" value="Update" class="btn btn-success"></center>
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