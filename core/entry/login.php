<?php

require_once "../../app/database/connection.php";
require_once "../../app/database/functions.php";
require_once "../../path.php";

session_start();

// if (isLoggedIn() == true) {
//     header('Location: ' . BASE_URL . '/core/entry/login.php');
//     exit;
// }


if(isset($_POST['login-btn'])){

	$uid = mysqli_real_escape_string($conn, $_POST['user_id']);
	$uname = mysqli_real_escape_string($conn, $_POST['uname']);
	$pass = md5($_POST['password']);
	// $cpass = md5($_POST['cpassword']);
	$isadmin = $_POST['isadmin'];
	$loggedin = $_POST['loggedin'];
 
	$select = " SELECT * FROM users WHERE username = '$uname' && password = '$pass' ";
 
	$result = mysqli_query($conn, $select);
 
	if(mysqli_num_rows($result) > 0){
 
	   $row = mysqli_fetch_array($result);
	   $sql = "UPDATE users SET loggedin='1' WHERE username='$uname'";
	   mysqli_query($conn, $sql);
		$_SESSION['fname']           = $row['firstname'];
		$_SESSION['uid']             = $row['user_id'];
		$_SESSION['loggedin']        = $row['loggedin'];
		$_SESSION['employee_idno']   = $row['idno'];
		$_SESSION['lname']           = $row['lastname'];
		$_SESSION['uname']           = $row['username'];
	   $_SESSION['email']            = $row['email'];
	   $_SESSION['pass']             = $row['password'];
	   header('location:' . BASE_URL . '/core/alerts.php');
	  
	}else{
	   $error[] = 'incorrect email or password!';
	}
 
 };
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Monitor | Login</title>

<!-- Custom Styles -->
<!-- <link rel="stylesheet" href="<?php //echo BASE_URL . '/assets/css/main-style.css?v='. time(); ?>"> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body>

<?php include("../../app/includes/header.php"); ?>
   
<br><br><br>
<div class="form-container mx-auto">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="uname" required placeholder="enter your user name">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="login-btn" value="Login" class="form-btn">
      <p>don't have an account? <a href="/pages/entry/register.php">register now</a></p>
   </form>

</div>

<?php //include("../../app/includes/footer.php"); ?>

</body>
</html>