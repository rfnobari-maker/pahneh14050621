<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_بهره_برداران_تایید_نشده.xls");
include('../lock_oce.php');
include('../event.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;

 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
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
 $query = "SELECT id_ostan,id_city,id_mar,add_abadi,add_city,mor_cod_m,bah_cod_m,name,last_name,tel_m,date_t,no_bah  FROM  bah where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_mor_cod_m and $v_bah_cod_m and ok = '2' ORDER BY BINARY last_name ASC  "; 
$stmt= $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td height="57" bgcolor="#FFFFFF"><p class="style8">کد ملی کارشناس</p></td>
          <td width="8%" bgcolor="#FFFFFF" class="style8">نام کارشناس</td>
          <td height="57" bgcolor="#FFFFFF" class="style8">شماره همراه</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">تاریخ تولد </td>
          <td width="5%" bgcolor="#FFFFFF" class="style8"> کد ملی<br />
          </td>
          <td width="7%" bgcolor="#FFFFFF" class="style8">نام خانوادگی</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8"> نام </td>
          <td width="8%" bgcolor="#FFFFFF" class="style8">نوع بهره بردار</td>
          <td width="10%" bgcolor="#FFFFFF" class="style8">شهر / آبادی </td>
          <td width="12%" bgcolor="#FFFFFF" class="style8">شهرستان </td>
          <td width="6%" bgcolor="#FFFFFF" class="style8">ردیف</td>
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
$query = "SELECT ostan,city,abadi,mar from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT ostan,city,shahr,mar from list_city where add_city = :add_city"; 
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
     <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
           if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;
?>
          <td align="center" width="8%" height="30" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
