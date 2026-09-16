<?php include('lock_p1.php');?>
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
      <div style="float:right ; margin-right:30px ; margin-top:15px ; padding:10px "  > <img src="../files/users/<?php echo $pic ?>" width="85" height="114"  alt="تصویر کاربر "/></div>
              <p align="right" class="link" style="margin-right:30px">&nbsp;</p>
              <p align="right" class="style2" style="margin-right:30px">پانل مدیریتی سامانه پهنه بندی آبادی های استان</p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه روسای مراکز جهاد کشاورزی </p>
              <p align="right" class="normalTextSmaller" style="margin-right:30px">محل خدمت : <?php echo $ostan.'&nbsp; /&nbsp;'.$city.'&nbsp;/&nbsp;'.$markaz ;  ?></p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?
include('../login/config.php');
$query = "SELECT * FROM  list_abadi WHERE  id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><span class="style1">لیست آبادی های تحت پوشش مرکز</span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="85%" height="107" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td height="50" colspan="3" bgcolor="#CCCCCC">عملیات</td>
    <td width="15%" height="50" bgcolor="#CCCCCC"><p> <span class="style2">آخرین بروز رسانی اطلاعات<br />
      عمومی آبادی</span></p></td>
    <td colspan="2" bgcolor="#CCCCCC">مشخصات مروج آبادی</td>
    <td width="17%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="19%" bgcolor="#CCCCCC">دهستان</td>
    <td width="5%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT * FROM  users  where cod_m = '$cod_m' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
// تاریخ بروز رسانی اطلاعات عمومی 
$id_abadi = substr($row['add_abadi'],13,6) ;
$query3 = "SELECT * FROM  public_abadi  where id_abadi = '$id_abadi' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
<td width="6%" height="48">&nbsp;</td>
<td width="5%">&nbsp;</td>
<td width="7%"><form  action="public_abadi.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><img src="../files/view.png" border="0"  title="ويرايش اطلاعات عمومی آبادی" width="28" height="23" /></button>
</form></td>
   <td class="normalTextSmaller"><?php echo $row3['up_date'];?></td>
    <td width="20%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
 <td width="6%" class="normalTextSmaller"><img src="../files/users/<?php echo $pic_mo;?>" width="28" height="33"  alt=""/></td>
 <td class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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
