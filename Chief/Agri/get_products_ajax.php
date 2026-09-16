<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

header('Content-Type: application/json; charset=utf-8');

$group_cod = isset($_POST['group_cod']) ? $_POST['group_cod'] : '';

if (empty($group_cod)) {
    echo json_encode(array());
    exit;
}

$query = "SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_name ASC";
$stmt = $dbh->prepare($query);
$stmt->execute(array($group_cod));
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>