<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Agri_rep11.doc");
include("../../lock_oce.php");
include_once("../../event.php");
if (isset($_POST['z_sal']))   $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
      <?php include_once('../../login/config.php') ; ;?>
      </p>
      <?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan1 = $id_ostan ; 
?>
<table width="98%" height="245" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح آیش<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td height="55" colspan="3" bgcolor="#999999">تعداد قطعات زراعی<br />
                 <span class="style2">قطعه</span></td>
               <td width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="44" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="5%" height="44" bgcolor="#999999">کل</td>
               <td width="6%" bgcolor="#999999">دیم</td>
               <td width="5%" bgcolor="#999999">آبی</td>
               <td height="44" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="44" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
               <td width="6%" height="44" bgcolor="#999999">کل</td>
               <td width="5%" bgcolor="#999999">دیم</td>
               <td width="5%" bgcolor="#999999">آبی</td>
  </tr>
             <tr>
               <?php
$query = "SELECT 
Agri_prod.id_city ,
sum(Agri_prod.zer_kesht_a) zer_k1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_a,0)) as zer_k1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_a,0)) as zer_k1_dim,

sum(Agri_prod.zer_kesht_b) zer_k2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_b,0)) as zer_k2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_b,0)) as zer_k2_dim,

sum(Agri_prod.s_bar_a) s_bar1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_a,0)) as s_bar1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_a,0)) as s_bar1_dim,

sum(Agri_prod.s_bar_b) s_bar2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_b,0)) as s_bar2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_b,0)) as s_bar2_dim,

sum(Agri_prod.mah_tol) m_tol, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.mah_tol,0)) as m_tol_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.mah_tol,0)) as m_tol_dim ,

count( Agri.id) kol ,
count(CASE WHEN Agri.no_kesh='1' THEN 1  END )  t_abi,
count(CASE WHEN Agri.no_kesh='2' THEN 1  END )  t_dim,
sum(Agri.s_ayesh) ayesh, 
sum(if(Agri.no_kesh = '1',Agri.s_ayesh,0)) as ayesh_abi, 
sum(if(Agri.no_kesh = '2',Agri.s_ayesh,0)) as ayesh_dim

FROM Agri
INNER JOIN Agri_prod ON Agri.id=Agri_prod.Agri_id 
where Agri_prod.id_ostan = '$id_ostan1' and Agri_prod.z_sal='$z_sal' 
GROUP BY id_city
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="59" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
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
Agri_prod.id_ostan ,
sum(Agri_prod.zer_kesht_a) zer_k1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_a,0)) as zer_k1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_a,0)) as zer_k1_dim,

sum(Agri_prod.zer_kesht_b) zer_k2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_b,0)) as zer_k2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_b,0)) as zer_k2_dim,

sum(Agri_prod.s_bar_a) s_bar1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_a,0)) as s_bar1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_a,0)) as s_bar1_dim,

sum(Agri_prod.s_bar_b) s_bar2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_b,0)) as s_bar2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_b,0)) as s_bar2_dim,

sum(Agri_prod.mah_tol) m_tol, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.mah_tol,0)) as m_tol_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.mah_tol,0)) as m_tol_dim ,

count( Agri.id) kol ,
count(CASE WHEN Agri.no_kesh='1' THEN 1  END )  t_abi,
count(CASE WHEN Agri.no_kesh='2' THEN 1  END )  t_dim,
sum(Agri.s_ayesh) ayesh, 
sum(if(Agri.no_kesh = '1',Agri.s_ayesh,0)) as ayesh_abi, 
sum(if(Agri.no_kesh = '2',Agri.s_ayesh,0)) as ayesh_dim

FROM Agri
INNER JOIN Agri_prod ON Agri.id=Agri_prod.Agri_id 
where Agri_prod.id_ostan = '$id_ostan1' and Agri_prod.z_sal='$z_sal' 
GROUP BY id_ostan
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
            <tr>
               <td align="center" height="59" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
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
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['kol']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_dim'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_abi'] ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
  </tr>
       </table>
           </div>
<?php }?>
           <p>&nbsp;</p>
</body>
</html>