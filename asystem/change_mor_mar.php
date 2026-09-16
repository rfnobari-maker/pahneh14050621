<?php
include("../lock_admin.php");
include('../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
     <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=320,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
<p align="center" ><span class="style1">ویرایش مرکز و مروج آبادی </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 
  <?php if (isset($_POST['add_abadi'])) 
 {  
$add_abadi=$_POST['add_abadi'];
$error = $_POST['error'];
 $query = "SELECT * from list_abadi where  add_abadi = ?  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array($add_abadi));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row['ostan'] ; 
$city= $row['city'] ; 
$deh= $row['deh'] ; 
$abadi= $row['abadi'] ; 
$add_abadi= $row['add_abadi'] ; 
$mor_cod_m= $row['mor_cod_m'] ; 
$id_mar= $row['id_mar'] ; 
$mar= $row['mar'] ; 
?>
  <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="38" colspan="2" bgcolor="#999999"><span class="text1">مشخصات مروج فعلی </span></td>
      <td colspan="2" bgcolor="#999999"><span class="text1">مشخصات مرکز فعلی</span></td>
      <td width="18%" rowspan="2" bgcolor="#999999" class="text1">آبادی</td>
      <td width="18%" rowspan="2" bgcolor="#999999" class="text1">دهستان</td>
      <td width="14%" rowspan="2" bgcolor="#999999"><span class="text1">شهرستان</span></td>
    </tr>
    <tr>
      <td height="35" bgcolor="#999999"><span class="text1">کد ملی </span></td>
      <td width="22%" bgcolor="#999999"><span class="text1">نام و نام خانوادگی</span></td>
      <td width="9%" bgcolor="#999999"><span class="text1">کد مرکز</span></td>
      <td width="15%" bgcolor="#999999"><span class="text1">نام مرکز</span></td>
    </tr>
    <tr>
      <td width="22%" height="48"><?php echo $mor_cod_m?></td>
      <td><?php echo user_name1($mor_cod_m) ?></td>
      <td><?php echo $id_mar ?></td>
      <td><?php echo $mar ?></td>
      <td><?php echo $abadi ?><br />
        <?php echo $add_abadi ?></td>
      <td><?php echo $deh ?></td>
      <td><?php echo $city ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
<form  action="mar_list.php" method="post" onsubmit="target_popup(this)">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
    <button><img src="../files/con_info.png" border="0"  title="لیست مراکز جهاد کشاورزی " width="16" height="16" /></button>
    <span class="input_text">مشاهده لیست مراکز
    جهاد کشاورزی </span>
</form>
   <p><span class="style8"><?php echo $error?></span>
     </p>
   <form id="form2" name="form2" method="post" action="">
     <table width="400" height="132" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
       <td width="238" height="52" ><input name="id_mar" type="text"class="input_text" id="id_mar" style="width:150px ; height:30px" tabindex="2"   value="<?php echo $id_mar ?>" /></td>
       <td width="262" style="text-align: right"> <span class="RedTitleSmall">*</span>:کد مرکز جهاد کشاورزی</td>
     </tr>
     <tr>
       <td height="49"><input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m" style="width:150px ; height:30px" tabindex="3" value="<?php echo $mor_cod_m?>"/></td>
       <td style="text-align: right">:کد مروج آبادی </td>
     </tr>
     <tr>
       <td height="31" colspan="2" class="RedTitleSmall" style="text-align: right">درج کد مرکز جهاد کشاورزی الزامی است *</td>
       </tr>
 </table>
   <p>
     <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ?>" />
     <input name="action2" type="submit" id="action1" style="width:100px ; height:40px" tabindex="2" value="بازگشت" /> 
     <input name="action1" type="submit" id="action2" style="width:100px ; height:40px" tabindex="1" value="ثبت " />
   </p>
 </form>
     <?php
 }
?>
     
   <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" >&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
  <?php if (isset($_POST['action2'])) 
 {
 ?>
 <form name="myform1" class="myform" method="post" action="index.php">
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php  
 }
 if (isset($_POST['action1'])) 
 {  
    $add_abadi=$_POST['add_abadi'];
if (isset($_POST['mor_cod_m']))
{
       $mor_cod_m = $_POST['mor_cod_m'];
}
else 
{
 $mor_cod_m = '' ;
}
 $id_mar=$_POST['id_mar'];
//
$query = "SELECT mar from mar where id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
$v_mar = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mar= $row['mar'] ; 
if ($id_mar=='' or $v_mar==0)
{
?>
 <form name="myform1" class="myform" method="post" action="">
 <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ?>" />
 <input type="hidden" name="error"  value="کد مرکز جهاد کشاورزی معتبر نمی باشد " />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
}
else 
{
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "UPDATE list_abadi SET id_mar=?,mar=?,mor_cod_m=? WHERE add_abadi =?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar,$mar,$mor_cod_m,$add_abadi));
edit_database_abadi($id_mar,$mor_cod_m,$id_abadi,$add_abadi) ;
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ویرایش مرکز و مروج آبادی',$id_ostan) ; 
alert(' آبادی مورد نظر با موفقیت ویرایش شد.') ;
?>
 <form name="myform1" class="myform" method="post" action="change_abadi_mar.php">
  </form>
 <script type="text/javascript">document.myform1.submit();</script>

<?php 
}
}
?>