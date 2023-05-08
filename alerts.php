<!DOCTYPE html>
<html>
<head>
    <title>Alerts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/css/bootstrap.min.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
        </ul>
    </nav>
    
    <table class="table table-bordered">
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
            
            // Read the JSON file as lines
            $jsonLines = file($jsonFile, FILE_IGNORE_NEW_LINES);

            // Iterate over each line in the JSON file
            foreach ($jsonLines as $index => $line) {
                // Decode each line as a JSON object
                $item = json_decode($line, true);
            
                // Check if JSON decoding was successful
                if ($item === null && json_last_error() !== JSON_ERROR_NONE) {
                    echo '<tr><td colspan="4">Failed to decode JSON: ' . json_last_error_msg() . '</td></tr>';
                    continue; // Skip to the next line
                }
            
                // Generate a unique ID for each entry
                $id = $index + 1;
            
                // Extract the required fields (msg, timestamp, and class)
                $msg = $item['msg'];
                $timestamp = $item['timestamp'];
                $class = $item['class'];

                // $formattedTimestamp = date('M d, Y h:i A', strtotime($timestamp));
                // $formattedTimestamp = date('M d, Y h:i A', strtotime(substr($timestamp, 0, 6) . ' ' . substr($timestamp, 7)));

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
$formattedTimestamp = $dateTime->format('M d, Y h:i A');



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

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
