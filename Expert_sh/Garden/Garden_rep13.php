<?php 
include("../../lock_expsh.php");
include("../../Jalali.php");
include("../../event.php");
if (isset($_POST['z_sal']))  
$id_ostan1  = isset($_POST['id_ostan'])    ? $_POST['id_ostan']    : '';
$id_city    = isset($_POST['id_city5'])    ? $_POST['id_city5']    : '';
$id_mar     = isset($_POST['id_mar'])      ? $_POST['id_mar']      : '';
$add_abadi  = isset($_POST['add_abadi'])   ? $_POST['add_abadi']   : '';
$add_city   = isset($_POST['add_city'])    ? $_POST['add_city']    : '';
$no_kesh    = isset($_POST['no_kesh'])     ? $_POST['no_kesh']     : '';
$mor_cod_m  = isset($_POST['mor_cod_m'])   ? $_POST['mor_cod_m']   : '';
$bah_cod_m  = isset($_POST['bah_cod_m'])   ? $_POST['bah_cod_m']   : '';
$z_sal      = isset($_POST['z_sal'])       ? $_POST['z_sal']       : '';
$mah_qroup  = isset($_POST['mah_qroup'])   ? $_POST['mah_qroup']   : '';
$mah_name   = isset($_POST['mah_name'])    ? $_POST['mah_name']    : '';
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
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
function close_window() {
      close();
 }
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
$(".mar").html(html);
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
      <p>&nbsp;</p>
            <form  id="reg-form" method="post" action="#1">
      <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
  <table width="100%" height="387" border='0' align="center" cellpadding='0' cellspacing='0'>
    <tr bgcolor='#f1f1f1' >
      <td height="44" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات باغی استان به تفکیک محصول</span><span class="style8"><a name="1" id="1"></a></span></span></td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td width="190" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
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
      <td width="143"  align='center' bgcolor="#DDDDDD" class="style8">: سال </td>
      <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
       <?php $id_ostan1 = $id_ostan ?>
      <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
        <option value="-1">انتخاب استان</option>
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
      </select>
        <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
      <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
        <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
          <option value="0">انتخاب کنید</option>
          <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
          <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
        </select>
      </div></td>
      <td height="47" align="right" bgcolor="#FFFFFF" class="style11" ><font size="2" class="style8">: نوع کشت</font></td>
      <td width="221" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
        <option value="0"> کل استان</option>
        <?php
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
      <td width="146"  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8"> :شهرستان</font></td>
    </tr>
    <tr >
      <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
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
      <td bgcolor="#DDDDDD"><span style="margin:10px"><font size="2" class="style8">: نام محصول</font></td>
      <td bgcolor="#DDDDDD"><div align="right">
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
        </select></div></td>
      <td  align='center' bgcolor="#DDDDDD" class="style11"><font size="2" class="style8">:گروه محصولات</font></td>
    </tr>
    <tr >
      <td height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
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
      <td height="42"  align='center' bgcolor="#FFFFFF" class="style8">:نام آبادی</td>
      <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
      <td width="146" rowspan="2"  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
    </tr>
    <tr >
      <td height="40" align="right" bgcolor="#FFFFFF" class="input_text" >
      <select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
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
      <td height="40"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
      </tr>
    <tr >
      <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
        <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
      </div></td>
      <td height="54" align="right" bgcolor="#DDDDDD" class="style11" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
      <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
        <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
      </div></td>
      <td height="54"  align='center' bgcolor="#DDDDDD" class="style11"><font size="2" class="style8">: کد ملی مروج</font></td>
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
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
?>
<br />
<img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="Garden_rep13_xls.php" method="post">
                 <input type="hidden" name="id_ostan1" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="mah_name" value="<?php echo  $mah_name ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                 <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                 <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Garden_rep13_doc.php" method="post">
                 <input type="hidden" name="id_ostan1" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="mah_name" value="<?php echo  $mah_name ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                 <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                 <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
         </table>
           <table width="98%" height="111" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="39" colspan="2" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درخت<br />
                <span class="style2">اصله</span></td>
               <td colspan="2" bgcolor="#999999">سطح زیر کشت <br />
                <span class="style2">هکتار</span></td>
               <td width="23%" rowspan="2" bgcolor="#999999">نام محصول<br />
                 <span class="style2">کد محصول</span></td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td width="15%" height="31" bgcolor="#999999">قطعی</td>
               <td width="13%" bgcolor="#999999">پیش بینی</td>
               <td bgcolor="#999999">غیربارور</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیربارور</td>
               <td width="10%" bgcolor="#999999">بارور</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT  cod_mah ,
sum(s_kesht_b)  s_keshtb,
sum(s_kesht_gb) s_keshtgb,
sum(tree_b) treeb,
sum(tree_gb) treegb ,
sum(mah_tolp)   mahtolp,
sum(mah_tol)  mahtol
FROM Garden_prod
where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah Group by cod_mah "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(); 
$r = 1 ;
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
 $treeb = $row['treeb'] ;
 $treegb = $row['treegb'] ;
 $s_keshtb = round($row['s_keshtb'],3) ;
 $s_keshtgb = round($row['s_keshtgb'],3) ;
 $mahtolp = $row['mahtolp'] ;
 $mahtol = $row['mahtol'] ;

?>
               <td height="39"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtolp ;?></td>
               <td width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $treegb ;?></td>
               <td width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $treeb ;?></td>
               <td width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_keshtgb ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_keshtb ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh($row['cod_mah']);?><br />
                 <?php echo $row['cod_mah'];?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
}
?>
         </table>
           </div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



