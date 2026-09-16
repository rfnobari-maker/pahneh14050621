<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mush_spawn_list.xls");
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd align="center"XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
<div align="center" dir="rtl">اطلاعات سالن های پرورش واحد های پرورش قارچ در  سال <?php echo $y_prod ?></div>
      <?php
 if (1==1) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Mushroom.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Mushroom.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Mushroom.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Mushroom.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Mushroom.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Mushroom.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Mushroom.bah_cod_m = '$bah_cod_m'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "Mushroom.no_mush = '$no_mush'" ;}
 if ($v_unit == '')  { $f_v_unit  = 1  ; }else{ $f_v_unit = "Mushroom.v_unit = '$v_unit'" ;}
 include('../../login/config.php');
  $query = "SELECT Mushroom.id,Mushroom.id_ostan,Mushroom.id_city,Mushroom.id_mar,Mushroom.bah_cod_m
,Mushroom.no_mush,Mushroom.unit_name
,Mushroom.mor_cod_m,Mushroom.m_zamin,Mushroom.m_arseh,Mushroom.m_salon
,Mushroom_spawn.num_row,Mushroom_spawn.num_t_row,Mushroom_spawn.h_t,Mushroom_spawn.w_t,Mushroom_spawn.num_spawn,Mushroom_spawn.zer_kesh
,Mushroom_prod.t_dpar
FROM Mushroom 
inner join Mushroom_spawn ON Mushroom.id = Mushroom_spawn.unit_id and Mushroom_spawn.y_prod = '$y_prod'
inner join Mushroom_prod ON Mushroom.id = Mushroom_prod.unit_id and Mushroom_prod.y_prod = '$y_prod'
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and Mushroom_prod.y_prod = '$y_prod' and 
$f_no_mush and $v_bah_cod_m and $v_mor_cod_m  group by Mushroom.id ORDER BY id_ostan,id_city,bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      <br />
      <table width="99%" border="1" align="center" cellpadding="0"  cellspacing="0" bordercolor="#0099CC">
        <tr class="text1">
          <td width="6%" height="44" align="center" bgcolor="#CCCCCC">کد ملی کارشناس</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">سطح زیر کشت سالن/مترمربع</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد سالن</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">عرض هر طبقه/متر</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">طول هر طبقه/متر</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد طبقه در هر ردیف</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد ردیف</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">تعداد دوره پرورشی</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">مساحت سالن</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">مساحت زیربنا</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">مساحت زمین</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نوع قارچ</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">کد واحد</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">نام واحد</td>
          <td align="center" width="9%" bgcolor="#CCCCCC"> کد ملی</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="11%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 

if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

  ?>
          <td height="28" align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesh'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_spawn'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['w_t'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['h_t'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_t_row'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_row'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dpar'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_salon']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_arseh']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush;  ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']);?></td>
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