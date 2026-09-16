<?Php
include "lock_p1.php";
include "login/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="PayAdmin/FA.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>(تغییر کلمه عبور )</title>
</head>
<body>
<?Php
$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$old_password=$_POST['old_password'];
/////////////////////////
if(isset($todo) and $todo=="change-password"){
$status = "OK";
$msg="";			
 $sql=$dbh->prepare("SELECT * FROM users WHERE username=?");
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
 $msg=$msg."رمز قبلی صحیح نیست <BR>";
 $status= "NOTOK";
 }					
if ( strlen($password) < 5 or strlen($password) > 8 ){
$msg=$msg."رمز وارد شده نباید از 5 کارکتر کمتر و از 8 کارکتر بیشتر باشد <BR>";
$status= "NOTOK";}					

if ( $password <> $password2 ){
$msg=$msg."کلمه عبور جدید وارد شده با تکرار آن مطابقت ندارد <BR>";
$status= "NOTOK";}					



if($status<>"OK"){ 
echo "<font face='Verdana' size='2' color=red>$msg</font><br><center><input type='button' value='تلاش مجدد' onClick='history.go(-1)'></center>";
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
    $query = "UPDATE users  SET password=?, psalt=? 	WHERE username=?";
     $q = $dbh->prepare($query);
    $q->execute(array($salted_hash, $p_salt,$user_check));
if($sql->execute()){
echo "<font face='Verdana' size='2' ><center>با تشکر  <br> رمز شما با موفقیت تغییر یافت ، لطفا در بازه زمانی محدود نسبت به تغییر رمز خود اقدام نمایید </font></center>";
}else{echo "<font face='Verdana' size='2' color=red><center>متاسفیم  <br> خطا در تغییر رمز لطفا با مدیر سامانه تماس حاصل فرمایید </font></center>";
} // end of if else if updation of password is successful
} // end of if else if status <>OK
} // end of if else todo
?>
<center>
<br><br></center> 
</body>
</html>