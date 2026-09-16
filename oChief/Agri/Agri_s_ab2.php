<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_city.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan = $_SESSION['id_ostan'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">
        <!--
        .tabel { margin-right:45px }
        .text_r { margin-right:0px }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        .style8 {
            font-family: Tahoma;
            font-size: 14px;
        }

        #content
        {
            width: 900px;
            margin: 0 auto;
            font-family:Arial, Helvetica, sans-serif;
        }
        .page
        {
            float: right;
            margin: 0;
            padding: 0;
        }
        .page li
        {
            list-style: none;
            display:inline-block;
        }
        .page li a, .current
        {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #8A8A8A;
        }
        .current
        {
            font-weight:bold;
            color: #000;
        }
        .button
        {
            padding: 5px 15px;
            text-decoration: none;
            background: #333;
            color: #F3F3F3;
            font-size: 13PX;
            border-radius: 2PX;
            margin: 0 4PX;
            display: block;
            float: left;
        }
        .column {
            float: left;
            width:12.25%;
            padding: 5px;
        }
        .row {
            width: 100%
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        /* جدول نتایج مدرن و واکنش‌گرا */
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
        }
        .agri-table th:last-child, .agri-table td:last-child {
            border-left: none;
        }
        .agri-table th {
            background: #006699;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }
        .agri-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .agri-table tr:nth-child(odd) {
            background: #fff;
        }
        .agri-table tr:hover {
            background: #e6f2ff;
        }
        
        /* استایل برای نمایش موجودی - ساده شده */
        .balance-info {
            font-size: 10px;
            padding: 2px 4px;
            margin-top: 2px;
            border-radius: 3px;
            text-align: center;
            line-height: 1.4;
            direction: rtl;
        }
        .balance-valid { background: #e8f5e9; color: #2e7d32; }
        .balance-warning { background: #fff3e0; color: #e65100; }
        .balance-error { background: #ffebee; color: #c62828; }
        
        /* باکس اطلاعات کلی در بالای جدول */
        .summary-box {
            background: #e3f2fd;
            border: 2px solid #006699;
            border-radius: 8px;
            padding: 6px 12px;
            margin: 8px auto;
            width: 92%;
            text-align: right;
            font-family: Tahoma;
            direction: rtl;
        }
        .summary-box .label {
            font-weight: bold;
            color: #003366;
            font-size: 11px;
        }
        .summary-box .value {
            color: #006699;
            font-weight: bold;
            font-size: 11px;
        }
        
        .input-field {
            width: 80px;
            height: 30px;
            font-family: Tahoma;
            font-size: 13px;
            text-align: center;
        }
        .input-field:focus {
            border-color: #006699;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        .input-field.error {
            border-color: #c62828;
            background: #ffebee;
        }
        .input-field.success {
            border-color: #2e7d32;
            background: #e8f5e9;
        }
        
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
        .submit-btn:hover:not(:disabled) {
            background: #006699;
            color: #fff;
        }
        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 900px) {
            .agri-table {
                font-size: 13px;
            }
            .agri-table th, .agri-table td {
                padding: 8px 4px;
            }
            .input-field {
                width: 60px;
                height: 26px;
                font-size: 12px;
            }
            .summary-box {
                font-size: 10px;
                padding: 4px 8px;
            }
            .summary-box .label, .summary-box .value {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840" >
                            <?php include('top.php');?>
                            <span class="style8">برنامه الگوی کشت ابلاغی محصولات زراعی </span><br />
                            </p>
                            <form id="reg-form" method="post" action="#1">
                                <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
                                    <table width="100%" height="213" border='0' align="center" cellpadding='0' cellspacing='0'>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="1" dir="rtl"  >
                                                        <option value="" > انتخاب گروه</option>
                                                        <?php
                                                        $query = "SELECT DISTINCT group_cod,group_name FROM `product_z` ORDER BY group_cod ASC" ;
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->execute();
                                                        foreach($stmt as $row){
                                                            ?>
                                                            <option value="<?php echo $row['group_cod'] ;?>"
                                                                <?php if (isset($_POST['mah_qroup']) && $row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                                                            <?php }?>
                                                    </select>
                                              </div>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="2" dir="rtl">
                                                        <?php
                                                        if (!empty($mah_qroup)) {
                                                            $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE `group_cod` = :mah_qroup ORDER BY product_name ASC" ;
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(':mah_qroup', $mah_qroup);
                                                            $stmt->execute();
                                                            foreach($stmt as $row){
                                                                ?>
                                                                <option value="<?php echo $row['product_cod'] ;?>"
                                                                    <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo '<option value="">ابتدا گروه را انتخاب کنید</option>';
                                                        }
                                                        ?>
                                                    </select>
                                              </div>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style8">: نام محصول</td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="z_sal" class="input_text required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                                                        <option value="1405-1406" <?php if (isset($z_sal) && $z_sal=='1405-1406') echo 'selected=selected'?>>1405-1406</option>
                                                        <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                                                    </select>
                                              </div>
                                            </td>
                                            <td width="146" align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال زراعی</span></td>
                                        </tr>
                                        <tr >
                                            <td height="60" colspan="2" align="left">
                                                <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="5" value='جستجو' />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <p>
                                <?php
                                if (isset($_POST['action']) && !empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {
                                    // 1. کوئری بررسی وجود الگو در سطح استان
                                    $query_check_ostan = "
                                        SELECT COUNT(*) 
                                        FROM Agri_ab_ostan 
                                        WHERE z_sal = :z_sal 
                                          AND product_cod = :mah_name 
                                          AND (s_abi > 0 OR s_dem > 0)
                                          AND id_ostan = :id_ostan
                                    ";
                                    $stmt_check_ostan = $dbh->prepare($query_check_ostan);
                                    $stmt_check_ostan->execute(array(
                                        ':z_sal'    => $z_sal,
                                        ':mah_name' => $mah_name,
                                        ':id_ostan'  => $id_ostan
                                    ));
                                    $count_ostan = $stmt_check_ostan->fetchColumn();

                                    // 2. بررسی نتیجه کوئری
                                    if ($count_ostan > 0) {
                                        // اگر رکوردی یافت شد، ادامه فرآیند را اجرا کن
                                        $query_city_list = "SELECT id_city FROM cityname WHERE id_ostan = :id_ostan";
                                        $stmt_city_list = $dbh->prepare($query_city_list);
                                        $stmt_city_list->bindParam(':id_ostan', $id_ostan);
                                        $stmt_city_list->execute();
                                        $city_ids = $stmt_city_list->fetchAll(PDO::FETCH_COLUMN);

                                        foreach ($city_ids as $city_id) {
                                            $query_insert = "
                                            INSERT INTO Agri_ab_city (group_cod, group_name, product_cod, product_name, id_ostan, id_city, z_sal)
                                            SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :id_ostan, :id_city, :z_sal
                                            FROM product_z p
                                            LEFT JOIN Agri_ab_city a
                                              ON p.product_cod = a.product_cod
                                                 AND p.group_cod = a.group_cod
                                                 AND a.id_ostan = :id_ostan
                                                 AND a.id_city = :id_city
                                                 AND a.z_sal = :z_sal
                                            WHERE a.product_cod IS NULL
                                              AND p.product_cod = :mah_name
                                              AND p.group_cod = :mah_qroup";

                                            $q_insert = $dbh->prepare($query_insert);
                                            $q_insert->execute(array(
                                                ':id_ostan'  => $id_ostan,
                                                ':id_city'   => $city_id,
                                                ':z_sal'     => $z_sal,
                                                ':mah_name'  => $mah_name,
                                                ':mah_qroup' => $mah_qroup
                                            ));
                                        }

                                        $query = "
                                            SELECT a.*, c.city
                                            FROM Agri_ab_city a
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
                                        $t_row = $stmt->rowCount();

                                        if ($t_row > 0) {
                                            // دریافت اطلاعات کلی برای نمایش در summary-box
                                            // برای هر فیلد، یکبار اطلاعات را از دیتابیس می‌گیریم
                                            $summary_data = array();
                                            $fields = array('s_abi', 's_dem', 't_abi', 't_dem');
                                            foreach ($fields as $field) {
                                                // دریافت سقف استان
                                                $q_limit = "SELECT {$field} FROM Agri_ab_ostan WHERE z_sal = :z_sal AND id_ostan = :id_ostan AND product_cod = :mah_name";
                                                $stmt_limit = $dbh->prepare($q_limit);
                                                $stmt_limit->execute(array(':z_sal' => $z_sal, ':id_ostan' => $id_ostan, ':mah_name' => $mah_name));
                                                $city_limit = floatval($stmt_limit->fetchColumn());
                                                
                                                // دریافت مجموع کل (همه شهرستان‌ها)
                                                $q_sum = "SELECT SUM({$field}) FROM Agri_ab_city WHERE z_sal = :z_sal AND id_ostan = :id_ostan AND product_cod = :mah_name";
                                                $stmt_sum = $dbh->prepare($q_sum);
                                                $stmt_sum->execute(array(':z_sal' => $z_sal, ':id_ostan' => $id_ostan, ':mah_name' => $mah_name));
                                                $total_current = floatval($stmt_sum->fetchColumn());
                                                
                                                $summary_data[$field] = array(
                                                    'limit' => $city_limit,
                                                    'total' => $total_current,
                                                    'remaining' => $city_limit - $total_current
                                                );
                                            }
                                            ?>
                                            
                                            <!-- باکس اطلاعات کلی -->
                                            <div class="summary-box">
                                                <div style="font-size:12px; font-weight:bold; color:#003366; border-bottom:1px solid #006699; padding-bottom:3px; margin-bottom:4px;">
                                                    📊 اطلاعات کلی تخصیص محصول: <?php echo $mah_name; ?>
                                                </div>
                                                <table width="100%" border="0" cellpadding="1" cellspacing="0" style="font-size:11px;">
                                                    <tr>
                                                        <td width="25%" style="font-size:11px;"><span class="label">سطح آبی:</span></td>
                                                        <td width="25%" style="font-size:11px;">سقف: <span class="value"><?php echo number_format($summary_data['s_abi']['limit'], 2); ?></span> | مجموع: <span class="value"><?php echo number_format($summary_data['s_abi']['total'], 2); ?></span> | موجودی: <span class="value"><?php echo number_format($summary_data['s_abi']['remaining'], 2); ?></span></td>
                                                        <td width="25%" style="font-size:11px;"><span class="label">سطح دیم:</span></td>
                                                        <td width="25%" style="font-size:11px;">سقف: <span class="value"><?php echo number_format($summary_data['s_dem']['limit'], 2); ?></span> | مجموع: <span class="value"><?php echo number_format($summary_data['s_dem']['total'], 2); ?></span> | موجودی: <span class="value"><?php echo number_format($summary_data['s_dem']['remaining'], 2); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:11px;"><span class="label">تولید آبی:</span></td>
                                                        <td style="font-size:11px;">سقف: <span class="value"><?php echo number_format($summary_data['t_abi']['limit'], 2); ?></span> | مجموع: <span class="value"><?php echo number_format($summary_data['t_abi']['total'], 2); ?></span> | موجودی: <span class="value"><?php echo number_format($summary_data['t_abi']['remaining'], 2); ?></span></td>
                                                        <td style="font-size:11px;"><span class="label">تولید دیم:</span></td>
                                                        <td style="font-size:11px;">سقف: <span class="value"><?php echo number_format($summary_data['t_dem']['limit'], 2); ?></span> | مجموع: <span class="value"><?php echo number_format($summary_data['t_dem']['total'], 2); ?></span> | موجودی: <span class="value"><?php echo number_format($summary_data['t_dem']['remaining'], 2); ?></span></td>
                                                    </tr>
                                                </table>
                                                <div style="font-size:10px; color:#666; margin-top:3px; border-top:1px solid #ccc; padding-top:3px;">
                                                    💡 برای هر شهرستان، مقدار مورد نظر را وارد کنید. موجودی جدید پس از اعمال تغییر در هر ردیف نمایش داده می‌شود.
                                                </div>
                                            </div>
                                            
                                            <table width="122" height="56" border="0" align="center">
                                                <tr>
                                                    <td>
                                                        <form action="Sab_L2p_xls.php" method="post">
                                                            <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                                                            <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                                                            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                                            <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="agri-table" id="main-table">
                                                <tr class="text1">
                                                    <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
                                                    <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
                                                    <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                                                    <td colspan="2" bgcolor="#006699"><p>سطح / هکتار<br /></p></td>
                                                    <td width="10%" height="35" rowspan="2" bgcolor="#006699">شهرستان </td>
                                                    <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
                                                </tr>
                                                <tr class="text1">
                                                    <td width="10%" bgcolor="#006699">دیم</td>
                                                    <td width="10%" bgcolor="#006699">آبی</td>
                                                    <td width="15%" bgcolor="#006699">دیم</td>
                                                    <td width="15%" bgcolor="#006699">آبی</td>
                                                    <td width="15%" bgcolor="#006699">دیم</td>
                                                    <td width="14%" bgcolor="#006699">آبی</td>
                                                </tr>
                                                <?php
                                                $r = 1;
                                                foreach($stmt as $row){
                                                    $t_r = $r ;
                                                    $id_city = $row['id_city'] ;
                                                    ?>
                                                    <tr id="row-<?php echo $t_r; ?>">
                                                        <td height="78" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                                                            <form name="form<?php echo $t_r ?>">
                                                                <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id'] ;?>" />
                                                                <input type="hidden" id="id_city<?php echo $t_r ?>"  name="id_city" value="<?php echo $id_city ;?>" />
                                                                <input type="hidden" id="z_sal<?php echo $t_r ?>" name="z_sal" value="<?php echo $z_sal ;?>" />
                                                                <input type="hidden" id="id_ostan<?php echo $t_r ?>" name="id_ostan" value="<?php echo $id_ostan ;?>" />
                                                                <input type="hidden" id="product_cod<?php echo $t_r ?>" name="product_cod" value="<?php echo  $mah_name ;?>" />
                                                                <input type="hidden" id="group_cod<?php echo $t_r ?>" name="group_cod" value="<?php echo  $mah_qroup ;?>" />
                                                                <input name="submit"  type="submit" class="submit-btn submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:40px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo ($r*10+7); ?>"  value="ثبت"  />
                                                                <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span>
                                                                <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span>
                                                            </form>
                                                        </td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="a_dem"  type="text" class="style8" id="a_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+6); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="a_abi"  type="text" class="style8" id="a_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+5); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="t_dem"  type="text" class="input-field t_dem<?php echo $t_r ?> required number" id="t_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+4); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" />
                                                            <div class="balance-info" id="info_t_dem_<?php echo $t_r; ?>"></div>
                                                        </td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="t_abi"  type="text" class="input-field t_abi<?php echo $t_r ?> required number" id="t_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+3); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" />
                                                            <div class="balance-info" id="info_t_abi_<?php echo $t_r; ?>"></div>
                                                        </td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_dem"  type="text" class="input-field s_dem<?php echo $t_r ?> required digits" id="s_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+2); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" />
                                                            <div class="balance-info" id="info_s_dem_<?php echo $t_r; ?>"></div>
                                                        </td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_abi"  type="text" class="input-field s_abi<?php echo $t_r ?> required digits" id="s_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+1); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" />
                                                            <div class="balance-info" id="info_s_abi_<?php echo $t_r; ?>"></div>
                                                        </td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo $row['city'] ?></td>
                                                        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo $r;?></td>
                                                    </tr>
                                                    <?php
                                                    $r++;
                                                }
                                                ?>
                                            </table>
                                            <p class="style2" align="center">
                                            <?php
                                        } else {
                                            echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p>';
                                        }

                                    } else {
                                        // 3. اگر رکوردی یافت نشد، پیام خطا را نمایش بده
                                        echo '<p class="style8">برنامه الگوی کشت برای این محصول در سطح استان تعریف نشده است</p>';
                                    }

                                } else {
                                    echo '<p class="style8"></p>';
                                }
                                ?>
                            <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <script type="text/javascript">
        // jQuery برای بارگذاری پویای محصولات بر اساس گروه
        $(document).ready(function() {
            $(".country").change(function() {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax_city.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
    </script>

    <?php
    $no = isset($t_row) ? $t_row : 0;
    while ($no > 0){
        ?>
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
    // کش و اعتبارسنجی - نمایش ساده‌شده در هر ردیف
    // ============================================================
    var validationCache<?php echo $no ?> = {};

    function validateField<?php echo $no ?>(field, value) {
        var row = <?php echo $no ?>;
        if (value === '' || value === null) {
            var infoDiv = $('#info_' + field + '_' + row);
            infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
            $('#submit' + row).prop('disabled', false);
            $('#' + field + row).removeClass('error success');
            return;
        }

        var cacheKey = row + '_' + field + '_' + value;
        if (validationCache<?php echo $no ?>[cacheKey] && (Date.now() - validationCache<?php echo $no ?>[cacheKey].timestamp < 2000)) {
            updateUI<?php echo $no ?>(field, validationCache<?php echo $no ?>[cacheKey].result);
            return;
        }

        $.post('check_s_abi.php', {
            [field]: value,
            z_sal: $('#z_sal<?php echo $no ?>').val(),
            id_ostan: $('#id_ostan<?php echo $no ?>').val(),
            id_city: $('#id_city<?php echo $no ?>').val(),
            product_cod: $('#product_cod<?php echo $no ?>').val(),
            id_rec: $('#id<?php echo $no ?>').val()
        }, function(response) {
            validationCache<?php echo $no ?>[cacheKey] = { result: response, timestamp: Date.now() };
            updateUI<?php echo $no ?>(field, response);
        }, 'json').fail(function() {
            var infoDiv = $('#info_' + field + '_' + row);
            infoDiv.html('⚠️ خطا در ارتباط با سرور').addClass('balance-error');
        });
    }

    function updateUI<?php echo $no ?>(field, response) {
        var row = <?php echo $no ?>;
        var infoDiv = $('#info_' + field + '_' + row);
        var input = $('#' + field + row);
        var submitBtn = $('#submit' + row);

        infoDiv.removeClass('balance-valid balance-warning balance-error');
        input.removeClass('error success');

        if (response.valid) {
            var new_remaining = response.data.new_remaining;
            var statusText = '✅ مجاز';
            var statusClass = 'balance-valid';
            if (new_remaining < 0) {
                statusText = '⚠️ بیش از سقف';
                statusClass = 'balance-warning';
            } else if (new_remaining === 0) {
                statusText = '⚠️ تکمیل شده';
                statusClass = 'balance-warning';
            }

            // نمایش ساده: فقط وضعیت و موجودی جدید
            var infoHtml = '<span style="font-weight:bold;">' + statusText + '</span> | موجودی جدید: ' + formatNumberWithSeparator(new_remaining);
            infoDiv.html(infoHtml).addClass(statusClass);
            input.addClass('success');
            submitBtn.prop('disabled', false);
        } else {
            var message = response.message || 'مقدار وارد شده مجاز نیست';
            var displayMessage = message.replace(/\n/g, '<br>');

            // در صورت خطا، پیام کامل نمایش داده شود
            if (response.data) {
                var max_allowed = response.data.max_allowed;
                if (max_allowed !== undefined) {
                    displayMessage += '<br>💡 حداکثر مجاز: ' + formatNumberWithSeparator(max_allowed);
                }
            }

            infoDiv.html(
                '<span style="color: #c62828; font-weight:bold;">❌ ' + displayMessage + '</span>'
            ).addClass('balance-error');
            input.addClass('error');
            submitBtn.prop('disabled', true);

            if (response.data && response.data.max_allowed !== undefined && response.data.max_allowed > 0) {
                infoDiv.append(
                    '<br><button onclick="setMaxValue<?php echo $no ?>(\'' + field + '\', ' + response.data.max_allowed + ')" ' +
                    'style="background: #1565c0; color: white; border: none; padding: 2px 8px; border-radius: 3px; ' +
                    'cursor: pointer; font-size: 10px; margin-top: 2px;">' +
                    '🔄 جایگزینی با حداکثر مجاز (' + formatNumberWithSeparator(response.data.max_allowed) + ')' +
                    '</button>'
                );
            }
        }
    }

    function setMaxValue<?php echo $no ?>(field, maxValue) {
        var row = <?php echo $no ?>;
        $('#' + field + row).val(formatNumberWithSeparator(maxValue));
        $('#' + field + row).trigger('change');
        $('#' + field + row).focus();
    }

    // ============================================================
    // محاسبه خودکار عملکرد
    // ============================================================
    function calcRow<?php echo $no ?>() {
        var row = <?php echo $no ?>;
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
    $(document).ready(function() {
        var row = <?php echo $no ?>;
        
        ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
            var input = $('#' + field + row);

            input.on('change', function() {
                var value = $(this).val();
                var cleanValue = unformatNumber(value);
                if (cleanValue !== '') {
                    validateField<?php echo $no ?>(field, cleanValue);
                } else {
                    var infoDiv = $('#info_' + field + '_' + row);
                    infoDiv.html('').removeClass('balance-valid balance-warning balance-error');
                    $('#' + field + row).removeClass('error success');
                    $('#submit' + row).prop('disabled', false);
                }
                calcRow<?php echo $no ?>();
            });

            var timer;
            input.on('keyup', function() {
                clearTimeout(timer);
                var value = $(this).val();
                var cleanValue = unformatNumber(value);
                timer = setTimeout(function() {
                    if (cleanValue !== '') {
                        validateField<?php echo $no ?>(field, cleanValue);
                    }
                }, 400);
                calcRow<?php echo $no ?>();
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

        // محاسبه اولیه
        calcRow<?php echo $no ?>();
        
        // اعتبارسنجی اولیه
        ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
            var value = unformatNumber($('#' + field + row).val());
            if (value && value > 0) {
                validateField<?php echo $no ?>(field, value);
            }
        });
    });


    // ============================================================
    // ثبت داده‌ها (ذخیره)
    // ============================================================
    $(function() {
        $(".submit<?php echo $no ?>").click(function(e) {
            e.preventDefault();
            
            var row = <?php echo $no ?>;
            var s_abi = unformatNumber($("#s_abi" + row).val());
            var s_dem = unformatNumber($("#s_dem" + row).val());
            var t_abi = unformatNumber($("#t_abi" + row).val());

            var t_dem = unformatNumber($("#t_dem" + row).val());
            var a_abi = unformatNumber($("#a_abi" + row).val());
            var a_dem = unformatNumber($("#a_dem" + row).val());
            var id = $("#id" + row).val();
            var id_ostan = '<?php echo $id_ostan?>';
            var id_city = $("#id_city" + row).val();
            var z_sal = $("#z_sal" + row).val();
            var id_product = $("#product_cod" + row).val();

            // بررسی اعتبار نهایی
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
    });

    // ============================================================
    // به‌روزرسانی خودکار موجودی (هر 30 ثانیه)
    // ============================================================
    function refreshBalances<?php echo $no ?>() {
        var row = <?php echo $no ?>;
        ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(function(field) {
            var value = unformatNumber($('#' + field + row).val());
            if (value && value > 0) {
                var cacheKey = row + '_' + field + '_' + value;
                delete validationCache<?php echo $no ?>[cacheKey];
                validateField<?php echo $no ?>(field, value);
            }
        });
    }

    var autoRefreshInterval<?php echo $no ?>;
    $(document).on('mousemove keydown', function() {
        clearInterval(autoRefreshInterval<?php echo $no ?>);
        autoRefreshInterval<?php echo $no ?> = setInterval(refreshBalances<?php echo $no ?>, 30000);
    });
    autoRefreshInterval<?php echo $no ?> = setInterval(refreshBalances<?php echo $no ?>, 30000);
</script>
        <?php
        $no--;
    }
    ?>
</body>
</html>