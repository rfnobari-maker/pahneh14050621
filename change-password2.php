<?Php
include "lock_p1.php";
include "login/config.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="PayAdmin/FA.css" rel="stylesheet" type="text/css" />
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>(تغییر کلمه عبور )</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>
<body >
<form action='change-passwordck.php' method=post><input type=hidden name=todo value=change-password>
<table width="300" border='0' align=center cellpadding='0' cellspacing='0'>
 <tr bgcolor='#f1f1f1' > <td colspan='2' align='center'><font size="2" face="verdana, arial, helvetica" class="style8">تغییر کلمه عبور </font></td> </tr>
<tr >
  <td width="163" height="41" bgcolor="#F1F1F1" class="input_text" ><input type ='password' class='bginput' name='old_password' /></td>
  <td width="137"  align='center' bgcolor="#F1F1F1" class="style8"><font size="2">کلمه عبور فعلی </font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" bgcolor="#FFFFFF" class="input_text" ><font face='verdana, arial, helvetica' size='2' >
    <input type ='password' class='bginput' name='password' />
    </font></td>
  <td  align='center' bgcolor="#FFFFFF" class="style8"><font size="2">کلمه عبور جدید</font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" class="input_text" ><font face='verdana, arial, helvetica' size='2' >
    <input type ='password' class='bginput' name='password2' />
    </font></td>
  <td  align='center' class="style8"><font size="2">تکرار کلمه عبور جدید </font></td>
</tr>
<tr bgcolor='#ffffff' > <td colspan=2 align=center><p>&nbsp;
  </p>
  <p>
    <input type=submit value='تغییر کلمه عبور '>
    <input type=reset value=انصراف >
  </p>    </font></td></tr>
</table>
</form>
<center>
<br><br></center> 
</body>
</html>