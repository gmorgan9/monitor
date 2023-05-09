<?php

require_once "../../app/database/connection.php";
require_once "../../app/database/functions.php";
require_once "../../path.php";
require_once "../../execute.php";

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

    <?php include("../../app/includes/header.php"); ?>
    
    <!-- container -->
        <div class="container">

        <?php echo ROOT_PATH; ?>
            <a href="<?php echo BASE_URL . '/core/sensors/add/' ?>" class="btn btn-primary btn-sm float-end mt-2 mb-2" style="background-color: #3b6e5e; border-color: #3b6e5e;">
                Add New Sensor
            </a>


            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- END MODAL -->




            <?php
            $recordsPerPage = 10;
            $curPage = isset($_GET['page']) ? $_GET['page'] : 1;
            // Calculate the total number of pages
            $query = "SELECT COUNT(*) AS total FROM sensors";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total = $row['total'];
            $totalPages = ceil($row['total'] / $recordsPerPage);
            ?>

 
            <div class="float-start d-flex mt-3">
                <a class="text-decoration-none text-secondary" style="font-size: 16px;" href="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p class="text-secondary" style="font-size: 14px;">
                    <?php if($totalPages == 0) { ?>
                        <?php echo $total; ?> alerts (Page <?php echo $curPage; ?> of 1)
                    <?php } else { ?>
                        <?php echo $total; ?> alerts (Page <?php echo $curPage; ?> of <?php echo $totalPages; ?>)
                    <?php } ?>
                </p>
            </div>

            

            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Deployment ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Sensor Type</th>
                        <th>IP</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Define the number of records per page

                    // Get the current page number from the URL query string
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the starting record for the current page
                    $startFrom = ($currentPage - 1) * $recordsPerPage;

                    // Select the data from the table with pagination
                    $query = "SELECT * FROM sensors LIMIT $startFrom, $recordsPerPage";
                    $result = mysqli_query($conn, $query);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row of data
                        while ($a = mysqli_fetch_assoc($result)) {
                            $idno = $a['idno'];
                            $did = $a['deployment_id'];
                            $name = $a['name'];
                            $status = $a['status'];
                            $sensor_type = $a['sensor_type'];
                            $ip = $a['ip_addr'];
                    ?>

                        <tr>
                            <!-- IDNO -->
                            <td>#<?php echo $did; ?></td>

                            <!-- TIMESTAMP -->
                            <td><?php echo $name; ?></td>

                            <!-- Name -->
                            <td><?php echo $status; ?></td>

                            <!-- Name -->
                            <td><?php echo $sensor_type; ?></td>
                            <!-- Name -->
                            <td><?php echo $ip; ?></td>

                            <!-- ACTIONS -->
                            <td>
                                <a href="#" class="text-decoration-none text-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="#" class="text-decoration-none text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php
            // Calculate the total number of pages
            $query = "SELECT COUNT(*) AS total FROM alerts";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $totalPages = ceil($row['total'] / $recordsPerPage);
            ?>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php
                    // Display pagination links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>

        </div>
    <!-- end container -->


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
