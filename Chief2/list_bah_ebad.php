<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست بهره برداران.xls");
include('../lock_ce.php');
include('../event.php') ;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
include('../login/config.php');
 $query = "SELECT id_ostan,id_city,bah_cod_m,name,last_name,no_bah,jens,date_t,m_sod,fname,sh_sh,no_bah FROM  bah where ok = '2' and id > '2668633' ";
  $stmt= $dbh->prepare($query);
   $stmt->execute();
?>
      </p>
      <p align="center"> لیست بهره برداران مشکل دار</p>
      <table width="92%" height="65" border="1" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td width="6%" height="30" bgcolor="#FFFFFF" class="style8">نام پدر</td>
          <td width="7%" bgcolor="#FFFFFF" class="style8">محل صدور</td>
          <td width="9%" bgcolor="#FFFFFF" class="style8">شماره شناسنامه</td>
          <td width="7%" bgcolor="#FFFFFF" class="style8">تاریخ تولد </td>
          <td width="7%" bgcolor="#FFFFFF" class="style8"> کد ملی<br />
          </td>
          <td width="8%" bgcolor="#FFFFFF" class="style8">جنسیت</td>
          <td width="13%" bgcolor="#FFFFFF" class="style8">نام خانوادگی</td>
          <td width="9%" bgcolor="#FFFFFF" class="style8"> نام </td>
          <td width="8%" bgcolor="#FFFFFF" class="style8">نوع بهره بردار</td>
          <td width="9%" bgcolor="#FFFFFF" class="style8">شهرستان </td>
          <td width="10%" bgcolor="#FFFFFF" class="style8">استان</td>
          <td width="7%" bgcolor="#FFFFFF" class="style8">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row)
  {

//echo $row2['User_Name'] ; 
?>
     <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
           if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;

?>

       <td height="30" align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_sod'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_jens;?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
       <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']);?></td>
         <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
<p align="center">---------------------- پایان گزارش ---------------------------<p>
