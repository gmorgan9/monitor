<?php
session_start();

require_once '../../../app/database/connection.php';
// require_once "../../../app/database/functions.php";
// require_once '../../../app/database/functions.php';
include(ROOT_PATH . "/path.php");
// require_once '../../../path.php';


// if (!isLoggedIn()) {
//     header('Location: ' . BASE_URL . '/core/entry/login.php');
//     exit;
// }
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

    <title>Add New Sensor | LogDetect</title>
</head>
<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    
    <!-- container -->
        <div class="container">

            <h1>
                Add New Sensor
            </h1>

            <form>
                <div class="mb-3">
                <label for="deployment_id" class="form-label">Deployment ID</label>
                <input type="text" class="form-control" id="deployment_id" placeholder="Enter deployment ID">
                </div>
                <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="mb-3">
                <label for="ip_addr" class="form-label">IP Address</label>
                <input type="text" class="form-control" id="ip_addr" placeholder="Enter IP address">
                </div>
                <div class="mb-3">
                <label for="sensor_type" class="form-label">Sensor Type</label>
                <select class="form-control" id="sensor_type">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
                </div>
                <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" rows="3" placeholder="Enter notes"></textarea>
                </div>
            </form>

        </div>
    <!-- end container -->


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
