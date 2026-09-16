<?php 
include('../lock_ce.php');
include('counter.php');
include('../pageurl.php') ; 
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
<?
if (isset($_POST['id_city'])) 
{
include_once('../login/config.php');
$id_city = $_POST['id_city'] ; 
$city = $_POST['city'] ; 
$query = "SELECT * FROM  users WHERE  id_city = '$id_city' and  S_access = '2'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1">مشخصات مراکز جهاد کشاورزی شهرستان  <?php echo ' '.$city ?></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="98%" height="215" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="3" bgcolor="#999999"> تعداد مروجین مرکز به تفکیک مدرک تحصیلی</td>
    <td height="56" colspan="3" bgcolor="#999999"> تعداد مروجین مرکز</td>
    <td width="13%" rowspan="2" bgcolor="#999999">نام مرکز </td>
    <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td width="12%" bgcolor="#999999">دکتری</td>
    <td width="10%" bgcolor="#999999">فوق لیسانس</td>
    <td width="12%" bgcolor="#999999">لیسانس</td>
    <td width="10%" height="43" bgcolor="#999999">کل</td>
    <td width="8%" bgcolor="#999999">مرد</td>
    <td width="10%" bgcolor="#999999">زن</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td height="58" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="mar_promotes.php" method="post">
    <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
    <input type="hidden" name="mar" value="<?php echo $row['mar'] ;?>" />
    <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
    <button><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات مروجین مرکز" width="48" height="43" /></button>
  </form></td>
<td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_mor_mtah_count($row['id_mar'],3)?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_mor_mtah_count($row['id_mar'],2)?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_mor_mtah_count($row['id_mar'],1)?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo mar_mor_count($row['id_mar'])?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo mar_mor_jens_count($row['id_mar'],1)?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo mar_mor_jens_count($row['id_mar'],2)?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['markaz'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
  <?php
$r++ ; 
}
?>
<tr>
<td height="58" bgcolor="#FFCCCC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="city_promotes.php" method="post">
    <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
    <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
    <button><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات مروجین شهرستان" width="48" height="43" /></button>
  </form></td>
    <td bgcolor="#FFCCCC"  class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_mor_mtah_count($row['id_city'],3)?></td>
    <td bgcolor="#FFCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_mor_mtah_count($row['id_city'],2)?></td>
    <td bgcolor="#FFCCCC" class="RightMenuCell" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_mor_mtah_count($row['id_city'],1)?></td>
    <td bgcolor="#FFCCCC" class="RightMenuCell" ><?php echo city_mor_count($row['id_city'])?></td>
    <td bgcolor="#FFCCCC"  class="RightMenuCell" ><?php echo city_mor_jens_count($row['id_city'],1)?></td>
    <td bgcolor="#FFCCCC" class="RightMenuCell"  ><?php echo city_mor_jens_count($row['id_city'],2)?></td>
    <td colspan="2" bgcolor="#990033" class="text1"  >کل شهرستان</td>
    </tr>
<?php } else { echo '<p style="color:red">'.'مجوز دسترسی به این صفحه را ندارید '.'</p>';}?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



