<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='گزارش_1_آمارنامه.xls");
include('../../lock_cp.php');
include('../../event.php');
include_once('../../login/config.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $z_sal = $_POST['z_sal'] ;
 $Agri_prod_table = 'Agriprod'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
<p align="center" dir="rtl">برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>     
         <?php
 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
$query = "SELECT cod_qroup_amar , cod_mah_amar , cod_mah, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 


sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and cod_qroup_amar !='' Group by cod_qroup_amar , cod_mah_amar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="95%" height="90" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
              <tr  class="text1">
               <td align="center" colspan="2" bgcolor="#999999">عملکرد
                 <span class="style2">کیلوگرم</span></td>
               <td align="center" colspan="3" bgcolor="#999999">میزان تولید
                <span class="style2">تن</span></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح 
                <span class="style2">هکتار</span></td>
               <td align="center" width="15%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td align="center" width="20%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td align="center" width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="20" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" width="8%" height="20" bgcolor="#999999">جمع</td>
               <td align="center" width="8%" bgcolor="#999999">دیم</td>
               <td align="center" width="7%" bgcolor="#999999">آبی</td>
               <td align="center" height="20" bgcolor="#999999">جمع</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="23" ><?php echo round($mahtol_d/$s_d*1000) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_amar($row['cod_mah_amar']);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if($row['cod_qroup_amar'] == '4') echo group_name_amar($row['cod_qroup_amar']).'**'; else echo group_name_amar($row['cod_qroup_amar']);?>                 <br /></td>
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
<P></P>
           <table width="95%" height="88" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr class="text1">
               <td align="center" height="38" colspan="2" bgcolor="#999999">عملکرد
                 <span class="style2">کیلوگرم</span></td>
               <td align="center" colspan="3" bgcolor="#999999">میزان تولید
                 <span class="style2">تن</span></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح 
                <span class="style2">هکتار</span></td>
               <td align="center" width="15%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td align="center" width="20%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td align="center" width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="20" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" width="8%" height="20" bgcolor="#999999">جمع</td>
               <td align="center" width="8%" bgcolor="#999999">دیم</td>
               <td align="center" width="7%" bgcolor="#999999">آبی</td>
               <td align="center" height="20" bgcolor="#999999">جمع</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT 
cod_mah ,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
GROUP BY cod_mah
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
        $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="28" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="28" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo group_name_amar('4');?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
</table>
</table>       

</body>
</html>