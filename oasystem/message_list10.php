<?php 
include('../lock_ad.php');
include('counter.php');
include('../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
#menu
{font-family:Tahoma ; font-size:13px ; float:right ; list-style:none ; direction:rtl; width:370px ; line-height:40px 
; background:#069; margin-right:250px ; border:1px #990000; border-radius:10px} 
 #menu li
{ float:right ; padding-left:10px ; padding-right:10px}
 #menu li:hover
{ background:#06C ; line-height:45px;border-radius:10px  }

#menu li a 
{ text-decoration:none ; color:#FFF }
  #img1
    {
	border-radius:40px ; 
	}
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
      <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
      <p>
        <?php include('../login/config.php');
$query=" SELECT pm.* , users.username,users.id_ostan FROM users INNER JOIN pm ON pm.s_user = users.username
where users.id_ostan='$id_ostan'
ORDER BY s_date DESC LIMIT 1750" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <p>        <span class="style8">لیست پیام های تبادل شده در سامانه </span>
      </p>
      <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

           <table width="98%" height="127" border="1" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
    <td height="56" colspan="2" rowspan="2" bgcolor="#0099CC">عملیات</td>
    <td width="10%" rowspan="2" bgcolor="#0099CC">آخرین وضعیت</td>
    <td colspan="2" bgcolor="#0099CC">گیرنده</td>
    <td colspan="2" bgcolor="#0099CC">فرستنده</td>
    <td width="8%" rowspan="2" bgcolor="#0099CC">تاریخ</td>
    <td width="24%" rowspan="2" bgcolor="#0099CC">موضوع پیام </td>
    <td width="3%" rowspan="2" bgcolor="#0099CC">پیوست</td>
    <td width="4%" rowspan="2" bgcolor="#0099CC">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td width="14%" bgcolor="#0099CC">نام و نام خانوادگی</td>
    <td width="5%" bgcolor="#0099CC">تصویر</td>
    <td width="13%" height="33" bgcolor="#0099CC">نام و نام خانوادگی</td>
    <td width="6%" bgcolor="#0099CC">تصویر</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 if ($row['ru_read']=='1')  $v_message = 'مشاهده نشده' ; 
	 if ($row['ru_read']=='2')  $v_message = 'مشاهده '.'<br>'.$row['r_date'] ; 
	 if ($row['ru_read']=='3')  $v_message = 'ارسال پاسخ'.'<br>'.$row['r_date'] ;  ; 
	 if ($row['ru_read']=='5')  $v_message = 'انتقال'.'<br>'.$row['r_date'] ; 
	
?>
<td width="7%" height="59" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="message_del.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <button onclick="return confirm('از حذف این پیام مطمئن هستید ؟ ')"><img src="../files/del1.png" border="0"  title="حذف پیام" width="33" height="31" /></button>
  </form></td>
<td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="onmessage_view.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <input type="hidden" name="ru_read" value="<?php echo $row['ru_read'] ;?>" />
  <button><img src="../files/view.png" border="0"  title="مشاهده پیام" width="29" height="30" /></button>
    </form></td>
<td  class="style2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_message ;?></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['r_user']);?></td>
<td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img  id="img1" src="../files/users/<?php echo user_pic($row['r_user']) ?>" width="42" height="46"  alt=""/></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['s_user']);?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img  id="img1" src="../files/users/<?php echo user_pic($row['s_user']) ?>" width="42" height="46"  alt=""/></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['s_date']?></td>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['title'];?></td>
   <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if ($row['file']<>'') echo '<img src=../files/attachment.jpg width=30 height=30/>'?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
  <?php
$r++ ; 
}
?>
</table>
          <p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
</tr>
</table>
</table>
</body>
</html>


