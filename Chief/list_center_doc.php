<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست مراکز جهاد کشاورزی.doc");
include('../lock_ce.php');
include('counter.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
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
    </p>
      <p align="center" class="style1"> اطلاعات مراکز جهاد کشاورزی 
        <?php if(isset($_POST['id_ostan']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_select_city = $_POST['id_city'] ; 
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
 $query = "SELECT * FROM  mar where  $v_id_ostan and  $v_id_city order by id_ostan,id_city   "  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="65%" height="126" border="0" align="center" cellpadding="0" cellspacing="2" >
        <tr align="center" class="text1">
          <td colspan="3" bordercolor="#FFFFFF" bgcolor="#999999">مشخصات رئیس مرکز</td>
          <td width="16%" rowspan="2" bgcolor="#999999">مرکز جهاد کشاورزی</td>
          <td width="13%" rowspan="2" bgcolor="#999999">شهرستان</td>
          <td width="13%" rowspan="2" bgcolor="#999999">استان</td>
          <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
        </tr>
        <tr align="center" class="text1">
          <td width="21%" height="44" bordercolor="#FFFFFF" bgcolor="#999999">شماره همراه</td>
          <td width="18%" bordercolor="#FFFFFF" bgcolor="#999999">نام خانوادگی</td>
          <td width="14%" bordercolor="#FFFFFF" bgcolor="#999999">نام</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;

$query2 = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and id_city = '$id_city' and id_ostan = '$id_ostan' and  S_access = '2'"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'
?>
          <td align="center" height="39" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo  $row2['tel_m'];?></span></td>
          <td align="center" height="39" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['Last_name'];?></td>
          <td align="center" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['name'];?></td>
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



