<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گروه_محصولات_زراعی.doc");
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول
 $mah_qroup = $_POST['mah_qroup'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
        <?php
 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')    {$f_no_kesh   =1;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m =1;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m =1;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_qroup == '')    {$v_cod_qroup   =1;}else{ $v_cod_qroup = "cod_qroup = '$mah_qroup'" ;}
$query = "SELECT cod_qroup ,
sum(zer_kesht_a)  zer_keshta ,
sum(zer_kesht_b)  zer_keshtb ,
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM `$Agri_prod_table`
where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and $v_cod_qroup and cod_qroup !='' Group by cod_qroup "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
<p align="center" dir="rtl">گزارش محصولات زراعی - سال زراعی <?php echo $z_sal?></p>
      <table width="85%" height="117" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
        <tr align="center" class="text1">
               <td height="39" colspan="2" bgcolor="#999999">میزان تولید محصول<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت <br />
                <span class="style2">هکتار</span></td>
               <td valign="middle" width="10%" rowspan="2" bgcolor="#999999">کد گروه</td>
               <td valign="middle" width="19%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">قطعی</td>
               <td bgcolor="#999999">پیش بینی</td>
               <td width="8%" height="38" bgcolor="#999999">کل</td>
               <td width="9%" bgcolor="#999999">کشت دوم</td>
               <td width="8%" bgcolor="#999999">کشت اول</td>
               <td height="38" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">کشت دوم</td>
               <td width="7%" bgcolor="#999999">کشت اول</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $zer_keshta = round($row['zer_keshta'],3) ;
 $zer_keshtb = round($row['zer_keshtb'],3) ;
 $zer_keshtkol =  $zer_keshta + $zer_keshtb ; 
 $s_bara = round($row['s_bara'],3) ;
 $s_barb = round($row['s_barb'],3) ;
 $s_barkol =  $s_bara + $s_barb ;
 $mahtol= round($row['mahtol'],3) ; 
 $mahtolp= round($row['mahtolp'],3) ; 
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="9%" height="38" ><?php echo $mahtol ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="11%" ><?php echo $mahtolp ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barkol ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barb ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_bara ;?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtkol ;?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtb ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshta ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['cod_qroup'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo group_name($row['cod_qroup']);?><br /></td>
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