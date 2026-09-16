<?php
include('../../lock_ce.php');
include('../../event.php');
include('../../login/config.php');

// ======================== توابع کمکی ========================
function agri_h($v) {
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

// ======================== دریافت داده ========================
if (!isset($_POST['id'])) {
    header('Location: Garden.php');
    exit;
}

$id = $_POST['id'];

// دریافت اطلاعات اصلی باغ
$query = "SELECT * FROM Garden WHERE id = :id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id' => $id));
if ($stmt->rowCount() == 0) {
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
    $q = $dbh->prepare("SELECT name, jens, last_name, fname, tel_m FROM bah WHERE bah_cod_m = :bah_cod_m");
    $q->execute(array(':bah_cod_m' => $bah_cod_m));
    $malek = $q->fetch(PDO::FETCH_ASSOC);
    if ($malek) {
        $m_name      = $malek['name'];
        $m_jens      = $malek['jens'];
        $m_last_name = $malek['last_name'];
        $m_fname     = $malek['fname'];
        $m_tel_m     = $malek['tel_m'];
    } else {
        $m_name = $m_last_name = $m_fname = $m_tel_m = '';
        $m_jens = '1';
    }
    $m_cod_m = $bah_cod_m;
    $m_addres = ''; // برای مالک بهره‌بردار آدرس جداگانه نداریم
} else {
    $q = $dbh->prepare("SELECT m_name, m_jens, m_last_name, m_fname, m_tel_m, m_addres FROM malek WHERE m_cod_m = :m_cod_m");
    $q->execute(array(':m_cod_m' => $m_cod_m));
    $malek = $q->fetch(PDO::FETCH_ASSOC);
    if ($malek) {
        $m_name      = $malek['m_name'];
        $m_jens      = $malek['m_jens'];
        $m_last_name = $malek['m_last_name'];
        $m_fname     = $malek['m_fname'];
        $m_tel_m     = $malek['m_tel_m'];
        $m_addres    = $malek['m_addres'];
    } else {
        $m_name = $m_last_name = $m_fname = $m_tel_m = $m_addres = '';
        $m_jens = '1';
    }
}

// دریافت اطلاعات مکان برای نمایش نام‌ها
if ($m_poul == 'abadi') {
    $q = $dbh->prepare("SELECT add_abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = :add_abadi");
    $q->execute(array(':add_abadi' => $add_abadi));
    $place = $q->fetch(PDO::FETCH_ASSOC);
    if ($place) {
        $add_abadi_display = $place['add_abadi'];
        $add_city_display = '-';
        $id_ostan_display = $place['id_ostan'];
        $id_city_display  = $place['id_city'];
        $id_mar_display   = $place['id_mar'];
    }
} else {
    $q = $dbh->prepare("SELECT add_city, id_ostan, id_city, id_mar FROM list_city WHERE add_city = :add_city");
    $q->execute(array(':add_city' => $add_city));
    $place = $q->fetch(PDO::FETCH_ASSOC);
    if ($place) {
        $add_city_display = $place['add_city'];
        $add_abadi_display = '-';
        $id_ostan_display = $place['id_ostan'];
        $id_city_display  = $place['id_city'];
        $id_mar_display   = $place['id_mar'];
    }
}
if (!isset($add_abadi_display)) $add_abadi_display = $add_abadi;
if (!isset($add_city_display)) $add_city_display = $add_city;
if (!isset($id_ostan_display)) $id_ostan_display = $id_ostan;
if (!isset($id_city_display)) $id_city_display = $id_city;
if (!isset($id_mar_display)) $id_mar_display = $id_mar;

// برچسب‌های فارسی
$v_no_kesh = ($no_kesh == '1') ? 'آبی' : 'دیم';
$v_nah_kesh = '';
if ($nah_kesh == '1') $v_nah_kesh = 'ساده';
elseif ($nah_kesh == '2') $v_nah_kesh = 'مخلوط';
elseif ($nah_kesh == '3') $v_nah_kesh = 'درختان پراکنده';

$no_mal_labels = array(
    '1' => 'سند ششدانگ', '2' => 'سند مشاعی', '3' => 'اصلاحات اراضی',
    '4' => 'موقوفه', '5' => 'واگذاری', '6' => 'قولنامه', '7' => 'اجاره', '8' => 'سایر'
);
$v_no_mal = isset($no_mal_labels[$no_mal]) ? $no_mal_labels[$no_mal] : '';

// دریافت محصولات
$products = array();
$q = $dbh->prepare("SELECT * FROM Garden_prod WHERE Garden_id = :Garden_id ORDER BY id");
$q->execute(array(':Garden_id' => $id));
while ($prod = $q->fetch(PDO::FETCH_ASSOC)) {
    $products[] = $prod;
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>مشاهده اطلاعات باغی</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style>
        body { font-family: Tahoma, sans-serif; direction: rtl; text-align: right; background: #fff; padding: 10px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .title { font-size: 18px; font-weight: bold; color: #111; text-align: center; margin: 10px 0; }
        .card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 14px 16px; margin-bottom: 14px; }
        .card h3 { margin: 0 0 10px; padding-bottom: 8px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .grid { overflow: hidden; }
        .field { float: right; width: 48%; margin: 0 1% 10px 0; }
        .field-wide { width: 98%; }
        .field label { display: block; font-size: 13px; color: #555; }
        .info { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; min-height: 22px; font-size: 13px; }
        .info-readonly { background: #fffbeb; }
        .table-wrap { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .table th { background: #f3f4f6; padding: 8px 6px; border: 1px solid #d1d5db; text-align: center; }
        .table td { padding: 6px; border: 1px solid #d1d5db; text-align: center; }
        .btn { height: 44px; min-width: 150px; padding: 0 18px; margin: 4px; border: 0; border-radius: 6px; font-size: 14px; cursor: pointer; background: #6b7280; color: #fff; }
        .btn:hover { filter: brightness(0.95); }
        .note { font-size: 12px; color: #6b7280; margin-top: 8px; }
        @media screen and (max-width: 700px) { .field { float: none; width: 100%; } }
    </style>
    <script>
        function close_window() { window.close(); }
    </script>
</head>
<body>
<div class="container">

    <div class="title">مشاهده اطلاعات باغی و قلمستان</div>

    <?php sar_data2($bah_cod_m, $num_bah); ?>

    <!-- موقعیت -->
    <div class="card">
        <h3>موقعیت بهره برداری</h3>
        <div class="grid">
            <div class="field"><label>استان</label><div class="info"><?php echo agri_h(ostan_name($id_ostan_display)); ?></div></div>
            <div class="field"><label>شهرستان</label><div class="info"><?php echo agri_h(city_name1($id_city_display, $id_ostan_display)); ?></div></div>
            <div class="field"><label>مرکز جهاد کشاورزی</label><div class="info"><?php echo agri_h(mar_name($id_mar_display)); ?></div></div>
            <div class="field"><label>آبادی / شهر</label><div class="info"><?php echo agri_h(abadi_name($add_abadi_display)); ?></div></div>
        </div>
    </div>

    <!-- اطلاعات کلی -->
    <div class="card">
        <h3>اطلاعات کلی</h3>
        <div class="grid">
            <div class="field"><label>نوع کشت</label><div class="info"><?php echo agri_h($v_no_kesh); ?></div></div>
            <div class="field"><label>نوع مالکیت</label><div class="info"><?php echo agri_h($v_no_mal); ?></div></div>
            <div class="field"><label>نحوه کشت</label><div class="info"><?php echo agri_h($v_nah_kesh); ?></div></div>
            <?php if ($nah_kesh != '3') { ?>
            <div class="field"><label>طول جغرافیایی X</label><div class="info"><?php echo agri_h($lng); ?></div></div>
            <div class="field"><label>عرض جغرافیایی Y</label><div class="info"><?php echo agri_h($lat); ?></div></div>
            <div class="field"><label>مساحت زمین (هکتار)</label><div class="info"><?php echo agri_h($m_zamin); ?></div></div>
            <?php } ?>
        </div>
    </div>

    <!-- اطلاعات مالک -->
    <div class="card">
        <h3>اطلاعات مالک</h3>
        <?php if ($no_mal != '7') { ?>
            <div style="background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8; padding:8px; margin-bottom:12px; text-align:center;">
                اطلاعات بهره بردار بعنوان مالک ثبت گردیده است
            </div>
        <?php } ?>
        <div class="grid">
            <div class="field"><label>کد ملی مالک</label><div class="info info-readonly"><?php echo agri_h($m_cod_m); ?></div></div>
            <div class="field"><label>جنسیت</label><div class="info info-readonly"><?php echo ($m_jens == '1') ? 'مرد' : 'زن'; ?></div></div>
            <div class="field"><label>نام</label><div class="info info-readonly"><?php echo agri_h($m_name); ?></div></div>
            <div class="field"><label>نام خانوادگی</label><div class="info info-readonly"><?php echo agri_h($m_last_name); ?></div></div>
            <div class="field"><label>نام پدر</label><div class="info info-readonly"><?php echo agri_h($m_fname); ?></div></div>
            <div class="field"><label>تلفن همراه</label><div class="info info-readonly"><?php echo agri_h($m_tel_m); ?></div></div>
            <div class="field"><label>وضعیت سکونت</label><div class="info info-readonly"><?php echo ($m_vaz_sok == '1') ? 'ساکن' : (($m_vaz_sok == '2') ? 'غیرساکن' : ''); ?></div></div>
            <?php if ($no_mal == '7') { ?>
            <div class="field field-wide"><label>آدرس محل سکونت</label><div class="info info-readonly"><?php echo agri_h($m_addres); ?></div></div>
            <?php } ?>
        </div>
    </div>

    <!-- اطلاعات آب (در صورت آبی) -->
    <?php if ($no_kesh == '1') { ?>
    <div class="card">
        <h3>اطلاعات آب</h3>
        <div class="grid">
            <div class="field"><label>منبع آب</label><div class="info info-readonly">
                <?php
                $ab_sources = array(1=>'چشمه',2=>'قنات',3=>'رودخانه',4=>'سد',5=>'چاه سطحی',6=>'چاه عمیق',7=>'چاه نیمه عمیق',8=>'زهکش',9=>'پساب',10=>'آب بندان',11=>'سایر');
                echo agri_h(isset($ab_sources[$m_ab]) ? $ab_sources[$m_ab] : '');
                ?>
            </div></div>
            <div class="field"><label>مدار آبیاری (شبانه روز)</label><div class="info info-readonly"><?php echo agri_h($md_ab); ?></div></div>
            <div class="field"><label>حقابه (ساعت)</label><div class="info info-readonly"><?php echo agri_h($h_ab); ?></div></div>
            <div class="field"><label>نوع سند حقابه</label><div class="info info-readonly">
                <?php
                $sab_types = array(1=>'پروانه بهره برداری',2=>'مجوز آب',3=>'عرفی',4=>'سایر');
                echo agri_h(isset($sab_types[$no_sab]) ? $sab_types[$no_sab] : '');
                ?>
            </div></div>
            <div class="field"><label>نحوه آبیاری</label><div class="info info-readonly">
                <?php
                $ab_types = array(1=>'جوی و پشته',2=>'نواری',3=>'غرقابی',4=>'تشتکی',5=>'تحت فشار قطره ای',6=>'تحت فشار بارانی',7=>'سایر');
                echo agri_h(isset($ab_types[$no_ab]) ? $ab_types[$no_ab] : '');
                ?>
            </div></div>
            <div class="field"><label>وضعیت استخر</label><div class="info info-readonly">
                <?php
                $es_types = array(1=>'ندارد',2=>'دارد / جهت ذخیره آب',3=>'دارد - دو منظوره');
                echo agri_h(isset($es_types[$es]) ? $es_types[$es] : '');
                ?>
            </div></div>
        </div>
    </div>
    <?php } ?>

    <!-- اطلاعات کاشت و محصولات -->
    <div class="card">
        <h3>اطلاعات کاشت</h3>
        <div class="grid">
            <div class="field"><label>سال زراعی</label><div class="info info-readonly"><?php echo agri_h($z_sal); ?></div></div>
        </div>
        <?php if (!empty($products)) { ?>
        <div class="table-wrap">
            <table class="table">
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
                        // دریافت نام گروه و محصول
                        $qg = $dbh->prepare("SELECT group_name FROM product_b WHERE group_cod = :group_cod LIMIT 1");
                        $qg->execute(array(':group_cod' => $prod['cod_qroup']));
                        $grow = $qg->fetch(PDO::FETCH_ASSOC);
                        $group_name = $grow ? $grow['group_name'] : $prod['cod_qroup'];

                        $qp = $dbh->prepare("SELECT product_name FROM product_b WHERE product_cod = :product_cod LIMIT 1");
                        $qp->execute(array(':product_cod' => $prod['cod_mah']));
                        $prow = $qp->fetch(PDO::FETCH_ASSOC);
                        $product_name = $prow ? $prow['product_name'] : $prod['cod_mah'];

                        $bem = ($prod['mah_bem'] == '1') ? 'بلی' : 'خیر';
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
        <div class="note">* تعداد درخت برای محصولات توت فرنگی، چای، زرشک، گل محمدی، گیاهان دارویی و گیاهان دائمی تزئینی تکمیل نمی‌گردد.</div>
        <?php } ?>
        <?php } else { ?>
        <div class="info">هیچ محصولی برای این باغ ثبت نشده است.</div>
        <?php } ?>
    </div>

    <!-- دکمه بستن -->
    <div style="text-align:center; padding:12px 0;">
        <button class="btn" onclick="close_window()">بستن پنجره</button>
    </div>

</div>
</body>
</html>