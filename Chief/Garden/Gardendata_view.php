<?php
include('../../lock_ce.php');
include('../../event.php');
include('../../date_con.php');
include('../../login/config.php');
require_once('../../Jalali.php'); // اگر نیاز باشد

// ======================== توابع کمکی ========================
function agri_h($v) {
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_clean_code($v) {
    if (!isset($v)) return '';
    $v = trim($v);
    if ($v == '/' || $v == '\\') return '';
    return $v;
}

// ======================== دریافت داده ========================
if (!isset($_POST['id'])) {
    // اگر id ارسال نشده، به صفحه قبل برگردان
    header('Location: Garden.php');
    exit;
}

$id = $_POST['id'];

// دریافت اطلاعات اصلی باغ
$query = "SELECT * FROM Garden WHERE id = :id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id' => $id));
if ($stmt->rowCount() == 0) {
    // رکوردی یافت نشد
    header('Location: Garden.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// استخراج متغیرها
$add_abadi   = $row['add_abadi'];
$add_city    = $row['add_city'];
$bah_cod_m   = $row['bah_cod_m'];
$num_bah     = $row['num_bah'] ?: '1';
$m_poul      = $row['m_poul'];
$sh_gat      = $row['sh_gat'];
$z_sal       = $row['z_sal'];
$t_mah       = $row['t_mah'];
$no_mal      = $row['no_mal'];
$no_kesh     = $row['no_kesh'];
$nah_kesh    = $row['nah_kesh'];
$id_ostan    = $row['id_ostan'];
$id_mar      = $row['id_mar'];
$id_city     = $row['id_city'];
$lng         = $row['lng'];
$lat         = $row['lat'];
$m_zamin     = $row['m_zamin'];
$m_cod_m     = $row['m_cod_m'];
$m_ab        = $row['m_ab'];
$md_ab       = $row['md_ab'];
$h_ab        = $row['h_ab'];
$no_sab      = $row['no_sab'];
$no_ab       = $row['no_ab'];
$es          = $row['es'];
$m_vaz_sok   = $row['m_vaz_sok'];

// دریافت اطلاعات مالک
if ($no_mal != '7') {
    // مالک همان بهره‌بردار است
    $query = "SELECT name, jens, last_name, fname, tel_m FROM bah WHERE bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $malek_row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($malek_row) {
        $m_name      = $malek_row['name'];
        $m_jens      = $malek_row['jens'];
        $m_last_name = $malek_row['last_name'];
        $m_fname     = $malek_row['fname'];
        $m_tel_m     = $malek_row['tel_m'];
    } else {
        $m_name = $m_last_name = $m_fname = $m_tel_m = '';
        $m_jens = '1';
    }
    $m_cod_m = $bah_cod_m; // کد ملی مالک همان بهره‌بردار است
} else {
    // مالک از جدول malek
    $query = "SELECT m_name, m_jens, m_last_name, m_fname, m_tel_m, m_addres FROM malek WHERE m_cod_m = :m_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    $malek_row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($malek_row) {
        $m_name      = $malek_row['m_name'];
        $m_jens      = $malek_row['m_jens'];
        $m_last_name = $malek_row['m_last_name'];
        $m_fname     = $malek_row['m_fname'];
        $m_tel_m     = $malek_row['m_tel_m'];
        $m_addres    = $malek_row['m_addres'];
    } else {
        $m_name = $m_last_name = $m_fname = $m_tel_m = $m_addres = '';
        $m_jens = '1';
    }
}

// دریافت اطلاعات مکان (برای نمایش نام‌ها)
if ($m_poul == 'abadi') {
    $query = "SELECT add_abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = :add_abadi";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_abadi' => $add_abadi));
    $place = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($place) {
        $add_abadi_display = $place['add_abadi'];
        $add_city_display = '-';
        $id_ostan_display = $place['id_ostan'];
        $id_city_display  = $place['id_city'];
        $id_mar_display   = $place['id_mar'];
    }
} else { // shahr
    $query = "SELECT add_city, id_ostan, id_city, id_mar FROM list_city WHERE add_city = :add_city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_city' => $add_city));
    $place = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($place) {
        $add_city_display = $place['add_city'];
        $add_abadi_display = '-';
        $id_ostan_display = $place['id_ostan'];
        $id_city_display  = $place['id_city'];
        $id_mar_display   = $place['id_mar'];
    }
}
// اگر مکانی یافت نشد، از مقادیر موجود استفاده کن
if (!isset($add_abadi_display)) $add_abadi_display = $add_abadi;
if (!isset($add_city_display)) $add_city_display = $add_city;
if (!isset($id_ostan_display)) $id_ostan_display = $id_ostan;
if (!isset($id_city_display)) $id_city_display = $id_city;
if (!isset($id_mar_display)) $id_mar_display = $id_mar;

// تعیین برچسب‌های فارسی
$v_no_kesh = ($no_kesh == '1') ? 'آبی' : 'دیم';
$v_nah_kesh = '';
if ($nah_kesh == '1') $v_nah_kesh = 'ساده';
elseif ($nah_kesh == '2') $v_nah_kesh = 'مخلوط';
elseif ($nah_kesh == '3') $v_nah_kesh = 'درختان پراکنده';

$no_mal_labels = array(
    '1' => 'سند ششدانگ',
    '2' => 'سند مشاعی',
    '3' => 'اصلاحات اراضی',
    '4' => 'موقوفه',
    '5' => 'واگذاری',
    '6' => 'قولنامه',
    '7' => 'اجاره',
    '8' => 'سایر'
);
$v_no_mal = isset($no_mal_labels[$no_mal]) ? $no_mal_labels[$no_mal] : '';

// دریافت محصولات مرتبط
$products = array();
$query = "SELECT * FROM Garden_prod WHERE Garden_id = :Garden_id ORDER BY id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Garden_id' => $id));
while ($prod = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $prod;
}

// ======================== شروع خروجی HTML ========================
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo agri_h(isset($title) ? $title : 'مشاهده اطلاعات باغی'); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style>
        /* استایل‌های اختصاصی این صفحه – مشابه Agri1.php */
        .agri-page { font-family: Tahoma, "IranSans", sans-serif; direction: rtl; text-align: right; color: #1f2937; }
        .agri-wrap { max-width: 1000px; margin: 0 auto 20px; padding: 0 12px; }
        .agri-title { font-size: 18px; font-weight: bold; color: #111827; margin: 8px 0 6px; text-align: center; }
        .agri-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 14px 16px 8px; margin-bottom: 14px; }
        .agri-card h3 { margin: 0 0 12px; padding-bottom: 8px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #374151; }
        .agri-grid { width: 100%; overflow: hidden; }
        .agri-field { float: right; width: 48%; margin: 0 1% 14px 0; }
        .agri-field-wide { width: 98%; }
        .agri-field label { display: block; margin-bottom: 6px; font-size: 13px; color: #4b5563; }
        .agri-info { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; min-height: 22px; font-size: 13px; }
        .agri-info-readonly { background: #fffbeb; }
        .agri-table-wrap { overflow-x: auto; }
        .agri-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .agri-table th { background: #f3f4f6; padding: 8px 6px; border: 1px solid #d1d5db; text-align: center; }
        .agri-table td { padding: 6px; border: 1px solid #d1d5db; text-align: center; }
        .agri-table .highlight { background: #fffbeb; }
        .agri-actions { text-align: center; padding: 12px 0 20px; clear: both; }
        .agri-btn {
            height: 44px; min-width: 150px; padding: 0 18px; margin: 4px; border: 0; border-radius: 6px;
            font-family: Tahoma, sans-serif; font-size: 14px; cursor: pointer;
        }
        .agri-btn-gray { background: #6b7280; color: #fff; }
        .agri-btn:hover { filter: brightness(0.95); }
        @media screen and (max-width: 700px) {
            .agri-field { float: none; width: 100%; margin: 0 0 14px 0; }
        }
    </style>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script>
        function close_window() { window.close(); }
    </script>
</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr><td><img src="../../files/images/header.jpg" width="100%" height="100" alt=""/></td></tr>
    <tr><td dir="ltr"><?php include('menu.php'); ?></td></tr>
    <tr><td>
        <?php include('top.php'); ?>
        <div class="agri-page">
            <div class="agri-wrap">
                <div class="agri-title">مشاهده اطلاعات باغی و قلمستان</div>

                <?php sar_data2($bah_cod_m, $num_bah); ?>

                <!-- فرم با فیلدهای غیرفعال جهت نمایش -->
                <form method="post" id="form1">
                    <!-- موقعیت -->
                    <div class="agri-card">
                        <h3>موقعیت بهره برداری</h3>
                        <div class="agri-grid">
                            <div class="agri-field"><label>استان</label><div class="agri-info"><?php echo agri_h(ostan_name($id_ostan_display)); ?></div></div>
                            <div class="agri-field"><label>شهرستان</label><div class="agri-info"><?php echo agri_h(city_name1($id_city_display, $id_ostan_display)); ?></div></div>
                            <div class="agri-field"><label>مرکز جهاد کشاورزی</label><div class="agri-info"><?php echo agri_h(mar_name($id_mar_display)); ?></div></div>
                            <div class="agri-field"><label>آبادی / شهر</label><div class="agri-info"><?php echo agri_h(abadi_name($add_abadi_display)); ?></div></div>
                        </div>
                    </div>

                    <!-- اطلاعات کلی -->
                    <div class="agri-card">
                        <h3>اطلاعات کلی</h3>
                        <div class="agri-grid">
                            <div class="agri-field"><label>نوع کشت</label><div class="agri-info"><?php echo agri_h($v_no_kesh); ?></div></div>
                            <div class="agri-field"><label>نوع مالکیت</label><div class="agri-info"><?php echo agri_h($v_no_mal); ?></div></div>
                            <div class="agri-field"><label>نحوه کشت</label><div class="agri-info"><?php echo agri_h($v_nah_kesh); ?></div></div>
                            <?php if ($nah_kesh != '3') { ?>
                            <div class="agri-field"><label>طول جغرافیایی X</label><div class="agri-info"><?php echo agri_h($lng); ?></div></div>
                            <div class="agri-field"><label>عرض جغرافیایی Y</label><div class="agri-info"><?php echo agri_h($lat); ?></div></div>
                            <div class="agri-field"><label>مساحت زمین (هکتار)</label><div class="agri-info"><?php echo agri_h($m_zamin); ?></div></div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- اطلاعات مالک -->
                    <div class="agri-card">
                        <h3>اطلاعات مالک</h3>
                        <?php if ($no_mal != '7') { ?>
                            <div class="agri-info" style="background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8; padding:8px; margin-bottom:12px; text-align:center;">
                                اطلاعات بهره بردار بعنوان مالک ثبت گردیده است
                            </div>
                        <?php } ?>
                        <div class="agri-grid">
                            <div class="agri-field"><label>کد ملی مالک</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_cod_m); ?></div></div>
                            <div class="agri-field"><label>جنسیت</label><div class="agri-info agri-info-readonly"><?php echo ($m_jens == '1') ? 'مرد' : 'زن'; ?></div></div>
                            <div class="agri-field"><label>نام</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_name); ?></div></div>
                            <div class="agri-field"><label>نام خانوادگی</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_last_name); ?></div></div>
                            <div class="agri-field"><label>نام پدر</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_fname); ?></div></div>
                            <div class="agri-field"><label>تلفن همراه</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_tel_m); ?></div></div>
                            <div class="agri-field"><label>وضعیت سکونت</label><div class="agri-info agri-info-readonly"><?php echo ($m_vaz_sok == '1') ? 'ساکن' : (($m_vaz_sok == '2') ? 'غیرساکن' : ''); ?></div></div>
                            <?php if ($no_mal == '7') { ?>
                            <div class="agri-field agri-field-wide"><label>آدرس محل سکونت</label><div class="agri-info agri-info-readonly"><?php echo agri_h($m_addres); ?></div></div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- اطلاعات آب (در صورت آبی) -->
                    <?php if ($no_kesh == '1') { ?>
                    <div class="agri-card">
                        <h3>اطلاعات آب</h3>
                        <div class="agri-grid">
                            <div class="agri-field"><label>منبع آب</label><div class="agri-info agri-info-readonly">
                                <?php
                                $ab_sources = array(
                                    1 => 'چشمه', 2 => 'قنات', 3 => 'رودخانه', 4 => 'سد',
                                    5 => 'چاه سطحی', 6 => 'چاه عمیق', 7 => 'چاه نیمه عمیق',
                                    8 => 'زهکش', 9 => 'پساب', 10 => 'آب بندان', 11 => 'سایر'
                                );
                                echo agri_h(isset($ab_sources[$m_ab]) ? $ab_sources[$m_ab] : '');
                                ?>
                            </div></div>
                            <div class="agri-field"><label>مدار آبیاری (شبانه روز)</label><div class="agri-info agri-info-readonly"><?php echo agri_h($md_ab); ?></div></div>
                            <div class="agri-field"><label>حقابه (ساعت)</label><div class="agri-info agri-info-readonly"><?php echo agri_h($h_ab); ?></div></div>
                            <div class="agri-field"><label>نوع سند حقابه</label><div class="agri-info agri-info-readonly">
                                <?php
                                $sab_types = array(1 => 'پروانه بهره برداری', 2 => 'مجوز آب', 3 => 'عرفی', 4 => 'سایر');
                                echo agri_h(isset($sab_types[$no_sab]) ? $sab_types[$no_sab] : '');
                                ?>
                            </div></div>
                            <div class="agri-field"><label>نحوه آبیاری</label><div class="agri-info agri-info-readonly">
                                <?php
                                $ab_types = array(1 => 'جوی و پشته', 2 => 'نواری', 3 => 'غرقابی', 4 => 'تشتکی',
                                    5 => 'تحت فشار قطره ای', 6 => 'تحت فشار بارانی', 7 => 'سایر');
                                echo agri_h(isset($ab_types[$no_ab]) ? $ab_types[$no_ab] : '');
                                ?>
                            </div></div>
                            <div class="agri-field"><label>وضعیت استخر</label><div class="agri-info agri-info-readonly">
                                <?php
                                $es_types = array(1 => 'ندارد', 2 => 'دارد / جهت ذخیره آب', 3 => 'دارد - دو منظوره');
                                echo agri_h(isset($es_types[$es]) ? $es_types[$es] : '');
                                ?>
                            </div></div>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- اطلاعات کاشت و محصولات -->
                    <div class="agri-card">
                        <h3>اطلاعات کاشت</h3>
                        <div class="agri-grid">
                            <div class="agri-field"><label>سال زراعی</label><div class="agri-info agri-info-readonly"><?php echo agri_h($z_sal); ?></div></div>
                        </div>
                        <?php if (!empty($products)) { ?>
                        <div class="agri-table-wrap">
                            <table class="agri-table">
                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>گروه محصول</th>
                                        <th>نام محصول</th>
                                        <?php if ($nah_kesh != '3') { ?>
                                        <th>سطح کاشت بارور (هکتار)</th>
                                        <th>سطح کاشت غیربارور (هکتار)</th>
                                        <?php } ?>
                                        <th>تعداد درخت بارور</th>
                                        <th>تعداد درخت غیربارور</th>
                                        <th>تولید قطعی (تن)</th>
                                        <th>تولید پیش‌بینی (تن)</th>
                                        <th>محصول بیمه شده</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row_num = 1;
                                    foreach ($products as $prod) {
                                        $group_cod = $prod['cod_qroup'];
                                        $cod_mah   = $prod['cod_mah'];
                                        // دریافت نام گروه و محصول (با کوئری جداگانه، اما برای سادگی از جداول product_b استفاده می‌کنیم)
                                        $qg = $dbh->prepare("SELECT group_name FROM product_b WHERE group_cod = :group_cod LIMIT 1");
                                        $qg->execute(array(':group_cod' => $group_cod));
                                        $grow = $qg->fetch(PDO::FETCH_ASSOC);
                                        $group_name = $grow ? $grow['group_name'] : $group_cod;

                                        $qp = $dbh->prepare("SELECT product_name FROM product_b WHERE product_cod = :product_cod LIMIT 1");
                                        $qp->execute(array(':product_cod' => $cod_mah));
                                        $prow = $qp->fetch(PDO::FETCH_ASSOC);
                                        $product_name = $prow ? $prow['product_name'] : $cod_mah;

                                        $bem = $prod['mah_bem'] == '1' ? 'بلی' : 'خیر';
                                    ?>
                                    <tr>
                                        <td><?php echo $row_num++; ?></td>
                                        <td><?php echo agri_h($group_name); ?></td>
                                        <td><?php echo agri_h($product_name); ?></td>
                                        <?php if ($nah_kesh != '3') { ?>
                                        <td><?php echo agri_h($prod['s_kesht_gb']); ?></td>
                                        <td><?php echo agri_h($prod['s_kesht_b']); ?></td>
                                        <?php } ?>
                                        <td><?php echo agri_h($prod['tree_gb']); ?></td>
                                        <td><?php echo agri_h($prod['tree_b']); ?></td>
                                        <td><?php echo agri_h($prod['mah_tol']); ?></td>
                                        <td><?php echo agri_h($prod['mah_tolp']); ?></td>
                                        <td><?php echo $bem; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($nah_kesh == '3') { ?>
                        <div style="font-size:12px; color:#6b7280; margin-top:8px;">
                            * تعداد درخت برای محصولات توت فرنگی، چای، زرشک، گل محمدی، گیاهان دارویی و گیاهان دائمی تزئینی تکمیل نمی‌گردد.
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="agri-info">هیچ محصولی برای این باغ ثبت نشده است.</div>
                        <?php } ?>
                    </div>

                    <!-- دکمه بستن -->
                    <div class="agri-actions">
                        <button type="button" class="agri-btn agri-btn-gray" onclick="close_window()">بستن پنجره</button>
                    </div>

                </form>
            </div>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr><td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td></tr>
        </table>
    </td></tr>
</table>

</body>
</html>