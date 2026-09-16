<?php 
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['z_sal']))   $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
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
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
</script>

<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_garden.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>

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
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="320" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات باغی یک محصول به تفکیک شهرستان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
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
        <td width="112"  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1395" <?php if ($z_sal=='1395') echo 'selected=selected'?>>1395</option>
            <option value="1396" <?php if ($z_sal=='1396') echo 'selected=selected'?>>1396</option>
            <option value="1397" <?php if ($z_sal=='1397') echo 'selected=selected'?>>1397</option>
          </select>
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال </font></span></td>
      </tr>
      <tr >
        <td align="left" bgcolor="#DDDDDD"><div align="right">
          <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
            <option value="" > انتخاب گروه</option>
            <?php
include ('../../login/config.php');
$query = "SELECT DISTINCT group_cod,group_name FROM product_b "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
            <?php }?>
          </select>
        </div></td>
        <td height="60"  align='center' bgcolor="#DDDDDD" class="style11"><font size="2" class="style8">: انتخاب گروه</font></td>
      </tr>
      <tr >
        <td align="left" bgcolor="#FFFFFF"><div align="right">
          <select  name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="23" dir="rtl">
            <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM product_b WHERE  group_cod = $mah_qroup " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
            <?php
}
?>
          </select>
        </div></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8">: نام محصول</font></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <br />
           <table width="98%" height="266" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td rowspan="2" bgcolor="#999999">پیش بینی تولید <br />
                <span class="style2">تن</span> <br /></td>
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
Agri_prod.id_city ,
sum(Agri_prod.zer_kesht_a) zer_k1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_a,0)) as zer_k1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_a,0)) as zer_k1_dim,

sum(Agri_prod.zer_kesht_b) zer_k2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_b,0)) as zer_k2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_b,0)) as zer_k2_dim,

sum(Agri_prod.mah_tolp) m_tolp, 

sum(Agri_prod.s_bar_a) s_bar1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_a,0)) as s_bar1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_a,0)) as s_bar1_dim,

sum(Agri_prod.s_bar_b) s_bar2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_b,0)) as s_bar2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_b,0)) as s_bar2_dim,

sum(Agri_prod.mah_tol) m_tol, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.mah_tol,0)) as m_tol_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.mah_tol,0)) as m_tol_dim 


FROM Agri_prod 
where Agri_prod.id_ostan = '$id_ostan1' and Agri_prod.z_sal='$z_sal'  and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name'
GROUP BY id_city
 "  ;
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
               <td width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
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
Agri_prod.id_ostan ,
sum(Agri_prod.zer_kesht_a) zer_k1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_a,0)) as zer_k1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_a,0)) as zer_k1_dim,

sum(Agri_prod.zer_kesht_b) zer_k2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.zer_kesht_b,0)) as zer_k2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.zer_kesht_b,0)) as zer_k2_dim,

sum(Agri_prod.mah_tolp) m_tolp, 

sum(Agri_prod.s_bar_a) s_bar1, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_a,0)) as s_bar1_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_a,0)) as s_bar1_dim,

sum(Agri_prod.s_bar_b) s_bar2, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.s_bar_b,0)) as s_bar2_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.s_bar_b,0)) as s_bar2_dim,

sum(Agri_prod.mah_tol) m_tol, 
sum(if(Agri_prod.no_kesh = '1',Agri_prod.mah_tol,0)) as m_tol_abi, 
sum(if(Agri_prod.no_kesh = '2',Agri_prod.mah_tol,0)) as m_tol_dim 

FROM Agri_prod 
where Agri_prod.id_ostan = '$id_ostan1' and Agri_prod.z_sal='$z_sal' and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' 
GROUP BY id_ostan "  ;
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
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
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