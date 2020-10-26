<?php
include("includes/config.php");
include('includes/header.php'); 
include("includes/functions.php");

$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
if (isset($_POST['submit'])) {
	# code...
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$email=$_POST['mail'];
	$password=$_POST['pass'];
	$c_password=$_POST['cpass'];
	$image=$_FILES['image']['name'];
	$tmp_image=$_FILES['image']['tmp_name'];
	$size_image=$_FILES['image']['size'];
	$date=$_POST['dob'];
	$checkbox=isset($_POST['check']);
	//echo $firstname."</br>".$lastname."</br>".$email//."</br>.".$date."</br>".$password."</br>".$c_pas//sword."</br>".$image."</br>".$checkbox;
	if (strlen($firstname)<3) {
		$msg="<div class='error' >First name must contain atleast 3 characters.!!</div>";
	}
	else if (strlen($lastname)<3) {
		$msg2="<div class='error' >Last name must contain atleast 3 characters.!!</div>";
	}
	else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$msg3="<div class='error' >Enter Valid Email!!</div>";
	}
	else if (email_exists($email,$con)) {
		$msg3="<div class='error' >Email already EXISTS!!</div>";
	}
	else if(empty($date))
	{
		$msg4="<div class='error' >Please enter the date of birth!!</div>";
	}
	else if(empty($password))
	{
		$msg5="<div class='error' >Please enter your Password!!</div>";
	}
	else if (strlen($password)<5)
	{
		$msg5="<div class='error' >Password must contain atleast 5 characters!!</div>";
	}	
	else if ($password!=$c_password)
	{
		$msg6="<div class='error' >Password is not same!!</div>";
	}
	else if ($image=='')
	{
		$msg7="<div class='error' >Please upload a profile pic!!</div>";		
	}
	else if ($size_image>=1000000) {
		$msg7="<div class='error' >Please upload Image less than 1 MB!!</div>";
	}
	else if ($checkbox!='on')
	{
		$msg8="<div class='error' >Please agree terms and conditions!!</div>";
	}
	else
	{
		$password=md5($password);
		$img_ext=explode(".", $image);
		$image_ext=$img_ext['1'];
		$image=rand(1,1000).rand(1,1000).time().".".$image_ext;
		if($image_ext=='jpg' || $image_ext=='png' ||$image_ext=='JPG' ||$image_ext=='PNG' )
		{
			move_uploaded_file($tmp_image, "images/$image");
		mysqli_query($con,"INSERT INTO users(first_name,last_name,mail,dob,password,img)
			VALUES ('$firstname','$lastname','$email','$date','$password','$image')");
			$msg9="<div class='success'><center>You are Successfully Registered!!</center></div>" ;
            $firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
		}   
		else
		{
			$msg7="<div class='error'>Please Upload a Image file</div>";
		} 
	}
 }
?>
<title>Signup</title>

<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
<link rel="stylesheet" type="text/css" href="css/signup.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	#body-bg
	{
		background-color: black;
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
	<div class="container px-2 px-md-4 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-5">
                <div class="card1 pb-5">
                    <div class="row px-3">
                        <h5 class="logo"><b style="color: white;font-size: 2em;">YAZISA</b></h5>
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" id="li1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1" id="li2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" id="li3" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3" id="li4"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="4" id="li5"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item card border-0 card-0">
                                    <div class="text-center"> <img src="images/slide1.jpg" class="img-fluid profile-pic"> </div>
                                    <h6 class="font-weight-bold mt-5" style="color: red;">― The Joker</h6> 
                                    <hr width="50%">
                                    <p class="content mt-2 mb-0"><b> “And he didn’t die all at once. It was hours before the screaming stopped. I almost didn’t get to sleep that night. That was the last time I’d used crushed glass”</b>   </p>
                                </div>
                                <div class="carousel-item card border-0 card-0">
                                    <div class="text-center"> <img src="images/slide2.jpg" class="img-fluid profile-pic"> </div>
                                    <h6 class="font-weight-bold mt-5" style="color: red;">― The Joker</h6> 
                                    <hr width="50%">
                                    <p class="content mt-2 mb-0"><b>“Smile, because it confuses people. Smile, because it’s easier than explaining what is killing you inside.”</b></p>
                                </div>
                                <div class="carousel-item active card border-0 card-0">
                                    <div class="text-center"> <img src="images/slide3.jpg" class="img-fluid profile-pic"> </div>
                                    <h6 class="font-weight-bold mt-5" style="color: red;">― The Joker</h6> 
                                    <hr width="50%">
                                    <p class="content mt-2 mb-0"><b>“I don’t wanna kill you, what would I do without you? Go back to rippin’ off mob dealers… no, no, no… no you, you complete me.”</b></p>
                                </div>
                                <div class="carousel-item card border-0 card-0">
                                    <div class="text-center"> <img src="images/slide4.jpg" class="img-fluid profile-pic"> </div>
                                    <h6 class="font-weight-bold mt-5" style="color: red;">― The Joker</h6>
                                    <hr width="50%">
                                    <p class="content mt-2 mb-0"><b>“Madness is the emergency exit. You can just step outside, and close the door on all those dreadful things that happened. You can lock them away… forever.”</b></p>
                                </div>
                                <div class="carousel-item card border-0 card-0">
                                    <div class="text-center"> <img src="images/pic.jpg" class="img-fluid profile-pic"> </div>
                                    <h6 class="font-weight-bold mt-5" style="color: red;">― The Joker</h6> 
                                    <hr width="50%">
                                    <p class="content mt-2 mb-0"><b> “Now comes the part where I relieve you, the little people, of the burden of your failed and useless lives. But, as my plastic surgeon always said: if you gotta go, go with a smile.”</b> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 text-center justify-content-center mb-0 social"> <span class="fa fa-facebook-square mx-2"></span> <span class="fa fa-twitter mx-2"></span> <span class="fa fa-instagram mx-2"></span> <span class="fa fa-youtube-play mx-2"></span> </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card2 card border-0 px-4 px-sm-5 py-5">
                    <h3 class="mb-1" style="color: red;">Sign up to <img src="images/logo.png"></h3>
                    
                    <?php echo $msg9; ?>
                    
                    <form method="post" enctype="multipart/form-data">
                    <div class="row mt-3 form-group">
                        <div class="col-md-6"> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Full Name : </h6>
                            </label>  
                            <input type="text" name="fname" class="form-control" style="background-color: #000000b0;color: white;" placeholder="First Name" value="<?php echo $firstname; ?>" >
					<?php echo $msg; ?>
                        </div>
                        <div class="col-md-6 "> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Last Name : </h6>
                            </label> <input type="text" name="lname" class="form-control" style="background-color: #000000b0;color: white;" placeholder="Last Name" value="<?php echo $lastname; ?>">
					<?php echo $msg2; ?>
					 </div>
                    </div>
                    <div class="row mt-3 form-group">
                        <div class="col-md-6"> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Email :</h6>
                            </label>  
                            <input type="email" name="mail" class="form-control" style="background-color: #000000b0;color: white;"  placeholder="Email Address" value="<?php echo $email; ?>">
					<?php echo $msg3; ?>
                        </div>
                        <div class="col-md-6"> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Date of Birth :</h6>
                            </label> <input type="date" name="dob" class="form-control" style="background-color: #000000b0;color: white;"  placeholder="Birth date" value="<?php echo $date; ?>">
					<?php echo $msg4; ?>
					 </div>
                    </div>
                    <div class="row mt-3 form-group">
                        <div class="col-md-6"> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Password : </h6>
                            </label>  
                            <input type="password" name="pass" class="form-control" style="background-color: #000000b0;color: white;"  placeholder="Password" value="<?php echo $password; ?>">
					<?php echo $msg5; ?>
                        </div>
                        <div class="col-md-6 "> <label class="mb-0">
                                <h6 class="mb-0 text-sm">Re-enter Password : </h6>
                            </label><input type="password" name="cpass" class="form-control" style="background-color: #000000b0;color: white;" placeholder="Re-enter Password" value="<?php echo $c_password; ?>">
					<?php echo $msg6; ?>
					 </div>
                    </div>
                    <div class="row px-3 form-group"> <label class="mb-0">
                            <h6 class="mb-0 text-sm">Profile Image :</h6>
                        </label> <input type="file" name="image" value="<?php echo $image;?>">
					<?php echo $msg7; ?>
					 </div>
                   <center><input type="checkbox" name="check" style="margin-bottom: 0px;">
					I Agree the terms and conditions
					<?php echo $msg8; ?></center>
					<br>
                    <center><input type="submit" name="submit" value="Submit" class="btn btn-success" style="background-color: #bf0603;"></center>
					<center>Already Registered ?? <a href="login.php"><b style="color: red;"> LOGIN HERE !!</b></a><br> </center>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>