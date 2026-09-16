<?php 
include('../../lock_ce.php');
include('bee_counter.php');
if(isset($_POST['id_ostan'])) $id_ostan = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
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
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="188" /></td>
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
      <?php include('top.php');?>
      </p>
        <p class="style1">گزارش زنبورستان به تفکیک شهرستان</p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55%" height="68"><div align="right">
                <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                  <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                  <?php 
		   }?>
                </select>
              </div></td>
              <td width="45%" class="style8">:  استان مورد نظر</td>
            </tr>
            <tr>
              <td height="68"><div align="right">
                <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                </select>
              </div></td>
              <td class="style8"> : سرشماری سال </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$sal = $_POST['sal'];
$query = "SELECT * from cityname where id_ostan = '$id_ostan1' order by binary cityname.city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<P  class="style1" align="center">گزارش زنبورداران به تفکیک استان بر اساس سرشماری سال : <?php echo $sal?></p>  
    <table width="98%" height="115" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="style1">
            <td width="2%" height="38" bgcolor="#999999">حوزوی</td>
            <td width="2%" bgcolor="#999999">دکتری</td>
            <td width="2%" bgcolor="#999999">فوق لیسانس</td>
            <td width="2%" bgcolor="#999999">لیسانس</td>
            <td width="2%" bgcolor="#999999">فوق دیپلم</td>
            <td width="3%" bgcolor="#999999">دیپلم</td>
            <td width="4%" bgcolor="#999999">سیکل</td>
            <td width="4%" bgcolor="#999999">خواندن و نوشتن</td>
            <td width="5%" bgcolor="#999999">بیسواد</td>
               <td width="6%" bgcolor="#999999">کل</td>
               <td width="7%" bgcolor="#999999">حقوقی</td>
               <td width="7%" bgcolor="#999999">حقیقی</td>
            <td width="7%" bgcolor="#999999">استان </td>
            <td width="3%" bgcolor="#999999">ردیف</td>
            </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ; 
$ostan = $row['ostan'] ; 
$query = "SELECT  
sum(CASE WHEN bah.no_bah = '1' THEN 1 ELSE 0 END ) no_bah1,
sum(CASE WHEN bah.no_bah = '2' THEN 1 ELSE 0 END ) no_bah2,
sum(CASE WHEN bah.m_tah  = '1'  THEN 1 ELSE 0 END ) m_tah1,
sum(CASE WHEN bah.m_tah  = '2'  THEN 1 ELSE 0 END ) m_tah2,
sum(CASE WHEN bah.m_tah  = '3'  THEN 1 ELSE 0 END ) m_tah3,
sum(CASE WHEN bah.m_tah  = '4'  THEN 1 ELSE 0 END ) m_tah4,
sum(CASE WHEN bah.m_tah  = '5'  THEN 1 ELSE 0 END ) m_tah5,
sum(CASE WHEN bah.m_tah  = '6'  THEN 1 ELSE 0 END ) m_tah6,
sum(CASE WHEN bah.m_tah  = '7'  THEN 1 ELSE 0 END ) m_tah7,
sum(CASE WHEN bah.m_tah  = '8'  THEN 1 ELSE 0 END ) m_tah8,
sum(CASE WHEN bah.m_tah  = '9'  THEN 1 ELSE 0 END ) m_tah9
FROM (select DISTINCT bee.bah_cod_m,bee.num_bah from bee WHERE 
(((bee.id_ostan='$id_ostan') and (bee.m_ostan='$id_ostan' or bee.m_ostan='-'))
 or (bee.id_ostan != '$id_ostan' and bee.m_ostan = '$id_ostan')) and bee.sal = '$sal'
  ) bee 
inner join bah ON bah.bah_cod_m = bee.bah_cod_m  and  bah.num_bah = bee.num_bah
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <td align="center" height="36"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1']+$row['no_bah2'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $ostan ;?><br /></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
$query = "SELECT  
sum(CASE WHEN bah.no_bah = '1' THEN 1 ELSE 0 END ) no_bah1,
sum(CASE WHEN bah.no_bah = '2' THEN 1 ELSE 0 END ) no_bah2,
sum(CASE WHEN bah.m_tah  = '1'  THEN 1 ELSE 0 END ) m_tah1,
sum(CASE WHEN bah.m_tah  = '2'  THEN 1 ELSE 0 END ) m_tah2,
sum(CASE WHEN bah.m_tah  = '3'  THEN 1 ELSE 0 END ) m_tah3,
sum(CASE WHEN bah.m_tah  = '4'  THEN 1 ELSE 0 END ) m_tah4,
sum(CASE WHEN bah.m_tah  = '5'  THEN 1 ELSE 0 END ) m_tah5,
sum(CASE WHEN bah.m_tah  = '6'  THEN 1 ELSE 0 END ) m_tah6,
sum(CASE WHEN bah.m_tah  = '7'  THEN 1 ELSE 0 END ) m_tah7,
sum(CASE WHEN bah.m_tah  = '8'  THEN 1 ELSE 0 END ) m_tah8,
sum(CASE WHEN bah.m_tah  = '9'  THEN 1 ELSE 0 END ) m_tah9
FROM (select DISTINCT bee.bah_cod_m,bee.num_bah from bee WHERE 
 bee.sal = '$sal'
  ) bee 
inner join bah ON bah.bah_cod_m = bee.bah_cod_m  and  bah.num_bah = bee.num_bah
 "   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <tr>
      <td align="center" height="37"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1']+$row['no_bah2'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >&nbsp;</td>
    </tr>
</table>
  <?php }?>
<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>