<?php
include('../../lock_ce.php');
include('../../event.php');
include('../../login/config.php');

$id = isset($_POST['id']) ? $_POST['id'] : null;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : null;

// برای تست
if ($id === null || $z_sal === null) {
    die('ID or Z_Sal is missing');
}

$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

// بررسی وجود ID
if (isset($id)) {
    try {
        // اجرای کوئری آپدیت
        $stmt = $dbh->prepare("UPDATE $Agri_table SET inquiry = '', inquiry_timestamp = NULL WHERE id = ?");
        if ($stmt->execute(array($id))) {
            alert(' مسدودیت اطلاعات با موفقیت ثبت شد') ;
			
        } else {
            alert('خطا') ;
        }
	
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid ID";
}
?>
 <script>
  window.close();
  </script>