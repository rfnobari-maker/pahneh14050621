<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=فرمهای_ثبت_شده.xls");
include('../lock_oce.php');
include('counter9.php');
$sal = $_POST['sal'] ; 
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
<?php include('../login/config.php');
$query = "SELECT   id_city,city FROM cityname where id_ostan =$id_ostan  ORDER BY BINARY city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style8">فرم های ثبت شده به تفکیک بهره بردار</p>
 <table width="85%" height="225" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
   <tr align="center" class="text1">
    <td height="49" colspan="4" bgcolor="#999999">تعداد بهره برداری های ثبت شده</td>
    <td width="15%" rowspan="2" bgcolor="#999999"> تعداد بهره بردار</td>
    <td width="20%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
   </tr>
  <tr align="center" class="text1">
    <td height="45" bgcolor="#999999">آبزی پروری</td>
    <td bgcolor="#999999">گلخانه</td>
    <td bgcolor="#999999">باغی</td>
    <td width="15%" bgcolor="#999999">زراعی</td>
   </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
//echo $row2['User_Name'] ; 
?>
  <td width="15%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_Aquatic_count($id_ostan,$row['id_city'],$sal) ?></td>
    <td width="16%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_Greenhous_count($id_ostan,$row['id_city'],$sal) ?></td>
    <td width="13%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_Garden_count($id_ostan,$row['id_city'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_Agri_count($id_ostan,$row['id_city'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_count($id_ostan,$row['id_city']);?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td height="44" bgcolor="#CCCCCC"  class="morph"  >آبزی پروری</td>
    <td bgcolor="#CCCCCC"  class="morph"  >گلخانه</td>
    <td bgcolor="#CCCCCC"  class="morph"  >باغی<br />
    </td>
    <td bgcolor="#CCCCCC"  class="morph"  >زراعی</td>
    <td bgcolor="#CCCCCC"  class="morph"  >بهره بردار</td>
    <td colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
   </tr>
  <tr>
    <td height="38" bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Aquatic_count($id_ostan,$sal) ?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Greenhous_count($id_ostan,$sal) ?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Garden_count($id_ostan,$sal) ?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Agri_count($id_ostan,$sal) ?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo kol_bah_count($id_ostan);?></td>
   </tr>
</table>
</body>
</html>