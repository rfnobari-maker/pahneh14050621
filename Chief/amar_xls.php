<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=اطلاعات_آبادی.xls");
include('../lock_ce.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
	include_once('../login/config.php');
 $query = "SELECT id_abadi,add_abadi,ostan,city,bakh,deh,abadi from public_abadi4  where 1  order by id_abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<div  class="style1" align="center">اطلاعات آبادی های کشور  </div>
<table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="15%" bgcolor="#CCCCCC">کارشناس مروج</td>
    <td width="15%" bgcolor="#CCCCCC">گلخانه</td>
    <td width="15%" bgcolor="#CCCCCC">اراضی باغی</td>
    <td width="15%" bgcolor="#CCCCCC">اراضی زراعی</td>
    <td width="15%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="16%" bgcolor="#CCCCCC">دهستان</td>
    <td width="12%" bgcolor="#CCCCCC">بخش</td>
    <td width="16%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="18%" bgcolor="#CCCCCC">استان</td>
    <td width="15%" bgcolor="#CCCCCC">کد آبادی </td>
    <td width="8%" bgcolor="#CCCCCC">ردیف</td>
  </tr>
<?php
  $r = 1 ;
 foreach($stmt as $row){
	 $add_abadi = $row['add_abadi'] ; 
	 ?>
  <tr>
    <td class="normalTextSmaller"><?php echo Abadi_mor($add_abadi) ?></td>
    <td class="normalTextSmaller"><?php echo Abadi_green_count($add_abadi) ?></td>
    <td class="normalTextSmaller"><?php echo Abadi_garden_count($add_abadi) ?></td>
    <td class="normalTextSmaller"><?php echo Abadi_agri_count($add_abadi) ?></td>
    <td class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td><?php echo $row['deh'];?></td>
    <td><?php echo $row['bakh'];?></td>
    <td><?php echo $row['city'];?></td>
    <td><?php echo $row['ostan'];?></td>
    <td><?php echo "'".$row['id_abadi'];?></td>
    <td><?php echo $r;?></td>
  </tr>
  <?php
$r++ ; 
}
?>
</table>

<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>
 <?php
 function Abadi_agri_count($add_abadi)
{
include_once('../login/config.php');
 $query = "SELECT count(*) from Agri1399_1400 where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
if ($result > 0) $Agri = 'دارد' ; else $Agri = 'ندارد' ;
return $Agri ; 
// clos conntection 

}
 function Abadi_garden_count($add_abadi)
{
include_once('../login/config.php');
 $query = "SELECT count(*) from Garden where add_abadi = '$add_abadi' and z_sal = '1400' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
if ($result > 0) $Garden = 'دارد' ; else $Garden = 'ندارد' ;
return $Garden ; 
// clos conntection 

}
 function Abadi_green_count($add_abadi)
{
include_once('../login/config.php');
 $query = "SELECT count(*) from Greenhous_prod where add_abadi = '$add_abadi' and y_prod = '1400' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
if ($result > 0) $Green = 'دارد' ; else $Green = 'ندارد' ;
return $Green ; 
// clos conntection 

}
function Abadi_mor($add_abadi)
{
include_once('../login/config.php');
 $query = "SELECT count(*) from list_abadi where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
if ($result > 0) $mor = 'دارد' ; else $mor = 'ندارد' ;
return $mor ; 
// clos conntection 

}
?>