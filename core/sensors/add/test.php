<?php

require_once "/../../../app/database/connection.php";
require_once "/../../../app/database/functions.php";
require_once "/../../../path.php";
require_once "/../../../execute.php";

session_start();

if (!isLoggedIn()) {
    header('Location: ' . BASE_URL . '/core/entry/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Sensors | LogDetect</title>
</head>
<body>

    <?php include("../../../app/includes/header.php"); ?>

    <div class="container">

    </div>

</body>
</html>