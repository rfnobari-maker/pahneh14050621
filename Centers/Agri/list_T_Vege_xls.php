<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Vege.xls");
?>
<?php 
include('../../lock_p2.php');
include('../../event.php') ;
$add_abadi = $_POST['add_abadi'] ;
$add_city = $_POST['add_city'] ;
$bah_cod_m = $_POST['bah_cod_m'] ;
$mor_cod_m = $_POST['mor_cod_m'] ;
$z_sal = $_POST['z_sal'] ;
$b_time = $_POST['b_time'] ;
$m_ab = $_POST['m_ab'] ;
$confi2 = $_POST['confi1'] ;
$date_check =$_POST['date_check'];  
 if ($add_abadi == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "Vege.add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "Vege.add_city = '$add_city'" ;}
 if ($b_time == '')  { $f_b_time  = 1  ; }else{ $f_b_time = "Vege.b_time = '$b_time'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "Vege.m_ab = '$m_ab'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Vege.bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Vege.mor_cod_m = '$mor_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Vege.z_sal = '$z_sal'" ;}
 if ($confi2 == '')  { $v_confi2  = 1  ; }else{ $v_confi2 = "Vege.confi2 = '$confi2 ' and mah_tolp > 0" ;}
 if ($confi2 == '4') { $v_confi2 = "mah_tolp is null" ;}
include('../../login/config.php');
 $query = "SELECT Vege.id,Vege.id_ostan,Vege.id_city,Vege.add_abadi,Vege.add_city,Vege.no_bah,Vege.b_time,Vege.m_ab,Vege.m_zamin,Vege.bah_cod_m,Vege.mor_cod_m,Vege.z_sal,Vege.sh_gat,Vege.confi2,Vege_prod.date_ab,Vege.id_mar
FROM Vege
INNER JOIN Vege_prod ON Vege.id=Vege_prod.Vege_id
where  Vege.confi='2' and Vege_prod.date_ab <= '$date_check' and $v_confi2 and $v_add_abadi and $v_add_city
and $f_b_time and $f_m_ab and $v_bah_cod_m and $v_mor_cod_m and $v_z_sal and Vege.id_mar = '$id_mar' and 
Vege_prod.dah_bazar != ''
group by Vege.id"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<div style="font-family:'B Titr'" align="center"> لیست قطعات محصولات عمده صیفی، اطلاعات تکمیلی</div>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
  <tr class="text1">
    <td width="8%" bgcolor="#CCCCCC" style="text-align: center">کد ملی مروج</td>
          <td width="8%" bgcolor="#CCCCCC" style="text-align: center">مساحت زمین /<span class="text1">هکتار</span></td>
          <td width="7%" bgcolor="#CCCCCC" style="text-align: center">منبع آب </td>
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">فصل تولید</td>
          <td width="5%" bgcolor="#CCCCCC" style="text-align: center">شماره قطعه</td>
          <td width="6%" bgcolor="#CCCCCC" style="text-align: center">سال زراعی</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">کد ملی</td>
          <td width="12%" bgcolor="#CCCCCC" style="text-align: center">نام و نام خانوادگی</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">شهر/آبادی</td>
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">شهرستان</td>
          <td width="6%" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
if ($row['m_ab']=='1')  $v_m_ab='چشمه';
if ($row['m_ab']=='2')  $v_m_ab='قنات';
if ($row['m_ab']=='3')  $v_m_ab='رودخانه'; 
if ($row['m_ab']=='4')  $v_m_ab='سد';
if ($row['m_ab']=='5')  $v_m_ab='چاه سطحی';
if ($row['m_ab']=='6')  $v_m_ab='چاه عمیق';
if ($row['m_ab']=='7')  $v_m_ab='چاه نیمه عمیق';
if ($row['m_ab']=='8')  $v_m_ab='زهکش';
if ($row['m_ab']=='9')  $v_m_ab='پساب';
if ($row['m_ab']=='10')  $v_m_ab='آب بندان' ;
if ($row['m_ab']=='11')  $v_m_ab='سایر' ;
  ?>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall" style="text-align: center"><?php echo $row['mor_cod_m'] ?></span></td>

          <td height="22" class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
      <?php 
