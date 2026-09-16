<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
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
<title><?php echo $title ;?></title>
<style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}
button
{
	border-color:#FFF ;
}
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 2px solid navy; border-radius:15px ;  margin: auto; text-align: left;" >
    <table width="100%" height="200" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات زراعی استان به تفکیک شهرستان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
        <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
          <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
        </select>
          <?php 
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
          </select>
        </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr >
        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal)  ; 
?>
           <p>&nbsp;</p>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="Agri_rep11_xls.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
      </table>
           <br />
           <table width="85%" class="my-table"  align="center"  >
             <tr align="center" class="text1">
               <td colspan="3" bgcolor="#999999">سطح آیش<br />
                 <span class="style2">هکتار</span></td>
               <td height="55" colspan="3" bgcolor="#999999">تعداد قطعات زراعی<br />
                 <span class="style2">قطعه</span></td>
               <td width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td width="5%" height="57" bgcolor="#999999">کل</td>
               <td width="6%" bgcolor="#999999">دیم</td>
               <td width="5%" bgcolor="#999999">آبی</td>
               <td width="6%" height="57" bgcolor="#999999">کل</td>
               <td width="5%" bgcolor="#999999">دیم</td>
               <td width="5%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
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
               <td height="59" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['kol']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_dim'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_abi'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
<?php 
 $query = "SELECT 
    id_ostan,
    COUNT(*) AS kol,
    COUNT(CASE WHEN no_kesh = '1' THEN 1 END) AS t_abi,
    COUNT(CASE WHEN no_kesh = '2' THEN 1 END) AS t_dim,
    SUM(s_ayesh) AS ayesh,
    SUM(CASE WHEN no_kesh = '1' THEN s_ayesh ELSE 0 END) AS ayesh_abi,
    SUM(CASE WHEN no_kesh = '2' THEN s_ayesh ELSE 0 END) AS ayesh_dim
FROM 
    $Agri_table
WHERE 
    id_ostan = '$id_ostan1';"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
            <tr>
               <td height="59" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['ayesh_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['kol']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_dim'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['t_abi'] ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
             </tr>
 </table>
           </div>
      <p>&nbsp;</p>
           <table width="85%" class="my-table"  align="center" >
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
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
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="59" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br />
                <?php echo $row['id_city'] ;?> <br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
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
               <td height="59" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
             </tr>
           </table>
           <?php }?>

    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>