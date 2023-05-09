<?php

require_once "../../../app/database/connection.php";
require_once "../../../app/database/functions.php";
require_once "../../../path.php";
require_once "../../../execute.php";

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
    <style>
        .add-sense {
            color: #3b6e5e;
            border-color: #3b6e5e;
        }
        .add-sense:hover {
            background-color: #3b6e5e;
            border-color: #3b6e5e;
        }
        .cancel-sense {
            color: #3b6e5e;
        }
    </style>
</head>
<body>

    <?php include("../../../app/includes/header.php"); ?>

    <div class="container">

        <div class="heading mt-3 mb-2 w-75 mx-auto">
            <h1 class="mt-3 mb-2">
                Add New Sensor
            </h1>
        </div>

        <form action="" method="post" class="w-75 mx-auto">

            <div class="row">
                <div class="col-md-6">
                <div class="mb-3">
                    <label for="deployment_id" class="form-label">Deployment ID</label>
                    <input type="text" class="form-control" id="deployment_id" placeholder="Enter deployment ID">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="ip_addr" class="form-label">IP Address</label>
                    <input type="text" class="form-control" id="ip_addr" placeholder="Enter IP address">
                </div>
                <div class="mb-3">
                    <label for="sensor_type" class="form-label">Sensor Type</label>
                    <select class="form-control" id="sensor_type">
                        <option value="" disabled selected style="color: #6c757d;">Select Sensor Type</option>
                        <option value="raspberry-pi">Raspberry Pi</option>
                        <option value="vm-container">VM Container</option>
                        <!-- <option value="option3">Option 3</option> -->
                    </select>
                </div>
            </div>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" rows="3" placeholder="Enter notes"></textarea>
            </div>
            <div class="text-center float-end">
                <a href="<?php echo BASE_URL . '/core/sensors/'; ?>" class="text-decoration-none cancel-sense float-end">Cancel</button> &nbsp;&nbsp;
                <button type="submit" class="btn btn-outline-primary add-sense btn-sm">Add New Sensor</button>
            </div>
        </form>

    </div>

</body>
</html>