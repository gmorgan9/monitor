<?php
// Create a database connection and execute the query to retrieve the updated table data
// ...

// Fetch the table data and generate the HTML code
$html = '';
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $msg = $row['msg'];
    $formattedTimestamp = $row['formatted_timestamp'];
    $class = $row['class'];

    $html .= "<tr>";
    $html .= "<td>" . $id . "</td>";
    $html .= "<td>" . $msg . "</td>";
    $html .= "<td>" . $formattedTimestamp . "</td>";
    $html .= "<td>" . $class . "</td>";
    $html .= "</tr>";
}

echo $html;
?>
