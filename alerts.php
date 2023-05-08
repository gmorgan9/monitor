<?php

require_once "app/database/connection.php";
require_once "path.php";
require_once "execute.php";
session_start();
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

    <?php include("app/includes/header.php"); ?>
    
    <!-- container -->
        <div class="container">

            <a class="text-decoration-none text-secondary" href="<?php $_SERVER['PHP_SELF']; ?>"><i class="bi bi-arrow-clockwise"></i></a>

            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Alert ID</th>
                        <th>Seconds</th>
                        <th>Action</th>
                        <th>Class</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Define the number of records per page
                    $recordsPerPage = 10;

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
                            $class = $a['class'];
                            $timestamp = $a['timestamp'];

                            // Display the data in the specified format
                            echo "<tr>";
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . $seconds . "</td>";
                            echo "<td>" . $action . "</td>";
                            echo "<td>" . $class . "</td>";
                            echo "<td>" . $timestamp . "</td>";
                            echo "</tr>";
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
