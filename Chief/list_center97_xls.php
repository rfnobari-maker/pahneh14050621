<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=اطلاعات_مرکز.xls");
include('../lock_ce.php');
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
      <?php 
include ('../login/config.php');
?>
<p align="center" class="style1">اطلاعات مراکز جهاد کشاورزی
<?php if(isset($_POST['id_ostan']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_select_city = $_POST['id_city'] ; 
if ($id_ostan == -1) { $v_id_ostan = 1 ;} else { $v_id_ostan = "mar.id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1;} else { $v_id_city = "mar.id_city='$id_city'" ;}
 $query = "SELECT mar.id_city,mar.id_ostan,mar.id_mar,mar.mar,mar.city,mar.ostan,
users.pic,
users.name,
users.last_name,
users.cod_m,
users.tel_m,
promo_cent_public.m_name ,
promo_cent_public.rating ,
promo_cent_public.y_tas ,
promo_cent_public.address ,
promo_cent_public.cod_pos ,
promo_cent_public.lng ,
promo_cent_public.lat ,
promo_cent_public.tel ,
promo_cent_public.fax 
FROM  mar
left join users ON mar.id_mar = users.id_mar and users.S_access = '2'
left join promo_cent_public ON mar.id_mar = promo_cent_public.id_mar
where $v_id_ostan and  $v_id_city  order by mar.id_ostan,mar.id_city,mar.id_mar  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
       <table width="100%" height="84" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#00CCFF" >
        <tr align="center" class="style8">
          <td width="23%" bordercolor="#FFFFFF" bgcolor="#FFCC99">آدرس</td>
          <td width="7%" bordercolor="#FFFFFF" bgcolor="#FFCC99">فکس </td>
          <td width="7%" bordercolor="#FFFFFF" bgcolor="#FFCC99">تلفن</td>
          <td width="8%" bordercolor="#FFFFFF" bgcolor="#FFCC99">کد پستی</td>
          <td width="6%" bordercolor="#FFFFFF" bgcolor="#FFCC99">سال تاسیس  </td>
          <td width="7%" bordercolor="#FFFFFF" bgcolor="#FFCC99">سطح مرکز</td>
          <td width="7%" height="39" bordercolor="#FFFFFF" bgcolor="#FFCC99">شماره همراه رئیس مرکز</td>
          <td width="5%" bordercolor="#FFFFFF" bgcolor="#FFCC99">کد ملی رئیس مرکز</td>
          <td width="4%" bordercolor="#FFFFFF" bgcolor="#FFCC99">نام خانوادگی رئیس مرکز</td>
          <td width="3%" bordercolor="#FFFFFF" bgcolor="#FFCC99">نام رئیس مرکز</td>
          <td width="2%" bgcolor="#FFCC99">کد مرکز</td>
          <td width="4%" bgcolor="#FFCC99">مرکز جهاد کشاورزی</td>
          <td width="5%" bgcolor="#FFCC99">شهرستان</td>
          <td width="8%" bgcolor="#FFCC99">استان</td>
          <td width="4%" bgcolor="#FFCC99">ردیف</td>
        </tr>
          <?php
$r = 1 ;
 foreach($stmt as $row){
?>
        <tr>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['address'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['fax'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['tel'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['cod_p'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['y_tas'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['rating'];?></span></td>
          <td align="center" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['tel_m'];?></span></td>

          <td align="center" height="39" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row['cod_m'];?></span></td>
          <td align="center" height="39" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['id_mar'];?></td>
          <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['mar'];?></td>
          <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
          <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['ostan'];?></td>
          <td align="center"  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
 }
}
?>
</table>
</body>
</html>