<?php

require_once "app/database/connection.php";
require_once "path.php";
session_start();

date_default_timezone_set('UTC');


function generateRandomNumber($conn, $length = 10) {
    $characters = '0123456789';
    $max = strlen($characters) - 1;

    do {
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $max)];
        }

        // Check if the generated number already exists in the database
        $checkQuery = "SELECT COUNT(*) as count FROM alerts WHERE idno = '$randomString'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $row = mysqli_fetch_assoc($checkResult);
        $count = $row['count'];

    } while ($count > 0); // Repeat until a unique number is generated

    return $randomString;
}


$jsonFile = '/var/log/snort/alert_json.txt';

// Read the JSON file
$jsonLines = file($jsonFile, FILE_IGNORE_NEW_LINES);

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

    // Grab the JSON message and store it in the message field
    $message = mysqli_real_escape_string($conn, $line);

    // Generate a random identifier
    $idno = generateRandomNumber($conn);
    $dst_addr = mysqli_real_escape_string($conn, $data["dst_addr"]);
    $dst_port = mysqli_real_escape_string($conn, $data["dst_port"]);
    $src_addr = mysqli_real_escape_string($conn, $data["src_addr"]);
    $src_port = mysqli_real_escape_string($conn, $data["src_port"]);
    $seconds = mysqli_real_escape_string($conn, $data["seconds"]);
    $msg = mysqli_real_escape_string($conn, $data["msg"]);
    $class = mysqli_real_escape_string($conn, $data["class"]);
    $timestamp = mysqli_real_escape_string($conn, $data["timestamp"]);

    // FORMATTED TIMESTAMP
        $dateTimeParts = explode('-', $timestamp);
        $datePart = $dateTimeParts[0];
        $timePart = $dateTimeParts[1];

        $dateParts = explode('/', $datePart);
        $month = $dateParts[0];
        $day = $dateParts[1];

        $timeParts = explode(':', $timePart);
        $hour = $timeParts[0];
        $minute = $timeParts[1];
        $second = substr($timeParts[2], 0, 2); // Truncate milliseconds

        $dateTime = DateTime::createFromFormat('m/d H:i:s', $month . '/' . $day . ' ' . $hour . ':' . $minute . ':' . $second);
        $formattedTimestamp = $dateTime->format('Y-m-d\TH:i:s');
    // END FORMATTED TIMESTAMP

    // Check if the record already exists with the same idno
    $checkQuery = "SELECT * FROM alerts WHERE seconds = '$seconds'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // echo "Record with idno $idno already exists. Skipping for line " . ($index + 1) . "<br>";
        continue; // Skip to the next line
    }

    // Extract the necessary data and prepare SQL statements
    
    // Extract other required fields as needed

    // Prepare the SQL insert statement
    $sql = "INSERT INTO alerts (idno, seconds, msg, class, timestamp, message, dst_addr, dst_port, src_addr, src_port) VALUES ('$idno', '$seconds', '$msg', '$class', '$formattedTimestamp', '$message', '$dst_addr', '$dst_port', '$src_addr', '$src_port')";
    mysqli_query($conn, $sql);
    // Execute the SQL statement
    // if (mysqli_query($conn, $sql)) {
    //     echo "Data inserted successfully for line " . ($index + 1) . "<br>";
    // } else {
    //     echo "Error inserting data for line " . ($index + 1) . ": " . mysqli_error($conn) . "<br>";
    // }
}