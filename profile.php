<?php
include("includes/config.php");
include('includes/header.php'); 

session_start();
include("includes/functions.php");

if (logged_in())
{
    header("location:login.php");
}
else if(isset($_COOKIE['name']))

{
    //echo "YOU ARE LOGGED THROUGH COOKIES";
    $email=$_COOKIE['name'];

$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
    $id=$retrive['id'];
    $firstname=$retrive['first_name'];
    $lastname=$retrive['last_name'];
    $image=$retrive['img'];

?>

<title>Profie page</title>
</head>

<body style="background:url('images/stars.jpeg')">
<center style="margin-top: 12rem;">    <div class="col-md-4">
                <div class="card profile-card-1">
                    <img src="images/banner.png" alt="profile-sample1" class="background"/>
                    <img src="images/<?php echo $image ?>" alt="profile-image" class="profile"/>
                    <div class="card-content">
                       
                    <h2 style="text-align: center;">WELCOME!!<b style="color:red;"> <?php echo ucfirst($firstname)." ".ucfirst($lastname);  ?></b></h2>
                      <div class="icon-block"><a href="logout.php"><button class="btn btn-outline-success" style="float: right;">Logout</button></a><a href="change-password.php?id=<?php echo $id;?>"><button class="btn btn-outline-primary" style="float: left;">Change Password</button></a>
                      </div>
                    </div>
                </div>
            <p class="mt-3 w-100 float-left text-center"><strong>Profile Card</strong></p>
      </div>
</center>

</body>
</html>
<?php
}
else{

    //echo "YOU ARE LOGGED THROUGH SESSIONS.";
    $email=$_SESSION['mail'];

    $result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
    $id=$retrive['id'];
    $firstname=$retrive['first_name'];
    $lastname=$retrive['last_name'];
    $image=$retrive['img'];

?>
<title>Profie page</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
</head>
<style type="text/css">
    #body-bg
    {
        background-color: #efefef;
    }
    
</style>
<body id="body-bg">
    <div class="col-md-4">
                <div class="card profile-card-1">
                    <img src="https://images.pexels.com/photos/946351/pexels-photo-946351.jpeg?w=500&h=650&auto=compress&cs=tinysrgb" alt="profile-sample1" class="background"/>
                    <img src="images/<?php echo $image ?>" alt="profile-image" class="profile"/>
                    <h2 align="center">WELCOME!! <?php echo ucfirst($firstname)." ".ucfirst($lastname);  ?></h2>
                    <div class="card-content">
                       <h2>Savannah Fields<small>Engineer</small></h2>
                      <div class="icon-block"><a href="logout.php"><button class="btn btn-outline-success" style="float: right;">Logout</button></a><a href="change-password.php?id=<?php echo $id;?>"><button class="btn btn-outline-primary" style="float: left;">Change Password</button></a>
                      </div>
                    </div>
                </div>
                
                <p class="mt-3 w-100 float-left text-center"><strong>Basic Profile Card</strong></p>
      </div>

</body>
</html>

<?php
}
?>