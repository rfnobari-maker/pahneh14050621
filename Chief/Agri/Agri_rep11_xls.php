<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=اطلاعات_زراعی_به_تفکیک_شهرستان.xls");
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['z_sal'])) 
{
 $z_sal= $_POST['z_sal'] ; 
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal)  ; 
}
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}

    </style>

</head>
<body>
      <?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal)  ; 
?>
<p align="center"> گزارش اطلاعات زراعی استان به تفکیک شهرستان </p>
           <table width="98%" height="142" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" colspan="3" bgcolor="#999999">سطح آیش / <span class="style2">هکتار</span><br /></td>
               <td align="center" height="33" colspan="3" bgcolor="#999999">تعداد قطعات زراعی</td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" width="5%" height="25" bgcolor="#999999">کل</td>
               <td align="center" width="6%" bgcolor="#999999">دیم</td>
               <td align="center" width="5%" bgcolor="#999999">آبی</td>
               <td align="center" width="6%" height="25" bgcolor="#999999">کل</td>
               <td align="center" width="5%" bgcolor="#999999">دیم</td>
               <td align="center" width="5%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
  include_once('../../login/config.php') ;
  $query = "SELECT 
$Agri_table.id_city ,
count(*) kol ,
count(CASE WHEN $Agri_table.no_kesh='1' THEN 1  END )  t_abi,
count(CASE WHEN $Agri_table.no_kesh='2' THEN 1  END )  t_dim,
sum($Agri_table.s_ayesh) ayesh, 
SUM(CASE WHEN no_kesh = '1' THEN s_ayesh ELSE 0 END) AS ayesh_abi,
SUM(CASE WHEN no_kesh = '2' THEN s_ayesh ELSE 0 END) AS ayesh_dim
FROM $Agri_table
where $Agri_table.id_ostan = '$id_ostan1' 
GROUP BY id_city
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center"  height="33" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['kol']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_dim'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_abi'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
<?php 
 $query = "SELECT 
count(*) kol ,
count(CASE WHEN $Agri_table.no_kesh='1' THEN 1  END )  t_abi,
count(CASE WHEN $Agri_table.no_kesh='2' THEN 1  END )  t_dim,
sum($Agri_table.s_ayesh) ayesh, 
SUM(CASE WHEN no_kesh = '1' THEN s_ayesh ELSE 0 END) AS ayesh_abi,
SUM(CASE WHEN no_kesh = '2' THEN s_ayesh ELSE 0 END) AS ayesh_dim
FROM $Agri_table
where $Agri_table.id_ostan = '$id_ostan1' GROUP BY id_ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
            <tr>
               <td align="center" height="49" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['kol']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_dim'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_abi'] ; ?></td>
               <td align="center" colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
             </tr>
 </table>
           </div>
<p>&nbsp;</p>
<table width="98%" height="164" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" height="29" colspan="3" bgcolor="#999999">میزان تولید / تن<br /></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح برداشت / هکتار<br /></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح زیر کشت / هکتار<br /></td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="32" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="32" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="32" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" width="6%" bgcolor="#999999">آبی</td>
  </tr>
             <tr>
               <?php
 $query = "SELECT 
    id_city,
    SUM(zer_kesht_a) AS zer_k1,
    SUM(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) AS zer_k1_abi,
    SUM(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) AS zer_k1_dim,

    SUM(zer_kesht_b) AS zer_k2,
    SUM(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) AS zer_k2_abi,
    SUM(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) AS zer_k2_dim,

    SUM(s_bar_a) AS s_bar1,
    SUM(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) AS s_bar1_abi,
    SUM(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) AS s_bar1_dim,

    SUM(s_bar_b) AS s_bar2,
    SUM(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) AS s_bar2_abi,
    SUM(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) AS s_bar2_dim,

    SUM(mah_tol) AS m_tol,
    SUM(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) AS m_tol_abi,
    SUM(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) AS m_tol_dim

FROM 
    $Agri_prod_table 
WHERE 
    id_ostan = '$id_ostan1' 
GROUP BY 
    id_city; "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="46" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT 
    id_ostan,
    SUM(zer_kesht_a) AS zer_k1,
    SUM(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) AS zer_k1_abi,
    SUM(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) AS zer_k1_dim,

    SUM(zer_kesht_b) AS zer_k2,
    SUM(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) AS zer_k2_abi,
    SUM(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) AS zer_k2_dim,

    SUM(s_bar_a) AS s_bar1,
    SUM(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) AS s_bar1_abi,
    SUM(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) AS s_bar1_dim,

    SUM(s_bar_b) AS s_bar2,
    SUM(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) AS s_bar2_abi,
    SUM(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) AS s_bar2_dim,

    SUM(mah_tol) AS m_tol,
    SUM(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) AS m_tol_abi,
    SUM(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) AS m_tol_dim

FROM 
    $Agri_prod_table 
WHERE 
    id_ostan = '$id_ostan1' 
GROUP BY 
    id_ostan; "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr>
               <td align="center" height="51" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center" colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
             </tr>
</table>
           <?php }?>
</body>
</html>