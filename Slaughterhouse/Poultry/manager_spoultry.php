<?php
include("../../lock_expar.php");
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
 <title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
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
 include ('../../login/config.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" ><span class="style8">مدیریت اطلاعات مرغداری های صنعتی </span><br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" />
     :کد ملی مرغداری / مدیر عامل</p>
  <p>&nbsp;</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
include('../../login/config.php');
$query = "SELECT end_bee from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 

$bah_cod_m=$_POST['bah_cod_m'];
$query = "SELECT * from spoultry where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
    <tr class="text1">
    <td rowspan="2" bgcolor="#006699">عملیات</td>
    <td width="8%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br />
      مروج</td>
    <td width="6%" rowspan="2" bgcolor="#006699">ظرفیت</td>
    <td width="7%" rowspan="2" bgcolor="#006699">نوع مجوز</td>
    <td height="54" colspan="2" bgcolor="#006699">مشخصات مرغدار</td>
    <td width="10%" rowspan="2" bgcolor="#006699">نوع بهره برداری</td>
    <td colspan="3" bgcolor="#006699">موقعیت مرغداری</td>
    <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="8%" height="54" bgcolor="#006699">کد ملی </td>
      <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="11%" bgcolor="#006699">شهر/آبادی</td>
      <td width="12%" bgcolor="#006699">شهرستان</td>
      <td width="11%" bgcolor="#006699">استان</td>
      </tr>  <tr>
<?php  
  $r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_bah']=='1') $v_no_bah='مرغ گوشتی' ;	 
if ($row['no_bah']=='2') $v_no_bah='مرغ تخمگذار' ;	 
if ($row['no_bah']=='3') $v_no_bah='مادر گوشتی' ;	 
if ($row['no_bah']=='4') $v_no_bah='مادر تخمگذار' ;	 
if ($row['no_bah']=='5') $v_no_bah='اجداد گوشتی' ;	 
if ($row['no_bah']=='6') $v_no_bah='اجداد تخمگذار' ;	 
if ($row['no_bah']=='7') $v_no_bah='پولت تخمگذار' ;	 
if ($row['no_bah']=='8') $v_no_bah='جوجه کشی' ;	 
if ($row['no_bah']=='9') $v_no_bah='شترمرغ مولد' ;	 
if ($row['no_bah']=='10') $v_no_bah='شترمرغ پرواری' ;	 
if ($row['no_bah']=='11') $v_no_bah='بوقبمون مولد' ;	 
if ($row['no_bah']=='12') $v_no_bah='بوقلمون گوشتی' ;	 
if ($row['no_bah']=='13') $v_no_bah='بلدرچین' ;	 
if ($row['no_bah']=='14') $v_no_bah='کبک' ;	 
if ($row['no_bah']=='15') $v_no_bah='پرندگان زینتی' ;	 
if ($row['no_bah']=='16') $v_no_bah='سایر ماکیان' ;	 
if ($row['no_moj']=='1') $v_no_moj='پروانه بهره برداری' ;	 
if ($row['no_moj']=='2') $v_no_moj='کارت شناسائی' ;	 
if ($row['no_moj']=='3') $v_no_moj='فاقد مجوز' ;	 
  ?>
    <td width="9%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="view_spoultry.php" method="post">
      <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
      <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
      <button><img src="../../files/view.png" title="نمایش اطلاعات مرغداری"  width="33" height="40"  alt=""/></button>
      </form>
    </td>
    <td height="81" class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />      
      <?php echo user_name($row['mor_cod_m'])?><br/><?php echo $row['mor_cod_m']?><br /></td>
     <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_unit'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_moj ?></td>
    <td height="81" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'] ?></p></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah?></td>
    <td width="11%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
    <td width="12%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name($row['id_city']); ?></td>
    <td width="11%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan'])?></td> 
    <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $r;?></span></td> 

    </tr>
    <?php $r++ ; 
}?>
   </table>
<?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
   <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
