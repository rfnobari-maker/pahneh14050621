<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal); 
$dis = isset($_POST['dis']) ? $_POST['dis'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
  <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
}
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
border-color:#FFF ;
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
  width:21.25%;
  padding: 5px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php if(isset($num_t_mah)) echo $num_t_mah ;?>").change(function()
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
      <span class="style8">بررسی اطلاعات سطح برداشت و تولید قطعی محصولات زراعی</span><br />
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
                 <td  align='center' bgcolor="#FFFFFF" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
                 <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_kesh" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl" tabindex="2">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if(isset($no_kesh) and $no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if(isset($no_kesh) and $no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: نوع کشت</font></td>
                 <td width="214" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_city5" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                   <select  name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="4" dir="rtl">
   <?php
if(isset($mah_qroup))
{
$query = "SELECT DISTINCT product_cod,product_name FROM product_z WHERE  group_cod = $mah_qroup " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
        <?php
        }
        }
        ?>
        </select>
                 </div></td>
                 <td height="54"  align='center' class="style8">نام محصول</td>
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="3" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_z "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if (isset($mah_qroup) and $row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                   </select></td>
                 <td  align='center' class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="6" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE   mor_cod_m = '$login_session' ORDER BY BINARY abadi "  ;
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
                   <select  name="id_mar" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td width="146" rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="40" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" tabindex="7" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' and mor_cod_m= '$login_session'ORDER BY BINARY shahr "  ;
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
       <input name="mor_cod_m" type="text" class="style8"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m ?>" />

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
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m' " ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m' " ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
 if ($dis == '1')  { $v_dis  = 1  ; }else{ $v_dis = "mah_tol = 0 and mah_kh !='1'" ;}

// include_once('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query  = "SELECT  id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi from $Agri_prod_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and  $v_dis ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit "; 
 $query1 = "SELECT  count(*)  from $Agri_prod_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and  $v_dis  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="AgriP_editT_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="dis"  value="<?php echo $dis ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table width="85%"  align="center" class="my-table" >
              <tr class="text1">
          <td width="9%" rowspan="2" bgcolor="#006699">وضعیت بهره بردار</td>
          <td width="9%" rowspan="2" bgcolor="#006699">میزان تولید قطعی<br />
            <span class="style2">تن</span></td>
          <td colspan="2" bgcolor="#006699"><p>سطح برداشت <br />
            <span class="style2">هکتار</span>          </p></td>
          <td width="7%" rowspan="2" bgcolor="#006699"><p>پیش بینی<br />
            تولید<br />
  <span class="style2">تن </span></p></td>
          <td colspan="2" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
          <td width="10%" rowspan="2" bgcolor="#006699">نام محصول</td>
          <td width="5%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه<br /></td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="7%" bgcolor="#006699">دوم</td>
          <td width="8%" bgcolor="#006699">اول</td>
          <td width="7%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول</td>
          <td width="10%" height="36" bgcolor="#006699" class="text1">کد ملی</td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;
foreach($stmt as $row){ 
$bah_vaz = bah_vaz($row['bah_cod_m']) ;
if ($bah_vaz=='1') $v_bah_vaz='زنده' ;	 
if ($bah_vaz=='2') $v_bah_vaz='فوتی' ;	 
if ($bah_vaz=='3') $v_bah_vaz='تایید نشده' ;	 

if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
 $t_r = $r ; 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_bah_vaz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']; ?>
          <br /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $row['zer_kesht_a']; ?><br /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']); ?><br /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?><br /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td height="34" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
  <p class="style2" align="center">
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
</p>
<?php
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    $t_row = ($rows > 25) ? 25 : $rows;

    // Function to generate hidden inputs
    function generate_hidden_inputs() {
        global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, 
               $mor_cod_m, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis;
        ?>
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
        <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
        <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
        <input type="hidden" name="add_abadi" value="<?= htmlspecialchars($add_abadi) ?>" />
        <input type="hidden" name="add_city" value="<?= htmlspecialchars($add_city) ?>" />
        <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
        <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($mor_cod_m) ?>" />
        <input type="hidden" name="no_kesh" value="<?= htmlspecialchars($no_kesh) ?>" />
        <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
        <input type="hidden" name="mah_qroup" value="<?= htmlspecialchars($mah_qroup) ?>" />
        <input type="hidden" name="mah_name" value="<?= htmlspecialchars($mah_name) ?>" />
        <input type="hidden" name="dis" value="<?= htmlspecialchars($dis) ?>" />
        <?php
    }

// Define visible pages range (shows 5 pages at a time)
$visible_pages = 5;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);
?>

<div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
    <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
        <?php if($id > 1): ?>
            <li style="display: inline-block;">
                <form action="AgriP_edit_T.php?id=<?= $id-1 ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <li style="display: inline-block;">
                <form action="AgriP_edit_T.php?id=1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li style="display: inline-block;">
                <?php if($i == $id): ?>
                    <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                <?php else: ?>
                    <form action="AgriP_edit_T.php?id=<?= $i ?>" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if($end_page < $total): ?>
            <?php if($end_page < $total - 1): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
            <li style="display: inline-block;">
                <form action="AgriP_edit_T.php?id=<?= $total ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($id < $total): ?>
            <li style="display: inline-block;">
                <form action="AgriP_edit_T.php?id=<?= $id+1 ?>" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                </form>
            </li>
    </ul>

    <div class="page-jump" style="margin-top: 15px;">
        <form action="AgriP_edit_T.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
            <?php generate_hidden_inputs(); ?>
            <span style="font-size: 14px;"> به صفحه:</span>
            <input type="number" name="page_input"  
                   value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
        </form>
        <?php endif; ?>
    </div>
</div>

<script>
document.querySelector('.page-jump form').addEventListener('submit', function(e) {
    const pageInput = this.querySelector('input[name="page_input"]');
    const pageNum = parseInt(pageInput.value);
    
    if (isNaN(pageNum)) {
        e.preventDefault();
        alert('لطفاً یک عدد معتبر وارد کنید');
        return;
    }
    
    if (pageNum < 1 || pageNum > <?= $total ?>) {
        e.preventDefault();
        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
        return;
    }
    
    this.action = `AgriP_edit_T.php?id=${pageNum}`;
});
</script>
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