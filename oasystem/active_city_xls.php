<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=شهرهای فعال.xls");
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
      <?php 
include ('../login/config.php');
 $id_city1 = $_POST['id_city'] ; 
 $id_mar1 = $_POST['id_mar'] ; 
if ($id_city1 == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city1'" ;}
if ($id_mar1 == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar1'" ;}
 $query = "SELECT mor_cod_m,add_city,id_mar,shahr,mar,bakh,city FROM  list_city where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="76%" height="68" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr align="center" class="style8">
          <td width="15%" height="40" bgcolor="#CCCCCC">مشخصات مروج شهر</td>
          <td width="13%" bgcolor="#CCCCCC">نام مرکز</td>
          <td width="18%" bgcolor="#CCCCCC">آدرس آماری شهر</td>
          <td width="13%" bgcolor="#CCCCCC">نام شهر</td>
          <td width="14%" bgcolor="#CCCCCC">مرکز</td>
          <td width="13%" bgcolor="#CCCCCC">شهرستان </td>
          <td width="14%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT Last_name,name FROM  users  where cod_m = $cod_m " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
          <td height="28" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
          <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> align="center"><?php echo $row['mar'];?></td>
          <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> align="center"><?php echo $row['add_city'];?></td>
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
