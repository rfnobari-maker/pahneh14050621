<?php 
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

$login_session = $_SESSION['login_user'];
$id_mar = $_SESSION['id_mar'];

// عملیات حذف درخواست
if(isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    // بررسی اینکه وضعیت درخواست 3 یا 33 نباشد قبل از حذف
    $check_sql = "SELECT status FROM Agri_prod_req WHERE id = :id AND mor_cod_m = :login_session";
    $check_stmt = $dbh->prepare($check_sql);
    $check_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
    $req_status = $check_stmt->fetchColumn();

    if($req_status != 3 && $req_status != 33) {
        $del_sql = "DELETE FROM Agri_prod_req WHERE id = :id AND mor_cod_m = :login_session";
        $del_stmt = $dbh->prepare($del_sql);
        $del_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
        header("Location: tracking_requests.php?msg=deleted");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>پیگیری درخواست‌های اصلاح</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style>
        html, body { background-color: #FFFFFF !important; margin: 0 !important; padding: 0 !important; font-family: Tahoma; }
        table { border-collapse: collapse; margin: 0; padding: 0; border: none; }
        .search-box { width: 500px; margin: 30px auto; padding: 20px; background: #fff; border: 1px solid #006699; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .my-table { width: 98%; border-collapse: collapse; margin: 20px auto; background: #fff; font-size: 11px; }
        .my-table th, .my-table td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        .header-blue { background-color: #006699; color: #fff; }
        
        .status-badge { padding: 4px 8px; border-radius: 5px; color: #fff; font-weight: bold; display: inline-block; font-size: 10px; min-width: 90px; }
        .status-0 { background-color: #f39c12; }
        .status-1 { background-color: #3498db; }
        .status-11 { background-color: #e74c3c; }
        .status-2 { background-color: #2980b9; }
        .status-22 { background-color: #e74c3c; }
        .status-3 { background-color: #27ae60; }
        .status-33 { background-color: #e74c3c; }
        .comment-row { border-top: 1px dashed #ddd; margin-top: 5px; padding-top: 4px; }
        .comment-date { color: #7f8c8d; font-size: 9px; display: block; margin-top: 2px; }


        .old-val1 { color: #888; text-decoration: line-through; display: block; font-size: 10px; }
        .new-val1 { color: #2e7d32; font-weight: bold; display: block; }
        .btn-back { background-color: #7f8c8d; color: white; padding: 8px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; margin-bottom: 10px; }
        .btn-search { background-color: #006699; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer; font-family: Tahoma; }
        .btn-del { color: #e74c3c; text-decoration: none; font-weight: bold; font-size: 14px; }
    </style>
    <script>
        function confirmDelete(id) {
            if(confirm('آیا از حذف این درخواست اطمینان دارید؟')) {
                window.location.href = 'tracking_requests.php?del_id=' + id;
            }
        }
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td style="line-height: 0; font-size: 0;"><img src="../../files/images/header.jpg" width="100%" height="149" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td><?php include('top.php'); ?></td></tr>
    </table>

<div style="min-height: 500px; background-color: #FFFFFF; padding: 20px;">
                
  <div class="search-box" dir="rtl">
            <h3 align="center" style="color:#006699; margin-top: 0;">فیلتر درخواست‌ها</h3>
            <form method="post">
              <table width="85%" align="center" style="border: none;">
                    <tr>
                        <td width="30%" height="48">سال زراعی:</td>
                        <td>
                            <select name="z_sal" style="width: 200px; height: 35px; font-family: Tahoma;">
                                <option value='1404-1405' <?php echo ($z_sal == '1404-1405' ? 'selected' : ''); ?>>1404-1405</option>
                            </select>
                      </td>
                </tr>
                    <tr>
                        <td height="48">کد ملی بهره‌بردار:</td>
                      <td><input type="text" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" maxlength="10" style="width: 200px; height: 30px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding-top:15px;"><input type="submit" value="اعمال فیلتر" class="btn-search"></td>
                    </tr>
                </table>
            </form>
        </div>

        <table class="my-table" dir="rtl">
            <tr class="header-blue">
                <th height="35">ردیف</th>
                <th>تاریخ ثبت</th>
                <th>نام بهره‌بردار</th>
                <th> نام محصول<br>
(قدیم ← جدید)</th>
                <th>سطح زیر کشت اول<br>
                (قدیم ← جدید)</th>
                <th>سطح زیر کشت دوم<br> 
                (قدیم ← جدید)</th>
                <th>پیش بینی تولید<br> 
                (قدیم ← جدید)</th>
                <th>علت درخواست و نظرات</th>
                <th>وضعیت</th>
                <th>حذف درخواست</th>
            </tr>
            <?php 
            $where = "WHERE mor_cod_m = :login_session AND z_sal = :z_sal";
            if(!empty($bah_cod_m)) { $where .= " AND bah_cod_m = :bah_cod_m"; }

            $sql = "SELECT * FROM Agri_prod_req $where ORDER BY id DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':login_session', $login_session);
            $stmt->bindParam(':z_sal', $z_sal);
            if(!empty($bah_cod_m)) { $stmt->bindParam(':bah_cod_m', $bah_cod_m); }
            $stmt->execute();

            $count = 1;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $status_text = array(0=>"در جریان", 1=>"تایید:مرکز", 11=>"رد:مرکز", 2=>"تایید:شهرستان", 22=>"رد:شهرستان", 3=>"تایید نهایی : استان", 33=>"رد: استان");
                $farmer_name = bah_name2($row['bah_cod_m'], $row['num_bah']);
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['date_req']; ?></td>
                <td><strong><?php echo $farmer_name; ?></strong><br><small><?php echo $row['bah_cod_m']; ?></small></td>
                <td><span class="old-val1"><?php echo mah_name($row['cod_mah']); ?></span><span class="new-val1">← <?php echo mah_name($row['new_cod_mah']); ?></span></td>
                <td><span class="old-val1"><?php echo $row['zer_kesht_a']; ?></span><span class="new-val1">← <?php echo $row['new_zer_kesht_a']; ?></span></td>
                <td><span class="old-val1"><?php echo $row['zer_kesht_b']; ?></span><span class="new-val1">← <?php echo $row['new_zer_kesht_b']; ?></span></td>
                <td><span class="old-val1"><?php echo $row['mah_tolp']; ?></span><span class="new-val1">← <?php echo $row['new_mah_tolp']; ?></span></td>
              <td style="font-size: 10px; max-width: 250px; text-align: right;">
                    <div><strong>علت درخواست:</strong> <?php echo $row['reason']; ?></div>
                    <?php if(!empty($row['center_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#3498db;">نظر مرکز:</strong> <?php echo $row['center_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['center_date']; ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($row['city_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#d35400;">نظر شهرستان:</strong> <?php echo $row['city_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['city_date']; ?></span>
                        </div>
                    <?php endif; ?>

                 <?php if(!empty($row['prov_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#F03;">نظر نهائی استان:</strong> <?php echo $row['prov_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['prov_date']; ?></span>
                        </div>
                    <?php endif; ?>
                </td>
                <td><span class="status-badge status-<?php echo $row['status']; ?>"><?php echo isset($status_text[$row['status']]) ? $status_text[$row['status']] : 'نامشخص'; ?></span></td>
                <td>
                    <?php if($row['status'] != 3 && $row['status'] != 33): ?>
                  <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>);" class="btn-del">❌</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
          </tr>
            <?php } ?>
  </table>
        <div align="center"><a href="Agri_reg.php" class="btn-back">⬅ بازگشت به فرم ثبت درخواست</a></div>
    </div>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 20px;">
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php')?></td></tr>
    </table>
</body>
</html>