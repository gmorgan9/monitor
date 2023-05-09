<?php

require_once "../../path.php";
session_start();
require('connection.php');

function isLoggedIn() {
    return isset($_SESSION['fname']);
}


// LOGIN
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
    	   header('location:' . BASE_URL . '/core/alerts/');
        
    	}else{
    	   $error[] = 'incorrect email or password!';
    	}
    
    };
// end LOGIN


// REGISTER
    if(isset($_POST['register-btn'])){

        $uid = mysqli_real_escape_string($conn, $_POST['user_id']);
        $idno  = rand(10000, 99999); // figure how to not allow duplicates
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $uname = mysqli_real_escape_string($conn, $_POST['uname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        // $acc_type = $_POST['acc_type'];
    
        $select = " SELECT * FROM users WHERE uname = '$uname' && email = '$email' && password = '$pass' ";
    
        $result = mysqli_query($conn, $select);
    
        if(mysqli_num_rows($result) > 0){
    
        $error[] = 'user already exist!';
    
        }else{
    
        if($pass != $cpass){
            $error[] = 'passwords do not match!';
        }else{
            $insert = "INSERT INTO users (idno, firstname, lastname, username, email, password) VALUES('$idno', '$fname','$lname','$uname','$email','$pass')";
            mysqli_query($conn, $insert);
            header('location:' . BASE_URL . '/core/entry/login.php');
        }
        }
    
    };
// end REGISTER