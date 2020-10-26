<?php 

session_start();
session_destroy();

header("location:admin.php");
setcookie('name','',time()-3000);

 ?>