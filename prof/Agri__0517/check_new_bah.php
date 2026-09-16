<?php
include('../../lock_p1.php');
include('../../login/config.php');

header('Content-Type: application/json');

$cod_m = isset($_POST['cod_m']) ? $_POST['cod_m'] : '';
$results = array();

if (strlen($cod_m) == 10 || strlen($cod_m) == 12) {
    // جستجوی تمام رکوردهایی که با این کد ملی مطابقت دارند
    $stmt = $dbh->prepare("SELECT name, last_name, co_name, no_bah, num_bah FROM bah WHERE bah_cod_m = :bah_cod_m");
    $stmt->execute(array(':bah_cod_m' => $cod_m));
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        // تعیین نام نمایشی: اگر حقوقی (2) بود نام شرکت، در غیر این صورت نام و نشان
        $displayName = ($user['no_bah'] == 2) ? $user['co_name'] : $user['name'] . ' ' . $user['last_name'];
        $typeText = ($user['no_bah'] == 2) ? 'حقوقی (شرکت)' : 'حقیقی';

        $results[] = array(
            'display_name' => $displayName,
            'type_text'    => $typeText,
            'no_bah'       => $user['no_bah'],
            'num_bah'      => $user['num_bah'] // شناسه یکتا برای ثبت در مرحله بعد
        );
    }
}

echo json_encode(array(
    'exists' => (count($results) > 0),
    'count'  => count($results),
    'data'   => $results
));