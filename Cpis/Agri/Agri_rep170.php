<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$zka1 = isset($_POST['zka1']) ? $_POST['zka1'] : '';
$zka2 = isset($_POST['zka2']) ? $_POST['zka2'] : '';
$zkb1 = isset($_POST['zkb1']) ? $_POST['zkb1'] : '';
$zkb2 = isset($_POST['zkb2']) ? $_POST['zkb2'] : '';
$sba1 = isset($_POST['sba1']) ? $_POST['sba1'] : '';
$sba2 = isset($_POST['sba2']) ? $_POST['sba2'] : '';
$sbb1 = isset($_POST['sbb1']) ? $_POST['sbb1'] : '';
$sbb2 = isset($_POST['sbb2']) ? $_POST['sbb2'] : '';
$mtol1 = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2 = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$mtolp1 = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2 = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';

$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$mah_kh = isset($_POST['mah_kh']) ? $_POST['mah_kh'] : '';
$mah_bem = isset($_POST['mah_bem']) ? $_POST['mah_bem'] : '';

$date_s1 = isset($_POST['date_s1']) ? $_POST['date_s1'] : '';
$date_s2 = isset($_POST['date_s2']) ? $_POST['date_s2'] : '';

// ایجاد نام جدول بر اساس سال
$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

// گرفتن لیست استان‌ها
$stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
$ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../../15_files/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("9999/99/99",{placeholder:"____/__/__"});
    	 $("#date2").mask("9999/99/99",{placeholder:"____/__/__"});
    });
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
    var initial_add_abadi = '<?php echo !empty($add_abadi) ? $add_abadi : ''; ?>';
    var initial_add_city = '<?php echo !empty($add_city) ? $add_city : ''; ?>';
</script>
<script src="../../location/ajax-location.js"></script>
<style>
button
{
	border-color:#FFF ;
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
}
.current
{
	font-weight:bold;
	color: #000;
}
</style>
<script type="text/javascript">
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
$(".mar").html(html);
} 
});
});
});

function target_popup(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=250,height=479"); 
    form.target = 'formpopup';
}
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}
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
      <span class="style8">گزارش اختصاصی اطلاعات زراعی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="942" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
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
                 <td width="155"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
    <option value="-1">-- انتخاب استان --</option>
    <?php foreach($ostans as $o): ?>
    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
    <?php endforeach; ?>
</select></td>
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="55" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="55" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: نوع کشت</font></td>
                 <td align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select name="id_city" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl"  >
    <option value="">-- انتخاب شهرستان --</option>
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
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
                 </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select name="add_abadi" class="input_text" id="abadi" style="width:170px ; height:40px" dir="rtl" >
      <option value="">-- انتخاب آبادی --</option>
 <?php
      // کد PHP برای پر کردن دراپ‌دان آبادی
if (!empty($id_mar) && !empty($add_abadi)) {
    $stmt_abadi = $dbh->prepare("SELECT add_abadi, abadi FROM abadiname WHERE id_mar = ? ORDER BY BINARY abadi ASC");
    $stmt_abadi->execute(array($id_mar));
    $abadies = $stmt_abadi->fetchAll(PDO::FETCH_ASSOC);
    foreach ($abadies as $a) {
        echo '<option value="' . $a['add_abadi'] . '"' . (($a['add_abadi'] == $add_abadi) ? ' selected="selected"' : '') . '>' . htmlspecialchars($a['abadi'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
}?>
      </select></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
    <option value="">-- انتخاب مرکز --</option>
    <?php
    // If a city and markaz were previously selected, load the markazes for that city
    if (!empty($id_city) && !empty($id_mar)) {
        $stmt_markazes = $dbh->prepare("SELECT id_mar, mar FROM marname WHERE id_city = ? ORDER BY BINARY mar ASC");
        $stmt_markazes->execute(array($id_city));
        $markazes = $stmt_markazes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($markazes as $m) {
            echo '<option value="' . $m['id_mar'] . '"' . (($m['id_mar'] == $id_mar) ? ' selected="selected"' : '') . '>' . htmlspecialchars($m['mar'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
    ?>
</select>
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select name="add_city" class="input_text" id="shahr" style="width:170px ; height:40px" dir="rtl" >
      <option value="">-- انتخاب شهر --</option>
   <?php
   // کد PHP برای پر کردن دراپ‌دان شهر
if (!empty($id_mar) && !empty($add_city)) {
    $stmt_shahr = $dbh->prepare("SELECT add_city, shahr FROM shahrname WHERE id_mar = ? ORDER BY BINARY shahr ASC");
    $stmt_shahr->execute(array($id_mar));
    $shahrs = $stmt_shahr->fetchAll(PDO::FETCH_ASSOC);
    foreach ($shahrs as $s) {
        echo '<option value="' . $s['add_city'] . '"' . (($s['add_city'] == $add_city) ? ' selected="selected"' : '') . '>' . htmlspecialchars($s['shahr'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
}
   ?>
      </select></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:نام شهر</td>
               </tr>
               <tr >
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div></td>
                 <td height="54" align="right" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                   </div></td>
                 <td height="54"  align='center' class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="52" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                     <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                     <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                     <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                     <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                     <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                     <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                   </select>
                 </div></td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">:نحوه آبیاری</font></td>
                 <td width="175" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                     <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                     <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                     <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                     <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                     <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                     <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                     <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                     <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                     <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                     <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                   </select>
                 </div></td>
                 <td width="166"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: منبع آب</font></td>
               </tr>
               <tr >
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text mar" id="mah_name" style="width:170px ; height:40px" tabindex="23" dir="rtl">
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
                 <td height="44"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: نام محصول</td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
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
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka2" type="text" class="input_text" id="zka2"  style="height:35px ; width:70px " value="<?php echo $zka2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zka1" type="text" class="input_text" id="zka1"  style="height:35px ; width:70px " value="<?php echo $zka1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت اول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zkb2" type="text" class="input_text" id="zkb2"  style="height:35px ; width:70px " value="<?php echo $zkb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="zkb1" type="text" class="input_text" id="zkb1"  style="height:35px ; width:70px " value="<?php echo $zkb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت دوم<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba2" type="text" class="input_text" id="sba2"  style="height:35px ; width:70px " value="<?php echo $sba2?>" />
                 </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sba1" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " value="<?php echo $sba1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح  برداشت اول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sbb2" type="text" class="input_text" id="sbb2"  style="height:35px ; width:70px " value="<?php echo $sbb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">هکتار </span>
                   <input name="sbb1" type="text" class="input_text" id="zkb4"  style="height:35px ; width:70px " value="<?php echo $sbb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">سطح  برداشت دوم<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp2" type="text" class="input_text" id="mtolp2"  style="height:35px ; width:70px " value="<?php echo $mtolp2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtolp1" type="text" class="input_text" id="mtol4"  style="height:35px ; width:70px " value="<?php echo $mtolp1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان پیش بینی محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                 </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol5"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="mah_bem" class="input_text  required" id="no_kesh"  style="height:40px ; width:150px ; direction:rtl">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                     <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                     </select>
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: محصول بیمه شده</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="mah_kh" class="input_text  required" id="no_kesh"  style="height:40px ; width:150px ; direction:rtl">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($mah_kh=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                     <option value="2" <?php if ($mah_kh=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                     </select>
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: محصول خسارت دیده</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="date_s2" type="text" id="date2" style="width:75px ; height:35px" tabindex="5" value="<?php echo $date_s2?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: تا تاریخ </font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="date_s1" type="text" id="date" style="width:75px ; height:35px" tabindex="4" value="<?php echo $date_s1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: تاریخ ثبت / ویرایش از</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
// ایجاد یک آرایه برای فیلترها
$filters = array(
    'date_s1' => $date_s1,
    'date_s2' => $date_s2,
    'id_ostan1' => $id_ostan1,
    'id_city' => $id_city,
    'id_mar' => $id_mar,
    'add_abadi' => $add_abadi,
    'add_city' => $add_city,
    'no_kesh' => $no_kesh,
    'm_ab' => $m_ab,
    'no_ab' => $no_ab,
    'mor_cod_m' => $mor_cod_m,
    'bah_cod_m' => $bah_cod_m,
    'mah_name' => $mah_name,
    'zka1' => $zka1,
    'zka2' => $zka2,
    'zkb1' => $zkb1,
    'zkb2' => $zkb2,
    'sba1' => $sba1,
    'sba2' => $sba2,
    'sbb1' => $sbb1,
    'sbb2' => $sbb2,
    'mtol1' => $mtol1,
    'mtol2' => $mtol2,
    'mtolp1' => $mtolp1,
    'mtolp2' => $mtolp2,
    'mah_kh' => $mah_kh,
    'mah_bem' => $mah_bem,
);

// ایجاد یک آرایه برای شرایط
$query_parts = array();

// بررسی و اضافه کردن هر فیلتر به آرایه شرایط
foreach ($filters as $key => $value) {
    if ($value != '') {
        switch ($key) {
            case 'date_s1':
                $query_parts[] = "$Agri_prod_table.date_s >= '$value'";
                break;
            case 'date_s2':
                $query_parts[] = "$Agri_prod_table.date_s <= '$value'";
                break;
            case 'id_ostan1':
                if ($value != '-1') {
                    $query_parts[] = "$Agri_prod_table.id_ostan = '$value'";
                }
                break;
            case 'id_city':
                $query_parts[] = "$Agri_prod_table.id_city = '$value'";
                break;
            case 'id_mar':
                $query_parts[] = "$Agri_prod_table.id_mar = '$value'";
                break;
            case 'add_abadi':
                $query_parts[] = "$Agri_prod_table.add_abadi = '$value'";
                break;
            case 'add_city':
                $query_parts[] = "$Agri_prod_table.add_city = '$value'";
                break;
            case 'no_kesh':
                $query_parts[] = "$Agri_prod_table.no_kesh = '$value'";
                break;
            case 'm_ab':
                $query_parts[] = "$Agri_table.m_ab = '$value'";
                break;
            case 'no_ab':
                $query_parts[] = "$Agri_table.no_ab = '$value'";
                break;
            case 'mor_cod_m':
                $query_parts[] = "$Agri_prod_table.mor_cod_m = '$value'";
                break;
            case 'bah_cod_m':
                $query_parts[] = "$Agri_prod_table.bah_cod_m = '$value'";
                break;
            case 'mah_name':
                $query_parts[] = "$Agri_prod_table.cod_mah = '$value'";
                break;
            case 'zka1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a >= '$value'";
                break;
            case 'zka2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a <= '$value'";
                break;
            case 'zkb1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b >= '$value'";
                break;
            case 'zkb2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b <= '$value'";
                break;
            case 'sba1':
                $query_parts[] = "$Agri_prod_table.s_bar_a >= '$value'";
                break;
            case 'sba2':
                $query_parts[] = "$Agri_prod_table.s_bar_a <= '$value'";
                break;
            case 'sbb1':
                $query_parts[] = "$Agri_prod_table.s_bar_b >= '$value'";
                break;
            case 'sbb2':
                $query_parts[] = "$Agri_prod_table.s_bar_b <= '$value'";
                break;
            case 'mtol1':
                $query_parts[] = "$Agri_prod_table.mah_tol >= '$value'";
                break;
            case 'mtol2':
                $query_parts[] = "$Agri_prod_table.mah_tol <= '$value'";
                break;
            case 'mtolp1':
                $query_parts[] = "$Agri_prod_table.mah_tolp >= '$value'";
                break;
            case 'mtolp2':
                $query_parts[] = "$Agri_prod_table.mah_tolp <= '$value'";
                break;
            case 'mah_kh':
                $query_parts[] = "$Agri_prod_table.mah_kh = '$value'";
                break;
            case 'mah_bem':
                $query_parts[] = "$Agri_prod_table.mah_bem = '$value'";
                break;
        }
    }
}

// ایجاد شرایط کوئری
$query_conditions = implode(' AND ', $query_parts);
// ایجاد کوئری نهایی
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT $Agri_prod_table.*, $Agri_table.m_ab, $Agri_table.no_ab
          FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          WHERE $query_conditions
          ORDER BY bah_cod_m ASC
          LIMIT $start, $limit";
 $query1 = "SELECT count(*)  FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          WHERE $query_conditions
"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep172_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="m_ab"       value="<?php echo  $m_ab ;?>" />
                   <input type="hidden" name="no_ab"      value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bem"  value="<?php echo $mah_bem ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />
                   <input type="hidden" name="date_s1"  value="<?php echo $date_s1 ;?>" />
                   <input type="hidden" name="date_s2"  value="<?php echo $date_s2 ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Agri_rep172_doc.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bem"  value="<?php echo $mah_bem ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />
                   <input type="hidden" name="date_s1"  value="<?php echo $date_s1 ;?>" />
                   <input type="hidden" name="date_s2"  value="<?php echo $date_s2 ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <span class="style8">فقط قطعات دارای محصول در محاسبه شرکت داده شده / قطعات دارای تنوع محصول 0 یا به عبارت دیگر قطعه ی که کلاً آیش ثبت شده محاسبه نگردیده</span><img src="../../files/con_info.png" title="دانلود نتایج با فرمت فایل ورد"  width="16" height="16"  alt=""/><br />
            <table width="85%" align="center" class="my-table" >
              <tr class="text1">
                <td colspan="2" rowspan="3" bgcolor="#006699">عملیات</td>
                <td width="7%" rowspan="3" bgcolor="#006699">نام محصول</td>
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="6" bgcolor="#006699">مساحت/هکتار</td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="6%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="7%" rowspan="2" bgcolor="#006699">پیش بینی</td>
          <td colspan="3" bgcolor="#006699">سطح برداشت</td>
          <td  colspan="3" bgcolor="#006699">سطح زیر کشت</td>
          <td width="11%"  rowspan="2" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="17%" rowspan="2" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr class="text1">
          <td width="7%" bgcolor="#006699">کل</td>
          <td width="5%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول </td>
          <td width="6%"  bgcolor="#006699">کل</td>
          <td width="6%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> 
           <form  action="../send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
     </form></td>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Agri_id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
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
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    
    // Set visible pages range (3 before and after current page)
    $visible_pages = 3;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    $show_first = ($start_page > 1);
    $show_last = ($end_page < $total);
    
    // Function to generate hidden inputs
    function generate_hidden_inputs() {
        global $action, $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, 
               $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $mah_name, $zka1, $zka2, $zkb1, $zkb2, 
               $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_bem, $mah_kh;
        ?>
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
        <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
        <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar); ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
        <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($mor_cod_m); ?>" />
        <input type="hidden" name="no_kesh" value="<?php echo htmlspecialchars($no_kesh); ?>" />
        <input type="hidden" name="m_ab" value="<?php echo htmlspecialchars($m_ab); ?>" />
        <input type="hidden" name="no_ab" value="<?php echo htmlspecialchars($no_ab); ?>" />
        <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo htmlspecialchars($mah_qroup); ?>" />
        <input type="hidden" name="mah_name" value="<?php echo htmlspecialchars($mah_name); ?>" />
        <input type="hidden" name="zka1" value="<?php echo htmlspecialchars($zka1); ?>" />
        <input type="hidden" name="zka2" value="<?php echo htmlspecialchars($zka2); ?>" />
        <input type="hidden" name="zkb1" value="<?php echo htmlspecialchars($zkb1); ?>" />
        <input type="hidden" name="zkb2" value="<?php echo htmlspecialchars($zkb2); ?>" />
        <input type="hidden" name="sba1" value="<?php echo htmlspecialchars($sba1); ?>" />
        <input type="hidden" name="sba2" value="<?php echo htmlspecialchars($sba2); ?>" />
        <input type="hidden" name="sbb1" value="<?php echo htmlspecialchars($sbb1); ?>" />
        <input type="hidden" name="sbb2" value="<?php echo htmlspecialchars($sbb2); ?>" />
        <input type="hidden" name="mtolp1" value="<?php echo htmlspecialchars($mtolp1); ?>" />
        <input type="hidden" name="mtolp2" value="<?php echo htmlspecialchars($mtolp2); ?>" />
        <input type="hidden" name="mtol1" value="<?php echo htmlspecialchars($mtol1); ?>" />
        <input type="hidden" name="mtol2" value="<?php echo htmlspecialchars($mtol2); ?>" />
        <input type="hidden" name="mah_bem" value="<?php echo htmlspecialchars($mah_bem); ?>" />
        <input type="hidden" name="mah_kh" value="<?php echo htmlspecialchars($mah_kh); ?>" />
        <?php
    }
    ?>
    
    <div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; background: #fff; padding: 15px; border-radius: 15px; width: 98%;">
        <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
            <?php if($id > 1): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="Agri_rep170.php?id=<?php echo $id-1 ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="Agri_rep170.php?id=1#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                    </form>
                </li>
                <?php if($start_page > 2): ?>
                    <li style="display: inline-block; margin: 2px; color: #999; padding: 5px 10px;">...</li>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <li style="display: inline-block; margin: 2px;">
                    <?php if($i == $id): ?>
                        <span style="background: #06C; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?php echo $i; ?></span>
                    <?php else: ?>
                        <form action="Agri_rep170.php?id=<?php echo $i ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs(); ?>
                            <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?php echo $i; ?></button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <?php if($show_last): ?>
                <?php if($end_page < $total - 1): ?>
                    <li style="display: inline-block; margin: 2px; color: #999; padding: 5px 10px;">...</li>
                <?php endif; ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="Agri_rep170.php?id=<?php echo $total ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($id < $total): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="Agri_rep170.php?id=<?php echo $id+1 ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top: 15px;">
            <form id="pageJumpForm" action="Agri_rep170.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
                <?php generate_hidden_inputs(); ?>
                <span style="font-size: 14px;">به صفحه:</span>
                <input type="number" name="page_input" min="1" max="<?php echo $total; ?>" 
                       value="<?php echo $id; ?>" 
                       style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
        const pageInput = this.querySelector('input[name="page_input"]');
        const pageNum = parseInt(pageInput.value);
        
        if (isNaN(pageNum)) {
            e.preventDefault();
            alert('لطفاً یک عدد وارد کنید');
            return;
        }
        
        if (pageNum < 1 || pageNum > <?php echo $total; ?>) {
            e.preventDefault();
            alert('لطفاً عددی بین 1 و <?php echo $total; ?> وارد کنید');
            return;
        }
        
        this.action = `Agri_rep170.php?id=${pageNum}#1`;
    });
    </script>
<?php } ?>
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