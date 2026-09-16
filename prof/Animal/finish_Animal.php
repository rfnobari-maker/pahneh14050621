<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
}
.tricky_image {
	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}

.tricky_image:hover {
    opacity:0.2;
    filter:alpha(opacity=20);
}
</style>
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
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  >اعلام خاتمه ثبت اطلاعات دام های تحت پوشش </p>
           <table width="75%" border="0" align="center">
             <tr>
               <td height="44" class="style8" style="text-align: right"><p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                 <p>همکار  گرامی </p></td>
             </tr>
             <tr>
               <td height="93" style="font-family:Tahoma ; direction:rtl ; text-align:justify ; color:#069 ; line-height:200%" >بعد از کلیک دکمه تایید ،  <span class="style9">ثبت اطلاعات جدید ، تغییر و همچنین حذف اطلاعات دام  ، امکان پذیر نخواهد بود </span>، در صورتی که از خاتمه آمارگیری دام های تحت پوشش خود مطمئن هستید کلید <span class="style9">تایید </span>و در غیر اینصورت  کلید <span class="style9">انصراف </span>را کلیک نمایید.</td>
             </tr>
             <tr>
               <td height="61"><p>&nbsp;</p>
                 <form action="" method="post" name="fsend" id="fsend">
                   <input type="submit" name="cancel" id="submit2" value="انصراف" style="width:150px ; height:45px"  title="انصراف از ارسال"/>
                   <input type="submit" onclick="return confirm('از خاتمه عملیات ثبت دام های تحت پوشش خود مطمئن هستید ؟ ')" name="send" id="submit1" value="تایید" style="width:150px ; height:45px" title="ارسال درخواست " />
                 </form>
                 </p>
                 </p>
</td>
             </tr>
           </table>           <p class="style9">&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>
<?php if(isset($_POST['send'])) { ;
 include('../../login/config.php');
$query = "SELECT end_dam from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_dam =  $row['end_dam'] ; 
if ($end_dam=='' or $end_dam=='3')
{
$query = "UPDATE  users SET end_dam=?,date_end_dam=?,con_center=? where username = $login_session " ;
$q = $dbh->prepare($query);
$q->execute(array('1',$date_edit,''));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','گزارش خاتمه عملیات ، ثبت اطلاعات سرشماری دام ',$id_ostan) ; 
alert (' خاتمه عملیات ثبت اطلاعات سرشماری دام با موفقیت ثبت شد ') ;
}
else 
{
alert (' خاتمه عملیات شما قبلا گزارش شده است') ;
}
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
?>
<?php
if (isset($_POST['cancel']))
{
?>
<script>
window.location.href='index.php';
</script>
<?php } 
//alert (' مهلت اعلام خاتمه عملیات به پایان رسیده است ') ;
//<form  name="myform" class="myform" method="post" action="index.php">
//</form>
//<script type="text/javascript">document.myform.submit();</script>
