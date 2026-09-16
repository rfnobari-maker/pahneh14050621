<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی.xls");
include('../../lock_ce.php');
include('../../event.php');
$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<div align="center">  مجموع برش الگوی کشت ابلاغی محصولات زراعی  شهرستان در سال زراعی <?php echo($z_sal)?></div>
              <?php
if (isset($_POST['z_sal'])) 
{  
include('../../login/config.php') ;
// Query to get the summed values from Agri_ab_city, but only for products in Agri_ab_ostan
$query = "
    SELECT 
       c.id_ostan,
        SUM(c.s_abi) AS s_abi_sum, 
        SUM(c.s_dem) AS s_dem_sum, 
        SUM(c.t_abi) AS t_abi_sum, 
        SUM(c.t_dem) AS t_dem_sum, 
        c.product_name, 
        c.group_name
    FROM Agri_ab_ostan AS o
    INNER JOIN Agri_ab_city AS c 
        ON o.id_ostan = c.id_ostan AND o.product_cod = c.product_cod AND o.z_sal = c.z_sal
    WHERE o.z_sal = :z_sal 
    GROUP BY c.id_ostan, c.product_cod
    ORDER BY c.	id_ostan ASC ,c.	group_cod ASC, c.product_cod ASC
";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':z_sal', $z_sal);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="100%" >
              <tr class="text1">
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">عملکرد / کیلوگرم در هکتار<br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center"><p>سطح   / هکتار<br />
          </p></td>
          <td height="35" colspan="2" bgcolor="#CCCCCC" style="text-align: center">مشخصات </td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">استان</td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="15%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="12%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">دیم</td>
          <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td>
          <td width="12%" height="36" bgcolor="#CCCCCC" class="text1" style="text-align: center">نام محصول </td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">گروه</td>
          </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
?>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ( $row['t_dem_sum'] / $row['s_dem_sum'])*1000 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ( $row['t_abi_sum'] / $row['s_abi_sum'])*1000 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['product_name'] ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['group_name']?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_ostan']?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
}

}
}
	?>
  </table>