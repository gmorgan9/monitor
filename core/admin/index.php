<?php

require_once "../../app/database/connection.php";
require_once "../../app/database/functions.php";
require_once "../../path.php";
session_start();

if (!isLoggedIn()) {
    header('Location: ' . BASE_URL . '/core/entry/login.php');
    exit;
}

if (!isAdmin()) {
    header('Location: ' . BASE_URL . '/core/alerts/');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>LogDetect | Admin</title>
</head>
<body>
<?php include("../../app/includes/header.php"); ?>

<div class="container">
        <h1>Welcome to the Admin Page</h1>
        <p>This is the protected area for admin users only.</p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Account</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $sql = "SELECT * FROM users";
                $all = mysqli_query($conn, $sql);
                if($all) {
                    while ($row = mysqli_fetch_assoc($all)) {
                        $idno     = $row['idno'];
                        $email       = $row['email'];
                        $uname       = $row['username'];
                        $fname       = $row['firstname'];
                        $lname       = $row['lastname'];
                        $admin       = $row['isadmin'];
                        $status      = $row['status'];
                    }
            ?>
                

                    <tr>
                        <td><?php echo $idno; ?></td>
                        <td><?php echo $lname; ?>, <?php echo $fname; ?></td>
                        <td><?php echo $uname; ?></td>
                        <td><?php echo $admin; ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
