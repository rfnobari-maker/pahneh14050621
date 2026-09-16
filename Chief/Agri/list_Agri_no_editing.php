<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
$id_ostan1   = isset($_POST['id_ostan'])   ? $_POST['id_ostan']   : '';
$id_city     = isset($_POST['id_city5'])   ? $_POST['id_city5']   : '';
$id_mar      = isset($_POST['id_mar'])     ? $_POST['id_mar']     : '';
$no_kesh     = isset($_POST['no_kesh'])    ? $_POST['no_kesh']    : '';
$no_mal      = isset($_POST['no_mal'])     ? $_POST['no_mal']     : '';
$mor_cod_m   = isset($_POST['mor_cod_m'])  ? $_POST['mor_cod_m']  : '';
$bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '';
$m_cod_m     = isset($_POST['m_cod_m'])    ? $_POST['m_cod_m']    : '';
$z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
$ok          = isset($_POST['ok'])         ? $_POST['ok']         : '';
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
button
{
padding: 5px 15px;
text-decoration: none;
color: #000;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
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
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="../../location/ajax-location.js"></script>
  <script>
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
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
   <form  id="reg-form" method="post" action="#1">
             <p>&nbsp;</p>
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
             <table width="100%" height="361" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">لیست بهره برداری های زراعی فاقد ویرایش<span class="style8"><a name="1" id="1"></a></span></span></td>
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
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><font size="2" class="style8">: سال زراعی</font></td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="style8" id="ostan" style="width:170px ; height:40px" dir="rtl" >
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
                 <td width="209" height="46" align="right" bgcolor="#FFFFFF" class="input_text" >                 <select  name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl">
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
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="131" align="center" bgcolor="#FFFFFF" class="input_text" ><span class="style8"><font size="2" class="style8">: مرکز </font></span></td>
                 <td width="197" align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="id_city5" class="style8" id="shahrestan" style="width:170px ; height:40px" dir="rtl" >
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
                 <td width="163"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span style="text-align: right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </span></div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><span class="style1"><font size="2" class="style8">: نوع کشت</font></span></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if ($no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if ($no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if ($no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if ($no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if ($no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if ($no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                   </select>
                 </div></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style8"><span class="style1"><font size="2" class="style8">: نوع مالکیت</font></span></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                 </span></div></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><span class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></span></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                 </span></div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"><font size="2" class="style8">: کد ملی مروج</font></span></td>
               </tr>
               <tr >
                 <td height="60" align="left"><div align="right"><span style="text-align: right">
                   <select  name="ok"  class="input_text" id="ok" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" <?php if ($ok == '') echo "selected=selected" ?>>همه موارد </option>
                     <option value="4"  <?php if ($ok == '4') echo "selected=selected" ?>>تایید نشده</option>
                     <option value="1" <?php if ($ok == '1') echo "selected=selected" ?>>زنده</option>
                     <option value="2" <?php if ($ok == '2') echo "selected=selected" ?>>فوتی</option>
                   </select>
                 </span></div></td>
                 <td height="60" align="left"><span class="style8">: وضعیت حیات بهره بردار</span></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="m_cod_m" type="text" class="input_text" id="m_cod_m"  style="height:35px ; width:170px " value="<?php echo $m_cod_m?>" />
                 </span></div></td>
 <td height="54"  align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"><font size="2" class="style8">: کد ملی مالک</font></span></td>                 </tr>
               <tr >
                 <td colspan="3" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
                 <td height="60"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
               </tr>
             </table> 
             </div>
   </form>
             <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan  = 1 ;}else{ $v_id_ostan = "$Agri_table.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   = 1 ;}else{ $v_id_city = "$Agri_table.id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    = 1 ;}else{ $v_id_mar = "$Agri_table.id_mar='$id_mar'" ;}
 if ($no_mal  == '0')    {$f_no_mal    = 1 ;}else{ $f_no_mal = "$Agri_table.no_mal = '$no_mal'" ;}
 if ($no_kesh == '0')    {$f_no_kesh   = 1 ;}else{ $f_no_kesh = "$Agri_table.no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m = 1 ;}else{ $v_mor_cod_m = "$Agri_table.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m = 1 ;}else{ $v_bah_cod_m = "$Agri_table.bah_cod_m = '$bah_cod_m'" ;}
 if ($m_cod_m == '')     {$v_m_cod_m   = 1 ;}else{ $v_m_cod_m = "$Agri_table.m_cod_m = '$m_cod_m'" ;}
 if ($ok == '')          { $f_ok  = 1      ; }else{ $f_ok = "bah.ok = '$ok'" ;}
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT $Agri_table.id,$Agri_table.id_ostan,$Agri_table.id_city,$Agri_table.add_abadi,$Agri_table.add_city
,$Agri_table.m_cod_m,$Agri_table.bah_cod_m,$Agri_table.mor_cod_m,$Agri_table.sh_gat,$Agri_table.no_mal,$Agri_table.no_kesh,$Agri_table.m_zamin,$Agri_table.t_mah,$Agri_table.z_sal ,bah.ok
from $Agri_table 
inner join bah ON $Agri_table.bah_cod_m = bah.bah_cod_m
  where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_m_cod_m and  $Agri_table.date_s not like '%/%' and $f_ok ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*) from $Agri_table 
inner join bah ON $Agri_table.bah_cod_m = bah.bah_cod_m
  where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_m_cod_m and  $Agri_table.date_s not like '%/%' and $f_ok "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td><form  action="list_Agri_no_editing_xls.php" method="post">
                 <input type="hidden" name="id_ostan2" value="<?php echo $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
                 <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
                 <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
                 <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
                 <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
                 <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                 <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
                 <input type="hidden" name="ok" value="<?php  echo $ok ;?>" />                 
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
      </table>
 <table width="85%"  align="center" class="my-table" >
             <tr class="text1">
          <td width="6%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="6%" rowspan="2" bordercolor="#CCCCCC" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            هکتار</td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="8%" rowspan="2" bgcolor="#006699">نوع مالکیت</td>
          <td width="9%" rowspan="2" bgcolor="#006699">کد ملی مالک</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td height="35" colspan="3" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" bgcolor="#006699">وضعیت حیات</td>
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
          <td width="8%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
 if($row['ok'] == '3') $v_ok = 'در حال استعلام' ;
 if($row['ok'] == '1') $v_ok = 'زنده' ;
 if($row['ok'] == '2') $v_ok = 'فوتی' ;
 if($row['ok'] == '4') $v_ok = 'تایید نشده' ;

  ?>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
            <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
            <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
            <?php echo user_name($row['mor_cod_m'])?><br/>
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
          </p></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $v_ok ;?></span></td>
          <td height="108" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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
// Execute query and calculate total pages
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);

// Function to generate hidden inputs (reduces code duplication)
function generate_hidden_inputs() {
    global $id_ostan1, $id_city, $id_mar, $bah_cod_m, $m_cod_m, $mor_cod_m, 
           $no_kesh, $no_mal, $z_sal, $ok;
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
    <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
    <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
    <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
    <input type="hidden" name="m_cod_m" value="<?= htmlspecialchars($m_cod_m) ?>" />
    <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($mor_cod_m) ?>" />
    <input type="hidden" name="no_kesh" value="<?= htmlspecialchars($no_kesh) ?>" />
    <input type="hidden" name="no_mal" value="<?= htmlspecialchars($no_mal) ?>" />
    <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
    <input type="hidden" name="ok" value="<?= htmlspecialchars($ok) ?>" />
    <?php
}

// Define visible pages range (shows 5 pages at a time)
$visible_pages = 5;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);
?>

<div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
    <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
        <?php if($id > 1): ?>
            <li style="display: inline-block;">
                <form action="list_Agri_no_editing.php?id=<?= $id-1 ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <li style="display: inline-block;">
                <form action="list_Agri_no_editing.php?id=1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li style="display: inline-block;">
                <?php if($i == $id): ?>
                    <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                <?php else: ?>
                    <form action="list_Agri_no_editing.php?id=<?= $i ?>" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if($end_page < $total): ?>
            <?php if($end_page < $total - 1): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
            <li style="display: inline-block;">
                <form action="list_Agri_no_editing.php?id=<?= $total ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($id < $total): ?>
            <li style="display: inline-block;">
                <form action="list_Agri_no_editing.php?id=<?= $id+1 ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                </form>
            </li>
    </ul>

    <div class="page-jump" style="margin-top: 15px;">
        <form action="list_Agri_no_editing.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
            <?php generate_hidden_inputs(); ?>
            <span style="font-size: 14px;"> به صفحه:</span>
            <input type="number" name="page_input"  
                   value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
        </form>
        <?php endif; ?>
    </div>
</div>

<script>
document.querySelector('.page-jump form').addEventListener('submit', function(e) {
    const pageInput = this.querySelector('input[name="page_input"]');
    const pageNum = parseInt(pageInput.value);
    
    if (isNaN(pageNum)) {
        e.preventDefault();
        alert('لطفاً یک عدد معتبر وارد کنید');
        return;
    }
    
    if (pageNum < 1 || pageNum > <?= $total ?>) {
        e.preventDefault();
        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
        return;
    }
    
    this.action = `list_Agri_no_editing.php?id=${pageNum}`;
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