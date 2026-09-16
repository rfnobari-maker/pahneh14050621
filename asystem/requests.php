<?php 
include('../lock_admin.php');
include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

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
      <?php include('top.php');?>
      </p>
<?php 
include('../login/config.php');
$query = "SELECT * FROM  users WHERE   S_access = '2'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1">درخواست های دریافتی از مراکز جهاد کشاورزی  </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="80%" height="121" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999"> رد شده </td>
    <td colspan="2" bgcolor="#999999">اقدام شده</td>
    <td colspan="2" bgcolor="#999999">اقدام نشده</td>
    <td width="11%" bgcolor="#999999">نام مرکز </td>
    <td width="12%" bgcolor="#999999">شهرستان</td>
    <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <td <?php  if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="11%" height="58" class="normalTextSmaller"><img src="../files/send_mail.png" width="31" height="30"  alt=""/></td>
  <td  width="10%" class="normalTextSmaller" <?php  if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img src="../files/receive_mail.png" width="31" height="30"  alt=""/></td>
  <td width="10%"  class="normalTextSmaller" <?php  if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="center_listsabadi.php" method="POST">
      <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
      <input type="hidden" name="mar" value="<?php echo $row['markaz'] ;?>" />
      <button><img src="../files/notok.png" border="0"  title="مشاهده لیست آبادی ها" width="39" height="39" /></button>
      </form>
  </td>
    <td width="7%" class="normalTextSmaller"  <?php  if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <?php echo mar_request_count($row['id_mar'],'3') ;?></td>
    <td width="10%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
       <form  action="<?php if((mar_request_count($row['id_mar'],'2')) <>0) echo 'list_request2.php';?>" method="POST">
      <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
      <input type="hidden" name="mar" value="<?php echo $row['markaz'] ;?>" />
      <button><img src="../files/ok.png" border="0"  title="مشاهده لیست آبادی ها" width="39" height="39" /></button>
      </form>
      </td>
    <td width="7%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_request_count($row['id_mar'],'2') ;?></td>
    <td width="9%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="<?php if((mar_request_count($row['id_mar'],'1')) <>0) echo 'list_request1.php';?>" method="POST">
      <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
      <input type="hidden" name="mar" value="<?php echo $row['markaz'] ;?>" />
      <button><img src="../files/Sback.PNG" border="0"  title="مشاهده لیست آبادی ها" width="39" height="39" /></button>
     </form> 
      </td>
    <td width="7%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_request_count($row['id_mar'],'1') ;?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['markaz'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



