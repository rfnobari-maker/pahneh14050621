<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=inactive_abadi.xls");
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
$query = "SELECT public_abadi4.add_abadi,public_abadi4.abadi,public_abadi4.deh,public_abadi4.city,public_abadi4.id_ostan
FROM public_abadi4
LEFT JOIN list_abadi ON list_abadi.add_abadi = public_abadi4.add_abadi
WHERE list_abadi.add_abadi IS NULL and public_abadi4.id_ostan  = $id_ostan" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
           <table width="700" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="31%" height="41" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="27%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="18%" bgcolor="#CCCCCC">دهستان</td>
    <td width="16%" bgcolor="#CCCCCC">شهرستان </td>
    <td width="8%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td height="55" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['add_abadi'].'&nbsp;';?></span></td>
     <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>