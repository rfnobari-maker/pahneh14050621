<?Php
include "../lock_ad.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
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
      <p align="center" >&nbsp;</p>
      <p align="center" ><span class="style1">عملیات تغییر کلمه عبور </span></p>
      <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>&nbsp;</p>
      <p>
        <?Php
include "../login/config.php";
$todo=$_POST['todo'];
$username = $_POST['username'] ; 
$password=$_POST['password'];
$password2=$_POST['password2'];
/////////////////////////
if(isset($todo) and $todo=="change-password"){
$status = "OK";
$msg="";			
 $sql=$dbh->prepare("SELECT * FROM users WHERE username=?");
 $sql->execute(array($username));
 while($r=$sql->fetch()){
 $p=$r['password'];
 $p_salt=$r['psalt'];
 $id=$r['id'];
 $access= $r['Access']; 
 $s_access=$r['S_access']; 
 $PersName=$r['Last_name'];
 }
if ( strlen($password) < 4 or strlen($password) > 14 ){
$msg=$msg."رمز وارد شده نباید از 4 کارکتر کمتر و از 14 کارکتر بیشتر باشد <BR>";
$status= "NOTOK";}					

if ( $password <> $password2 ){
$msg=$msg."کلمه عبور جدید وارد شده با تکرار آن مطابقت ندارد <BR>";
$status= "NOTOK";}					
if($status<>"OK"){ 
echo "<font face='Tahoma' size='3' color=red>$msg</font><br>";
?>
<form action="user_password.php" method="post" >
<input type="hidden" name="username" value="<?php echo $username ;?>" />
<input type="submit" value="تلاش مجدد" style="width:150px ; height:40px; font-size:16px ; font-family:Tahoma"  />
</form>
<?php 
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

    $query = "UPDATE users  SET date_pas=?,password=?, psalt=? WHERE username=?";
     $q = $dbh->prepare($query);
    $q->execute(array('0000-00-00',$salted_hash, $p_salt,$username));
    
    $dbh = null ;


if($sql->execute()){
echo "<font face='Tahoma' size='16px' color=green ><center>کلمه عبور کاربر با موفقیت تغییر یافت </font></center>";
echo '<p>' ;
}else{echo "<font face='Tahoma' size='3' color=red><center>متاسفیم  <br> خطا در تغییر رمز لطفا با مدیر سامانه تماس حاصل فرمایید </font></center>";
} // end of if else if updation of password is successful
} // end of if else if status <>OK
} // end of if else todo
?>
      </p>
      <p>&nbsp;</p>
      <p><a href="index.php"><input type=reset value='بازگشت' style="width:150px ; height:45px" ></a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
