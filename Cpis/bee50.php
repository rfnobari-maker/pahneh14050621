<?php 
include('../lock_cp.php');
include('bee_counter.php');
$sal = '1396' ; 
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
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
            <td><img src="../files/images/header.jpg" width="949" height="188" /></td>
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
        <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
<form method="post" name="form1" id="form"  action="">
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
                  <option value="1395"<?php if ($sal=='1395') echo 'selected=selected'?>>1395</option>
                  <option value="1396"<?php if ($sal=='1396') echo 'selected=selected'?>>1396</option>
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
$query = "SELECT bee.id_ostan,cityname.city,count(*) as jam,
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
FROM bee 
left join bah ON bah.bah_cod_m = bee.bah_cod_m 
left join cityname ON bee.id_ostan = cityname.id_ostan  and bee.id_city = cityname.id_city 
WHERE bee.sal='$sal'  and bee.id_ostan = '$id_ostan1'
group by bee.id_city
order by binary cityname.city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="bee5_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="sal"       value="<?php echo  $sal ;?>" />
        <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
      </tr>
  </table>
  <table width="98%" height="260" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td height="42" colspan="9" bgcolor="#999999">مدرک تحصیلی / نفر</td>
      <td colspan="3" bgcolor="#999999">تعداد زنبورستان</td>
      <td width="11%" rowspan="2" bgcolor="#999999">شهرستان</td>
      <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td width="6%" height="52" bgcolor="#999999">حوزوی</td>
      <td width="5%" bgcolor="#999999">دکتری</td>
      <td width="6%" bgcolor="#999999">فوق لیسانس</td>
      <td width="6%" bgcolor="#999999">لیسانس</td>
      <td width="7%" bgcolor="#999999">فوق دیپلم</td>
      <td width="6%" bgcolor="#999999">دیپلم</td>
      <td width="8%" bgcolor="#999999">سیکل</td>
      <td width="8%" bgcolor="#999999">خواندن و نوشتن</td>
      <td width="8%" bgcolor="#999999">بیسواد</td>
      <td width="9%" bgcolor="#999999">کل</td>
      <td width="8%" bgcolor="#999999">حقوقی</td>
      <td width="7%" bgcolor="#999999">حقیقی</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
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
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['jam'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
$query = "SELECT count(*) as jam,
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
FROM bee 
left join bah ON bah.bah_cod_m = bee.bah_cod_m 
WHERE bee.sal='$sal' and bee.id_ostan = '$id_ostan1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <tr>
      <td height="38" rowspan="2" align="center" bgcolor="#999999" class="text1">حوزوی</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">دکتری</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">فوق لیسانس</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">لیسانس</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">فوق دیپلم</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">دیپلم</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">سیکل</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">خواندن و نوشتن</td>
      <td rowspan="2" align="center" bgcolor="#999999" class="text1">بیسواد</td>
      <td height="29" colspan="3" bgcolor="#999999"  class="text1">تعداد زنبورستان</td>
      <td colspan="2" rowspan="3" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
    </tr>
    <tr>
      <td height="38" align="center" bgcolor="#999999" class="text1">کل</td>
      <td align="center" bgcolor="#999999" class="text1">حقوقی</td>
      <td align="center" bgcolor="#999999" class="text1">حقیقی</td>
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
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['jam'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
    </tr>
  </table>
  <?php }?>
       <p>&nbsp;</p>
       <p> <p><a href="Poultry/index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



