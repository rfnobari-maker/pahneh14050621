<?php include("../lock_ce.php");
include('counter.php');
include_once('side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link rel="shortcut icon" href="<?php echo $root ;?>files/images/favicon.ico" type="image/x-icon">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
}
.box1 {width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
}
</style>

</head>
<body style="top:-70px">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
   <td> 
   <?php  include("header.php");?>

      <p align="center" >&nbsp;</p>
      <p align="center" ><span class="style1">عملیات تغییر کلمه عبور </span></p>
      <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>&nbsp;</p>
      <p>
        <?Php
include "../login/config.php";
$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$old_password=$_POST['old_password'];
/////////////////////////
if(isset($todo) and $todo=="change-password"){
$status = "OK";
$msg="";			
 $sql=$dbh->prepare("SELECT password,psalt,id,Access,S_access,Last_name FROM users WHERE username=?");
 $sql->execute(array($user_check));
 while($r=$sql->fetch()){
 $p=$r['password'];
 $p_salt=$r['psalt'];
 $id=$r['id'];
 $access= $r['Access']; 
 $s_access=$r['S_access']; 
 $PersName=$r['Last_name'];
 }
 $site_salt="subinsblogsalt";
 $salted_hash = hash('sha256',$old_password.$site_salt.$p_salt);

 if($p<>$salted_hash){
 $msg=$msg."کلمه عبور قبلی وارد شده صحیح نمیباشد <BR>";
 $status= "NOTOK";
 }					
else 
{
if ( $password <> $password2 ){
$msg=$msg."کلمه عبور جدید وارد شده با تکرار آن مطابقت ندارد <BR>";
$status= "NOTOK";
}					
else 
{
if ( $password == $old_password ){
$msg=$msg."کلمه عبور جدید نمیتواند همان کلمه عبور قبلی باشد   <BR>";
$status= "NOTOK";
}					
else 
{            if (!empty($password)) { //check if string is empty
                if (ctype_alnum($password)) { //check if string is alphanumeric
                    if (7 < strlen($password)){ //check if string meets 8 or more characters
                        if (strcspn($password, '0123456789') != strlen($password)){ //check if string has numbers
                            if (strcspn($password, 'abcdefghijklmnopqrstuvwxyz') != strlen($password)) { //check if string has small letters
                                if (strcspn($password, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($password)) { //check if string has capital letters
$status= "OK";                                }
                                else {
$msg=$msg."در کلمه عبور جدید از حروف بزرگ استفاده نشده <BR>";
$status= "NOTOK";
                                }
                            }
                            else {
$msg=$msg."در کلمه عبور جدید از حروف کوچک استفاده نشده <BR>";
$status= "NOTOK";
                            }
                        }
                        else {
$msg=$msg." در کلمه عبور جدید از اعداد استفاده نشده است  <BR>";
$status= "NOTOK";
                        }
                    }
                    else {

    $msg=$msg."کلمه عبور جدید نباید از 8 کارکتر کوچکتر باشد <BR>";
     $status= "NOTOK";
                    }
                }
                else {
      $msg=$msg."کلمه عبور جدید دارای کارکترهای ویژه میباشد <BR>";
      $status= "NOTOK";
                }
            }
            else {
     $msg=$msg."کلمه عبور جدید خالیست <BR>";
     $status= "NOTOK";
  }
  }
  }
  }
///
if($status<>"OK"){ 
echo "<font face='Tahoma' size='3' color=red>$msg</font><br><center><input type='button' value='تلاش مجدد' style='width:150px ; height:45px' onClick='history.go(-1)'></center>";
}else{ // if all validations are passed.
     function rand_string($length) {
      $str="";
      $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $size = strlen($chars);
      for($i = 0;$i < $length;$i++) {
       $str .= $chars[rand(0,$size-1)];
      }
      return $str; /* http://subinsb.com/php-generate-random-string */
     }
    $p_salt = rand_string(20); /* http://subinsb.com/php-generate-random-string */
     $site_salt="subinsblogsalt"; /*Common Salt used for password storing on site.*/
     $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
    $date_pas = date("Y-m-d") ; 
    $query = "UPDATE users  SET date_pas=?,password=?, psalt=? 	WHERE username=?";
     $q = $dbh->prepare($query);
    $q->execute(array($date_pas,$salted_hash, $p_salt,$user_check));
    
 //
if($sql->execute()){
echo "<font face='Tahoma' size='16px' color=green ><center>رمز شما با موفقیت تغییر یافت <br> جهت ارتقاء امنیت اطلاعات ، لطفا در بازه های زمانی 
محدود نسبت به تغییر مجدد رمز خود اقدام نمایید <br> اکنون با کلیک دکمه برگشت از سامانه خارج شده و مجددا با کلمه عبور جدید وارد شوید  </font></center>";
}else{echo "<font face='Tahoma' size='3' color=red><center>متاسفیم  <br> خطا در تغییر رمز لطفا با مدیر سامانه تماس حاصل فرمایید </font></center>";
} // end of if else if updation of password is successful
} // end of if else if status <>OK
} // end of if else todo
?>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
 
      <p>&nbsp;</p></td>
          
   </td>
   </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
          </tr>
        </table>
      </div>
</body>
</html>