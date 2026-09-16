<?php
include("../lock_expsh.php");
include("../event.php");
$id_city = $_POST['id_city'] ;
$expert_unit = $_POST['expert_unit'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.style12 {color: #999999}
</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <p>
   <?php include('top.php');
 include ('../login/config.php');
 ?>
 </p>
 <p>&nbsp;</p>
 <p align="center" ><span class="style1">کتابخانه الکترونیکی </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> 
 <p align="center" ><?php include('../ebook_files.php')?> </p> 
 <p align="center"><a href="index.php"><img src="../files/goback.jpg" width="128" height="57"  alt=""/></a></p>
 <p align="center"></p>
 <p align="center"></p>
    </td>
  </tr>
  <tr>
      <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p>
      <?php include('../footer.php')?>
    </p>
      <p>&nbsp; </p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
