<?php
require_once("../lock_ce.php");
require_once("../event.php");
require_once('side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <style>
    #box
	{ box-shadow:10px 10px 5px #999 ; width:700px ; background-color:#CCC ; 
	margin:auto; border:1px solid #003399  ; border-radius: 10px ;  
	}
    #img1
    {
	border-radius:40px ; 
	}
 </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
   <?php 
 if (isset($_POST['id']) and isset($_POST['s_user'])) 
  {  
$id = $_POST['id'] ; 
$s_user = $_POST['s_user'] ; 
$list_ru_read = isset($_POST['list_ru_read']) ? $_POST['list_ru_read'] : '';
$order_field = isset($_POST['order_field']) ? $_POST['order_field'] : 's_date';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'desc';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 1;
if ($page_id < 1) $page_id = 1;
$list_q = isset($_POST['list_q']) ? $_POST['list_q'] : '';
$back_qs = 'id=' . (int)$page_id
    . '&ru_read=' . urlencode($list_ru_read)
    . '&order_field=' . urlencode($order_field)
    . '&order_by=' . urlencode($order_by);
if ($list_q !== '') {
    $back_qs .= '&q=' . urlencode($list_q);
}
$query = "SELECT * from pm where id = $id and s_user = '$s_user'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$title   = $row['title'] ; 
$s_user  = $row['s_user'];
$r_user  = $row['r_user']; 
$message = $row['message']; 
$file = $row['file'] ;
?>
 <?php if (isset($_POST['reply1'])) 
  {  
?>
	 <form name="reply" class="reply" method="post" action="reply_pm.php#1">
      <input type="hidden" name="username" value="<?php echo $row['s_user'] ;?>" />
      <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['title']) ;?>" />
      <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
      <input type="hidden" name="re_message" value="<?php echo htmlspecialchars($row['message']) ;?>" />
      <input type="hidden" name="s_date" value="<?php echo $row['s_date'] ;?>" />
      <input type="hidden" name="s_time" value="<?php echo $row['s_time'] ;?>" />
      <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
      <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
      <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
      <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
      <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
  }
  ?>
 <?php if (isset($_POST['reply2'])) 
  {  
?>
	 <form name="reply" class="reply" method="post" action="forward.php#1">
      <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
      <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
      <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
      <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
      <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
      <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
  }
  ?>

 </p>
 <p>مشاهده پیام <span class="style21"><a name="1" id="1"></a></span></p>
   <form action="" method="post"  id="form1" name="form1" >
     <div id="box">
         <table width="95%" border="0" align="center">
           <tr>
             <td height="88"><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo user_pic($s_user) ?>" width="57" height="64"  alt=""/></span></td>
             <td><div align="right">
               <input name="title2" type="text" class="input_text" id="title2" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo user_name($s_user).'&nbsp;&nbsp;/&nbsp;&nbsp;'.$s_user;?>" maxlength="250" readonly="readonly" xml:lang="fa" />
             </div></td>
             <td><div align="right">: <span class="style8">فرستنده</span></div></td>
           </tr>
          <tr>
            <td width="376" height="72" colspan="2"><div align="right">
              <input name="title" type="text" class="input_text" id="title" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $title?>" maxlength="250" readonly="readonly" xml:lang="fa" />
              </div></td>
            <td width="105"><div align="right">: موضوع پیام </div></td>
          </tr>
   <tr>
     <td height="92" colspan="2"><div align="right">
       <textarea name="message" cols="55" rows="10" readonly="readonly" class="input_text" id="textarea" style="font-size:13px" dir="rtl"><?php echo $message ?></textarea>
     </div></td>
     <td><div align="right" >:متن پیام</div></td>
   </tr>
   <tr>
     <td height="37" colspan="2"><div align="right">
       <?php if ($file<>'') { ?>
     <a href="../pm_files/<?php echo $file ?>"  target="new"  title="مشاهده پیوست" style="text-align: right"><img src="../files/reports.png" width="64" height="59"  alt=""/></a>
     <?php }?>
     </div></td>
     <td><div align="right">:فایل پیوستی</div></td>
   </tr>
    </table>
        <p>&nbsp;</p>
        <table width="400" border="0" align="center">
          <tr>
            <td>&nbsp;</td>
            <td>
              <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
              <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
              <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
              <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
              <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
              <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
              <button name="reply2" style="width:200px ; height:45px ; font-family:Tahoma ; font-size: 14px" >انتقال پیام</button></td>
            <td>&nbsp;</td>
            <td>
              <button name="reply1" style="width:200px ; height:45px ; font-family:Tahoma ; font-size: 14px" >ارسال پاسخ</button></td>
          </tr>
             </table>
           

        <p>&nbsp;</p>
       </div>
    </form>
    <p align="center" style="margin-top:20px;">
      <a href="messanger.php?<?php echo htmlspecialchars($back_qs); ?>" style="font-family:Tahoma; font-size:14px; color:#069;">&laquo; بازگشت به لیست پیام‌ها</a>
    </p>
 <?php
 }
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
  ?>  
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>