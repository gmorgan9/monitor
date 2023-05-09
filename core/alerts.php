<?php

require_once "../app/database/connection.php";
require_once "../app/database/functions.php";
require_once "../path.php";
require_once "../execute.php";

session_start();

if(isLoggedIn() == false){
    header('location: '. BASE_URL . '/core/entry/login.php');
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

    <title>Alerts</title>
</head>
<body>

    <?php include("../app/includes/header.php"); ?>
    
    <!-- container -->
        <div class="container">

            <?php
            $recordsPerPage = 10;
            $curPage = isset($_GET['page']) ? $_GET['page'] : 1;
            // Calculate the total number of pages
            $query = "SELECT COUNT(*) AS total FROM alerts";
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
                    <?php echo $total; ?> alerts (Page <?php echo $curPage; ?> of <?php echo $totalPages; ?>)
                </p>
            </div>

            

            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Alert ID</th>
                        <th>Timestamp</th>
                        <th>Summary</th>
                        <th>Class</th>
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
                    $query = "SELECT * FROM alerts LIMIT $startFrom, $recordsPerPage";
                    $result = mysqli_query($conn, $query);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row of data
                        while ($a = mysqli_fetch_assoc($result)) {
                            $id = $a['id'];
                            $seconds = $a['seconds'];
                            $action = $a['action'];
                            $msg = $a['msg'];
                            $class = $a['class'];
                            $timestamp = $a['timestamp'];
                    ?>

                        <tr>
                            <td>
                                <?php echo $id; ?>
                            </td>
                            <td>
                                <?php echo $timestamp; ?>
                            </td>
                            <td>
                                <?php echo $msg; ?>
                            </td>
                            <td>
                                <?php echo $class; ?>
                            </td>
                        </tr>

                    <?php
                        }
                    } else {
                        echo "No data found.";
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
                        // echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
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
