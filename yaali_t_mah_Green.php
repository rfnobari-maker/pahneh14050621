<?php
include('login/config.php');
include('event.php');


$query = "SELECT t_mah, unit_id FROM Greenhous_prod WHERE y_prod = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array('1404'));

foreach ($stmt as $row) {
    $t_mah = $row['t_mah'];
    $unit_id = $row['unit_id'];

    $query = "SELECT COUNT(*) FROM Greenprod_annual WHERE unit_id = ? AND y_prod = ?";
    $stmt_count = $dbh->prepare($query);
    $stmt_count->execute(array($unit_id, '1404'));
    $count_id = $stmt_count->fetchColumn();

    if ($t_mah != $count_id) {
        $update = "UPDATE Greenhous_prod SET t_mah = ? WHERE unit_id = ? AND y_prod = ?";
        $q = $dbh->prepare($update);
        $q->execute(array($count_id, $unit_id, '1404'));
    }
}

alert('تمام');
?>
