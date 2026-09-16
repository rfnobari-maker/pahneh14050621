<?php
include('../../lock_p3.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);
$req_id     = isset($_POST['req_id']) ? intval($_POST['req_id']) : 0;
$action     = isset($_POST['action']) ? intval($_POST['action']) : 0;
$comment    = isset($_POST['comment']) ? $_POST['comment'] : '';
$date_now   = jdate("Y/m/d");

if (!$req_id || !in_array($action, array(1, 2))) {
    echo json_encode(array('status' => 'error', 'message' => 'اطلاعات ناقص است.'));
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM Agri_req_bah WHERE id = :id AND reg_status = 1");
    $stmt->execute(array(':id' => $req_id));
    $req_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$req_data) {
        echo json_encode(array('status' => 'error', 'message' => 'درخواست مورد نظر یافت نشد.'));
        exit;
    }


    if ($action == 1) 
	{
        $final_status = 2; 
    } else {
        $final_status = 22; 
    }

    // عملیات نهایی بروزرسانی
    $sql_update = "UPDATE Agri_req_bah  SET reg_status = :status, city_comment = :comment, city_date = :mdate WHERE id = :id";
    $stmt_up = $dbh->prepare($sql_update);
    $result = $stmt_up->execute(array(
        ':status'  => $final_status,
        ':comment' => $comment,
        ':mdate'   => $date_now,
        ':id'      => $req_id
    ));

    if ($result) {
        $msg = ($final_status == 2) ? 'درخواست تایید و به زراعت استان ارسال شد.' : 'درخواست رد شد.';
        echo json_encode(array('status' => 'success', 'message' => $msg));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'خطا در ثبت نهایی دیتابیس.'));
    }

} catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'خطای سیستمی: ' . $e->getMessage()));
}