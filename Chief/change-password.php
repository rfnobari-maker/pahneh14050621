<?php
require_once("../lock_ce.php");
require_once("../event.php");
require_once('side_menu1.php');
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
        });
    </script>
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
		   $query = "SELECT * from users  WHERE username='".$user_check."' and S_access='99' ";
           $stmt = $dbh->prepare($query);
           $stmt->execute();
           $ch_num = $stmt -> rowCount();
		   if ($ch_num > 0)
           {
		   ?>
             <form action='change-passwordck.php' method="post">
               <p>
                 <input type="hidden" name="todo" value="change-password" />
               </p>
               <p align="center" ><span class="style1">تغییر کلمه عبور </span></p>
               <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
               <div align="center" class="style8">
                 <p>کلمه عبور جدید نباید  کمتر از 8 کارکتر باشد همچنین باید ترکیبی از عدد ، حروف کوچک و بزرگ انگلیسی بوده و از کارکترهای خاص هم استفاده نشود</p>
               </div>
               <table width="365" border='0' align="center" cellpadding='0' cellspacing='0'>
                 <tr bgcolor='#f1f1f1' >
                   <td height="40" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                 </tr>
                 <tr >
                   <td width="174" height="48" bgcolor="#F1F1F1" class="input_text" ><input type ='password' class='bginput' name='old_password' style="width:100px ; height:35px" /></td>
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
                 <tr bgcolor='#ffffff' >
                   <td colspan="2" align="center"><p>&nbsp;</p>
                     <p>
                       <input type="submit" value='تغییر کلمه عبور ' style="width:150px ; height:45px" />
                     </p>
                     </font></td>
                 </tr>
               </table>
               <p>&nbsp;</p>
               <p>&nbsp;</p>
             </form>             <?php }?>              
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