<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
$m_zan = "";
$add_abadi ="" ;
$add_city="";
$no_kesht = "";
$bah_cod_m="";
$mess = '' ;
 if (isset($_POST['action1'])) 
 {
?>
<form name="myform" class="myform" method="post" action="../benef.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
 <?php
 }
if(isset($_POST["m_poul"]))  $m_poul = $_POST["m_poul"];  else  $m_poul = '' ;
if(isset($_POST["add_abadi"])) 
{ 
$add_abadi = $_POST["add_abadi"]; 
$m_poul = $_POST["m_poul"]; 
}
if(isset($_POST["add_city"]))
{ 
 $add_city = $_POST["add_city"]; 
 $m_poul = $_POST["m_poul"]; 
}
 if (isset($_POST['action'])) 
 {  
$m_poul = $_POST["m_poul"]; 
if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<br>' ;
$add_city = $_POST["add_city"]; 
if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<br>' ; else $mess = '' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<br>' ;

$bah_cod_m = $_POST['bah_cod_m'];
if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<br>' ;
$no_kesht = $_POST['no_kesht'];
if ($no_kesht=='') $mess.='نوع کشت را انتخاب کنید'.'<br>' ;
$no_moj = $_POST['no_moj'];
if ($no_moj=='') $mess.='نوع مجوز واحد را انتخاب کنید'.'<br>' ;
$no_mal = $_POST['no_mal'];
if ($no_mal=='') $mess.='نوع مالکیت را انتخاب کنید'.'<br>' ;
//if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ; 
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT num_bah FROM  bah where bah_cod_m = $bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_pm = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$num_bah = $row['num_bah'] ; 
  if ($count_pm > 1) {
            ?>
	 <form name="myform1" class="myform" method="post" action="bah_history2.php">
     <input type="hidden" name="m_page" value="<?php echo 'Greenhous.php' ;?>" />
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_kesht" value="<?php echo $no_kesht ;?>" />
     <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
     </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
if ($count_pm ==0) { $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره بردار ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ; 
$not_found_bah= true ;
}
else
{
$query = "SELECT count(*) from Greenhous where bah_cod_m = $bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> fetchColumn();
if ($count_codm>0) { 
?>
	 <form name="myform1" class="myform" method="post" action="Greenhous_history.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_kesht" value="<?php echo $no_kesht ;?>" />
     <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// $num_bah = $row['num_bah'] ; 
?>
	 <form name="myform1" class="myform" method="post" action="Greenhous_data99.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
           <input type="hidden" name="no_kesht" value="<?php echo $no_kesht ;?>" />
           <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />           
           <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
<!--style the error message--> 
<style type="text/css"> 
.error { 
    display: block; 
    color: red; 
    font-style: italic; 
} 
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
} 
</style> 
</head>
<body onLoad="onload()">
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
    <img src="../Agri/img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
    
</div>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
  <?php include('top.php'); ?>
    <td width="840" >

           <p class="style8">ثبت اطلاعات گلخانه  جدید<br />
            <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div id="div">
            <div id="mess"><?php echo $mess ?> </div>
           <form id="form" name="form1" action="" method="post" >
             <table width="100%" height="97" border="0">
               <tr>
                 <td width="38%" height="93"><p style="text-align: right">
                   <select  id="add_city" name="add_city"  class="input_text" style="width:170px ; height:40px ; display:none" dir="rtl"    >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                     <?php }?>
                   </select>

                    <select dir="rtl"  id="add_abadi" name="add_abadi"  class="input_text" style="width:170px ; height:40px ; display:none"   >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                 </p></td>
                 <td width="20%">
                   <div id="city_title" style="display:none">: نام شهر</div>
                   <div id="abadi_title" style="display:none">: نام آبادی</div>
				   	  </td>
                 <td width="18%"><p style="text-align: right">شهر
                   <input type="radio" id="city_select"  class="red" name="m_zan" <?php if ($m_zan == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onClick="Fun_city()" />
                 </p>
                   <p style="text-align: right"> آبادی
                     <input type="radio" id="abadi_select" class="red" name="m_zan" <?php if ($m_zan == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onClick="Fun_abadi()" />
                  </p></td>
                 <td width="24%" class="normalTextSmall"> : موقعیت گلخانه<a name="1" id="1"></a></td>
               </tr>
             </table>
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
   <td width="73%" colspan="2" align="right">   <div align="right">
                      <input name="bah_cod_m"  class="required" type="text" value="<?php echo $bah_cod_m ;?>"/>
   </div> </td>
                   <td width="27%"> : کد ملی بهره بردار</td>
                 </tr>
                 <tr>
                   <td colspan="2"><p style="text-align: right"> گلخانه
                       <input type="radio" class="red" name="no_kesht" <?php if ($no_kesht == '1') { ?>checked='checked' <?php } ?> value="1"  />
                     <br />
                     <span class="style2">سبزی و صیفی ، گل و گیاهان زینتی ، سایر محصولات گلخانه ای </span></p>
                     <p style="text-align: right"> فضای باز
                       <input type="radio" class="red" name="no_kesht" <?php if ($no_kesht== '2') { ?>checked='checked' <?php } ?> value="2" />
                       <br />
                      <span class="style2">گل و گیاهان زینتی در فضای بازد</span></p></td>
                   <td> <p>: نوع کشت</p></td>
                 </tr>
                 <tr>
                   <td align="center">&nbsp;</td>
                   <td height="55" align="center"><div align="right">
                     <select name="no_moj" class="input_text required " id="seeAnotherField3"  style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                       <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/وزارت جهاد</option>
                       <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                       <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                       <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                     </select>
                   </div></td>
                   <td><div align="right">:نوع مجوز</div></td>
                 </tr>
                 <tr>
                   <td align="center">&nbsp;</td>
                   <td height="55" align="center"><div align="right">
                     <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                       <option value="">انتخاب کنید</option>
                       <option value="0" <?php if ($no_mal=='0') { echo 'selected="selected"' ; } ?>>------</option>
                       <option value="1" <?php if ($no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                       <option value="2" <?php if ($no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                       <option value="3" <?php if ($no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                       <option value="4" <?php if ($no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                       <option value="5" <?php if ($no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                       <option value="6" <?php if ($no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                       <option value="7" <?php if ($no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                       <option value="8" <?php if ($no_mal=='8') { echo 'selected="selected"' ; } ?>>سایر</option>
                       </select>
                    </div></td>
                   <td><div align="right"> : نوع مالکیت</div></td>
                 </tr>
                 <tr>
                   <td height="107"  colspan="3">
                     <input id="sub" name="action" type="submit" value="ادامه"  />
  <?php if(isset($not_found_bah))  { ?>
                     <input name="action1" type="submit" value="ثبت اطلاعات بهره بردار"  />
                    </td>
  <?php }?>
                 </tr>
               </table>
          </form>
      </div>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
include_once('../../login/config.php');
$query = "SELECT end_bee from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
?>
<script>
    $('#sub').click(function () {
    var r = $('#rasul').css('display','block');
     r.delay(400).find(30000);
    })

  function Fun_city() {
  var checkBox_city = document.getElementById("city_select");
  if (checkBox_city.checked == true){
    add_city.style.display    = "block";
	city_title.style.display  = "block";
    abadi_title.style.display = "none";
    add_abadi.style.display   = "none";
	add_city.classList.add("required");
  }
}

  function Fun_abadi() {
  var checkBox_abadi = document.getElementById("abadi_select");
  if (checkBox_abadi.checked == true){
    add_city.style.display = "none";
    add_abadi.style.display = "block";
	city_title.style.display  = "none";
    abadi_title.style.display = "block";
	add_city.classList.add("required");
  }
}

 function onload() {

  var checkBox_city = document.getElementById("city_select");
  if (checkBox_city.checked == true){
    add_city.style.display    = "block";
	city_title.style.display  = "block";
    abadi_title.style.display = "none";
    add_abadi.style.display   = "none";
	add_city.classList.add("required");
  }
  var checkBox_abadi = document.getElementById("abadi_select");
  if (checkBox_abadi.checked == true){
    add_city.style.display = "none";
    add_abadi.style.display = "block";
	city_title.style.display  = "none";
    abadi_title.style.display = "block";
	add_city.classList.add("required");
  }
  }
</script>