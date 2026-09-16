<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "
    SELECT g.id, g.t_mah, COUNT(p.id) AS prod_count
    FROM Garden g
    LEFT JOIN Garden_prod p ON p.Garden_id = g.id AND p.z_sal = '1404'
    WHERE g.z_sal = '1404'
    GROUP BY g.id, g.t_mah
";
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row) {
    $t_mah = $row['t_mah'];
    $prod_count = $row['prod_count'];
    $id = $row['id'];
    if ($t_mah != $prod_count) {
        $q = $dbh->prepare("UPDATE Garden SET t_mah = ? WHERE id = ? AND z_sal = '1404'");
        $q->execute(array($prod_count, $id));
    }
}
alert('تمام');
?>