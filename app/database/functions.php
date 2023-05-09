<?php

session_start();
require('connection.php');

function isLoggedIn()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
        return true;
    } else {
        return false;
    }
}