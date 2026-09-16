<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
$nationalCode = $_GET['nationalCode']; // دریافت کد ملی از پارامتر درخواست GET
$query = "SELECT name, last_name, mor_cod_m, date_t FROM bah WHERE bah_cod_m = :nationalCode";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':nationalCode', $nationalCode, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // برگرداندن نتیجه به صورت JSON
    header('Content-Type: application/json');
    $json = json_encode($result);
    $decodedJson = json_decode($json, true);
echo print_r($decodedJson);
?>
</body>
</html>