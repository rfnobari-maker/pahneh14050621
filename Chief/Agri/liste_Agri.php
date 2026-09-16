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
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 

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
<script type="text/javascript">
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
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
border-color:#FFF
}
</style>
  <script>
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
   <form  id="reg-form" method="post" action="#1">
             <p>&nbsp;</p>
             <div style="width: 600px; padding: 5px; border: 2px solid navy; border-radius:15px ;  margin: auto; text-align: left;" >
             <table width="100%" height="355" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">لیست بهره برداری های زراعی <span class="style8"><a name="1" id="1"></a></span></span></td>
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

                 <select name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
    <option value="-1">-- انتخاب استان --</option>
    <?php foreach($ostans as $o): ?>
    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
    <?php endforeach; ?>
</select></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="209" height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><select name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
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
                 <td width="131" align="center" bgcolor="#FFFFFF" class="input_text" ><span class="style8"><font size="2" class="style8">: مرکز </font></span></td>
                 <td width="197" align="right" bgcolor="#FFFFFF" class="input_text" >
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
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
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
 if ($id_ostan1 == '-1') {$v_id_ostan  = 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   = 1 ;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    = 1 ;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($no_mal  == '0')    {$f_no_mal    = 1 ;}else{ $f_no_mal = "no_mal = '$no_mal'" ;}
 if ($no_kesh == '0')    {$f_no_kesh   = 1 ;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($m_cod_m == '')     {$v_m_cod_m   = 1 ;}else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT id,id_ostan,id_city,add_abadi,add_city,m_cod_m,bah_cod_m,mor_cod_m,sh_gat,no_mal,no_kesh,m_zamin,t_mah,z_sal from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_m_cod_m ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*) from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m  and $v_m_cod_m   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="list_Agri_xls.php" method="post">
        <input type="hidden" name="id_ostan2" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="list_Agri_doc.php" method="post">
        <input type="hidden" name="id_ostan2" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php  echo $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php  echo $id_mar ;?>" />
        <input type="hidden" name="no_mal" value="<?php   echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php  echo $no_kesh ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php  echo $mor_cod_m ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php  echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php  echo $z_sal ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <table class="my-table"  width="85%"  align="center" >
             <tr class="text1">
          <td width="8%" rowspan="2" bgcolor="#999999">عملیات</td>
          <td width="8%" rowspan="2" bordercolor="#CCCCCC" bgcolor="#999999">کارشناس<br /></td>
          <td width="7%" rowspan="2" bgcolor="#999999">مساحت زمین<br />
            هکتار</td>
          <td width="5%" rowspan="2" bgcolor="#999999">نوع کشت</td>
          <td width="6%" rowspan="2" bgcolor="#999999">نوع مالکیت</td>
          <td width="9%" rowspan="2" bgcolor="#999999">کد ملی مالک</td>
          <td width="5%" rowspan="2" bgcolor="#999999">شماره قطعه</td>
          <td height="35" colspan="2" bgcolor="#999999">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#999999">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#999999">کد ملی </td>
          <td width="12%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#999999">شهر/آبادی</td>
          <td width="9%" bgcolor="#999999">شهرستان</td>
          <td width="8%" bgcolor="#999999">استان</td>
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
  ?>
          <td height="73" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
            <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
            <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
            <?php echo user_name($row['mor_cod_m'])?><br/>
            <?php echo $row['mor_cod_m']?><br />
          <?php echo user_tel($row['mor_cod_m'])?><br /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
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
if(isset($query1)) {
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
                    <form action="liste_Agri.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Agri.php?id=1#1" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
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
                            <input type="hidden" name="action" value="1" />
                            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                            <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                            <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                            <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                            <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                            <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                            <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
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
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($id != $total): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Agri.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top:10px;">
            <form id="pageJumpForm" action="liste_Agri.php" method="post" style="display:inline-block;">
                <input type="hidden" name="action" value="1" />
                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
                <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                <span style="font-size:18px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
                <input type="number" 
                       id="pageIdInput"
                       name="page_input"
                       value="<?php echo isset($id) ? (int)$id : 1; ?>" 
                       placeholder="شماره صفحه" 
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
            this.action = 'liste_Agri.php?id=' + pageId + '#1';
        } else {
            e.preventDefault();
            alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
        }
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