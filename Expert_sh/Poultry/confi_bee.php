<?php 
include('../../lock_expsh.php');
include('../../event.php');
include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<?
include('../../login/config.php');
$query = "SELECT * FROM  users WHERE  id_city = '$id_city' and  S_access = '2'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1">تایید اطلاعات سرشماری زنبورستان های  مراکز جهاد کشاورزی شهرستان </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="98%" height="145" border="1" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="4" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999">تعداد کندو</td>
    <td width="9%" rowspan="2" bgcolor="#999999">تعداد زنبورستان</td>
    <td height="56" colspan="3" bgcolor="#999999">مشخصات رئیس مرکز</td>
    <td width="12%" rowspan="2" bgcolor="#999999">نام مرکز </td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">مدرن</td>
    <td bgcolor="#999999">بومی</td>
    <td width="15%" height="43" bgcolor="#999999">نام خانوادگی</td>
    <td width="9%" bgcolor="#999999">نام</td>
    <td width="6%" bgcolor="#999999">تصویر</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td  width="7%" height="58" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller">
    <form  action="../send_sms.php" method="post" onsubmit="target_popup(this)">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
    <button><img src="../../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
    </form></td>
<td   width="7%" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller">
    <form  action="../send_pm.php" method="post">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
    </form>
</td>
         <?php if((mar_status($row['id_mar'])=='1') and (mar_status2($row['id_mar'])=='2') and (mar_status3($row['id_mar'])=='2') ) {?>
               <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
                <form  action="notok_bee.php" method="post">
                 <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
                 <button><img src="../../files/return.png" border="0"  title="عدم تایید اطلاعات مرکز و درخواست اصلاح " width="55" height="44" /></button>
               </form></td>
               <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
                 <form  action="ok_bee.php" method="post">
                 <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
                 <button><img src="../../files/coniform.png" border="0"  title="تایید اطلاعات ثبت شده مرکز " width="55" height="44" /></button>
               </form></td>
            <?php } ?>

     <?php if((mar_status($row['id_mar'])=='2') and (mar_status3($row['id_mar'])=='2')) {?>
               <td colspan="2"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
              <img src="../../files/lock.gif" width="32" height="32" title="بعلت عدم تایید اطلاعات کلیه مروجین ، امکان تایید وجود ندارد"  alt=""/></td>
            <?php } ?>
      <?php if(mar_status2($row['id_mar'])=='1') {?>
              <td colspan="2"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
              <img src="../../files/ok.png" width="32" height="32" title="اطلاعات مرکز قبلاً تایید شده است"  alt=""/><br></td>
            <?php } ?>
      <?php if(mar_status3($row['id_mar'])=='1') {?>
      <td colspan="2"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
      <img src="../../files/notok.png" width="32" height="32" title="عدم تائید اطلاعات مرکز قبلاً ثبت شده است"  alt=""/><br></td>
            <?php } ?>


    <td width="7%"  class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_kol_kmo($row['id_mar'])?></td>
    <td width="7%" class="normalTextSmaller"  <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_kol_kbo($row['id_mar'])?></td>
    <td class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_bee_count($row['id_mar'])?></td>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../../files/users/<? echo $pic ?>" width="40" height="49"  alt=""/></span></td>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['markaz'];?><br />
      <?php echo $row['id_mar'];?> <br /></td>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
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
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>




