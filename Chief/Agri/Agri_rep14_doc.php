<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Agri_rep14.doc");
include('../../lock_ce.php');
include('../../event.php');
include('counter14.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<p align="center" dir="rtl"  class="style8">گزارش اطلاعات زراعی به تفکیک بهره بردار - سال زراعی <?php echo $z_sal?>
        <?php
 if ($id_ostan1 == '-1') {$v_id_ostan   = 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar     = 1 ;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi  = 1 ;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city   = 1 ;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')    {$f_no_kesh    = 1 ;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m  = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m  = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 include_once('../../login/config.php');
 $query = "SELECT DISTINCT bah_cod_m from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m  ORDER BY bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
<table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#bbbbbb">
              <tr class="text1">
                <td width="13%" rowspan="2" align="center">کد ملی کارشناس</td>
          <td colspan="2" align="center">میزان محصول / تن </td>
          <td align="center" colspan="4">مساحت /  هکتار </td>
          <td align="center" width="6%" rowspan="2"> تعداد<br />
            قطعه<br /></td>
          <td align="center" height="24" colspan="2">مشخصات بهره بردار</td>
          <td align="center" width="3%" rowspan="2">ردیف</td>
  </tr>
        <tr class="text1">
          <td align="center" width="13%">قطعی</td>
          <td align="center" width="12%">پیش بینی</td>
          <td align="center" width="12%">سطح برداشت</td>
          <td align="center" width="11%">سطح زیر کشت</td>
          <td align="center" width="10%">اراضی آیش</td>
          <td align="center" width="9%">  اراضی زراعی</td>
          <td align="center" width="9%" height="36" class="style8"><span class="text1"> کد ملی</span></td>
          <td align="center" width="15%">نام و نام خانوادگی</td>
  </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_tol($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_tolp($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo s_bar($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo zer_kesht($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo s_ayesh($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo m_zamin($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Agri_gat($row['bah_cod_m'],$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal) ; ?></td>
          <td height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
</table>
     <?php }
?>
<p align="center">----------------- پایان گزارش -----------------</p>
</body>
</html>


