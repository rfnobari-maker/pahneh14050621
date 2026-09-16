<?php
include("lock_p1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="files/images/header.jpg" width="949" height="149" /></td>
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
 <?php include('top.php'); ?>
<p align="center" ><span class="style1">محقق  معین شهرستان </span></p>
 <p align="center" ><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
 <p class="style8"> <?php echo $_POST['mess'] ; ?></p>
 <p>
   <?php 
  $query = "SELECT username,name,Last_name,pic,tel_m,cod_m,id_city  FROM  users WHERE  id_ostan = '$id_ostan' and S_access = '7' and  id_city='$id_city'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count>0){
?>
   <span class="RedTitleSmall">محقق معین شهرستانی</span><br />
 </p>
 <table width="600" height="100" border="0" align="center" cellpadding="2" cellspacing="2" >
   <tr align="center" class="text1">
     <td height="32" bgcolor="#999999">عملیات</td>
     <td width="41%" bgcolor="#999999">نام خانوادگی</td>
     <td width="22%" bgcolor="#999999">نام</td>
     <td width="12%" bgcolor="#999999">تصویر</td>
     </tr>
   <tr>
     
     <?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td width="12%" height="61" bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="send_pm.php" method="post">
  <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
  <button><img src="files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
</form></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['Last_name'];?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['name'];?></td>
     <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
     </tr>
   <?php
$r++ ; 
}
?>
 </table>
       <?php 
 }
 ?>

 <p align="center"></p>
 <p align="center"><a href="indexbenef.php"><img src="files/goback.jpg" width="128" height="57"  alt=""/></a></p>
 <p align="center"></p>
 <p align="center"></p>
    </td>
  </tr>
  <tr>
      <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><p>
      <?php include('footer.php')?>
    </p>
      <p>&nbsp; </p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>