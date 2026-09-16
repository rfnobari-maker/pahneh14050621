<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=inactive_city.xls");
?>
<?php 
include('../lock_ad.php');
include('../event.php') ;
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../login/config.php');
$query = "SELECT public_city.add_city,public_city.shahr,public_city.bakh,public_city.city,public_city.id_ostan
FROM public_city
LEFT JOIN list_city ON list_city.add_city = public_city.add_city
WHERE list_city.add_city IS NULL and public_city.id_ostan  = $id_ostan" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
      <table width="90%" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr align="center" class="style8">
          <td width="15%" bgcolor="#CCCCCC">آدرس آماری شهر</td>
          <td width="15%" bgcolor="#CCCCCC">نام شهر</td>
          <td width="13%" bgcolor="#CCCCCC">مرکز</td>
          <td width="14%" bgcolor="#CCCCCC">شهرستان </td>
          <td width="7%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT * FROM  users  where cod_m = $cod_m " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
?>
          <td height="55" align="center" class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'];?></td>
          <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> align="center"><?php echo $row['shahr'];?><br /></td>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller" align="center"><?php echo $row['bakh'];?></td>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> align="center"><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> align="center"><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
      </table>    