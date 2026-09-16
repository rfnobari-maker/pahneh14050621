<?php 
include("../../lock_expar.php");
include_once("../../event.php");
$z_sal      = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
$id_ostan1  = isset($_POST['id_ostan'])   ? $_POST['id_ostan']   : '';
$mah_qroup  = isset($_POST['mah_qroup'])  ? $_POST['mah_qroup']  : '';
$mah_name   = isset($_POST['mah_name'])   ? $_POST['mah_name']   : '';
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
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan"  ;
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
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="Garden_rep11p_xls.php" method="post">
                 <input type="hidden" name="mah_qroup" value="<?php echo  $mah_qroup ;?>" />
                 <input type="hidden" name="mah_name" value="<?php echo  $mah_name ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Garden_rep11p_doc.php" method="post">
                 <input type="hidden" name="mah_qroup" value="<?php echo  $mah_qroup ;?>" />
                 <input type="hidden" name="mah_name" value="<?php echo  $mah_name ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="99%" height="370" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="55" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td rowspan="2" bgcolor="#999999">پیش بینی تولید <br />
                 <span class="style2">تن</span></td>
               <td colspan="4" bgcolor="#999999">تعداد درخت<br />
                 <span class="style2">اصله</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td width="5%" rowspan="2" bgcolor="#999999">&nbsp;</td>
               <td width="17%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT 
id_city,
  SUM(s_kesht_b) AS zer_k1,
  SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN no_kesh = '1' THEN s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN no_kesh = '2' THEN s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  sum(mah_tolp) m_tolp, 
  SUM(tree_b) AS s_bar1,
  SUM(CASE WHEN no_kesh = '1' THEN tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN no_kesh = '2' THEN tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN nah_kesh = '3' THEN tree_b ELSE 0 END) AS tree_b_p,
  SUM(tree_gb) AS s_bar2,
  SUM(CASE WHEN no_kesh = '1' THEN tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN no_kesh = '2' THEN tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(mah_tol) AS m_tol,
  SUM(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN nah_kesh = '3' THEN mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where id_ostan = '$id_ostan1' and z_sal='$z_sal' and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' GROUP BY id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="70" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1'] ; ?><br />
                 <?php echo $row['s_bar2'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?><br />
                 <?php echo $row['tree_gb_p'] ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_dim'] ; ?><br />
                 <?php echo $row['s_bar2_dim'] ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_abi'] ; ?><br />
                 <?php echo $row['s_bar2_abi'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >بارور<br />
                 غیربارور</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br />
                <?php echo $row['id_city'] ;?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT 
  SUM(s_kesht_b) AS zer_k1,
  SUM(CASE WHEN no_kesh = '1' THEN s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN no_kesh = '2' THEN s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN no_kesh = '1' THEN s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN no_kesh = '2' THEN s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  sum(mah_tolp) m_tolp, 
  SUM(tree_b) AS s_bar1,
  SUM(CASE WHEN no_kesh = '1' THEN tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN no_kesh = '2' THEN tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN nah_kesh = '3' THEN tree_b ELSE 0 END) AS tree_b_p,
  SUM(tree_gb) AS s_bar2,
  SUM(CASE WHEN no_kesh = '1' THEN tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN no_kesh = '2' THEN tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(mah_tol) AS m_tol,
  SUM(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN nah_kesh = '3' THEN mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where id_ostan = '$id_ostan1' and z_sal='$z_sal' and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' GROUP BY id_ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td rowspan="2" bgcolor="#999999">پیش بینی تولید <br />
                 <span class="style2">تن</span></td>
               <td colspan="4" bgcolor="#999999">تعداد درخت<br />
                 <span class="style2">اصله</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td height="37" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="78" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1'];?><br/>
                 <?php echo $row['s_bar2'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?><br />
                 <?php echo $row['tree_gb_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_dim'] ; ?><br />
                 <?php echo $row['s_bar2_dim'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_abi'] ; ?><br />
                 <?php echo $row['s_bar2_abi'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >بارور<br />
                 غیربارور</td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> > کل استان</td>
             </tr>
     </table>
           <?php }?>
<p> <p><a href="Garden.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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