<?php

session_start();
require('connection.php');

function isLoggedIn() {
    return isset($_SESSION['fname']);
}
