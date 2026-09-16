<?php
require_once('../../login/config.php');

// چک کردن درخواست POST و دریافت متغیرها
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Agri_id = $_POST['Agri_id'];
    $z_sal = $_POST['z_sal'];
    $mor_cod_m = $_POST['mor_cod_m'];

    // نام جدول
    $Agri_not_table = 'Agri_note' . str_replace('-', '_', $z_sal);

    try {
        // دریافت توضیحات مرتبط با Agri_id و mor_cod_m
        $stmt = $dbh->prepare("SELECT id, description, date_s, mor_cod_m FROM `$Agri_not_table` WHERE Agri_id = :Agri_id ORDER BY id DESC");
        $stmt->bindParam(':Agri_id', $Agri_id, PDO::PARAM_INT);
		$stmt->execute();
        
        $descriptions = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $descriptions[] = $row;
        }

        // بازگرداندن نتیجه به صورت JSON
        echo json_encode(array("success" => true, "descriptions" => $descriptions));
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "error" => $e->getMessage()));
    }
}
?>
