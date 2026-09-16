<?php
require_once("../lock_ce.php");
require_once("../event.php");
require_once('side_menu1.php');

// تغییرات اعمال شده: بررسی هر دو متد POST و GET
$ru_read = isset($_POST['ru_read']) ? $_POST['ru_read'] : (isset($_GET['ru_read']) ? $_GET['ru_read'] : '');
if ($ru_read !== '1' && $ru_read !== '2') {
    $ru_read = '';
}

// دریافت شماره صفحه
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// ========== جستجو ==========
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if (function_exists('mb_substr')) {
    if (mb_strlen($q, 'UTF-8') > 100) {
        $q = mb_substr($q, 0, 100, 'UTF-8');
    }
} elseif (strlen($q) > 100) {
    $q = substr($q, 0, 100);
}

// ========== بخش مرتب‌سازی ==========
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'desc';
$order_field = isset($_GET['order_field']) ? $_GET['order_field'] : 's_date';

// اعتبارسنجی
$allowed_fields = array('s_date', 's_time', 'title', 's_user');
$allowed_orders = array('asc', 'desc');

if (!in_array($order_field, $allowed_fields)) {
    $order_field = 's_date';
}
if (!in_array($order_by, $allowed_orders)) {
    $order_by = 'desc';
}

// آیکون‌ها
$s_date_icon = ($order_field == 's_date') ? (($order_by == 'asc') ? '🔼' : '🔽') : '↕️';
$s_time_icon = ($order_field == 's_time') ? (($order_by == 'asc') ? '🔼' : '🔽') : '↕️';
$title_icon = ($order_field == 'title') ? (($order_by == 'asc') ? '🔼' : '🔽') : '↕️';
$s_user_icon = ($order_field == 's_user') ? (($order_by == 'asc') ? '🔼' : '🔽') : '↕️';

// ساخت ORDER BY
if ($order_field == 's_date') {
    $order_sql = "ORDER BY s_date $order_by, s_time $order_by";
} else {
    $order_sql = "ORDER BY $order_field $order_by";
}
// ========== پایان مرتب‌سازی ==========

// پارامترهای مشترک برای لینک‌ها (فیلتر + جستجو + مرتب‌سازی)
$list_qs_params = array(
    'ru_read' => $ru_read,
    'order_field' => $order_field,
    'order_by' => $order_by,
);
if ($q !== '') {
    $list_qs_params['q'] = $q;
}
$list_qs = http_build_query($list_qs_params);
$q_h = htmlspecialchars($q, ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
    color: #003366;
    font-family: Tahoma;
    font-size: 18px;
}

/* ========== منوی اصلی ========== */
#menu {
    font-family: Tahoma;
    font-size: 13px;
    list-style: none;
    direction: rtl;
    width: 500px;
    line-height: 40px;
    background: #069;
    margin: 0 auto;
    border: 1px solid #990000;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
}

#menu li {
    display: inline-block;
    padding-left: 10px;
    padding-right: 10px;
}

#menu li:hover {
    background: #903;
    line-height: 40px;
    border-radius: 10px;
}

#menu li a {
    text-decoration: none;
    color: #FFF;
}

/* ========== تصاویر ========== */
#img1 {
    border-radius: 40px;
}

/* ========== محتوا ========== */
#content {
    width: 900px;
    margin: 0 auto;
    font-family: Arial, Helvetica, sans-serif;
}

/* ========== صفحه‌بندی ========== */
.page {
    float: right;
    margin: 0;
    padding: 0;
}
.page li {
    list-style: none;
    display: inline-block;
}
.page li a, .current {
    display: block;
    padding: 5px;
    text-decoration: none;
    color: #8A8A8A;
}
.current {
    font-weight: bold;
    color: #000;
}

/* ========== دکمه‌ها ========== */
.button {
    padding: 5px 15px;
    text-decoration: none;
    background: #333;
    color: #F3F3F3;
    font-size: 13px;
    border-radius: 2px;
    margin: 0 4px;
    display: block;
    float: left;
}

/* ========== جدول اصلی ========== */
.my-table {
    border-collapse: collapse;
    width: 90%;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.my-table th,
.my-table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.my-table thead th {
    background-color: #0099CC;
    color: white;
    font-weight: bold;
}

/* ========== ردیف‌های جدول ========== */
.my-table tbody tr:hover {
    background-color: #f5f5f5;
}

/* ========== متن چرخیده ========== */
.rotated-text {
    transform: rotate(-45deg);
    display: inline-block;
    font-size: 11px;
    color: #930;
}

/* ========== لینک‌های مرتب‌سازی ========== */
.sort-link {
    color: white;
    text-decoration: none;
    display: inline-block;
    padding: 3px 5px;
}
.sort-link:hover {
    background-color: #0077aa;
    border-radius: 5px;
}

/* ========== دکمه بازنشانی ========== */
.reset-btn {
    background: #06C;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 4px;
    margin-right: 10px;
    display: inline-block;
    font-size: 12px;
    border: 1px solid #0055aa;
}
.search-bar {
    width: 70%;
    margin: 12px auto 8px;
    text-align: center;
    font-family: Tahoma;
    direction: rtl;
}
.search-bar input[type="text"] {
    width: 55%;
    max-width: 420px;
    padding: 7px 10px;
    border: 1px solid #99c;
    border-radius: 4px;
    font-family: Tahoma;
    font-size: 13px;
}
.search-bar button {
    background: #069;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 7px 16px;
    font-family: Tahoma;
    font-size: 13px;
    cursor: pointer;
    margin-right: 6px;
}
.search-bar button:hover {
    background: #047;
}
.search-bar .clear-search {
    color: #903;
    font-size: 12px;
    margin-right: 10px;
    text-decoration: none;
}
.search-hint {
    color: #666;
    font-size: 11px;
    margin-top: 4px;
}

.reset-btn:hover {
    background: #0055aa;
	    color: red;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 4px;
    margin-right: 10px;
    display: inline-block;
    font-size: 12px;
    border: 1px solid #0055aa;

}

* ========== دکمه‌های عملیاتی در جدول ========== */
.my-table button {
    border-color: transparent;
    background: transparent;
    cursor: pointer;
    padding: 5px;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.my-table button:hover {
    background: rgba(0,153,204,0.15);
    transform: scale(1.1);
}
.my-table button img {
    transition: all 0.2s ease;
}
.my-table button:hover img {
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}
/* ========== چک‌باکس‌ها ========== */
.my-table input[type="checkbox"] {
    cursor: pointer;
}

/* ========== دکمه حذف گروهی ========== */
.btn-danger {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
}
.btn-danger:hover {
    background: #c82333;
}

/* ========== استایل سلول‌های جدول ========== */
.normalTextSmall {
    font-size: 12px;
    font-family: Tahoma;
}
.normalTextSmaller {
    font-size: 11px;
    font-family: Tahoma;
}
.style2 {
    color: #555;
    font-size: 11px;
}
.style8 {
    font-size: 18px;
    font-weight: bold;
    color: #069;
}
</style>
<script type="text/javascript" src="../assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
function delete_confirm(){
    var result = confirm("آیا از حذف پیام های انتخابی مطمئن هستید ؟");
    if(result){
        return true;
    }else{
        return false;
    }
}

function singleMessageAction(action, fields, confirmMsg, popup) {
    if (confirmMsg && !confirm(confirmMsg)) {
        return false;
    }
    var form = document.createElement('form');
    form.method = 'post';
    form.action = action;
    if (popup) {
        window.open('about:blank', 'formpopup', 'width=250,height=479,resizable,scrollbars');
        form.target = 'formpopup';
    }
    for (var key in fields) {
        if (!fields.hasOwnProperty(key)) continue;
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = fields[key];
        form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();
    return false;
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
<td colspan="3" valign="middle">
    <ul id="menu">
      <li><a href="send_group_pm.php">ارسال پیام گروهی</a></li>
      <li><a href="search_promo.php">ارسال پیام جدید</a></li>
      <li><a href="sent_message.php">پیام های ارسالی</a></li>
      <li><a href="messanger.php">پیام های دریافتی</a></li>
    </ul>
<p style="padding-top:15px"><span class="style8">لیست پیام های دریافتی </span> </p>
<p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

<form name="ru_read_filter" action="messanger.php" method="get">
  <input type="hidden" name="id" value="1" />
  <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
  <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
  <input type="hidden" name="q" value="<?php echo $q_h; ?>" />
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="203"><input type="radio" name="ru_read" value="1" id="12" <?php if ($ru_read == '1') echo "checked='checked'" ?> onchange="this.form.submit()" />
مشاهده نشده</td>
      <td width="203"><label>
        <input type="radio" name="ru_read" value="2" id="1" <?php if ($ru_read == '2') echo "checked='checked'" ?> onchange="this.form.submit()" />
        مشاهده شده</label></td>
      <td width="141"><input type="radio" name="ru_read" value="" id="0" <?php if ($ru_read == '') echo "checked='checked'" ?> onchange="this.form.submit()" />
کلیه پیام ها</td>
      <td width="141">
        <a href="messanger.php?id=1&ru_read=<?php echo urlencode($ru_read); ?><?php echo $q !== '' ? '&q=' . urlencode($q) : ''; ?>" class="reset-btn">
            ↺ بازنشانی مرتب‌سازی
        </a>
        </td>
    </tr>
  </table>
</form>

<form class="search-bar" action="messanger.php" method="get">
  <input type="hidden" name="id" value="1" />
  <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
  <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
  <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
  <input type="text" name="q" value="<?php echo $q_h; ?>" placeholder="جستجو در موضوع، متن، نام کاربری یا کد ملی فرستنده..." dir="rtl" maxlength="100" />
  <button type="submit">جستجو</button>
  <?php if ($q !== '') { ?>
    <a class="clear-search" href="messanger.php?id=1&ru_read=<?php echo urlencode($ru_read); ?>&order_field=<?php echo urlencode($order_field); ?>&order_by=<?php echo urlencode($order_by); ?>">پاک کردن جستجو</a>
  <?php } ?>
  <div class="search-hint">جستجو در موضوع، متن پیام، نام کاربری و کد ملی فرستنده — همزمان با فیلتر وضعیت</div>
</form>

<?php 
$start = 0;
$limit = 25;
$start = ($id - 1) * $limit;

// ساخت شرط وضعیت خوانده شده (با در نظر گرفتن del در همه حالت‌ها)
if ($ru_read == '') {
    $v_ru_read = "(del != 'T' OR del IS NULL)";
}
if ($ru_read == '1') {
    $v_ru_read = "ru_read = 1 AND (del != 'T' OR del IS NULL)";
}
if ($ru_read == '2') {
    $v_ru_read = "ru_read != 1 AND (del != 'T' OR del IS NULL)";
}

$search_sql = '';
$search_params = array();
if ($q !== '') {
    $search_sql = " AND (
        title LIKE ? OR message LIKE ? OR s_user LIKE ?
        OR s_user IN (SELECT username FROM users WHERE CAST(cod_m AS CHAR) LIKE ?)
    )";
    $like = '%' . $q . '%';
    $search_params = array($like, $like, $like, $like);
}

$query = "SELECT r_date, del_date, s_user, id, s_time, title, s_date, ru_read, file 
          FROM pm 
          WHERE r_user = '$login_session' AND $v_ru_read 
          $search_sql
          $order_sql 
          LIMIT $start, $limit";

$query1 = "SELECT count(*) 
           FROM pm 
           WHERE r_user = '$login_session' AND $v_ru_read
           $search_sql";

$stmt = $dbh->prepare($query);
$stmt->execute($search_params);
?>
<form name="bulk_action_form" action="message_del2.php" method="post" onSubmit="return delete_confirm();">
    <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
    <input type="hidden" name="list_q" value="<?php echo $q_h; ?>" />
    <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
    <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
    <input type="hidden" name="page_id" value="<?php echo (int)$id; ?>" />
    <table class="my-table" align="center">
        <tr align="center" class="text1">
            <th width="36" rowspan="2" bgcolor="#0099CC"><input type="checkbox" name="select_all" id="select_all" value=""/></th>
            <td width="55" rowspan="2" bgcolor="#0099CC">حذف</td>
            <td width="54" rowspan="2" bgcolor="#0099CC">مشاهده</td>
            <td width="94" rowspan="2" bgcolor="#0099CC">آخرین وضعیت</td>
            <td colspan="2" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 's_user', 'order_by' => ($order_field == 's_user' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    فرستنده <?php echo $s_user_icon; ?>
                </a>
            </td>
            <td height="33" colspan="2" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 's_date', 'order_by' => ($order_field == 's_date' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    دریافت پیام <?php echo $s_date_icon; ?>
                </a>
            </td>
            <td width="25%" rowspan="2" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 'title', 'order_by' => ($order_field == 'title' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    موضوع پیام <?php echo $title_icon; ?>
                </a>
            </td>
            <td width="3%" rowspan="2" bgcolor="#0099CC">پیوست</td>
            <td width="5%" rowspan="2" bgcolor="#0099CC">ردیف</td>
        </tr>
        <tr align="center" class="text1">
            <td width="16%" height="33" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 's_user', 'order_by' => ($order_field == 's_user' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    نام و نام خانوادگی <?php echo $s_user_icon; ?>
                </a>
            </td>
            <td width="7%" bgcolor="#0099CC">تصویر</td>
            <td width="10%" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 's_time', 'order_by' => ($order_field == 's_time' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    ساعت <?php echo $s_time_icon; ?>
                </a>
            </td>
            <td width="9%" bgcolor="#0099CC">
                <a href="messanger.php?id=<?php echo $id; ?>&<?php echo http_build_query(array_merge($list_qs_params, array('order_field' => 's_date', 'order_by' => ($order_field == 's_date' && $order_by == 'asc') ? 'desc' : 'asc'))); ?>" class="sort-link">
                    تاریخ <?php echo $s_date_icon; ?>
                </a>
            </td>
        </tr>
        
        <?php
        $r = $start + 1;
        if($stmt->rowCount() > 0){
            foreach($stmt as $row) {
                if ($row['ru_read'] == '1') {
                    $v_message = 'مشاهده نشده';
                }
                if ($row['ru_read'] == '2') {
                    $v_message = 'مشاهده ' . '<br>' . $row['r_date'];
                }
                if ($row['ru_read'] == '3') {
                    $v_message = 'ارسال پاسخ' . '<br>' . $row['r_date'];
                }
                if ($row['ru_read'] == '5') {
                    $v_message = 'انتقال' . '<br>' . $row['r_date'];
                }
                
                if (S_access($row['s_user']) == '1') $v_s_access = 'مروج کشاورزی';
                if (S_access($row['s_user']) == '2') $v_s_access = 'رئیس مرکز';
                if (S_access($row['s_user']) == '3') $v_s_access = 'مدیریت شهرستان';
                if (S_access($row['s_user']) == '4') $v_s_access = 'مدیریت سامانه';
                if (S_access($row['s_user']) == '5') $v_s_access = 'کارشناس معین استان';
                if (S_access($row['s_user']) == '6') $v_s_access = 'کارشناس موضوعی شهرستان';
                if (S_access($row['s_user']) == '7') $v_s_access = 'کارشناس محقق معین شهرستان';
                if (S_access($row['s_user']) == '20') $v_s_access = 'مدیریت کشوری';
                if (S_access($row['s_user']) == '98') $v_s_access = 'کارشناس ادمین استان';
        ?>
        <tr>
            <td height="79" align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['id']; ?>"/></td>
            <td width="8%" height="59" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <button type="button" style="border-color:#FFF" title="حذف پیام"
                    onclick="return singleMessageAction('message_del.php', {
                        id: '<?php echo (int)$row['id']; ?>',
                        s_user: '<?php echo htmlspecialchars($row['s_user'], ENT_QUOTES); ?>',
                        list_ru_read: '<?php echo htmlspecialchars($ru_read, ENT_QUOTES); ?>',
                        list_q: '<?php echo $q_h; ?>',
                        order_field: '<?php echo htmlspecialchars($order_field, ENT_QUOTES); ?>',
                        order_by: '<?php echo htmlspecialchars($order_by, ENT_QUOTES); ?>',
                        page_id: '<?php echo (int)$id; ?>'
                    }, 'از حذف این پیام مطمئن هستید ؟ ');">
                    <img src="../files/del1.png" border="0" title="حذف پیام" width="33" height="31" />
                </button>
            </td>
            <td width="8%" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <button type="button" style="border-color:#FFF" title="مشاهده پیام"
                    onclick="return singleMessageAction('sabt_view.php', {
                        id: '<?php echo (int)$row['id']; ?>',
                        s_user: '<?php echo htmlspecialchars($row['s_user'], ENT_QUOTES); ?>',
                        ru_read: '<?php echo htmlspecialchars($row['ru_read'], ENT_QUOTES); ?>',
                        list_ru_read: '<?php echo htmlspecialchars($ru_read, ENT_QUOTES); ?>',
                        list_q: '<?php echo $q_h; ?>',
                        order_field: '<?php echo htmlspecialchars($order_field, ENT_QUOTES); ?>',
                        order_by: '<?php echo htmlspecialchars($order_by, ENT_QUOTES); ?>',
                        page_id: '<?php echo (int)$id; ?>'
                    });">
                    <img src="../files/view.png" border="0" title="مشاهده پیام" width="29" height="30" />
                </button>
            </td>
            <td class="style2" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $v_message ;?></td>
            <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <?php echo user_name($row['s_user']);?><br />
                <span class="style2"><?php echo $v_s_access ; ?><br />
                <?php echo user_mfa($row['s_user']);?> <br />
                <?php echo user_tel($row['s_user']);?> <br />
                </span>
            </td>
            <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <button type="button" style="border-color:#FFF"
                    onclick="return singleMessageAction('last_login.php', { username: '<?php echo htmlspecialchars($row['s_user'], ENT_QUOTES); ?>' }, null, true);">
                    <img id="img1" src="../files/users/<?php echo user_pic($row['s_user']); ?>?m=<?php @filemtime(user_pic($row['s_user'])); ?>" width="42" height="46" alt=""/>
                </button>
            </td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['s_time'];?></td>
            <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['s_date'];?></td>
            <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['title'];?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <?php if ($row['file'] <> '') { ?>
                    <img src="../files/attachment.jpg" width="30" height="30" />
                <?php } else { ?>
                    <span class="rotated-text">ندارد</span>
                <?php } ?>
            </td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
        </tr>
        <?php
                $r++;
            }
        } else {
        ?>
            <tr>
                <td colspan="11"><?php echo ($q !== '') ? 'نتیجه‌ای برای این جستجو یافت نشد' : 'پیامی موجود نیست'; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br />
    <input type="submit" class="btn btn-danger" name="bulk_delete_submit" value="حذف پیام های انتخابی"/>
</form>
<p></p>
<div style="height:20px"></div>
</div>

<?php 
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute($search_params);
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    
    if($total > 1) {
        $visible_pages = 3;
        $start_page = max(1, $id - $visible_pages);
        $end_page = min($total, $id + $visible_pages);
        $show_first = ($start_page > 1);
        $show_last = ($end_page < $total);
        ?>
        
        <div dir="rtl" class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; border-radius:15px">
            <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
                <?php if($id > 1): ?>
                    <li class="page-item" style="display:inline-block; margin:2px;">
                        <a href="messanger.php?id=<?php echo $id-1; ?>&<?php echo $list_qs; ?>#1" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</a>
                    </li>
                <?php endif; ?>
                
                <?php if($show_first): ?>
                    <li class="page-item" style="display:inline-block; margin:2px;">
                        <a href="messanger.php?id=1&<?php echo $list_qs; ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</a>
                    </li>
                    <?php if($start_page > 2): ?>
                        <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                            <span style="padding:5px 10px;">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                    <li class="page-item <?php echo ($i == $id) ? 'active' : ''; ?>" style="display:inline-block; margin:2px;">
                        <?php if($i == $id): ?>
                            <span class="current-page" style="background:#06C; color:white; padding:5px 10px; border-radius:4px; display:inline-block;"><?php echo $i; ?></span>
                        <?php else: ?>
                            <a href="messanger.php?id=<?php echo $i; ?>&<?php echo $list_qs; ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endfor; ?>
                
                <?php if($show_last): ?>
                    <?php if($end_page < $total - 1): ?>
                        <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                            <span style="padding:5px 10px;">...</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item" style="display:inline-block; margin:2px;">
                        <a href="messanger.php?id=<?php echo $total; ?>&<?php echo $list_qs; ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></a>
                    </li>
                <?php endif; ?>
                
                <?php if($id != $total): ?>
                    <li class="page-item" style="display:inline-block; margin:2px;">
                        <a href="messanger.php?id=<?php echo $id+1; ?>&<?php echo $list_qs; ?>#1" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <div class="page-jump" style="margin-top:10px;">
                <form id="pageJumpForm" action="messanger.php" method="get" style="display:inline-block;">
                    <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                    <input type="hidden" name="q" value="<?php echo $q_h; ?>" />
                    <input type="hidden" name="order_field" value="<?php echo $order_field; ?>" />
                    <input type="hidden" name="order_by" value="<?php echo $order_by; ?>" />
                    <span style="font-size:16px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
                    <input type="number" 
                           id="pageIdInput"
                           name="id"
                           value="<?php echo $id; ?>" 
                           placeholder="شماره صفحه" 
                           min="1" max="<?php echo $total; ?>"
                           style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
                </form>
            </div>
        </div>
        <script>
        document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
            var input = document.getElementById('pageIdInput');
            var pageId = parseInt(input.value, 10);
            if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
                this.action = 'messanger.php?id=' + pageId + '&<?php echo $list_qs; ?>#1';
            } else {
                e.preventDefault();
                alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
            }
        });
        </script>
    <?php } ?>
<?php } ?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle">
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php if(isset($_GET["unread"])) { ?>
    <script type="text/javascript">
        msgBoxImagePath = "../15_files/";
        showMsgBox(); 
        function showMsgBox(title,content,type) {
            $.msgBox({
                title: "توجه :",
                content: " لطفاً برای ادامه ، ابتدا پیام های جدید خود را مشاهده کنید .",
                type: "alert",
                showButtons: true,
                opacity: 0.8,
                autoClose: true,
            });
        }
    </script>
<?php } ?>