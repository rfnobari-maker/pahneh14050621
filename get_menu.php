<?php
			// اتصال به دیتابیس
           include ('login/config.php');

	// دریافت لیست آیتم‌های منو
	$stmt = $dbh->prepare('SELECT * FROM menu_items ORDER BY position ASC');
	$stmt->execute();
	$menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// تبدیل لیست آیتم‌های منو به فرمت JSON و برگرداندن آن
	header('Content-Type: application/json');
	echo json_encode($menu);
?>
