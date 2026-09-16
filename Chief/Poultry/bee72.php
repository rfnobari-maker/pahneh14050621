<?php
require_once("../../lock_ce.php");
require_once('../side_menu1.php');
require_once('bee_counter.php');
if(isset($_POST['sal'])) $sal = $_POST['sal'];
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
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
    </style>
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
        <p class="style1">آمار زنبوردار ها به تفکیک استان</p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px; border-radius:10px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="64%" height="68"><div align="right">
                <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1404"<?php if ($sal=='1404') echo 'selected=selected'?>>1404</option>
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                </select>
              </div></td>
              <td width="36%" class="style8"> : سرشماری سال </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>

  <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$query = "SELECT * from ostanname where 1 order by binary ostanname.ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="bee72_xls.php" method="post">
        <input type="hidden" name="sal"       value="<?php echo  $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
      </tr>
  </table>
           <table width="90%"  align="center" class="my-table">
             <tr align="center" class="text1">
               <td height="42" colspan="9" bgcolor="#669999">مدرک تحصیلی / نفر</td>
               <td colspan="5" bgcolor="#669999">تعداد زنبورستان</td>
    <td width="11%" rowspan="3" bgcolor="#669999">استان  </td>
    <td width="5%" rowspan="3" bgcolor="#669999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="6%" height="52" rowspan="2" bgcolor="#669999">حوزوی</td>
               <td width="5%" rowspan="2" bgcolor="#669999">دکتری</td>
               <td width="6%" rowspan="2" bgcolor="#669999">فوق لیسانس</td>
               <td width="6%" rowspan="2" bgcolor="#669999">لیسانس</td>
               <td width="7%" rowspan="2" bgcolor="#669999">فوق دیپلم</td>
               <td width="6%" rowspan="2" bgcolor="#669999">دیپلم</td>
               <td width="8%" rowspan="2" bgcolor="#669999">سیکل</td>
               <td width="8%" rowspan="2" bgcolor="#669999">خواندن و نوشتن</td>
               <td width="8%" rowspan="2" bgcolor="#669999">بیسواد</td>
               <td width="6%" rowspan="2" bgcolor="#669999">کل</td>
               <td width="6%" rowspan="2" bgcolor="#669999">حقوقی</td>
               <td colspan="3" bgcolor="#669999">حقیقی</td>
             </tr>
             <tr align="center" class="text1">
               <td width="4%" bgcolor="#669999">جمع</td>
               <td width="5%" bgcolor="#669999">زن</td>
               <td width="3%" bgcolor="#669999">مرد</td>
             </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ; 
$ostan = $row['ostan'] ; 
$query = "SELECT  
sum(CASE WHEN bah.jens   = '1' THEN 1 ELSE 0 END ) mard,
sum(CASE WHEN bah.jens   = '2' THEN 1 ELSE 0 END ) zan,
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
    <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1']+$row['no_bah2'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'];?></td>
    <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mard'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $ostan;?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
$query = "SELECT  
sum(CASE WHEN bah.jens   = '1' THEN 1 ELSE 0 END ) mard,
sum(CASE WHEN bah.jens   = '2' THEN 1 ELSE 0 END ) zan,
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
?>
    <tr>
      <td height="38" rowspan="3" align="center" bgcolor="#669999" class="text1">حوزوی</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">دکتری</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">فوق لیسانس</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">لیسانس</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">فوق دیپلم</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">دیپلم</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">سیکل</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">خواندن و نوشتن</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">بیسواد</td>
      <td height="29" colspan="5" bgcolor="#669999"  class="text1">تعداد زنبورستان</td>
      <td colspan="2" rowspan="4" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
    </tr>
    <tr>
      <td height="38" rowspan="2" align="center" bgcolor="#669999" class="text1">کل</td>
      <td rowspan="2" align="center" bgcolor="#669999" class="text1">حقوقی</td>
      <td colspan="3" align="center" bgcolor="#669999" class="text1">حقیقی</td>
      </tr>
    <tr>
      <td align="center" bgcolor="#669999" class="text1">جمع</td>
      <td align="center" bgcolor="#669999" class="text1">زن</td>
      <td align="center" bgcolor="#669999" class="text1">مرد</td>
    </tr>
    <tr>
    <?php
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1']+$row['no_bah2'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mard'];?></td>
    </tr>
</table>
<?php }
?>

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