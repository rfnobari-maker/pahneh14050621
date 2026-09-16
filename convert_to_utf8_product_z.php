<?php
include ('event.php'); // Assuming this file contains any necessary event handling or utility functions
include ('./login/config.php'); // Your primary database configuration for reading data

// Select all data from your source table
$query = "SELECT * FROM product_z WHERE 1"; // **IMPORTANT: Replace 'your_source_table_name' with your actual table name**
$stmt = $dbh->prepare($query);
$stmt->execute();

// Loop through each row fetched from the database
foreach($stmt as $row) {
    // Extract data based on your specified structure
    $group_cod = $row['group_cod'];
    $group_name = $row['group_name'];
    $product_cod = $row['product_cod'];
    $product_name = $row['product_name'];

    // Include the UTF-8 specific configuration for writing
    include ('./login/config_utf8.php');

    // Prepare the INSERT query for the UTF-8 enabled table
    // **IMPORTANT: Replace 'your_target_utf8_table_name' with the name of your target UTF-8 table**
    $query = "INSERT INTO product_z_utf8(group_cod, group_name, product_cod, product_name)
              VALUES(:group_cod, :group_name, :product_cod, :product_name)";
    $q = $dbh->prepare($query);

    // Execute the INSERT query with the extracted data
    $q->execute(array(
        ':group_cod' => $group_cod,
        ':group_name' => $group_name,
        ':product_cod' => $product_cod,
        ':product_name' => $product_name
    ));
}

// Display an alert when the process is complete
echo "<script>alert('تمام');</script>";
?>