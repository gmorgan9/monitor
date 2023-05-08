<?php

require_once "app/database/connection.php";
require_once "path.php";
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

    <title>Alerts</title>
</head>
<body>

    <?php include("app/includes/header.php"); ?>
    
    <div class="container">


        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>Alert ID</th>
                    <th>Message</th>
                    <th>Timestamp</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Path to the JSON file
$jsonFile = '/usr/local/etc/snort/alert_json.txt';

// Read the JSON file
$jsonLines = file($jsonFile, FILE_IGNORE_NEW_LINES);

// Create a database connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Iterate over each line in the JSON file
foreach ($jsonLines as $index => $line) {
    // Parse the JSON data from each line into an associative array
    $data = json_decode($line, true);

    // Check if the JSON data is valid
    if ($data === null) {
        echo "Error parsing JSON data on line " . ($index + 1);
        continue; // Skip to the next line
    }

    // Extract the necessary data and prepare SQL statements
    $seconds = mysqli_real_escape_string($conn, $data["seconds"]);
    $action = mysqli_real_escape_string($conn, $data["action"]);
    $class = mysqli_real_escape_string($conn, $data["class"]);
    // Extract other required fields as needed

    // Prepare the SQL insert statement
    $sql = "INSERT INTO alerts (seconds, action, class) VALUES ('$seconds', '$action', '$class')";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully for line " . ($index + 1) . "<br>";
    } else {
        echo "Error inserting data for line " . ($index + 1) . ": " . mysqli_error($conn) . "<br>";
    }
}

// Close the database connection
mysqli_close($conn);





                // // Read the JSON file as lines
                // $jsonLines = file($jsonFile, FILE_IGNORE_NEW_LINES);

                // // Iterate over each line in the JSON file
                // foreach ($jsonLines as $index => $line) {
                //     // Decode each line as a JSON object
                //     $item = json_decode($line, true);
                
                //     // Check if JSON decoding was successful
                //     if ($item === null && json_last_error() !== JSON_ERROR_NONE) {
                //         echo '<tr><td colspan="4">Failed to decode JSON: ' . json_last_error_msg() . '</td></tr>';
                //         continue; // Skip to the next line
                //     }
                
                //     // Generate a unique ID for each entry
                //     $id = $index + 1;
                
                //     // Extract the required fields (msg, timestamp, and class)
                //     $msg = $item['msg'];
                //     $timestamp = $item['timestamp'];
                //     $class = $item['class'];

                //     // $formattedTimestamp = date('M d, Y h:i A', strtotime($timestamp));
                //     // $formattedTimestamp = date('M d, Y h:i A', strtotime(substr($timestamp, 0, 6) . ' ' . substr($timestamp, 7)));

                //     $dateTimeParts = explode('-', $timestamp);
                //     $datePart = $dateTimeParts[0];
                //     $timePart = $dateTimeParts[1];

                //     $dateParts = explode('/', $datePart);
                //     $month = $dateParts[0];
                //     $day = $dateParts[1];

                //     $timeParts = explode(':', $timePart);
                //     $hour = $timeParts[0];
                //     $minute = $timeParts[1];
                //     $second = substr($timeParts[2], 0, 2); // Truncate milliseconds

                //     $dateTime = DateTime::createFromFormat('m/d H:i:s', $month . '/' . $day . ' ' . $hour . ':' . $minute . ':' . $second);
                //     $formattedTimestamp = $dateTime->format('M d, Y h:i A');



                    ?>

                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $msg; ?></td>
                        <td><?php echo $formattedTimestamp; ?></td>
                        <td><?php echo $class; ?></td>
                    </tr>
                    <?php
                }
        ?>
            </tbody>
        </table>



    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
