<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=ostan.doc");

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
 <table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
 <tr>
      <td width="840" >
     </p>
<?php include('../login/config.php');
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="normalTextSmall">داشبورد مدیریتی  استان های تحت پوشش</p>
          <table width="98%" height="202" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
            <tr align="center" class="text1">
    <td colspan="6" bgcolor="#999999">تعداد</td>
    <td height="40" colspan="2" bgcolor="#999999">مشخصات رئیس سازمان</td>
    <td width="12%" rowspan="2" bgcolor="#999999">استان </td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">بهره بردار<br /></td>
    <td bgcolor="#999999"> آبادی <br /></td>
    <td bgcolor="#999999">شهر</td>
    <td bgcolor="#999999">کارشناس  پهنه<br /></td>
    <td width="5%" bgcolor="#999999">مرکز</td>
    <td width="7%" bgcolor="#999999">شهرستان<br /></td>
    <td width="10%" height="40" bgcolor="#999999">نام خانوادگی</td>
    <td width="8%" bgcolor="#999999">نام</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ;
$query2 = "SELECT id,username,tel_m,cod_m,Last_name,name,pic FROM  users WHERE  id_ostan = '$id_ostan' and  chief = '1' "  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
   
  <td align="center"  width="8%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_count($row['id_ostan']);?></td>
  <td align="center"  width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php echo ostan_abadi_count($row['id_ostan']);?></td>
    <td align="center"  width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_count($row['id_ostan']);?></td>
    <td align="center"  width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_count($row['id_ostan']);?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mar_count($row['id_ostan']);?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <?php echo  ostan_city_count($row['id_ostan']);?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row2['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td align="center"  height="37"  class="RedTitleSmall"  >بهره بردار</td>
    <td align="center"  class="RedTitleSmall"  >آبادی</td>
    <td align="center"  class="RedTitleSmall"  >شهر</td>
    <td align="center"  class="RedTitleSmall"  >کارشناس  پهنه<br />
    </td>
    <td align="center"  class="RedTitleSmall"  >مرکز</td>
    <td  align="center"  class="RedTitleSmall"  >شهرستان</td>
    <td align="center"  colspan="4" rowspan="2"   class="morph">جمع کل</td>
    </tr>
  <tr>
    <td height="39"  class="normalTextSmaller"  ><?php echo kol_bah_count();?></td>
    <td  class="normalTextSmaller"  ><?php echo abadi_count() ; ?></td>
    <td  class="normalTextSmaller"  ><?php echo totl_shahr_count() ;  ?></td>
    <td  class="normalTextSmaller"  ><?php echo mor_count() ?></td>
    <td  class="normalTextSmaller"  ><?php echo totl_mar_count() ; ?></td>
    <td  class="normalTextSmaller"  ><?php echo kol_city_count();?></td>
    </tr>
  </table>
</body>
</html>



