<?php
require_once("../lock_cp.php");
require_once("../event.php");
require_once('side_menu1.php');
if($_FILES['pic']['name']) {
list($name_file,$result) = upload('pic','../pm_files','jpg,jpeg,gif,png,JPG,JPEG,PNG,xlsx,xls,doc,docx,pdf');
if ($result==1) {
$file_send =  $name_file ;
 $mess =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
 } else 
 {
 $mess =  "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
}
else 
{
$file_send = '' ;
}
 if ((empty($_FILES['pic']['name']) and isset($_POST['action1']))) 
  {  
 $mess =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
  }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
    <style>
    #box
	{ box-shadow:10px 10px 5px #999 ; width:700px ; background-color:#FFC ; 
	margin:auto; border:1px solid #069  ; border-radius: 20px ;  
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
 if (isset($_POST['username']))
{
$username = $_POST['username'] ; 
$title    = $_POST['title'] ; 
$rep_id   = $_POST['id'] ; 
$s_date   = $_POST['s_date'] ;
$s_time   = $_POST['s_time'] ;
if (isset($_POST['re_message']))
{
$re_message  = $_POST['re_message'] ; 
$v_message =<<<EOT


------------------- پیام دریافتی --------------------
 تاریخ : $s_date         ساعت :  $s_time
       
متن پیام دریافتی :

$re_message 
EOT;
}
?>
<p align="center" >&nbsp;</p>ارسال پاسخ پیام <span style="color:#900 ; font-family:Tahoma; font-size:12px"><span class="style21"></span><span class="style1"><a name="1" id="1"></a></span></span>
<p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $mess ?></p>
 <form action="" method="post" enctype="multipart/form-data" id="form1" name="form1" >
   <div id="box">
        <table width="95%" border="0" align="center">
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
     <td width="150"><div align="right">  : موضوع پیام /در پاسخ</div></td>
   </tr>
   <tr>
     <td height="104" colspan="2"><div align="right">
       <textarea name="message" cols="45" rows="10" style="color:#06C ; font-family:myfont2 ; font-size:14px" autofocus="autofocus" class="required" id="textarea" dir="rtl" > <?php echo $v_message ?></textarea>
       </div></td>
     <td><div align="right" >:متن پیام</div></td>
   </tr>
   <tr>
     <td height="37" colspan="2"><div align="right" class="input_text" >  <input name="pic" type="file" id="pic" tabindex="4"  accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG,.xlsx,.xls,.doc,.docx,.pdf" /> 
       <br />
     </div></td>
     <td><div align="right">:پیوست فایل</div></td>
   </tr>
   <tr>
     <td height="24" class="style2">حداکثر حجم :<span class="RedTitleSmaller"> 500</span> <span class="RedTitleSmaller">کیلو بایت</span></td>
     <td height="24" colspan="2" class="style2"><span class="RedTitleSmaller">jpg , jpeg , gif , xlsx , xls , doc , docx , pdf</span> : پسوند فایل های مجاز</td>
   </tr>
   </table>
 <div align="center">
   <p>
     <input type="hidden" name="username" value="<?php echo $username ;?>" />
     <input type="hidden" name="rep_id" value="<?php echo $rep_id ;?>" />
     <input type="hidden" name="s_user" value="<?php echo $login_session ;?>" />
     <input name="action1" type="submit" style="width:150px ; height:45px" tabindex="5" value="ارسال پیام" />
     </form> 
   </p>
   </p>
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
$rep_id = $_POST['rep_id'];
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//include_once('../login/config.php');
$query = "INSERT INTO pm (file,title,r_user,s_user,message,no_pm,s_date,s_time,rep_id) VALUES (:file,:title,:r_user,:s_user,:message,:no_pm,:s_date,:s_time,:rep_id)";
  $q = $dbh->prepare($query);
  $q->execute(array(':file'=>$file_send,':title'=>'در پاسخ :'.$title,':r_user'=>$r_user,':s_user'=>$s_user,':message'=>$message,':no_pm'=>'1',':s_date'=>$date_edit,':s_time'=>$time,':rep_id'=>$rep_id));
// ثبت وضعیت ارسال پاسخ 
$query2 = "UPDATE pm SET ru_read=?,r_date=?,r_time=? WHERE id=?";
$q2 = $dbh->prepare($query2);
$q2->execute(array('3',$date_edit,$time,$rep_id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ارسال پاسخ پیام خصوصی / '.user_name($r_user),$id_ostan) ; 
  }
  ?>
<?php  
   // فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("md");
$time = date('Hi') ;
   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    $no_file = $_POST['s_user'].'_'.$date_edit.'_'.$time ;
    $file_name = $no_file.'.' . $ext;//Get Unique Name
  //  echo $file_name ; 
	$all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;
    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
// کنترل حجم فایل
           if ((($_FILES[$file_id]['size'])<1000) || (($_FILES[$file_id]['size'])>500000))
		    { //Check if the file is made
            $file_name = '';
            $result =  "  حجم فایل ارسالی نباید از 1 کیلوبایت کمتر و از 500 کیلوبایت بیشتر باشد "; //Show the error message
			echo "<br/>\n" ;
        } else {

			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
}
////End
?>