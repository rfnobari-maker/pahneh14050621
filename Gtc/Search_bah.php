<?php include('../lock_Gtc.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$days_ago = 1 ; 
?>
<?php
   if (isset($_POST['id_ostan']))
{
    $id_ostan = $_POST['id_ostan'] ; 
    $no_bah =   $_POST['no_bah'] ; 
    $meli =     $_POST['meli'] ; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
  <p>
    <?php 
include('top.php'); 
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p>
<div align="center"  style=" margin:auto ; padding:25px ;  font-family:tahoma; font-size:16px ; background-color:#CC9 ; width:450px ;  border-radius: 25px ">
<form method="post" name="form1" id="form"  action="#1">
  <table width="93%" border='0' align="center" cellpadding='0' cellspacing='0'>
    <tr bgcolor='#f1f1f1' >
      <td height="40" colspan='2' align='center' bgcolor="#CCCC99"><span class="style1">استعلام اطلاعات گندمکار</span></td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td width="297" height="55" align="right" bgcolor="#CCCC99" class="input_text" >
        <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  >
          <option value="-1">انتخاب استان</option>
          <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM `public_abadi4` ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
        </select>
</td>
      <td align="right" bgcolor="#CCCC99"><font size="2" class="style8"><div align="right">: استان</div></font></td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td height="45" align="right" bgcolor="#CCCC99" class="input_text" >
        <select dir="rtl"  name="no_bah" id="no_bah" style="width:170px ; height:40px"  >
          <option value="0">نوع بهره بردار</option>
          <option value="1" <?php if ($no_bah=='1') echo 'selected=selected'?>>حقیقی</option>
          <option value="2" <?php if ($no_bah=='2') echo 'selected=selected'?>>حقوقی</option>
        </select>
</td>
      <td bgcolor="#CCCC99"><font size="2" class="style8"><div align="right">: نوع بهره بردار</div></font></td>
    </tr>
    <tr >
      <td height="12" align="right" bgcolor="#CCCC99" class="input_text" >
        <p>
          <input name="meli" class="input_text" value="<?php echo $meli?>" style="width:120px ; height:30px ; direction:ltr  "  />
       </td>
      <td width="122" height="52"  align='center' bgcolor="#CCCC99" class="style8"><font size="2" class="style8"><div align="right">: کد / شناسه ملی</div></font></td>
    </tr>
    <tr >
      <td><p align="center"><input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" /></td>
      </tr>
  </table>
</form>
</div>
    </table>
 <?php if(isset($_POST['action']))  { 
if ($no_bah == '1'){ $v_no_bah = 'حقیقی' ; $v_meli = 1 ;                       $v_bah_cod_m = "bah_cod_m = '$meli'" ;}
if ($no_bah == '2'){ $v_no_bah = 'حقوقی' ; $v_meli = "bah.sh_meli='$meli'"  ;  $v_bah_cod_m  = 1 ; }
$query = "SELECT 
bah.`no_bah` ,
Agri_prod.`num_bah` ,
Agri_prod.`bah_cod_m` ,
bah.`last_name` ,
bah.`name` ,
bah.`co_name` ,
bah.`sh_meli` ,
sum(Agri_prod.mah_tolp) as  mah_tolp
FROM (
SELECT *
FROM Agri_prod
WHERE `z_sal` = '1396-1397'
AND `cod_mah` = '102'
AND `cod_qroup` = '1'
and `id_ostan`  = '$id_ostan'
and $v_bah_cod_m
)Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
where bah.no_bah = '$no_bah'  and $v_meli
GROUP BY Agri_prod.bah_cod_m, Agri_prod.`id_ostan`,Agri_prod.`num_bah`   ";
$stmt = $dbh->prepare($query);
$stmt->execute();
if($stmt -> rowCount() > 0){
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($no_bah == '1'){ $row['co_name'] = '-' ; $row['sh_meli'] = '-' ; }
if ($no_bah == '2'){ $row['name'] = '-' ; $row['last_name'] = '-' ; $row['bah_cod_m'] = '-' ; }
?>
  <p>&nbsp;</p>
  <table width="95%" height="112" border="1" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td width="18%" bgcolor="#999999">میزان پیش بینی تولید <br />
        <span class="style2">تن</span></td>
      <td width="14%" height="46" bgcolor="#999999">شناسه ملی</td>
      <td width="18%" bgcolor="#999999">نام شرکت</td>
      <td width="12%" bgcolor="#999999">کد ملی</td>
      <td width="15%" bgcolor="#999999">نام خانوادگی</td>
      <td width="12%" bgcolor="#999999">نام</td>
      <td width="11%" bgcolor="#999999">نوع بهره بردار</td>
      </tr>
    <tr>
      <td  ><?php echo $row['mah_tolp'] * 1 ;?></td>
      <td  height="48" ><?php echo $row['sh_meli']?></td>
      <td ><?php echo $row['co_name']?></td>
      <td ><?php echo $row['bah_cod_m']?></td>
      <td ><?php echo $row['last_name']?></td>
      <td ><?php echo $row['name']?></td>
      <td ><?php echo $v_no_bah ; ?></td>
      </tr>
  </table>
    <?php
}
else 
{
	echo 'رکوردی یافت نشد ' ;
}
}
?>
  <p>&nbsp;</p>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>  
  </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>