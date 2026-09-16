<?php 
include_once('../../lock_p1.php');
include_once('../../event.php');
include_once('Agrinote_status.php');
   $add_abadi = '';
    $add_city =  '';
    $no_kesh = '';
    $no_mal = '';
    $t_mah = '';
    $docId = '';
    $bah_cod_m =  '';
    $m_cod_m =  '';
    $z_sal =  '';
if (isset($_POST['back_p'])) {
    if (isset($_SESSION['page_date'])) {
        $page_date = $_SESSION['page_date'];

        // استفاده از مقادیر از $_SESSION
        $bah_cod_m = isset($page_date['p_bah_cod_m']) ? $page_date['p_bah_cod_m'] : '';
        $m_cod_m = isset($page_date['p_m_cod_m']) ? $page_date['p_m_cod_m'] : '';
        $add_abadi = isset($page_date['p_add_abadi']) ? $page_date['p_add_abadi'] : '';
        $add_city = isset($page_date['p_add_city']) ? $page_date['p_add_city'] : '';
        $no_kesh = isset($page_date['p_no_kesh']) ? $page_date['p_no_kesh'] : '';
        $no_mal = isset($page_date['p_no_mal']) ? $page_date['p_no_mal'] : '';
        $z_sal = isset($page_date['p_z_sal']) ? $page_date['p_z_sal'] : '';
        $t_mah = isset($page_date['p_t_mah']) ? $page_date['p_t_mah'] : '';
        $docId = isset($page_date['p_docId']) ? $page_date['p_docId'] : '';
    }
} else {
    unset($_SESSION['page_date']);
    
    // استفاده از مقادیر از $_POST با مقدار پیش‌فرض و trim
    $add_abadi = isset($_POST['add_abadi']) ? trim($_POST['add_abadi']) : '';
    $add_city = isset($_POST['add_city']) ? trim($_POST['add_city']) : '';
    $no_kesh = isset($_POST['no_kesh']) ? trim($_POST['no_kesh']) : '';
    $no_mal = isset($_POST['no_mal']) ? trim($_POST['no_mal']) : '';
    $t_mah = isset($_POST['t_mah']) ? trim($_POST['t_mah']) : '';
    $docId = isset($_POST['docId']) ? trim($_POST['docId']) : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
    $m_cod_m = isset($_POST['m_cod_m']) ? trim($_POST['m_cod_m']) : '';
    $z_sal = isset($_POST['z_sal']) ? trim($_POST['z_sal']) : '';

    include_once('../session_start.php');
    
    // ذخیره داده‌ها در $_SESSION
    $_SESSION['page_date'] = array(
        'p_add_abadi' => $add_abadi,
        'p_add_city' => $add_city,
        'p_bah_cod_m' => $bah_cod_m,
        'p_m_cod_m' => $m_cod_m,
        'p_no_kesh' => $no_kesh,
        'p_no_mal' => $no_mal,
        'p_z_sal' => $z_sal,
        'p_t_mah' => $t_mah,
        'p_docId' => $docId
    );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en" dir="rtl">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='./css/leaflet.css'>
 <script>
    function target_Agri18(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=1200px,height=800px"); 
    form.target = 'formpopup'; 
	}
   </script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
       <style>
#message-box {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #FFC;
    color: #4E342E;
    padding: 20px;
    border: 1px solid #f5c6cb;
    border-radius: 8px;
    text-align: right;
    width: 700px;
	line-height: 2 ; 
    z-index: 9999;
}

#message-box button {
    display: block;
    margin: 20px auto 0 auto;  /* این باعث می‌شود دکمه در وسط به صورت افقی قرار گیرد */
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
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
width:50px
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
</style>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="130" /></td>
          </tr>
          <tr>
            <td dir="ltr"><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
  <div id="message-box" dir="rtl" >
      <p> تمامی مسئولیت‌های اطلاعات ثبت شده بر عهده کارشناس پهنه می‌باشد. به همین منظور، در بخش زراعت، آیکون «لیست حذفی‌های زراعی» اضافه شده است و در صورت لزوم، تنها همین لیست در اختیار نهادهای نظارتی قرار خواهد گرفت.</br>
   <p> مجدداً تأکید می‌شود از پذیرش ثبت، حذف و ویرایش دستوری اطلاعات توسط هر مقام و مسئولی جداً خودداری فرمایید.</br>
    <label style="color:#666 ; font-size:14px">
        <input type="checkbox" id="dont-show-again"> مطالعه کردم ، این پیام مجددا نمایش داده نشود
    </label><br>
    <button style="border-radius:8px ; width:100px" id="close-message">بستن</button>
</div>

   <form  id="reg-form" method="post" action="#1">
             <p> <span class="style1">لیست بهره برداری های زراعی </span></p>
             <div style=" border-radius:15px ;  width: 600px; padding: 5px; border: 2px solid navy; margin: auto; text-align: left; direction:ltr "  >
             <table width="100%" height="276" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                     <option value="1403-1404" <?php if (isset($z_sal) && $z_sal=='1403-1404') echo 'selected=selected'?>>1403-1404</option>
                     <option value="1402-1403" <?php if (isset($z_sal) && $z_sal=='1402-1403') echo 'selected=selected'?>>1402-1403</option>
                     <option value="1401-1402" <?php if (isset($z_sal) && $z_sal=='1401-1402') echo 'selected=selected'?>>1401-1402</option>
                     <option value="1400-1401" <?php if (isset($z_sal) && $z_sal=='1400-1401') echo 'selected=selected'?>>1400-1401</option>
                     <option value="1399-1400" <?php if (isset($z_sal) && $z_sal=='1399-1400') echo 'selected=selected'?>>1399-1400</option>
                     <option value="1398-1399" <?php if (isset($z_sal) && $z_sal=='1398-1399') echo 'selected=selected'?>>1398-1399</option>
                     <option value="1397-1398" <?php if (isset($z_sal) && $z_sal=='1397-1398') echo 'selected=selected'?>>1397-1398</option>
                   </select>
                 </div></td>
                 <td width="23%"><font size="2">: سال زراعی</font></td>
                 <td width="29%" height="45">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="" >انتخاب نام شهر </option>
                       <?php
$query = "SELECT add_city, shahr FROM `list_city` WHERE `mor_cod_m` = :mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach($stmt as $row){
?>
                       <option value="<?php echo htmlspecialchars($row['add_city'], ENT_QUOTES, 'UTF-8'); ?>"
   <?php if ($row['add_city'] == $add_city) echo 'selected=selected'; ?>> <?php echo htmlspecialchars($row['shahr'], ENT_QUOTES, 'UTF-8'); ?></option>
                       <?php }?>
                     </select>
                                   </td>
                 <td width="18%"><div align="right"><span style=" margin-right:15px ; text-align: right">: نام شهر</span></div>                 </td>
               </tr>
               <tr>
                 <td height="49" align="right" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
                 </span></div></td>
                 <td width="23%"><font size="2">: کد ملی بهره بردار</font></td>
                 <td height="49"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" >انتخاب نام آبادی </option>
                     <?php
$query = "SELECT add_abadi, abadi FROM `list_abadi` WHERE `mor_cod_m` = :mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach($stmt as $row){
?>
                     <option value="<?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>"
   <?php if (isset($row['add_abadi']) && $row['add_abadi'] == $add_abadi) echo 'selected=selected'; ?>> <?php echo htmlspecialchars($row['abadi'], ENT_QUOTES, 'UTF-8'); ?></option>
                     <?php }?>
                     </select>
                   </span></div>
                 </td>
                 <td height="49"><div align="right"><span style=" margin-right:15px;text-align: right">:
نام آبادی</span></div></td>
               </tr>
               <tr>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="m_cod_m" type="text" class="input_text" id="m_cod_m"  style="height:35px ; width:170px " value="<?php echo htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
                 </div></td>
                 <td><font size="2">: کد ملی مالک</font></td>
                 <td height="54"><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if (isset($no_mal) && $no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if (isset($no_mal) && $no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if (isset($no_mal) && $no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if (isset($no_mal) && $no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if (isset($no_mal) && $no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if (isset($no_mal) && $no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if (isset($no_mal) && $no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                     <option value="8" <?php if (isset($no_mal) && $no_mal=='8') { echo 'selected="selected"' ; } ?>>سایر</option>                     
                     </select>
                 </div></td>
                 <td height="54"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع مالکیت</span></div></td>
               </tr>
               <tr>
                 <td><div align="right">
                   <select name="t_mah" class="input_text  required" id="t_mah" style="height:40px ; width:170px ; direction:rtl">
                     <option value=''  >انتخاب تنوع محصول</option>
                     <option value="0" <?php if (isset($t_mah) && $t_mah=='0') { echo 'selected="selected"';}?>>صفر</option>
                     <option value="1" <?php if (isset($t_mah) && $t_mah=='1') { echo 'selected="selected"';}?>>1</option>
                     <option value="2" <?php if (isset($t_mah) && $t_mah=='2') { echo 'selected="selected"';}?>>2</option>
                     <option value="3" <?php if (isset($t_mah) && $t_mah=='3') { echo 'selected="selected"';}?>>3</option>
                     <option value="4" <?php if (isset($t_mah) && $t_mah=='4') { echo 'selected="selected"';}?>>بزرگتر از 3</option>
                   </select>
                 </div></td>
                 <td><font size="2">:  تنوع محصول</font></td>
                 <td height="44"><div align="right"><span style="text-align: right">
                   <select name="no_kesh" class="input_text  required" id="no_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if(isset($no_kesh) && $no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if(isset($no_kesh) && $no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </span></div></td>
                 <td height="44"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع کشت</span></div></td>
               </tr>
               <tr>
                 <td height="84" colspan="4">
                   <p>
                     <input type="submit" name="action_lise" id="action_lise" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
                     </p>
                   <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداری ها کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
               </tr>
             </table>
             </div>
   </form>

<?php 
 if (isset($_POST['action_lise'])) 
 {  
 // اعتبارسنجی نام جدول برای جلوگیری از SQL Injection
 $z_sal_clean = preg_replace('/[^0-9\-]/', '', $z_sal);
 $Agri_table = 'Agri' . str_replace('-', '_', $z_sal_clean);
 
 // بررسی اینکه نام جدول معتبر است
 $valid_tables = array('Agri1404_1405', 'Agri1403_1404', 'Agri1402_1403', 'Agri1401_1402', 
                       'Agri1400_1401', 'Agri1399_1400', 'Agri1398_1399', 'Agri1397_1398');
 if (!in_array($Agri_table, $valid_tables)) {
     $Agri_table = 'Agri1404_1405'; // مقدار پیش‌فرض
 }

 if ($z_sal == '1403-1404' || $z_sal == '1404-1405') {
     $Agri_edit_available = '1';
 } else {
     $Agri_edit_available = '0';
 }
 
 // ساخت شرط‌های WHERE با استفاده از Prepared Statements
 $where_conditions = array();
 $params = array(':mor_cod_m' => $login_session);
 
 if ($add_abadi != '') {
     $where_conditions[] = "Agri.add_abadi = :add_abadi";
     $params[':add_abadi'] = $add_abadi;
 }
 
 if ($add_city != '') {
     $where_conditions[] = "Agri.add_city = :add_city";
     $params[':add_city'] = $add_city;
 }
 
 if ($no_mal != '') {
     $where_conditions[] = "Agri.no_mal = :no_mal";
     $params[':no_mal'] = $no_mal;
 }
 
 if ($no_kesh != '') {
     $where_conditions[] = "Agri.no_kesh = :no_kesh";
     $params[':no_kesh'] = $no_kesh;
 }
 
 if ($bah_cod_m != '') {
     $where_conditions[] = "Agri.bah_cod_m = :bah_cod_m";
     $params[':bah_cod_m'] = $bah_cod_m;
 }
 
 if ($m_cod_m != '') {
     $where_conditions[] = "Agri.m_cod_m = :m_cod_m";
     $params[':m_cod_m'] = $m_cod_m;
 }
 
 if ($t_mah != '') {
     if ($t_mah == '4') {
         $where_conditions[] = "Agri.t_mah >= :t_mah";
     } else {
         $where_conditions[] = "Agri.t_mah = :t_mah";
     }
     $params[':t_mah'] = $t_mah;
 }
 
 if ($docId != '' && $z_sal == '1402-1403') {
     if ($docId == '1') {
         $where_conditions[] = "Agri.docId != ''";
     } else {
         $where_conditions[] = "Agri.docId = ''";
     }
 }
 
 $where_clause = "Agri.mor_cod_m = :mor_cod_m";
 if (!empty($where_conditions)) {
     $where_clause .= " AND " . implode(" AND ", $where_conditions);
 }
 
 $start = 0;
 $limit = 10;
 $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
 if ($id < 1) $id = 1;
 $start = ($id - 1) * $limit;
 
 $params[':start'] = $start;
 $params[':limit'] = $limit;

 $query = "SELECT 
    Agri.s_ayesh,
    Agri.num_bah,
    Agri.id,
    Agri.mor_cod_m,
    Agri.no_mal,
    Agri.bah_cod_m,
    Agri.m_cod_m,
    Agri.add_abadi,
    Agri.add_city,
    Agri.sh_gat,
    Agri.no_kesh,
    Agri.m_zamin,
    Agri.id_ostan,
    Agri.id_city,
    Agri.t_mah,
    Agri.docId,
    bah.name,
    bah.last_name,
    bah.no_bah,
    list_abadi.abadi,
    list_city.city
FROM 
    `$Agri_table` Agri
INNER JOIN 
    bah ON Agri.bah_cod_m = bah.bah_cod_m 
         AND Agri.num_bah = bah.num_bah
LEFT JOIN 
    list_abadi ON Agri.add_abadi = list_abadi.add_abadi
LEFT JOIN 
    list_city ON Agri.add_city = list_city.add_city
WHERE 
    $where_clause
ORDER BY 
    BINARY bah.last_name, bah.name, Agri.sh_gat  
ASC LIMIT :start, :limit";

$query1 = "SELECT COUNT(*) FROM 
    `$Agri_table` Agri
INNER JOIN 
    bah ON Agri.bah_cod_m = bah.bah_cod_m 
         AND Agri.num_bah = bah.num_bah
LEFT JOIN 
    list_abadi ON Agri.add_abadi = list_abadi.add_abadi
LEFT JOIN 
    list_city ON Agri.add_city = list_city.add_city
WHERE 
    $where_clause";

// حذف پارامترهای limit از query1
$params_count = $params;
unset($params_count[':start']);
unset($params_count[':limit']);

$stmt = $dbh->prepare($query);
foreach ($params as $key => $value) {
    if ($key == ':start' || $key == ':limit') {
        $stmt->bindValue($key, (int)$value, PDO::PARAM_INT);
    } else {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }
}
$stmt->execute();
?>
      <div class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style1"><a name="1" id="1"></a></span></div>
<form  action="list_Agri_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="add_city"  value="<?php echo htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="no_mal"    value="<?php echo htmlspecialchars($no_mal, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="no_kesh"   value="<?php echo htmlspecialchars($no_kesh, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="m_cod_m"   value="<?php echo htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="z_sal"     value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
        <input type="hidden" name="t_mah"     value="<?php echo htmlspecialchars($t_mah, ENT_QUOTES, 'UTF-8'); ?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="33" height="45"  alt=""/></button>
      </form>
<div style="text-align:right; margin:auto; width:98%; font-size:12px; font-family:myfont; padding:10px; direction:ltr; border-radius: 15px; ">
    <table align="center" class="my-table">
        <thead>
            <tr>
                <th colspan="5" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">عملیات</span></th>
                
                <th width="5%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">سطح آیش</span></th>
                <th width="6%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">مساحت زمین<br />هکتار</span></th>
                <th width="5%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">نوع کشت</span></th>
                <th width="6%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">کد ملی مالک</span></th>
                <th width="7%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">نوع مالکیت</span></th>
                <th width="5%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">شماره قطعه</span></th>
                <th  colspan="3" bgcolor="#006699"><span class="leaflet-zoom-animated">مشخصات بهره بردار</span></th>
                <th width="10%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">آبادی/شهر</span></th>
                <th width="5%" rowspan="2" bgcolor="#006699"><span class="leaflet-zoom-animated">ردیف</span></th>
            </tr>
            <tr>
                <th width="8%" bgcolor="#006699"><span class="leaflet-zoom-animated">همراه</span></th>
                <th width="8%" height="31" bgcolor="#006699"><span class="leaflet-zoom-animated">کد ملی</span></th>
                <th width="10%" bgcolor="#006699"><span class="leaflet-zoom-animated">نام و نام خانوادگی</span></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $r = $start + 1;

        foreach ($stmt as $row) {
            $v_no_mal = '';
            if ($row['no_mal'] == '1') $v_no_mal = 'سند ششدانگ';
            if ($row['no_mal'] == '2') $v_no_mal = 'سند مشاعی';
            if ($row['no_mal'] == '3') $v_no_mal = 'اصلاحات اراضی';
            if ($row['no_mal'] == '4') $v_no_mal = 'موقوفه';
            if ($row['no_mal'] == '5') $v_no_mal = 'واگذاری';
            if ($row['no_mal'] == '6') $v_no_mal = 'قولنامه';
            if ($row['no_mal'] == '7') $v_no_mal = 'اجاره';
            if ($row['no_mal'] == '8') $v_no_mal = 'سایر';

            $v_no_kesh = '';
            if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';
            if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
        ?>
            <tr>
            <?php if ($Agri_edit_available == '1') { ?>
                <td width="5%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                    <form action="del_list_Agri.php" method="post">
                        <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($row['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($row['add_city'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="sh_gat" value="<?php echo htmlspecialchars($row['sh_gat'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="id_page" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" />
                        <button onclick="return confirm('از حذف اطلاعات زراعی مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات زراعی" width="30" height="23" alt=""/></button>
                    </form>
                </td>
                <td width="5%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                    <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
                        <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($row['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
                        <button><img src="../../files/Pro.png" title="ویرایش اطلاعات محصول" width="30" height="23" alt=""/></button>
                    </form>
                </td>
                <td width="5%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                    <form action="Agri_edit.php" method="post">
                        <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($row['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="sh_gat" value="<?php echo htmlspecialchars($row['sh_gat'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="m_poul" value="<?php if (isset($row['m_poul'])) echo htmlspecialchars($row['m_poul'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($row['add_abadi'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($row['add_city'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo htmlspecialchars($row['no_kesh'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo htmlspecialchars($row['no_mal'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo htmlspecialchars($row['t_mah'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="id_page" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" />
                        <button><img src="../../files/Ear.png" title="ویرایش اطلاعات زمین" width="30" height="23" alt=""/></button>
                    </form>
                </td>
            <?php } else { ?>
                <td colspan="3" style="font-size:12px ; color:#900 ">امکان ویرایش و حذف مقدور نیست</td>
            <?php } ?>

           
                <td width="10%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                    <form action="Agri_note" method="post" onsubmit="target_Agri21(this)">
                        <input type="hidden" name="Agri_id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($user_check, ENT_QUOTES, 'UTF-8'); ?>" />
<button style="display:flex; align-items:center; gap:4px;">
    <?php echo getAgriStatus($z_sal, $row['id']); ?>
    <img src="../../files/add_new.png" title="درج /نمایش توضیح" width="30" height="23" alt=""/>
</button>
                    </form>
                </td>
           
            <td width="5%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                <form action="Agridata_view.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="hidden" name="id_page" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" />
                    <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری" width="30" height="23" alt=""/></button>
                </form>
            </td>
            <td width="4%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['s_ayesh'] * 1, ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="6%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['m_zamin'] * 1, ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="5%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($v_no_kesh, ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="7%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['m_cod_m'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="7%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php if (isset($v_no_mal)) echo htmlspecialchars($v_no_mal, ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="5%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['sh_gat'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="8%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars(bah_tel_m($row['bah_cod_m']), ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="8%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="10%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8') . '&nbsp;' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="10%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars(abadi_name($row['add_abadi']), ENT_QUOTES, 'UTF-8'); ?><?php echo htmlspecialchars(shahr_name($row['add_city']), ENT_QUOTES, 'UTF-8'); ?></td>
            <td width="5%" class="normalTextSmall" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo htmlspecialchars($r, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php
            $r++;
        }
 }
        ?>
        </tbody>
    </table>
</div></div>    
<div style="height:20px"></div>
</div>
<?php 
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    foreach ($params_count as $key => $value) {
        $stmt1->bindValue($key, $value, PDO::PARAM_STR);
    }
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    
    // تعیین محدوده صفحات برای نمایش
    $visible_pages = 3; // تعداد صفحات قابل مشاهده در هر طرف صفحه فعلی
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    // اگر صفحه اول در محدوده نیست، لینک صفحه اول را اضافه کنیم
    $show_first = ($start_page > 1);
    // اگر صفحه آخر در محدوده نیست، لینک صفحه آخر را اضافه کنیم
    $show_last = ($end_page < $total);
    ?>
    
    <div class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; border-radius:15px">
        <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
            <?php if(isset($id) && $id > 1): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Agri.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? htmlspecialchars($t_mah, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="docId" value="<?php echo isset($docId) ? htmlspecialchars($docId, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Agri.php?id=1#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? htmlspecialchars($t_mah, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="docId" value="<?php echo isset($docId) ? htmlspecialchars($docId, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</button>
                    </form>
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
                        <form action="liste_Agri.php?id=<?php echo $i ?>#1" method="post" style="display:inline;">
                            <input type="hidden" name="action_lise" value="1" />
                            <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                            <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                            <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                            <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                            <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                            <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? $m_cod_m : ''; ?>" />
                            <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                            <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? $t_mah : ''; ?>" />
                            <input type="hidden" name="docId" value="<?php echo isset($docId) ? $docId : ''; ?>" />
                            <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></button>
                        </form>
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
                    <form action="liste_Agri.php?id=<?php echo $total ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? htmlspecialchars($t_mah, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="docId" value="<?php echo isset($docId) ? htmlspecialchars($docId, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if(isset($id) && $id != $total): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Agri.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? htmlspecialchars($m_cod_m, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? htmlspecialchars($t_mah, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <input type="hidden" name="docId" value="<?php echo isset($docId) ? htmlspecialchars($docId, ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
<div class="page-jump" style="margin-top:10px;">
<form id="pageJumpForm" action="liste_Agri.php" method="post" style="display:inline-block;">
    <input type="hidden" name="action_lise" value="1" />
    <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi) : ''; ?>" />
    <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city) : ''; ?>" />
    <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal) : ''; ?>" />
    <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh) : ''; ?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m) : ''; ?>" />
    <input type="hidden" name="m_cod_m" value="<?php echo isset($m_cod_m) ? htmlspecialchars($m_cod_m) : ''; ?>" />
    <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal) : ''; ?>" />
    <input type="hidden" name="t_mah" value="<?php echo isset($t_mah) ? htmlspecialchars($t_mah) : ''; ?>" />
    <input type="hidden" name="docId" value="<?php echo isset($docId) ? htmlspecialchars($docId) : ''; ?>" />
<span style="font-size:18px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
    <input type="number" 
           id="pageIdInput"
           name="page_input"
           value="<?php echo isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1; ?>" 
           placeholder="شماره صفحه" 
           style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
         <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو </button>
</form>
</div>

    <script>
    document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
        var input = document.getElementById('pageIdInput');
        var pageId = parseInt(input.value, 10);
        if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
            this.action = 'liste_Agri.php?id=' + pageId + '#1';
        } else {
            e.preventDefault();
            alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
        }
    });
	
	function target_Agri21(form) {
    var width = 500;
    var height = 800;
    var left = 0;
    var top = 100;

    window.open(
        "", // پنجره خالی برای هدف فرم
        "formpopup",
        "location=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,width=" + width + ",height=" + height + ",left=" + left + ",top=" + top
    ); 
    form.target = 'formpopup'; // ارسال فرم به پنجره جدید
}
    </script>


    </div>
<?php } ?>
<p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
 