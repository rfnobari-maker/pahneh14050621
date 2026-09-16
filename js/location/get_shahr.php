<?php
header("Content-Type: application/json; charset=utf-8");
include_once('../login/config.php');

if (!isset($_GET['id_ostan']) || !is_numeric($_GET['id_ostan']) || 
    !isset($_GET['id_city']) || !is_numeric($_GET['id_city']) ||
    !isset($_GET['id_mar']) || !is_numeric($_GET['id_mar'])) {
    echo json_encode(array());
    exit;
}

$stmt = $dbh->prepare("SELECT add_city, shahr FROM list_city WHERE id_ostan = ? AND id_city = ? AND id_mar = ? ORDER BY BINARY shahr");
$stmt->execute(array($_GET['id_ostan'], $_GET['id_city'], $_GET['id_mar']));
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>