<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=list.xls");
include('../../lock_ce.php');
include('../../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
         <?php
 include_once('../../login/config.php');
 $query = "SELECT 
Agri_prod1398_1399.id_ostan,
Agri_prod1398_1399.id_city,
Agri_prod1398_1399.id_mar,
Agri_prod1398_1399.add_abadi,
Agri_prod1398_1399.add_city,
bah.name,
bah.last_name,
bah.fname ,
Agri1398_1399 .m_ab,
 Agri1398_1399.no_ab,
Agri_prod1398_1399.bah_cod_m,
Agri_prod1398_1399.zer_kesht_a,
Agri_prod1398_1399.zer_kesht_b,(Agri_prod1398_1399.zer_kesht_a+Agri_prod1398_1399.zer_kesht_b) as zk ,
Agri_prod1398_1399.s_bar_a,
Agri_prod1398_1399.s_bar_b,
(Agri_prod1398_1399.s_bar_a+Agri_prod1398_1399.s_bar_b) as sb ,
Agri_prod1398_1399.mah_tol 
from Agri_prod1398_1399 
inner join Agri1398_1399 ON Agri1398_1399.id = Agri_prod1398_1399.Agri_id
inner join bah ON bah.num_bah = Agri_prod1398_1399.num_bah and 
bah.bah_cod_m = Agri_prod1398_1399.bah_cod_m
where Agri_prod1398_1399.cod_mah='106' and 
(Agri_prod1398_1399.zer_kesht_a > 0 or Agri_prod1398_1399.zer_kesht_b > 0) and 
(Agri_prod1398_1399.s_bar_a >0 or Agri_prod1398_1399.s_bar_b > 0) 
and Agri_prod1398_1399.mah_tol > 0 
ORDER BY Agri_prod1398_1399.id_ostan,Agri_prod1398_1399.id_city,Agri_prod1398_1399.id_mar,Agri_prod1398_1399.add_abadi , Agri_prod1398_1399.add_city,Agri_prod1398_1399.bah_cod_m ASC   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ; ?>
<p  align="center" style="font-size:16px; font-family:Tahoma" >بهره برداران تولید کننده محصول <?php echo mah_name('106') ;?> طی سال زراعی <?php echo '1398-1399' ;?> </p>
            <table width="89%" height="96" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td align="center" width="4%" height="41" bgcolor="#999999">میزان تولید /
            تن </td>
          <td align="center" width="7%" bgcolor="#999999">جمع سطح برداشت/
            هکتار</td>
          <td align="center" width="4%" bgcolor="#999999">سطح برداشت اول</td>
          <td align="center" width="4%" bgcolor="#999999">سطح برداشت دوم</td>
          <td align="center" width="5%" bgcolor="#999999">جمع سطح زیر کشت/
            هکتار</td>
          <td align="center" width="5%" bgcolor="#999999">سطح زیر کشت دوم</td>
          <td align="center" width="5%" bgcolor="#999999">سطح زیر کشت اول</td>
          <td align="center" width="3%" bgcolor="#999999">نوع آبیاری </td>
          <td align="center" width="3%" bgcolor="#999999">منبع آب </td>
          <td align="center" width="3%" bgcolor="#999999">نام پدر</td>
          <td align="center" width="2%" bgcolor="#999999"><span class="text1"> کد ملی</span></td>
          <td align="center" width="6%" bgcolor="#999999"> نام خانوادگی</td>
          <td align="center" width="6%" bgcolor="#999999">نام </td>
          <td align="center" width="5%" bgcolor="#999999">آدرس آماری  آبادی </td>
          <td align="center" width="5%" bgcolor="#999999">آدرس آماری شهر  </td>
          <td align="center" width="4%" bgcolor="#999999">کد مرکز</td>
          <td align="center" width="8%" bgcolor="#999999">کد شهرستان </td>
          <td align="center" width="4%" bgcolor="#999999">کد استان</td>
          <td align="center" width="7%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
          <td align="center" width="6%" bgcolor="#999999">آبادی</td>
          <td align="center" width="6%" bgcolor="#999999">شهر  </td>
          <td align="center" width="7%" bgcolor="#999999">شهرستان</td>
          <td align="center" width="6%" bgcolor="#999999">استان </td>
          <td align="center" width="4%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
$m_ab  = $row['m_ab'];
$no_ab = $row['no_ab'];
if ($m_ab=='1') $v_m_ab = 'چشمه' ;
if ($m_ab=='2') $v_m_ab ='قنات' ; 
if ($m_ab=='3') $v_m_ab ='رودخانه' ; 
if ($m_ab=='4') $v_m_ab ='سد' ; 
if ($m_ab=='5') $v_m_ab ='چاه سطحی' ; 
if ($m_ab=='6') $v_m_ab ='چاه عمیق' ; 
if ($m_ab=='7') $v_m_ab ='چاه نیمه عمیق' ; 
if ($m_ab=='8') $v_m_ab ='زهکش' ; 
if ($m_ab=='9') $v_m_ab ='پساب' ; 
if ($m_ab=='10') $v_m_ab ='آب بندان' ; 
if ($m_ab=='11') $v_m_ab ='سایر' ; 

if ($no_ab=='1') $v_no_ab = 'جوی و پشته' ; 
if ($no_ab=='2') $v_no_ab = 'نواری' ; 
if ($no_ab=='3') $v_no_ab = 'غرقابی' ; 
if ($no_ab=='4') $v_no_ab = 'تشتکی' ; 
if ($no_ab=='5') $v_no_ab = 'تحت فشار قطره ای' ; 
if ($no_ab=='6') $v_no_ab = 'تحت فشار بارانی' ; 
if ($no_ab=='7') $v_no_ab = 'سایر' ; 

  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],2)?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['sb'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar_b'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar_a'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zk'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_kesht_b'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_kesht_a'],2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_ab ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'] ?></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'] ?></td>
          <td class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['name'] ?></div></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo '-'.$row['add_abadi'].'-' ;  ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'] ;  ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_mar'] ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_city'] ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_ostan'] ?></td>
          <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
  <td  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan'])?></td>
  <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
?>
<p align="center">-------------- پایان گزارش ----------------</p>
</body>
</html>