<?php include('../lock_p3.php');?>
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
      <td>
      <?php include('top.php');?>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
      <table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<?php
if (isset($_POST['id_mar']))
{
$id_mar = $_POST['id_mar'] ; 
$mar = $_POST['mar'] ; 
include('../login/config.php');
$query = "SELECT * FROM  change_mor WHERE  id_mar = '$id_mar' and status = '3'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><span class="style1"> لیست درخواست های تایید نشده مرکز <?php echo $mar ; ?></span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div align="right" class="LinkRedTitle" style="margin-right:45px"></div>
           
           <table width="98%" height="112" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="10%" bgcolor="#CCCCCC">تاریخ  عدم تایید</td>
    <td height="50" bgcolor="#CCCCCC">تاریخ ثبت</td>
    <td height="50" colspan="2" bgcolor="#CCCCCC"><p> <span class="style8"> مروج جدید</span></p></td>
    <td colspan="2" bgcolor="#CCCCCC">مروج قبلی</td>
    <td width="15%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="14%" bgcolor="#CCCCCC">نوع درخواست</td>
    <td width="4%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m1 = $row['mor_codm_old'] ;
$cod_m2 = $row['mor_codm_new'] ;
$abadi = $row['abadi'] ;
$no_request = $row['no_request'] ;  
switch ($no_request)
 {
  case "1":
$v_request = 'تغییر مروج آبادی' ;
 break;
  case "2":
$v_request = 'حذف مروج آبادی ' ; 
 break;
  case "3":
$v_request = 'حذف آبادی' ; 
 break;
  case "4":
$v_request = 'ثبت آبادی جدید' ; 
 break;
  case "5":
$v_request = 'ثبت مروج جدید' ; 
 break;
  }
$date_s = $row['date_s'] ;  
$status = $row['status'] ;
$last_name_mo1 = $row['Last_name'] ;
$name_mo1 = $row['name'] ;
switch ($status)
 {
  case "1":
$v_satus = 'در حال بررسی' ;
 break;
  case "2":
$v_satus = 'انجام شده' ; 
 break;
  case "3":
$v_satus = 'تایید نشد' ; 
  }
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT * FROM  users  where cod_m = '$cod_m1' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
if ($no_request<>5)
{
$name_mo1 = $row2['name'];
$last_name_mo1 = $row2['Last_name'];
}
$pic_mo1 = $row2['pic'];
if ($pic_mo1=='') $pic_mo1 = 'no_pic.png' ; 
$query2 = "SELECT * FROM  users  where cod_m = '$cod_m2' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo2 = $row2['pic'];
$name_mo2 = $row2['name'];
$last_name_mo2 = $row2['Last_name'];
$pic_mo2 = $row2['pic'];
if ($pic_mo2=='') $pic_mo2 = 'no_pic.png' ; 
?>
<td height="60" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['date_a'];?></span></td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="11%"><span class="normalTextSmaller"><?php echo $row['date_s'];?></span></td>
 <td width="12%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $last_name_mo2.' '.$name_mo2 .'<br>';  ?><?php echo $cod_m2;?></td>
 <td width="7%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
 <?php if($no_request=='1') echo '<img src=../files/users/'.$pic_mo2.' width=42 height=47 />' ?> 
 </td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="14%" class="normalTextSmaller"><?php echo $last_name_mo1.' '.$name_mo1  . '<br>';?><?php echo $cod_m1;?></td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="7%" class="normalTextSmaller">
 <?php if($no_request=='1' or $no_request=='2') echo '<img src=../files/users/'.$pic_mo1.' width=42 height=47 />' ?> 
  </td>
     <td  class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><br />
       <?php echo $row['add_abadi'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $v_request ;?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
</table>
           <p>&nbsp;</p>
           <p><a href="requests.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a>
            </p>
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