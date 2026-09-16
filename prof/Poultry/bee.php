<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
$m_zan = "";
$add_abadi ="" ;
$add_city="";
$no_bee = "";
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
if(isset($_POST["m_zan"]))
{ 
$m_zan = $_POST["m_zan"]; 
}
if(isset($_POST["add_abadi"]))
{ 
$add_abadi = $_POST["add_abadi"]; 
$m_zan = $_POST["m_zan"]; 
}
if(isset($_POST["add_city"]))
{ 
 $add_city = $_POST["add_city"]; 
 $m_zan = $_POST["m_zan"]; 

}
 if (isset($_POST['action'])) 
 {  
$m_zan = $_POST["m_zan"]; 
if ($m_zan=='') $mess='موقعیت زنبورستان را انتخاب کیند '.'<p>' ;
$add_city = $_POST["add_city"]; 
if ($m_zan=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_zan=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

$bah_cod_m = $_POST['bah_cod_m'];
if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
$no_bee = $_POST["no_bee"]; 
if ($no_bee=='') $mess.='نوع زنبوردار را انتخاب کنید'.'<p>' ;
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT num_bah FROM  bah where bah_cod_m = '$bah_cod_m'";
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_pm = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$num_bah = $row['num_bah'] ; 
  if ($count_pm > 1) {
            ?>
            <form name="myform1" class="myform" method="post" action="bah_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo $num_bah; ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                <input type="hidden" name="no_bee" value="<?php echo $no_bee; ?>"/>
                <input type="hidden" name="m_zan" value="<?php echo $m_zan ;?>" />
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
if ($count_pm ==0) { $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات زنبورستان ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ; 
$not_found_bah= true ;
}
else
{
$query = "SELECT id from bee where bah_cod_m = '$bah_cod_m' and sal = '1404'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($count_codm > 0) { 
?>
	 <form name="myform1" class="myform" method="post" action="bee_history.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="no_bee" value="<?php echo $no_bee ;?>" />
           <input type="hidden" name="m_zan" value="<?php echo $m_zan ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// $num_bah = $row['num_bah'] ; 
?>
	 <form name="myform1" class="myform" method="post" action="bee_data.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="no_bee" value="<?php echo $no_bee ;?>" />
           <input type="hidden" name="m_zan" value="<?php echo $m_zan ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
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
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
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

           <p class="style8">ثبت اطلاعات زنبورستان  جدید<br />
            <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div id="div">
            <div id="mess"><?php echo $mess ?>
                          </div>
           <form id="form" name="form1" action="" method="post" >
             <table width="100%" height="97" border="0">
               <tr>
                 <td width="38%" height="93"><p style="text-align: right">
                   <select  id="add_city" name="add_city"  class="input_text" style="width:170px ; height:40px ; display:none" dir="rtl"    >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  mor_cod_m = '$login_session'"  ;
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
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  mor_cod_m = '$login_session'"  ;
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
                 <td width="24%" class="normalTextSmall"> : موقعیت زنبورستان<a name="1" id="1"></a></td>
               </tr>
             </table>
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
   <td width="73%" align="right">   <div align="right">
                      <input name="bah_cod_m"  class="required" type="text" value="<?php echo $bah_cod_m ;?>"/>
   </div> </td>
                   <td width="27%"> : کد ملی زنبور دار </td>
                 </tr>
                 <tr>
                   <td><p style="text-align: right"> غیرمهاجر
                     <input type="radio" class="red" name="no_bee" <?php if ($no_bee == '1') { ?>checked='checked' <?php } ?> value="1"  />
                     <br />
                     <span class="style2">زنبورستان  های بومی منطقه </span></p>
                     <p style="text-align: right"> مهاجر
                       <input type="radio" class="red" name="no_bee" <?php if ($no_bee== '2') { ?>checked='checked' <?php } ?> value="2" />
                       <br />
                      <span class="style2">زنبورستان  های که از سایر شهرستان های  استان  یا استان های دیگر  به موقعیت فعلی کوچ کردند</span></p></td>
                   <td> <p>: نوع زنبور دار</p></td>
                 </tr>
                 <tr>
                   <td height="107"  colspan="2">
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
include('../../login/config.php');
$query = "SELECT end_bee from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
if ($end_bee=='5')
//if ('1'=='1')
{
alert (' خطا !! \n  خاتمه عملیات قبلاً گزارش شده است ، در صورت عدم تایید رئیس مرکز مجددا قادر به ثبت خواهید بود ') ;
//alert (' خطا !! \n امکان ثبت بعلت عدم شروع سرشماری مقدور نمیباشد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
else 
if ($end_bee=='3')
//if ($login_session !='1080007628 ')
//if ('3'>'3')
{
alert (' خطا !! \n مهلت ثبت اطلاعات آمارگیری زنبورستان ها به اتمام رسیده است  ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
else
//if (($end_bee=='1') or ($end_bee=='3'))
if ('3' == '3') 
//if ('3'>'3')
//if ( $login_session !='1080007628 ' )
{
alert ('مهلت ثبت به اتمام رسیده است ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
?>
<script>
   $('#sub').click(function () {
        $('#rasul').css('display', 'block').delay(400).fadeIn(3000);
    });

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