<?php

// Open the CSV file for reading
$file = fopen("gas_prices.csv", "r");

echo "<table style='font-family: \"Helvetica\", sans-serif; font-size: 14px;'>";

// Read the data from the CSV file and display it in the table
$rowCount = 0;
while (($row = fgetcsv($file)) !== false) {
    echo "<tr style='text-align: center'>";
    $cellCount = 0;
    foreach ($row as $cell) {
        if ($rowCount == 0) {
            // This is the header row
            echo "<th style='background-color: black; color: white; width: 200px; border: 1px solid black'>$cell</th>";
        } else {
            // This is a regular row
            if ($cellCount == 1 || $cellCount == 2) {
                // This is the "Adres" or "Station" column, skip it
                echo "<td style='width: 200px; border: 1px solid black'>$cell</td>";
            } else {
                // This is a price column
                if (count(array_filter($row)) == 1) {
                    echo "<td style='width: 200px; border: 1px solid black'>$cell</td>";
                } else {
                    if ($cell == min(array_filter($row))) {
                        echo "<td style='width: 200px; border: 1px solid black'>$cell</td>";
                    } elseif ($cell == max(array_filter($row))) {
                        echo "<td style='width: 200px; border: 1px solid black'>$cell</td>";
                    } else {
                        echo "<td style='width: 200px; border: 1px solid black'>$cell</td>";
                    }
                }
            }
        }
        $cellCount++;
    }
    echo "</tr>";
    $rowCount++;
}

echo "</table>";

// Close the file
fclose($file);

// Set the timezone to Europe/Amsterdam
date_default_timezone_set('Europe/Amsterdam');

// Get the creation timestamp of the CSV file
$creationTimestamp = filectime("gas_prices.csv");

// Format the timestamp as a human-readable date and time in 24-hour format
$creationDateTime = date("d-m-Y H:i:s", $creationTimestamp);

// Display the creation date and time in the footer
echo "<footer>Laatste update: $creationDateTime</footer>";

?>
<html>
<head>
<style>
  .logo {
    width: 288px;
    height: 56px;
    background-image: url('logo_small.png');
    background-size: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
  }
    .header {
    margin-bottom: 100px;
    }
  table {
    padding-top: 50px;
  }
</style>

</head>
<body>
  <div class="logo"></div>
</body>
</html>
