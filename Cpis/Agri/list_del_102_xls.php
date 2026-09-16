<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_گندم_حذفی.xls");
include('../../lock_cp.php');
include('../../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
      <p>
             <?php 
include_once('../../login/config.php');
$query = "SELECT del_rec.Date,del_rec.mor_cod_m,del_rec.bah_cod_m,users.id_city,users.city,users.markaz,users.name,users.last_name 
FROM del_rec
inner join users On del_rec.mor_cod_m = users.username
left  join Agri_prod1400_1401 ON 
del_rec.bah_cod_m = Agri_prod1400_1401.bah_cod_m 
and  Agri_prod1400_1401.cod_mah = del_rec.cod_mah
 WHERE del_rec.sal = '1400-1401' and del_rec.cod_mah= '102' and users.id_ostan = '16' and Agri_prod1400_1401.cod_mah is null
 order by users.city,users.markaz,del_rec.mor_cod_m";
$stmt= $dbh->prepare($query);
$stmt->execute(array());
?>
             <p align="center" dir="rtl">آمار گندم های حذف شده استان </p>
      <table width="98%" height="85" border="0" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text_r">
          <td width="10%" bgcolor="#999999">نام و نام خانوادگی کارشناس</td>
          <td width="10%" bgcolor="#999999">شماره همراه کارشناس</td>
               <td width="10%" height="42" bgcolor="#999999">کد ملی مروج</td>
          <td width="12%" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="11%" bgcolor="#999999"> کد ملی بهره بردار<br /></td>
    <td width="12%" bgcolor="#999999">نام مرکز</td>
    <td width="11%" bgcolor="#999999">شهرستان </td>
    <td width="7%" bgcolor="#999999">تاریخ حذف</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {

//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m'])?></td>
    <td height="40"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m']) ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['markaz'] ;  ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['city'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['Date'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
  <p align="center"> ------------- پایان گزارش -----------------</p>
