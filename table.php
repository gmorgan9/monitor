<?php
// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the alerts table
$sql = "SELECT id, seconds, action, class, timestamp FROM alerts";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Start generating the HTML table
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Seconds</th>
            <th>Action</th>
            <th>Class</th>
            <th>Timestamp</th>
        </tr>";

    // Loop through each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        // Retrieve the data from the row
        $id = $row['id'];
        $seconds = $row['seconds'];
        $action = $row['action'];
        $class = $row['class'];
        $timestamp = $row['timestamp'];

        // Output the row as HTML table rows
        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $seconds . "</td>";
        echo "<td>" . $action . "</td>";
        echo "<td>" . $class . "</td>";
        echo "<td>" . $timestamp . "</td>";
        echo "</tr>";
    }

    // End the HTML table
    echo "</table>";
} else {
    // No data found
    echo "No data found.";
}

// Close the database connection
mysqli_close($conn);
?>
