<?php
include("../lock_p2.php");
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','files','jpg,jpeg,gif,png,JPG,JPEG,PNG,xlsx,xls,doc,docx,pdf');
if ($result==1) {
$file_send =  $name ;
$mess =  $file_send . "<br align='center'> <font size=3 color='#060' >تصویر شما با موفقیت ارسال شد </font></br>";
 } else 
 {
$mess =  "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
}
else 
{
$file_send = '' ;
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../15_files/jquery.js" type="text/javascript"></script>
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
	{ box-shadow:10px 10px 5px #999 ; width:70% ; background-color:#CCC ; 
	margin:auto; border:1px solid #003399  ; border-radius: 10px ;  
		}
	        </style>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4">
</td>
    <td width="840" >
 <?php include('top.php');?>
<p align="center" ><span class="style1">ارسال پیام </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" ><?php echo $mess ; ?></p>
 <form action="" method="post" enctype="multipart/form-data" id="form1" name="form1" >
 <div id="box" >
        <table width="491" border="0" align="center">
   <tr>
     <td width="343" height="69"><div align="right"  >
       <input name="r_user" type="text" class="required input_text" id="r_user" style="width:200px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $_POST['co_name']?>" maxlength="100"  align="baseline" xml:lang="fa" />
     </div></td>
     <td width="138"><div align="right">:گیرنده</div></td>
   </tr>
   <tr>
     <td height="59"><div align="right">
       <input name="title" type="text" class="required input_text" id="title" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $_POST['name']?>" maxlength="250" xml:lang="fa" />
     </div></td>
     <td><div align="right">:عنوان پیام </div></td>
   </tr>
   <tr>
     <td height="112"><div align="right">
       <textarea name="message" cols="45" rows="5" id="message" tabindex="3"></textarea>
     </div></td>
     <td><div align="right" >:متن پیام</div></td>
   </tr>
   <tr>
     <td><div align="right" class="input_text" >  <input name="pic" type="file" id="pic" tabindex="4"  accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG,.xlsx,.xls,.doc,.docx,.pdf" /> 
       <br />
     </div></td>
     <td><div align="right">:فایل پیوستی </div></td>
   </tr>
   <tr>
     <td height="32" class="style2"> <span class="RedTitleSmaller">jpg , jpeg , gif , xlsx , xls . doc , docx , pdf</span> : پسوند فایل های مجاز </td>
     <td>&nbsp;</td>
   </tr>
        </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>

     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="5" value="ارسال پیام " />
   </p>
   <p>&nbsp;</p>
   </p>
 </div></div>
           <p>&nbsp;</p><p><a href="centers.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
 </form>      </td>
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
 <?php if (isset($_POST['action'])) 
  {  
$title= $_POST['title'] ; 
$r_user= $_POST['r_user'] ; 
$message= $_POST['message'] ; 
include('../login/config.php');
	$query = "INSERT INTO pm (file,title,r_user,message) VALUES (:file,:title,:r_user,:message)";
    $q = $dbh->prepare($query);
    $q->execute(array(':file'=>$file_send,':title'=>$title,':r_user'=>$r_user,':message'=>$message));
	$mess_p =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
  }
  ?>
<?php  
   // فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 

   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    $no_file = $_POST['r_user']   ;
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
        $max_filesize  = 500000;
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