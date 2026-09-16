<?php include('../lock_p2.php');?>
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
  #img1
    {
	border-radius:40px ; 
	}

-->
</style>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
      <td>
       <?php include('top.php'); ?>

      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?php 
$query = "SELECT add_city,shahr,bakh,city,ostan FROM  list_city WHERE  id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><span class="style1">اطلاعات عمومی  شهرهای های تحت پوشش </span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="90%" height="100" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="50" colspan="3" bgcolor="#999999">عملیات</td>
    <td width="15%" height="50" bgcolor="#999999"><p> آخرین بروز رسانی اطلاعات<br />
    </p></td>
    <td colspan="2" bgcolor="#999999">مشخصات مروج </td>
    <td width="17%" bgcolor="#999999">شهر</td>
    <td width="19%" bgcolor="#999999">بخش</td>
    <td width="5%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_city = $row['add_city'] ;
$query2 = "SELECT * FROM  users  where cod_m = '$cod_m' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
// تاریخ بروز رسانی اطلاعات عمومی 
$id_abadi = substr($row['add_abadi'],13,6) ;
$query3 = "SELECT * FROM  public_city  where add_city = '$add_city' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$up_date = $row3['up_date'] ; 
if ($up_date=='') $up_date =  '<p style=color:red> عدم بروز رسانی</p>' ;
?>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="8%" height="48"><img src="../files/send_mail.png" width="30" height="30"  alt=""/></td>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="7%"><img src="../files/receive_mail.png" width="30" height="30"  alt=""/></td><td width="7%"><form  action="public_abadi.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><img src="../files/view.png" border="0"  title="مشاهده اطلاعات عمومی آبادی" width="28" height="23" /></button>
</form></td>
   <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $up_date ;?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="20%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><img  id="img1" src="../files/users/<?php echo $pic_mo;?>" width="37" height="45"  alt=""/></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['shahr'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['bakh'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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
