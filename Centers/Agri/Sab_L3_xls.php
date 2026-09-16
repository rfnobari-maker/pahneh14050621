<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=االگوی_کشت_ابلاغی.xls");
include('../../lock_p2.php');
include('../../event.php');
 $id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
 $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
 $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
  $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
?>
<div align="center">  برنامه الگوی کشت ابلاغی محصولات زراعی مرکز جهاد کشاورزی  <?php echo mar_name($id_mar) ?> شهرستان  <?php echo city_name1($id_city,$id_ostan) ?> در سال زراعی <?php echo($z_sal)?></div><br />
              <?php
 if (isset($_POST['z_sal'])) 
 {  
include('../../login/config.php') ;
  $query = "SELECT  * from Agri_ab_mar where z_sal = '$z_sal' and id_ostan = '$id_ostan' and id_city = '$id_city' and id_mar = '$id_mar' and ((s_abi >0) or (s_dem >0)) group by group_cod,product_cod ASC "; 
$stmt = $dbh->prepare($query);
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
//$r = $start+1 ;
$r = 1 ;
foreach($stmt as $row){ 
 $t_r = $r ; 
  ?>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1 ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['product_name'] ?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['group_name']?></td>
          <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
}
}
}
	?>
  </table>
