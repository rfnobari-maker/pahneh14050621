<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست کارشناسان استان.xls");
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
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<?php
include('../login/config.php');
$query = "SELECT * FROM  users_97 WHERE  1 ORDER BY id_ostan,id_city,id_mar ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style1">لیست کارشناسانی که طی بیش از دو ماه گذشته به سامانه وارد نشده اند </p>
           <table width="85%" height="115" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td bgcolor="#999999">تعداد بهره بردار</td>
               <td height="44" bgcolor="#999999"> تعداد آبادی</td>
               <td bgcolor="#999999">تعداد شهر</td>
               <td width="13%" bgcolor="#999999">تلفن همراه</td>
               <td width="12%" bgcolor="#999999">کد ملی</td>
               <td width="14%" bgcolor="#999999">نام خانوادگی</td>
               <td width="10%" bgcolor="#999999">نام</td>
               <td width="5%" bgcolor="#999999">مرکز</td>
               <td width="5%" bgcolor="#999999">شهرستان</td>
               <td width="5%" bgcolor="#999999">استان</td>
               <td width="5%" bgcolor="#999999">ردیف</td>
             </tr>
  <tr >
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <td align="center" width="9%" height="61"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_bah_count($row['cod_m'])?></td>
    <td align="center" width="9%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
     <?php echo mor_abadi_count($row['cod_m'])?>
   </td>
    <td align="center" width="6%" class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
   <?php   echo   mor_shahr_count($row['cod_m']) ;  ?>
     </td>
    <td  align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['markaz'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['ostan'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
</body>
</html>



