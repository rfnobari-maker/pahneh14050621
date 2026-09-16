<?php
include('../../lock_oce.php');
include('../../login/config.php');
include '../../web/Send_Request.php';
$z_sal = '1404-1405' ; 
$Agri_id = 8738551 ; 
$prod_table = "Agri_prod" . str_replace('-', '_', $z_sal);

    $national_id = '0080107400';
    //$area_id = $prod_id;
    $year = 1404;
    $category = 0;
    $update_date = '1404/10/27';
    $msg_code = 0;
    $message = 'test';
    $change_type = "ChangeNationalID";
    $old_value = '0080107400';
    $new_value = '1380066174' ;


$sql_query = "SELECT id FROM $prod_table WHERE Agri_id = :id";
$stmt_product = $dbh->prepare($sql_query);
$stmt_product->execute(array(':id' => $Agri_id));
$results = $stmt_product->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    foreach ($results as $row) {
        echo  $area_id = $row["id"];
        // ارسال اطلاعات
  $result = send_changes_info($national_id, $area_id, $year, $category, $change_type, $old_value, $new_value, $update_date, $msg_code, $message);
  if ($result == 1 ) echo 'ثبت اطلاعات با موفقیت انجام شد' ; else echo 'خطای رخ داده بعدا تلاش کنید' ; 

}
}
?>