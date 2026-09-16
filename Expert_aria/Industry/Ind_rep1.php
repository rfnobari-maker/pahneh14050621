<?php 
include('../../lock_expar.php');
include('../../event.php');
  $id_ostan1    = $_POST['id_ostan'] ;
  $id_city      = $_POST['id_city5'] ;
  $id_mar       = $_POST['id_mar'] ; 
  $add_abadi    = $_POST['add_abadi'] ;
  $add_city     = $_POST['add_city'] ;
  $mor_cod_m    = $_POST['mor_cod_m'] ;
  $NationalCode = $_POST['NationalCode'] ;
  $identCode    = $_POST['identCode'] ;
  $y_prod    = $_POST['y_prod'] ;
  $d_prod    = $_POST['d_prod'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $isic_cod1 = $_POST['isic_cod1'] ;
 $isic_cod2 = $_POST['isic_cod2'] ;
 $isic_cod3 = $_POST['isic_cod3'] ;
 $isic_cod4 = $_POST['isic_cod4'] ;
 $isic_cod5 = $_POST['isic_cod5'] ;
 $isic_cod6 = $_POST['isic_cod6'] ;
 $isic_cod7 = $_POST['isic_cod7'] ;
 $isic_cod8 = $_POST['isic_cod8'] ;
 $isic_cod9 = $_POST['isic_cod9'] ;
 $isic_cod10 = $_POST['isic_cod10'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
  <script>
function view_ind_benef(form) {
    window.open('null', 'formpopup', 'width=800,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function winpap1(form) {
    window.open('null', 'formpopup', 'width=900,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>


</head>
<body>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <span class="style8">گزارش ویژه محصولات تولیدی صنایع غذایی و تبدیلی</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 80%; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="760" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select  name="d_prod"  class="input_text" id="y_prod2" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="06" <?php if ($d_prod=='06') echo 'selected=selected'?>>6 ماهه</option>
                     <option value="12" <?php if ($d_prod=='12') echo 'selected=selected'?>>12 ماهه</option>
                     </select>
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:دوره </div></td>
                 <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="y_prod"  class="input_text" id="y_prod" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
                     <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
                     <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
                    </select></td>
                 <td width="135"  bgcolor="#FFFFFF" class="style8"><div align="center"> : سال</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_city5" class="style8" id="id_city2" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
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
                 <td  bgcolor="#DDDDDD" class="style8"><div align="center"> : شهرستان</div></td>
                 <td height="51" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <?php $id_ostan1 = $id_ostan?>
                   <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="-1">انتخاب استان</option>
                     <?php
$query = "SELECT id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
                 <td  bgcolor="#DDDDDD" class="style8"><div align="center"> : استان</div></td>
               </tr>
               <tr >
                 <td height="40" align="right" class="input_text" ><select  name="add_city2"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value='' >انتخاب نام شهر</option>
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
                 <td height="40"  align='center' class="style8"><div align="center">:شهر </div></td>
                 <td height="89" rowspan="2" align="right" class="input_text" ><select  name="id_mar2" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td rowspan="2"  class="style8"><div align="center"> : مرکز جهاد کشاورزی</div></td>
               </tr>
               <tr >
                 <td height="40" align="right" class="input_text" ><select  name="add_abadi2"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="" >انتخاب نام آبادی</option>
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
                 <td height="40"  align='center' class="style8"><div align="center">:آبادی </div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="identCode" type="text" class="input_text" id="identCode"  style="height:35px ; width:170px " value="<?php echo $identCode?>" maxlength="11" />
                   </div></td>
                 <td  bgcolor="#DDDDDD" class="style8"><div align="center"> : شماره مجوز</div></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="NationalCode" type="text" class="input_text" id="NationalCode"  style="height:35px ; width:170px " value="<?php echo $NationalCode?>" maxlength="11" />
                   </div></td>
                 <td height="50" align="right" bgcolor="#DDDDDD"  class="style8"><div align="center">:کد/شناسه ملی </div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod2" type="text" class="style8" id="isic_cod2"  style="height:35px ; width:170px " value="<?php echo $isic_cod2 ?>"  />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:کد آیسیک 2</div></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod1" type="text" class="style8" id="isic_cod1"  style="height:35px ; width:170px " value="<?php echo $isic_cod1 ?>"  />
                   </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div  align="center">:کد آیسیک 1</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="isic_cod4" type="text" class="style8" id="isic_cod4"  style="height:35px ; width:170px " value="<?php echo $isic_cod4 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><div align="center">:کد آیسیک 4</div></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="isic_cod3" type="text" class="style8" id="isic_cod3"  style="height:35px ; width:170px " value="<?php echo $isic_cod3 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><div align="center">:کد آیسیک 3</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod6" type="text" class="style8" id="isic_cod6"  style="height:35px ; width:170px " value="<?php echo $isic_cod6 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:کد آیسیک 6</div></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod5" type="text" class="style8" id="isic_cod5"  style="height:35px ; width:170px " value="<?php echo $isic_cod5 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:کد آیسیک 5</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="isic_cod8" type="text" class="style8" id="isic_cod8"  style="height:35px ; width:170px " value="<?php echo $isic_cod8 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><div align="center">:کد آیسیک 8</div></td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="isic_cod7" type="text" class="style8" id="isic_cod7"  style="height:35px ; width:170px " value="<?php echo $isic_cod7 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><div align="center">:کد آیسیک 7</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod10" type="text" class="style8" id="isic_cod10"  style="height:35px ; width:170px " value="<?php echo $isic_cod10 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:کد آیسیک 10</div></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="isic_cod9" type="text" class="style8" id="isic_cod9"  style="height:35px ; width:170px " value="<?php echo $isic_cod9 ?>"  />
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8"><div align="center">:کد آیسیک 9</div></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن </span>
                   <input name="mtol1" type="text" class="input_text" id="mtol1"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8"><div align="center">: میزان تولید محصول بزرگتر یا مساوی</div></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <span class="style1"><a name="1" id="1"></a></span>
             <?php
   if(isset($_POST['action']))
{

 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "ind_unit.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "ind_unit.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "ind_unit.id_mar='$id_mar'" ;}
 if ($add_abadi == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "ind_unit.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "ind_unit.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "ind_unit.mor_cod_m = '$mor_cod_m'" ;}
 if ($NationalCode == '')  { $v_NationalCode  = 1  ; }else{ $v_NationalCode = "ind_unit.NationalCode = '$NationalCode'" ;}
 if ($identCode == '')  { $v_identCode  = 1  ; }else{ $v_identCode = "ind_unit.identCode = '$identCode'" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "ind_unit_prod.m_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "ind_unit_prod.m_tol <= $mtol2" ;}
 if ($isic_cod1 == '')  { $v_isic_cod1  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod1 = "ind_unit_prod.isic_cod = $isic_cod1" ;}
 if ($isic_cod2 == '')  { $v_isic_cod2  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod2 = "ind_unit_prod.isic_cod = $isic_cod2" ;}
 if ($isic_cod3 == '')  { $v_isic_cod3  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod3 = "ind_unit_prod.isic_cod = $isic_cod3" ;}
 if ($isic_cod4 == '')  { $v_isic_cod4  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod4 = "ind_unit_prod.isic_cod = $isic_cod4" ;}
 if ($isic_cod5 == '')  { $v_isic_cod5  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod5 = "ind_unit_prod.isic_cod = $isic_cod5" ;}
 if ($isic_cod6 == '')  { $v_isic_cod6  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod6 = "ind_unit_prod.isic_cod = $isic_cod6" ;}
 if ($isic_cod7 == '')  { $v_isic_cod7  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod7 = "ind_unit_prod.isic_cod = $isic_cod7" ;}
 if ($isic_cod8 == '')  { $v_isic_cod8  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod8 = "ind_unit_prod.isic_cod = $isic_cod8" ;}
 if ($isic_cod9 == '')  { $v_isic_cod9  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod9 = "ind_unit_prod.isic_cod = $isic_cod9" ;}
 if ($isic_cod10 == '')  { $v_isic_cod10  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod10= "ind_unit_prod.isic_cod = $isic_cod10" ;}
 if ($isic_cod1 == '' and $isic_cod2 == '' and $isic_cod3 == '' and $isic_cod4 == '' and 
 $isic_cod5 == '' and $isic_cod6 == '' and $isic_cod7 == '' and $isic_cod8 == '' and 
 $isic_cod9 == '' and $isic_cod10 == '' ) $v_isic_cod1 = 1 ; 
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $v_query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar,ind_unit_prod.isic_cod,ind_unit_prod.m_tol,
ind_list_product.zarfiyat,ind_list_product.m_jazb,ind_list_product.product_name,ind_unit.mor_cod_m
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
INNER join ind_unit_prod ON ind_unit_prod.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_prod.y_prod='$y_prod' and ind_unit_prod.d_prod='$d_prod' 

INNER join ind_list_product ON ind_unit_prod.ShenaseKasboKar=ind_list_product.ShenaseKasboKar
 and ind_unit_prod.isic_cod = ind_list_product.isic_code
 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode and $v_mor_cod_m and $v_NationalCode and ind_unit_prod.y_prod='$y_prod' and 
ind_unit_prod.d_prod='$d_prod' and $v_mtol1 and $v_mtol2 and
 ($v_isic_cod1 or $v_isic_cod2 or $v_isic_cod3 or $v_isic_cod4 or $v_isic_cod5 or $v_isic_cod6 or
 $v_isic_cod7 or $v_isic_cod8 or $v_isic_cod9 or $v_isic_cod10  )
 ORDER BY NationalCode ASC" ; 


 $query = "$v_query LIMIT $start, $limit "; 
 $query1 = "$v_query"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div align="center"><form  action="Ind_rep1_xls.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city5" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="NationalCode" value="<?php echo  $NationalCode ;?>" />
                 <input type="hidden" name="identCode" value="<?php echo  $identCode ;?>" />
                 <input type="hidden" name="y_prod" value="<?php echo  $y_prod ;?>" />
                 <input type="hidden" name="d_prod" value="<?php echo  $d_prod ;?>" />
                 <input type="hidden" name="v_vaz" value="<?php echo  $v_vaz ;?>" />
                 <input type="hidden" name="isic_cod1" value="<?php echo  $isic_cod1 ;?>" />
                 <input type="hidden" name="isic_cod2" value="<?php echo  $isic_cod2 ;?>" />
                 <input type="hidden" name="isic_cod3" value="<?php echo  $isic_cod3 ;?>" />
                 <input type="hidden" name="isic_cod4" value="<?php echo  $isic_cod4 ;?>" />
                 <input type="hidden" name="isic_cod5" value="<?php echo  $isic_cod5 ;?>" />
                 <input type="hidden" name="isic_cod6" value="<?php echo  $isic_cod6 ;?>" />
                 <input type="hidden" name="isic_cod7" value="<?php echo  $isic_cod7 ;?>" />
                 <input type="hidden" name="isic_cod8" value="<?php echo  $isic_cod8 ;?>" />
                 <input type="hidden" name="isic_cod9" value="<?php echo  $isic_cod9 ;?>" />
                 <input type="hidden" name="isic_cod10" value="<?php echo  $isic_cod10 ;?>" />
                 <input type="hidden" name="mtol1" value="<?php echo  $mtol1 ;?>" />
                 <input type="hidden" name="mtol2" value="<?php echo  $mtol2 ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
               </form></div></br>
           <table width="98%" height="132" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
      <td height="57" colspan="4" bgcolor="#999999"><p>عملیات</p></td>
      <td bgcolor="#999999">میزان تولید</td>
      <td bgcolor="#999999">ظرفیت جذب</td>
      <td bgcolor="#999999">ظرفیت سالن</td>
      <td bgcolor="#999999">کد آیسیک</td>
      <td bgcolor="#999999">شماره مجوز</td>
      <td width="12%" bgcolor="#999999"> شناسه /کد ملی<br /></td>
      <td width="11%" bgcolor="#999999">نام خانوادگی</td>
      <td width="9%" bgcolor="#999999"> نام </td>
      <td width="6%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
$mor_cod_m1=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m1) ;
//$add_abadi1 = $row['add_abadi'];
//$add_city1 = $row['add_city'];
//echo $row2['User_Name'] ; 
?>
    <td width="5%"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
         <form  action="../send_pm1.php#1" method="post" onsubmit="winpap1(this)">
         <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
         <button><img src="../../files/receive_mail.png" width="20" height="20" title="ارسال پیام " /></button>
        </form></td>
        <td width="5%"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <?php if($v_vaz != '2') {?>
          <form  action="ind_list_performance.php" method="post" onsubmit="winpap1(this)">
            <input type="hidden" name="ShenaseKasboKar" value="<?php echo $row['ShenaseKasboKar'] ;?>" />
            <button><img src="../../files/komo.png" title="نمایش عملکرد واحد صنعتی"  width="20" height="20"  alt=""/></button>
            </form>
          <?php }?>
        </td>
        <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="ind_unitdata_view.php#1" method="post" onsubmit="winpap1(this)">
          <input type="hidden" name="ShenaseKasboKar" value="<?php echo $row['ShenaseKasboKar'] ;?>" />
          <button><img src="../../files/view.png" title="نمایش اطلاعات واحد صنعتی"  width="20" height="20"  alt=""/></button>
        </form></td>
        <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form   action="view_ind_benef1.php#1" method="post" onsubmit="view_ind_benef(this)">
          <input type="hidden" name="ShenaseKasboKar" value="<?php echo $row['ShenaseKasboKar'] ;?>" />
          <button><img src="../../files/edit_user.gif" title="نمایش اطلاعات بهره بردار صنعتی"  width="20" height="20"  alt=""/></button>
        </form></td>
      <td  width="9%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tol']*1;?></td>
      <td  width="6%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_jazb']*1;?></td>
      <td  width="9%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zarfiyat']*1;?></td>
      <td  width="8%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><a href="#" title="<?php echo $row['product_name'];?>"><?php echo $row['isic_cod'];?></a></td>
      <td  width="11%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['identCode'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['NationalCode'];?></p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'], $row['c_l_name'];?><br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'], $row['c_f_name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?><br />
        <?php echo $row['co_name'];?></td>
      <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="Ind_rep1.php?id=<?php echo $id-1 ?>#1" method="post">
                 <input type="hidden" name="action"    value="1" />
                 <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city5"   value="<?php echo $id_city ;?>" />
                 <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="NationalCode" value="<?php echo  $NationalCode ;?>" />
                 <input type="hidden" name="identCode" value="<?php echo  $identCode ;?>" />
                 <input type="hidden" name="y_prod" value="<?php echo  $y_prod ;?>" />
                 <input type="hidden" name="d_prod" value="<?php echo  $d_prod ;?>" />
                 <input type="hidden" name="isic_cod1" value="<?php echo  $isic_cod1 ;?>" />
                 <input type="hidden" name="isic_cod2" value="<?php echo  $isic_cod2 ;?>" />
                 <input type="hidden" name="isic_cod3" value="<?php echo  $isic_cod3 ;?>" />
                 <input type="hidden" name="isic_cod4" value="<?php echo  $isic_cod4 ;?>" />
                 <input type="hidden" name="isic_cod5" value="<?php echo  $isic_cod5 ;?>" />
                 <input type="hidden" name="isic_cod6" value="<?php echo  $isic_cod6 ;?>" />
                 <input type="hidden" name="isic_cod7" value="<?php echo  $isic_cod7 ;?>" />
                 <input type="hidden" name="isic_cod8" value="<?php echo  $isic_cod8 ;?>" />
                 <input type="hidden" name="isic_cod9" value="<?php echo  $isic_cod9 ;?>" />
                 <input type="hidden" name="isic_cod10" value="<?php echo  $isic_cod10 ;?>" />
                 <input type="hidden" name="mtol1" value="<?php echo  $mtol1 ;?>" />
                 <input type="hidden" name="mtol2" value="<?php echo  $mtol2 ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Ind_rep1.php?id=<?php echo $id+1 ?>#1" method="post">
                 <input type="hidden" name="action" value="1" />
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city5" value="<?php echo $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="NationalCode" value="<?php echo  $NationalCode ;?>" />
                 <input type="hidden" name="identCode" value="<?php echo  $identCode ;?>" />
                 <input type="hidden" name="y_prod" value="<?php echo  $y_prod ;?>" />
                 <input type="hidden" name="isic_cod1" value="<?php echo  $isic_cod1 ;?>" />
                 <input type="hidden" name="isic_cod2" value="<?php echo  $isic_cod2 ;?>" />
                 <input type="hidden" name="isic_cod3" value="<?php echo  $isic_cod3 ;?>" />
                 <input type="hidden" name="isic_cod4" value="<?php echo  $isic_cod4 ;?>" />
                 <input type="hidden" name="isic_cod5" value="<?php echo  $isic_cod5 ;?>" />
                 <input type="hidden" name="isic_cod6" value="<?php echo  $isic_cod6 ;?>" />
                 <input type="hidden" name="isic_cod7" value="<?php echo  $isic_cod7 ;?>" />
                 <input type="hidden" name="isic_cod8" value="<?php echo  $isic_cod8 ;?>" />
                 <input type="hidden" name="isic_cod9" value="<?php echo  $isic_cod9 ;?>" />
                 <input type="hidden" name="isic_cod10" value="<?php echo  $isic_cod10 ;?>" />
                 <input type="hidden" name="d_prod" value="<?php echo  $d_prod ;?>" />
                 <input type="hidden" name="mtol1" value="<?php echo  $mtol1 ;?>" />
                 <input type="hidden" name="mtol2" value="<?php echo  $mtol2 ;?>" />
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
      <li class='current'><form  action="Ind_rep1.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city5" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                 <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                 <input type="hidden" name="NationalCode" value="<?php echo  $NationalCode ;?>" />
                 <input type="hidden" name="identCode" value="<?php echo  $identCode ;?>" />
                 <input type="hidden" name="y_prod" value="<?php echo  $y_prod ;?>" />
                 <input type="hidden" name="d_prod" value="<?php echo  $d_prod ;?>" />
                 <input type="hidden" name="isic_cod1" value="<?php echo  $isic_cod1 ;?>" />
                 <input type="hidden" name="isic_cod2" value="<?php echo  $isic_cod2 ;?>" />
                 <input type="hidden" name="isic_cod3" value="<?php echo  $isic_cod3 ;?>" />
                 <input type="hidden" name="isic_cod4" value="<?php echo  $isic_cod4 ;?>" />
                 <input type="hidden" name="isic_cod5" value="<?php echo  $isic_cod5 ;?>" />
                 <input type="hidden" name="isic_cod6" value="<?php echo  $isic_cod6 ;?>" />
                 <input type="hidden" name="isic_cod7" value="<?php echo  $isic_cod7 ;?>" />
                 <input type="hidden" name="isic_cod8" value="<?php echo  $isic_cod8 ;?>" />
                 <input type="hidden" name="isic_cod9" value="<?php echo  $isic_cod9 ;?>" />
                 <input type="hidden" name="isic_cod10" value="<?php echo  $isic_cod10 ;?>" />
                 <input type="hidden" name="mtol1" value="<?php echo  $mtol1 ;?>" />
                <input type="hidden" name="mtol2" value="<?php echo  $mtol2 ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
                 
          <p>&nbsp;</p>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>