<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست بهره برداران.doc");
include('../lock_oce.php');
include('../event.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;

 if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 'id = id'  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 'id = id'  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 'id = id'  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
    <td><p>
      <?php 
include('../login/config.php');
 $query = "SELECT * FROM  bah where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi  and $v_mor_cod_m and $v_bah_cod_m ORDER BY BINARY last_name ASC  "; 
$stmt= $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
      <table width="98%" height="111" border="0" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td height="57" bgcolor="#999999"><p>کد ملی کارشناس</p></td>
          <td width="10%" bgcolor="#999999">نام کارشناس</td>
          <td height="57" bgcolor="#999999">شماره همراه</td>
          <td width="10%" bgcolor="#999999"> کد ملی<br /></td>
          <td width="12%" bgcolor="#999999">نام خانوادگی</td>
          <td width="9%" bgcolor="#999999"> نام </td>
          <td width="10%" bgcolor="#999999">نوع بهره بردار</td>
          <td width="13%" bgcolor="#999999">شهر / آبادی </td>
          <td width="12%" bgcolor="#999999">شهرستان </td>
          <td width="6%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m) ;
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}

//echo $row2['User_Name'] ; 
?>
          <td align="center" width="7%" height="51" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="11%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
    </table>