<?php
require_once("../../lock_cp.php");
 include_once('../../login/config.php');
 // Include your database connection file

$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';

// Ensure id_ostan is not empty and is a valid number to prevent SQL injection issues
if (!empty($id_ostan) && is_numeric($id_ostan)) {
    // Default option for "All cities" or similar
    echo '<option value="0"> کل استان</option>';

    $query = "SELECT id_city, city FROM cityname WHERE id_ostan = :id_ostan ORDER BY BINARY city ASC";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->execute();

    foreach($stmt as $row){
        echo '<option value="' . $row['id_city'] . '">' . $row['city'] . '</option>';
    }
} else {
    echo '<option value="0"> کل استان</option>'; // Fallback if no province is selected or invalid ID
}
?>