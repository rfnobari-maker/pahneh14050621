<?php
// تنظیمات اولیه و فایل‌های مورد نیاز
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');

// تنظیم منطقه زمانی
date_default_timezone_set('Asia/Tehran');

// توابع کمکی برای PHP 5.3 و تمیزکاری کد
function get_post($key, $default = '') {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$date_edit = jdate("Y/m/d");
$time = date('H:i:s');
$id_page = get_post('id_page');

// ------------------------------------------------------------------
// بخش 1: انصراف
// ------------------------------------------------------------------
if (isset($_POST['cancel'])) {
    ?>
    <form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo h($id_page) . '#1'; ?>">
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="back_p" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit(); // توقف اجرای بقیه اسکریپت
}

// ------------------------------------------------------------------
// بخش 2: عملیات ثبت و تصحیح اطلاعات
// ------------------------------------------------------------------
if (isset($_POST['action'])) {
    try {
        // شروع تراکنش برای اطمینان از صحت داده‌ها
        $dbh->beginTransaction();

        $id = get_post('id');
        $date_s = $date_edit;
        $mor_cod_m = $login_session;
        
        // دریافت متغیرها
        $bah_cod_m  = get_post('bah_cod_m');
        $num_bah    = get_post('num_bah');
        $add_city   = get_post('add_city');
        $add_abadi  = get_post('add_abadi');
        $id_ostan   = get_post('id_ostan');
        $id_city    = get_post('id_city');
        $id_mar     = get_post('id_mar');
        $m_zamin    = get_post('m_zamin');
        $no_mal     = get_post('no_mal');
        $lng        = get_post('lng');
        $lat        = get_post('lat');
        $sh_gat     = get_post('sh_gat');
        $m_cod_m    = get_post('m_cod_m');
        
        if ($no_mal !== '7') {
            $m_cod_m = $bah_cod_m;
        }

        $m_vaz_sok  = get_post('m_vaz_sok');
        $no_kesh    = get_post('no_kesh');
        $m_ab       = get_post('m_ab');
        $md_ab      = get_post('md_ab');
        $h_ab       = get_post('h_ab');
        $no_sab     = get_post('no_sab');
        $no_ab      = get_post('no_ab');
        $es         = get_post('es');
        $t_mah      = get_post('t_mah');
        $z_sal      = get_post('z_sal');
        $s_ayesh    = get_post('s_ayesh');

        // اعتبارسنجی نام جدول برای امنیت
        // فقط حروف، اعداد، خط تیره و زیرخط مجاز است
        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $z_sal)) {
            throw new Exception("سال زراعی نامعتبر است.");
        }

        $Agri_table      = 'Agri' . str_replace('-', '_', $z_sal);
        $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

        // منطق دیم (اگر نوع کشت دیم باشد، اطلاعات آب صفر می‌شود)
        if ($no_kesh == '2') {
            $m_ab = '';
            $md_ab = 0;
            $h_ab = 0;
            $no_sab = '';
            $no_ab = '';
            $es = '';
        }

        // اطلاعات مالک برای ثبت در جدول malek
        $m_jens      = get_post('m_jens');
        $m_name      = get_post('m_name');
        $m_last_name = get_post('m_last_name');
        $m_fname     = get_post('m_fname');
        $m_tel_m     = get_post('m_tel_m');

        // آپدیت جدول محصولات (Agri_prod)
        $query1 = "UPDATE `$Agri_prod_table` SET date_s=?, z_sal=?, num_bah=?, add_abadi=?, add_city=?, no_kesh=? WHERE bah_cod_m=? AND Agri_id=?";
        $q1 = $dbh->prepare($query1);
        $q1->execute(array($date_s, $z_sal, $num_bah, $add_abadi, $add_city, $no_kesh, $bah_cod_m, $id));

        // آپدیت جدول زمین (Agri)
        $query2 = "UPDATE `$Agri_table` SET 
                   date_s=?, num_bah=?, add_abadi=?, add_city=?, m_zamin=?, no_mal=?, lng=?, lat=?, m_cod_m=?, 
                   m_vaz_sok=?, no_kesh=?, m_ab=?, md_ab=?, h_ab=?, no_sab=?, no_ab=?, es=?, z_sal=?, s_ayesh=? 
                   WHERE bah_cod_m=? AND id=?";
        $q2 = $dbh->prepare($query2);
        $q2->execute(array(
            $date_s, $num_bah, $add_abadi, $add_city, $m_zamin, $no_mal, $lng, $lat, $m_cod_m, 
            $m_vaz_sok, $no_kesh, $m_ab, $md_ab, $h_ab, $no_sab, $no_ab, $es, $z_sal, $s_ayesh, 
            $bah_cod_m, $id
        ));

        // درج یا آپدیت اطلاعات مالک (malek)
        $query3 = "INSERT IGNORE INTO malek (date_s, mor_cod_m, m_cod_m, m_jens, m_name, m_last_name, m_fname, m_tel_m) 
                   VALUES (:date_s, :mor_cod_m, :m_cod_m, :m_jens, :m_name, :m_last_name, :m_fname, :m_tel_m)";
        $q3 = $dbh->prepare($query3);
        $q3->execute(array(
            ':date_s' => $date_s,
            ':mor_cod_m' => $mor_cod_m,
            ':m_cod_m' => $m_cod_m,
            ':m_jens' => $m_jens,
            ':m_name' => $m_name,
            ':m_last_name' => $m_last_name,
            ':m_fname' => $m_fname,
            ':m_tel_m' => $m_tel_m
        ));

        // ثبت وقایع
        sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'تصحیح زمین زراعی/' . $sh_gat . '/' . $bah_cod_m, $id_ostan);

        // پایان تراکنش
        $dbh->commit();
        $com_alert = 'اطلاعات زمین زراعی با موفقیت تصحیح شد';

    } catch (Exception $e) {
        $dbh->rollBack();
        $com_alert = 'خطا در ثبت اطلاعات: ' . $e->getMessage();
    }
    ?>
    <form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo h($id_page) . '#1'; ?>">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="back_p" value="1" />
        <input type="hidden" name="com_alert" value="<?php echo h($com_alert); ?>" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit();
}

// ------------------------------------------------------------------
// بخش 3: نمایش فرم ویرایش
// ------------------------------------------------------------------
if (isset($_POST['bah_cod_m'])) {
    
    // دریافت اطلاعات اولیه برای نمایش
    $date_s = date_con(jdate("Y/m/d"));
    $id_page    = get_post('id_page');
    $add_abadi  = get_post('add_abadi');
    $add_city   = get_post('add_city');
    $bah_cod_m  = get_post('bah_cod_m');
    $num_bah    = get_post('num_bah', '1');
    $m_poul     = get_post('m_poul');
    $sh_gat     = get_post('sh_gat');
    $z_sal      = get_post('z_sal');
    $z_sal_old  = get_post('z_sal_old');
    $t_mah      = get_post('t_mah');
    $no_mal     = get_post('no_mal');
    $no_kesh    = get_post('no_kesh');
    $id         = get_post('id');

    // امنیت نام جدول
    if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $z_sal)) { die("خطای امنیتی در سال زراعی"); }
    $Agri_table      = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    // بررسی کشت قراردادی (جلوگیری از تغییر نوع کشت اگر محصول قراردادی باشد)
    $error = 0;
    $query_check = "SELECT id, no_kesh FROM `$Agri_prod_table` WHERE Agri_id = :id";
    $stmt_check = $dbh->prepare($query_check);
    $stmt_check->execute(array(':id' => $id));
    
    // استفاده از fetchAll برای سازگاری بهتر
    $rows_prod = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
    $current_no_kesh_db = ''; 

    foreach ($rows_prod as $row_p) {
        $prod_id = $row_p['id'];
        $current_no_kesh_db = $row_p['no_kesh']; // ذخیره نوع کشت فعلی در دیتابیس
        if (check_id($prod_id) == 2) {
            $error = 1;
        }
    }

    if ($error == 1 && $current_no_kesh_db != $no_kesh) {
        ?>
        <form name="myform" class="myform" method="post" action="liste_Agri.php#1">
             <input type="hidden" name="bah_cod_m" value="" />
             <input type="hidden" name="action_lise" value="1" />
             <input type="hidden" name="back_p" value="1" />
             <input type="hidden" name="com_alert" value="حداقل یکی از محصولات این قطعه شامل کشت قراردادی میباشد، تغییر نوع کشت مقدور نیست">
        </form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit();
    }

    // دریافت اطلاعات زمین
    $query = "SELECT * FROM `$Agri_table` WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) { die("اطلاعات زمین یافت نشد."); }

    // استخراج متغیرها از دیتابیس
    $lng = $row['lng'];
    $lat = $row['lat'];
    $m_zamin = $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'];
    $m_ab = $row['m_ab'];
    $md_ab = $row['md_ab'];
    $h_ab = $row['h_ab'];
    $no_sab = $row['no_sab'];
    $no_ab = $row['no_ab'];
    $es = $row['es'];
    $s_ayesh = $row['s_ayesh'];
    $m_vaz_sok = $row['m_vaz_sok'];
    $check_cod = $row['check_cod'];
    $docId = $row['docId'];
    $num_bah = $row['num_bah'];

    // دریافت اطلاعات بهره‌بردار یا مالک
    if ($no_mal != 7) {
        // اگر اجاره نباشد، از جدول بهره برداران
        $query = "SELECT no_bah, co_name, name, jens, last_name, fname, tel_m FROM bah WHERE bah_cod_m = :bah_cod_m AND num_bah = :num_bah";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
        $row_b = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $no_bah = isset($row_b['no_bah']) ? $row_b['no_bah'] : '';
        $co_name = isset($row_b['co_name']) ? $row_b['co_name'] : '';
        $m_name = isset($row_b['name']) ? $row_b['name'] : '';
        $m_jens = isset($row_b['jens']) ? $row_b['jens'] : '';
        $m_last_name = isset($row_b['last_name']) ? $row_b['last_name'] : '';
        $m_fname = isset($row_b['fname']) ? $row_b['fname'] : '';
        $m_tel_m = isset($row_b['tel_m']) ? $row_b['tel_m'] : '';
    } else {
        // اگر اجاره باشد، ابتدا نوع بهره بردار را می گیریم
        $query = "SELECT no_bah FROM bah WHERE bah_cod_m = :bah_cod_m AND num_bah = :num_bah";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
        $row_b = $stmt->fetch(PDO::FETCH_ASSOC);
        $no_bah = isset($row_b['no_bah']) ? $row_b['no_bah'] : '';

        // سپس اطلاعات مالک را از جدول malek
        $query = "SELECT m_name, m_jens, m_last_name, m_fname, m_tel_m FROM malek WHERE m_cod_m = :m_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':m_cod_m' => $m_cod_m));
        $row_m = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $m_name = isset($row_m['m_name']) ? $row_m['m_name'] : '';
        $m_jens = isset($row_m['m_jens']) ? $row_m['m_jens'] : '';
        $m_last_name = isset($row_m['m_last_name']) ? $row_m['m_last_name'] : '';
        $m_fname = isset($row_m['m_fname']) ? $row_m['m_fname'] : '';
        $m_tel_m = isset($row_m['m_tel_m']) ? $row_m['m_tel_m'] : '';
    }

    // مقادیر نمایشی
    $v_no_kesh = ($no_kesh == '1') ? 'آبی' : (($no_kesh == '2') ? 'دیم' : '');
    if ($no_mal != '7') $m_cod_m = $bah_cod_m;

    $malek_types = array(
        '1' => 'سند ششدانگ', '2' => 'سند مشاعی', '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه', '5' => 'واگذاری', '6' => 'قولنامه', '7' => 'اجاره', '8' => 'سایر'
    );
    $v_no_mal = isset($malek_types[$no_mal]) ? $malek_types[$no_mal] : '';

    // محاسبه سطح کشت
    $query = "SELECT sum(zer_kesht_a) as z_kesht1, sum(zer_kesht_b) as z_kesht2 FROM `$Agri_prod_table` WHERE Agri_id = :Agri_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':Agri_id' => $id));
    $row_sum = $stmt->fetch(PDO::FETCH_ASSOC);
    $z_kesht1 = $row_sum['z_kesht1'];
    $z_kesht2 = $row_sum['z_kesht2'];

    // مدیریت شهر/آبادی
    if ($m_poul == 'abadi') {
        $query = "SELECT add_abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = :add_abadi";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi' => $add_abadi));
        $row_loc = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row_loc) {
            $add_abadi = $row_loc["add_abadi"];
            $add_city = '-';
            $id_ostan = $row_loc["id_ostan"];
            $id_city = $row_loc["id_city"];
            $id_mar = $row_loc["id_mar"];
        }
    } elseif ($m_poul == 'shahr') {
        $query = "SELECT add_city, id_ostan, id_city, id_mar FROM list_city WHERE add_city = :add_city";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city' => $add_city));
        $row_loc = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row_loc) {
            $add_city = $row_loc["add_city"];
            $add_abadi = '-';
            $id_ostan = $row_loc["id_ostan"];
            $id_city = $row_loc["id_city"];
            $id_mar = $row_loc["id_mar"];
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo isset($title) ? h($title) : ''; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .style10 { color: #FF0000; }
        .style11 { font-size: 14px; }
        .size:hover { width: 20px; height: 19px; }
    </style>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });

        $(document).ready(function() {
            $(".Mcod_m").change(function() {
                var id = $(this).val();
                var dataString = 'cod_m=' + id;
                $.ajax({
                    type: "POST",
                    url: "select_mar.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
    </script>
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
            <?php include('top.php'); ?>
            <p class="style8">ویرایش اطلاعات زمین زراعی</p>
            <p>
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt="" /><br />
                <?php sar_data2($bah_cod_m, $num_bah); ?>
            </p>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                    <td width="840">
                        <form action="" method="post" id="form1" name="form1">
                            <table width="99%" height="409" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
                                <!-- موقعیت بهره برداری -->
                                <tr>
                                    <td height="40" colspan="5" bgcolor="#CCCCCC" align="right"><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="31%" height="40"><div align="right"><?php echo city_name1($id_city, $id_ostan); ?></div></td>
                                    <td width="20%"><div align="right">:شهرستان</div></td>
                                    <td width="8%">&nbsp;</td>
                                    <td width="23%"><div align="right"><?php echo ostan_name($id_ostan); ?></div></td>
                                    <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
                                </tr>
                                <tr>
                                    <td height="38"><div align="right"><?php echo abadi_name($add_abadi) . '' . shahr_name($add_city); ?></div></td>
                                    <td><div align="right">: آبادی / شهر</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><?php echo mar_name($id_mar); ?></div></td>
                                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                                </tr>
                                <!-- اطلاعات زمین -->
                                <tr>
                                    <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
                                </tr>
                                <tr>
                                    <td height="38"><div align="right"><?php echo h($v_no_mal); ?></div></td>
                                    <td><div align="right">:نوع مالکیت</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><?php echo h($v_no_kesh); ?></div></td>
                                    <td><div style="margin-right:30px" align="right">:نوع کشت</div></td>
                                </tr>
                                <tr>
                                    <td height="63">
                                        <div align="right">
                                            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px;" tabindex="2" dir="rtl" lang="fa" value="<?php echo h($lat); ?>" maxlength="11" />
                                            <br /><span class="style8">37.010521: مثال</span>
                                        </div>
                                    </td>
                                    <td><div align="right">:Y عرض جغرافیایی</div></td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div align="right">
                                            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px;" tabindex="1" dir="rtl" lang="fa" value="<?php echo h($lng); ?>" maxlength="11" />
                                            <br /><span class="style8">46.212486: مثال</span>
                                        </div>
                                    </td>
                                    <td><div style="margin-right:30px" align="right">:X طول جغرافیایی</div></td>
                                </tr>
                                <tr>
                                    <td height="49" colspan="5">
                                        <table width="75%" border="0" align="center" cellspacing="0">
                                            <tr>
                                                <td width="19%" bgcolor="#66CCFF">
                                                    <div align="right"><span class="style2">هکتار</span>
                                                        <input name="m_zamin2" type="text" class="m_zamin input_text number required" id="m_zamin2" style="width:80px; height:30px;" dir="rtl" lang="fa" value="<?php echo h($z_kesht2 * 1); ?>" maxlength="15" readonly />
                                                    </div>
                                                </td>
                                                <td width="17%" bgcolor="#66CCFF"> : مجموع مساحت کشت دوم</td>
                                                <td width="21%" bgcolor="#66FF66">
                                                    <div align="right"><span class="style2">هکتار</span>
                                                        <input name="m_zamin1" type="text" class="m_zamin input_text number required" id="m_zamin1" style="width:80px; height:30px;" dir="rtl" lang="fa" value="<?php echo h($z_kesht1 * 1); ?>" maxlength="15" readonly />
                                                    </div>
                                                </td>
                                                <td width="17%" bgcolor="#66FF66"> : مجموع مساحت کشت اول</td>
                                                <td width="26%" bgcolor="#CCCCCC" class="style19">: اطلاعات کشت موجود</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="49" colspan="3"></td>
                                    <td>
                                        <div align="right"><span class="style2">هکتار</span>
                                            <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px;" tabindex="3" dir="rtl" lang="fa" value="<?php echo h($m_zamin); ?>" maxlength="11" />
                                        </div>
                                    </td>
                                    <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
                                </tr>
                                <tr>
                                    <td height="5" colspan="5">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="42" colspan="5" bgcolor="#CCCCCC">
                                                    <?php if ($no_mal != 7) echo '<p align="center" style="color:#0066CC">اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد</p>'; else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="31%" height="58">
                                                    <div align="right">
                                                        <select name="m_jens" class="input_text mar required" id="m_jens" style="height:40px; width:120px; direction:rtl" tabindex="6">
                                                            <option value="1" <?php if ($m_jens == '1') echo 'selected="selected"'; ?>>مرد</option>
                                                            <option value="2" <?php if ($m_jens == '2') echo 'selected="selected"'; ?>>زن</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td width="20%"><div align="right">جنسیت</div></td>
                                                <td width="1%" bgcolor="#FFFFFF">&nbsp;</td>
                                                <td width="30%" bgcolor="#FFFFFF">
                                                    <div align="right">
                                                        <input name="m_cod_m" type="text" class="input_text required Mcod_m" id="m_cod_m" style="width:150px; height:30px; <?php if ($no_mal != 7) echo 'background-color:#FFFFCC" readonly="readonly" '; ?>" tabindex="5" dir="rtl" lang="fa" value="<?php echo h($m_cod_m); ?>" maxlength="11" />
                                                    </div>
                                                </td>
                                                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک</div></td>
                                            </tr>
                                            <tr>
                                                <td height="46" bgcolor="#FFFFFF">
                                                    <div align="right">
                                                        <input name="m_last_name" type="text" class="input_text required" id="m_last_name" style="width:150px; height:30px; <?php if ($no_mal != 7) echo 'background-color:#FFFFCC" readonly="readonly" '; ?>" tabindex="8" dir="rtl" lang="fa" value="<?php echo h($m_last_name); ?>" maxlength="70" />
                                                    </div>
                                                </td>
                                                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی</div></td>
                                                <td bgcolor="#FFFFFF">&nbsp;</td>
                                                <td bgcolor="#FFFFFF">
                                                    <div align="right">
                                                        <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px; <?php if ($no_mal != 7) echo 'background-color:#FFFFCC" readonly="readonly" '; ?>" tabindex="7" dir="rtl" lang="fa" value="<?php echo h($m_name); ?>" maxlength="70" />
                                                    </div>
                                                </td>
                                                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                                            </tr>
                                            <tr>
                                                <td height="51">
                                                    <div align="right">
                                                        <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px; <?php if ($no_mal != 7) echo 'background-color:#FFFFCC" readonly="readonly" '; ?>" tabindex="10" dir="rtl" lang="fa" value="<?php echo h($m_tel_m); ?>" maxlength="11" />
                                                    </div>
                                                </td>
                                                <td><div align="right">:تلفن همراه</div></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div align="right">
                                                        <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px; <?php if ($no_mal != 7) echo 'background-color:#FFFFCC" readonly="readonly" '; ?>" tabindex="9" dir="rtl" lang="fa" value="<?php echo ($no_bah == 2) ? h($co_name) : h($m_fname); ?>" maxlength="75" />
                                                    </div>
                                                </td>
                                                <td><div style="margin-right:30px" align="right"><?php if ($no_bah == 2) echo ':نام شرکت'; else echo ':نام پدر'; ?></div></td>
                                            </tr>
                                            <tr>
                                                <td height="60">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div align="right">
                                                        <select name="m_vaz_sok" class="required input_text" id="m_vaz_sok" style="height:40px; width:120px; direction:rtl" tabindex="12">
                                                            <option value="">انتخاب کنید</option>
                                                            <option value="1" <?php if ($m_vaz_sok == '1') echo 'selected="selected"'; ?>>ساکن</option>
                                                            <option value="2" <?php if ($m_vaz_sok == '2') echo 'selected="selected"'; ?>>غیرساکن</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td><div style="margin-right:30px" align="right"><p>:وضعیت سکونت مالک</p></div></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- اطلاعات آب -->
                                <tr>
                                    <td height="9" colspan="5" bgcolor="#FFFFFF">
                                        <?php if ($no_kesh == '1') { ?>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات آب</strong></div></td>
                                                </tr>
                                                <tr>
                                                    <td width="31%" height="53">
                                                        <div align="right">
                                                            <span class="style2">شبانه روز</span>
                                                            <input name="md_ab" type="text" class="required number input_text" id="md_ab" style="width:50px; height:30px;" tabindex="15" dir="rtl" lang="fa" value="<?php echo h($md_ab); ?>" maxlength="2" />
                                                        </div>
                                                    </td>
                                                    <td width="20%"><div align="right">:مدار آبیاری</div></td>
                                                    <td width="1%">&nbsp;</td>
                                                    <td width="30%" bgcolor="#FFFFFF">
                                                        <div align="right">
                                                            <select name="m_ab" class="input_text required" id="m_ab" style="height:40px; width:120px; direction:rtl" tabindex="14">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="1" <?php if ($m_ab == '1') echo 'selected="selected"'; ?>>چشمه</option>
                                                                <option value="2" <?php if ($m_ab == '2') echo 'selected="selected"'; ?>>قنات</option>
                                                                <option value="3" <?php if ($m_ab == '3') echo 'selected="selected"'; ?>>رودخانه</option>
                                                                <option value="4" <?php if ($m_ab == '4') echo 'selected="selected"'; ?>>سد</option>
                                                                <option value="5" <?php if ($m_ab == '5') echo 'selected="selected"'; ?>>چاه سطحی</option>
                                                                <option value="6" <?php if ($m_ab == '6') echo 'selected="selected"'; ?>>چاه عمیق</option>
                                                                <option value="7" <?php if ($m_ab == '7') echo 'selected="selected"'; ?>>چاه نیمه عمیق</option>
                                                                <option value="8" <?php if ($m_ab == '8') echo 'selected="selected"'; ?>>زهکش</option>
                                                                <option value="9" <?php if ($m_ab == '9') echo 'selected="selected"'; ?>>پساب</option>
                                                                <option value="10" <?php if ($m_ab == '10') echo 'selected="selected"'; ?>>آب بندان</option>
                                                                <option value="11" <?php if ($m_ab == '11') echo 'selected="selected"'; ?>>سایر</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
                                                </tr>
                                                <tr>
                                                    <td height="47">
                                                        <div align="right">
                                                            <select name="no_sab" class="input_text required" id="no_sab" style="height:40px; width:170px; direction:rtl" tabindex="17">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="1" <?php if ($no_sab == '1') echo 'selected="selected"'; ?>>پروانه بهره برداری</option>
                                                                <option value="2" <?php if ($no_sab == '2') echo 'selected="selected"'; ?>>مجوز آب</option>
                                                                <option value="3" <?php if ($no_sab == '3') echo 'selected="selected"'; ?>>عرفی</option>
                                                                <option value="4" <?php if ($no_sab == '4') echo 'selected="selected"'; ?>>سایر</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><div align="right">:نوع سند حقابه</div></td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <div align="right"><span class="style2">ساعت</span>
                                                            <input name="h_ab" type="text" class="input_text required number" id="h_ab" style="width:100px; height:30px;" tabindex="16" dir="rtl" lang="fa" value="<?php echo h($h_ab); ?>" maxlength="5" />
                                                        </div>
                                                    </td>
                                                    <td><div style="margin-right:30px" align="right">:حقابه</div></td>
                                                </tr>
                                                <tr>
                                                    <td height="52">
                                                        <div align="right">
                                                            <select name="es" class="input_text required" id="es" style="height:40px; width:170px; direction:rtl" tabindex="19">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="1" <?php if ($es == '1') echo 'selected="selected"'; ?>>ندارد</option>
                                                                <option value="2" <?php if ($es == '2') echo 'selected="selected"'; ?>>دارد / جهت ذخیره آب</option>
                                                                <option value="3" <?php if ($es == '3') echo 'selected="selected"'; ?>>دارد - دو منظوره</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><div align="right">:وضعیت استخر</div></td>
                                                    <td>&nbsp;</td>
                                                    <td bgcolor="#FFFFFF">
                                                        <div align="right">
                                                            <select name="no_ab" class="input_text required" id="no_ab" style="height:40px; width:120px; direction:rtl" tabindex="18">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="1" <?php if ($no_ab == '1') echo 'selected="selected"'; ?>>جوی و پشته</option>
                                                                <option value="2" <?php if ($no_ab == '2') echo 'selected="selected"'; ?>>نواری</option>
                                                                <option value="3" <?php if ($no_ab == '3') echo 'selected="selected"'; ?>>غرقابی</option>
                                                                <option value="4" <?php if ($no_ab == '4') echo 'selected="selected"'; ?>>تشتکی</option>
                                                                <option value="5" <?php if ($no_ab == '5') echo 'selected="selected"'; ?>>تحت فشار قطره ای</option>
                                                                <option value="6" <?php if ($no_ab == '6') echo 'selected="selected"'; ?>>تحت فشار بارانی</option>
                                                                <option value="7" <?php if ($no_ab == '7') echo 'selected="selected"'; ?>>سایر</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نحوه آبیاری</div></td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                        <br /><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td height="40">
                                        <div align="right"><span class="style2">هکتار</span>
                                            <input name="s_ayesh" type="text" class="s_ayesh input_text required number" id="s_ayesh" style="width:100px; height:30px;" tabindex="31" dir="rtl" lang="fa" value="<?php echo h($s_ayesh * 1); ?>" maxlength="10" />
                                        </div>
                                    </td>
                                    <td><div align="right">: سطح آیش</div></td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div align="right">
                                            <input name="z_sal" readonly type="text" class="z_sal input_text required" id="z_sal" style="width:100px; height:30px;" tabindex="20" dir="rtl" lang="fa" value="<?php echo h($z_sal); ?>" maxlength="10" />
                                        </div>
                                    </td>
                                    <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
                                </tr>
                            </table>
                            <div align="center">
                                <p>
                                    <input type="hidden" name="id" value="<?php echo h($id); ?>" />
                                    <input type="hidden" name="z_sal_old" value="<?php echo h($z_sal_old); ?>" />
                                    <input type="hidden" name="sh_gat" value="<?php echo h($sh_gat); ?>" />
                                    <input type="hidden" name="bah_cod_m" value="<?php echo h($bah_cod_m); ?>" />
                                    <input type="hidden" name="num_bah" value="<?php echo h($num_bah); ?>" />
                                    <input type="hidden" name="id_ostan" value="<?php echo h($id_ostan); ?>" />
                                    <input type="hidden" name="id_city" value="<?php echo h($id_city); ?>" />
                                    <input type="hidden" name="add_abadi" value="<?php echo h($add_abadi); ?>" />
                                    <input type="hidden" name="add_city" value="<?php echo h($add_city); ?>" />
                                    <input type="hidden" name="id_mar" value="<?php echo h($id_mar); ?>" />
                                    <input type="hidden" name="t_mah" value="<?php echo h($t_mah); ?>" />
                                    <input type="hidden" name="no_kesh" value="<?php echo h($no_kesh); ?>" />
                                    <input type="hidden" name="no_mal" value="<?php echo h($no_mal); ?>" />
                                    <input type="hidden" name="check_cod" value="<?php echo h($check_cod); ?>" />
                                    <input type="hidden" name="id_page" value="<?php echo h($id_page); ?>" />
                                    <input type="submit" name="cancel" value="انصراف" style="width:150px; height:45px" tabindex="30" id="btn1" />
                                    <input type="submit" name="action" value="تصحیح اطلاعات" id="submit" style="width:150px; height:45px" tabindex="32" />
                                </p>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
} else {
    ?>
    <form name="myform" class="myform" method="post" action="Agri1.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
?>
    <tr>
        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php') ?></td>
    </tr>
</table>
<script>
    window.addEventListener("load", function() {
        var form = document.getElementById("form1");
        if (form) {
            form.addEventListener("submit", function(event) {
                // اگر دکمه انصراف زده شده باشد، ولیدیشن را اجرا نکن
                // با توجه به اینکه دکمه انصراف name="cancel" دارد و در PHP هندل می‌شود،
                // اینجا فرض بر این است که دکمه اصلی سابمیت زده شده است.
                // برای تشخیص دقیق‌تر می‌توانید روی دکمه کلیک لیسنر بگذارید.
                
                var m_zamin = parseFloat(document.getElementById("m_zamin").value) || 0;
                var m_zamin1 = parseFloat(document.getElementById("m_zamin1").value) || 0;
                var m_zamin2 = parseFloat(document.getElementById("m_zamin2").value) || 0;
                var s_ayesh = parseFloat(document.getElementById("s_ayesh").value) || 0;

                var max_kesht = Math.max(m_zamin1, m_zamin2);
                var sum_kesht_ayesh = max_kesht + s_ayesh;

                if (m_zamin < sum_kesht_ayesh) {
                    alert("مساحت کل زمین نمی‌تواند کوچکتر از مجموع مساحت کشت شده و آیش یعنی " + sum_kesht_ayesh + " باشد.");
                    event.preventDefault();
                    return;
                }
                if (s_ayesh > m_zamin) {
                    alert("سطح آیش نمی‌تواند از مساحت کل زمین بزرگتر باشد.");
                    event.preventDefault();
                    return;
                }
            });
        }
    });

    $('.s_ayesh').keyup(function() {
        var ayesh = $(this).val();
        if (parseFloat(ayesh) < 0) {
            alert("خطا !! \n سطح آیش نمیتواند منفی باشد");
            $(this).val(0);
        }
    });
</script>
</body>
</html>
