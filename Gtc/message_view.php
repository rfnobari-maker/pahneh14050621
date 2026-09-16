<?php
include("../lock_df.php");
include('../event.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <style>
    #box
	{ box-shadow:10px 10px 5px #999 ; width:70% ; background-color:#CCC ; 
	margin:auto; border:1px solid #003399  ; border-radius: 10px ;  
	}
    #img1
    {
	border-radius:40px ; 
	}
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
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4">
</td>
    <td width="840" >
 <p>
   <?php include('top.php');
 if (isset($_POST['id']) and isset($_POST['s_user'])) 
  {  
$id = $_POST['id'] ; 
$s_user = $_POST['s_user'] ; 
$query = "SELECT * from pm where id = $id and s_user = $s_user";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$title   = $row['title'] ; 
$s_user  = $row['s_user'];
$r_user  = $row['r_user']; 
$message = $row['message']; 
$file = $row['file'] ;
?>
 </p>
 <p>مشاهده پیام <span class="style21"><a name="1" id="1"></a></span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
   <form action="" method="post"  id="form1" name="form1" >
       <div id="box">
         <table width="491" border="0" align="center">
           <tr>
             <td height="88"><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo user_pic($s_user) ?>" width="57" height="64"  alt=""/></span></td>
             <td><div align="right">
               <input name="title2" type="text" class="input_text" id="title2" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo user_name($s_user).'&nbsp;&nbsp;';?>" maxlength="250" readonly="readonly" xml:lang="fa" />
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
       <textarea name="message" cols="55" rows="5" readonly="readonly" class="input_text" id="textarea" dir="rtl"><?php echo $message ?></textarea>
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
              <button name="reply2" style="width:200px ; height:45px ; font-family:Tahoma ; font-size: 14px" >انتقال پیام</button></td>
            <td>&nbsp;</td>
            <td>
           
              <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
              <button name="reply1" style="width:200px ; height:45px ; font-family:Tahoma ; font-size: 14px" >ارسال پاسخ</button></td>
          </tr>
             </table>
           

        <p>&nbsp;</p>
       </div>
           </form> 
 <?php
 }
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
  ?>  
 <p>&nbsp;</p><p><a href="messanger.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>  
 <p align="center" >&nbsp;</p>
         </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
 <?php if (isset($_POST['reply1'])) 
  {  
?>
	 <form name="reply" class="reply" method="post" action="reply_pm.php#1">
      <input type="hidden" name="username" value="<?php echo $row['s_user'] ;?>" />
      <input type="hidden" name="title" value="<?php echo $row['title'] ;?>" />
      <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
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
     </form>
    <script type="text/javascript">document.reply.submit();</script>
<?php
  }
  ?>
