<?php 
/**
 * Garden_s_ab2.php - برش یک محصول باغی در همه شهرستان‌ها
 * نسخه بهینه‌شده: یک اسکریپت سراسری + یک اینتروال + یک کوئری درج
 * سازگار با PHP 5.3.3
 */

include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_baghi.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name  = isset($_POST['mah_name'])  ? $_POST['mah_name']  : '';
$id_ostan  = $_SESSION['id_ostan'];

function renderBaghiSummaryBoxSimple($summary_data, $product_name = '') {
    $html = '
    <div class="summary-box" style="background: #f0f7ff; border: 2px solid #006699; border-radius: 8px; padding: 10px 16px; margin: 12px auto; width: 95%; text-align: right; font-family: Tahoma; font-size: 13px; direction: rtl;">
        <div style="font-size:15px; font-weight:bold; color:#003366; border-bottom:1px solid #006699; padding-bottom:4px; margin-bottom:6px;">
            📊 ' . htmlspecialchars($product_name) . '
        </div>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size:13px;">
            <tr>
                <td width="12%" style="font-weight:bold; color:#003366;">سطح بارور:</td>
                <td width="38%">
                    آبی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_abi']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['s_bar_abi']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['s_bar_abi']['remaining'],2) . ')</span>
                </td>
                <td width="12%" style="font-weight:bold; color:#003366;"></td>
                <td width="38%">
                    دیم: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_bar_dem']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['s_bar_dem']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['s_bar_dem']['remaining'],2) . ')</span>
                </td>
            </tr>
            <tr style="background:#e8f0f8;">
                <td style="font-weight:bold; color:#003366;">سطح غیربارور:</td>
                <td>
                    آبی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_abi']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['s_nobar_abi']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['s_nobar_abi']['remaining'],2) . ')</span>
                </td>
                <td style="font-weight:bold; color:#003366;"></td>
                <td>
                    دیم: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['s_nobar_dem']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['s_nobar_dem']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['s_nobar_dem']['remaining'],2) . ')</span>
                </td>
            </tr>
            <tr style="border-top:1px dashed #ccc;">
                <td style="font-weight:bold; color:#003366;">تولید:</td>
                <td>
                    آبی: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_abi']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['t_abi']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['t_abi']['remaining'],2) . ')</span>
                </td>
                <td style="font-weight:bold; color:#003366;"></td>
                <td>
                    دیم: <span style="color:#006699; font-weight:bold;">' . number_format($summary_data['t_dem']['total'],2) . '</span>
                    از <span style="color:#c62828; font-weight:bold;">' . number_format($summary_data['t_dem']['limit'],2) . '</span>
                    <span style="color:#2e7d32; font-weight:bold;">(موجودی: ' . number_format($summary_data['t_dem']['remaining'],2) . ')</span>
                </td>
            </tr>
        </table>
        <div style="font-size:11px; color:#888; margin-top:4px; border-top:1px solid #e0e0e0; padding-top:4px; text-align:center;">
            💡 مجموع &nbsp;|&nbsp; سقف &nbsp;|&nbsp; موجودی قابل تخصیص
        </div>
    </div>';
    return $html;
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
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 { color:#003366; font-family:Tahoma; font-size:18px; }
.style8 { font-family:Tahoma; font-size:14px; }
#content { width:900px; margin:0 auto; font-family:Arial, Helvetica, sans-serif; }
.page { float:right; margin:0; padding:0; }
.page li { list-style:none; display:inline-block; }
.page li a, .current { display:block; padding:5px; text-decoration:none; color:#8A8A8A; }
.current { font-weight:bold; color:#000; }
.button { padding:5px 15px; text-decoration:none; background:#333; color:#F3F3F3; font-size:13PX; border-radius:2PX; margin:0 4PX; display:block; float:left; }
.column { float:left; width:12.25%; padding:5px; }
.row { width:100% }
.row::after { content:""; clear:both; display:table; }

.agri-table { width:100%; margin:24px auto; border-collapse:collapse; font-family:Tahoma, Arial, sans-serif; font-size:14px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.07); border-radius:12px; overflow:hidden; }
.agri-table th, .agri-table td { padding:8px 6px; text-align:center; border:1px solid #e0e0e0; }
.agri-table th:last-child, .agri-table td:last-child { border-right:1px solid #e0e0e0; }
.agri-table th:first-child, .agri-table td:first-child { border-left:1px solid #e0e0e0; }
.agri-table th { background:#006699; color:#fff; font-weight:bold; font-size:15px; }
.agri-table tr:nth-child(even) { background:#f9f9f9; }
.agri-table tr:nth-child(odd) { background:#fff; }
.agri-table tr:hover { background:#e6f2ff; }

.balance-info { font-size:10px; padding:2px 4px; margin-top:2px; border-radius:3px; text-align:right; line-height:1.5; direction:rtl; max-width:180px; }
.balance-valid { background:#e8f5e9; color:#2e7d32; }
.balance-warning { background:#fff3e0; color:#e65100; }
.balance-error { background:#ffebee; color:#c62828; }

.input-field { width:78px; height:28px; font-family:Tahoma; font-size:13px; text-align:center; border:1px solid #ccc; border-radius:3px; }
.input-field:focus { border-color:#006699; box-shadow:0 0 5px rgba(0,102,153,0.3); outline:none; }
.input-field.error { border-color:#c62828; background:#ffebee; }
.input-field.success { border-color:#2e7d32; background:#e8f5e9; }

.submit-btn { width:38px; height:32px; font-size:13px; color:#900; font-family:tahoma; text-align:center; border:1px solid #ccc; border-radius:4px; cursor:pointer; background:#fff; }
.submit-btn:hover:not(:disabled) { background:#006699; color:#fff; }
.submit-btn:disabled { opacity:0.5; cursor:not-allowed; }

@media (max-width: 900px) {
    .agri-table { font-size:12px; }
    .agri-table th, .agri-table td { padding:6px 3px; }
    .input-field { width:62px; height:24px; font-size:11px; }
    .balance-info { font-size:9px; max-width:120px; }
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" /></td></tr>
    <tr><td><?php include('menu.php'); ?></td></tr>
    <tr><td>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                <td width="840">
                    <?php include('top.php');?>
                    <span class="style8">برنامه الگوی کشت ابلاغی محصولات باغی</span><br />

                    <form id="reg-form" method="post" action="#1">
                        <div style="width: 350px; padding: 5px; border: 2px solid #09C; margin: auto; border-radius: 15px">
                            <table width="100%" height="213" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr bgcolor="#f1f1f1"><td height="22" colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td></tr>
                                <tr bgcolor="#f1f1f1">
                                    <td height="54" align="right" bgcolor="#FFFFFF" class="input_text">
                                        <div align="right">
                                            <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px; height:40px" tabindex="1" dir="rtl">
                                                <option value="">انتخاب گروه</option>
                                                <?php
                                                $query = "SELECT DISTINCT group_cod, group_name FROM product_b ORDER BY group_cod ASC";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['group_cod']; ?>" <?php if (isset($_POST['mah_qroup']) && $row['group_cod'] == $mah_qroup) echo 'selected="selected"'; ?>>
                                                    <?php echo $row['group_name']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
                                </tr>
                                <tr bgcolor="#f1f1f1">
                                    <td height="54" align="right" bgcolor="#FFFFFF" class="input_text">
                                        <div align="right">
                                            <select name="mah_name" class="required input_text mar" id="mah_name" style="width:170px; height:40px" tabindex="2" dir="rtl">
                                                <?php
                                                if (!empty($mah_qroup)) {
                                                    $query = "SELECT DISTINCT product_cod, product_name FROM product_b WHERE group_cod = :mah_qroup ORDER BY product_name ASC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->bindParam(':mah_qroup', $mah_qroup);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['product_cod']; ?>" <?php if ($row['product_cod'] == $mah_name) echo 'selected="selected"'; ?>>
                                                    <?php echo $row['product_name']; ?>
                                                </option>
                                                <?php
                                                    }
                                                } else {
                                                    echo '<option value="">ابتدا گروه را انتخاب کنید</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="style8">: نام محصول</td>
                                </tr>
                                <tr bgcolor="#f1f1f1">
                                    <td height="71" align="right" bgcolor="#FFFFFF" class="input_text">
                                        <div align="right">
                                            <select name="z_sal" class="input_text required" id="z_sal" style="height:40px; width:170px; direction:rtl" tabindex="3">
                                                <option value="1405" <?php if (isset($z_sal) && $z_sal == '1405') echo 'selected="selected"'; ?>>1405</option>
                                                <option value="1404" <?php if (isset($z_sal) && $z_sal == '1404') echo 'selected="selected"'; ?>>1404</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td width="146" align="center" bgcolor="#FFFFFF" class="style1"><span class="style8">: سال </span></td>
                                </tr>
                                <tr>
                                    <td height="60" colspan="2" align="left">
                                        <input name="action" type="submit" id="action" style="width:150px; height:45px; alignment-adjust:middle" tabindex="4" value="جستجو" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>

                    <p>
<?php
$t_row = 0;
if (isset($_POST['action']) && !empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {

    // ---- ۱) بررسی الگو در سطح استان ----
    $stmt_check_ostan = $dbh->prepare("
        SELECT COUNT(*) FROM Garden_ab_ostan
        WHERE z_sal = :z_sal AND product_cod = :mah_name
          AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0)
          AND id_ostan = :id_ostan
    ");
    $stmt_check_ostan->execute(array(
        ':z_sal' => $z_sal, ':mah_name' => $mah_name, ':id_ostan' => $id_ostan
    ));
    $count_ostan = $stmt_check_ostan->fetchColumn();

    if ($count_ostan > 0) {

        // ---- ۲) درج یک‌باره با CROSS JOIN (به جای N کوئری) ----
        $q_insert = $dbh->prepare("
            INSERT INTO Garden_ab_city
                (group_cod, group_name, product_cod, product_name, id_ostan, id_city, z_sal)
            SELECT p.group_cod, p.group_name, p.product_cod, p.product_name,
                   :id_ostan_1, c.id_city, :z_sal_1
            FROM product_b p
            CROSS JOIN cityname c
            WHERE p.product_cod = :mah_name
              AND p.group_cod   = :mah_qroup
              AND c.id_ostan    = :id_ostan_2
              AND NOT EXISTS (
                  SELECT 1 FROM Garden_ab_city a
                  WHERE a.product_cod = p.product_cod
                    AND a.group_cod   = p.group_cod
                    AND a.id_ostan    = :id_ostan_3
                    AND a.id_city     = c.id_city
                    AND a.z_sal       = :z_sal_2
              )
        ");
        $q_insert->execute(array(
            ':id_ostan_1' => $id_ostan,
            ':id_ostan_2' => $id_ostan,
            ':id_ostan_3' => $id_ostan,
            ':z_sal_1'    => $z_sal,
            ':z_sal_2'    => $z_sal,
            ':mah_name'   => $mah_name,
            ':mah_qroup'  => $mah_qroup
        ));

        // ---- ۳) خواندن رکوردها ----
        $query = "
            SELECT a.*, c.city
            FROM Garden_ab_city a
            JOIN cityname c ON a.id_city = c.id_city AND a.id_ostan = c.id_ostan
            WHERE a.z_sal = :z_sal
              AND a.group_cod = :mah_qroup
              AND a.product_cod = :mah_name
              AND a.id_ostan = :id_ostan
            ORDER BY BINARY c.city ASC
        ";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(
            ':z_sal'     => $z_sal,
            ':mah_qroup' => $mah_qroup,
            ':mah_name'  => $mah_name,
            ':id_ostan'  => $id_ostan
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $t_row = count($rows);

        if ($t_row > 0) {
            $summary_data = getBaghiSummaryData($dbh, array(
                'id_ostan'    => $id_ostan,
                'z_sal'       => $z_sal,
                'product_cod' => $mah_name
            ));

            $stmt_pname = $dbh->prepare("SELECT product_name FROM product_b WHERE product_cod = :mah_name LIMIT 1");
            $stmt_pname->execute(array(':mah_name' => $mah_name));
            $product_name = $stmt_pname->fetchColumn();

            echo renderBaghiSummaryBoxSimple($summary_data, $product_name);
            ?>

            <table width="122" height="56" border="0" align="center">
                <tr><td>
                    <form action="Sab_L2p_xls.php" method="post">
                        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup; ?>" />
                        <input type="hidden" name="mah_name" value="<?php echo $mah_name; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="44" height="45" alt=""/></button>
                    </form>
                </td></tr>
            </table>

            <table class="agri-table" id="main-table">
                <thead>
                    <tr class="text1">
                        <th width="5%" rowspan="2">عملیات</th>
                        <th colspan="2">عملکرد / کیلوگرم در هکتار</th>
                        <th colspan="2">تولید / تن</th>
                        <th colspan="2">سطح بارور / هکتار</th>
                        <th colspan="2">سطح غیربارور / هکتار</th>
                        <th width="14%" rowspan="2">شهرستان</th>
                        <th width="4%" rowspan="2">ردیف</th>
                    </tr>
                    <tr class="text1">
                        <th width="8%">دیم</th>
                        <th width="8%">آبی</th>
                        <th width="8%">دیم</th>
                        <th width="8%">آبی</th>
                        <th width="7%">دیم</th>
                        <th width="7%">آبی</th>
                        <th width="7%">دیم</th>
                        <th width="7%">آبی</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $r = 1;
                foreach($rows as $row){
                    $t_r = $r;
                    $id_city = $row['id_city'];
                ?>
                    <tr id="row-<?php echo $t_r; ?>">
                        <td class="normalTextSmall">
                            <form name="form<?php echo $t_r; ?>">
                                <input type="hidden" id="id<?php echo $t_r; ?>" name="id" value="<?php echo $row['id']; ?>" />
                                <input type="hidden" id="id_city<?php echo $t_r; ?>" name="id_city" value="<?php echo $id_city; ?>" />
                                <input type="hidden" id="z_sal<?php echo $t_r; ?>" name="z_sal" value="<?php echo $z_sal; ?>" />
                                <input type="hidden" id="id_ostan<?php echo $t_r; ?>" name="id_ostan" value="<?php echo $id_ostan; ?>" />
                                <input type="hidden" id="product_cod<?php echo $t_r; ?>" name="product_cod" value="<?php echo $mah_name; ?>" />
                                <input type="hidden" id="group_cod<?php echo $t_r; ?>" name="group_cod" value="<?php echo $mah_qroup; ?>" />
                                <input name="submit" type="submit" class="submit-btn submit<?php echo $t_r; ?>" id="submit<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 9); ?>" value="ثبت" />
                                <span class="error<?php echo $t_r; ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15" alt=""/></span>
                                <span class="success<?php echo $t_r; ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15" alt=""/></span>
                            </form>
                        </td>
                        <td><input name="a_dem" type="text" class="style8" id="a_dem<?php echo $t_r; ?>" style="width:55px; height:26px;" readonly /></td>
                        <td><input name="a_abi" type="text" class="style8" id="a_abi<?php echo $t_r; ?>" style="width:55px; height:26px;" readonly /></td>
                        <td>
                            <input name="t_dem" type="text" class="input-field t_dem<?php echo $t_r; ?> required number" id="t_dem<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 6); ?>" value="<?php echo $row['t_dem'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_t_dem_<?php echo $t_r; ?>"></div>
                        </td>
                        <td>
                            <input name="t_abi" type="text" class="input-field t_abi<?php echo $t_r; ?> required number" id="t_abi<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 5); ?>" value="<?php echo $row['t_abi'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_t_abi_<?php echo $t_r; ?>"></div>
                        </td>
                        <td>
                            <input name="s_bar_dem" type="text" class="input-field s_bar_dem<?php echo $t_r; ?> required digits" id="s_bar_dem<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 4); ?>" value="<?php echo $row['s_bar_dem'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_s_bar_dem_<?php echo $t_r; ?>"></div>
                        </td>
                        <td>
                            <input name="s_bar_abi" type="text" class="input-field s_bar_abi<?php echo $t_r; ?> required digits" id="s_bar_abi<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 3); ?>" value="<?php echo $row['s_bar_abi'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_s_bar_abi_<?php echo $t_r; ?>"></div>
                        </td>
                        <td>
                            <input name="s_nobar_dem" type="text" class="input-field s_nobar_dem<?php echo $t_r; ?> required digits" id="s_nobar_dem<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 2); ?>" value="<?php echo $row['s_nobar_dem'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_s_nobar_dem_<?php echo $t_r; ?>"></div>
                        </td>
                        <td>
                            <input name="s_nobar_abi" type="text" class="input-field s_nobar_abi<?php echo $t_r; ?> required digits" id="s_nobar_abi<?php echo $t_r; ?>" tabindex="<?php echo ($r * 10 + 1); ?>" value="<?php echo $row['s_nobar_abi'] * 1; ?>" maxlength="12" />
                            <div class="balance-info" id="info_s_nobar_abi_<?php echo $t_r; ?>"></div>
                        </td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $r; ?></td>
                    </tr>
                <?php
                    $r++;
                }
                ?>
                </tbody>
            </table>
<?php
        } else {
            echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p>';
        }
    } else {
        echo '<p class="style8">برنامه الگوی کشت برای این محصول در سطح استان تعریف نشده است</p>';
    }
} else {
    echo '<p class="style8"></p>';
}
?>
                    <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/> </a></p>
                </td>
            </tr>
            <tr>
                <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td>
            </tr>
        </table>
    </td></tr>
</table>

<script type="text/javascript">
// بارگذاری پویای محصولات بر اساس گروه (بدون تغییر)
$(document).ready(function() {
    $(".country").change(function() {
        var id = $(this).val();
        var dataString = 'group_cod=' + id;
        $.ajax({
            type: "POST",
            url: "ajax_city.php",
            data: dataString,
            cache: false,
            success: function(html) { $(".mar").html(html); }
        });
    });
});
</script>

<?php if ($t_row > 0) { ?>
<script type="text/javascript">
/**
 * ============================================================
 *  اسکریپت واحد برای همه ردیف‌ها (به جای N اسکریپت جدا)
 *  منطق عیناً همان نسخه اصلی است، فقط row به‌عنوان پارامتر
 * ============================================================
 */
var TOTAL_ROWS = <?php echo (int)$t_row; ?>;

// ===== ابزار کمکی (یک بار تعریف می‌شود) =====
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

// ===== کش سراسری (کلید: row_field_value) =====
var validationCache = {};

// ============================================================
// اعتبارسنجی
// ============================================================
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

    // ★ همان ساختار قبلی: نام فیلد به‌عنوان کلید پارامتر ★
    var postData = {
        z_sal:       $('#z_sal' + row).val(),
        id_ostan:    $('#id_ostan' + row).val(),
        id_city:     $('#id_city' + row).val(),
        product_cod: $('#product_cod' + row).val(),
        id_rec:      $('#id' + row).val()
    };
    postData[field] = value;

    $.post('check_s_abi.php', postData, function(response) {
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
        var field_label = response.data.field_label || field;

        var statusText = '✅ مجاز';
        var statusClass = 'balance-valid';
        if (new_remaining < 0) {
            statusText = '⚠️ بیش از سقف';
            statusClass = 'balance-warning';
        } else if (new_remaining === 0) {
            statusText = '⚠️ تکمیل شده';
            statusClass = 'balance-warning';
        }

        var infoHtml = '<span style="font-weight:bold;">' + statusText + '</span><br>';
        infoHtml += '📊 سقف: ' + formatNumberWithSeparator(city_limit) + '<br>';
        infoHtml += '📌 مجموع: ' + formatNumberWithSeparator(total_current) + '<br>';
        infoHtml += '💰 موجودی جدید: ' + formatNumberWithSeparator(new_remaining);

        infoDiv.html(infoHtml).addClass(statusClass);
        input.addClass('success');
        submitBtn.prop('disabled', false);
    } else {
        var message = response.message || 'مقدار وارد شده مجاز نیست';
        var displayMessage = message.replace(/\n/g, '<br>');

        if (response.data) {
            var max_allowed = response.data.max_allowed;
            if (max_allowed !== undefined) {
                displayMessage += '<br>💡 حداکثر مجاز: ' + formatNumberWithSeparator(max_allowed);
            }
            var new_remaining = response.data.new_remaining;
            if (new_remaining !== undefined) {
                displayMessage += '<br>💰 موجودی پس از تغییر: ' + formatNumberWithSeparator(new_remaining);
            }
        }

        infoDiv.html(
            '<span style="color: #c62828; font-weight:bold;">❌ ' + displayMessage + '</span>'
        ).addClass('balance-error');
        input.addClass('error');
        submitBtn.prop('disabled', true);

        if (response.data && response.data.max_allowed !== undefined && response.data.max_allowed > 0) {
            infoDiv.append(
                '<br><button type="button" class="set-max-btn" ' +
                'data-row="' + row + '" data-field="' + field + '" data-max="' + response.data.max_allowed + '" ' +
                'style="background: #1565c0; color: white; border: none; padding: 2px 8px; border-radius: 3px; ' +
                'cursor: pointer; font-size: 10px; margin-top: 3px;">' +
                '🔄 جایگزینی با حداکثر مجاز (' + formatNumberWithSeparator(response.data.max_allowed) + ')' +
                '</button>'
            );
        }
    }
}

// دکمه «جایگزینی با حداکثر» - با event delegation (بدون onclick درون‌خطی)
$(document).on('click', '.set-max-btn', function() {
    var $b = $(this);
    var row = $b.data('row');
    var field = $b.data('field');
    var maxValue = $b.data('max');
    $('#' + field + row).val(formatNumberWithSeparator(maxValue));
    $('#' + field + row).trigger('change');
    $('#' + field + row).focus();
});

// ============================================================
// محاسبه خودکار عملکرد
// ============================================================
function calcRow(row) {
    var t_abi = parseFloat(unformatNumber($('#t_abi' + row).val())) || 0;
    var s_bar_abi = parseFloat(unformatNumber($('#s_bar_abi' + row).val())) || 0;
    var t_dem = parseFloat(unformatNumber($('#t_dem' + row).val())) || 0;
    var s_bar_dem = parseFloat(unformatNumber($('#s_bar_dem' + row).val())) || 0;

    var a_abi = s_bar_abi > 0 ? (t_abi / s_bar_abi * 1000).toFixed(2) : '';
    var a_dem = s_bar_dem > 0 ? (t_dem / s_bar_dem * 1000).toFixed(2) : '';

    $('#a_abi' + row).val(a_abi ? formatNumberWithSeparator(a_abi) : '');
    $('#a_dem' + row).val(a_dem ? formatNumberWithSeparator(a_dem) : '');
}

// ============================================================
// ثبت داده‌ها (ذخیره) - دقیقاً مثل نسخه اصلی
// ============================================================
function submitRow(row) {
    var s_bar_abi = unformatNumber($("#s_bar_abi" + row).val());
    var s_bar_dem = unformatNumber($("#s_bar_dem" + row).val());
    var s_nobar_abi = unformatNumber($("#s_nobar_abi" + row).val());
    var s_nobar_dem = unformatNumber($("#s_nobar_dem" + row).val());
    var t_abi = unformatNumber($("#t_abi" + row).val());
    var t_dem = unformatNumber($("#t_dem" + row).val());
    var a_abi = unformatNumber($("#a_abi" + row).val());
    var a_dem = unformatNumber($("#a_dem" + row).val());
    var id = $("#id" + row).val();
    var id_ostan = $('#id_ostan' + row).val();
    var id_city = $("#id_city" + row).val();
    var z_sal = $("#z_sal" + row).val();
    var id_product = $("#product_cod" + row).val();

    var isValid = true;
    var errorMessages = [];

    if (parseFloat(s_bar_abi) > 0 && parseFloat(t_abi) <= 0) {
        isValid = false;
        errorMessages.push('برای سطح بارور آبی، تولید باید بزرگتر از 0 باشد');
    }
    if (parseFloat(s_bar_dem) > 0 && parseFloat(t_dem) <= 0) {
        isValid = false;
        errorMessages.push('برای سطح بارور دیم، تولید باید بزرگتر از 0 باشد');
    }

    if (id == 0) {
        var hasSurface = (
            parseFloat(s_bar_abi) > 0 ||
            parseFloat(s_bar_dem) > 0 ||
            parseFloat(s_nobar_abi) > 0 ||
            parseFloat(s_nobar_dem) > 0
        );
        if (!hasSurface) {
            isValid = false;
            errorMessages.push('حداقل یکی از فیلدهای سطح (بارور یا غیربارور) باید دارای مقدار باشد');
        }
    }

    if (!isValid) {
        alert('⚠️ ' + errorMessages.join('\n'));
        return false;
    }

    $.post('sabt_ab.php', {
        s_bar_abi: s_bar_abi,
        s_bar_dem: s_bar_dem,
        s_nobar_abi: s_nobar_abi,
        s_nobar_dem: s_nobar_dem,
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
}

// ============================================================
// به‌روزرسانی خودکار - یک اینتروال سراسری به جای N اینتروال
// ============================================================
var refreshTimer = null;
var refreshQueue = [];
var refreshBusy = false;

function buildRefreshQueue() {
    refreshQueue = [];
    for (var row = 1; row <= TOTAL_ROWS; row++) {
        ['s_bar_abi', 's_bar_dem', 's_nobar_abi', 's_nobar_dem', 't_abi', 't_dem'].forEach(function(field) {
            var v = unformatNumber($('#' + field + row).val());
            if (v && parseFloat(v) > 0) {
                refreshQueue.push({ row: row, field: field, value: v });
            }
        });
    }
}

function processRefreshQueue() {
    if (refreshQueue.length === 0) { refreshBusy = false; return; }
    refreshBusy = true;
    var item = refreshQueue.shift();
    var cacheKey = item.row + '_' + item.field + '_' + item.value;
    delete validationCache[cacheKey];
    validateField(item.row, item.field, item.value);
    setTimeout(processRefreshQueue, 200);
}

function tickRefresh() {
    if (refreshBusy) return;
    buildRefreshQueue();
    processRefreshQueue();
}

function startRefreshTimer() {
    if (refreshTimer) clearInterval(refreshTimer);
    refreshTimer = setInterval(tickRefresh, 30000);
}

// ============================================================
// راه‌اندازی: یک بار bind همه ردیف‌ها
// ============================================================
$(document).ready(function() {

    var FIELDS = ['s_bar_abi', 's_bar_dem', 's_nobar_abi', 's_nobar_dem', 't_abi', 't_dem'];

    for (var row = 1; row <= TOTAL_ROWS; row++) {
        (function(r) {
            FIELDS.forEach(function(field) {
                var $input = $('#' + field + r);

                $input.on('change', function() {
                    var value = $(this).val();
                    var cleanValue = unformatNumber(value);
                    if (cleanValue !== '') {
                        validateField(r, field, cleanValue);
                    } else {
                        var infoDiv = $('#info_' + field + '_' + r);
                        infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                        $input.removeClass('error success');
                        $('#submit' + r).prop('disabled', false);
                    }
                    calcRow(r);
                });

                var timer;
                $input.on('keyup', function() {
                    clearTimeout(timer);
                    var value = $(this).val();
                    var cleanValue = unformatNumber(value);
                    timer = setTimeout(function() {
                        if (cleanValue !== '') {
                            validateField(r, field, cleanValue);
                        }
                    }, 400);
                    calcRow(r);
                });

                // ★ ورودی: فقط رقم و نقطه، ۴ رقم اعشار، حفظ مکان‌نما ★
                $input.on('input', function() {
                    var el = this;
                    var oldValue = el.value;
                    var oldCaret = el.selectionStart;

                    var meaningfulBefore = 0;
                    for (var i = 0; i < oldCaret && i < oldValue.length; i++) {
                        var ch = oldValue.charAt(i);
                        if ((ch >= '0' && ch <= '9') || ch === '.') meaningfulBefore++;
                    }

                    var value = oldValue.replace(/[^\d.]/g, '');
                    var parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }
                    parts = value.split('.');
                    if (parts.length === 2 && parts[1].length > 4) {
                        value = parts[0] + '.' + parts[1].substring(0, 4);
                    }

                    var newValue = value ? formatNumberWithSeparator(value) : '';
                    el.value = newValue;

                    var count = 0;
                    var newCaret = newValue.length;
                    for (var j = 0; j < newValue.length; j++) {
                        var c = newValue.charAt(j);
                        if ((c >= '0' && c <= '9') || c === '.') {
                            count++;
                            if (count >= meaningfulBefore) { newCaret = j + 1; break; }
                        }
                    }
                    try { el.setSelectionRange(newCaret, newCaret); } catch (e) {}
                });

                // پاک کردن تولید وابسته هنگام تغییر سطح بارور (مثل نسخه اصلی)
                if (field === 's_bar_abi') {
                    $input.on('change', function() {
                        $('#t_abi' + r).val('');
                        var infoDiv = $('#info_t_abi_' + r);
                        infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                        $('#t_abi' + r).removeClass('error success');
                    });
                }
                if (field === 's_bar_dem') {
                    $input.on('change', function() {
                        $('#t_dem' + r).val('');
                        var infoDiv = $('#info_t_dem_' + r);
                        infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                        $('#t_dem' + r).removeClass('error success');
                    });
                }
            });

            // دکمه ثبت این ردیف
            $(".submit" + r).click(function(e) {
                e.preventDefault();
                submitRow(r);
                return false;
            });

            // محاسبه اولیه و اعتبارسنجی اولیه
            calcRow(r);
            FIELDS.forEach(function(field) {
                var value = unformatNumber($('#' + field + r).val());
                if (value && parseFloat(value) > 0) {
                    validateField(r, field, value);
                }
            });

        })(row);
    }

    // یک اینتروال سراسری برای همه ردیف‌ها
    startRefreshTimer();

    // ریست تایمر به‌روزرسانی روی فعالیت کاربر (یک هندلر به جای N هندلر)
    $(document).on('mousemove keydown', function() {
        startRefreshTimer();
    });
});
</script>
<?php } ?>
</body>
</html>