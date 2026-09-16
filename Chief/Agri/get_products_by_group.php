<?php
require_once("../../lock_ce.php");
header('Content-Type: application/json');

if (isset($_GET['group']) && !empty($_GET['group'])) {
    $group = $_GET['group'];
    $stmt = $dbh->prepare("SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_cod ASC");
    $stmt->execute(array($group));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
} else {
    echo json_encode(array());
}
?>