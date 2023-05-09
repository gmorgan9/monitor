<?php
session_start();
require_once "../../path.php";
// include("/path.php");
require('connection.php');

function isLoggedIn() {
    return isset($_SESSION['fname']);
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
}


// LOGIN
    if(isset($_POST['login-btn'])){

    	$uid = mysqli_real_escape_string($conn, $_POST['user_id']);
    	$uname = mysqli_real_escape_string($conn, $_POST['uname']);
    	$pass = md5($_POST['password']);
    	// $cpass = md5($_POST['cpassword']);
    	$isadmin = $_POST['isadmin'];
    	$loggedin = $_POST['loggedin'];
    
    	$select = "SELECT * FROM users WHERE username = '$uname' && password = '$pass'";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['status'] === 'pending') {
                $error[] = 'Your account is pending approval.';
            } else {
                $sql = "UPDATE users SET loggedin='1' WHERE username='$uname'";
                mysqli_query($conn, $sql);

                $_SESSION['fname'] = $row['firstname'];
                $_SESSION['uid'] = $row['user_id'];
                $_SESSION['loggedin'] = $row['loggedin'];
                $_SESSION['idno'] = $row['idno'];
                $_SESSION['lname'] = $row['lastname'];
                $_SESSION['uname'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pass'] = $row['password'];
                $_SESSION['admin'] = $row['isadmin'];

                header('Location: /core/alerts/');
                exit;
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    }
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
    
        $select = " SELECT * FROM users WHERE username = '$uname' && email = '$email' && password = '$pass' ";
    
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

// ADD NEW SENSOR
    if(isset($_POST['add-sensor'])){

        // `deployment_id`, `name`, `ip_addr`, `sensor_type`, `notes`
        $idno = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        // $idno  = rand(10000, 99999); // figure how to not allow duplicates
        $deployment_id = mysqli_real_escape_string($conn, $_POST['deployment_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $ip_addr = mysqli_real_escape_string($conn, $_POST['ip_addr']);
        $sensor_type = mysqli_real_escape_string($conn, $_POST['sensor_type']);
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);
        // $acc_type = $_POST['acc_type'];

        $select = " SELECT * FROM sensors WHERE idno = '$idno' ";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';

        }else{

        if($pass != $cpass){
            $error[] = 'passwords do not match!';
        }else{
            $insert = "INSERT INTO sensors (idno, deployment_id, name, ip_addr, sensor_type, notes) VALUES('$idno', '$deployment_id', '$name', '$ip_addr', '$sensor_type', '$notes')";
            mysqli_query($conn, $insert);
            header('location:' . BASE_URL . '/core/sensors/');
        }
        }

    };
// end REGISTER