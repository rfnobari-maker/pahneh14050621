<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if (isset($_POST['id_city5'])) $id_city = $_POST['id_city5'];
if (isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'];
if (isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'];
if (isset($_POST['add_city'])) $add_city = $_POST['add_city'];
if (isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'];
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'];
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
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
url: "ajax_garden_amar.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});

$(document).ready(function()
{
$(".country").change(function()
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
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>
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
    <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="438" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش سطح ، میزان تولید و عملکرد محصولات باغبانی به تفکیک نوع محصول </span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" colspan="3" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1404"<?php  if ($z_sal=='1404') echo 'selected=selected'?>>1404</option>
                     <option value="1403"<?php  if ($z_sal=='1403') echo 'selected=selected'?>>1403</option>
                     <option value="1402"<?php  if ($z_sal=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401"<?php  if ($z_sal=='1401') echo 'selected=selected'?>>1401</option>
                     <option value="1400"<?php  if ($z_sal=='1400') echo 'selected=selected'?>>1400</option>
            </select>
          </div></td>
        <td width="149"  align='center' bgcolor="#DDDDDD" class="style11"><span class="input_text"><font size="2" class="style8">: سال </font></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" colspan="3" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
          <option value="-1">انتخاب استان</option>
          <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan="3" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
          <option value="0"> کل استان</option>
          <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
          <?php }?>
        </select>
          <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
        <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td width="273" height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
          <option value="0" >انتخاب نام آبادی</option>
          <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
          <?php }?>
        </select></td>
        <td width="108" height="42"  align='center' bgcolor="#FFFFFF" class="style8">نام آبادی</td>
        <td width="170" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
          <option value="0"> نام مرکز</option>
          <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
          <?php }?>
        </select>
          <?php
                 				   if (isset($_POST['id_mar']))
  $id_mar = $_POST['id_mar'] ; 

				 ?>
          <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
        <td rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
      </tr>
      <tr >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
          <option value="0" >انتخاب نام شهر</option>
          <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
          <?php }?>
        </select></td>
        <td height="49"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
      </tr>
      <tr >
        <td colspan="3" align="left" bgcolor="#DDDDDD"><div align="right">
          <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:200px ; height:40px" tabindex="22" dir="rtl"  >
            <option value="0" > انتخاب گروه</option>
            <?php
include ('../../login/config.php');
$query = "SELECT DISTINCT group_cod,group_name FROM product_b_amar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
            <?php }?>
            </select>
          </div></td>
        <td height="51"  align='center' bgcolor="#DDDDDD" class="style11"><font size="2" class="style8">: انتخاب گروه</font></td>
      </tr>
      <tr >
        <td colspan="3" align="left" bgcolor="#FFFFFF"><div align="right">
        <select  name="mah_name" class="required input_text mar" style="width:200px ; height:40px" tabindex="23" dir="rtl">
          <option value="0" > انتخاب محصول</option>
          <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM product_b_amar WHERE  group_cod = $mah_qroup " ;
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
        <td height="48"  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8">: نام محصول</font></td>
      </tr>
      <tr >
        <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['action'])) 
 {  
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
?>
<table width="103" height="56" border="0" align="center">
        <tr>
               <td width="97"><form  action="Garden_amar_2_xls.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="mah_qroup" value="<?php echo  $mah_qroup ;?>" />
                 <input type="hidden" name="mah_name" value="<?php echo  $mah_name ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
              </tr>
           </table>
           <br />
           <?php if (($mah_qroup < '8') or ($mah_qroup == '99'))  { ?>
           <br />
           اطلاعات باغ <br />
      <table width="90%"  align="center" class="my-table"  >
              <tr align="center" class="text1">
                <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
                <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
                <td height="55" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                  <span class="style2">هکتار</span></td>
                <td width="17%" rowspan="3" bgcolor="#999999">نام محصول</td>
                <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
              </tr>
              <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
              </tr>
             <tr align="center" class="text1">
               <td height="46" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="46" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
              </tr>
             <tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
if ($mah_name == '0')   { $v_mah    = 1  ; }else{ $v_mah   = "cod_mah   = '$mah_name'" ;}

 $query = "SELECT 
Garden_prod.id_ostan ,cod_mah ,
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
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
GROUP BY cod_mah "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="42" ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_p'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_dim'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_abi'],4)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh_amar($row['cod_mah']);?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT 
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
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
 "  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت بارور<br />
                <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیربارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr align="center" class="text1">
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="38" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_p'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
<?php }?>
            <!-- شروع قارچ -->
           <?php if (($mah_qroup == '0') or ($mah_qroup == '100'))  { ?>

            <p>اطلاعات واحد های پرورش قارچ خوراکی</p>
      <table width="90%"  align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td height="55" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td width="17%" rowspan="3" bgcolor="#999999">نام محصول</td>
               <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
             </tr>
             <tr align="center" class="text1">
               <td height="46" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="46" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
 if ($mah_name == '0')  { $v_mah    = 1  ; }else{ $v_mah   = "no_mush   = '$mah_name'" ;}


 $query = "SELECT no_mush , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city   and $v_mah 
GROUP BY no_mush
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="42" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh_amar($row['no_mush']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '-1') 
{
 $query = "SELECT id_ostan , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_mah 
 "  ;
}
if ($id_ostan1 != '-1') 
{
 $query = "SELECT id_ostan , id_city , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_mah 
GROUP BY id_ostan "  ;
}

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت بارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیربارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="38" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
           </table>
           <p>&nbsp;</p>
           <p><!-- پایان قارچ -->
           <?php } }?>
           </p>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
           <p align="center"><a href="amar.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
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