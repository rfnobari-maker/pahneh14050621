<?php
require_once("../../lock_cp.php");
 include_once('../../login/config.php');

$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';

// Ensure id_ostan and id_city are not empty and are valid numbers
if (!empty($id_ostan) && is_numeric($id_ostan) && !empty($id_city) && is_numeric($id_city)) {
    // Default option for "All centers" or similar
    echo '<option value="0"> کل شهرستان</option>';

    $query = "SELECT id_mar, mar FROM mar WHERE id_ostan = :id_ostan AND id_city = :id_city ORDER BY BINARY mar ASC";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->bindParam(':id_city', $id_city, PDO::PARAM_INT);
    $stmt->execute();

    foreach($stmt as $row){
        echo '<option value="' . $row['id_mar'] . '">' . $row['mar'] . '</option>';
    }
} else {
    echo '<option value="0"> کل شهرستان</option>'; // Fallback if no province/city is selected or invalid IDs
}
?>