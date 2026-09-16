<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
// به‌روزرسانی نام فایل برای محصولات باغی
header("Content-Disposition: attachment;Filename=الگوی_کشت_ابلاغی_محصولات_باغی.xls");
include('../../lock_cp.php');
include('../../event.php');
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<div align="center">برنامه الگوی کشت ابلاغی محصولات باغی در سال زراعی <?php echo($z_sal)?></div>
              <?php
 if (isset($_POST['z_sal']))
 {
include('../../login/config.php') ;
// کوئری SQL برای محصولات باغی (مشابه Sab.php)
$query = "
    SELECT 
        o.id_ostan,
        osn.ostan,
        SUM(o.s_nobar_dem) AS total_s_nobar_dem,
        SUM(o.s_nobar_abi) AS total_s_nobar_abi,
        SUM(o.s_bar_dem) AS total_s_bar_dem,
        SUM(o.s_bar_abi) AS total_s_bar_abi,
        SUM(o.t_dem) AS total_t_dem,
        SUM(o.t_abi) AS total_t_abi
    FROM Garden_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    WHERE o.z_sal = :z_sal
    GROUP BY o.id_ostan, osn.ostan
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal
));
$t_row = $stmt -> rowCount() ;
if ($t_row>0) { ;
?>
            <table width="100%" border="1" style="border-collapse: collapse;">
              <tr class="text1">
                <td height="35" colspan="3" bgcolor="#006699" style="text-align: center; color: white;">تولید کل / تن <br /></td>
                <td colspan="3" bgcolor="#006699" style="text-align: center; color: white;"><p>سطح کل بارور  / هکتار<br /></p></td>
                <td colspan="3" bgcolor="#006699" style="text-align: center; color: white;">سطح کل   غیر بارور/ هکتار</td>
                <td width="15%" rowspan="2" bgcolor="#006699" style="text-align: center; color: white;">استان </td>
                <td width="7%" rowspan="2" bgcolor="#006699" style="text-align: center; color: white;">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">مجموع</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">دیم</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">آبی</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">مجموع</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">دیم</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">آبی</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">مجموع</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">دیم</td>
                <td width="10%" bgcolor="#006699" style="text-align: center; color: white;">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                // متغیرهای جمع کل برای محصولات باغی
                $total_s_nobar_dem_sum = 0;
                $total_s_nobar_abi_sum = 0;
                $total_s_bar_dem_sum = 0;
                $total_s_bar_abi_sum = 0;
                $total_t_dem_sum = 0;
                $total_t_abi_sum = 0;
                
                foreach($stmt as $row){
                    // محاسبات مجموع‌های استانی
                    $grand_total_s_nobar  = $row['total_s_nobar_dem'] + $row['total_s_nobar_abi'] ;
                    $grand_total_s_bar  = $row['total_s_bar_dem'] + $row['total_s_bar_abi'] ;
                    $grand_total_t = $row['total_t_dem'] + $row['total_t_abi'] ; 

                    // محاسبه جمع کل کشور
                    $total_s_nobar_dem_sum += $row['total_s_nobar_dem'];
                    $total_s_nobar_abi_sum += $row['total_s_nobar_abi'];
                    $total_s_bar_dem_sum += $row['total_s_bar_dem'];
                    $total_s_bar_abi_sum += $row['total_s_bar_abi'];
                    $total_t_dem_sum += $row['total_t_dem'];
                    $total_t_abi_sum += $row['total_t_abi'];
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_t*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_s_bar*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_bar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_bar_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_s_nobar*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_nobar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_nobar_abi']*1; ?></td>
                <td class="style19" align="center" style="vertical-align: middle;" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
        <?php
	$r++ ;
}
// محاسبه مجموع نهایی
$grand_total_s_nobar_sum = $total_s_nobar_dem_sum + $total_s_nobar_abi_sum;
$grand_total_s_bar_sum = $total_s_bar_dem_sum + $total_s_bar_abi_sum;
$grand_total_t_sum = $total_t_dem_sum + $total_t_abi_sum;
?>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td align="center" class="normalTextSmall"><?php echo $grand_total_t_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_t_dem_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_t_abi_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $grand_total_s_bar_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_bar_dem_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_bar_abi_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $grand_total_s_nobar_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_nobar_dem_sum*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_nobar_abi_sum*1; ?></td>
                <td class="style19" align="center" style="vertical-align: middle;">جمع کل کشور</td>
                <td class="normalTextSmall" align="center"></td>
              </tr>
        <?php
}
}
?>
  </table>