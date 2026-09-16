<?php
include("lock_p1.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>پروفایل مروج</title>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>

</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="949" height="149" /></td>
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
          <p>پروفایل مروج </p>
          <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="39%" bgcolor="#FFFFCC"><p class="style1"><span class="normalTextSmall">تصویر  مروج</span>
<?php 
 include('login/config.php');
$query = "SELECT * FROM users WHERE username='".$user_check."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
 $row_del = $stmt->fetch(PDO::FETCH_ASSOC);
 $pic = $row_del['pic']; 
 $username = $row_del['username']; 
 $jens = $row_del['jens']; 
// حذف تصویر
 if (isset($_POST['del_pic']))
 {
$file ='http://pahneh.eaj.ir/files/users/'.$row_del['pic'] ;
//unlink($file);
$query = "UPDATE users SET pic=?  WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array('',$user_check));
 }
 //
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','files/users','jpg,jpeg,gif,png');
if ($result==1) {
$pic =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >تصویر شما با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }

if (isset($_POST['action4'] ) ) {
$query = "UPDATE users 
        SET pic=? WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($pic,$username));
} 

$query = "SELECT * from users WHERE username='".$user_check."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>             
                <form action="" method="post" enctype="multipart/form-data">
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="325" height="53" align="center"><p class="up_row">
                        <?php if($row['pic']<>""){?>
             <p><img style="border:1px solid #021a40;" src="<?php echo 'files/users/'.$row['pic'];?>"  width="97" height="125"/> </p>
                        <p class="up_row">
                          <input type="submit" name="del_pic"  value="حذف"   style="width:50px; height:30px ; font-family:Tahoma, Geneva, sans-serif " />
                        </p>
                        <?php } ?>
                <input type="hidden" name="no_file" value="<?php echo $username ; ?>" />
               <input type="submit" value="ارسال فايل" name="action4"  <?php if($row['pic']<>"") { echo ' disabled="disabled"';}?>/>
                        <input name="pic" type="file" id="pic"  accept=".jpg,.jpeg,.gif,.png" /></td>
                    </tr>
                  </table>
              </form>
                </p>
                <p align="justify" class="style2"  style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >- حجم فایل ارسالی نباید از 3 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد</p>
                <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- برای تغییر تصویر موجود ، ابتدا تصویر قبلی را حذف نمایید .</p>
                <p style="direction:rtl ; color:#900"></p></td>
              <td width="61%"><table width="100%" height="119" border="0" align="center" cellpadding="1" cellspacing="1">
                <tr  style=" text-align: right;">
                  <td width="27%" height="41"><span class="LinkTitleNews"><?php echo $username ; 
 ?></span></td>
                  <td width="11%" class="style8">:کد ملی</td>
                  <td width="46%"><span class="LinkTitleNews" ><?php echo $ostan.'&nbsp; /&nbsp; '.$city.'&nbsp;/&nbsp; '.$markaz ;  ?></span></td>
                  <td width="16%" class="style8"> :محل خدمت </td>
                </tr>
                <tr>
                  <td height="34" colspan="3">&nbsp;</td>
                  <td class="style8">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><?php echo  $jens ; ?></td>
                  <td class="style8"> : جنسیت </td>
                </tr>
              </table></td>
            </tr>
          </table>
          <p>&nbsp;</p>
<p align="center"><a href="<?php echo $previous?>" title="برگشت به صفحه اصلی" ><img src="files/goback.jpg" width="128" height="57" border="0" /></a></p>
  <?php

// فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 

   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
    //Get file extension
   // $ext_arr = split("\.",basename($file_title));
   // $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
  //  $file_name = $id . '_' . $file_title;//Get Unique Name
    $no_file = $_POST['no_file']   ;
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
   
switch ($file_id)
 {
  case "pic":
        $max_filesize  = 30000;
		$min_filesize = 2000;
}
            $size=filesize($_FILES[$file_id]['tmp_name']);
//            $max_filesize = 122091;
            if (($size > $max_filesize) || ($size < $min_filesize))
		   {
			$result = 'حجم فایل غیر مجاز '.($size/1000).'کیلوبایت'  ;
             }
			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
////End
?>
    
    
     </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>

</table>
</body>
</html>
