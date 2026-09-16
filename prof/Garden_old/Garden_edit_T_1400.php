<?php 
include_once('../../lock_p1.php');
include_once('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $dis = $_POST['dis'] ;
// $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول
 $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <script src="../../15_files/jquery.js" type="text/javascript"></script>
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
.column {
  float: left;
  width:10.75%;
  padding: 5px;
}
.row {
	width: 100%
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
   <script>
function target_Gar15(form) {
    window.open('null','formpopup','width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
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
                    <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include_once('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include_once('top.php');?>
      <span class="style8">تکمیل اطلاعات  تولید قطعی </span><br />
      <span class="style8">محصولات مثمر دارای درخت بارور / سطح زیر کشت بارور </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="437" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                        <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1400" <?php if (isset($z_sal) && $z_sal=='1400') echo 'selected=selected'?>>1400</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <?php $id_ostan1 = $id_ostan ?>
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC "  ;
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
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl" tabindex="2">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: نوع کشت</font></td>
                 <td width="214" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="146"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <select  name="mah_name" class="required input_text mar" id="mah_name" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                     <?php
 $query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE  `group_cod` = $mah_qroup " ;
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
                 <td height="54"  align='center' class="style8">نام محصول</td>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <div align="right">
                     <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                       <option value="" > انتخاب گروه</option>
                       <?php
//include ('../../login/config.php');
$query = "SELECT DISTINCT group_cod,group_name FROM `product_b` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                       <?php }?>
                     </select>
                   </div></td>
                 <td  align='center' class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="6" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE   `mor_cod_m` = '$login_session' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                   </select></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_mar" disabled="disabled" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td width="146" rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="40" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" tabindex="7" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `id_mar` = '$id_mar' and `mor_cod_m`= '$login_session'ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="40"  align='center' bgcolor="#DDDDDD" class="style8">نام شهر</td>
                 </tr>
               <tr >
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " tabindex="8" value="<?php echo $bah_cod_m?>" />
                   </div>                </td>
                 <td height="54" align="right" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" class="input_text" ><div align="right">
       <input name="mor_cod_m" type="text" class="style8"  style="height:35px ; width:170px " value=" <?php echo $login_session ?>" readonly="readonly" />

                   </div></td>
                 <td height="54"  align='center' class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
               </tr>
               <tr >
                 <td height="60" align="left" bgcolor="#DDDDDD">&nbsp;</td>
                 <td height="60" align="left" bgcolor="#DDDDDD">&nbsp;</td>
                 <td height="60" align="left" bgcolor="#DDDDDD"><div align="right">
                   <select name="dis" class="input_text  required" id="no_kesh"  style="height:40px ; width:170px ; direction:rtl" tabindex="9">
                 <option value="1" selected="selected" <?php if($dis=="1") echo "selected='selected'"?>>همه رکوردها</option>
                 <option value="2" <?php if($dis=="2") echo "selected='selected'"?>>رکوردهای فاقد تولید قطعی</option>
                   </select>
                 </div></td>
                 <td height="60" align="left" bgcolor="#DDDDDD"><font size="2" class="style8">:   نمایش رکوردها</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = $mor_cod_m " ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m' " ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
 if ($dis == '1')  { $v_dis  = 1  ; }else{ $v_dis = "mah_tol < 0.0000001 and cod_mah != '299007' and mah_kh !='1'" ;}

// include_once('../../login/config.php');
$start=0;
$limit=15;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT  Garden_id,z_sal,bah_cod_m,sh_gat,no_kesh,cod_mah,mah_tolp,mah_tol,add_abadi,s_kesht_b,s_kesht_gb,tree_b,tree_gb from Garden_prod 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and  $v_dis 
AND ( `s_kesht_b` >0  OR  `tree_b` >0 ) AND  `cod_mah` !=  '299007'  ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit "; 
 $query1 = "SELECT id from Garden_prod where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and  $v_dis
 AND (`s_kesht_b` >0  OR  `tree_b` >0 ) AND  `cod_mah` !=  '299007'   ORDER BY bah_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <br />
            <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="8%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">خسارت</td>
          <td colspan="2" bgcolor="#006699">میزان تولید قطعی<br />
            <span class="style2">تن</span></td>
          <td colspan="2" bgcolor="#006699"><p>تعداد درخت<br />
            <span class="style2">اصله</span></p></td>
          <td colspan="2" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
          <td width="8%" rowspan="2" bgcolor="#006699">نام محصول</td>
          <td width="4%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="4%" rowspan="2" bgcolor="#006699"> قطعه<br /></td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" bgcolor="#006699">قطعی</td>
          <td width="7%" bgcolor="#006699">پیش بینی</td>
          <td width="8%" bgcolor="#006699">غیر بارور</td>
          <td width="8%" bgcolor="#006699">بارور</td>
          <td width="7%" bgcolor="#006699">غیر بارور</td>
          <td width="8%" bgcolor="#006699">بارور</td>
          <td width="8%" height="36" bgcolor="#006699" class="text1">کد ملی</td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr>
                    <td colspan="8" class="normalTextSmall" 
                    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_bagh($row['cod_mah']); ?><br /></td>
                    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?><br /></td>
                    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
                    <td height="72" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
                    <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
                    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
          </tr>
        <?php 
	$r++ ; 
 }
	?>
  </table>
  <p class="style2" align="center">
    <?php 
   }  
  else 
  { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }
?>
</p>
  <div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
  <?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if ($rows > 15) $t_row = 15  ; else  $t_row = $rows ; 
if($id>1)
{
	?>
    <form  action="Garden_edit_T.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
        <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Garden_edit_T.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
        <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="Garden_edit_T.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
        <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
        <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

<?php
$no = $t_row ; 
while ($no > 0){
?>
 <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {
var s_bar_a     = $("#s_bar_a<?php echo $no ?>").val();
var s_bar_b     = $("#s_bar_b<?php echo $no ?>").val();
var mah_tol     = $("#mah_tol<?php echo $no ?>").val();
  var e = document.getElementById("mah_kh<?php echo $no ?>");
  var mah_kh = e.options[e.selectedIndex].value;
var id          = $("#id<?php echo $no ?>").val();
var bah_cod_m   = $("#bah_cod_m<?php echo $no ?>").val();
var add_abadi   = $("#add_abadi<?php echo $no ?>").val();
var z_sal       = $("#z_sal").val();
var sh_gat      = $("#sh_gat<?php echo $no ?>").val();
var sb          = s_bar_a + s_bar_b ; 
var dataString = 's_bar_a='+ s_bar_a + '&s_bar_b=' + s_bar_b + '&mah_tol=' + mah_tol + '&id=' + id 
+ '&bah_cod_m=' + bah_cod_m +  '&add_abadi=' + add_abadi + '&z_sal=' + z_sal +  '&sh_gat=' + sh_gat + '&mah_kh=' + mah_kh;
if(s_bar_a=='' || s_bar_b=='' || mah_tol=='' || (parseFloat(sb) > 0   &&  parseFloat(mah_tol) <= 0 )
|| (parseFloat(sb) <= 0   &&  parseFloat(mah_tol) > 0 )
|| mah_kh == '' )
{
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "post98.php",
data: dataString,
success: function(){
$('.success<?php echo $no ?>').fadeIn(200).show();
$('.error<?php echo $no ?>').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
<?php
 $no--;
}
?>