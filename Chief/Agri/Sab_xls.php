<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی_تجمیعی.xls");
include('../../lock_ce.php');
include('../../event.php');
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<div align="center">برنامه الگوی کشت ابلاغی تجمیعی محصولات زراعی در سال زراعی <?php echo($z_sal)?></div>
              <?php
 if (isset($_POST['z_sal']))
 {
include('../../login/config.php') ;
$query = "
    SELECT 
        o.id_ostan,
        osn.ostan,
        SUM(o.s_dem) AS total_s_dem,
        SUM(o.s_abi) AS total_s_abi,
        SUM(o.s_dem) + SUM(o.s_abi) AS grand_total_s,
        SUM(o.t_dem) AS total_t_dem,
        SUM(o.t_abi) AS total_t_abi,
        SUM(o.t_dem) + SUM(o.t_abi) AS grand_total_t
    FROM Agri_ab_ostan o
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
            <table width="100%" >
              <tr class="text1">
                <td height="35" colspan="3" bgcolor="#CCCCCC" style="text-align: center">تولید کل / تن <br /></td>
                <td colspan="3" bgcolor="#CCCCCC" style="text-align: center"><p>سطح کل   / هکتار<br /></p></td>
                <td width="15%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">استان </td>
                <td width="7%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">مجموع</td>
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">مجموع</td>
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
                <td width="15%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                $total_s_dem = 0;
                $total_s_abi = 0;
                $total_t_dem = 0;
                $total_t_abi = 0;
                $grand_total_s = 0;
                $grand_total_t = 0;

                foreach($stmt as $row){
                    $total_s_dem += $row['total_s_dem'];
                    $total_s_abi += $row['total_s_abi'];
                    $total_t_dem += $row['total_t_dem'];
                    $total_t_abi += $row['total_t_abi'];
                    $grand_total_s += $row['grand_total_s'];
                    $grand_total_t += $row['grand_total_t'];
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['grand_total_t']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['grand_total_s']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_abi']*1; ?></td>
                <td class="style19" align="center" style="vertical-align: middle;" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
        <?php
	$r++ ;
}
?>
              <tr style='background:#e0e0e0; font-weight:bold;'>
                <td align="center" class="normalTextSmall"><?php echo $grand_total_t*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_t_dem*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_t_abi*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $grand_total_s*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_dem*1; ?></td>
                <td align="center" class="normalTextSmall"><?php echo $total_s_abi*1; ?></td>
                <td class="style19" align="center" style="vertical-align: middle;">جمع کل کشور</td>
                <td class="normalTextSmall" align="center"></td>
              </tr>
        <?php
}
}
?>
  </table>