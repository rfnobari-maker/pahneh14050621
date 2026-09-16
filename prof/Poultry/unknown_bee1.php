<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_s = jdate("Y/m/d");
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$m_zan = "";
$add_abadi ="" ;
$add_city="";
$no_bee = "";
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
echo $add_abadi = $_POST["add_abadi"]; 
$m_zan = $_POST["m_zan"]; 
}
if(isset($_POST["add_city"]))
{ 
echo  $add_city = $_POST["add_city"]; 
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

$no_bee = $_POST["no_bee"]; 
if ($no_bee=='') $mess.='نوع زنبوردار را انتخاب کنید'.'<p>' ;
$tk_bo = $_POST['tk_bo'];
$tk_mo = $_POST['tk_mo'];
$comment = $_POST['comment'];
if ($tk_bo=='') $mess.='تعداد کندوی بومی را وارد کنید'.'<p>' ;
if ($tk_mo=='') $mess.='تعداد کندوی مدرن را وارد کنید'.'<p>' ;
if(!is_numeric($tk_bo))  $mess.='تعداد کندوی بومی را فقط به صورت عدد وارد کنید'.'<p>' ;
if(!is_numeric($tk_mo))  $mess.='تعداد کندوی مدرن را فقط به صورت عدد وارد کنید'.'<p>' ;
if (strlen($comment)<30) $mess.='توضیحات تکمیلی حداقل باید شامل 30 کارکتر باشد'.'<p>' ;

if ((isset($_POST['action'])) and ($mess==''))
{
if ($m_zan=='abadi') {
 
 $query = "SELECT add_abadi,id_ostan,id_city,id_mar from list_abadi where add_abadi = :add_abadi"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute(array(':add_abadi'=>$add_abadi));
 $found = $stmt -> rowCount();
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $add_abadi = $row["add_abadi"]; 
   $add_city = '-'; 
   $id_ostan = $row["id_ostan"]; 
   $id_city = $row["id_city"]; 
   $id_mar = $row["id_mar"]; 
}
if  ($m_zan=='shahr') {
 
 $query = "SELECT add_city,id_ostan,id_mar, from list_city where add_city = :add_city"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute(array(':add_city'=>$add_city));
 $found = $stmt -> rowCount();
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 $add_city = $row["add_city"]; 
 $add_abadi = '-'; 
 $id_ostan = $row["id_ostan"]; 
 $id_city = $row["id_city"]; 
 $id_mar = $row["id_mar"]; 
}
    $mor_cod_m = $login_session ;
	$no_zan = $no_bee ;
	$sal = '1404';
	$query = "INSERT INTO unknown_bee (date_s,sal,mor_cod_m,no_zan) VALUES(:date_s,:sal,:mor_cod_m,:no_zan)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':sal'=>$sal,':mor_cod_m'=>$mor_cod_m,':no_zan'=>$no_zan));
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات زنبورستان نا شناس ') ; 
unset($error,$date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$no_zan,$tk_mo,$tk_bo,$comment,$add_abadi,$add_city);
alert ('اطلاعات زنبورستان ناشناس با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
<script>
function autoSubmit()
{
    var formObject = document.forms['reg-form'];
    formObject.submit();
}
</script>
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
<body>
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

           <p class="style8">ثبت اطلاعات زنبورستان  ناشناس<span class="style21"><a name="1" id="1"></a></span></p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div  id="div">
             <div id="mess"><?php echo $mess ?></div>
             <form  id="reg-form" method="post" action="#1">
<table width="100%" height="97" border="0" align="center" cellpadding="0" cellspacing="0"  >
               <tr>
                 <td width="38%" height="93"><p style="text-align: right">
                   <?php if ($m_zan == 'shahr') { ?>
                   <select  name="add_city"  style="width:170px ; height:40px" dir="rtl"   onchange="this.form.submit()" >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                     <?php }?>
                   </select>
                   <?php }?>
                   <?php if ($m_zan == 'abadi') { ?>
                   <select dir="rtl"  name="add_abadi"  class="required" style="width:170px ; height:40px"  onchange="this.form.submit()" >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                   <?php }?>
                 </p></td>
                 <td width="20%"><?php if ($m_zan == 'shahr') { ?>
                   : نام شهر
                   <?php } 
                            if ($m_zan == 'abadi') { ?>
                   : نام آبادی
                   <?php }
				   	  ?></td>
                 <td width="19%"><p style="text-align: right">شهر
                   <input type="radio"  class="red" name="m_zan" <?php if ($m_zan == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onChange="autoSubmit();" />
                 </p>
                   <p style="text-align: right"> آبادی
                     <input type="radio" class="red" name="m_zan" <?php if ($m_zan == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onChange="autoSubmit();" />
                  </p></td>
                 <td width="23%" class="normalTextSmall"> : موقعیت زنبورستان</td>
               </tr>
             </table>
            </form>
            <form id="form" name="form1" action="" method="post" >
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  >
                 <tr>
                   <td colspan="2"><p style="text-align: right"> بومی <span class="style2">ساکن شهرستان</span>
                     <input type="radio" class="red" name="no_bee" <?php if ($no_bee == '1') { ?>checked='checked' <?php } ?> value="1"  />
                   </p>
                     <p style="text-align: right"> مهاجر <span class="style2">از سایر استان یا شهرستان ها</span>
                       <input type="radio" class="red" name="no_bee" <?php if ($no_bee== '2') { ?>checked='checked' <?php } ?> value="2" />
                     </p></td>
                   <td><p>: نوع زنبور دار</p></td>
                 </tr>
                 <tr>
                   <td width="68%" height="42" style="text-align: right">
      <input type="text" name="tk_bo" id="tk_bo" class=" required input_text" value="<?php echo $tk_bo ;?>" style="width:75px ; height:30px" /></td>
                   <td width="9%" style="text-align: right">: بومی</td>
                   <td width="23%" rowspan="2">تعداد کندوی</td>
                 </tr>
                 <tr style="text-align: right">
             <td height="43" style="text-align: right">
   <input type="text" name="tk_mo" id="tk_mo" class="input_text" value="<?php echo $tk_mo ;?>" style="width:75px ; height:30px" /></td>
                   <td height="43" style="text-align: right">: مدرن</td>
                  </tr>
                 <tr>
                   <td height="111" style="text-align: right"> 
                   <textarea class="input_text" name="comment" id="comment" cols="60" rows="8"><?php echo $comment ;?></textarea></td>
                   <td height="111" colspan="2"> : توضیحات تکمیلی<br />
                     <span class="style2">مشخصه کندوهای شمارش شده</span></td>
                  </tr>
                 <tr>
                   <td height="107"  colspan="3">
 <input name="action" type="submit" value="ثبت "  style="width:120px ; height:35px ; color:#036 ; font-family:Tahoma"  />
                     <input type="hidden" name="m_zan" value="<?php echo $m_zan ;?>" />
                     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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

$query = "SELECT end_bee from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
// غیر فعال کردن تغییرات و حذف 
// if($end_bee == '3') 
if ('3' > '3') 
{
 alert (' مهلت ثبت اطلاعات زنبورستان به پایان رسیده است ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
//
<?php  }
//if ($end_bee=='1')
if ('3' > '3') 
{
alert (' خاتمه عملیات ثبت اطلاعات شما قبلا گزارش شده است') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
