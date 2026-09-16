<?php 
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

$login_session = $_SESSION['login_user'];
$id_mar = $_SESSION['id_mar'];

// نام جدول اصلی بر اساس سال زراعی برای دریافت جزئیات زمین
$Agri_table = 'Agri'.str_replace('-','_',$z_sal); 

// عملیات حذف درخواست (فقط در صورتی که تایید نهایی نشده باشد)
if(isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    // بررسی وضعیت درخواست قبل از حذف
    $check_sql = "SELECT reg_status FROM Agri_req_bah WHERE id = :id AND mor_cod_m = :login_session";
    $check_stmt = $dbh->prepare($check_sql);
    $check_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
    $req_status = $check_stmt->fetchColumn();

    if($req_status != 3 && $req_status != 33) {
        $del_sql = "DELETE FROM Agri_req_bah WHERE id = :id AND mor_cod_m = :login_session";
        $del_stmt = $dbh->prepare($del_sql);
        $del_stmt->execute(array(':id' => $del_id, ':login_session' => $login_session));
        header("Location: tracking_farmer_requests.php?msg=deleted");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>پیگیری درخواست‌های تغییر بهره‌بردار</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style>
        html, body { background-color: #FFFFFF !important; margin: 0 !important; padding: 0 !important; font-family: Tahoma; }
        .search-box { width: 500px; margin: 30px auto; padding: 20px; background: #fff; border: 1px solid #2980b9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .my-table { width: 98%; border-collapse: collapse; margin: 20px auto; background: #fff; font-size: 11px; }
        .my-table th, .my-table td { border: 1px solid #ccc; padding: 10px; text-align: center; vertical-align: middle; }
        .header-blue { background-color: #2980b9; color: #fff; }
        
        .status-badge { padding: 4px 8px; border-radius: 5px; color: #fff; font-weight: bold; display: inline-block; font-size: 10px; min-width: 90px; }
        .status-0 { background-color: #f39c12; }   /* در جریان */
        .status-1 { background-color: #3498db; }   /* تایید مرکز */
        .status-11 { background-color: #e74c3c; }  /* رد مرکز */
        .status-2 { background-color: #2980b9; }   /* تایید شهرستان */
        .status-22 { background-color: #e74c3c; }  /* رد شهرستان */
        .status-3 { background-color: #27ae60; }   /* تایید نهایی */
        .status-33 { background-color: #c0392b; }  /* رد نهایی */

        .old-val { color: #888; text-decoration: line-through; display: block; font-size: 10px; }
        .new-val { color: #2ecc71; font-weight: bold; display: block; }
        
        .comment-row { border-top: 1px dashed #ddd; margin-top: 5px; padding-top: 4px; }
        .comment-date { color: #7f8c8d; font-size: 9px; display: block; margin-top: 2px; }
        
        .btn-back { background-color: #7f8c8d; color: white; padding: 8px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; }
        .btn-search { background-color: #2980b9; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer; font-family: Tahoma; }
        .btn-del { color: #e74c3c; text-decoration: none; font-weight: bold; font-size: 16px; }
    </style>
    <script>
        function confirmDelete(id) {
            if(confirm('آیا از حذف این درخواست اطمینان دارید؟')) {
                window.location.href = 'tracking_farmer_requests.php?del_id=' + id;
            }
        }
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" style="display: block;" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td><?php include('top.php'); ?></td></tr>
    </table>

    <div style="min-height: 600px; padding: 20px;">
        
        <div class="search-box" dir="rtl">
            <h3 align="center" style="color:#2980b9; margin-top: 0;">پیگیری درخواست‌های تغییر بهره‌بردار</h3>
            <form method="post">
                <table width="90%" align="center" style="border: none;">
                    <tr>
                        <td>سال زراعی:</td>
                        <td>
                            <select name="z_sal" style="width: 180px; height: 32px; font-family: Tahoma;">
                                <option value='1404-1405' <?php echo ($z_sal == '1404-1405' ? 'selected' : ''); ?>>1404-1405</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>کد ملی (قدیم/جدید):</td>
                        <td><input type="text" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" maxlength="10" style="width: 175px; height: 28px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding-top:15px;">
                            <input type="submit" value="جستجو و فیلتر" class="btn-search">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <table class="my-table" dir="rtl">
            <tr class="header-blue">
                <th width="40">ردیف</th>
                <th width="90">تاریخ ثبت</th>
                <th>نام آبادی</th>
                <th>نوع کشت</th>
                <th>مساحت زمین</th>
                <th>بهره‌بردار فعلی (قبلی)</th>
                <th>بهره‌بردار پیشنهادی</th>
                <th>شناسه قطعه</th>
                <th width="320">علت و نظرات کارشناسی</th>
                <th>وضعیت فعلی</th>
                <th width="60">عملیات</th>
            </tr>
            <?php 
            $where = "WHERE mor_cod_m = :login_session AND z_sal = :z_sal";
            if(!empty($bah_cod_m)) { 
                $where .= " AND (bah_cod_m = :bah_cod_m OR new_bah_cod_m = :bah_cod_m)"; 
            }

            $sql = "SELECT * FROM Agri_req_bah $where ORDER BY id DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':login_session', $login_session);
            $stmt->bindParam(':z_sal', $z_sal);
            if(!empty($bah_cod_m)) { $stmt->bindParam(':bah_cod_m', $bah_cod_m); }
            $stmt->execute();

            $i = 1;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $status_text = array(0=>"در جریان", 1=>"تایید مرکز", 11=>"رد مرکز", 2=>"تایید شهرستان", 22=>"رد شهرستان", 3=>"تایید نهایی", 33=>"رد نهایی");
                
                // دریافت اطلاعات تکمیلی قطعه از جدول اصلی
                $stmt_inf = $dbh->prepare("SELECT add_abadi, add_city, no_kesh, m_zamin FROM `$Agri_table` WHERE id = ?");
                $stmt_inf->execute(array($row['Agri_id']));
                $inf = $stmt_inf->fetch(PDO::FETCH_ASSOC);

                $old_name = bah_name2($row['bah_cod_m'], $row['num_bah']);
                $new_name = bah_name2($row['new_bah_cod_m'], $row['new_num_bah']);
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['date_req']; ?></td>
                <td><?php echo abadi_name($inf['add_abadi']) . shahr_name($inf['add_city']); ?></td>
                <td><?php if ($inf['no_kesh'] =='1') echo 'آبی' ; if ($inf['no_kesh'] =='2') echo 'دیم' ; ?></td>
                <td><?php echo $inf['m_zamin']; ?></td>
                <td>
                    <span class="old-val"><?php echo $old_name; ?></span>
                    <small>کد ملی: <?php echo $row['bah_cod_m']; ?></small>
                </td>
                <td>
                    <span class="new-val"><?php echo $new_name; ?></span>
                    <small>کد ملی: <?php echo $row['new_bah_cod_m']; ?></small>
                </td>
                <td><?php echo $row['Agri_id']; ?></td>
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
                <td>
                    <span class="status-badge status-<?php echo $row['reg_status']; ?>">
                        <?php echo isset($status_text[$row['reg_status']]) ? $status_text[$row['reg_status']] : 'نامشخص'; ?>
                    </span>
                </td>
                <td>
                    <?php if($row['reg_status'] != 3 && $row['reg_status'] != 33): ?>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>);" class="btn-del" title="حذف درخواست">❌</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        
        <div align="center" style="margin-top: 30px;">
            <a href="Agri_req_bah.php" class="btn-back">⬅ بازگشت به فرم ثبت درخواست</a>
        </div>
    </div>

    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php')?></td></tr>
    </table>
</body>
</html>