<?php
include("../lock_oce.php");
include('../event.php');
$id_city  = $_POST['id_city'] ; 
$s_access = $_POST['s_access'] ; 
$id_mar = $_POST['id_mar'] ; 
if($_FILES['pic']['name']) {
list($name,$result) = upload('pic','../pm_files','jpg,jpeg,gif,png,JPG,JPEG,PNG,xlsx,xls,doc,docx,pdf');
if ($result==1) {
$file_send =  $name ;
 $mess =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
echo $v_s_access ; 
 } else 
 {
 $mess =  "<br align='center' style='text-decoration:rtl'> <font size=3 color='#900 ' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
}
else 
{
$file_send = '' ;
}
 if ((empty($_FILES['pic']['name']) and isset($_POST['action']))) 
  {  
 $mess =  "<br align='center'> <font size=3 color='#060' >پیام شما با موفقیت ارسال شد </font></br>";
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
	{ box-shadow:10px 10px 5px #999 ; width:70% ; background-color:#CCC; 
	margin:auto; border:1px solid #003399  ; border-radius: 10px ;  
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
 <?php include('top.php');?>
 <br />
 ارسال پیام گروهی
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $mess ?><span class="style21"><a name="1" id="1"></a></span></p>
	   <form action="" method="post" enctype="multipart/form-data" id="form1" name="form1" >
       <div id="box">
        <table width="491" border="0" align="center">
          <tr>
            <td height="42" colspan="2"><div align="right" dir="rtl">
              <p>
                <select  name="id_city" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="0"> کل استان</option>
                  <?php
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<? echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <? echo $row['city'] ;?></option>
                  <?php }?>
                </select>
                <select  name="id_mar" class="input_text" id="id_mar" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                  <option value="0"> کلیه مراکز جهاد کشاورزی</option>
                  <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                  <?php }?>
                </select>
              </p>
            </div></td>
            <td><div align="right" class="style8">: شهرستان</div></td>
          </tr>
          <tr>
            <td width="129" height="40">&nbsp;</td>
            <td width="250"><div align="right" dir="rtl">
              <p>
                <select name="s_access" class="input_text" id="s_access" style="width:200px; height:30px  ">
                  <option value="1" <?php if ($s_access== '1') echo 'selected=selected' ?> >کارشناسان مسئول پهنه</option>
                  <option value="2" <?php if ($s_access== '2') echo 'selected=selected' ?>>روسای مراکز </option>
             <?php if((!isset($_POST['id_city'])) or ($id_city=='0') or $id_mar=='0'){?>
                  <option value="3" <?php if ($s_access== '3') echo 'selected=selected' ?>>مدیران شهرستان</option>
                  <option value="6" <?php if ($s_access== '6') echo 'selected=selected' ?>>کارشناسان موضوعی شهرستان</option>
                  <option value="7" <?php if ($s_access== '7') echo 'selected=selected' ?>>کارشناسان محقق معین شهرستان</option>
              <?php }
              if((!isset($_POST['id_city'])) or $id_city=='0') {?>
                  <option value="4" <?php if ($s_access== '4') echo 'selected=selected' ?>>مدیران استان</option>
                  <option value="5" <?php if ($s_access== '5') echo 'selected=selected' ?>>کارشناسان معین استان</option>
              <?php }?>
                  </select>
                </p>
              </div></td>
            <td><div align="right" class="style8">: گیرندگان</div></td>
          </tr>
          <tr>
            <td height="40" colspan="2"><div align="right">
              <input name="title" type="text" class="required input_text" id="title" style="width:250px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $_POST['name']?>" maxlength="250" xml:lang="fa" />
              </div></td>
            <td width="98"><div align="right">: موضوع پیام </div></td>
          </tr>
   <tr>
     <td height="85" colspan="2"><div align="right">
       <textarea name="message"  class="required  input_text" id="textarea" cols="45" rows="5" dir="rtl"></textarea>
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
     <input type="hidden" name="s_user" value="<?php echo $login_session ;?>" />
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="5" value="ارسال پیام" />
   </p>
   </p>
 </div>
</div>
 <p>&nbsp;</p><p><a href="centers.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>  
 <p align="center" >&nbsp;</p>
      </form>      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
 <?
 if (isset($_POST['action'])) 
  {  
$id_city  = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
$title   = $_POST['title'] ; 
$s_user  = $_POST['s_user'];
$message = $_POST['message']; 
$s_access = $_POST['s_access']; 
if ($id_city =='0') $v_id_city='id_city = id_city' ; else $v_id_city = "id_city= '$id_city'" ; 
if ($id_mar == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}

require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "SELECT username from users where S_access=$s_access and id_ostan = '$id_ostan' and $v_id_city and $v_id_mar";
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
 $r_user  = $row['username']; 
include('../login/config.php');
	$query = "INSERT INTO eagri_pahneh.pm(id,no_pm, s_user, r_user, title, message, s_date, s_time, ru_read, r_date, r_time, rep_id, add_abadi, add_city, file, del, del_date, del_time)
	 VALUES (NULL, '1','$s_user' , '$r_user', '$title', '$message', '$date_edit', '$time', '1', '0', '0', '0', '0', '0', '$file_send', '0', '0', '0')";
    $q = $dbh->prepare($query);
    $q->execute();
} ;

	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ارسال پیام گروهی به مخاطبان گروه : ' .$s_access) ; 
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
