<?php 
include('../../lock_oce.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $no_kesht = $_POST['no_kesht'] ;
 $y_prod = $_POST['y_prod'] ;
 $skb1 = $_POST['skb1'] ;
 $skb2 = $_POST['skb2'] ;
 $date_1_kesh = $_POST['date_1_kesh'] ;
 $date_2_kesh = $_POST['date_2_kesh'] ;
 $date_1_bar = $_POST['date_1_bar'] ;
 $date_2_bar = $_POST['date_2_bar'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
// کد گروه و کد محصول
 $group_cod = $_POST['group_cod'] ;
 $mah_cod = $_POST['mah_cod'] ;
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
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_Green_rep.php",
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
url: "ajax_Green_rep.php",
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
      <span class="style8">گزارش جمعبندی محصولات گلخانه</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="436" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="204" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1404" <?php if ($y_prod=='1404') echo 'selected=selected'?>>1404</option>
                     <option value="1403" <?php if ($y_prod=='1403') echo 'selected=selected'?>>1403</option>
                     <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
                   </select>
                 </div></td>
                 <td width="134"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                  <?php $id_ostan1 = $id_ostan?>
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="41" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="no_kesht" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesht=="1") echo "selected='selected'"?>>گلخانه</option>
                     <option value="2" <?php if($no_kesht=="2") echo "selected='selected'"?>>فضای باز</option>
                   </select>
                 </div></td>
                 <td height="41" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="normalTextSmall">: نوع کشت</font></td>
                 <td width="196" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td width="166"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall"> :شهرستان</font></td>
               </tr>
               <tr >
  <td height="52" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
    <select name="date_2_kesh" class="date date_2_kesh input_text  " id="date_2_kesh"  style="height:40px ; width:70px ; direction:rtl" tabindex="61">
      <option value="">انتخاب</option>
      <option value="01"<?php if($date_2_kesh == '01') echo 'selected=selected'?>>فروردین</option>
      <option value="02"<?php if($date_2_kesh == '02') echo 'selected=selected'?>>اردیبهشت</option>
      <option value="03"<?php if($date_2_kesh == '03') echo 'selected=selected'?>>خرداد</option>
      <option value="04"<?php if($date_2_kesh == '04') echo 'selected=selected'?>>تیر</option>
      <option value="05"<?php if($date_2_kesh == '05') echo 'selected=selected'?>>مرداد</option>
      <option value="06"<?php if($date_2_kesh == '06') echo 'selected=selected'?>>شهریور</option>
      <option value="07"<?php if($date_2_kesh == '07') echo 'selected=selected'?>>مهر</option>
      <option value="08"<?php if($date_2_kesh == '08') echo 'selected=selected'?>>آبان</option>
      <option value="09"<?php if($date_2_kesh == '09') echo 'selected=selected'?>>آذر</option>
      <option value="10"<?php if($date_2_kesh == '10') echo 'selected=selected'?>>دی</option>
      <option value="11"<?php if($date_2_kesh == '11') echo 'selected=selected'?>>بهمن</option>
      <option value="12"<?php if($date_2_kesh == '12') echo 'selected=selected'?>>اسفند</option>
      </select>
  </div></td>
                 <td height="52" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="normalTextSmall">:پایان کشت</font></td>
                 <td width="196" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <div align="right">
                     <select name="date_1_kesh" class="date date_1_kesh input_text  " id="date_1_kesh"  style="height:40px ; width:70px ; direction:rtl" tabindex="60">
                       <option value="">انتخاب</option>
                       <option value="01"<?php if($date_1_kesh == '01') echo 'selected=selected'?>>فروردین</option>
                       <option value="02"<?php if($date_1_kesh == '02') echo 'selected=selected'?>>اردیبهشت</option>
                       <option value="03"<?php if($date_1_kesh == '03') echo 'selected=selected'?>>خرداد</option>
                       <option value="04"<?php if($date_1_kesh == '04') echo 'selected=selected'?>>تیر</option>
                       <option value="05"<?php if($date_1_kesh == '05') echo 'selected=selected'?>>مرداد</option>
                       <option value="06"<?php if($date_1_kesh == '06') echo 'selected=selected'?>>شهریور</option>
                       <option value="07"<?php if($date_1_kesh == '07') echo 'selected=selected'?>>مهر</option>
                       <option value="08"<?php if($date_1_kesh == '08') echo 'selected=selected'?>>آبان</option>
                       <option value="09"<?php if($date_1_kesh == '09') echo 'selected=selected'?>>آذر</option>
                       <option value="10"<?php if($date_1_kesh == '10') echo 'selected=selected'?>>دی</option>
                       <option value="11"<?php if($date_1_kesh == '11') echo 'selected=selected'?>>بهمن</option>
                       <option value="12"<?php if($date_1_kesh == '12') echo 'selected=selected'?>>اسفند</option>
                       </select>
                    </div></td>
                 <td width="166"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">: شروع کشت</font></td>
               </tr>
               
               <tr >
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="date_2_bar" class="date date_2_bar input_text  " id="date_2_bar"  style="height:40px ; width:70px ; direction:rtl" tabindex="64">
                     <option value="">انتخاب</option>
                     <option value="01"<?php if($date_2_bar == '01') echo 'selected=selected'?>>فروردین</option>
                     <option value="02"<?php if($date_2_bar == '02') echo 'selected=selected'?>>اردیبهشت</option>
                     <option value="03"<?php if($date_2_bar == '03') echo 'selected=selected'?>>خرداد</option>
                     <option value="04"<?php if($date_2_bar == '04') echo 'selected=selected'?>>تیر</option>
                     <option value="05"<?php if($date_2_bar == '05') echo 'selected=selected'?>>مرداد</option>
                     <option value="06"<?php if($date_2_bar == '06') echo 'selected=selected'?>>شهریور</option>
                     <option value="07"<?php if($date_2_bar == '07') echo 'selected=selected'?>>مهر</option>
                     <option value="08"<?php if($date_2_bar == '08') echo 'selected=selected'?>>آبان</option>
                     <option value="09"<?php if($date_2_bar == '09') echo 'selected=selected'?>>آذر</option>
                     <option value="10"<?php if($date_2_bar == '10') echo 'selected=selected'?>>دی</option>
                     <option value="11"<?php if($date_2_bar == '11') echo 'selected=selected'?>>بهمن</option>
                     <option value="12"<?php if($date_2_bar == '12') echo 'selected=selected'?>>اسفند</option>
                   </select>
                 </div></td>
                 <td height="50"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:پایان برداشت</font></td>
                 <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="date_1_bar" class="date date_1_bar input_text  " id="date_1_bar"  style="height:40px ; width:70px ; direction:rtl" tabindex="63">
                     <option value="">انتخاب</option>
                     <option value="01"<?php if($date_1_bar == '01') echo 'selected=selected'?>>فروردین</option>
                     <option value="02"<?php if($date_1_bar == '02') echo 'selected=selected'?>>اردیبهشت</option>
                     <option value="03"<?php if($date_1_bar == '03') echo 'selected=selected'?>>خرداد</option>
                     <option value="04"<?php if($date_1_bar == '04') echo 'selected=selected'?>>تیر</option>
                     <option value="05"<?php if($date_1_bar == '05') echo 'selected=selected'?>>مرداد</option>
                     <option value="06"<?php if($date_1_bar == '06') echo 'selected=selected'?>>شهریور</option>
                     <option value="07"<?php if($date_1_bar == '07') echo 'selected=selected'?>>مهر</option>
                     <option value="08"<?php if($date_1_bar == '08') echo 'selected=selected'?>>آبان</option>
                     <option value="09"<?php if($date_1_bar == '09') echo 'selected=selected'?>>آذر</option>
                     <option value="10"<?php if($date_1_bar == '10') echo 'selected=selected'?>>دی</option>
                     <option value="11"<?php if($date_1_bar == '11') echo 'selected=selected'?>>بهمن</option>
                     <option value="12"<?php if($date_1_bar == '12') echo 'selected=selected'?>>اسفند</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">: شروع برداشت</font></td>
               </tr>
               <tr >
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">مترمربع</span>
                   <input name="skb2" type="text" class="input_text" id="skb2"  style="height:35px ; width:70px " value="<?php echo $skb2?>" />
                   </div></td>
                 <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی</td>
                 <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">مترمربع </span>
                     <input name="skb1" type="text" class="input_text" id="skb1"  style="height:35px ; width:70px " value="<?php echo $skb1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">سطح زیر کشت <br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="61" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select  name="mah_cod" class="target<?php echo $mah_cod.$num2_t_mah ;?> required input_text mar<?php echo $mah_cod.$num2_t_mah ;?>" id="cod_mah" style="width:200px ; height:40px" tabindex="59" dir="rtl">
                     <option value="" selected="selected">انتخاب نام محصول</option>
                     <?php
$query = "SELECT DISTINCT mah_cod,mah_name FROM product_G WHERE  group_cod = $group_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['mah_cod'] ;?>"
   <?php if ($row['mah_cod']==$mah_cod) echo 'selected=selected'?>> <?php echo $row['mah_name'] ;?></option>
                     <?php
}
?>
                     </select>
                   </div></td>
                 <td height="61"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: نام محصول</td>
                 <td height="61" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                 <select  name="group_cod" class="mah_qroup required input_text country" id="mah_qroup" style="width:160px ; height:40px" tabindex="58" dir="rtl"  >
                     <option value="" > انتخاب گروه</option>
                     <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_G where 1  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
             <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']== $group_cod) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php }?>
                     </select>
                   </div>                   <div align="right"></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="normalTextSmall">:گروه محصولات</font></td>
               </tr>
               <tr >
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">تن/عدد/اصله/گلدان/شاخه</span>
                   <input name="mtol2" type="text" class="input_text" id="mtol2"  style="height:35px ; width:70px " value="<?php echo $mtol2?>" />
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
                 <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"> <span class="style2">تن/عدد/اصله/گلدان/شاخه</span>
                   <input name="mtol1" type="text" class="input_text" id="mtol5"  style="height:35px ; width:70px " value="<?php echo $mtol1?>" />
                   </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="normalTextSmall">میزان تولید محصول<br />
                   : بزرگتر یا مساوی</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='اجرای کوئری' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($no_kesht == '0')  { $f_no_kesht  = 1  ; }else{ $f_no_kesht = "no_kesht = '$no_kesht'" ;}
 if ($y_prod == '')  { $v_y_prod  = 1  ; }else{ $v_y_prod = "y_prod = '$y_prod'" ;}
 if ($group_cod == '')  { $v_group_cod  = 1  ; }else{ $v_group_cod = "group_cod = '$group_cod'" ;}
 if ($mah_cod == '')  { $v_mah_cod  = 1  ; }else{ $v_mah_cod = "mah_cod = '$mah_cod'" ;}
 if ($skb1 == '')  { $v_skb1  = 1  ; }else{ $v_skb1 = "s_kesh >= $skb1" ;}
 if ($skb2 == '')  { $v_skb2  = 1  ; }else{ $v_skb2 = "s_kesh <= $skb2" ;}
 if ($date_1_kesh == '')  { $v_date_1_kesh  = 1  ; }else{ $v_date_1_kesh = "date_1_kesh >= $date_1_kesh" ;}
 if ($date_2_kesh == '')  { $v_date_2_kesh  = 1  ; }else{ $v_date_2_kesh = "date_2_kesh <= $date_2_kesh" ;}
 if ($date_1_bar == '')  { $v_date_1_bar  = 1  ; }else{ $v_date_1_bar = "date_1_bar >= $date_1_bar" ;}
 if ($date_2_bar == '')  { $v_date_2_bar  = 1  ; }else{ $v_date_2_bar = "date_2_bar <= $date_2_bar" ;}

 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "m_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "m_tol <= $mtol2" ;}

 include('../../login/config.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

if ($id_ostan1 == '-1') {
   $query = " SELECT sum(s_kesh) as s_kesh , sum(m_tol) as m_tol , id_ostan, mah_cod , group_cod , no_kesht 
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city and $f_no_kesht and 
 $v_y_prod and $v_group_cod and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2 group by id_ostan,no_kesht,group_cod,mah_cod  ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') LIMIT $start, $limit "; 
 $query1 = "SELECT id
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city  and $f_no_kesht and 
 $v_y_prod and $v_group_cod  and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2  group by id_ostan,no_kesht,group_cod,mah_cod  "; 
}
else
{
   $query = " SELECT sum(s_kesh) as s_kesh , sum(m_tol) as m_tol , id_ostan,id_city , mah_cod , group_cod , no_kesht 
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city and $f_no_kesht and 
 $v_y_prod and $v_group_cod and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2 group by id_city,no_kesht,group_cod,mah_cod  ORDER BY id_city ASC LIMIT $start, $limit "; 
 $query1 = "SELECT id
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city  and $f_no_kesht and 
 $v_y_prod and $v_group_cod  and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2  group by id_city,no_kesht,group_cod,mah_cod "; 
}

$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <span class="style1"><a name="1" id="1"></a></span><br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Greenh_rep4_xls.php" method="post">
                   <input type="hidden" name="id_ostan1"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="no_kesht"   value="<?php echo  $no_kesht ;?>" />
                   <input type="hidden" name="y_prod"     value="<?php echo $y_prod ;?>" />
                   <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
                   <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
                   <input type="hidden" name="date_1_kesh"   value="<?php echo  $date_1_kesh ;?>" />
                   <input type="hidden" name="date_2_kesh"       value="<?php echo  $date_2_kesh ;?>" />
                   <input type="hidden" name="date_1_bar"  value="<?php echo $date_1_bar ;?>" />
                   <input type="hidden" name="date_2_bar"  value="<?php echo $date_2_bar ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="group_cod"  value="<?php echo $group_cod ;?>" />
                   <input type="hidden" name="mah_cod"  value="<?php echo $mah_cod ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="15%" bgcolor="#006699">عملکرد در هکتار<br />
                <span class="style2">تن/عدد/اصله/گلدان/شاخه</span></td>
          <td width="10%" bgcolor="#006699">میزان تولید<br />
            <span class="style2">تن/عدد/اصله/گلدان/شاخه</span></td>
          <td width="12%" bgcolor="#006699">سطح زیر کشت <br />
            <span class="style2">مترمربع</span></td>
          <td width="11%" bgcolor="#006699">نام محصول</td>
          <td width="20%" bgcolor="#006699">گروه محصولات</td>
          <td width="9%" bgcolor="#006699">نوع کاشت</td>
          <td width="18%" bgcolor="#006699"><?php if($id_ostan1=='-1') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
          <td width="5%" bgcolor="#006699">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['no_kesht']=="1")  $v_no_kesht = 'گلخانه'  ;
if($row['no_kesht']=="2")  $v_no_kesht = 'فضای باز' ;
  ?>
          <td height="25" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['m_tol'] / ($row['s_kesh']/10000)),2) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tol'],4)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesh']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_green($row['mah_cod']) ; ?><br /></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo group_name_green($row['group_cod']) ; ?><br /></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesht ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($id_ostan1=='-1') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$row['id_ostan'])  ; ?></td>
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
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Greenh_rep4.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_kesht"   value="<?php echo  $no_kesht ;?>" />
        <input type="hidden" name="y_prod"     value="<?php echo $y_prod ;?>" />
        <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
        <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
        <input type="hidden" name="date_1_kesh"   value="<?php echo  $date_1_kesh ;?>" />
        <input type="hidden" name="date_2_kesh"       value="<?php echo  $date_2_kesh ;?>" />
        <input type="hidden" name="date_1_bar"  value="<?php echo $date_1_bar ;?>" />
        <input type="hidden" name="date_2_bar"  value="<?php echo $date_2_bar ;?>" />
        <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
        <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
        <input type="hidden" name="group_cod"  value="<?php echo $group_cod ;?>" />
        <input type="hidden" name="mah_cod"  value="<?php echo $mah_cod ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Greenh_rep4.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_kesht"   value="<?php echo  $no_kesht ;?>" />
        <input type="hidden" name="y_prod"     value="<?php echo $y_prod ;?>" />
        <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
        <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
        <input type="hidden" name="date_1_kesh"   value="<?php echo  $date_1_kesh ;?>" />
        <input type="hidden" name="date_2_kesh"       value="<?php echo  $date_2_kesh ;?>" />
        <input type="hidden" name="date_1_bar"  value="<?php echo $date_1_bar ;?>" />
        <input type="hidden" name="date_2_bar"  value="<?php echo $date_2_bar ;?>" />
        <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
        <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
        <input type="hidden" name="group_cod"  value="<?php echo $group_cod ;?>" />
        <input type="hidden" name="mah_cod"  value="<?php echo $mah_cod ;?>" />
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
      <li class='current'><form  action="Greenh_rep4.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_kesht"   value="<?php echo  $no_kesht ;?>" />
        <input type="hidden" name="y_prod"     value="<?php echo $y_prod ;?>" />
        <input type="hidden" name="skb1"  value="<?php echo $skb1 ;?>" />
        <input type="hidden" name="skb2"  value="<?php echo $skb2 ;?>" />
        <input type="hidden" name="date_1_kesh"   value="<?php echo  $date_1_kesh ;?>" />
        <input type="hidden" name="date_2_kesh"       value="<?php echo  $date_2_kesh ;?>" />
        <input type="hidden" name="date_1_bar"  value="<?php echo $date_1_bar ;?>" />
        <input type="hidden" name="date_2_bar"  value="<?php echo $date_2_bar ;?>" />
        <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
        <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
        <input type="hidden" name="group_cod"  value="<?php echo $group_cod ;?>" />
        <input type="hidden" name="mah_cod"  value="<?php echo $mah_cod ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="Greenhous.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>