<?php
include ('event.php'); // Assuming this file contains necessary event handling or utility functions
include ('./login/config.php'); // Your database configuration for reading data

// Select all data from the 'your_table_name_here' table
$query = "SELECT * FROM mar WHERE 1"; // Replace 'your_table_name_here' with your actual table name
$stmt = $dbh->prepare($query);
$stmt->execute();

// Loop through each row fetched from the database
foreach($stmt as $row) {
    // Extract data from the current row
    $id = $row['id'];
    $id_ostan = $row['id_ostan'];
    $ostan = $row['ostan'];
    $id_city = $row['id_city'];
    $city = $row['city'];
    $id_mar = $row['id_mar'];
    $mar = $row['mar'];

    // Include the UTF-8 specific configuration for writing
    include ('./login/config_utf8.php');

    // Prepare the INSERT query for the UTF-8 table
    // Replace 'your_utf8_table_name_here' with the name of your target UTF-8 table
    $query = "INSERT INTO mar_utf8(id, id_ostan, ostan, id_city, city, id_mar, mar)
              VALUES(:id, :id_ostan, :ostan, :id_city, :city, :id_mar, :mar)";
    $q = $dbh->prepare($query);

    // Execute the INSERT query with the extracted data
    $q->execute(array(
        ':id' => $id,
        ':id_ostan' => $id_ostan,
        ':ostan' => $ostan,
        ':id_city' => $id_city,
        ':city' => $city,
        ':id_mar' => $id_mar,
        ':mar' => $mar
    ));
}

// Display an alert when the process is complete
echo "<script>alert('تمام');</script>"; // Using JavaScript alert as PHP alert() doesn't exist
?>