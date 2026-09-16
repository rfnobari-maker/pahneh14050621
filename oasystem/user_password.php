<?php include('../lock_ad.php');?>
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
	<script src="../15_files/jquery.js" type="text/javascript"></script>
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
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action='user-passwordck.php' method=post>
      <p>
        <input type=hidden name=todo value=change-password>
      </p>
  <?php include('top.php'); 
  if(isset($_POST['username']))
{
include('../login/config.php');
$username = $_POST['username'] ; 
  $query2 = "SELECT * FROM  users  where username = '$username' " ;
  $stmt2 = $dbh->prepare($query2);
  $stmt2->execute();
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
          <p align="center" >&nbsp;</p>
          <p align="center" ><span class="style1">تغییر کلمه عبور </span></p>
          <table  style=" margin-right:35px" width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="111" rowspan="2"><p class="style8"><img src="../files/users/<?php echo $row2['pic'];?>" width="61" height="75"  alt=""/></p></td>
              <td height="45" colspan="4"><span class="style8"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></span></td>
            </tr>
            <tr>
              <td width="216" height="44" align="right" ><?php echo $row2['cod_m'] ;  ?></td>
              <td width="184" align="right" ><span class="style8">:کد ملی</span></td>
              <td width="204"><?php  echo '<dir style=margin-right:45px>'.$row2['name'].' '.$row2['Last_name'].'</div>'; ?></td>
              <td width="139"><span class="style8">:نام و نام خانوادگی </span></td>
            </tr>
          </table>
          <p align="center" >&nbsp;</p>
      <p align="center" >&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="365" border='0' align=center cellpadding='0' cellspacing='0'>
        <tr bgcolor='#f1f1f1' > <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" face="verdana, arial, helvetica" class="style8">تغییر کلمه عبور </font></td> </tr>
<tr bgcolor='#f1f1f1' >
  <td width="174" height="45" bgcolor="#FFFFFF" class="input_text" ><font face='verdana, arial, helvetica' size='2' >
    <input type ='password' class='bginput' name='password' style="width:100px ; height:35px" />
    </font></td>
  <td width="191"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> : کلمه عبور جدید</font></td>
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
   <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
    <a href="user_view.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>
    <input type=submit value='ثبت ' style="width:150px ; height:45px" />
  </p>  </font></td></tr>
</table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
<?php }
else 
{
    echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
</td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>