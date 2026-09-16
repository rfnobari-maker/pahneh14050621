<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');
require_once('../../Jalali.php');

function agri2_h($v)
{
    if (!isset($v)) return '';
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri2_clean_code($v)
{
    if (!isset($v)) return '';
    $v = trim($v);
    if ($v == '/' || $v == '\\') return '';
    return $v;
}

function agri2_load_place($dbh, $m_poul, $add_abadi, $add_city)
{
    $out = array(
        'ok' => false,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'id_ostan' => '',
        'id_city' => '',
        'id_mar' => ''
    );
    if ($m_poul == 'abadi' && $add_abadi != '' && $add_abadi != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi' => $add_abadi));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_abadi'] = $row['add_abadi'];
            $out['add_city'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    } elseif ($m_poul == 'shahr' && $add_city != '' && $add_city != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_city from list_city where add_city = :add_city";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city' => $add_city));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_city'] = $row['add_city'];
            $out['add_abadi'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    }
    return $out;
}

function agri2_fix_num_bah($dbh, $bah_cod_m, $num_bah)
{
    $num_bah = agri2_clean_code($num_bah);
    if ($num_bah != '' && is_numeric($num_bah)) {
        return $num_bah;
    }
    $query = "SELECT num_bah from bah where bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row['num_bah']) && agri2_clean_code($row['num_bah']) != '' && is_numeric($row['num_bah'])) {
            return $row['num_bah'];
        }
    }
    return '1';
}

function agri2_num($v)
{
    $v = trim(str_replace(array('،', ','), '.', $v . ''));
    if ($v === '') return null;
    if (!is_numeric($v)) return false;
    return $v + 0;
}

function garden_is_scattered($nah_kesh)
{
    return ($nah_kesh == '3' || $nah_kesh === 3);
}

function agri2_validate_step2($post, $no_kesh, $nah_kesh)
{
    $errors = array();
    $scattered = garden_is_scattered($nah_kesh);
    $z_sal = isset($post['z_sal']) ? trim($post['z_sal']) : '';
    if ($z_sal == '') $errors['z_sal'] = 'سال را انتخاب کنید';
    elseif ($z_sal != '1405') $errors['z_sal'] = 'سال نامعتبر است';

    if (!$scattered) {
        $lng = agri2_num(isset($post['lng']) ? $post['lng'] : '');
        $lat = agri2_num(isset($post['lat']) ? $post['lat'] : '');
        $m_zamin = agri2_num(isset($post['m_zamin']) ? $post['m_zamin'] : '');
        $m_vaz_sok = isset($post['m_vaz_sok']) ? $post['m_vaz_sok'] : '';

        if ($lng === null) $errors['lng'] = 'طول جغرافیایی را وارد کنید';
        elseif ($lng === false) $errors['lng'] = 'طول جغرافیایی باید عدد باشد';
        elseif ($lng != 0 && ($lng < 40 || $lng > 70)) $errors['lng'] = 'طول جغرافیایی باید صفر یا بین ۴۰ تا ۷۰ باشد (مثال: ۴۶٫۲۱)';

        if ($lat === null) $errors['lat'] = 'عرض جغرافیایی را وارد کنید';
        elseif ($lat === false) $errors['lat'] = 'عرض جغرافیایی باید عدد باشد';
        elseif ($lat != 0 && ($lat < 20 || $lat > 45)) $errors['lat'] = 'عرض جغرافیایی باید صفر یا بین ۲۰ تا ۴۵ باشد (مثال: ۳۷٫۰۱)';

        if ($m_zamin === null) $errors['m_zamin'] = 'مساحت زمین را وارد کنید';
        elseif ($m_zamin === false) $errors['m_zamin'] = 'مساحت زمین باید عدد باشد';
        elseif ($m_zamin <= 0) $errors['m_zamin'] = 'مساحت زمین باید بزرگ‌تر از صفر باشد';
        elseif ($m_zamin > 5000) $errors['m_zamin'] = 'مساحت زمین نمی‌تواند از ۵۰۰۰ هکتار بیشتر باشد';

        if ($m_vaz_sok == '') $errors['m_vaz_sok'] = 'وضعیت سکونت مالک را انتخاب کنید';
        if (!isset($post['m_cod_m']) || trim($post['m_cod_m']) == '') $errors['m_cod_m'] = 'کد ملی مالک را وارد کنید';
        if (!isset($post['m_name']) || trim($post['m_name']) == '') $errors['m_name'] = 'نام مالک را وارد کنید';
        if (!isset($post['m_last_name']) || trim($post['m_last_name']) == '') $errors['m_last_name'] = 'نام خانوادگی مالک را وارد کنید';
        if (!isset($post['m_tel_m']) || trim($post['m_tel_m']) == '') $errors['m_tel_m'] = 'تلفن همراه را وارد کنید';
        if (!isset($post['m_fname']) || trim($post['m_fname']) == '') $errors['m_fname'] = 'این فیلد را تکمیل کنید';

        if ($no_kesh == '1') {
            if (!isset($post['m_ab']) || $post['m_ab'] == '') $errors['m_ab'] = 'منبع آب را انتخاب کنید';
            if (!isset($post['md_ab']) || trim($post['md_ab']) == '') $errors['md_ab'] = 'مدار آبیاری را وارد کنید';
            elseif (agri2_num($post['md_ab']) === false) $errors['md_ab'] = 'مدار آبیاری باید عدد باشد';
            if (!isset($post['h_ab']) || trim($post['h_ab']) == '') $errors['h_ab'] = 'حقابه را وارد کنید';
            elseif (agri2_num($post['h_ab']) === false) $errors['h_ab'] = 'حقابه باید عدد باشد';
            if (!isset($post['no_sab']) || $post['no_sab'] == '') $errors['no_sab'] = 'نوع سند حقابه را انتخاب کنید';
            if (!isset($post['no_ab']) || $post['no_ab'] == '') $errors['no_ab'] = 'نحوه آبیاری را انتخاب کنید';
            if (!isset($post['es']) || $post['es'] == '') $errors['es'] = 'وضعیت استخر را انتخاب کنید';
        }
    }
    return $errors;
}

$slash_keys = array('add_abadi', 'add_city', 'num_bah', 'id_city', 'id_mar', 'id_ostan', 'm_poul');
foreach ($slash_keys as $k) {
    if (isset($_POST[$k])) {
        $_POST[$k] = agri2_clean_code($_POST[$k]);
    }
}

$mess = $add_abadi = $add_city = $m_poul = '';
$field_errors = array();
$show_step2 = false;
$place_ok = false;
$place_err = '';
$no_mal = '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$id_mar = isset($_POST['id_mar']) ? agri2_clean_code($_POST['id_mar']) : '';
$check_cod = isset($_POST['check_cod']) ? $_POST['check_cod'] : 0;
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
$t_mah = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';
$num_bah = isset($_POST['num_bah']) ? $_POST['num_bah'] : 1;
$v_co_name = '';
$m_cod_m = '';
$m_last_name = '';
$m_name = '';
$m_tel_m = '';
$m_fname = '';
$m_jens = '';
$no_bah = '1';
$co_name = '';

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['no_mal'])) $no_mal = test_input($_POST['no_mal']);
if (isset($_POST['bah_cod_m'])) $bah_cod_m = test_input($_POST['bah_cod_m']);
if (isset($_POST['no_kesh'])) $no_kesh = test_input($_POST['no_kesh']);
if (isset($_POST['nah_kesh'])) $nah_kesh = test_input($_POST['nah_kesh']);
if (isset($_POST['t_mah'])) $t_mah = test_input($_POST['t_mah']);
if (isset($_POST['action1'])) {
    ?>
    <form name="myform" class="myform" method="post" action="../benef.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}
if (isset($_POST["m_poul"])) {
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST["add_abadi"])) {
    $add_abadi = $_POST["add_abadi"];
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST["add_city"])) {
    $add_city = $_POST["add_city"];
    $m_poul = $_POST["m_poul"];
}

$id_ostan = isset($_POST['id_ostan']) ? agri2_clean_code($_POST['id_ostan']) : '';
$id_city = isset($_POST['id_city']) ? agri2_clean_code($_POST['id_city']) : '';
$force_step1 = (isset($_POST['agri_step']) && $_POST['agri_step'] == '1');

$is_save = (!$force_step1 && isset($_POST['action']) && isset($_POST['z_sal']));
if ($is_save) {
    $query = "SELECT ok from bah where  bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = ($row && isset($row['ok'])) ? $row['ok'] : '';
    if ($ok == '2') {
        alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست  ');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if ($ok == '4') {
        alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد  ');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    $date_s = $date_edit;
    $check_cod = $_POST['check_cod'];
    $mor_cod_m = $login_session;
    $bah_cod_m = $_POST['bah_cod_m'];
    $add_city = agri2_clean_code($_POST['add_city']);
    $add_abadi = agri2_clean_code($_POST['add_abadi']);
    $m_poul = isset($_POST['m_poul']) ? agri2_clean_code($_POST['m_poul']) : $m_poul;
    if ($m_poul == '') {
        if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
        elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
    }
    $place = agri2_load_place($dbh, $m_poul, $add_abadi, $add_city);
    if (!$place['ok']) {
        $place_err = 'موقعیت بهره برداری نامعتبر است. آبادی/شهر را دوباره انتخاب کنید.';
        $show_step2 = true;
    } else {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
        $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : $no_mal;
        $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : $no_kesh;
        $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : $nah_kesh;
        $t_mah = isset($_POST['t_mah']) ? $_POST['t_mah'] : $t_mah;
        if (garden_is_scattered($nah_kesh)) {
            if ($no_kesh == '') $no_kesh = '-';
            if ($no_mal == '') $no_mal = '-';
        }
        $field_errors = agri2_validate_step2($_POST, $no_kesh, $nah_kesh);
        if (!empty($field_errors)) {
            $show_step2 = true;
            $mess = 'لطفاً موارد زیر را تکمیل کنید';
        } else {
        $scattered = garden_is_scattered($nah_kesh);
        $m_zamin = $scattered ? 0 : agri2_num($_POST['m_zamin']);
        $lng = $scattered ? 0 : agri2_num($_POST['lng']);
        $lat = $scattered ? 0 : agri2_num($_POST['lat']);
        $m_cod_m = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
        $num_bah = agri2_fix_num_bah($dbh, $bah_cod_m, isset($_POST['num_bah']) ? $_POST['num_bah'] : '');
        if ($no_mal <> '7') $m_cod_m = $bah_cod_m;
        $m_vaz_sok = isset($_POST['m_vaz_sok']) ? $_POST['m_vaz_sok'] : '';
        $m_ab = '';
        $md_ab = 0;
        $h_ab = 0;
        $no_sab = '';
        $no_ab = '';
        $es = '';
        if (!$scattered && $no_kesh == '1') {
            $m_ab = $_POST['m_ab'];
            $md_ab = agri2_num($_POST['md_ab']);
            $h_ab = agri2_num($_POST['h_ab']);
            $no_sab = $_POST['no_sab'];
            $no_ab = $_POST['no_ab'];
            $es = $_POST['es'];
        }
        $z_sal = trim($_POST['z_sal']);
        $query = "SELECT max(`sh_gat`) as `max_shgat` FROM Garden WHERE bah_cod_m= :bah_cod_m and z_sal= :z_sal";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':z_sal' => $z_sal));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $t_gat = $row['max_shgat'];
        $sh_gat = $t_gat + 1;
        $m_jens = isset($_POST['m_jens']) ? $_POST['m_jens'] : '';
        $m_name = isset($_POST['m_name']) ? $_POST['m_name'] : '';
        $m_last_name = isset($_POST['m_last_name']) ? $_POST['m_last_name'] : '';
        $m_fname = isset($_POST['m_fname']) ? $_POST['m_fname'] : '';
        $m_tel_m = isset($_POST['m_tel_m']) ? $_POST['m_tel_m'] : '';
        if ($scattered) {
            $query = "INSERT INTO Garden (date_s, mor_cod_m, bah_cod_m, num_bah, sh_gat, id_ostan, id_city, id_mar, add_abadi, add_city, nah_kesh, z_sal, check_cod) VALUES (:date_s, :mor_cod_m, :bah_cod_m, :num_bah, :sh_gat, :id_ostan, :id_city, :id_mar, :add_abadi, :add_city, :nah_kesh, :z_sal, :check_cod)";
            $q = $dbh->prepare($query);
            $q->execute(array(':date_s' => $date_s, ':mor_cod_m' => $mor_cod_m, ':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah, ':sh_gat' => $sh_gat, ':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':add_abadi' => $add_abadi, ':add_city' => $add_city, ':nah_kesh' => $nah_kesh, ':z_sal' => $z_sal, ':check_cod' => $check_cod));
        } else {
            $query = "INSERT INTO Garden (date_s, mor_cod_m, bah_cod_m, num_bah, sh_gat, id_ostan, id_city, id_mar, add_abadi, add_city, m_zamin, no_mal, lng, lat, m_cod_m, m_vaz_sok, no_kesh, nah_kesh, m_ab, md_ab, h_ab, no_sab, no_ab, es, z_sal, check_cod) VALUES (:date_s, :mor_cod_m, :bah_cod_m, :num_bah, :sh_gat, :id_ostan, :id_city, :id_mar, :add_abadi, :add_city, :m_zamin, :no_mal, :lng, :lat, :m_cod_m, :m_vaz_sok, :no_kesh, :nah_kesh, :m_ab, :md_ab, :h_ab, :no_sab, :no_ab, :es, :z_sal, :check_cod)";
            $q = $dbh->prepare($query);
            $q->execute(array(':date_s' => $date_s, ':mor_cod_m' => $mor_cod_m, ':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah, ':sh_gat' => $sh_gat, ':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':add_abadi' => $add_abadi, ':add_city' => $add_city, ':m_zamin' => $m_zamin, ':no_mal' => $no_mal, ':lng' => $lng, ':lat' => $lat, ':m_cod_m' => $m_cod_m, ':m_vaz_sok' => $m_vaz_sok, ':no_kesh' => $no_kesh, ':nah_kesh' => $nah_kesh, ':m_ab' => $m_ab, ':md_ab' => $md_ab, ':h_ab' => $h_ab, ':no_sab' => $no_sab, ':no_ab' => $no_ab, ':es' => $es, ':z_sal' => $z_sal, ':check_cod' => $check_cod));
        }
        $query = "INSERT IGNORE INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m) VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
        $q = $dbh->prepare($query);
        $q->execute(array(':date_s' => $date_s, ':mor_cod_m' => $mor_cod_m, ':m_cod_m' => $m_cod_m, ':m_jens' => $m_jens, ':m_name' => $m_name, ':m_last_name' => $m_last_name, ':m_fname' => $m_fname, ':m_tel_m' => $m_tel_m));
        sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'ثبت اطلاعات باغی - ' . $bah_cod_m, $id_ostan);
        $dbh = null;
        alert('اطلاعات بهره برداری باغی  با موفقیت ثبت شد ');
        ?>
  <form name="myform1" class="myform" method="post" action="liste_Garden.php#1">
        <input type="hidden" name="z_sal" value="<?php echo agri2_h($z_sal); ?>"/>
        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
        <input type="hidden" name="action_lise" value="1"/>
        <input type="hidden" name="t_mah" value=""/>
 </form>
   <script type="text/javascript">document.myform1.submit();</script>
        <?php
        exit;
        }
    }
}

if (!$is_save && isset($_POST['action'])) {
    $m_poul = $_POST["m_poul"];
    if ($m_poul == '') {
        $mess = 'موقعیت بهره برداری را تعیین کنید ' . '<p>';
        $field_errors['m_poul'] = 'موقعیت بهره برداری را تعیین کنید';
    }
    $add_city = $_POST["add_city"];
    if ($m_poul == 'shahr' and $add_city == '') {
        $mess .= 'نام شهر را انتخاب کنید' . '<p>';
        $field_errors['add_city'] = 'نام شهر را انتخاب کنید';
    }
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul == 'abadi' and $add_abadi == '') {
        $mess .= 'نام آبادی را انتخاب کنید' . '<p>';
        $field_errors['add_abadi'] = 'نام آبادی را انتخاب کنید';
    }
    $bah_cod_m = $_POST['bah_cod_m'];
    if ($bah_cod_m == '') {
        $mess .= 'کد ملی را وارد کنید' . '<p>';
        $field_errors['bah_cod_m'] = 'کد ملی را وارد کنید';
    } elseif (function_exists('check_code_melli') && check_code_melli($bah_cod_m) <> 1) {
        $mess .= 'کد ملی بهره بردار صحیح نیست' . '<p>';
        $field_errors['bah_cod_m'] = 'کد ملی بهره بردار صحیح نیست';
    }
    $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
    if ($nah_kesh == '') {
        $mess .= 'نحوه کاشت را انتخاب کنید' . '<p>';
        $field_errors['nah_kesh'] = 'نحوه کاشت را انتخاب کنید';
    }
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    if (garden_is_scattered($nah_kesh)) {
        $no_kesh = '-';
        $no_mal = '-';
    } else {
        if ($no_kesh == '' || $no_kesh == '-') {
            $mess .= 'نوع کشت را انتخاب کنید' . '<p>';
            $field_errors['no_kesh'] = 'نوع کشت را انتخاب کنید';
        }
        if ($no_mal == '' || $no_mal == '-') {
            $mess .= 'نوع مالکیت را انتخاب کنید' . '<p>';
            $field_errors['no_mal'] = 'نوع مالکیت را انتخاب کنید';
        }
    }
    if ((isset($_POST['action'])) and ($mess == '')) {
        $query = "SELECT num_bah from bah where bah_cod_m = :bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
        $count_codm = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num_bah = '1';
        if ($count_codm == 1 && $row && agri2_clean_code($row['num_bah']) != '' && is_numeric($row['num_bah'])) {
            $num_bah = $row['num_bah'];
        }
        if ($count_codm > 1) { ?>
                <form name="myform1" class="myform" method="post" action="bah_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo agri2_h($num_bah); ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                <input type="hidden" name="no_kesh" value="<?php echo agri2_h($no_kesh); ?>"/>
                <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($nah_kesh); ?>"/>
                <input type="hidden" name="t_mah" value="<?php echo agri2_h($t_mah); ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
            exit;
        }
        if ($count_codm == 0) {
            $mess = 'اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره برداری باغی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ';
            $not_found_bah = true;
            $field_errors['bah_cod_m'] = 'اطلاعات بهره بردار یافت نشد';
        } else {
            if (isset($_POST['agri_h']) && $_POST['agri_h'] == '2') {
                ?>
                <form name="myform1" class="myform" method="post" action="Garden_history.php">
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                    <input type="hidden" name="no_kesh" value="<?php echo agri2_h($no_kesh); ?>"/>
                    <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($nah_kesh); ?>"/>
                    <input type="hidden" name="t_mah" value="<?php echo agri2_h($t_mah); ?>"/>
                    <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                </form>
                <script type="text/javascript">document.myform1.submit();</script>
                <?php
                exit;
            }
            $show_step2 = true;
        }
    }
}

if (!$force_step1 && !$show_step2 && !isset($_POST['action']) && $bah_cod_m != ''
    && $nah_kesh != '' && $m_poul != '') {
    if (garden_is_scattered($nah_kesh) || ($no_kesh != '' && $no_mal != '')) {
        $show_step2 = true;
    }
}

if ($show_step2) {
    $query = "SELECT ok from bah where  bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = ($row && isset($row['ok'])) ? $row['ok'] : '';
    if ($ok == '2') {
        alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست  ');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if ($ok == '4') {
        alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد  ');
        ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    if (isset($_POST['t_gat'])) $check_cod = $_POST['t_gat'] + 1;
    if (isset($_POST['add_abadi'])) $add_abadi = agri2_clean_code($_POST["add_abadi"]);
    if (isset($_POST['add_city'])) $add_city = agri2_clean_code($_POST["add_city"]);
    if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
    if (isset($_POST['m_poul'])) $m_poul = agri2_clean_code($_POST['m_poul']);
    if (isset($_POST['no_mal'])) $no_mal = $_POST['no_mal'];
    if (isset($_POST['nah_kesh'])) $nah_kesh = $_POST['nah_kesh'];
    if (isset($_POST['t_mah'])) $t_mah = $_POST['t_mah'];
    $num_bah = agri2_fix_num_bah($dbh, $bah_cod_m, isset($_POST['num_bah']) ? $_POST['num_bah'] : $num_bah);
    if ($m_poul == '') {
        if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
        elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
    }
    if (garden_is_scattered($nah_kesh)) {
        $no_kesh = ($no_kesh == '') ? '-' : $no_kesh;
        $no_mal = ($no_mal == '') ? '-' : $no_mal;
    }
    if (!garden_is_scattered($nah_kesh) && $no_mal <> 7) {
        include('../../login/config.php');
        $query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $no_bah = $row['no_bah'];
            $co_name = $row['co_name'];
            if ($no_bah == '2') {
                $m_fname = '-';
                $v_co_name = '/ شرکت ' . $row['co_name'] . ' /';
            } else {
                $m_fname = $row['fname'];
            }
            $m_name = $row['name'];
            $m_jens = $row['jens'];
            $m_last_name = $row['last_name'];
            $m_tel_m = $row['tel_m'];
        }
    } else {
        if (isset($_POST['m_cod_m'])) $m_cod_m = $_POST['m_cod_m'];
        if (isset($_POST['m_jens'])) $m_jens = $_POST['m_jens'];
        if (isset($_POST['m_name'])) $m_name = $_POST['m_name'];
        if (isset($_POST['m_last_name'])) $m_last_name = $_POST['m_last_name'];
        if (isset($_POST['m_fname'])) $m_fname = $_POST['m_fname'];
        if (isset($_POST['m_tel_m'])) $m_tel_m = $_POST['m_tel_m'];
    }
    if (isset($_POST['no_kesh'])) $no_kesh = $_POST['no_kesh'];
    if (isset($_POST['lng'])) $lng = $_POST['lng'];
    if (isset($_POST['lat'])) $lat = $_POST['lat'];
    if (isset($_POST['m_zamin'])) $m_zamin = $_POST['m_zamin'];
    if (isset($_POST['m_ab'])) $m_ab = $_POST['m_ab'];
    if (isset($_POST['md_ab'])) $md_ab = $_POST['md_ab'];
    if (isset($_POST['h_ab'])) $h_ab = $_POST['h_ab'];
    if (isset($_POST['no_sab'])) $no_sab = $_POST['no_sab'];
    if (isset($_POST['no_ab'])) $no_ab = $_POST['no_ab'];
    if (isset($_POST['es'])) $es = $_POST['es'];
    if (isset($_POST['m_vaz_sok'])) $m_vaz_sok = $_POST['m_vaz_sok'];
    if (isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'];
    $v_no_kesh = '';
    $v_no_mal = '';
    $v_nah_kesh = '';
    if ($no_kesh == '1') $v_no_kesh = 'آبی';
    if ($no_kesh == '2') $v_no_kesh = 'دیم';
    if ($nah_kesh == '1') $v_nah_kesh = 'ساده';
    if ($nah_kesh == '2') $v_nah_kesh = 'مخلوط';
    if ($nah_kesh == '3') $v_nah_kesh = 'درختان پراکنده';
    if ($no_mal <> '7' && $no_mal != '-') $m_cod_m = $bah_cod_m;
    if ($no_mal == '1') $v_no_mal = 'سند ششدانگ';
    if ($no_mal == '2') $v_no_mal = 'سند مشاعی';
    if ($no_mal == '3') $v_no_mal = 'اصلاحات اراضی';
    if ($no_mal == '4') $v_no_mal = 'موقوفه';
    if ($no_mal == '5') $v_no_mal = 'واگذاری';
    if ($no_mal == '6') $v_no_mal = 'قولنامه';
    if ($no_mal == '7') $v_no_mal = 'اجاره';
    if ($no_mal == '8') $v_no_mal = 'سایر';
    $place = agri2_load_place($dbh, $m_poul, $add_abadi, $add_city);
    $place_ok = $place['ok'];
    if ($place_ok) {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
    } else {
        $id_ostan = '';
        $id_city = '';
        $id_mar = '';
        if ($place_err == '') $place_err = 'موقعیت بهره برداری یافت نشد. آبادی/شهر را از مرحله قبل دوباره انتخاب کنید.';
    }
}

$city_data = array();
$abadi_data = array();
if (!$show_step2) {
$query = "SELECT add_city, shahr FROM `list_city` WHERE mor_cod_m = :mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    $city_data[] = array('code' => $row['add_city'], 'name' => $row['shahr']);
}

$query = "SELECT add_abadi, abadi FROM `list_abadi` WHERE mor_cod_m = :mor_cod_m ORDER BY BINARY abadi";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    $abadi_data[] = array('code' => $row['add_abadi'], 'name' => $row['abadi']);
}
}

$city_label = '';
if ($add_city != '') {
    foreach ($city_data as $item) {
        if ($item['code'] == $add_city) {
            $city_label = $item['name'];
            break;
        }
    }
}
$abadi_label = '';
if ($add_abadi != '') {
    foreach ($abadi_data as $item) {
        if ($item['code'] == $add_abadi) {
            $abadi_label = $item['name'];
            break;
        }
    }
}

$show_city = ($m_poul == 'shahr' || ($add_city != '' && $add_city != '-'));
$show_abadi = ($m_poul == 'abadi' || ($add_abadi != '' && $add_abadi != '-'));
$has_errors = ($mess != '');
$has_step2_errors = ($show_step2 && (!empty($field_errors) || $place_err != ''));
$err_m_poul = isset($field_errors['m_poul']);
$err_city = isset($field_errors['add_city']);
$err_abadi = isset($field_errors['add_abadi']);
$err_cod = isset($field_errors['bah_cod_m']);
$err_kesh = isset($field_errors['no_kesh']);
$err_mal = isset($field_errors['no_mal']);
$err_nah = isset($field_errors['nah_kesh']);
$garden_scattered = garden_is_scattered($nah_kesh);
$agri_ro = ($show_step2 && $no_mal <> 7 && $no_mal != '-') ? ' readonly="readonly"' : '';
$agri_ro_class = ($show_step2 && $no_mal <> 7 && $no_mal != '-') ? ' agri-lock' : '';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-accent: #A16207;
            --color-on-accent: #FFFFFF;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-card-foreground: #14532D;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-on-destructive: #FFFFFF;
            --color-ring: #15803D;
            --color-warning-bg: #FEF2F2;
            --space-1: 8px;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --radius: 12px;
            --duration: 200ms;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; }

        body.agri1-body {
            margin: 0;
            background: var(--color-background);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.6;
        }

        .agri1-skip {
            position: absolute;
            right: -999px;
            top: 8px;
            z-index: 50;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }

        .agri1-main {
            width: min(920px, 100%);
            margin: 0 auto;
            padding: var(--space-3) var(--space-2) var(--space-4);
        }

        .agri1-kicker {
            margin: 0 0 var(--space-1);
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
            font-weight: 600;
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-steps {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-1);
            list-style: none;
            margin: 0 0 var(--space-3);
            padding: 0;
        }

        .agri1-steps li {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-steps li.is-current {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-steps li.is-link {
            padding: 0;
            background: transparent;
        }

        .agri1-step-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border: 0;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-foreground);
            cursor: pointer;
            font: inherit;
            font-size: 0.875rem;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .agri1-step-btn:hover { background: #DCFCE7; }
        .agri1-step-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-step-btn .agri1-step-num {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-step-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid #FECACA;
            background: var(--color-warning-bg);
            color: #991B1B;
        }
        .agri1-alert:focus { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert ul { margin: 0; padding: 0 18px 0 0; }
        .agri1-alert a { color: #991B1B; text-decoration: underline; }
        .agri1-alert ul:empty { display: none; }

        .agri1-icon {
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agri1-fieldset { margin: 0 0 var(--space-3); padding: 0; border: 0; }

        .agri1-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-bottom: 10px;
            color: var(--color-foreground);
            font-size: 1rem;
            font-weight: 700;
        }

        .agri1-hint {
            margin: 0 0 12px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 52px;
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            cursor: pointer;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }

        .agri1-choice:has(input:checked),
        .agri1-choice.is-selected {
            border-color: var(--color-primary);
            background: #ECFDF3;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.16);
        }

        .agri1-choice:focus-within {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-choice input {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
        }

        .agri1-choice-mark {
            width: 20px;
            height: 20px;
            border: 2px solid var(--color-primary);
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
        }

        .agri1-choice:has(input:checked) .agri1-choice-mark::after,
        .agri1-choice.is-selected .agri1-choice-mark::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: var(--color-primary);
        }

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 16px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.5;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-page .agri1-form select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 10px 16px 10px 44px;
            text-align: right;
            text-align-last: right;
            direction: rtl;
            cursor: pointer;
            background-color: var(--color-card);
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2314532D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 12px center;
            background-size: 20px 20px;
        }

        .agri1-page .agri1-form select option {
            padding: 10px 16px;
            text-align: right;
            direction: rtl;
            background-color: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form #bah_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }

        .agri1-page .agri1-form input[type="text"]:hover,
        .agri1-page .agri1-form select:hover {
            background-color: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }

        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"],
        .agri1-fieldset.is-invalid .agri1-choices {
            border-color: var(--color-destructive);
        }

        .agri1-combo { position: relative; }

        .agri1-page .agri1-form .agri1-combo input[type="text"] {
            padding-left: 44px;
        }

        .agri1-combo-toggle {
            position: absolute;
            left: 4px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: var(--touch);
            height: var(--touch);
            border: 0;
            background: transparent;
            color: var(--color-foreground);
            cursor: pointer;
            border-radius: 8px;
        }
        .agri1-combo-toggle:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-combo-list {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            left: 0;
            z-index: 20;
            max-height: 240px;
            overflow-y: auto;
            margin: 0;
            padding: 6px 0;
            list-style: none;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        .agri1-combo-list.is-open { display: block; }

        .agri1-combo-option {
            min-height: var(--touch);
            padding: 10px 16px;
            cursor: pointer;
            color: var(--color-foreground);
        }
        .agri1-combo-option:hover,
        .agri1-combo-option.is-active {
            background: #ECFDF3;
        }
        .agri1-combo-empty {
            padding: 12px 14px;
            color: var(--color-muted-foreground);
        }

        .agri1-select { position: relative; }

        .agri1-page .agri1-form select.agri1-select-native {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            clip-path: inset(50%);
            border: 0;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            background-image: none;
        }

        .agri1-select-trigger {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: var(--touch);
            margin: 0;
            padding: 10px 16px 10px 44px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.5;
            text-align: right;
            cursor: pointer;
            box-shadow: none;
        }
        .agri1-select-trigger:hover {
            background: var(--color-card);
            color: var(--color-foreground);
        }
        .agri1-select-trigger:focus,
        .agri1-select-trigger:focus-visible {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }
        .agri1-select-trigger[aria-invalid="true"] {
            border-color: var(--color-destructive);
        }
        .agri1-select-trigger:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .agri1-select-value {
            flex: 1 1 auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .agri1-select .agri1-combo-toggle {
            pointer-events: none;
        }

        .agri1-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 0;
            color: var(--color-destructive);
            font-size: 0.875rem;
        }

        .is-hidden { display: none !important; }

        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: var(--space-2);
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-accent {
            background: var(--color-accent);
            color: var(--color-on-accent);
        }
        .agri1-btn-accent:hover { background: #854D0E; }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }

        .agri1-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 80;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.55);
        }
        .agri1-overlay.is-open { display: flex !important; }

        .agri1-overlay-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 220px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: agri1-spin 0.8s linear infinite;
        }

        @keyframes agri1-spin { to { transform: rotate(360deg); } }

        .agri1-info {
            min-height: var(--touch);
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--color-muted);
            color: var(--color-foreground);
        }
        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-grid-break { grid-column: 1; }
        .agri1-note {
            margin-bottom: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly] {
            background: #FFFBEB;
        }
        .agri1-prod-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-top: 8px;
        }
        .agri1-prod {
            width: 100%;
            min-width: 980px;
            border-collapse: collapse;
            table-layout: auto;
        }
        .agri1-prod th,
        .agri1-prod td {
            border: 1px solid var(--color-border);
            padding: 6px 4px;
            vertical-align: top;
            font-size: 0.8125rem;
        }
        .agri1-prod th {
            background: var(--color-primary);
            color: var(--color-on-primary);
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
        }
        .agri1-prod td .agri1-error { margin-top: 4px; font-size: 0.75rem; }
        .agri1-page .agri1-form .agri1-prod input[type="text"],
        .agri1-page .agri1-form .agri1-prod select {
            min-height: 36px;
            padding: 6px 8px;
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#<?php echo $show_step2 ? 'form1' : 'agri2-form'; ?>">رفتن به فرم ثبت</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri2-title"><?php echo $show_step2 ? 'ثبت قطعه باغی جدید' : 'ثبت اطلاعات بهره‌برداری باغی جدید'; ?></h1>
            <ol class="agri1-steps" aria-label="مراحل ثبت">
                <?php if ($show_step2) { ?>
                <li class="is-link">
                    <button type="submit" class="agri1-step-btn" form="agri2-back">
                        <span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه
                    </button>
                </li>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
                <?php } else { ?>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه</li>
                <li><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
                <?php } ?>
            </ol>
        </header>

        <section class="agri1-card" aria-labelledby="agri2-title">
            <?php if ($show_step2) { ?>
                <form id="agri2-back" method="post" action="Garden.php" class="is-hidden" aria-hidden="true">
                    <input type="hidden" name="agri_step" value="1"/>
                    <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo agri2_h(($add_city == '-') ? '' : $add_city); ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo agri2_h(($add_abadi == '-') ? '' : $add_abadi); ?>"/>
                    <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                    <input type="hidden" name="no_kesh" value="<?php echo agri2_h($no_kesh); ?>"/>
                    <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($nah_kesh); ?>"/>
                    <input type="hidden" name="t_mah" value="<?php echo agri2_h($t_mah); ?>"/>
                    <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                    <input type="hidden" name="num_bah" value="<?php echo agri2_h($num_bah); ?>"/>
                </form>

                <div class="agri1-alert<?php echo $has_step2_errors ? '' : ' is-hidden'; ?>" id="agri2-error-summary" role="alert" tabindex="-1" aria-labelledby="agri2-error-title" <?php if (!$has_step2_errors) echo 'hidden'; ?>>
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri2-error-title"><?php echo ($place_err != '') ? 'موقعیت بهره‌برداری نیاز به اصلاح دارد' : 'لطفاً موارد زیر را تکمیل کنید'; ?></h2>
                        <?php if ($place_err != '') { ?>
                            <p><?php echo agri2_h($place_err); ?></p>
                            <p><button type="submit" class="agri1-btn agri1-btn-ghost" form="agri2-back">اصلاح موقعیت در مشخصات اولیه</button></p>
                        <?php } ?>
                        <ul id="agri2-error-list">
                            <?php if (!empty($field_errors)) { foreach ($field_errors as $fid => $ferr) { ?>
                                <li><a href="#field-<?php echo agri2_h($fid); ?>"><?php echo agri2_h($ferr); ?></a></li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
                <div><?php sar_data2($bah_cod_m, $num_bah); ?></div>

                <form action="Garden.php" method="post" id="form1" name="form1" class="agri1-form" novalidate>
                    <h2 class="agri1-card-title">موقعیت بهره‌برداری</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">استان</span>
                            <div class="agri1-info"><?php echo ostan_name($id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">شهرستان</span>
                            <div class="agri1-info"><?php echo city_name1($id_city, $id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">مرکز جهاد کشاورزی</span>
                            <div class="agri1-info"><?php echo mar_name($id_mar); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">آبادی / شهر</span>
                            <div class="agri1-info"><?php echo abadi_name($add_abadi); ?></div>
                        </div>
                    </div>

                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات زمین</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نحوه کاشت</span>
                            <div class="agri1-info"><?php echo agri2_h($v_nah_kesh); ?></div>
                        </div>
                        <?php if (!$garden_scattered) { ?>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نوع کشت</span>
                            <div class="agri1-info"><?php echo agri2_h($v_no_kesh); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نوع مالکیت</span>
                            <div class="agri1-info"><?php echo agri2_h($v_no_mal); ?></div>
                        </div>
                        <div class="agri1-field agri1-grid-break" style="margin-top:0" id="field-lng">
                            <label class="agri1-label" for="lng">طول جغرافیایی X</label>
                            <input name="lng" type="text" id="lng" dir="ltr" lang="fa" inputmode="decimal" value="<?php if (isset($lng)) echo agri2_h($lng); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['lng']) ? 'true' : 'false'; ?>"
                                   aria-describedby="hint-lng<?php echo isset($field_errors['lng']) ? ' error-lng' : ''; ?>"/>
                            <p class="agri1-hint" id="hint-lng">درجه اعشار — مثال: 46.212486 — اگر مختصات ندارید صفر بزنید</p>
                            <p class="agri1-error<?php echo isset($field_errors['lng']) ? '' : ' is-hidden'; ?>" id="error-lng"><?php echo isset($field_errors['lng']) ? agri2_h($field_errors['lng']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-lat">
                            <label class="agri1-label" for="lat">عرض جغرافیایی Y</label>
                            <input name="lat" type="text" id="lat" dir="ltr" lang="fa" inputmode="decimal" value="<?php if (isset($lat)) echo agri2_h($lat); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['lat']) ? 'true' : 'false'; ?>"
                                   aria-describedby="hint-lat<?php echo isset($field_errors['lat']) ? ' error-lat' : ''; ?>"/>
                            <p class="agri1-hint" id="hint-lat">درجه اعشار — مثال: 37.010521 — اگر مختصات ندارید صفر بزنید</p>
                            <p class="agri1-error<?php echo isset($field_errors['lat']) ? '' : ' is-hidden'; ?>" id="error-lat"><?php echo isset($field_errors['lat']) ? agri2_h($field_errors['lat']) : ''; ?></p>
                        </div>
                        <div class="agri1-field agri1-grid-break" style="margin-top:0" id="field-m_zamin">
                            <label class="agri1-label" for="m_zamin">مساحت زمین (هکتار)</label>
                            <input name="m_zamin" type="text" id="m_zamin" class="m_zamin" dir="ltr" lang="fa" inputmode="decimal" value="<?php if (isset($m_zamin)) echo agri2_h($m_zamin); ?>" maxlength="11"
                                   aria-invalid="<?php echo isset($field_errors['m_zamin']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_zamin']) ? 'error-m_zamin' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_zamin']) ? '' : ' is-hidden'; ?>" id="error-m_zamin"><?php echo isset($field_errors['m_zamin']) ? agri2_h($field_errors['m_zamin']) : ''; ?></p>
                        </div>
                        <?php } ?>
                    </div>

                    <?php if (!$garden_scattered) { ?>
                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات مالک</h2>
                    <?php if ($no_mal <> 7) { ?>
                    <p class="agri1-note">اطلاعات بهره‌بردار <?php echo agri2_h($v_co_name); ?> بعنوان مالک ثبت خواهد شد</p>
                    <?php } ?>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-m_cod_m">
                            <label class="agri1-label" for="m_cod_m">کد ملی مالک</label>
                            <input name="m_cod_m" type="text" class="Mcod_m<?php echo $agri_ro_class; ?>" id="m_cod_m" dir="ltr" value="<?php echo agri2_h($m_cod_m); ?>" maxlength="12"<?php echo $agri_ro; ?>
                                   aria-invalid="<?php echo isset($field_errors['m_cod_m']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_cod_m']) ? 'error-m_cod_m' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_cod_m']) ? '' : ' is-hidden'; ?>" id="error-m_cod_m"><?php echo isset($field_errors['m_cod_m']) ? agri2_h($field_errors['m_cod_m']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <label class="agri1-label" for="m_jens">جنسیت</label>
                            <select name="m_jens" class="mar" id="m_jens">
                                <option value="1" <?php if (isset($m_jens) && $m_jens == '1') echo 'selected="selected"'; ?>>مرد</option>
                                <option value="2" <?php if (isset($m_jens) && $m_jens == '2') echo 'selected="selected"'; ?>>زن</option>
                            </select>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_name">
                            <label class="agri1-label" for="m_name">نام</label>
                            <input name="m_name" type="text" class="<?php echo $agri_ro_class; ?>" id="m_name" value="<?php echo agri2_h($m_name); ?>" maxlength="75"<?php echo $agri_ro; ?>
                                   aria-invalid="<?php echo isset($field_errors['m_name']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_name']) ? 'error-m_name' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_name']) ? '' : ' is-hidden'; ?>" id="error-m_name"><?php echo isset($field_errors['m_name']) ? agri2_h($field_errors['m_name']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_last_name">
                            <label class="agri1-label" for="m_last_name">نام خانوادگی</label>
                            <input name="m_last_name" type="text" class="<?php echo $agri_ro_class; ?>" id="m_last_name" value="<?php echo agri2_h($m_last_name); ?>" maxlength="70"<?php echo $agri_ro; ?>
                                   aria-invalid="<?php echo isset($field_errors['m_last_name']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_last_name']) ? 'error-m_last_name' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_last_name']) ? '' : ' is-hidden'; ?>" id="error-m_last_name"><?php echo isset($field_errors['m_last_name']) ? agri2_h($field_errors['m_last_name']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_fname">
                            <label class="agri1-label" for="m_fname"><?php if ($no_bah == 2) echo 'نام شرکت'; else echo 'نام پدر'; ?></label>
                            <input name="m_fname" type="text" class="<?php echo $agri_ro_class; ?>" id="m_fname" value="<?php if ($no_bah == 2) echo agri2_h($co_name); else echo agri2_h($m_fname); ?>" maxlength="75"<?php echo $agri_ro; ?>
                                   aria-invalid="<?php echo isset($field_errors['m_fname']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_fname']) ? 'error-m_fname' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_fname']) ? '' : ' is-hidden'; ?>" id="error-m_fname"><?php echo isset($field_errors['m_fname']) ? agri2_h($field_errors['m_fname']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_tel_m">
                            <label class="agri1-label" for="m_tel_m">تلفن همراه</label>
                            <input name="m_tel_m" type="text" id="m_tel_m" dir="ltr" inputmode="numeric" value="<?php echo agri2_h($m_tel_m); ?>" maxlength="11"<?php echo $agri_ro; ?>
                                   aria-invalid="<?php echo isset($field_errors['m_tel_m']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['m_tel_m']) ? 'error-m_tel_m' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['m_tel_m']) ? '' : ' is-hidden'; ?>" id="error-m_tel_m"><?php echo isset($field_errors['m_tel_m']) ? agri2_h($field_errors['m_tel_m']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_vaz_sok">
                            <label class="agri1-label" for="m_vaz_sok">وضعیت سکونت مالک</label>
                            <select name="m_vaz_sok" id="m_vaz_sok"
                                    aria-invalid="<?php echo isset($field_errors['m_vaz_sok']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['m_vaz_sok']) ? 'error-m_vaz_sok' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if (isset($m_vaz_sok) && $m_vaz_sok == '1') echo 'selected="selected"'; ?>>ساکن</option>
                                <option value="2" <?php if (isset($m_vaz_sok) && $m_vaz_sok == '2') echo 'selected="selected"'; ?>>غیرساکن</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['m_vaz_sok']) ? '' : ' is-hidden'; ?>" id="error-m_vaz_sok"><?php echo isset($field_errors['m_vaz_sok']) ? agri2_h($field_errors['m_vaz_sok']) : ''; ?></p>
                        </div>
                    </div>

                    <?php if ($no_kesh == '1') { ?>
                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات آب</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-m_ab">
                            <label class="agri1-label" for="m_ab">منبع آب</label>
                            <select name="m_ab" id="m_ab"
                                    aria-invalid="<?php echo isset($field_errors['m_ab']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['m_ab']) ? 'error-m_ab' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if (isset($m_ab) and $m_ab == '1') echo 'selected="selected"'; ?>>چشمه</option>
                                <option value="2" <?php if (isset($m_ab) and $m_ab == '2') echo 'selected="selected"'; ?>>قنات</option>
                                <option value="3" <?php if (isset($m_ab) and $m_ab == '3') echo 'selected="selected"'; ?>>رودخانه</option>
                                <option value="4" <?php if (isset($m_ab) and $m_ab == '4') echo 'selected="selected"'; ?>>سد</option>
                                <option value="5" <?php if (isset($m_ab) and $m_ab == '5') echo 'selected="selected"'; ?>>چاه سطحی</option>
                                <option value="6" <?php if (isset($m_ab) and $m_ab == '6') echo 'selected="selected"'; ?>>چاه عمیق</option>
                                <option value="7" <?php if (isset($m_ab) and $m_ab == '7') echo 'selected="selected"'; ?>>چاه نیمه عمیق</option>
                                <option value="8" <?php if (isset($m_ab) and $m_ab == '8') echo 'selected="selected"'; ?>>زهکش</option>
                                <option value="9" <?php if (isset($m_ab) and $m_ab == '9') echo 'selected="selected"'; ?>>پساب</option>
                                <option value="10" <?php if (isset($m_ab) and $m_ab == '10') echo 'selected="selected"'; ?>>آب بندان</option>
                                <option value="11" <?php if (isset($m_ab) and $m_ab == '11') echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['m_ab']) ? '' : ' is-hidden'; ?>" id="error-m_ab"><?php echo isset($field_errors['m_ab']) ? agri2_h($field_errors['m_ab']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-md_ab">
                            <label class="agri1-label" for="md_ab">مدار آبیاری (شبانه روز)</label>
                            <input name="md_ab" type="text" id="md_ab" dir="ltr" inputmode="decimal" value="<?php if (isset($md_ab)) echo agri2_h($md_ab); ?>" maxlength="2"
                                   aria-invalid="<?php echo isset($field_errors['md_ab']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['md_ab']) ? 'error-md_ab' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['md_ab']) ? '' : ' is-hidden'; ?>" id="error-md_ab"><?php echo isset($field_errors['md_ab']) ? agri2_h($field_errors['md_ab']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-h_ab">
                            <label class="agri1-label" for="h_ab">حقابه (ساعت)</label>
                            <input name="h_ab" type="text" id="h_ab" dir="ltr" inputmode="decimal" value="<?php if (isset($h_ab)) echo agri2_h($h_ab); ?>" maxlength="4"
                                   aria-invalid="<?php echo isset($field_errors['h_ab']) ? 'true' : 'false'; ?>"
                                   aria-describedby="<?php echo isset($field_errors['h_ab']) ? 'error-h_ab' : ''; ?>"/>
                            <p class="agri1-error<?php echo isset($field_errors['h_ab']) ? '' : ' is-hidden'; ?>" id="error-h_ab"><?php echo isset($field_errors['h_ab']) ? agri2_h($field_errors['h_ab']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-no_sab">
                            <label class="agri1-label" for="no_sab">نوع سند حقابه</label>
                            <select name="no_sab" id="no_sab"
                                    aria-invalid="<?php echo isset($field_errors['no_sab']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['no_sab']) ? 'error-no_sab' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if (isset($no_sab) && ($no_sab == '1')) echo 'selected="selected"'; ?>>پروانه بهره برداری</option>
                                <option value="2" <?php if (isset($no_sab) && ($no_sab == '2')) echo 'selected="selected"'; ?>>مجوز آب</option>
                                <option value="3" <?php if (isset($no_sab) && ($no_sab == '3')) echo 'selected="selected"'; ?>>عرفی</option>
                                <option value="4" <?php if (isset($no_sab) && ($no_sab == '4')) echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['no_sab']) ? '' : ' is-hidden'; ?>" id="error-no_sab"><?php echo isset($field_errors['no_sab']) ? agri2_h($field_errors['no_sab']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-no_ab">
                            <label class="agri1-label" for="no_ab">نحوه آبیاری</label>
                            <select name="no_ab" id="no_ab"
                                    aria-invalid="<?php echo isset($field_errors['no_ab']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['no_ab']) ? 'error-no_ab' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if (isset($no_ab) and $no_ab == '1') echo 'selected="selected"'; ?>>جوی و پشته</option>
                                <option value="2" <?php if (isset($no_ab) and $no_ab == '2') echo 'selected="selected"'; ?>>نواری</option>
                                <option value="3" <?php if (isset($no_ab) and $no_ab == '3') echo 'selected="selected"'; ?>>غرقابی</option>
                                <option value="4" <?php if (isset($no_ab) and $no_ab == '4') echo 'selected="selected"'; ?>>تشتکی</option>
                                <option value="5" <?php if (isset($no_ab) and $no_ab == '5') echo 'selected="selected"'; ?>>تحت فشار قطره ای</option>
                                <option value="6" <?php if (isset($no_ab) and $no_ab == '6') echo 'selected="selected"'; ?>>تحت فشار بارانی</option>
                                <option value="7" <?php if (isset($no_ab) and $no_ab == '7') echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['no_ab']) ? '' : ' is-hidden'; ?>" id="error-no_ab"><?php echo isset($field_errors['no_ab']) ? agri2_h($field_errors['no_ab']) : ''; ?></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-es">
                            <label class="agri1-label" for="es">وضعیت استخر</label>
                            <select name="es" id="es"
                                    aria-invalid="<?php echo isset($field_errors['es']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['es']) ? 'error-es' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if (isset($es) and $es == '1') echo 'selected="selected"'; ?>>ندارد</option>
                                <option value="2" <?php if (isset($es) and $es == '2') echo 'selected="selected"'; ?>>دارد / جهت ذخیره آب</option>
                                <option value="3" <?php if (isset($es) and $es == '3') echo 'selected="selected"'; ?>>دارد - دو منظوره</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['es']) ? '' : ' is-hidden'; ?>" id="error-es"><?php echo isset($field_errors['es']) ? agri2_h($field_errors['es']) : ''; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <div class="agri1-grid" style="margin-top:24px">
                        <div class="agri1-field" style="margin-top:0" id="field-z_sal">
                            <label class="agri1-label" for="z_sal">سال</label>
                            <select name="z_sal" id="z_sal"
                                    aria-invalid="<?php echo isset($field_errors['z_sal']) ? 'true' : 'false'; ?>"
                                    aria-describedby="<?php echo isset($field_errors['z_sal']) ? 'error-z_sal' : ''; ?>">
                                <option value="">انتخاب کنید</option>
                                <option value="1405" <?php if (isset($z_sal) && $z_sal == '1405') echo 'selected="selected"'; ?>>1405</option>
                            </select>
                            <p class="agri1-error<?php echo isset($field_errors['z_sal']) ? '' : ' is-hidden'; ?>" id="error-z_sal"><?php echo isset($field_errors['z_sal']) ? agri2_h($field_errors['z_sal']) : ''; ?></p>
                        </div>
                    </div>

                                        <div class="agri1-actions">
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri2_h($bah_cod_m); ?>"/>
                        <input type="hidden" name="num_bah" value="<?php echo agri2_h($num_bah); ?>"/>
                        <input type="hidden" name="m_poul" value="<?php echo agri2_h($m_poul); ?>"/>
                        <input type="hidden" name="id_ostan" value="<?php echo agri2_h($id_ostan); ?>"/>
                        <input type="hidden" name="id_city" value="<?php echo agri2_h($id_city); ?>"/>
                        <input type="hidden" name="add_abadi" value="<?php echo agri2_h($add_abadi); ?>"/>
                        <input type="hidden" name="add_city" value="<?php echo agri2_h($add_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri2_h($id_mar); ?>"/>
                        <input type="hidden" name="check_cod" value="<?php echo agri2_h($check_cod); ?>"/>
                        <input type="hidden" name="no_kesh" value="<?php echo agri2_h($no_kesh); ?>"/>
                        <input type="hidden" name="nah_kesh" value="<?php echo agri2_h($nah_kesh); ?>"/>
                        <input type="hidden" name="t_mah" value="<?php echo agri2_h($t_mah); ?>"/>
                        <input type="hidden" name="no_mal" value="<?php echo agri2_h($no_mal); ?>"/>
                        <?php if ($place_ok) { ?>
                        <button type="submit" name="action" value="ثبت اطلاعات" class="agri1-btn agri1-btn-primary" id="submit">ثبت اطلاعات</button>
                        <?php } ?>
                        <button type="submit" class="agri1-btn agri1-btn-ghost" form="agri2-back" id="agri2-back-btn">بازگشت به مشخصات اولیه</button>
                    </div>
                </form>
            <?php } else { ?>
            <?php if ($has_errors) { ?>
                <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1" aria-labelledby="agri1-error-title">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri1-error-title"><?php echo isset($not_found_bah) ? 'بهره‌بردار یافت نشد' : 'لطفاً موارد زیر را تکمیل کنید'; ?></h2>
                        <?php if (isset($not_found_bah)) { ?>
                            <p>برای ثبت اطلاعات بهره‌برداری باغی، ابتدا اطلاعات بهره‌بردار را ثبت کنید.</p>
                        <?php } elseif (!empty($field_errors)) { ?>
                            <ul>
                                <?php foreach ($field_errors as $fid => $ferr) { ?>
                                    <li><a href="#field-<?php echo agri2_h($fid); ?>"><?php echo agri2_h($ferr); ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <form id="agri2-form" class="agri1-form" method="post" action="Garden.php" novalidate>
                <fieldset class="agri1-fieldset<?php echo $err_m_poul ? ' is-invalid' : ''; ?>" id="field-m_poul">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        موقعیت بهره‌برداری
                    </legend>
                    <p class="agri1-hint" id="hint-m_poul">محل را انتخاب کنید؛ سپس نام شهر یا آبادی را جستجو و از فهرست برگزینید.</p>
                    <div class="agri1-choices" role="radiogroup" aria-labelledby="field-m_poul" aria-describedby="hint-m_poul<?php echo $err_m_poul ? ' error-m_poul' : ''; ?>">
                        <label class="agri1-choice<?php if ($m_poul == 'shahr') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="shahr"
                                <?php if ($m_poul == 'shahr') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>شهر</span>
                        </label>
                        <label class="agri1-choice<?php if ($m_poul == 'abadi') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="abadi"
                                <?php if ($m_poul == 'abadi') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>آبادی</span>
                        </label>
                    </div>
                    <?php if ($err_m_poul) { ?>
                        <p class="agri1-error" id="error-m_poul"><?php echo agri2_h($field_errors['m_poul']); ?></p>
                    <?php } ?>

                    <div class="agri1-field shahr_wrap<?php echo $show_city ? '' : ' is-hidden'; ?>" id="field-add_city">
                        <label class="agri1-label" for="add_city_text">نام شهر</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_city_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="city_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_city ? 'true' : 'false'; ?>"
                                   value="<?php echo agri2_h($city_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="city_arrow" aria-label="نمایش فهرست شهرها" aria-controls="city_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="city_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_city" id="add_city_hidden" value="<?php echo agri2_h($add_city); ?>"/>
                        <p class="agri1-error<?php echo $err_city ? '' : ' is-hidden'; ?>" id="error-add_city"><?php echo $err_city ? agri2_h($field_errors['add_city']) : 'لطفاً یک شهر را از فهرست انتخاب کنید'; ?></p>
                    </div>

                    <div class="agri1-field abadi_wrap<?php echo $show_abadi ? '' : ' is-hidden'; ?>" id="field-add_abadi">
                        <label class="agri1-label" for="add_abadi_text">نام آبادی</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_abadi_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="abadi_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_abadi ? 'true' : 'false'; ?>"
                                   value="<?php echo agri2_h($abadi_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="abadi_arrow" aria-label="نمایش فهرست آبادی‌ها" aria-controls="abadi_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="abadi_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_abadi" id="add_abadi_hidden" value="<?php echo agri2_h($add_abadi); ?>"/>
                        <p class="agri1-error<?php echo $err_abadi ? '' : ' is-hidden'; ?>" id="error-add_abadi"><?php echo $err_abadi ? agri2_h($field_errors['add_abadi']) : 'لطفاً یک آبادی را از فهرست انتخاب کنید'; ?></p>
                    </div>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-bah_cod_m">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        مشخصات بهره‌بردار
                    </legend>
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار / مدیرعامل</label>
                    <p class="agri1-hint" id="hint-bah_cod_m">کد ملی ثبت‌شده در سامانه را وارد کنید.</p>
                    <input name="bah_cod_m" id="bah_cod_m" type="text" inputmode="numeric" maxlength="12" dir="ltr"
                           autocomplete="off"
                           value="<?php echo isset($_POST['bah_cod_m']) ? agri2_h($bah_cod_m) : ''; ?>"
                           aria-invalid="<?php echo $err_cod ? 'true' : 'false'; ?>"
                           aria-describedby="hint-bah_cod_m<?php echo $err_cod ? ' error-bah_cod_m' : ''; ?>"/>
                    <?php if ($err_cod) { ?>
                        <p class="agri1-error" id="error-bah_cod_m"><?php echo agri2_h($field_errors['bah_cod_m']); ?></p>
                    <?php } ?>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-nah_kesh">
                    <legend class="agri1-legend">نحوه کاشت</legend>
                    <label class="agri1-label" for="nah_kesh">ساده، مخلوط یا درختان پراکنده</label>
                    <select name="nah_kesh" id="nah_kesh" dir="rtl"
                            aria-invalid="<?php echo $err_nah ? 'true' : 'false'; ?>"
                            aria-describedby="<?php echo $err_nah ? 'error-nah_kesh' : ''; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if ($nah_kesh == '1') echo 'selected="selected"'; ?>>ساده</option>
                        <option value="2" <?php if ($nah_kesh == '2') echo 'selected="selected"'; ?>>مخلوط</option>
                        <option value="3" <?php if ($nah_kesh == '3') echo 'selected="selected"'; ?>>درختان پراکنده</option>
                    </select>
                    <?php if ($err_nah) { ?>
                        <p class="agri1-error" id="error-nah_kesh"><?php echo agri2_h($field_errors['nah_kesh']); ?></p>
                    <?php } ?>
                </fieldset>

                <div id="garden-kash-fields" class="<?php echo garden_is_scattered($nah_kesh) ? 'is-hidden' : ''; ?>">
                <fieldset class="agri1-fieldset<?php echo $err_kesh ? ' is-invalid' : ''; ?>" id="field-no_kesh">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 22V8"></path>
                            <path d="M5 12s2.5-7 7-7 7 7 7 7"></path>
                            <path d="M5 22h14"></path>
                        </svg>
                        نوع کشت
                    </legend>
                    <div class="agri1-choices" role="radiogroup" aria-labelledby="field-no_kesh"
                         aria-describedby="<?php echo $err_kesh ? 'error-no_kesh' : ''; ?>">
                        <label class="agri1-choice<?php if ($no_kesh == '1') echo ' is-selected'; ?>">
                            <input type="radio" name="no_kesh" value="1"
                                <?php if ($no_kesh == '1') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>آبی</span>
                        </label>
                        <label class="agri1-choice<?php if ($no_kesh == '2') echo ' is-selected'; ?>">
                            <input type="radio" name="no_kesh" value="2"
                                <?php if ($no_kesh == '2') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>دیم</span>
                        </label>
                    </div>
                    <?php if ($err_kesh) { ?>
                        <p class="agri1-error" id="error-no_kesh"><?php echo agri2_h($field_errors['no_kesh']); ?></p>
                    <?php } ?>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-no_mal">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <path d="M14 2v6h6"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                            <path d="M10 9H8"></path>
                        </svg>
                        نوع مالکیت
                    </legend>
                    <label class="agri1-label" for="no_mal">سند یا مبنای مالکیت قطعه</label>
                    <select name="no_mal" id="no_mal" dir="rtl"
                            aria-invalid="<?php echo $err_mal ? 'true' : 'false'; ?>"
                            aria-describedby="<?php echo $err_mal ? 'error-no_mal' : ''; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="0" <?php if ($no_mal == '0') echo 'selected="selected"'; ?>>------</option>
                        <option value="1" <?php if ($no_mal == '1') echo 'selected="selected"'; ?>>سند ششدانگ</option>
                        <option value="2" <?php if ($no_mal == '2') echo 'selected="selected"'; ?>>سند مشاعی</option>
                        <option value="3" <?php if ($no_mal == '3') echo 'selected="selected"'; ?>>اصلاحات اراضی</option>
                        <option value="4" <?php if ($no_mal == '4') echo 'selected="selected"'; ?>>موقوفه</option>
                        <option value="5" <?php if ($no_mal == '5') echo 'selected="selected"'; ?>>واگذاری</option>
                        <option value="6" <?php if ($no_mal == '6') echo 'selected="selected"'; ?>>قولنامه</option>
                        <option value="7" <?php if ($no_mal == '7') echo 'selected="selected"'; ?>>اجاره</option>
                        <option value="8" <?php if ($no_mal == '8') echo 'selected="selected"'; ?>>سایر</option>
                    </select>
                    <?php if ($err_mal) { ?>
                        <p class="agri1-error" id="error-no_mal"><?php echo agri2_h($field_errors['no_mal']); ?></p>
                    <?php } ?>
                </fieldset>
                </div>
                <div id="garden-kash-hidden">
                    <?php if (garden_is_scattered($nah_kesh)) { ?>
                    <input type="hidden" name="no_kesh" value="-"/>
                    <input type="hidden" name="no_mal" value="-"/>
                    <?php } ?>
                </div>

                <div class="agri1-actions">
                    <button id="sub" name="action" type="submit" class="agri1-btn agri1-btn-primary" value="ادامه">
                        ادامه
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 12H5"></path>
                            <path d="M12 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <?php if (isset($not_found_bah)) { ?>
                        <button name="action1" type="submit" class="agri1-btn agri1-btn-accent" value="ثبت اطلاعات بهره بردار">
                            ثبت اطلاعات بهره‌بردار
                            <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M19 8v6"></path>
                                <path d="M22 11h-6"></path>
                            </svg>
                        </button>
                    <?php } ?>
                </div>

                <input type="hidden" name="m_poul" id="m_poul_hidden" value="<?php echo agri2_h($m_poul); ?>"/>
                <input type="hidden" name="agri_h" value="1"/>
            </form>
            <?php } ?>
        </section>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="index.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </a>
        </p>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>

    <?php if (!$show_step2) { ?>
    <script>
        (function () {
            var cityData = <?php echo json_encode($city_data); ?>;
            var abadiData = <?php echo json_encode($abadi_data); ?>;
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('agri2-form');
            var submitBtn = document.getElementById('sub');
            var summary = document.getElementById('agri1-error-summary');
            var sending = false;

            function showOverlay() {
                if (!overlay) return;
                overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            }

            function syncChoiceState() {
                $('.agri1-choice').each(function () {
                    var input = $(this).find('input[type=radio]')[0];
                    if (input && input.checked) $(this).addClass('is-selected');
                    else $(this).removeClass('is-selected');
                });
            }

            function findExact(data, name) {
                var text = (name || '').replace(/^\s+|\s+$/g, '');
                for (var i = 0; i < data.length; i++) {
                    if (data[i].name === text) return data[i];
                }
                return null;
            }

            function closeList(list, input) {
                list.removeClass('is-open').attr('hidden', true);
                if (input) input.attr('aria-expanded', 'false');
            }

            function renderList(list, data, filterText, onPick) {
                list.empty();
                var filtered = data;
                if (filterText) {
                    filtered = [];
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].name.indexOf(filterText) !== -1) filtered.push(data[i]);
                    }
                }
                if (filtered.length === 0) {
                    list.append('<li class="agri1-combo-empty">موردی یافت نشد</li>');
                } else {
                    for (var j = 0; j < filtered.length; j++) {
                        var item = filtered[j];
                        var li = $('<li class="agri1-combo-option" role="option"></li>');
                        li.text(item.name);
                        li.attr('data-code', item.code);
                        li.attr('data-name', item.name);
                        list.append(li);
                    }
                    list.find('.agri1-combo-option').on('mousedown', function (e) {
                        e.preventDefault();
                        onPick($(this).attr('data-code'), $(this).attr('data-name'));
                    });
                }
                list.addClass('is-open').removeAttr('hidden');
            }

            function setupCombo(opts) {
                var input = $(opts.input);
                var hidden = $(opts.hidden);
                var list = $(opts.list);
                var arrow = $(opts.arrow);
                var data = opts.data;

                function openList() {
                    renderList(list, data, input.val(), function (code, name) {
                        input.val(name);
                        hidden.val(code);
                        input.attr('aria-invalid', 'false');
                        $(opts.error).addClass('is-hidden');
                        closeList(list, input);
                    });
                    input.attr('aria-expanded', 'true');
                }

                input.on('focus click', function () { openList(); });
                input.on('input', function () {
                    var match = findExact(data, input.val());
                    hidden.val(match ? match.code : '');
                    openList();
                });
                input.on('keydown', function (e) {
                    if (e.keyCode === 27) closeList(list, input);
                });
                arrow.on('click', function (e) {
                    e.preventDefault();
                    if (list.hasClass('is-open')) closeList(list, input);
                    else {
                        input.focus();
                        openList();
                    }
                });
            }

            function showFieldError(id, show) {
                var el = document.getElementById(id);
                if (!el) return;
                if (show) el.className = 'agri1-error';
                else el.className = 'agri1-error is-hidden';
            }

            if (summary) summary.focus();

            if (form) {
                form.addEventListener('submit', function (e) {
                    var submitter = e.submitter || document.activeElement;
                    if (submitter && submitter.getAttribute('name') === 'action1') return;

                    var region = form.querySelector('input.region:checked');
                    var hiddenRegion = document.getElementById('m_poul_hidden');
                    if (region && hiddenRegion) hiddenRegion.value = region.value;

                    var selectedType = region ? region.value : (hiddenRegion ? hiddenRegion.value : '');
                    var cityCode = document.getElementById('add_city_hidden').value;
                    var abadiCode = document.getElementById('add_abadi_hidden').value;
                    var ok = true;

                    if (selectedType === 'shahr' && (!cityCode || cityCode === '')) {
                        showFieldError('error-add_city', true);
                        document.getElementById('add_city_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }
                    if (selectedType === 'abadi' && (!abadiCode || abadiCode === '')) {
                        showFieldError('error-add_abadi', true);
                        document.getElementById('add_abadi_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }

                    if (!ok) {
                        e.preventDefault();
                        sending = false;
                        return;
                    }

                    if (sending) {
                        e.preventDefault();
                        return;
                    }
                    sending = true;
                    showOverlay();
                });
            }

            $(document).ready(function () {
                syncChoiceState();

                setupCombo({
                    input: '#add_city_text',
                    hidden: '#add_city_hidden',
                    list: '#city_dropdown',
                    arrow: '#city_arrow',
                    error: '#error-add_city',
                    data: cityData
                });
                setupCombo({
                    input: '#add_abadi_text',
                    hidden: '#add_abadi_hidden',
                    list: '#abadi_dropdown',
                    arrow: '#abadi_arrow',
                    error: '#error-add_abadi',
                    data: abadiData
                });

                $('.agri1-choice input[type=radio]').change(function () {
                    syncChoiceState();
                });

                $('input.region').change(function () {
                    $('#m_poul_hidden').val(this.value);
                    if (this.value == 'shahr') {
                        $('.shahr_wrap').removeClass('is-hidden');
                        $('.abadi_wrap').addClass('is-hidden');
                    } else if (this.value == 'abadi') {
                        $('.abadi_wrap').removeClass('is-hidden');
                        $('.shahr_wrap').addClass('is-hidden');
                    }
                });

                function syncKashFields() {
                    var nah = $('#nah_kesh').val();
                    var wrap = $('#garden-kash-fields');
                    var hid = $('#garden-kash-hidden');
                    if (nah === '3') {
                        wrap.addClass('is-hidden');
                        wrap.find('input, select').prop('disabled', true);
                        hid.html('<input type="hidden" name="no_kesh" value="-"/><input type="hidden" name="no_mal" value="-"/>');
                    } else {
                        wrap.removeClass('is-hidden');
                        wrap.find('input, select').prop('disabled', false);
                        hid.empty();
                    }
                }
                $('#nah_kesh').on('change', syncKashFields);
                syncKashFields();

                $(document).on('click', function (e) {
                    if (!$(e.target).closest('.agri1-combo').length) {
                        closeList($('#city_dropdown'), $('#add_city_text'));
                        closeList($('#abadi_dropdown'), $('#add_abadi_text'));
                    }
                });
            });
        })();
    </script>
    <?php } else { ?>
    <script>
        (function () {
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('form1');
            var submitBtn = document.getElementById('submit');
            var summary = document.getElementById('agri2-error-summary');
            var sending = false;

            function parseNum(v) {
                if (v == null) return null;
                v = String(v).replace(/[،,]/g, '.').replace(/^\s+|\s+$/g, '');
                if (v === '') return null;
                if (!/^-?\d+(\.\d+)?$/.test(v)) return false;
                return parseFloat(v);
            }

            function setFieldError(id, msg) {
                var el = document.getElementById(id);
                var err = document.getElementById('error-' + id);
                if (el) el.setAttribute('aria-invalid', msg ? 'true' : 'false');
                if (err) {
                    err.textContent = msg || '';
                    err.className = msg ? 'agri1-error' : 'agri1-error is-hidden';
                }
            }

            function val(id) {
                var el = document.getElementById(id);
                return el ? el.value : '';
            }

            function hasEl(id) {
                return !!document.getElementById(id);
            }

            function validateStep2() {
                var errors = {};
                if (hasEl('lng')) {
                    var lng = parseNum(val('lng'));
                    var lat = parseNum(val('lat'));
                    var mZamin = parseNum(val('m_zamin'));
                    if (lng === null) errors.lng = 'طول جغرافیایی را وارد کنید';
                    else if (lng === false) errors.lng = 'طول جغرافیایی باید عدد باشد';
                    else if (lng !== 0 && (lng < 40 || lng > 70)) errors.lng = 'طول جغرافیایی باید صفر یا بین ۴۰ تا ۷۰ باشد (مثال: ۴۶٫۲۱)';
                    if (lat === null) errors.lat = 'عرض جغرافیایی را وارد کنید';
                    else if (lat === false) errors.lat = 'عرض جغرافیایی باید عدد باشد';
                    else if (lat !== 0 && (lat < 20 || lat > 45)) errors.lat = 'عرض جغرافیایی باید صفر یا بین ۲۰ تا ۴۵ باشد (مثال: ۳۷٫۰۱)';
                    if (mZamin === null) errors.m_zamin = 'مساحت زمین را وارد کنید';
                    else if (mZamin === false) errors.m_zamin = 'مساحت زمین باید عدد باشد';
                    else if (mZamin <= 0) errors.m_zamin = 'مساحت زمین باید بزرگ‌تر از صفر باشد';
                    else if (mZamin > 5000) errors.m_zamin = 'مساحت زمین نمی‌تواند از ۵۰۰۰ هکتار بیشتر باشد';
                    if (!val('m_vaz_sok')) errors.m_vaz_sok = 'وضعیت سکونت مالک را انتخاب کنید';
                    if (!val('m_cod_m').replace(/^\s+|\s+$/g, '')) errors.m_cod_m = 'کد ملی مالک را وارد کنید';
                    if (!val('m_name').replace(/^\s+|\s+$/g, '')) errors.m_name = 'نام مالک را وارد کنید';
                    if (!val('m_last_name').replace(/^\s+|\s+$/g, '')) errors.m_last_name = 'نام خانوادگی مالک را وارد کنید';
                    if (!val('m_tel_m').replace(/^\s+|\s+$/g, '')) errors.m_tel_m = 'تلفن همراه را وارد کنید';
                    if (!val('m_fname').replace(/^\s+|\s+$/g, '')) errors.m_fname = 'این فیلد را تکمیل کنید';
                }
                if (!val('z_sal')) errors.z_sal = 'سال را انتخاب کنید';
                if (hasEl('m_ab')) {
                    if (!val('m_ab')) errors.m_ab = 'منبع آب را انتخاب کنید';
                    if (!val('md_ab').replace(/^\s+|\s+$/g, '')) errors.md_ab = 'مدار آبیاری را وارد کنید';
                    else if (parseNum(val('md_ab')) === false) errors.md_ab = 'مدار آبیاری باید عدد باشد';
                    if (!val('h_ab').replace(/^\s+|\s+$/g, '')) errors.h_ab = 'حقابه را وارد کنید';
                    else if (parseNum(val('h_ab')) === false) errors.h_ab = 'حقابه باید عدد باشد';
                    if (!val('no_sab')) errors.no_sab = 'نوع سند حقابه را انتخاب کنید';
                    if (!val('no_ab')) errors.no_ab = 'نحوه آبیاری را انتخاب کنید';
                    if (!val('es')) errors.es = 'وضعیت استخر را انتخاب کنید';
                }
                return errors;
            }

            function applyErrors(errors) {
                var ids = ['lng', 'lat', 'm_zamin', 'z_sal', 'm_vaz_sok', 'm_cod_m', 'm_name', 'm_last_name', 'm_fname', 'm_tel_m', 'm_ab', 'md_ab', 'h_ab', 'no_sab', 'no_ab', 'es'];
                var i, key;
                for (i = 0; i < ids.length; i++) {
                    setFieldError(ids[i], errors[ids[i]] || '');
                }
                if (summary) {
                    var title = document.getElementById('agri2-error-title');
                    var list = document.getElementById('agri2-error-list');
                    if (list) {
                        list.innerHTML = '';
                        for (key in errors) {
                            if (!errors.hasOwnProperty(key)) continue;
                            var li = document.createElement('li');
                            var a = document.createElement('a');
                            a.href = '#field-' + key;
                            a.appendChild(document.createTextNode(errors[key]));
                            li.appendChild(a);
                            list.appendChild(li);
                        }
                    }
                    if (title) title.textContent = 'لطفاً موارد زیر را تکمیل کنید';
                    summary.className = 'agri1-alert';
                    summary.removeAttribute('hidden');
                    try { summary.focus(); } catch (e) {}
                }
            }

            $(function () {
                if (summary && !summary.hasAttribute('hidden')) {
                    try { summary.focus(); } catch (e) {}
                }

                $('.Mcod_m').change(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'select_mar.php',
                        data: 'cod_m=' + $(this).val(),
                        cache: false,
                        success: function (html) {
                            $('.mar').html(html);
                        }
                    });
                });

                $('.m_zamin').on('change', function () {
                    var zamin = parseNum(val('m_zamin'));
                    if (typeof zamin === 'number' && zamin > 100) {
                        setFieldError('m_zamin', 'لطفاً از صحت مساحت بر حسب هکتار اطمینان حاصل کنید');
                    }
                });

                if (form) {
                    form.addEventListener('submit', function (e) {
                        if (sending) {
                            e.preventDefault();
                            return;
                        }
                        var errors = validateStep2();
                        var hasErr = false;
                        for (var k in errors) {
                            if (errors.hasOwnProperty(k)) { hasErr = true; break; }
                        }
                        if (hasErr) {
                            e.preventDefault();
                            applyErrors(errors);
                            var firstId = null;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) { firstId = key; break; }
                            }
                            var first = firstId ? document.getElementById(firstId) : null;
                            if (first && first.focus) first.focus();
                            return;
                        }
                        sending = true;
                        if (overlay) overlay.className = 'agri1-overlay is-open';
                        if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
                    });
                }
            });
        })();
    </script>
    <?php } ?>
    <script>
        (function () {
            var chevron = '<svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"></path></svg>';

            function closeComboLists(exceptWrap) {
                $('.agri1-combo').each(function () {
                    if (exceptWrap && this === exceptWrap) return;
                    var $wrap = $(this);
                    $wrap.find('.agri1-combo-list').removeClass('is-open').attr('hidden', true);
                    $wrap.find('[role="combobox"], .agri1-select-trigger').attr('aria-expanded', 'false');
                });
            }

            function selectedLabel(select) {
                var opt = select.options[select.selectedIndex];
                return opt ? String(opt.text || '').replace(/^\s+|\s+$/g, '') : '';
            }

            function enhanceSelect(select) {
                if (!select || select.getAttribute('data-agri-select') === '1') return;
                select.setAttribute('data-agri-select', '1');

                var $sel = $(select);
                $sel.addClass('agri1-select-native');
                $sel.wrap('<div class="agri1-combo agri1-select"></div>');
                var $wrap = $sel.parent();
                var sid = select.id || ('agri-select-' + String(Math.random()).slice(2));
                if (!select.id) select.id = sid;
                var listId = sid + '-list';
                var triggerId = sid + '-trigger';

                var $btn = $('<button type="button" class="agri1-select-trigger"></button>');
                $btn.attr({
                    id: triggerId,
                    'aria-haspopup': 'listbox',
                    'aria-expanded': 'false',
                    'aria-controls': listId
                });
                $btn.append('<span class="agri1-select-value"></span>');
                $btn.append($('<span class="agri1-combo-toggle" aria-hidden="true"></span>').html(chevron));

                var $list = $('<ul class="agri1-combo-list" role="listbox" hidden></ul>').attr('id', listId);
                $wrap.append($btn).append($list);

                var $value = $btn.find('.agri1-select-value');
                var activeIndex = -1;

                $('label[for="' + sid + '"]').attr('for', triggerId);

                function syncState() {
                    $btn.prop('disabled', !!select.disabled);
                    $btn.attr('aria-invalid', select.getAttribute('aria-invalid') === 'true' ? 'true' : 'false');
                    $wrap.toggleClass('is-disabled', !!select.disabled);
                }

                function highlight(index) {
                    var $opts = $list.find('.agri1-combo-option');
                    if (!$opts.length) return;
                    if (index < 0) index = $opts.length - 1;
                    if (index >= $opts.length) index = 0;
                    activeIndex = index;
                    $opts.removeClass('is-active').attr('aria-selected', 'false');
                    var $cur = $opts.eq(activeIndex);
                    $cur.addClass('is-active').attr('aria-selected', 'true');
                    var el = $cur.get(0);
                    if (el && el.scrollIntoView) el.scrollIntoView({ block: 'nearest' });
                }

                function renderOptions() {
                    $list.empty();
                    activeIndex = -1;
                    for (var i = 0; i < select.options.length; i++) {
                        var opt = select.options[i];
                        var $li = $('<li class="agri1-combo-option" role="option"></li>');
                        $li.text(opt.text);
                        $li.attr('data-value', opt.value);
                        $li.attr('data-index', String(i));
                        if (opt.disabled) $li.attr('aria-disabled', 'true');
                        if (opt.selected) {
                            $li.addClass('is-active').attr('aria-selected', 'true');
                            activeIndex = i;
                        }
                        $list.append($li);
                    }
                    var label = selectedLabel(select);
                    $value.text(label || '\u00a0');
                    syncState();
                }

                function closeList() {
                    $list.removeClass('is-open').attr('hidden', true);
                    $btn.attr('aria-expanded', 'false');
                }

                function openList() {
                    if (select.disabled) return;
                    closeComboLists($wrap.get(0));
                    renderOptions();
                    $list.addClass('is-open').removeAttr('hidden');
                    $btn.attr('aria-expanded', 'true');
                    if (activeIndex < 0) activeIndex = 0;
                    highlight(activeIndex);
                }

                function pickIndex(index) {
                    if (index < 0 || index >= select.options.length) return;
                    if (select.options[index].disabled) return;
                    select.selectedIndex = index;
                    $sel.trigger('change');
                    renderOptions();
                    closeList();
                    $btn.focus();
                }

                $btn.on('click', function (e) {
                    e.preventDefault();
                    if ($list.hasClass('is-open')) closeList();
                    else openList();
                });

                $btn.on('keydown', function (e) {
                    var key = e.key || e.keyCode;
                    if (key === 'Escape' || key === 27) {
                        if ($list.hasClass('is-open')) {
                            e.preventDefault();
                            closeList();
                        }
                        return;
                    }
                    if (key === 'ArrowDown' || key === 40) {
                        e.preventDefault();
                        if (!$list.hasClass('is-open')) openList();
                        else highlight(activeIndex + 1);
                        return;
                    }
                    if (key === 'ArrowUp' || key === 38) {
                        e.preventDefault();
                        if (!$list.hasClass('is-open')) openList();
                        else highlight(activeIndex - 1);
                        return;
                    }
                    if ((key === 'Enter' || key === 13 || key === ' ' || key === 'Spacebar' || key === 32) && $list.hasClass('is-open')) {
                        e.preventDefault();
                        pickIndex(activeIndex);
                    }
                });

                $list.on('mousedown', '.agri1-combo-option', function (e) {
                    e.preventDefault();
                    if ($(this).attr('aria-disabled') === 'true') return;
                    pickIndex(parseInt($(this).attr('data-index'), 10));
                });

                $sel.on('change.agriSelect', function () {
                    renderOptions();
                });

                if (window.MutationObserver) {
                    var mo = new MutationObserver(function () { renderOptions(); });
                    mo.observe(select, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        attributeFilter: ['disabled', 'aria-invalid']
                    });
                }

                renderOptions();
            }

            $(function () {
                $('.agri1-form select').each(function () { enhanceSelect(this); });
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.agri1-combo').length) closeComboLists(null);
                else closeComboLists($(e.target).closest('.agri1-combo').get(0));
            });
        })();
    </script>
</body>
</html>
