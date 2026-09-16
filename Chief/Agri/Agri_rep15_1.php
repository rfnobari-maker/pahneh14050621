<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
require_once('counter15.php');
$id_ostan1   = isset($_POST['id_ostan'])   ? $_POST['id_ostan']   : '';
$id_city     = isset($_POST['id_city5'])   ? $_POST['id_city5']   : '';
$id_mar      = isset($_POST['id_mar'])     ? $_POST['id_mar']     : '';
$add_abadi   = isset($_POST['add_abadi'])  ? $_POST['add_abadi']  : '';
$add_city    = isset($_POST['add_city'])   ? $_POST['add_city']   : '';
$no_kesh     = isset($_POST['no_kesh'])    ? $_POST['no_kesh']    : '';
$mor_cod_m   = isset($_POST['mor_cod_m'])  ? $_POST['mor_cod_m']  : '';
$bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '';
$z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
$mah_qroup   = isset($_POST['mah_qroup'])  ? $_POST['mah_qroup']  : '';
$mah_name    = isset($_POST['mah_name'])   ? $_POST['mah_name']   : '';

$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
	<script src="../../location/ajax-location.js"></script>
<style>
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
button
{
	border-color:#FFF ;
}
    </style>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
    var initial_add_abadi = '<?php echo !empty($add_abadi) ? $add_abadi : ''; ?>';
    var initial_add_city = '<?php echo !empty($add_city) ? $add_city : ''; ?>';
</script>

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <span class="style8">گزارش اطلاعات زراعی به تفکیک محصول / بهره بردار</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="384" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                <select  name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
    <option value="-1">-- انتخاب استان --</option>
    <?php
    // گرفتن لیست استان‌ها
    $stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
    $ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($ostans as $o): ?>
    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
    <?php endforeach; ?>
</select></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: نوع کشت</font></td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl"  >
    <option value="0">-- انتخاب شهرستان --</option>
    <?php
    // If a province and city were previously selected, load the cities for that province
    if (!empty($id_ostan1) && !empty($id_city)) {
        $stmt_cities = $dbh->prepare("SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC");
        $stmt_cities->execute(array($id_ostan1));
        $cities = $stmt_cities->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cities as $c) {
            echo '<option value="' . $c['id_city'] . '"' . (($c['id_city'] == $id_city) ? ' selected="selected"' : '') . '>' . htmlspecialchars($c['city'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
    ?>
</select></td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                     <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM product_z WHERE  group_cod = $mah_qroup " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                     <?php
}
?>
                   </select>
                 </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8">نام محصول</td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_z "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                   </select></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select name="add_abadi" class="input_text" id="abadi" style="width:170px ; height:40px" dir="rtl" >
      <option value="0">-- انتخاب آبادی --</option>
 <?php
      // کد PHP برای پر کردن دراپ‌دان آبادی
if (!empty($id_mar) && !empty($add_abadi)) {
    $stmt_abadi = $dbh->prepare("SELECT add_abadi, abadi FROM list_abadi WHERE id_mar = ? ORDER BY BINARY abadi ASC");
    $stmt_abadi->execute(array($id_mar));
    $abadies = $stmt_abadi->fetchAll(PDO::FETCH_ASSOC);
    foreach ($abadies as $a) {
        echo '<option value="' . $a['add_abadi'] . '"' . (($a['add_abadi'] == $add_abadi) ? ' selected="selected"' : '') . '>' . htmlspecialchars($a['abadi'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
}?>
      </select></td>
                 <td height="42"  align='center' bgcolor="#FFFFFF" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_mar" class="style8" id="markaz" style="width:170px ; height:40px" dir="rtl" >
    <option value="0">-- انتخاب مرکز --</option>
    <?php
    // If a city and markaz were previously selected, load the markazes for that city
    if (!empty($id_city) && !empty($id_mar)) {
        $stmt_markazes = $dbh->prepare("SELECT id_mar, mar FROM mar WHERE id_city = ? ORDER BY BINARY mar ASC");
        $stmt_markazes->execute(array($id_city));
        $markazes = $stmt_markazes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($markazes as $m) {
            echo '<option value="' . $m['id_mar'] . '"' . (($m['id_mar'] == $id_mar) ? ' selected="selected"' : '') . '>' . htmlspecialchars($m['mar'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
    ?>
</select>
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="146" rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select name="add_city" class="input_text" id="shahr" style="width:170px ; height:40px" dir="rtl" >
      <option value="0">-- انتخاب شهر --</option>
   <?php
   // کد PHP برای پر کردن دراپ‌دان شهر
if (!empty($id_mar) && !empty($add_city)) {
    $stmt_shahr = $dbh->prepare("SELECT add_city, shahr FROM list_city WHERE id_mar = ? ORDER BY BINARY shahr ASC");
    $stmt_shahr->execute(array($id_mar));
    $shahrs = $stmt_shahr->fetchAll(PDO::FETCH_ASSOC);
    foreach ($shahrs as $s) {
        echo '<option value="' . $s['add_city'] . '"' . (($s['add_city'] == $add_city) ? ' selected="selected"' : '') . '>' . htmlspecialchars($s['shahr'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
}
   ?>
      </select></td>
                 <td height="42"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
                 </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
      <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan   = 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar     = 1 ;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == 0) {$f_add_abadi  = 1 ;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == 0)  {$f_add_city   = 1 ;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')    {$f_no_kesh    = 1 ;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m  = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m  = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_name == '')    {$v_cod_mah    = 1 ;}else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
 include_once('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT DISTINCT bah_cod_m from $Agri_prod_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m  and  $v_cod_mah ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT COUNT(DISTINCT bah_cod_m)  from $Agri_prod_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_cod_mah  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep15_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                            <td width="56"><form  action="Agri_rep15_doc.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <span class="style8">فقط قطعات دارای محصول در محاسبه شرکت داده شده / قطعات دارای تنوع محصول 0 یا به عبارت دیگر قطعه ی که کلاً آیش ثبت شده محاسبه نگردیده</span><img src="../../files/con_info.png" title="دانلود نتایج با فرمت فایل ورد"  width="16" height="16"  alt=""/><br />
            <table width="85%" align="center" class="my-table" >
              <tr class="text1">
          <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="2" bgcolor="#006699">مساحت /  هکتار </td>
          <td width="6%" rowspan="2" bgcolor="#006699"> تعداد<br />
            قطعه<br /></td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="6%" bgcolor="#006699">قطعی</td>
          <td width="12%" bgcolor="#006699">پیش بینی</td>
          <td width="12%" bgcolor="#006699">سطح برداشت</td>
          <td width="11%" bgcolor="#006699">سطح زیر کشت</td>
          <td width="9%" height="36" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="manager_Agri2.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="$id_city" value="<?php echo  $$id_city ;?>" />
              <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
              <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
              <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
              <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_tol($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m) ;
 ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_tolp($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo s_bar($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo zer_kesht($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Agri_gat($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m) ; ?></td>
          <td height="49" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
<?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);

// تعیین محدوده صفحات برای نمایش
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
                <form action="Agri_rep15.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($show_first): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep15.php?id=1#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
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
                    <form action="Agri_rep15.php?id=<?php echo $i ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
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
                <form action="Agri_rep15.php?id=<?php echo $total ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($id != $total): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="Agri_rep15.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                    <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                </form>
            </li>
    </ul>
    
    <div class="page-jump" style="margin-top:10px;">
        <form id="pageJumpForm" action="Agri_rep15.php" method="post" style="display:inline-block;">
            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
            <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
            <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
            <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
            <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
            <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
            <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
            <span style="font-size:18px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
            <input type="number" 
                   id="pageIdInput"
                   name="page_input"
                   value="<?php echo isset($id) ? (int)$id : 1; ?>" 
                   placeholder="شماره صفحه" 
                   style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
        </form>
                <?php endif; ?>
    </div>
</div>
<script>
document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
    var input = document.getElementById('pageIdInput');
    var pageId = parseInt(input.value, 10);
    if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
        this.action = 'Agri_rep15.php?id=' + pageId + '#1';
    } else {
        e.preventDefault();
        alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
    }
});
</script>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>