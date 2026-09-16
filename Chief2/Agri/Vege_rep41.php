<?php 
include('../../lock_ce.php');
include('../../event.php');
 $ra_kesh   = $_POST['ra_kesh'] ;
 $z_sal     = $_POST['z_sal'] ;
 $b_time    = $_POST['b_time'] ;
 $ragham    = $_POST['ragham'] ; 
 $no_ab     = $_POST['no_ab'] ; 
 $dah_bazar = $_POST['dah_bazar'] ; 
 $mah_bazar = $_POST['mah_bazar'] ; 
 $mah_name  = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
      <span class="style8">گزارش اختصاصی اطلاعات صیفی </span><br />
      </p>
      <span class="style1"><a name="1" id="1"></a></span>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="321" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="53" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">&nbsp;</td>
                 <td height="53" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1398-1399" <?php if (isset($z_sal) && $z_sal=='1398-1399') echo 'selected=selected'?>>1398-1399</option>
                     <option value="1397-1398" <?php if (isset($z_sal) && $z_sal=='1397-1398') echo 'selected=selected'?>>1397-1398</option>
                     <option value="1396-1397" <?php if (isset($z_sal) && $z_sal=='1396-1397') echo 'selected=selected'?>>1396-1397</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال زراعی</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="44" colspan="2" bgcolor="#FFFFFF"><div align="right"  class="style8" >انتخاب نام محصول ضروری میباشد</div> </td>
                 <td width="196" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="mah_name" class="required input_text country" id="mah_name" style="width:150px ; height:40px" tabindex="22" dir="rtl" onchange="this.form.submit()" >
                   <option value="">انتخاب نام محصول</option>
                   <option value="174" <?php if ($mah_name=='174') echo 'selected="selected"' ; ?>>گوجه فرنگی</option>
                   <option value="170" <?php if ($mah_name=='170') echo 'selected="selected"' ; ?>>سیب زمینی</option>
                   <option value="172" <?php if ($mah_name=='172') echo 'selected="selected"' ; ?>>پیاز</option>
                 </select></td>
                 <td width="166"  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">:نام محصول</font><span class="style8"><br />
                   </span></td>
               </tr>
               <tr >
                 <td height="60" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="ragham" id="ragham" class="input_text  required"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
                     <?php
switch ($mah_name) {
    case "174":
  ?>
                     <option value="-">-----</option>
                     <?php
        break;
    case "172":
  ?>
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>قرمز</option>
                     <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سفید</option>
                     <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>زرد</option>
                     <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>صورتی</option>
                     <?php
        break;
    case "170":
  ?>
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>اگریا</option>
                     <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سانته</option>
                     <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>ساتینا</option>
                     <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>میلوا</option>
                     <option value="5" <?php if ($ragham=='5') { echo 'selected="selected"' ; }?>>بورن</option>
                     <option value="6" <?php if ($ragham=='6') { echo 'selected="selected"' ; }?>>ساوالان</option>
                     <option value="7" <?php if ($ragham=='7') { echo 'selected="selected"' ; }?>>آرنیدا</option>
                     <option value="8" <?php if ($ragham=='8') { echo 'selected="selected"' ; }?>>بانبا</option>
                     <option value="9" <?php if ($ragham=='9') { echo 'selected="selected"' ; }?>>مارفونا</option>
                     <option value="10" <?php if ($ragham=='10') { echo 'selected="selected"' ; }?>>فونتانه</option>
                     <option value="11" <?php if ($ragham=='11') { echo 'selected="selected"' ; }?>>راموس</option>
                     <option value="12" <?php if ($ragham=='12') { echo 'selected="selected"' ; }?>>پیکاسو</option>
                     <option value="13" <?php if ($ragham=='13') { echo 'selected="selected"' ; }?>>جلی</option>
                     <option value="14" <?php if ($ragham=='14') { echo 'selected="selected"' ; }?>>سایر</option>
                     <?php
}
?>
                     </select>
                   </div></td>
                 <td height="60"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: رقم</td>
                 <td height="60" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="b_time" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                     <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                     <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                     <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                   </select>
                 </div>                   <div align="right"></td>
                 <td  align='center' bgcolor="#DDDDDD" ><span class="normalTextSmall">: فصل تولید</span></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="ra_kesh" id="ra_kesh" class="input_text  required"  style="height:40px ; width:150px ; direction:rtl" tabindex="7">
                     <option value="">انتخاب کنید</option>
                     <?php if ($mah_name=='170') {?>
                     <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
                     <?php } else {?>
                     <option value="1" <?php if ($ra_kesh=='1') { echo 'selected="selected"' ; }?>>نشایی</option>
                     <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
                     <?php }?>
                     <?php if ($mah_name=='174') {?> 
                  <option value="3"<?php if ($ra_kesh=='3') { echo 'selected="selected"' ; }?>>نشایی با مالچ</option>
                  <option value="4"<?php if ($ra_kesh=='4') { echo 'selected="selected"' ; }?>>مستقیم با مالچ</option>
                    <?php }?>
                   </select>
                 </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall"><font size="2" class="normalTextSmall">:روش کشت</font></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>نواری</option>
                     <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>غرقابی</option>
                     <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>قطره ای</option>
                     <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>بارانی</option>
                     <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>سایر</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" ><font size="2" class="normalTextSmall">:روش آبیاری</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="dah_bazar" class="required input_text  required" id="dah_bazar"  style="height:40px ; width:150px ; direction:rtl" tabindex="3">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($dah_bazar=='1') { echo 'selected="selected"' ; } ?>>دهه اول </option>
                     <option value="2" <?php if ($dah_bazar=='2') { echo 'selected="selected"' ; } ?>>دهه دوم</option>
                     <option value="3" <?php if ($dah_bazar=='3') { echo 'selected="selected"' ; } ?>>دهه سوم</option>
                     </select>
                   </div></td>
                 <td height="54" align="right" bgcolor="#DDDDDD"  ><font size="2" class="normalTextSmall">: دهه ارسال به بازار</font></td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="mah_bazar" class="required input_text  required" id="mah_bazar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:150px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($mah_bazar=='1') { echo 'selected="selected"' ; } ?>>فروردین</option>
                     <option value="2" <?php if ($mah_bazar=='2') { echo 'selected="selected"' ; } ?>>اردیبهشت</option>
                     <option value="3" <?php if ($mah_bazar=='3') { echo 'selected="selected"' ; } ?>>خرداد</option>
                     <option value="4" <?php if ($mah_bazar=='4') { echo 'selected="selected"' ; } ?>>تیر</option>
                     <option value="5" <?php if ($mah_bazar=='5') { echo 'selected="selected"' ; } ?>>مرداد</option>
                     <option value="6" <?php if ($mah_bazar=='6') { echo 'selected="selected"' ; } ?>>شهریور</option>
                     <option value="7" <?php if ($mah_bazar=='7') { echo 'selected="selected"' ; } ?>>مهر</option>
                     <option value="8" <?php if ($mah_bazar=='8') { echo 'selected="selected"' ; } ?>>آبان</option>
                     <option value="9" <?php if ($mah_bazar=='9') { echo 'selected="selected"' ; } ?>>آذر</option>
                     <option value="10" <?php if ($mah_bazar=='10') { echo 'selected="selected"' ; } ?>>دی</option>
                     <option value="11" <?php if ($mah_bazar=='11') { echo 'selected="selected"' ; } ?>>بهمن</option>
                     <option value="12" <?php if ($mah_bazar=='12') { echo 'selected="selected"' ; } ?>>اسفند</option>
                     </select>
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" ><font size="2" class="normalTextSmall">:ماه ارسال به بازار</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; background-color:#3CF 
                   ; alignment-adjust:middle" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
  $v_z_sal     = "z_sal = '$z_sal'" ;
  $v_cod_mah   = "cod_mah = '$mah_name'" ;
 if ($ra_kesh == '')     { $v_ra_kesh  = 1   ;}else{$v_ra_kesh  = "ra_kesh = '$ra_kesh'" ;}
 if ($b_time == '')      { $f_b_time   = 1 ;}else{ $f_b_time     = "b_time = '$b_time'"       ;}
 if ($ragham == '')      { $v_ragham   = 1     ;}else{$v_ragham    = "ragham = '$ragham'" ;}
 if ($no_ab == '')       { $v_no_ab    = 1     ;}else{$v_no_ab      = "no_ab = '$no_ab'" ;}
 if ($mah_bazar == '')   { $v_mah_bazar= 1  ;}else{$v_mah_bazar = "mah_bazar = '$mah_bazar'" ;}
 if ($dah_bazar == '')   { $v_dah_bazar= 1  ;}else{$v_dah_bazar = "dah_bazar = '$dah_bazar'" ;}
 include('../../login/config.php');
$query = "SELECT ostan,id_ostan from ostanname where 1 
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','28','09','29','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56">
                 <form  action="Vege_rep41_xls.php" method="post">
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo  $ragham ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
                <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Vege_rep4_doc.php" method="post">
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo  $ragham ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <br />
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="15%" height="38" bgcolor="#006699"> مجموع تولید قطعی<br />
                  <span class="style3">تن </span></td>
                <td width="16%" bgcolor="#006699"> مجموع  پیش بینی تولید <br />
                <span class="style3">تن</span></td>
          <td width="16%" bgcolor="#006699"> مجموع  سطح برداشت<br />
            <span class="style3">هکتار</span></td>
          <td width="16%" bgcolor="#006699">مجموع  سطح زیر کشت<br />
            <span class="style3">هکتار</span></td>
          <td width="15%" bgcolor="#006699">سطح زیر کشت ابلاغی<br />
            <span class="style3">هکتار</span></td>
          <td width="17%" bgcolor="#006699">نام استان</td>
          <td width="5%" bgcolor="#006699">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$id_ostan = $row['id_ostan'] ; 
$ostan = $row['ostan'] ; 
$query = "SELECT id_ostan,sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp 
 , sum(mah_tol) as T_mah_tol from Vege_prod
   where  $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time and id_ostan = '$id_ostan' Group by id_ostan  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
          <td height="39"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_s_bar']+0 ; ?></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
          <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $ostan?></div></td>
          <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}

  $query = "SELECT  sum(zer_kesht) as T_zer_kesht, sum(s_bar) as T_s_bar , sum(mah_tolp) as T_mah_tolp , sum(mah_tol) as T_mah_tol
     from  Vege_prod where $v_z_sal  and  $v_cod_mah and  $v_ragham  and $v_no_ab  and $v_mah_bazar and $v_dah_bazar and
  $v_ra_kesh and $f_b_time "; 
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
          <td bgcolor="#006699" class="text1"  >سطح زیر کشت ابلاغی<br />
            <span class="style3">هکتار</span></td>
          <td colspan="2" bgcolor="#006699" class="text1"  >کل</td>
          </tr>
<?php 
foreach($stmt as $row){ 
?>
        <tr>
          <td height="39" ><?php echo round($row['T_mah_tol'],3)*1 ; ?></td>
          <td><?php echo round($row['T_mah_tolp'],3)*1 ; ?></td>
          <td><?php echo $row['T_s_bar']+0 ; ?></td>
          <td><?php echo $row['T_zer_kesht']+0 ; ?></td>
          <td  >&nbsp;</td>
          <td colspan="2"  >&nbsp;</td>
          </tr>
  </table>
   <?php }
}
?>

          <p>&nbsp;</p>
          <p>&nbsp;</p>
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