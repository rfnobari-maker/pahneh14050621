<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی_باغی.xls");
include('../../lock_p3.php');
include('../../event.php');
 $id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
 $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<div align="center">  مجموع برش الگوی کشت ابلاغی محصولات باغی شهرستان در سال <?php echo($z_sal)?></div>
              <?php
if (isset($_POST['z_sal'])) 
{  
include('../../login/config.php') ;
// Query جدید برای محصولات باغی (Garden)
$query = "
    SELECT 
        id_ostan,
        SUM(s_bar_abi) AS s_bar_abi_sum, 
        SUM(s_bar_dem) AS s_bar_dem_sum,
        SUM(s_nobar_abi) AS s_nobar_abi_sum, 
        SUM(s_nobar_dem) AS s_nobar_dem_sum, 
        SUM(t_abi) AS t_abi_sum, 
        SUM(t_dem) AS t_dem_sum, 
        product_cod,       
        product_name, 
        group_cod,         
        group_name
    FROM Garden_ab_ostan 
    WHERE z_sal = :z_sal AND id_ostan = :id_ostan 
    GROUP BY product_cod, product_name, group_cod, group_name
    ORDER BY group_cod ASC, product_cod ASC
";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':z_sal', $z_sal); 
$stmt->bindParam(':id_ostan', $id_ostan); 
$stmt->execute();
$t_row = $stmt->rowCount();if ($t_row>0) { ;
?>
            <table width="100%" >
              <tr class="text1">
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center"><p>سطح کل بارور  / هکتار<br /></p></td>
          <td colspan="2" bgcolor="#CCCCCC" style="text-align: center">سطح کل غیر بارور / هکتار</td>
          <td height="35" colspan="2" bgcolor="#CCCCCC" style="text-align: center">مشخصات </td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">استان</td>
          <td width="5%" rowspan="2" bgcolor="#CCCCCC" style="text-align: center">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="11%" bgcolor="#CCCCCC" style="text-align: center">دیم</td> <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td> <td width="10%" bgcolor="#CCCCCC" style="text-align: center">دیم</td> <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td> <td width="10%" bgcolor="#CCCCCC" style="text-align: center">دیم</td> <td width="9%" bgcolor="#CCCCCC" style="text-align: center">آبی</td> <td width="12%" height="36" bgcolor="#CCCCCC" class="text1" style="text-align: center">نام محصول </td>
          <td width="10%" bgcolor="#CCCCCC" style="text-align: center">گروه</td>
          </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
?>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi_sum']*1 ?></td>

          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_dem_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_abi_sum']*1 ?></td>

          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_dem_sum']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_abi_sum']*1 ?></td>
          
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