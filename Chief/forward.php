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
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 15
    });
});
    </script>
    <style type="text/css">
.bs-example{
	font-family: Tahoma;
	position: relative;
	margin: 30px;
	text-align: center;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 16px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 14px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
    #box
	{ box-shadow:10px 10px 5px #999 ; width:600px ; background-color:#FFC ; 
	margin:auto; border:1px solid #069  ; border-radius: 20px ;  
	}
     #img1
    {
	border-radius:40px ; 
	}
 </style>
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=400,height=300,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
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
$id = isset($_POST['id']) ? $_POST['id'] : (isset($_POST['rep_id']) ? $_POST['rep_id'] : '');
$list_ru_read = isset($_POST['list_ru_read']) ? $_POST['list_ru_read'] : '';
$list_q = isset($_POST['list_q']) ? $_POST['list_q'] : '';
$order_field = isset($_POST['order_field']) ? $_POST['order_field'] : 's_date';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'desc';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 1;
if ($page_id < 1) $page_id = 1;
$back_qs = 'id=' . (int)$page_id
    . '&ru_read=' . urlencode($list_ru_read)
    . '&order_field=' . urlencode($order_field)
    . '&order_by=' . urlencode($order_by);
if ($list_q !== '') {
    $back_qs .= '&q=' . urlencode($list_q);
}
?>
           <p class="style8">جستجوی گیرنده</p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
  <form action="#1" name='myform' method="post">
    <div dir="rtl" class="bs-example">
        <p>
          <input type="text" dir="rtl" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="نام خانوادگی">
        </p>
        <p>
          <input type="submit" name="action" value="تایید" style=" margin:auto ; width:100px ; height:45px ; font-size:14px"" tabindex="9" />
          <input type="hidden" name="id" value="<?php echo $id ;?>" />
          <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
          <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
          <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
          <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
          <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
        </p>
    </div>
</form>
<p align="center"><a href="messanger.php?<?php echo htmlspecialchars($back_qs); ?>" title="برگشت به لیست"><img src="../files/goback.jpg" width="118" height="47" alt=""/></a></p>
  <?php 
 if (isset($_POST['action'])) 
    {  
//   echo $_POST['typeahead'].'<p>' ; 
//echo stristr($_POST['typeahead'],"1");
$b = strpos($_POST['typeahead'],'-').'<p>' ;
$a= strlen($_POST['typeahead']);
$c = $a - $b ;
 $cod_m =  substr($_POST['typeahead'],$b+1,$c) ;
$query = "SELECT username from users where cod_m = $cod_m ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $row['username'] ;
$id = $_POST['id'] ;
$query = "SELECT * from pm where id = $id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$title   = $row['title'] ; 
$s_user  = $row['s_user'];
$r_user  = $row['r_user']; 
$message = $row['message']; 
$file = $row['file'] ;
$s_date = $row['s_date'] ;
$s_time = $row['s_time'] ;
$rep_id = $row['id'] ;
$from = user_name($s_user) ; 
$to = user_name($r_user) ; 
$v_message =<<<EOT
---------- انتقال پیام ----------
از : $from 
به : $to    
تاریخ ارسال  :$s_date
ساعت ارسال :$s_time
متن پیام :
$message 
EOT;
///
?>
 <span class="style21"><a name="1" id="1"></a></span>
<form action="" method="post" enctype="multipart/form-data" id="form1" name="form1" >
<div id="box">
  <table width="559" border="0" align="center">
          <tr>
            <td width="145" height="79"><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo user_pic($username) ?>" width="57" height="64"  alt=""/></span></td>
            <td width="250"><div align="right">
              <input name="title2" type="text" class="input_text" id="title2" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo user_name($username).'&nbsp;&nbsp;';?>" maxlength="250" readonly="readonly" xml:lang="fa" />
              </div></td>
            <td><div align="right">: <span class="style8">گیرنده</span></div></td>
          </tr>
   <tr>
     <td height="53" colspan="2"><div align="right">
       <input name="title" type="text" class="required input_text" id="title" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $title ?>" maxlength="250" xml:lang="fa" />
       </div></td>
     <td width="150"><div align="right">  : موضوع پیام /انتقال</div></td>
   </tr>
   <tr>
     <td height="104" colspan="2"><div align="right">
       <textarea name="message" class="required" id="textarea" cols="45" rows="5" style="font-size:13px" dir="rtl"><?php echo $v_message ?></textarea>
     </div></td>
     <td><div align="right" >:متن پیام</div></td>
   </tr>
   <tr>
     <td height="37" colspan="2"><div align="right" class="input_text" >  <input name="file" type="text" style="width:250px; height:30px ; " tabindex="4"  value="<?php echo $file ?>" readonly="readonly" /> 
       <br />
     </div></td>
     <td><div align="right">:پیوست فایل</div></td>
   </tr>
   </table>
 <div align="center">
   <p>
     <input type="hidden" name="username" value="<?php echo $username ;?>" />
     <input type="hidden" name="rep_id" value="<?php echo $rep_id ;?>" />
     <input type="hidden" name="s_user" value="<?php echo $login_session ;?>" />
     <input type="hidden" name="list_ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
     <input type="hidden" name="list_q" value="<?php echo htmlspecialchars($list_q); ?>" />
     <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
     <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
     <input type="hidden" name="page_id" value="<?php echo (int)$page_id; ?>" />
     <input name="action1" type="submit" style="width:150px ; height:45px" tabindex="5" value="انتقال پیام" />
   </p>
   </p>
 </div>
</div>
</form>
<p align="center"><a href="messanger.php?<?php echo htmlspecialchars($back_qs); ?>" title="برگشت به لیست"><img src="../files/goback.jpg" width="118" height="47" alt=""/></a></p>
<?php
}
?>
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
 <?php if (isset($_POST['action1'])) 
  {  
$title   = $_POST['title'] ; 
$s_user  = $_POST['s_user'];
$r_user  = $_POST['username']; 
$message = $_POST['message']; 
$file = $_POST['file'];
$rep_id = $_POST['rep_id'];
$list_ru_read = isset($_POST['list_ru_read']) ? $_POST['list_ru_read'] : '';
$list_q = isset($_POST['list_q']) ? $_POST['list_q'] : '';
$order_field = isset($_POST['order_field']) ? $_POST['order_field'] : 's_date';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'desc';
$page_id = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 1;
if ($page_id < 1) $page_id = 1;
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../login/config.php');
$query = "INSERT INTO pm (file,title,r_user,s_user,message,no_pm,s_date,s_time) VALUES (:file,:title,:r_user,:s_user,:message,:no_pm,:s_date,:s_time)";
  $q = $dbh->prepare($query);
  $q->execute(array(':file'=>$file,':title'=>'انتقال : '.$title,':r_user'=>$r_user,':s_user'=>$s_user,':message'=>$message,':no_pm'=>'1',':s_date'=>$date_edit,':s_time'=>$time));
// ثبت وضعیت ارسال پاسخ 
$query2 = "UPDATE pm SET ru_read=?,r_date=?,r_time=? WHERE id=?";
$q2 = $dbh->prepare($query2);
$q2->execute(array('5',$date_edit,$time,$rep_id));
// ثبت کارکرد
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','انتقال پیام دریافتی به / '.user_name($r_user)) ; 
alert('پیام با موفقیت ارسال شد ') ;
  ?>
 <form name="reply" class="reply" method="get" action="messanger.php">
      <input type="hidden" name="id" value="<?php echo (int)$page_id; ?>" />
      <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($list_ru_read); ?>" />
      <input type="hidden" name="q" value="<?php echo htmlspecialchars($list_q); ?>" />
      <input type="hidden" name="order_field" value="<?php echo htmlspecialchars($order_field); ?>" />
      <input type="hidden" name="order_by" value="<?php echo htmlspecialchars($order_by); ?>" />
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
  }
?>