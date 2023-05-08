<!-- WORKING -->
<?php
session_start();
require_once "app/database/connection.php";
require_once "path.php";

$uid = $_SESSION['uid'];
$sql = "UPDATE users SET loggedin='0' WHERE user_id='$uid'";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

session_unset();
session_destroy();
header('location:' . BASE_URL . '/core/entry/login.php');

?>