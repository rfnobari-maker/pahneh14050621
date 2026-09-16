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
$query = "SELECT id,mor_codm_old,mor_codm_new,abadi,no_request,date_s,status,Last_name,name,add_abadi FROM  change_mor WHERE  id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><span class="style1"> لیست درخواست ها</span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div align="right" class="LinkRedTitle" style="margin-right:45px"></div>
           <table width="98%" height="112" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="6%" height="50" bgcolor="#CCCCCC">حذف </td>
    <td width="10%" bgcolor="#CCCCCC">آخرین وضعیت</td>
    <td height="50" bgcolor="#CCCCCC">تاریخ ثبت</td>
    <td height="50" colspan="2" bgcolor="#CCCCCC"><p> <span class="style8"> مروج 2</span></p></td>
    <td colspan="2" bgcolor="#CCCCCC">مروج 1</td>
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
$query2 = "SELECT name,Last_name,pic FROM  users  where cod_m = '$cod_m1' " ;
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
$query2 = "SELECT  name,Last_name,pic FROM  users  where cod_m = '$cod_m2' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo2 = $row2['pic'];
$name_mo2 = $row2['name'];
$last_name_mo2 = $row2['Last_name'];
$pic_mo2 = $row2['pic'];
if ($pic_mo2=='') $pic_mo2 = 'no_pic.png' ; 
?>
<td height="60" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php if($status=='1') { ?>
    <form action="request_del1.php" method="POST">
    <input type="hidden" name="del_id" value="<?php echo $row['id'] ;?>" />
    <button onclick="return confirm('از حذف درخواست مطمئن هستید ؟ ')"><img src="../files/del1.png" border="0"  title="حذف درخواست" width="20" height="20" >    </button>
     </form>
    <?php }?>
            </td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $v_satus ;?></span></td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="11%"><span class="normalTextSmaller"><?php echo $row['date_s'];?></span></td>
 <td width="12%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $last_name_mo2.' '.$name_mo2 ;  ?></td>
 <td width="7%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
 <?php if($no_request=='1') echo '<img src=../files/users/'.$pic_mo2.' width=42 height=47 />' ?> 
 </td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="14%" class="normalTextSmaller"><?php echo $last_name_mo1.' '.$name_mo1 ;?></td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="7%" class="normalTextSmaller">
 <?php if($no_request=='1' or $no_request=='2') echo '<img src=../files/users/'.$pic_mo1.' width=42 height=47 />' ?> 
  </td>
     <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><br />
       <?php echo $row['add_abadi'];?> <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $v_request ;?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p><a href="change_request.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg"  alt="" width="118" height="47" border="0"/> </a>
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
