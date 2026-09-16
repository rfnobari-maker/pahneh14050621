<?php
require_once("../lock_ce.php");
require_once('../web/sokh.php');
require_once('side_menu1.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
<div align="center" dir="rtl" style="border-radius:15px; padding:40px 30px; font-size:18px; width:80%; margin: 0 auto; line-height: 1.8; background-color: #f9f9f9; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
    <blockquote style=" font-size: 20px; color: #444; padding-left: 30px; margin-bottom: 20px; text-align: right; position: relative; line-height: 1.6; font-family: myfont;">
        <?php echo $Sokh['sokh']; ?>
    </blockquote>
    <p align="left" style="font-weight: bold; color: #333; font-size: 18px; text-align: left; margin-top: 10px; font-family: myfont2;">
        <?php echo $Sokh['name']; ?>
    </p>
</div>




    </td>
  </tr>
  <tr>
    <td height="50" colspan="3" valign="middle" >
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