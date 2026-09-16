<?php 
include('../../lock_oce.php');
include('../../event.php');
$id_ostan1   = isset($_POST['id_ostan'])   ? $_POST['id_ostan']   : '' ;
$id_city     = isset($_POST['id_city5'])   ? $_POST['id_city5']   : '' ;
$id_mar      = isset($_POST['id_mar'])     ? $_POST['id_mar']     : '' ;
$no_kesh     = isset($_POST['no_kesh'])    ? $_POST['no_kesh']    : '' ;
$no_mal      = isset($_POST['no_mal'])     ? $_POST['no_mal']     : '' ;
$mor_cod_m   = isset($_POST['mor_cod_m'])  ? $_POST['mor_cod_m']  : '' ;
$bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '' ;
$m_cod_m     = isset($_POST['m_cod_m'])    ? $_POST['m_cod_m']    : '' ;
$z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '' ;
$t_mah       = isset($_POST['t_mah'])      ? $_POST['t_mah']      : '' ;
$ok          = isset($_POST['ok'])         ? $_POST['ok']         : '' ;
$Agri_table  = 'Agri'.str_replace('-','_', $z_sal) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
<style type="text/css">
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
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
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
   <form  id="reg-form" method="post" action="#2">
             <p>&nbsp;</p>
             <div style="width: 600px; padding: 5px; border: 2px solid navy; margin: auto; text-align: left; border-radius:15px" >
             <table width="100%" height="355" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">لیست بهره برداری های زراعی<span class="style8"><a name="2" id="122"></a></span></span></td>
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
                   <?php $id_ostan1 = $id_ostan ; ?>
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="-1">انتخاب استان</option>
                   <?php
$query = "SELECT id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                   <?php 
		   }?>
                 </select>
                   <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="209" height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl">
                   <option value="0"> نام مرکز</option>
                   <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                   <?php }?>
                 </select>
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="131" align="center" bgcolor="#FFFFFF" class="input_text" ><span class="style8"><font size="2" class="style8">: مرکز </font></span></td>
                 <td width="197" align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                   <?php }?>
                 </select>
                   <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
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
                 <td bgcolor="#FFFFFF"><div align="right">
                   <select name="t_mah" class="input_text  required" id="t_mah" style="height:40px ; width:170px ; direction:rtl">
                     <option value='-1' >انتخاب تنوع محصول</option>
                     <option value="0" <?php if (isset($t_mah) && $t_mah==0) { echo 'selected="selected"';}?>>صفر</option>
                     <option value="1" <?php if (isset($t_mah) && $t_mah==1) { echo 'selected="selected"';}?>>1</option>
                     <option value="2" <?php if (isset($t_mah) && $t_mah==2) { echo 'selected="selected"';}?>>2</option>
                     <option value="3" <?php if (isset($t_mah) && $t_mah==3) { echo 'selected="selected"';}?>>3</option>
                     <option value="4" <?php if (isset($t_mah) && $t_mah==4) { echo 'selected="selected"';}?>>بزرگتر از 3</option>
                   </select>
                 </div></td>
                 <td bgcolor="#FFFFFF"><font size="2" class="style8">:  تنوع محصول</font></td>
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
 if ($t_mah =='-1') { $v_t_mah = 1;}else{ $v_t_mah = "t_mah = '$t_mah'" ;}
 if ($t_mah =='4') { $v_t_mah = "t_mah >= '$t_mah'" ;}

 include('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT id,id_ostan,id_city,add_abadi,add_city,m_cod_m,bah_cod_m,mor_cod_m,sh_gat,no_mal,no_kesh,m_zamin,t_mah,z_sal from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_m_cod_m and $v_t_mah ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*) from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m  and $v_m_cod_m  and $v_t_mah  "; 
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
        <input type="hidden" name="t_mah" value="<?php  echo $t_mah ;?>" />

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
        <input type="hidden" name="t_mah" value="<?php  echo $t_mah ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
         </table>
           <span class="style8"><a name="1" id="12"></a></span>
           <table  align="center" class="my-table" >
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
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
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
  ?>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
            <input type="hidden" name="id"  value=<?php echo $row['id'] ;?> />
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
          <td height="119" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
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
    
    // تعیین محدوده صفحات برای نمایش (5 صفحه در هر طرف صفحه فعلی)
    $visible_pages = 5;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    // تابع برای تولید فیلدهای مخفی
    function generate_hidden_inputs() {
        global $id_ostan1, $id_city, $id_mar, $bah_cod_m, $m_cod_m, $mor_cod_m, 
               $no_kesh, $no_mal, $z_sal, $t_mah;
        ?>
        <input type="hidden" name="action" value="1" />
<input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars(isset($id_ostan1) ? $id_ostan1 : ''); ?>" />
<input type="hidden" name="id_city5" value="<?php echo htmlspecialchars(isset($id_city) ? $id_city : ''); ?>" />
<input type="hidden" name="id_mar" value="<?php echo htmlspecialchars(isset($id_mar) ? $id_mar : ''); ?>" />
<input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars(isset($bah_cod_m) ? $bah_cod_m : ''); ?>" />
<input type="hidden" name="m_cod_m" value="<?php echo htmlspecialchars(isset($m_cod_m) ? $m_cod_m : ''); ?>" />
<input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars(isset($mor_cod_m) ? $mor_cod_m : ''); ?>" />
<input type="hidden" name="no_kesh" value="<?php echo htmlspecialchars(isset($no_kesh) ? $no_kesh : ''); ?>" />
<input type="hidden" name="no_mal" value="<?php echo htmlspecialchars(isset($no_mal) ? $no_mal : ''); ?>" />
<input type="hidden" name="z_sal" value="<?php echo htmlspecialchars(isset($z_sal) ? $z_sal : ''); ?>" />
<input type="hidden" name="t_mah" value="<?php echo htmlspecialchars(isset($t_mah) ? $t_mah : ''); ?>" />
        <?php
    }
    ?>
    
    <div class="pagination-container" dir="rtl" style="text-align:center; margin:20px auto; padding:15px; background:#f8f8f8; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1)">
        <ul class="pagination" style="list-style:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap; gap:5px;">
            <?php if($id > 1): ?>
                <li style="display:inline-block;">
                  <form action="liste_Agri.php?id=<?= $id-1 ?>#1" method="post" style="display:inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background:#4CAF50; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer; font-size:14px;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($start_page > 1): ?>
                <li style="display:inline-block;">
                  <form action="liste_Agri.php?id=1 #1" method="post" style="display:inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background:#f1f1f1; color:#333; border:1px solid #ddd; padding:6px 12px; border-radius:4px; cursor:pointer;">1</button>
                    </form>
                </li>
                <?php if($start_page > 2): ?>
                    <li style="display:inline-block; color:#999; padding:6px 10px;">...</li>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <li style="display:inline-block;">
                    <?php if($i == $id): ?>
                        <span style="background:#4CAF50; color:white; padding:8px 14px; border-radius:4px; display:inline-block; font-weight:bold;"><?= $i ?></span>
                    <?php else: ?>
                  <form action="liste_Agri.php?id=<?= $i ?> #1" method="post" style="display:inline;">
                            <?php generate_hidden_inputs(); ?>
                            <button type="submit" class="button" style="background:#f1f1f1; color:#333; border:1px solid #ddd; padding:6px 12px; border-radius:4px; cursor:pointer;"><?= $i ?></button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <?php if($end_page < $total): ?>
                <?php if($end_page < $total - 1): ?>
                    <li style="display:inline-block; color:#999; padding:6px 10px;">...</li>
                <?php endif; ?>
                <li style="display:inline-block;">
                  <form action="liste_Agri.php?id=<?= $total ?> #1" method="post" style="display:inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background:#f1f1f1; color:#333; border:1px solid #ddd; padding:6px 12px; border-radius:4px; cursor:pointer;"><?= $total ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($id < $total): ?>
                <li style="display:inline-block;">
                  <form action="liste_Agri.php?id=<?= $id+1 ?> #1" method="post" style="display:inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background:#4CAF50; color:white; border:none; padding:8px 15px; border-radius:4px; cursor:pointer; font-size:14px;">بعدی &raquo;</button>
                    </form>
                </li>
         
        </ul>
        
        <div class="page-jump" style="margin-top:15px;">
            <form id="pageJumpForm" action="liste_Agri.php" method="post" style="display:inline-block;">
                <?php generate_hidden_inputs(); ?>
                <span style="font-size:14px; margin-left:10px;">برو به صفحه:</span>
                <input type="number" 
                       id="pageIdInput"
                       name="page_input"
                       min="1"
                        value="<?= $id?>"
                       style="width:60px; padding:6px; border:1px solid #ddd; border-radius:4px; text-align:center;">
                <button type="submit" class="button" style="background:#4CAF50; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
            </form>
               <?php endif; ?>
        </div>
        
        <script>
        document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
            var input = document.getElementById('pageIdInput');
            var pageId = parseInt(input.value);
            if (isNaN(pageId) || pageId < 1 || pageId > <?= $total ?>) {
                e.preventDefault();
                alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
                input.focus();
            } else {
                this.action = 'liste_Agri.php?id=' + pageId+'#1';
            }
        });
        </script>
    </div>
<?php } ?>
</div>
          <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

    </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>