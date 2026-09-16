<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست _بهره_برداران _مشاغل_وابسته _کشاورزی.xls");
include('../lock_expsh.php');
include('../event.php') ;
  $id_ostan1 = $_POST['id_ostan'] ;
  $id_city = $_POST['id_city'] ;
  $id_mar = $_POST['id_mar'] ; 
  $add_abadi = $_POST['add_abadi'] ;
  $add_city = $_POST['add_city'] ;
  $mor_cod_m = $_POST['mor_cod_m'] ;
  $bah_cod_m = $_POST['bah_cod_m'] ;
  $fa = $_POST['fa'] ;

 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($fa == '0')  { $v_fa  = 1  ; }else{ $v_fa = "fa".$fa."='1'" ;}
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
$query = "SELECT * FROM  ind_bah where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city  and $v_mor_cod_m and $v_bah_cod_m and $v_fa ORDER BY BINARY last_name ASC "; 
$stmt= $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td height="57" bgcolor="#FFFFFF"><p class="style8">کد ملی کارشناس</p></td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">نام کارشناس</td>
          <td bgcolor="#FFFFCC" class="style8">سایر</td>
          <td bgcolor="#FFFFCC" class="style8">ماشین آلات کشاورزی</td>
          <td bgcolor="#FFFFCC" class="style8">صنایع تبدیلی و تکمیلی</td>
          <td height="57" bgcolor="#FFFFFF" class="style8">شماره همراه</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">شماره ثابت</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">مدرک مرتبط</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">مدرک تحصیلی </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8">نام پدر</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">محل صدور</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">شناسه ملی</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">شماره شناسنامه</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">تاریخ تولد </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> کد ملی<br />
          </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">جنسیت</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">نام شرکت</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">نام خانوادگی</td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> نام </td>
          <td width="3%" bgcolor="#FFFFCC" class="style8">نوع بهره بردار</td>
          <td width="5%" bgcolor="#FFFFCC" class="style8">آدرس آماری</td>
          <td width="8%" bgcolor="#FFFFCC" class="style8">شهر / آبادی </td>
          <td width="12%" bgcolor="#FFFFCC" class="style8">شهرستان </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">ردیف</td>
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
     <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
           if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;
           if($row['er_mtah'] == '1') $v_er_mtah = 'بلی' ; else $v_er_mtah='خیر' ;
           if($row['fa1'] == '1') $v_fa_1 = 'بلی' ; else $v_fa_1 ='خیر' ;
           if($row['fa2'] == '1') $v_fa_2 = 'بلی' ; else $v_fa_2 ='خیر' ;
           if($row['fa3'] == '1') $v_fa_3 = 'بلی' ; else $v_fa_3 ='خیر' ;
switch ($row['m_tah']) {
    case "1":
        $v_m_tah= "بیسواد";
        break;
    case "2":
        $v_m_tah= "خواندن و نوشتن";
        break;
    case "3":
        $v_m_tah= "سیکل";
        break;
    case "4":
        $v_m_tah= "دیپلم";
        break;
    case "5":
        $v_m_tah= "فوق دیپلم";
        break;
    case "6":
        $v_m_tah= "لیسانس";
        break;
    case "7":
        $v_m_tah= "فوق لیسانس";
        break;
    case "8":
        $v_m_tah= "دکتری";
        break;
    case "9":
        $v_m_tah= "تحصیلات حوزوی";
}
?>
          <td align="center" width="5%" height="30" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></td>
          <td  width="3%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_3 ;?></td>
          <td  width="4%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_2 ;?></td>
          <td  width="4%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_1 ;?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel_s'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_er_mtah ;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_tah ;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_sod'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_meli'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_jens;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['co_name'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row2['add_abadi'];?><?php echo $row2['add_city'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
<p align="center">---------------------- پایان گزارش ---------------------------<p>
