<?php include('../lock_p2.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
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
$query = "SELECT mor_cod_m,add_abadi,abadi,deh FROM  list_abadi WHERE  id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();?>
           <p><span class="style1">درخواست ثبت تغییرات </span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div align="right" class="LinkRedTitle" style="margin-right:45px">
             <form id="form1" name="form1" method="post" action="list_request.php">
               <p>
                 <input type="hidden" name="id_mar" value="<?php echo $id_mar?>"/>
                 <input type="submit" name="submit" id="submit" style="height:30px"value=" مشاهده درخواست های قبلی"  title="جهت مشاهده درخواست های خود کلیک کنید "/>
                 <br />
               </p>
             </form>
           </div>
           <table width="90%" height="112" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td height="50" colspan="3" bgcolor="#CCCCCC">عملیات</td>
    <td width="16%" height="50" bgcolor="#CCCCCC"><p> <span class="style2">آخرین بروز رسانی اطلاعات<br />
      عمومی آبادی</span></p></td>
    <td colspan="2" bgcolor="#CCCCCC">مشخصات مروج آبادی</td>
    <td width="17%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">دهستان</td>
    <td width="5%" bgcolor="#CCCCCC">ردیف</td>
  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT pic,Last_name,name FROM  users  where cod_m = '$cod_m' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
// تاریخ بروز رسانی اطلاعات عمومی 
$id_abadi = substr($row['add_abadi'],10,6) ;
$query3 = "SELECT up_date FROM  public_abadi4  where id_abadi = '$id_abadi' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$up_date = $row3['up_date'] ; 
if ($up_date=='') $up_date =  '<p style=color:red> عدم بروز رسانی</p>' ;
?>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="8%" height="60">
<form  action="del_abadi.php" method="post">
<input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
<button><img src="../files/download-(2).jpg" border="0"  title="درخواست حذف آبادی" width="37" height="35" /></button>
</form>
</td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%">
 <form  action="del_prom.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><img src="../files/delete.jpg" border="0"  title=" درخواست حذف مروج آبادی" width="37" height="35" /></button>
</form>
</td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="8%">
  <form  action="change_prom.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><img src="../files/plan-2-action.png" border="0"  title=" درخواست تغییر مروج آبادی" width="37" height="35" /></button>
</form></td>
   <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $up_date ;?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="18%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="7%" class="normalTextSmaller"><img src="../files/users/<?php echo $pic_mo;?>" width="42" height="47"  alt=""/></td>
     <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a>
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