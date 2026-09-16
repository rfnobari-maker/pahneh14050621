<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_بهره_برداران.xls");
include('../lock_expar.php');
include('../event.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $sh_meli   = $_POST['sh_meli'] ;
 $s_bah     = $_POST['s_bah'] ;
 $ok     = $_POST['ok'] ;
 if(isset($_POST['no_bah'])) $no_bah = $_POST['no_bah'] ;
 if(isset($_POST['no_fa'])) $no_fa1 = $_POST['no_fa'] ;
 
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "bah.id_ostan='$id_ostan1'" ;}
 if ($id_city == '')    { $v_id_city = 1 ;} else { $v_id_city = "bah.id_city='$id_city'" ;}
 if ($id_mar  == '')    { $v_id_mar = 1 ;} else { $v_id_mar = "bah.id_mar='$id_mar'" ;}
 if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "bah.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "bah.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "bah.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah.bah_cod_m = '$bah_cod_m'" ;}
 if ($sh_meli == '')    { $v_sh_meli  = 1      ; }else{ $v_sh_meli = "bah.sh_meli = '$sh_meli'" ;}
 if ($s_bah == '')     { $v_s_bah  = 1         ; }else{ $v_s_bah = "bah.s_bah = '$s_bah'" ;}
 if ($no_fa1 == '')  { $v_no_fa  = 1  ; }else{ $v_no_fa = "$no_fa1='1'" ;}
 if ($ok == '')  { $f_ok  = 1  ; }else{ $f_ok = "bah.ok = '$ok'" ;}
 if ($no_bah == '')  { $f_no_bah  = 1  ; }else{ $f_no_bah = "bah.no_bah = '$no_bah'" ;}
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
 $query = "SELECT bah.*
,list_abadi.ostan,list_abadi.city as city1,list_abadi.abadi,list_abadi.mar
,list_city.ostan,list_city.city as city2,list_city.shahr,list_city.mar
 FROM  bah
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city  and $v_mor_cod_m and
  $v_bah_cod_m and $v_sh_meli  and $v_s_bah and $v_no_fa and $f_ok and $f_no_bah ORDER BY BINARY last_name ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="90" border="1" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text1">
          <td height="57" bgcolor="#FFFFFF"><p class="style8">کد ملی کارشناس</p></td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">نام کارشناس</td>
          <td bgcolor="#FFFFCC" class="style8">پرورش قارچ</td>
          <td bgcolor="#FFFFCC" class="style8">صنایع کشاورزی</td>
          <td bgcolor="#FFFFCC" class="style8">پرورش ماهی</td>
          <td bgcolor="#FFFFCC" class="style8">کرم ابرایشم</td>
          <td bgcolor="#FFFFCC" class="style8">زنبورعسل</td>
          <td bgcolor="#FFFFCC" class="style8">طیور صنعتی</td>
          <td bgcolor="#FFFFCC" class="style8">طیور سنتی</td>
          <td bgcolor="#FFFFCC" class="style8">دام سبک</td>
          <td bgcolor="#FFFFCC" class="style8">دام سنگین</td>
          <td bgcolor="#FFFFCC" class="style8">گلخانه</td>
          <td bgcolor="#FFFFCC" class="style8">باغ و قلمستان</td>
          <td bgcolor="#FFFFCC" class="style8">اراضی زراعی</td>
          <td bgcolor="#FFFFFF" class="style8">آخرین وضعیت بهره بردار</td>
          <td bgcolor="#FFFFFF" class="style8">کد پستی</td>
          <td height="57" bgcolor="#FFFFFF" class="style8">شماره همراه</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">شماره ثابت</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">مدرک مرتبط</td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">مدرک تحصیلی </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8">نام پدر</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">محل صدور</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">شماره شناسنامه</td>
          <td width="3%" bgcolor="#FFFFFF" class="style8">تاریخ تولد </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8">نام شرکت </td>
          <td width="2%" bgcolor="#FFFFFF" class="style8">شناسه ملی</td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> کد ملی<br />
          </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">جنسیت</td>
          <td width="5%" bgcolor="#FFFFFF" class="style8">نام خانوادگی</td>
          <td width="2%" bgcolor="#FFFFFF" class="style8"> نام </td>
          <td width="3%" bgcolor="#FFFFCC" class="style8">نوع سکونت</td>
          <td width="3%" bgcolor="#FFFFCC" class="style8">نوع بهره بردار</td>
          <td width="3%" bgcolor="#FFFFCC" class="style8">آدرس آماری</td>
          <td width="3%" bgcolor="#FFFFCC" class="style8">شهر / آبادی </td>
          <td width="17%" bgcolor="#FFFFCC" class="style8">شهرستان </td>
          <td width="4%" bgcolor="#FFFFFF" class="style8">تاریخ ثبت / ویرایش</td>
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
          <td align="center" width="5%" height="30" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $mor_cod_m?></span></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo user_name($mor_cod_m)?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_14 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_13 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_12 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_11 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_10 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_9 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_8 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_67 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_45 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_3 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_2 ;?></td>
          <td  width="2%" align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_fa_1 ;?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $v_ok;?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['cod_p'];?></td>
          <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel_s'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_er_mtah ;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_tah ;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_sod'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['co_name'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_meli'];?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_jens;?></td>
          <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
          <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_s_bah ;?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['add_abadi'];?><?php echo $row['add_city'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><?php echo $row['shahr'];?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city1'];?><?php echo $row['city2'];?></td>
          <td align="center" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'];?></td>
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