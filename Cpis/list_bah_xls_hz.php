<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_بهره_برداران.xls");
include('../lock_cp.php');
include('../event.php') ;
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
include_once('../login/config.php');
 $query = "SELECT * FROM  hztol
 where 1 ORDER BY BINARY bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td bgcolor="#FFFFFF" class="style8">کد پستی</td>
          <td height="57" bgcolor="#FFFFFF" class="style8">شماره همراه</td>
          <td width="2%" bgcolor="#FFFFFF" class="style8">نام پدر</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">محل صدور</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">شماره شناسنامه</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">تاریخ تولد </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> کد ملی<br />
          </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">جنسیت</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">نام خانوادگی</td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> نام </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">ردیف</td>
        </tr>
        <tr>
          <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
?>
     <?php 
     	  if($row['ok'] == '4') $v_ok = 'تایید نشده' ;
          if($row['ok'] == '1') $v_ok = 'زنده' ;
          if($row['ok'] == '2') $v_ok = 'فوتی' ;
           if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
           if($row['s_bah'] == '1')  $v_s_bah = 'ساکن' ; 
           if($row['s_bah'] == '2')  $v_s_bah = 'غیر ساکن' ; 
           if($row['s_bah'] == '3')  $v_s_bah = 'عشایر' ; 
           if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;
           if($row['er_mtah'] == '1') $v_er_mtah = 'بلی' ; else $v_er_mtah='خیر' ;
           if($row['fa_1'] == '1') $v_fa_1 = '1' ; else $v_fa_1 ='0' ;
           if($row['fa_2'] == '1') $v_fa_2 = '1' ; else $v_fa_2 ='0' ;
           if($row['fa_3'] == '1') $v_fa_3 = '1' ; else $v_fa_3 ='0' ;
           if($row['fa_45'] == '1') $v_fa_45 = '1' ; else $v_fa_45 ='0' ;
           if($row['fa_67'] == '1') $v_fa_67 = '1' ; else $v_fa_67 ='0' ;
           if($row['fa_8'] == '1') $v_fa_8 = '1' ; else $v_fa_8 ='0' ;
           if($row['fa_9'] == '1') $v_fa_9 = '1' ; else $v_fa_9 ='0' ;
           if($row['fa_10'] == '1') $v_fa_10 = '1' ; else $v_fa_10 ='0' ;
           if($row['fa_11'] == '1') $v_fa_11 = '1' ; else $v_fa_11 ='0' ;
           if($row['fa_12'] == '1') $v_fa_12 = '1' ; else $v_fa_12 ='0' ;
           if($row['fa_13'] == '1') $v_fa_13 = '1' ; else $v_fa_13 ='0' ;
           if($row['fa_14'] == '1') $v_fa_14 = '1' ; else $v_fa_14 ='0' ;
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
          <td  width="4%" height="30" align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_p'];?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_sod'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_jens;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
</table>
<p align="center">----------------- پایان گزارش -----------------</p>
</body>
</html>