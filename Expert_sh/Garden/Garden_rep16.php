<?php 
include("../../lock_expsh.php");
include_once("../../event.php");
if (isset($_POST['z_sal'])) {
    $z_sal = $_POST['z_sal'];
    $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
    $id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
  <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style=" width: 450px; padding: 15px;border: 3px solid navy; margin:auto ; border-radius:15px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC" class="style1">گزارش تولید به تفکیک محصول <span class="style8"><a name="1" id="1"></a></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="319" height="51" align="right" bgcolor="#F1F1F1" class="input_text" >
        <?php $id_ostan1 = $id_ostan ; ?>
        <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
          <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
        </select></td>
        <td width="131"  align='center' bgcolor="#F1F1F1" class="style11" style="color: #F1F1F1"><font size="2" class="style8">:استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl" >
          <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
          <?php 
		   }?>
        </select></td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="48" align="right" bgcolor="#F1F1F1" class="input_text" ><div align="right">
                   <select  name="z_sal" class="input_text"  id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
                   <?php
                   $query = "SELECT  sal FROM b_sal ORDER BY sal desc"  ;
                   $stmt = $dbh->prepare($query);
                   $stmt->execute();
                   foreach($stmt as $row){
                   ?>
                     <option value="<?php echo $row['sal'] ;?>"
                    <?php if (isset($z_sal) && $row['sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['sal'] ;?></option>
                   <?php }?>
                 </select>
        </div></td>
        <td height="48"  align='center' bgcolor="#F1F1F1" class="style11"><span class="style8">: سال </span></td>
      </tr>
      <tr >
        <td height="72" colspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="center">
          <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          <span class="style21"><a name="3" id="13"></a></span></div></td>
      </tr>
    </table>
  </div>
</form>
<?php 
 if (isset($_POST['action']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  
 $id_city = $_POST['id_city'] ;
if ($id_city == '0') $v_id_city = 1  ; else $v_id_city = "Garden_prod.id_city = '$id_city'" ; 
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56">
               <form  action="Garden_rep16_xls.php" method="post">
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56">
               <form  action="Garden_rep16_doc.php" method="post">
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="99%" height="159" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="55" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td rowspan="2" bgcolor="#999999">تعداد درخت پراکنده بارور</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت  بارور<br />
                <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیر بارور<br />
                 <span class="style2">هکتار</span></td>
               <td width="13%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="40" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="40" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT 
Garden_prod.cod_mah ,
SUM(Garden_prod.s_kesht_b) AS zer_k1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(Garden_prod.s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  SUM(Garden_prod.tree_b) AS s_bar1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.tree_b ELSE 0 END) AS tree_b_p,
  SUM(Garden_prod.tree_gb) AS s_bar2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(Garden_prod.mah_tol) AS m_tol,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where Garden_prod.id_ostan = '$id_ostan1' and Garden_prod.z_sal='$z_sal' 
and $v_id_city and Garden_prod.cod_mah  > 0  GROUP BY cod_mah  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="9%" height="41" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="7%" ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="7%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh($row['cod_mah']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
     </table>
           <?php }?>
<p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>
      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>