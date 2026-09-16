<?php include('../lock_cp.php');?>
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
    </style>
	<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>

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
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu_notseen.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action='expaire-passck.php' method=post>
      <p>
        <input type=hidden name=todo value=change-password>
      </p>
          <p align="center" class="style1" > بروز رسانی کلمه عبور </p>
      <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p align="center" >کاربر گرامی اعتبار کلمه عبور شما به اتمام رسیده است ، برای استفاده از سامانه باید کلمه عبور خود را تغییر دهید </p>
      <div align="center" class="style8">
        <p>کلمه عبور جدید نباید  کمتر از 8 کارکتر باشد همچنین باید ترکیبی از عدد ، حروف کوچک و بزرگ انگلیسی بوده و از کارکترهای خاص هم استفاده نشود</p>
      </div>
      <table width="365" border='0' align=center cellpadding='0' cellspacing='0'>
        <tr bgcolor='#f1f1f1' > <td height="40" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td> 
        </tr>
<tr >
  <td width="174" height="48" bgcolor="#F1F1F1" class="input_text" >
  <input type ='password' class='bginput' name='old_password' style="width:100px ; height:35px" /></td>
  <td width="191"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2">: کلمه عبور فعلی </font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" bgcolor="#FFFFFF" class="input_text" ><font face='verdana, arial, helvetica' size='2' >
    <input type ='password' class='bginput' name='password' style="width:100px ; height:35px" />
    </font></td>
  <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> : کلمه عبور جدید</font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" class="input_text" ><font face='verdana, arial, helvetica' size='2' >
    <input type ='password' class='bginput' name='password2' style="width:100px ; height:35px" />
    </font></td>
  <td  align='center' class="style1"><font size="2"> : تکرار کلمه عبور جدید </font></td>
</tr>
<tr bgcolor='#ffffff' > <td colspan=2 align=center><p>&nbsp;
  </p>
  <p>
     <input type=submit value='تغییر کلمه عبور ' style="width:150px ; height:45px" />
  </p>  </font></td></tr>
</table>
 <p>&nbsp;</p><p><a href="../login/logout.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>        <p>&nbsp;</p>
    </form>
</td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>