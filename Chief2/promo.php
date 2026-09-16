<?php 
include('../lock_ce.php');
include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
      <?php include('top.php');?>
      </p>

<?php 
include('../login/config.php');
$query = "SELECT   id_ostan,ostan FROM ostanname   ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><span class="LinkBlackSmall">اطلاعات کارشناسان مسئول پهنه به تفکیک استان </span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="98%" height="215" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="5" bgcolor="#999999"> تعداد <span class="LinkBlackSmall">کارشناسان مسئول پهنه</span> به تفکیک مدرک تحصیلی</td>
    <td height="56" colspan="3" bgcolor="#999999"> تعداد <span class="LinkBlackSmall">کارشناسان مسئول پهنه</span></td>
    <td width="13%" rowspan="2" bgcolor="#999999">استان</td>
    <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td width="12%" bgcolor="#999999">دکتری</td>
    <td width="10%" bgcolor="#999999">فوق لیسانس</td>
    <td width="12%" bgcolor="#999999">لیسانس</td>
    <td width="12%" bgcolor="#999999">فوق دیپلم</td>
    <td width="12%" bgcolor="#999999"> دیپلم</td>
    <td width="10%" height="43" bgcolor="#999999">کل*</td>
    <td width="8%" bgcolor="#999999">مرد</td>
    <td width="10%" bgcolor="#999999">زن</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row)
 {
$id_ostan = $row['id_ostan'] ; 
?>
<td height="58" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="ostan_promotes1.php" method="post" >
    <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
    <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
    <button><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات مروجین مرکز" width="48" height="43" /></button>
  </form></td>
<td   class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_mtah_count($id_ostan,3)?></td>
<td class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_mtah_count($id_ostan,2)?></td>
<td  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_mtah_count($id_ostan,1)?></td>
<td  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_mtah_count($id_ostan,5)?></td>
<td  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_mtah_count($id_ostan,4)?></td>
<td  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_count($id_ostan)?></td>
    <td   class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo ostan_mor_jens_count($id_ostan,1)?></td>
    <td  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo ostan_mor_jens_count($id_ostan,2)?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
  <?php
$r++ ; 
}
?>
<tr>
<td height="58" bgcolor="#CCCCCC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
    <td bgcolor="#CCCCCC"  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_mtah_count(3)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_mtah_count(2)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_mtah_count(1)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_mtah_count(5)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_mtah_count(4)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell" ><?php echo mor_count()?></td>
    <td bgcolor="#CCCCCC"  class="RightMenuCell" ><?php echo mor_jens_count(1)?></td>
    <td bgcolor="#CCCCCC" class="RightMenuCell"  ><?php echo mor_jens_count(2)?></td>
    <td colspan="2" bgcolor="#990033" class="text1"  >کل </td>
    </tr>
</table>
           <p class="style2"> بعلت عدم تکمیل اطلاعات کاربری توسط <span class="LinkBlackSmall">کارشناسان مسئول پهنه</span> امکان بروز اختلاف بین تعداد کل کارشناسان با مجموع تعداد <span class="LinkBlackSmall">کارشناسان مسئول پهنه</span> به تفکیک جنسیت و مدرک تحصیلی وجود دارد<span class="style8">*</span></p>
           <p> <p><a href="users.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



