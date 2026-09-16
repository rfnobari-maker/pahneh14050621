<?php
include("../../lock_p1.php");
include('../../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" class="style8" >لیست تغییر کاربری های های گزارش شده توسط شما</p>
 <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p>
   <?php
include('../../login/config.php');
$query = "SELECT end_bee from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
$bah_cod_m=$_POST['bah_cod_m'];
$query = "SELECT * from tk_arazi where mor_cod_m =:mor_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
if ($found>0) {
?>
 </p>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
    <tr class="text1">
    <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
    <td width="8%" rowspan="2" bgcolor="#006699">متراژ زمین <br />
      <span class="Row-Footer">مترمربع</span></td>
    <td width="7%" rowspan="2" bgcolor="#006699">نوع اراضی</td>
    <td width="7%" rowspan="2" bgcolor="#006699">نوع کاربری</td>
    <td height="29" colspan="2" bgcolor="#006699">مشخصات فرد</td>
    <td colspan="2" bgcolor="#006699">موقعیت محل</td>
    <td width="9%" rowspan="2" bgcolor="#006699">تاریخ گزارش </td>
    <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="10%" height="31" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="13%" bgcolor="#006699">آبادی</td>
      <td width="7%" bgcolor="#006699">شهرستان</td>
      </tr>  <tr>
<?php 
$r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_ka']=='1') $v_no_ka = 'زراعی'; else $v_no_ka = 'باغی' ;
 if ($row['no_ara']=='1') $v_no_ara = 'آبی'; else $v_no_ara = 'دیم' ;
  ?>
    <td width="9%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
<?php //if (!$end_bee=='1') {?>
    <form  action="del_tk_arazi.php" method="post">
    <input type="hidden" name="mor_cod_m" value="<?php echo $row['mor_cod_m']  ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button onclick="return confirm('از حذف این گزارش مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف گزارش" width="33" height="26"  alt=""/></button>
    </form>
    <?php //}?>
        </td>
    <td width="7%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php //if ((!$end_bee=='1') or (!$end_bee=='3'))  {?>
    <form  action="edit_tk_arazi.php" method="post">
     <input type="hidden" name="mor_cod_m" value="<?php echo $row['mor_cod_m'] ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button><img src="../../files/edit.png" title="ویرایش اطلاعات زنبورستان" width="33" height="26"  alt=""/></button>
    </form>
    <?php //}?>
</td>
    <td width="8%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="view_tk_arazi.php" method="post">
      <input type="hidden" name="mor_cod_m" value="<?php echo $row['mor_cod_m'] ;?>" />
      <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
      <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="33" height="26"  alt=""/></button>
      </form>
    </td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tk'] ;  ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_no_ara ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_no_ka ?></td>
    <td height="81" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_cod_m'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'].'-'.$row['name']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name($row['id_city']); ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td> 
     </tr>
    <?php 
	$r++ ; 
	}?>
   </table>
<?php
 }
?>
   <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
