<?php 
// ============================================================
// فعال‌سازی نمایش خطاها برای عیب‌یابی (در محیط تولید غیرفعال شود)
// ============================================================
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ============================================================

include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_city.php');
date_default_timezone_set('Asia/Tehran');

$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

$id_ostan1   = $id_ostan;
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] :'';
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * 25;
$limit = 25;

// ============================================================
// توابع کمکی با Prepared Statement
// ============================================================
function getCityData($dbh, $z_sal, $id_ostan, $id_city, $start, $limit) {
    $query = "SELECT * FROM Agri_ab_city 
              WHERE z_sal = :z_sal 
              AND id_ostan = :id_ostan 
              AND id_city = :id_city 
              GROUP BY group_cod, product_cod 
              LIMIT :start, :limit";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':z_sal', $z_sal, PDO::PARAM_STR);
    $stmt->bindParam(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->bindParam(':id_city', $id_city, PDO::PARAM_INT);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function getCityCount($dbh, $z_sal, $id_ostan, $id_city) {
    $query = "SELECT COUNT(*) FROM Agri_ab_city 
              WHERE z_sal = :z_sal 
              AND id_ostan = :id_ostan 
              AND id_city = :id_city";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':z_sal', $z_sal, PDO::PARAM_STR);
    $stmt->bindParam(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->bindParam(':id_city', $id_city, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function copyOstanToCity($dbh, $id_ostan, $id_city, $z_sal) {
    $query = "
        INSERT INTO Agri_ab_city (id_ostan, id_city, z_sal, group_cod, group_name, product_cod, product_name)
        SELECT
            c.id_ostan,
            :id_city,
            c.z_sal,
            c.group_cod,
            c.group_name,
            c.product_cod,
            c.product_name
        FROM Agri_ab_ostan c
        LEFT JOIN Agri_ab_city m
            ON c.product_cod = m.product_cod
            AND m.id_ostan = :id_ostan
            AND m.id_city = :id_city
            AND m.z_sal = :z_sal
        WHERE
            c.id_ostan = :id_ostan
            AND c.z_sal = :z_sal
            AND m.product_cod IS NULL
            AND (c.s_abi > 0 OR c.s_dem > 0)";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->bindParam(':id_city', $id_city, PDO::PARAM_INT);
    $stmt->bindParam(':z_sal', $z_sal, PDO::PARAM_STR);
    $stmt->execute();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fa-IR" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    
    <style type="text/css">
        body { text-align: right; }
        .tabel { margin-right:45px; }
        .text_r { margin-right:0px; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .style8 { font-family: Tahoma; font-size: 14px; }
        #content { width: 900px; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; }
        .page { float: right; margin: 0; padding: 0; }
        .page li { list-style: none; display: inline-block; }
        .page li a, .current { display: block; padding: 5px; text-decoration: none; color: #8A8A8A; }
        .current { font-weight: bold; color: #000; }
        .button { padding: 5px 15px; text-decoration: none; background: #333; color: #F3F3F3; font-size: 13PX; border-radius: 2PX; margin: 0 4PX; display: block; float: left; }
        .column { float: left; width: 12.25%; padding: 5px; }
        .row { width: 100% }
        .row::after { content: ""; clear: both; display: table; }
        
        .agri-table {
            width: 95%;
            margin: 24px auto;
            border-collapse: collapse;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 15px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border-radius: 12px;
            overflow: hidden;
        }
        .agri-table th, .agri-table td {
            padding: 10px 8px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            border-left: 1px solid #e0e0e0;
            border-right: none;
        }
        .agri-table th:last-child, .agri-table td:last-child { border-left: none; }
        .agri-table th { background: #006699; color: #fff; font-weight: bold; font-size: 16px; }
        .agri-table tr:nth-child(even) { background: #f9f9f9; }
        .agri-table tr:nth-child(odd) { background: #fff; }
        .agri-table tr:hover { background: #e6f2ff; }
        
        .balance-info {
            font-size: 11px;
            padding: 3px 6px;
            margin-top: 2px;
            border-radius: 3px;
            text-align: right;
            line-height: 1.6;
            direction: rtl;
        }
        .balance-valid { background: #e8f5e9; color: #2e7d32; }
        .balance-warning { background: #fff3e0; color: #e65100; }
        .balance-error { background: #ffebee; color: #c62828; }
        
        .input-field {
            width: 80px;
            height: 30px;
            font-family: Tahoma;
            font-size: 14px;
            text-align: center;
        }
        .input-field:focus { border-color: #006699; box-shadow: 0 0 5px rgba(0,102,153,0.3); }
        .input-field.error { border-color: #c62828; background: #ffebee; }
        .input-field.success { border-color: #2e7d32; background: #e8f5e9; }
        
        .submit-btn {
            width: 40px;
            height: 35px;
            font-size: 14px;
            color: #900;
            font-family: tahoma;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            background: #fff;
        }
        .submit-btn:hover:not(:disabled) { background: #006699; color: #fff; }
        .submit-btn:disabled { opacity: 0.5; cursor: not-allowed; }
        
        .pagination-container { text-align: center; margin: 20px auto; }
        .pagination {
            display: flex;
            list-style: none;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
            padding: 0;
        }
        .pagination .page-btn {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f8f8f8;
            color: #999;
            cursor: pointer;
        }
        .pagination .page-btn:hover { background: #e0e0e0; }
        .pagination .page-btn.active { background: #4CAF50; color: white; border-color: #4CAF50; }
        .pagination .nav-btn {
            background: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .pagination .nav-btn:hover { background: #388E3C; }
        
        @media (max-width: 900px) {
            .agri-table { font-size: 13px; }
            .agri-table th, .agri-table td { padding: 8px 4px; }
            .input-field { width: 60px; height: 26px; font-size: 12px; }
        }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php'); ?>
                            <span class="style8">برنامه الگوی کشت ابلاغی محصولات زراعی</span><br />
                            
                            <!-- فرم جستجو -->
                            <form id="reg-form" method="post" action="#1">
                                <div style="width: 350px; padding: 5px; border: 2px solid #09C; margin: auto;  border-radius: 15px">
                                    <table width="100%" height="284" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr bgcolor="#f1f1f1"><td height="22" colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td></tr>
                                        <tr bgcolor="#f1f1f1">
                                            <td height="60" dir="rtl" align="right" bgcolor="#FFFFFF" class="input_text">
                                                <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px; height:40px" onchange="this.form.submit()">
                                                    <option value="-1">انتخاب استان</option>
                                                    <?php
                                                    $query = "SELECT id_ostan, ostan FROM `ostanname` ORDER BY BINARY ostan ASC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo htmlspecialchars($row['id_ostan']); ?>" <?php if ($row['id_ostan'] == $id_ostan1) echo 'selected="selected"'; ?>>
                                                        <?php echo htmlspecialchars($row['ostan']); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td align="center" bgcolor="#FFFFFF" class="style1">: استان</td>
                                        </tr>
                                        <tr bgcolor="#f1f1f1">
                                            <td height="71" dir="rtl" align="right" bgcolor="#FFFFFF" class="input_text">
                                                <select name="id_city" class="input_text" id="shahrestan" style="width:170px; height:40px">
                                                    <option value="">انتخاب شهرستان</option>
                                                    <?php
                                                    if ($id_ostan1 != '' && $id_ostan1 != '-1') {
                                                        $query = "SELECT DISTINCT id_city, city FROM cityname WHERE id_ostan = :id_ostan ORDER BY BINARY city ASC";
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->bindParam(':id_ostan', $id_ostan1, PDO::PARAM_INT);
                                                        $stmt->execute();
                                                        foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo htmlspecialchars($row['id_city']); ?>" <?php if ($row['id_city'] == $id_city) echo 'selected="selected"'; ?>>
                                                        <?php echo htmlspecialchars($row['city']); ?>
                                                    </option>
                                                    <?php } } ?>
                                                </select>
                                            </td>
                                            <td align="center" bgcolor="#FFFFFF" class="style1">: شهرستان</td>
                                        </tr>
                                        <tr bgcolor="#f1f1f1">
                                            <td height="71" dir="rtl" align="right" bgcolor="#FFFFFF" class="input_text">
                                                <div align="right">
                                                    <select name="z_sal" class="input_text required" id="z_sal" style="height:40px; width:170px;" tabindex="1">
                     <option value="1405-1406" <?php if (isset($z_sal) && $z_sal=='1405-1406') echo 'selected=selected'?>>1405-1406</option>
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="146" align="center" bgcolor="#FFFFFF" class="style1">: سال زراعی</td>
                                        </tr>
                                        <tr>
                                            <td height="60" colspan="2" align="left">
                                                <input name="action" type="submit" id="action" style="width:150px; height:45px;" tabindex="10" value="جستجو" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            
                            <p>
                            <?php
                            if (isset($_POST['action']) && $id_city > 0 && $id_ostan1 != '' && $id_ostan1 != '-1') {
                                try {
                                    copyOstanToCity($dbh, $id_ostan1, $id_city, $z_sal);
                                    $stmt = getCityData($dbh, $z_sal, $id_ostan1, $id_city, $start, $limit);
                                    $t_row = $stmt->rowCount();
                                    
                                    if ($t_row > 0) {
                            ?>
                            
                            <!-- دکمه خروجی اکسل -->
                            <table width="122" height="56" border="0" align="center">
                                <tr>
                                    <td>
                                        <form action="Sab_L2_xls.php" method="post">
                                            <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                            <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                            <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                            <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="44" height="45" alt=""/></button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- جدول اصلی -->
                            <table class="agri-table" id="main-table">
                                <thead>
                                    <tr class="text1">
                                        <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
                                        <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار</td>
                                        <td colspan="2" bgcolor="#006699">تولید / تن</td>
                                        <td colspan="2" bgcolor="#006699">سطح / هکتار</td>
                                        <td height="35" colspan="2" bgcolor="#006699">مشخصات</td>
                                        <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
                                    </tr>
                                    <tr class="text1">
                                        <td width="15%" bgcolor="#006699">دیم</td>
                                        <td width="12%" bgcolor="#006699">آبی</td>
                                        <td width="11%" bgcolor="#006699">دیم</td>
                                        <td width="9%" bgcolor="#006699">آبی</td>
                                        <td width="10%" bgcolor="#006699">دیم</td>
                                        <td width="9%" bgcolor="#006699">آبی</td>
                                        <td width="12%" height="36" bgcolor="#006699" class="text1">نام محصول</td>
                                        <td width="10%" bgcolor="#006699">گروه</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $r = 1;
                                    foreach($stmt as $row) {
                                        $product_cod = $row['product_cod'];
                                    ?>
                                    <tr id="row-<?php echo $r; ?>">
                                        <td class="normalTextSmall">
                                            <form name="form<?php echo $r; ?>">
                                                <input type="hidden" id="id<?php echo $r; ?>" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />
                                                <input type="hidden" id="id_ostan<?php echo $r; ?>" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                                <input type="hidden" id="id_city<?php echo $r; ?>" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                                <input type="hidden" id="z_sal<?php echo $r; ?>" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                                <input type="hidden" id="product_cod<?php echo $r; ?>" name="product_cod" value="<?php echo htmlspecialchars($product_cod); ?>" />
                                                <input name="submit" type="submit" class="submit-btn submit<?php echo $r; ?>" id="submit<?php echo $r; ?>" tabindex="<?php echo ($r * 10 + 7); ?>" value="ثبت" />
                                                <span class="error<?php echo $r; ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15" alt=""/></span>
                                                <span class="success<?php echo $r; ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15" alt=""/></span>
                                            </form>
                                        </td>
                                        
                                        <td class="normalTextSmall">
                                            <input name="a_dem" type="text" class="style8" id="a_dem<?php echo $r; ?>" style="width:80px; height:30px;" readonly />
                                        </td>
                                        <td class="normalTextSmall">
                                            <input name="a_abi" type="text" class="style8" id="a_abi<?php echo $r; ?>" style="width:80px; height:30px;" readonly />
                                        </td>
                                        
                                        <td class="normalTextSmall">
                                            <input name="t_dem" type="text" class="input-field t_dem<?php echo $r; ?> required number" id="t_dem<?php echo $r; ?>" tabindex="<?php echo ($r * 10 + 4); ?>" value="<?php echo htmlspecialchars($row['t_dem'] * 1); ?>" maxlength="8" />
                                            <div class="balance-info" id="info_t_dem_<?php echo $r; ?>"></div>
                                        </td>
                                        <td class="normalTextSmall">
                                            <input name="t_abi" type="text" class="input-field t_abi<?php echo $r; ?> required number" id="t_abi<?php echo $r; ?>" tabindex="<?php echo ($r * 10 + 3); ?>" value="<?php echo htmlspecialchars($row['t_abi'] * 1); ?>" maxlength="8" />
                                            <div class="balance-info" id="info_t_abi_<?php echo $r; ?>"></div>
                                        </td>
                                        
                                        <td class="normalTextSmall">
                                            <input name="s_dem" type="text" class="input-field s_dem<?php echo $r; ?> required digits" id="s_dem<?php echo $r; ?>" tabindex="<?php echo ($r * 10 + 2); ?>" value="<?php echo htmlspecialchars($row['s_dem'] * 1); ?>" maxlength="8" />
                                            <div class="balance-info" id="info_s_dem_<?php echo $r; ?>"></div>
                                        </td>
                                        <td class="normalTextSmall">
                                            <input name="s_abi" type="text" class="input-field s_abi<?php echo $r; ?> required digits" id="s_abi<?php echo $r; ?>" tabindex="<?php echo ($r * 10 + 1); ?>" value="<?php echo htmlspecialchars($row['s_abi'] * 1); ?>" maxlength="8" />
                                            <div class="balance-info" id="info_s_abi_<?php echo $r; ?>"></div>
                                        </td>
                                        
                                        <td class="normalTextSmall"><?php echo htmlspecialchars($row['product_name']); ?></td>
                                        <td class="normalTextSmall"><div align="right"><?php echo htmlspecialchars($row['group_name']); ?></div></td>
                                        <td class="normalTextSmall"><?php echo $r; ?></td>
                                    </tr>
                                    <?php
                                        $r++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <?php
                                    } else {
                                        echo '<p class="style8">اطلاعاتی یافت نشد</p>';
                                    }
                                    
                                    $rows = getCityCount($dbh, $z_sal, $id_ostan1, $id_city);
                                    $total = ceil($rows / $limit);
                                    
                                    if ($total > 1) {
                            ?>
                            
                            <div class="pagination-container">
                                <ul class="pagination">
                                    <?php if ($id > 1): ?>
                                    <li>
                                        <form action="Agri_s_ab.php?id=<?php echo $id - 1; ?>#1" method="post">
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                            <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                            <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                            <button class="nav-btn">&laquo; قبلی</button>
                                        </form>
                                    </li>
                                    <?php endif; ?>
                                    
                                    <?php
                                    $visible_pages = 5;
                                    $start_page = max(1, $id - $visible_pages);
                                    $end_page = min($total, $id + $visible_pages);
                                    
                                    if ($start_page > 1): ?>
                                        <li>
                                            <form action="Agri_s_ab.php?id=1#1" method="post">
                                                <input type="hidden" name="action" value="1" />
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                                <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                                <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                                <button class="page-btn">1</button>
                                            </form>
                                        </li>
                                        <?php if ($start_page > 2): ?>
                                            <li style="padding: 6px 10px; color: #999;">...</li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li>
                                            <?php if ($i == $id): ?>
                                                <span class="page-btn active"><?php echo $i; ?></span>
                                            <?php else: ?>
                                                <form action="Agri_s_ab.php?id=<?php echo $i; ?>#1" method="post">
                                                    <input type="hidden" name="action" value="1" />
                                                    <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                                    <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                                    <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                                    <button class="page-btn"><?php echo $i; ?></button>
                                                </form>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <?php if ($end_page < $total): ?>
                                        <?php if ($end_page < $total - 1): ?>
                                            <li style="padding: 6px 10px; color: #999;">...</li>
                                        <?php endif; ?>
                                        <li>
                                            <form action="Agri_s_ab.php?id=<?php echo $total; ?>#1" method="post">
                                                <input type="hidden" name="action" value="1" />
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                                <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                                <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                                <button class="page-btn"><?php echo $total; ?></button>
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if ($id < $total): ?>
                                    <li>
                                        <form action="Agri_s_ab.php?id=<?php echo $id + 1; ?>#1" method="post">
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                            <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                            <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                            <button class="nav-btn">بعدی &raquo;</button>
                                        </form>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                                
                                <div style="margin-top: 15px;">
                                    <form method="post" action="Agri_s_ab.php" style="display: inline-flex; align-items: center; gap: 10px;">
                                        <input type="hidden" name="action" value="1" />
                                        <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                        <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
                                        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                        <span>به صفحه:</span>
                                        <input type="number" name="page_input" id="page_input" value="<?php echo $id; ?>" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;" />
                                        <button type="submit" class="nav-btn" style="padding: 6px 12px;">برو</button>
                                    </form>
                                </div>
                            </div>
                            
                            <script>
                                document.querySelector('.pagination-container form[action="Agri_s_ab.php"]').addEventListener('submit', function(e) {
                                    const input = document.getElementById('page_input');
                                    const value = parseInt(input.value);
                                    if (isNaN(value) || value < 1 || value > <?php echo $total; ?>) {
                                        e.preventDefault();
                                        alert('لطفاً عددی بین 1 تا <?php echo $total; ?> وارد کنید.');
                                    } else {
                                        this.action = 'Agri_s_ab.php?id=' + value + '#1';
                                    }
                                });
                            </script>
                            
                            <?php
                                    }
                                } catch (PDOException $e) {
                                    echo '<p style="color:red; font-weight:bold;">خطای دیتابیس: ' . htmlspecialchars($e->getMessage()) . '</p>';
                                } catch (Exception $e) {
                                    echo '<p style="color:red; font-weight:bold;">خطا: ' . htmlspecialchars($e->getMessage()) . '</p>';
                                }
                            }
                            ?>
                            
                            <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                            <?php include('../../footer.php'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <!-- جاوااسکریپت‌های کامل -->
    <script>
    // ============================================================
    // توابع کمکی
    // ============================================================
    function formatNumberWithSeparator(num) {
        if (!num && num !== 0) return "";
        var parts = num.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
        return parts.join(".");
    }
    
    function unformatNumber(str) {
        if (!str) return "0";
        return str.replace(/٬/g, "");
    }
    
    // ============================================================
    // اعتبارسنجی و نمایش موجودی
    // ============================================================
    var validationCache = {};
    
    function validateField(row, field, value) {
        if (value === '' || value === null) {
            var infoDiv = $('#info_' + field + '_' + row);
            infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
            $('#submit' + row).prop('disabled', false);
            $('#' + field + row).removeClass('error success');
            return;
        }
        
        var cacheKey = row + '_' + field + '_' + value;
        if (validationCache[cacheKey] && (Date.now() - validationCache[cacheKey].timestamp < 2000)) {
            updateUI(row, field, validationCache[cacheKey].result);
            return;
        }
        
        $.post('check_s_abi.php', {
            [field]: value,
            z_sal: $('#z_sal' + row).val(),
            id_ostan: $('#id_ostan' + row).val(),
            id_city: $('#id_city' + row).val(),
            product_cod: $('#product_cod' + row).val(),
            id_rec: $('#id' + row).val()
        }, function(response) {
            validationCache[cacheKey] = { result: response, timestamp: Date.now() };
            updateUI(row, field, response);
        }, 'json').fail(function() {
            var infoDiv = $('#info_' + field + '_' + row);
            infoDiv.html('⚠️ خطا در ارتباط با سرور').addClass('balance-error');
        });
    }
    
    function updateUI(row, field, response) {
        var infoDiv = $('#info_' + field + '_' + row);
        var input = $('#' + field + row);
        var submitBtn = $('#submit' + row);
        
        infoDiv.removeClass('balance-valid balance-warning balance-error');
        input.removeClass('error success');
        
        if (response.valid) {
            var city_limit = response.data.city_limit;
            var current_value = response.data.current_value;
            var other_cities_sum = response.data.other_cities_sum;
            var total_current = response.data.total_current;
            var new_remaining = response.data.new_remaining;
            var max_allowed = response.data.max_allowed;
            
            var statusText = '✅ مجاز';
            var statusClass = 'balance-valid';
            if (new_remaining < 0) {
                statusText = '⚠️ بیش از سقف';
                statusClass = 'balance-warning';
            } else if (new_remaining === 0) {
                statusText = '⚠️ تکمیل شده';
                statusClass = 'balance-warning';
            }
            
            // نمایش اطلاعات کامل به صورت چند خطی
            var infoHtml = '<span style="color: #2e7d32;">' + statusText + '</span><br>';
            infoHtml += '📊 سقف استان: ' + formatNumberWithSeparator(city_limit) + '<br>';
            infoHtml += '📌 مجموع کل فعلی: ' + formatNumberWithSeparator(total_current) + ' (این رکورد: ' + formatNumberWithSeparator(current_value) + ')' + '<br>';
            infoHtml += '📌 سایر شهرستان‌ها: ' + formatNumberWithSeparator(other_cities_sum) + '<br>';
            infoHtml += '💡 حداکثر مجاز برای این رکورد: ' + formatNumberWithSeparator(max_allowed) + '<br>';
            infoHtml += '💰 موجودی جدید: ' + formatNumberWithSeparator(new_remaining);
            
            infoDiv.html(infoHtml).addClass(statusClass);
            
            input.addClass('success');
            submitBtn.prop('disabled', false);
        } else {
            var message = response.message || 'مقدار وارد شده مجاز نیست';
            var displayMessage = message.replace(/\n/g, '<br>');
            
            // اطلاعات بیشتر در حالت خطا
            if (response.data) {
                var total_current = response.data.total_current || 0;
                var new_remaining = response.data.new_remaining;
                var max_allowed = response.data.max_allowed;
                
                if (max_allowed !== undefined) {
                    displayMessage += '<br>💡 حداکثر مجاز: ' + formatNumberWithSeparator(max_allowed);
                }
                if (new_remaining !== undefined) {
                    displayMessage += '<br>💰 موجودی پس از تغییر: ' + formatNumberWithSeparator(new_remaining);
                }
                displayMessage += '<br>📊 مجموع کل فعلی: ' + formatNumberWithSeparator(total_current);
            }
            
            infoDiv.html(
                '<span style="color: #c62828;">❌ ' + displayMessage + '</span>'
            ).addClass('balance-error');
            input.addClass('error');
            submitBtn.prop('disabled', true);
            
            if (response.data && response.data.max_allowed !== undefined && response.data.max_allowed > 0) {
                infoDiv.append(
                    '<br><button onclick="setMaxValue(\'' + field + '\', ' + row + ', ' + response.data.max_allowed + ')" ' +
                    'style="background: #1565c0; color: white; border: none; padding: 2px 8px; border-radius: 3px; ' +
                    'cursor: pointer; font-size: 11px; margin-top: 3px;">' +
                    '🔄 جایگزینی با حداکثر مجاز (' + formatNumberWithSeparator(response.data.max_allowed) + ')' +
                    '</button>'
                );
            }
        }
    }
    
    function setMaxValue(field, row, maxValue) {
        $('#' + field + row).val(formatNumberWithSeparator(maxValue));
        $('#' + field + row).trigger('change');
        $('#' + field + row).focus();
    }
    
    // ============================================================
    // محاسبه خودکار عملکرد
    // ============================================================
    function calcRow(row) {
        var t_abi = parseFloat(unformatNumber($('#t_abi' + row).val())) || 0;
        var s_abi = parseFloat(unformatNumber($('#s_abi' + row).val())) || 0;
        var t_dem = parseFloat(unformatNumber($('#t_dem' + row).val())) || 0;
        var s_dem = parseFloat(unformatNumber($('#s_dem' + row).val())) || 0;
        
        var a_abi = s_abi > 0 ? (t_abi / s_abi * 1000).toFixed(2) : '';
        var a_dem = s_dem > 0 ? (t_dem / s_dem * 1000).toFixed(2) : '';
        
        $('#a_abi' + row).val(a_abi ? formatNumberWithSeparator(a_abi) : '');
        $('#a_dem' + row).val(a_dem ? formatNumberWithSeparator(a_dem) : '');
    }
    
    // ============================================================
    // مدیریت رویدادها
    // ============================================================
    function attachFieldEvents(row) {
        ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
            var input = $('#' + field + row);
            
            input.on('change', function() {
                var value = $(this).val();
                var cleanValue = unformatNumber(value);
                if (cleanValue !== '') {
                    validateField(row, field, cleanValue);
                } else {
                    var infoDiv = $('#info_' + field + '_' + row);
                    infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                    $('#' + field + row).removeClass('error success');
                    $('#submit' + row).prop('disabled', false);
                }
                calcRow(row);
            });
            
            var timer;
            input.on('keyup', function() {
                clearTimeout(timer);
                var value = $(this).val();
                var cleanValue = unformatNumber(value);
                timer = setTimeout(function() {
                    if (cleanValue !== '') {
                        validateField(row, field, cleanValue);
                    }
                }, 400);
                calcRow(row);
            });
            
            input.on('input', function() {
                var value = $(this).val().replace(/[^\d.]/g, '');
                var parts = value.split('.');
                if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
                $(this).val(value ? formatNumberWithSeparator(value) : '');
            });
            
            if (field === 's_abi') {
                input.on('change', function() {
                    $('#t_abi' + row).val('');
                    var infoDiv = $('#info_t_abi_' + row);
                    infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                    $('#t_abi' + row).removeClass('error success');
                });
            }
            if (field === 's_dem') {
                input.on('change', function() {
                    $('#t_dem' + row).val('');
                    var infoDiv = $('#info_t_dem_' + row);
                    infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                    $('#t_dem' + row).removeClass('error success');
                });
            }
        });
    }
    
    // ============================================================
    // ثبت داده‌ها (ذخیره)
    // ============================================================
    function attachSubmitHandler(row) {
        $('#submit' + row).click(function(e) {
            e.preventDefault();
            
            var s_abi = unformatNumber($('#s_abi' + row).val());
            var s_dem = unformatNumber($('#s_dem' + row).val());
            var t_abi = unformatNumber($('#t_abi' + row).val());
            var t_dem = unformatNumber($('#t_dem' + row).val());
            var a_abi = unformatNumber($('#a_abi' + row).val());
            var a_dem = unformatNumber($('#a_dem' + row).val());
            var id = $('#id' + row).val();
            var id_ostan = $('#id_ostan' + row).val();
            var id_city = $('#id_city' + row).val();
            var z_sal = $('#z_sal' + row).val();
            var id_product = $('#product_cod' + row).val();
            
            var isValid = true;
            var errorMessages = [];
            if (parseFloat(s_abi) > 0 && parseFloat(t_abi) <= 0) {
                isValid = false;
                errorMessages.push('برای سطح آبی، تولید باید بزرگتر از 0 باشد');
            }
            if (parseFloat(s_dem) > 0 && parseFloat(t_dem) <= 0) {
                isValid = false;
                errorMessages.push('برای سطح دیم، تولید باید بزرگتر از 0 باشد');
            }
            
            if (!isValid) {
                alert('⚠️ ' + errorMessages.join('\n'));
                return false;
            }
            
            $.post('sabt_ab.php', {
                s_abi: s_abi,
                s_dem: s_dem,
                t_abi: t_abi,
                t_dem: t_dem,
                a_abi: a_abi,
                a_dem: a_dem,
                id: id,
                id_ostan: id_ostan,
                id_city: id_city,
                z_sal: z_sal,
                id_product: id_product
            }, function(response) {
                if (response.valid) {
                    $('.success' + row).fadeIn(200).show();
                    $('.error' + row).fadeOut(200).hide();
                    alert('✅ ' + response.message);
                } else {
                    alert('❌ ' + response.message);
                    $('.success' + row).fadeOut(200).hide();
                    $('.error' + row).fadeIn(200).show();
                }
            }, 'json').fail(function() {
                alert('⚠️ خطا در ارتباط با سرور');
            });
            
            return false;
        });
    }
    
    // ============================================================
    // مقداردهی اولیه و به‌روزرسانی خودکار
    // ============================================================
    $(document).ready(function() {
        var row = 1;
        while ($('#s_abi' + row).length > 0) {
            attachFieldEvents(row);
            attachSubmitHandler(row);
            calcRow(row);
            ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
                var value = unformatNumber($('#' + field + row).val());
                if (value && value > 0) {
                    validateField(row, field, value);
                }
            });
            row++;
        }
        setInterval(function() { validationCache = {}; }, 300000);
    });
    
    function refreshAllBalances() {
        var row = 1;
        while ($('#s_abi' + row).length > 0) {
            ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
                var value = unformatNumber($('#' + field + row).val());
                if (value && value > 0) {
                    var cacheKey = row + '_' + field + '_' + value;
                    delete validationCache[cacheKey];
                    validateField(row, field, value);
                }
            });
            row++;
        }
    }
    
    var autoRefreshInterval;
    $(document).on('mousemove keydown', function() {
        clearInterval(autoRefreshInterval);
        autoRefreshInterval = setInterval(refreshAllBalances, 30000);
    });
    autoRefreshInterval = setInterval(refreshAllBalances, 30000);
    </script>
</body>
</html>
<?php
// بستن اتصال دیتابیس (در صورت نیاز)
// $dbh = null;
?>