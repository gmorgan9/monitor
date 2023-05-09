<?php

require_once "app/database/connection.php";
require_once "path.php";
session_start();

date_default_timezone_set('UTC');


function generateRandomNumber($length = 8) {
    $characters = '0123456789';
    $randomString = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $max)];
    }

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

    // Generate a random identifier
    $idno = generateRandomNumber();
    $seconds = mysqli_real_escape_string($conn, $data["seconds"]);
    $msg = mysqli_real_escape_string($conn, $data["msg"]);
    $class = mysqli_real_escape_string($conn, $data["class"]);
    $timestamp = mysqli_real_escape_string($conn, $data["timestamp"]);

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
    $sql = "INSERT INTO alerts (idno, seconds, msg, class, timestamp) VALUES ('$idno', '$seconds', '$msg', '$class', '$formattedTimestamp')";
    mysqli_query($conn, $sql);
    // Execute the SQL statement
    // if (mysqli_query($conn, $sql)) {
    //     echo "Data inserted successfully for line " . ($index + 1) . "<br>";
    // } else {
    //     echo "Error inserting data for line " . ($index + 1) . ": " . mysqli_error($conn) . "<br>";
    // }
}