<?php
header("Content-Type: application/json; charset=utf-8");
include_once('../login/config.php');

if (!isset($_GET['id_ostan']) || !is_numeric($_GET['id_ostan']) || 
    !isset($_GET['id_city']) || !is_numeric($_GET['id_city'])) {
    echo json_encode(array());
    exit;
}

$stmt = $dbh->prepare("SELECT id_mar, mar FROM mar WHERE id_ostan = ? AND id_city = ? ORDER BY mar");
$stmt->execute(array($_GET['id_ostan'], $_GET['id_city']));
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
