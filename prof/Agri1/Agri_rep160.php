<?php 
include('../../lock_p1.php');
include('../../event.php');
$id_ostan1   = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city     = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar      = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh     = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m   = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal       = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

// کد گروه و کد محصول
$mah_qroup   = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
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
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>



</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <span class="style8">گزارش گروه محصولات زراعی </span>
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="382" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM `z_sal`  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <?php $id_ostan1 = $id_ostan ?>
                 <select  name="id_ostan" disabled="disabled" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT  id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC "  ;
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
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: نوع کشت</font></td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" disabled="disabled" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT id_city,city FROM `cityname` WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8">&nbsp;</td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM `product_z` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                   </select></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `id_mar` = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="42"  align='center' bgcolor="#FFFFFF" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_mar" disabled="disabled" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                     <option value="0"> نام مرکز</option>
                     <?php
$query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_ostan` = $id_ostan1 and `id_city` = $id_city"  ;
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
                 <td width="146" rowspan="2"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `id_mar` = '$id_mar' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="47"  align='center' bgcolor="#FFFFFF" class="style8">:نام شهر</td>
                 </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
       <input name="mor_cod_m" type="text" class="style8"  style="height:35px ; width:170px " value="<?php echo $login_session ?>" readonly="readonly" />

                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
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
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep160_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_qroup" value="<?php echo $cod_qroup ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                            <td width="56"><form  action="Agri_rep160_doc.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_qroup" value="<?php echo $cod_qroup ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <table width="95%" height="128" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="46" colspan="2" bgcolor="#999999">میزان تولید محصول<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت <br />
                <span class="style2">هکتار</span></td>
               <td width="19%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">قطعی</td>
               <td bgcolor="#999999">پیش بینی</td>
               <td width="11%" height="38" bgcolor="#999999">کل</td>
               <td width="10%" bgcolor="#999999">کشت دوم</td>
               <td width="9%" bgcolor="#999999">کشت اول</td>
               <td height="38" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">کشت دوم</td>
               <td width="8%" bgcolor="#999999">کشت اول</td>
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
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="40" ><?php echo $mahtol ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="11%" ><?php echo $mahtolp ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barkol ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barb ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_bara ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtkol ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtb ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshta ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo group_name($row['cod_qroup']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
           </table>
             <?php
}
}
?>
         </table>
           
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>