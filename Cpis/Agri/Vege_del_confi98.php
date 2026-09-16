<?php 
include('../../lock_cp.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $z_sal     = $_POST['z_sal'] ;
 $b_time    = $_POST['b_time'] ;
 $mah_name  = $_POST['mah_name'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
      <span class="style8">برداشت  تایید رئیس مرکز ، اطلاعات صیفی </span><br />
      </p>
      <span class="style1"><a name="1" id="1"></a></span>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="325" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="53" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1397-1398" <?php if (isset($z_sal) && $z_sal=='1397-1398') echo 'selected=selected'?>>1397-1398</option>
                     <option value="1396-1397" <?php if (isset($z_sal) && $z_sal=='1396-1397') echo 'selected=selected'?>>1396-1397</option>
                     </select>
                   </div></td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال زراعی <span class="style8">*</span></td>
                 <td height="53" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> انتخاب استان </option>
                     <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: استان<span class="style8"> *</span></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_mar" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">:مرکز جهاد کشاورزی</font></td>
                 <td align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <option value="0"> کل استان</option>
                   <?php
$query = "SELECT id_city,city FROM cityname WHERE id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td  align='center' bgcolor="#FFFFFF" class="normalTextSmall">:شهرستان</font></td>
                 </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="51" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
                 <td width="196" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="mah_name" class="required input_text country" id="mah_name" style="width:170px ; height:40px" tabindex="22" dir="rtl" onchange="this.form.submit()" >
                   <option value="">انتخاب نام محصول</option>
                   <option value="174" <?php if ($mah_name=='174') echo 'selected="selected"' ; ?>>گوجه فرنگی</option>
                   <option value="170" <?php if ($mah_name=='170') echo 'selected="selected"' ; ?>>سیب زمینی</option>
                   <option value="172" <?php if ($mah_name=='172') echo 'selected="selected"' ; ?>>پیاز</option>
                 </select></td>
                 <td width="166"  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">:نام محصول</font><span class="style8"> *<br />
                   </span></td>
               </tr>
               <tr >
                 <td height="60" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td height="60"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">&nbsp;</td>
                 <td height="60" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="b_time" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                     <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                     <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                     <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                   </select>
                 </div>                   <div align="right"></td>
                 <td  align='center' bgcolor="#DDDDDD" ><span class="normalTextSmall">: فصل تولید </span><span class="style8">*</span></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <div align="right" class="style8" style="margin-right:25px"> <br />
                     فیلدهای های ضروری : * </div>
                   <p>
                     <input name="action" type="submit" id="action" style="width:150px ; height:45px ;  background-color:#3CF ; alignment-adjust:middle" value='اجرای کوئری' />
                   </p>
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
  if (isset($_POST['del_confi'])) 
 {
$id_ostan1 = $_POST['id_ostan'] ;
$z_sal     = $_POST['z_sal'] ;
$b_time    = $_POST['b_time'] ;
$mah_name  = $_POST['mah_name'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 include_once('../../login/config.php');
 $query = "update Vege 
INNER JOIN Vege_prod ON Vege.id = Vege_prod.Vege_id
set confi= '1',date_confi='',confi2='1',date_confi2=''
WHERE Vege_prod.z_sal =  '$z_sal'
AND Vege_prod.cod_mah =  '$mah_name'
AND Vege_prod.b_time =  '$b_time'
AND Vege_prod.id_ostan = '$id_ostan1' 
AND and $v_id_city and  $v_id_mar"; 
$q = $dbh->prepare($query);
$q->execute();
	 alert('تایید اطلاعات مورد نظر با موفقیت حذف شد') ; 
 }
 if (isset($_POST['action'])) 
 {  
  $v_z_sal     = "Vege_prod.z_sal = '$z_sal'" ;
  $v_cod_mah   = "Vege_prod.cod_mah = '$mah_name'" ;
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "Vege_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar     = 1 ;}else{ $v_id_mar = "Vege_prod.id_mar='$id_mar'" ;}
 if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "Vege_prod.id_ostan='$id_ostan1'" ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time     = "Vege_prod.b_time = '$b_time'"       ;}
 include_once('../../login/config.php');
 $query = "SELECT  cityname.city,Vege_prod.id_ostan,Vege_prod.id_city,sum(Vege_prod.zer_kesht) as T_zer_kesht,
 sum(Vege_prod.s_bar) as T_s_bar , sum(Vege_prod.mah_tolp) as T_mah_tolp , sum(Vege_prod.mah_tol) as T_mah_tol,mar.mar
     from  Vege_prod 
	 LEFT JOIN cityname ON Vege_prod.id_ostan = cityname.id_ostan and Vege_prod.id_city = cityname.id_city
	 inner JOIN mar ON Vege_prod.id_ostan = mar.id_ostan and Vege_prod.id_mar = mar.id_mar
	 where  $v_id_ostan  and $v_id_city and  $v_id_mar and $v_z_sal  and  $v_cod_mah and  $f_b_time Group by Vege_prod.id_city ORDER BY BINARY cityname.city "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
             
            <br />
            <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="18%" height="38" bgcolor="#006699"> مجموع تولید قطعی<br />
                  <span class="style3">تن </span></td>
                <td width="19%" bgcolor="#006699"> مجموع  پیش بینی تولید <br />
                <span class="style3">تن</span></td>
          <td width="19%" bgcolor="#006699"> مجموع  سطح برداشت<br />
            <span class="style3">هکتار</span></td>
          <td width="20%" bgcolor="#006699">مجموع  سطح زیر کشت<br />
            <span class="style3">هکتار</span></td>
          <td width="17%" bgcolor="#006699">نام شهرستان / مرکز</td>
          <td width="7%" bgcolor="#006699">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td height="39"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_s_bar']+0 ; ?></td>
          <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['city']?>
          <?php if($id_mar != 0) echo '/' . $row['mar']?>
          </div></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
  $query = "SELECT  id_city,sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp , sum(mah_tol) as T_mah_tol
     from  Vege_prod where  $v_id_ostan  and $v_z_sal  and  $v_cod_mah  and $f_b_time Group by id_ostan "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
	?>
        <tr>
          <td height="38" bgcolor="#006699" class="text1"> مجموع تولید قطعی<br />
            <span class="style3">تن </span></td>
          <td bgcolor="#006699" class="text1"> مجموع  پیش بینی تولید <br />
            <span class="style3">تن</span></td>
          <td bgcolor="#006699" class="text1"> مجموع  سطح برداشت<br />
            <span class="style3">هکتار</span></td>
          <td bgcolor="#006699" class="text1">مجموع  سطح زیر کشت<br />
            <span class="style3">هکتار</span></td>
          <td colspan="2" bgcolor="#006699" class="text1"  >کل استان </td>
          </tr>
<?php 
foreach($stmt as $row){ 
?>
        <tr>
          <td height="39" ><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td><?php echo $row['T_s_bar']+0 ; ?></td>
          <td><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td colspan="2"  >&nbsp;</td>
          </tr>
  </table>
   <?php }
    ?>
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
   <form  id="del-form" method="post" action="#">
            <input type="hidden" name="id_ostan" id="id_ostan" value="<?php echo $id_ostan1 ?>" />
            <input type="hidden" name="z_sal" id="id_ostan"    value="<?php echo $z_sal ?>" />
            <input type="hidden" name="b_time" id="id_ostan"   value="<?php echo $b_time ?>" />
            <input type="hidden" name="mah_name" id="id_ostan"   value="<?php echo $mah_name ?>" />
           <input name="del_confi" type="submit" class="text1" id="action" style="width:250px ; height:45px ;  background-color:#C00 ; border-radius:15px ;  alignment-adjust:middle" value='با برداشت تایید اطلاعات فوق موافقم ' />
            </form>
<?php
  }
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>

          <p>&nbsp;</p>
          <p>

          </p>
          <p><a href="Vege.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>