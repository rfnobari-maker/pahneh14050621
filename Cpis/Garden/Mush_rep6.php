<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if (isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'];
if (isset($_POST['add_city'])) $add_city = $_POST['add_city'];
if (isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'];
if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
if (isset($_POST['y_prod'])) $y_prod = $_POST['y_prod'];
if (isset($_POST['no_mush'])) $no_mush = $_POST['no_mush'];

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
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
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
      <span class="style19">آمار تولید واحد های پرورش قارچ</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="375" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="206" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
           <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl">
            <option value="1404" <?php if ($y_prod=='1404') echo 'selected=selected'?>>1404</option>
            <option value="1403" <?php if ($y_prod=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
            <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
            <option value="1398" <?php if ($y_prod=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if ($y_prod=='1397') echo 'selected=selected'?>>1397</option>
            </select>
                 </div></td>
                 <td width="136"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" tabindex="1" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" >&nbsp;</td>
                 <td width="215" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" tabindex="3" dir="rtl"  onchange="this.form.submit()">
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
                 <td width="143"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="5" dir="rtl"   >
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
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall"> : نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="id_mar" style="width:170px ; height:40px" tabindex="4" dir="rtl" onchange="this.form.submit()">
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
                   <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" tabindex="6" dir="rtl"   >
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
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">:نام شهر</td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " tabindex="8" value="<?php echo $bah_cod_m?>" />
                   </div></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: کد ملی بهره بردار</font></td>
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m"  style="height:35px ; width:170px " tabindex="7" value="<?php echo $mor_cod_m?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: کد ملی مروج</font></td>
           </tr>
               <tr >
<td height="52" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="style1" >&nbsp;</td>
                 <td width="215" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="no_mush" class="input_text  required" id="no_mush"  style="height:40px ; width:170px ; direction:rtl" tabindex="9">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mush=='1') { echo 'selected="selected"' ; } ?>>صدفی</option>
                     <option value="2" <?php if ($no_mush=='2') { echo 'selected="selected"' ; } ?>>دکمه ای</option>
                     <option value="3" <?php if ($no_mush=='3') { echo 'selected="selected"' ; } ?>>سایر قارچ های پرورشی خاص</option>
                   </select>
                 </div></td>
                 <td width="143"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">نوع قارچ پرورشی</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="23" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Mushroom_prod.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Mushroom_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Mushroom_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Mushroom_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Mushroom_prod.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Mushroom_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Mushroom_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "Mushroom_prod.no_mush = '$no_mush'" ;}
 include_once('../../login/config.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = " SELECT Mushroom.id,Mushroom.id_ostan,Mushroom.id_city,Mushroom.id_mar,Mushroom.bah_cod_m
,Mushroom.no_mush,Mushroom.unit_name
,Mushroom.mor_cod_m,Mushroom.m_zamin,Mushroom.m_arseh,Mushroom.m_salon
,Mushroom_spawn.num_row,Mushroom_spawn.num_t_row,Mushroom_spawn.h_t,Mushroom_spawn.w_t,Mushroom_spawn.num_spawn,Mushroom_prod.zer_kesh
,Mushroom_prod.t_dpar
FROM Mushroom 
left join Mushroom_spawn ON Mushroom.id = Mushroom_spawn.unit_id and Mushroom_spawn.y_prod = '$y_prod'
left join Mushroom_prod ON Mushroom.id = Mushroom_prod.unit_id and Mushroom_prod.y_prod = '$y_prod'
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and Mushroom_prod.y_prod = '$y_prod' and 
$f_no_mush and $v_bah_cod_m and $v_mor_cod_m  group by Mushroom.id ORDER BY id_ostan,id_city,bah_cod_m ASC LIMIT $start, $limit "; 

$query1 = " SELECT Mushroom.id,Mushroom.id_ostan,Mushroom.id_city,Mushroom.id_mar,Mushroom.bah_cod_m
,Mushroom.no_mush,Mushroom.unit_name
,Mushroom.mor_cod_m,Mushroom.m_zamin,Mushroom.m_arseh,Mushroom.m_salon
,Mushroom_spawn.num_row,Mushroom_spawn.num_t_row,Mushroom_spawn.h_t,Mushroom_spawn.w_t,Mushroom_spawn.num_spawn,Mushroom_spawn.zer_kesh
,Mushroom_prod.t_dpar
FROM Mushroom 
left join Mushroom_spawn ON Mushroom.id = Mushroom_spawn.unit_id and Mushroom_spawn.y_prod = '$y_prod'
left join Mushroom_prod ON Mushroom.id = Mushroom_prod.unit_id and Mushroom_prod.y_prod = '$y_prod'
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and Mushroom_prod.y_prod = '$y_prod' and 
$f_no_mush and $v_bah_cod_m and $v_mor_cod_m  group by Mushroom.id ORDER BY id_ostan,id_city,bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <span class="style1"><a name="1" id="1"></a></span><br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Mush_rep6_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                   <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
                   <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="90%" align="center" class="my-table" >
              <tr class="text1">
                <td width="6%" rowspan="2" bgcolor="#006699">سطح زیر کشت سالیانه<br />
                <span class="style2">مترمربع</span></td>
          <td width="5%" rowspan="2" bgcolor="#006699"><p>تعداد سالن</p></td>
          <td width="5%" rowspan="2" bgcolor="#006699">عرض هر طبقه<br />
            <span class="style2">متر </span></td>
          <td width="5%" rowspan="2" bgcolor="#006699">طول هر طبقه<br />
            <span class="style2">متر </span></td>
          <td width="5%" rowspan="2" bgcolor="#006699">تعداد طبقه در هر ردیف</td>
          <td width="5%" rowspan="2" bgcolor="#006699">تعداد ردیف</td>
          <td width="6%" rowspan="2" bgcolor="#006699"><p>تعداد دوره پرورشی</p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">مساحت سالن</td>
          <td width="6%" rowspan="2" bgcolor="#006699"><p>مساحت زیربنا</p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">مساحت زمین</td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع قارچ</td>
          <td width="5%" rowspan="2" bgcolor="#006699">کد واحد</td>
          <td width="9%" rowspan="2" bgcolor="#006699"><p>نام واحد</p></td>
          <td colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 

if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';

if ($row['nt_comp']=='1')  $v_nt_comp='خود مصرفی';
if ($row['nt_comp']=='2')  $v_nt_comp='خریداری شده';
if ($row['nt_comp']=='3')  $v_nt_comp='ترکیبی';



  ?>
          <td height="37" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesh'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_spawn'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['w_t'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['h_t'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_t_row'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num_row'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dpar'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_salon']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_arseh']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush;  ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id']; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name']; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m']; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
<div   style=" text-align:right;height:80px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Mush_rep6.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Mush_rep6.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
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
      <li class='current'><form  action="Mush_rep6.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_mush"   value="<?php echo  $no_mush ;?>" />
        <input type="hidden" name="y_prod"    value="<?php echo  $y_prod ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
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