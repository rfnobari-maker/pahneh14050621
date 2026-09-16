<?php
header("Content-Type: application/json; charset=utf-8");
include_once('./login/config.php');

if (!isset($_GET['id_ostan']) || !is_numeric($_GET['id_ostan'])) {
    echo json_encode(array());
    exit;
}

$stmt = $dbh->prepare("SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY city");
$stmt->execute(array($_GET['id_ostan']));
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
