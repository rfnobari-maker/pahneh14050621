<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='اطلاعات_صیفی_استان_شهرستان.xls");
include('../../lock_oce.php');
include('../../event.php');
include('../../login/config.php') ;
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
<div align="center" dir="rtl">اطلاعات محصولات صیفی سال 1400-1399 به تفکیک استان و شهرستان </div> 
<?php
 $query = "SELECT z_sal,id_ostan,id_city,cod_mah,sum(s_bar)
 as sb , sum(mah_tol) as mah_tol FROM Vege_prod WHERE z_sal = '1399-1400' 
 and s_bar > 0 and id_ostan = '$id_ostan' group by id_ostan , id_city  ,cod_mah  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
           <table width="95%" height="100" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
              <tr align="center" class="text1">
               <td bgcolor="#999999">عملکرد کیلوگرم در هکتار</td>
               <td bgcolor="#999999">تولید به تن</td>
               <td bgcolor="#999999">سطح برداشت به هکتار</td>
               <td bgcolor="#999999">نوع کشت</td>
               <td bgcolor="#999999">کد گروه</td>
               <td bgcolor="#999999">نام گروه</td>
               <td width="5%" bgcolor="#999999">کد محصول</td>
               <td width="5%" bgcolor="#999999">نام محصول</td>
               <td width="6%" bgcolor="#999999">کد شهرستان</td>
               <td bgcolor="#999999">نام شهرستان</td>
               <td bgcolor="#999999">کد استان</td>
               <td width="12%" bgcolor="#999999">نام استان</td>
               <td width="9%" bgcolor="#999999">سال زراعی</td>
               <td width="3%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $s_b = round($row['sb'],2) ;
 $mah_tol = round($row['mah_tol'],2) ;
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="28" ><?php echo round(($mah_tol/$s_b)*1000,0) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $mah_tol ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $s_b ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" >1</td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" >4</td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" >سبزیجات</td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_mah'] ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_city'] ;?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                 <?php  echo $row['id_ostan'] ; ?>
               </span></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                 <?php  echo ostan_name($row['id_ostan'] ); ?>
               </span></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php  echo $row['z_sal'] ; ?>
               </span><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
       </table>
             <?php
}
?>
</table>
</body>
</html>