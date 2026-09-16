<?php
include("../../lock_oce.php");
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
           <p align="center" class="style8"  >اعلام خاتمه  سرشماری زنبورستان های استان</p>
           <table width="75%" border="0" align="center">
             <tr>
               <td height="44" class="style8" style="text-align: right"><p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                 <p>همکار  گرامی </p></td>
             </tr>
             <tr>
               <td height="93" style="font-family:Tahoma ; direction:rtl ; text-align:justify ; color:#069 ; line-height:200%" > کلیک دکمه تایید ،  به معنی اعلام خاتمه عملیات سرشماری زنبورستان های استان بوده و بعد از آن هر گونه ثبت ، تغییر و حذف غیر ممکن خواهد بود  ، در صورتی که از تکمیل اطلاعات سرشماری زنبورستان های استان  مطمئن هستید کلید تایید و در غیر اینصورت از کلید انصراف استفاده نمایید .</td>
             </tr>
             <tr>
               <td height="61"><p>&nbsp;</p>
                 <form action="" method="post" name="fsend" id="fsend">
                   <input type="submit" name="cancel" id="submit2" value="انصراف" style="width:150px ; height:45px"  title="انصراف از ارسال"/>
                   <input type="submit" name="send" id="submit1" value="تایید" style="width:150px ; height:45px" title="ارسال درخواست " />
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
$query = "SELECT id from users where S_access = '1' and id_ostan = '$id_ostan' and con_city !='1' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_con_city = $stmt -> rowCount();
if ($count_con_city == 0)
{
    $query = "SELECT id from users where S_access = '1' and id_ostan = '$id_ostan' and con_ostan !='1' ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $count_row = $stmt -> rowCount();
      if ($count_row > 0)
        {
         $query = "UPDATE  users SET con_ostan=?,date_con_ostan=? where id_ostan = ? " ;
         $q = $dbh->prepare($query);
         $q->execute(array('1',$date_edit,$id_ostan));
         sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','گزارش خاتمه عملیات سرشماری زنبورستان های استان',$id_ostan) ; 
         alert (' خاتمه عملیات ثبت سرشماری زنبورستان  استان با موفقیت ثبت شد ') ;
         }
      else 
        {
        alert (' خاتمه عملیات سرشماری استان قبلا گزارش شده است') ;
        }
}
else 
{
  alert ('خطا!! \n \n بعلت عدم تایید کلیه مدیران شهرستان ، امکان تایید اطلاعات استان مقدور نمیباشد') ;
?>
<form  name="myform" class="myform" method="post" action="../bee2.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
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
<?php }?>