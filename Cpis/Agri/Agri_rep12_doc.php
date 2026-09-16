<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_یک_محصول.doc");
include("../../lock_cp.php");
include_once("../../event.php");
include_once('../../login/config.php');
if (isset($_POST['z_sal'])) 
{ 
 $z_sal= $_POST['z_sal'] ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
}
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
<p dir="rtl" align="center" class="style8">گزارش اطلاعات محصول <?php echo mah_name($mah_name) ?> به تفکیک استان در سال <?php echo $z_sal ?></p>
<table width="98%" height="153" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="40" colspan="3" bgcolor="#CCCCCC">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#CCCCCC">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td rowspan="2" bgcolor="#CCCCCC">پیش بینی تولید <br />
                <span class="style2">تن</span> <br /></td>
               <td colspan="3" bgcolor="#CCCCCC">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
               <td width="7%" rowspan="2" bgcolor="#CCCCCC">استان </td>
               <td width="4%" rowspan="2" bgcolor="#CCCCCC">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" bgcolor="#CCCCCC">کل</td>
               <td bgcolor="#CCCCCC">دیم</td>
               <td bgcolor="#CCCCCC">آبی</td>
               <td height="29" bgcolor="#CCCCCC">کل</td>
               <td bgcolor="#CCCCCC">دیم</td>
               <td bgcolor="#CCCCCC">آبی</td>
               <td height="29" bgcolor="#CCCCCC">کل</td>
               <td bgcolor="#CCCCCC">دیم</td>
               <td width="6%" bgcolor="#CCCCCC">آبی</td>
  </tr>
             <tr>
               <?php
 $query = "SELECT 
    id_ostan , ostanname.ostan ,
    sum(zer_kesht_a) zer_k1,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) as zer_k1_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) as zer_k1_dim,

    sum(zer_kesht_b) zer_k2,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) as zer_k2_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) as zer_k2_dim,

    sum(s_bar_a) s_bar1,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) as s_bar1_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) as s_bar1_dim,

    sum(s_bar_b) s_bar2,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) as s_bar2_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) as s_bar2_dim,
	
    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol,
    sum(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) as m_tol_abi,
    sum(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) as m_tol_dim
FROM $Agri_prod_table 
left join ostanname on $Agri_prod_table.id_ostan = ostanname.id_ostan
where   cod_qroup = '$mah_qroup' and cod_mah = '$mah_name'
GROUP BY id_ostan ORDER BY FIELD($Agri_prod_table.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="40" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center"width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center"width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center"width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?><br /></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT 
    sum(zer_kesht_a) zer_k1,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) as zer_k1_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) as zer_k1_dim,

    sum(zer_kesht_b) zer_k2,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) as zer_k2_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) as zer_k2_dim,

    sum(s_bar_a) s_bar1,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) as s_bar1_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) as s_bar1_dim,

    sum(s_bar_b) s_bar2,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) as s_bar2_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) as s_bar2_dim,
	
    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol,
    sum(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) as m_tol_abi,
    sum(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) as m_tol_dim
FROM $Agri_prod_table 
where  cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' 
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr>
               <td align="center"height="39" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center"colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> > جمع کل  </td>
             </tr>
         </table>
</body>
</html>