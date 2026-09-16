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
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
            <p>
 
   <?php include('top.php'); ?>
    <h1 class="style1">ثبت درخواست حذف آبادی مرکز</h1>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
      <?php
if (isset($_POST['add_abadi'])) 
{
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$add_abadi = $_POST['add_abadi'] ; 
$query = "SELECT mor_cod_m,add_abadi,abadi,deh,bakh,city,ostan,mar,id_mar FROM list_abadi WHERE add_abadi='".$add_abadi."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mor_cod_m=$row['mor_cod_m'];
?>
</P>
    </p>
    <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="15%" height="40" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">دهستان</td>
    <td width="12%" bgcolor="#CCCCCC">بخش</td>
    <td width="18%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="14%" bgcolor="#CCCCCC">استان</td>
    </tr>
  <tr>
 <td height="30" class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td><?php echo $row['deh'];?></td>
    <td><?php echo $row['bakh'];?></td>
    <td><?php echo $row['city'];?></td>
    <td><?php echo $row['ostan'];?></td>
    </tr>
</table>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
    <form id="form1" name="form1" method="post" action="">
      <p>&nbsp;</p>
      <p>
   <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>">
   <input type="hidden" name="city" value="<?php echo $row['city'] ;?>">
   <input type="hidden" name="mor_codm_old" value="<?php echo $row['mor_cod_m'] ;?>">
   <input type="hidden" name="markaz" value="<?php echo $row['mar'] ;?>">
   <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>">
   <input type="hidden" name="abadi" value="<?php echo $row['abadi'] ;?>">
   <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>">
   <input type="submit" name="action" value="ثبت درخواست" style="width:150px ; height:45px" tabindex="39" />
      </p>
    </form>
    <p>&nbsp;</p>
            <p><a href="change_request.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>       
            <!-- Tabs -->
<?php } else { echo '<p style="color:red">'.'مجوز دسترسی به این صفحه را ندارید '.'</p>';}?>
    </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
if (isset($_POST['action'])) 
 {  
  $ostan = $_POST['ostan'] ; 
  $city = $_POST['city'] ; 
  $mar = $_POST['markaz'] ; 
  $id_mar = $_POST['id_mar'] ; 
  $abadi = $_POST['abadi'] ; 
  $add_abadi = $_POST['add_abadi'] ; 
  $status = '1' ; 
  $no_request ='3' ; 
$query = "INSERT INTO change_mor (ostan,city,id_mar,mar,abadi,add_abadi,no_request,date_s,status) VALUES (:ostan,:city,:id_mar,:mar,:abadi,:add_abadi,:no_request,:date_s,:status)";
$q = $dbh->prepare($query);
$q->execute(array(':ostan'=>$ostan,':city'=>$city,':id_mar'=>$id_mar,':mar'=>$mar,':abadi'=>$abadi,':add_abadi'=>$add_abadi,':no_request'=>$no_request,':date_s'=>$date_edit,':status'=>$status));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت درخواست حذف آبادی مرکز',$id_ostan) ; 
alert('درخواست شما پس از تایید مدیر شهرستان اعمال خواهد شد ') ;
?>
<form name="myform" class="myform" method="post" action="change_request.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 ?>
