<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mush_prod_list.xls");
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $y_prod = $_POST['y_prod'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_fani = $_POST['m_fani'] ;
 $v_unit = $_POST['v_unit'] ;
 $nt_comp = $_POST['nt_comp'] ;
 $comp1 = $_POST['comp1'] ;
 $comp2 = $_POST['comp2'] ;
 $t_dpar1 = $_POST['t_dpar1'] ;
 $t_dpar2 = $_POST['t_dpar2'] ;
 $zer_kesh1 = $_POST['zer_kesh1'] ;
 $zer_kesh2 = $_POST['zer_kesh2'] ;
 $mah_tol1 = $_POST['mah_tol1'] ;
 $mah_tol2 = $_POST['mah_tol2'] ;
 $tol_avg1 = $_POST['tol_avg1'] ;
 $tol_avg2 = $_POST['tol_avg2'] ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
<div align="center" dir="rtl">عملکرد سال <?php echo $y_prod ?> واحد های پرورش قارچ</div>
      <?php
 if (1==1) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($v_unit == '')  { $f_v_unit  = 1  ; }else{ $f_v_unit = "v_unit = '$v_unit'" ;}
 if ($m_fani == '')  { $f_m_fani  = 1  ; }else{ $f_m_fani = "m_fani = '$m_fani'" ;}
 if ($nt_comp == '0')  { $f_nt_comp  = 1  ; }else{ $f_nt_comp = "nt_comp = '$nt_comp'" ;}
 if ($comp1 == '')  { $v_comp1  = 1  ; }else{ $v_comp1 = "comp >= $comp1" ;}
 if ($comp2 == '')  { $v_comp2  = 1  ; }else{ $v_comp2 = "comp <= $comp2" ;}
 if ($t_dpar1 == '')  { $v_t_dpar1 = 1  ; }else{ $v_t_dpar1  = "t_dpar >= $t_dpar1" ;}
 if ($t_dpar2 == '')  { $v_t_dpar2  = 1  ; }else{ $v_t_dpar2 = "t_dpar <= $t_dpar2" ;}
 if ($zer_kesh1 == '')  { $v_zer_kesh1 = 1  ; }else{ $v_zer_kesh1  = "zer_kesh >= $zer_kesh1" ;}
 if ($zer_kesh2 == '')  { $v_zer_kesh2  = 1  ; }else{ $v_zer_kesh2 = "zer_kesh <= $zer_kesh2" ;}
 if ($mah_tol1 == '')  { $v_mah_tol1  = 1  ; }else{ $v_mah_tol1 = "mah_tol >= $mah_tol1" ;}
 if ($mah_tol2 == '')  { $v_mah_tol2  = 1  ; }else{ $v_mah_tol2 = "mah_tol <= $mah_tol2" ;}
 if ($tol_avg1 == '')  { $v_tol_avg1  = 1  ; }else{ $v_tol_avg1 = "tol_avg >= $tol_avg1" ;}
 if ($tol_avg2 == '')  { $v_tol_avg2  = 1  ; }else{ $v_tol_avg2 = "tol_avg <= $tol_avg2" ;}
 include('../../login/config.php');
 $query = " SELECT id_ostan,id_city,id_mar,mor_cod_m,add_abadi,add_city,num_bah,bah_cod_m,mor_cod_m,unit_id,t_zan,t_mar,m_fani,no_mush,comp,nt_comp
 ,t_dpar,zer_kesh,mah_tol,tol_avg,v_unit from Mushroom_prod
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and y_prod = '$y_prod' and 
$f_no_mush and $f_v_unit and $f_m_fani and $v_t_dpar1 and $v_t_dpar2 and $v_comp1 and $v_comp2 and $f_nt_comp and 
$v_zer_kesh1 and $v_zer_kesh2 and $v_mah_tol1 and $v_mah_tol2 and $v_tol_avg1 and $v_tol_avg2
and $v_bah_cod_m and $v_mor_cod_m ORDER BY bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      <br />
<table width="99%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#66CCFF">
              <tr class="text1">
                <td align="center" width="5%" bgcolor="#CCCCCC">همراه  کارشناس</td>
                <td align="center" width="5%" bgcolor="#CCCCCC">کد ملی کارشناس</td>
                <td align="center" width="5%" bgcolor="#CCCCCC">نام کارشناس</td>
                <td align="center" width="5%" bgcolor="#CCCCCC">عملکرد تولید / کیلوگرم بر مترمربع</td>
          <td align="center" width="3%" bgcolor="#CCCCCC"><p>کل تولید / تن</p></td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح زیر کشت/ مترمربع</td>
          <td align="center" width="5%" bgcolor="#CCCCCC"><p>تعداد دوره پرورشی</p></td>
          <td align="center" width="6%" bgcolor="#CCCCCC">نحوه تامین کمپوست</td>
          <td align="center" width="6%" bgcolor="#CCCCCC"><p>کمپوست مصرفی /تن در سال</p></td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نوع قارچ</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">مسئول فنی</td>
          <td align="center" width="6%" bgcolor="#CCCCCC"><p>تعداد شاغل/ نفر
          </p></td>
          <td align="center" width="8%" bgcolor="#CCCCCC"><span class="text1"> کد ملی</span></td>
          <td align="center" width="12%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">آبادی/شهر</td>
          <td align="center" width="3%" bgcolor="#CCCCCC">مرکز</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="12%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 

if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';

if ($row['nt_comp']=='1')  $v_nt_comp='خود مصرفی';
if ($row['nt_comp']=='2')  $v_nt_comp='خریداری شده';
if ($row['nt_comp']=='3')  $v_nt_comp='ترکیبی';
  ?>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tol_avg'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol']*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesh']*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dpar'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_nt_comp ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['comp']*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush;  ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_fani ; ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_mar'] + $row['t_zan'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
<p>
  <?php }  
    }
?>
<p align="center">پایان گزارش</p>

</body>
</html>