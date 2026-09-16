<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');

$id_ostan1    = isset($_POST['id_ostan'])    ? $_POST['id_ostan']    : '';
$id_city      = isset($_POST['id_city5'])    ? $_POST['id_city5']    : '';
$id_mar       = isset($_POST['id_mar'])      ? $_POST['id_mar']      : '';
$add_abadi    = isset($_POST['add_abadi'])   ? $_POST['add_abadi']   : '';
$add_city     = isset($_POST['add_city'])    ? $_POST['add_city']    : '';
$no_kesh      = isset($_POST['no_kesh'])     ? $_POST['no_kesh']     : '';
$mor_cod_m    = isset($_POST['mor_cod_m'])   ? $_POST['mor_cod_m']   : '';
$bah_cod_m    = isset($_POST['bah_cod_m'])   ? $_POST['bah_cod_m']   : '';
$z_sal        = isset($_POST['z_sal'])       ? $_POST['z_sal']       : '';
$mah_qroup    = isset($_POST['mah_qroup'])   ? $_POST['mah_qroup']   : '';

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
      <span class="style8">گزارش گروه محصولات زراعی </span>
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="382" border='0' align="center" cellpadding='0' cellspacing='0'>
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
                   <select name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
    <option value="-1">-- انتخاب استان --</option>
    <?php foreach($ostans as $o): ?>
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
                   <select name="id_city5" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl"  >
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
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8">&nbsp;</td>
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
    $stmt_abadi = $dbh->prepare("SELECT add_abadi, abadi FROM abadiname WHERE id_mar = ? ORDER BY BINARY abadi ASC");
    $stmt_abadi->execute(array($id_mar));
    $abadies = $stmt_abadi->fetchAll(PDO::FETCH_ASSOC);
    foreach ($abadies as $a) {
        echo '<option value="' . $a['add_abadi'] . '"' . (($a['add_abadi'] == $add_abadi) ? ' selected="selected"' : '') . '>' . htmlspecialchars($a['abadi'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
}?>
      </select></td>
                 <td height="42"  align='center' bgcolor="#FFFFFF" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
    <option value="0">-- انتخاب مرکز --</option>
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
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="146" rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><select name="add_city" class="input_text" id="shahr" style="width:170px ; height:40px" dir="rtl" >
      <option value="0">-- انتخاب شهر --</option>
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
                 <td height="47"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
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
// تعریف متغیرها و آرایه شرایط با استفاده از تابع array()
$conditions = array();
$params = array();
if ($id_ostan1 != '-1') {
    $conditions[] = "id_ostan = ?";
    $params[] = $id_ostan1;
}
if ($id_city != 0) {
    $conditions[] = "id_city = ?";
    $params[] = $id_city;
}
if ($id_mar != 0) {
    $conditions[] = "id_mar = ?";
    $params[] = $id_mar;
}
if ($add_abadi != 0) {
    $conditions[] = "add_abadi = ?";
    $params[] = $add_abadi;
}
if ($add_city != 0) {
    $conditions[] = "add_city = ?";
    $params[] = $add_city;
}
if ($no_kesh != '0') {
    $conditions[] = "no_kesh = ?";
    $params[] = $no_kesh;
}
if ($mor_cod_m != '') {
    $conditions[] = "mor_cod_m = ?";
    $params[] = $mor_cod_m;
}
if ($bah_cod_m != '') {
    $conditions[] = "bah_cod_m = ?";
    $params[] = $bah_cod_m;
}
if ($mah_qroup != '') {
    $conditions[] = "cod_qroup = ?";
    $params[] = $mah_qroup;
}
// ساختن کوئری SQL
$whereClause = implode(' AND ', $conditions);
 $query = "
    SELECT cod_qroup,
           SUM(zer_kesht_a) AS zer_keshta,
           SUM(zer_kesht_b) AS zer_keshtb,
           SUM(s_bar_a) AS s_bara,
           SUM(s_bar_b) AS s_barb,
           SUM(mah_tol) AS mahtol,
           SUM(mah_tolp) AS mahtolp
    FROM $Agri_prod_table
    WHERE $whereClause
      AND cod_qroup != ''
    GROUP BY cod_qroup ";
// آماده‌سازی و اجرای کوئری
$stmt = $dbh->prepare($query);
$stmt->execute($params);
$t_row = $stmt->rowCount();
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep160_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_qroup" value="<?php echo $cod_qroup ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                            <td width="56"><form  action="Agri_rep160_doc.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_qroup" value="<?php echo $cod_qroup ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <table class="my-table" width="85%" height="128" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="46" colspan="2" bgcolor="#999999">میزان تولید محصول<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت <br />
                <span class="style2">هکتار</span></td>
               <td width="19%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">قطعی</td>
               <td bgcolor="#999999">پیش بینی</td>
               <td width="11%" height="38" bgcolor="#999999">کل</td>
               <td width="10%" bgcolor="#999999">کشت دوم</td>
               <td width="9%" bgcolor="#999999">کشت اول</td>
               <td height="38" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">کشت دوم</td>
               <td width="8%" bgcolor="#999999">کشت اول</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $zer_keshta = round($row['zer_keshta'],3) ;
 $zer_keshtb = round($row['zer_keshtb'],3) ;
 $zer_keshtkol =  $zer_keshta + $zer_keshtb ; 
 $s_bara = round($row['s_bara'],3) ;
 $s_barb = round($row['s_barb'],3) ;
 $s_barkol =  $s_bara + $s_barb ;
 $mahtol= round($row['mahtol'],3) ; 
 $mahtolp= round($row['mahtolp'],3) ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="40" ><?php echo $mahtol ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="11%" ><?php echo $mahtolp ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barkol ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barb ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_bara ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtkol ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtb ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshta ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo group_name($row['cod_qroup']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
}
?>
       </table>
<?php }?>
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