<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=admins.xls");
include('../lock_cp.php');
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
</script>
</head>
<body>

<?php include_once('../login/config.php');
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="normalTextSmall">داشبورد مدیریتی ادمین های استانی سامانه</p>
           <table width="98%" height="249" border="1" bordercolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td colspan="7" bgcolor="#999999">تعداد</td>
    <td height="66" colspan="2" bgcolor="#999999">مشخصات ادمین استان</td>
    <td width="8%" rowspan="3" bgcolor="#999999">استان </td>
    <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td colspan="2" bgcolor="#999999"><br />       آبادی <br /></td>
    <td colspan="2" bgcolor="#999999">شهر</td>
    <td rowspan="2" bgcolor="#999999">کارشناس مروج<br /></td>
    <td width="7%" rowspan="2" bgcolor="#999999">مرکز</td>
    <td width="5%" rowspan="2" bgcolor="#999999">شهرستان<br /></td>
    <td width="10%" height="66" rowspan="2" bgcolor="#999999">نام خانوادگی</td>
    <td width="8%" rowspan="2" bgcolor="#999999">نام</td>
    </tr>
  <tr align="center" class="text1">
    <td width="7%" bgcolor="#999999">فعال</td>
    <td width="6%" bgcolor="#999999">کل</td>
    <td width="7%" bgcolor="#999999">فعال</td>
    <td width="7%" bgcolor="#999999">کل</td>
  </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ;
$query2 = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan' and  S_access = '98' "  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
   
  <td align="center" height="59"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php echo ostan_abadi_count($row['id_ostan']);?></td>
  <td  align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <?php echo kol_abadi_count($row['id_ostan']);?></td>
  <td  align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_count($row['id_ostan']);?></td>
  <td  align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo kol_shahr_count($row['id_ostan']);?></td>
    <td align="center" width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mor_count($row['id_ostan']);?></td>
    <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> 
 <?php echo ostan_mar_count($row['id_ostan']);?>
</td>
    <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  ostan_city_count($row['id_ostan']);?></td>
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
</table>
</body>
</html>



