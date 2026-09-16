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
 include('../../login/config.php');
 $query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
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
 include('../../login/config.php');
 $query = "SELECT * from list_city where add_city = :add_city"; 
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
	$query = "INSERT INTO unknown_bee (date_s,mor_cod_m,no_zan,id_ostan,id_city,id_mar,tk_mo,tk_bo,comment,add_abadi,add_city) VALUES(:date_s,:mor_cod_m,:no_zan,:id_ostan,:id_city,:id_mar,:tk_mo,:tk_bo,:comment,:add_abadi,:add_city)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_zan'=>$no_zan,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':tk_mo'=>$tk_mo,':tk_bo'=>$tk_bo,':comment'=>$comment,':add_abadi'=>$add_abadi,':add_city'=>$add_city));

// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات زنبورستان نا شناس ',$id_ostan) ; 
unset($error,$date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$no_zan,$tk_mo,$tk_bo,$comment,$add_abadi,$add_city);
alert ('اطلاعات زنبورستان ناشناس با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="../index.php">
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
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
    <link rel="stylesheet" href="../reza_2.css">
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
  <?php include('top.php'); ?>
    <td width="840" >

           <p class="style8">ثبت تغییر کاربری اراضی کشاورزی<span class="style21"><a name="1" id="1"></a></span></p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div  id="div1">
             <div id="mess"><?php echo $mess ?></div>
             <form  id="reg-form" method="post" action="#1">
<table width="100%" height="40" border="0" align="center" cellpadding="0" cellspacing="0"  >
               <tr>
           <td width="72%" height="40"><p style="text-align: right">
                   
                   <select dir="rtl"  name="add_abadi"  class="required" style="width:170px ; height:40px"  onchange="this.form.submit()" >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = $login_session"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<? echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <? echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                       </p></td>
                 <td width="28%">
                   : نام آبادی
</td>
                 </tr>
             </table>
             </form>
             <form action="" method="post" enctype="multipart/form-data" name="form1" id="form" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  >
                 <tr>
                   <td height="39" colspan="3" style="text-align: right"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                     <tr>
                       <td height="51" colspan="6" bgcolor="#FFCC99">مشخصات فرد تغییر دهنده کاربری اراضی کشاورزی</td>
                       </tr>
                     <tr>
                       <td height="47" style="text-align: center"><input type="text" name="tk_bo3" id="tk_bo3" class="required input_text" value="<?php echo $tk_bo ;?>" style="width:120px ; height:30px" /></td>
                       <td class="normalTextSmall" style="text-align: center">:کد ملی </td>
                       <td align="right" style="text-align: center"><input type="text" name="tk_bo2" id="tk_bo2" class="required input_text" value="<?php echo $tk_bo ;?>" style="width:120px ; height:30px" /></td>
                       <td class="normalTextSmall" style="text-align: center">:نام خانوادگی</td>
                       <td style="text-align: center"><input type="text" name="tk_bo" id="tk_bo" class=" required input_text" value="<?php echo $tk_bo ;?>" style="width:100px ; height:30px" /></td>
                       <td class="normalTextSmall" style="text-align: center"> : نام </td>
                       </tr>
                     <tr>
                       <td height="50" colspan="6" bgcolor="#FFCC99">مشخصات زمین</td>
                       </tr>
                     <tr>
                       <td width="18%" height="53"><input type="text" name="tk_bo6" id="tk_bo6" class="required input_text" value="<?php echo $tk_bo ;?>" style="width:120px ; height:30px" /></td>
                       <td width="14%"><span class="normalTextSmall">:میزان تغییر کاربری<br />
                         </span><span class="style2">متر مربع </span></td>
                       <td width="18%"><select dir="rtl"  name="add_abadi3"  class="required input_text" style="width:100px ; height:40px">
                         <option value="" >انتخاب کنید</option>
                         <option value="">آبی</option>
                         <option value="">دیم</option>
                       </select></td>
                       <td width="23%"><span class="normalTextSmall"> : نوع اراضی </span></td>
                       <td width="14%">
                      <select dir="rtl"  name="add_abadi2"  class="required input_text" style="width:100px ; height:40px" > 
                      <option value="" >انتخاب کنید</option>
                      <option value="" selected="selected">زراعی</option>
                      <option value="" selected="selected">باغی</option>
                       </select></td>
                       <td width="13%"><span class="normalTextSmall"> : نوع زمین</span></td>
                     </tr>
                     <tr>
                       <td height="54"><input type="text" name="tk_bo9" id="tk_bo9" class="required input_text" value="<?php echo $tk_bo ;?>" style="width:120px ; height:30px" /></td>
                       <td height="54"><span class="normalTextSmall">: عرض جغرافیایی</span></td>
                       <td height="54"><input type="text" name="tk_bo8" id="tk_bo8" class="required input_text" value="<?php echo $tk_bo ;?>" style="width:120px ; height:30px" /></td>
                       <td height="54"><span class="normalTextSmall"> : طول جغرافیای</span></td>
                       <td colspan="2" bgcolor="#FFCC99"><span class="normalTextSmall">: مختصات زمین</span></td>
                       </tr>
                     <tr>
                       <td colspan="4"><p>
                         <textarea class="input_text" name="comment2" id="comment2" cols="60" rows="8"><?php echo $comment ;?></textarea>
                       </p>
                         <br/>
                       </td>
                       <td colspan="2" class="normalTextSmall"> : آدرس دقیق محل</td>
                     </tr>
                     <tr>
                       <td height="47" colspan="6" bgcolor="#FFCC99"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" >
                         <tr>
                           <td width="85" height="55" align="center" bgcolor="#FFFFFF"><input type="submit" name="del_sh"  value="حذف تصویر"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic1 = '../files/ok.png' ;
		 if ($row['sh']=="")
		{
		$pic1 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                           <td width="72" align="center" bgcolor="#FFFFFF"><img src="<?php echo $pic1 ;?>" width="39" height="39"  alt=""/></td>
                           <td width="73" height="55" align="center" bgcolor="#FFFFFF"><span class="up_row">
                             <?php if($row['sh']<>""){?>
                             <a href="<?php echo 'savefiles/'.$id.'/'.$row['sh'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo 'savefiles/'.$id.'/'.$row['sh'];?>" width="30" height="50"/></a>
                             <?php }?>
                           </span></td>
                           <td width="301" height="55" bgcolor="#FFFFFF"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['sh']<>"") { echo ' disabled="disabled"';}?>/>
                             <input type="file" name="sh"  accept=".jpg,.jpeg,.gif,.png" />
                             <input type="hidden" name="no_file" value="sh" />
                             <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                           <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
                           <td width="193" align="center" bgcolor="#FFCC99">:تصویر محل</td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr>
                       <td height="47" colspan="6" bgcolor="#FFCC99">نوع تغییر کاربری</td>
                       </tr>
                     <tr>
                       <td height="40" colspan="6"><table align="center" cellpadding="0" cellspacing="0" class="input_text">
                         
                         <tr>
                           <td width="331" height="31" style="text-align: right" dir="rtl">&nbsp;عبور شبکه‎های برق</td>
                           <td width="24" style="text-align: left"><input type="checkbox" class="red"name="checkbox" id="checkbox" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;برداشت یا افزایش    شن و ماسه</td>
                           <td width="28" style="text-align: left"><input type="checkbox" class="red"name="checkbox" id="checkbox" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;انتقال و تغییر    حقابه اراضی زارعی و باغات به سایر اراضی و فعالیت‎های غیر کشاورزی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox2" id="checkbox2" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;ایجاد بنا و    تأسیسات</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox2" id="checkbox2" /></td>
                         </tr>
                         <tr>
                           <td width="331" style="text-align: right" dir="rtl">&nbsp;سوازندن، قطع و    ریشه کنی و خشک کردن باغات به هر طریق</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox3" id="checkbox3" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;خاکبرداری و    خاکریزی</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox3" id="checkbox3" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="37" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;مخلوط ریزی و شن    ریزی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox4" id="checkbox4" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;گود برداری</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox4" id="checkbox4" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="40" style="text-align: right" dir="rtl">&nbsp;احداث راه‎آهن و    فرودگاه</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox5" id="checkbox5" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;احداث کوره‎های آجر    و گچ‎پزی</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox5" id="checkbox5" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="38" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;احداث پارک و فضای    سبز.</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox6" id="checkbox6" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;پی کنی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox6" id="checkbox6" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="41" style="text-align: right" dir="rtl">&nbsp;پیست‎های ورزشی</td>
                           <td style="text-align: left"><input name="checkbox7" type="checkbox" class="red" id="checkbox7" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;دیوار کشی اراضی</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox7" id="checkbox7" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استخرهای ذخیره آب    غیر کشاورزی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox8" id="checkbox8" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دپوی زباله، نخاله    و مصالح ساختمانی، شن و ماسه و ضایعات فلزی.</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox8" id="checkbox8" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="40" style="text-align: right" dir="rtl">&nbsp;احداث پارکینگ مسقف    و غیرمسقف</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox9" id="checkbox9" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;ایجاد سکونتگاههای    موقت</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox9" id="checkbox9" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">محوطه سازی (شامل سنگفرش    و آسفالت کاری، جدول گذاری، سنگ ریزی و موارد مشابه)</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox10" id="checkbox10" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استقرار کانکس و    آلاچیق</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox10" id="checkbox10" /></td>
                         </tr>
                         <tr>
                           <td width="331" style="text-align: right" dir="rtl">&nbsp;صنایع تبدیلی و    تکمیلی و غذایی و طرح‎های موضوع تبصره 4 فوق‎الذکر.</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox11" id="checkbox11" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;احداث جاده و راه</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox11" id="checkbox11" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;صنایع دستی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox12" id="checkbox12" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دفن زباله‎های    واحدهای صنعتی</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox12" id="checkbox12" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="49" style="text-align: right" dir="rtl">&nbsp;طرح‎های خدمات    عمومی</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox13" id="checkbox13" /></td>
                           <td width="343" style="text-align: right" dir="rtl">&nbsp;رها کردن پساب‎های    واحدهای صنعتی، فاضلاب‎های شهری، ضایعات کارخانجات</td>
                           <td style="text-align: left"><input type="checkbox" class="red"name="checkbox13" id="checkbox13" /></td>
                         </tr>
                         <tr>
                           <td width="331" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;طرح‎های تملک    دارایی‎های سرمایه‎ای مصوب مجلس شورای اسلامی (ملی – استانی).</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox14" id="checkbox14" /></td>
                           <td width="343" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;لوله گذاری</td>
                           <td bgcolor="#CCCCCC" style="text-align: left"><input type="checkbox" class="red"name="checkbox14" id="checkbox14" /></td>
                         </tr>
                       </table></td>
                       </tr>
                     <tr>
                       <td height="40" colspan="6"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                         <tr>
                  <td width="73%" height="141"><textarea class="input_text" name="comment" id="comment" cols="60" rows="8"><?php echo $comment ;?></textarea></td>
                           <td width="27%">: سایر موارد با ذکر توضیح</td>
                           </tr>
                         </table></td>
                     </tr>
                    </table></td>
                 </tr>
                 <tr>
                   
                 </tr>
                 <tr>
                   <td height="107"  colspan="3">
                     <br />
                     <p>&nbsp; </p>
                     <p>
                       <input name="action" type="submit" value="ثبت و ارسال"  style="width:120px ; height:35px ; color:#036 ; font-family:Tahoma"  />
                       <input type="hidden" name="m_zan" value="<?php echo $m_zan ;?>" />
                       <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                       <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                     </p>
                  </tr>
               </table>
          </form>
            </div>
           <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>
