<?php include('../lock_Sc.php');
$id_mar = $_POST['mar'] ; 
$add_bakh = $_POST['bakh'] ; 
?>
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
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
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
  </tr>
  <tr>
      <td>
<?php 
include('top.php'); 
include ('../login/config.php');
?>
<p><span class="style1">اطلاعات عمومی  شهر های تحت پوشش </span></p>
<p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
  <div style=" width: 500px; padding: 15px;border: 3px solid navy; margin:auto" >
    <form action='' method="post">
        <table width="100%" border='0' align=center cellpadding='0' cellspacing='0'>
        <tr bgcolor='#f1f1f1' > <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td> 
        </tr>
<tr >
  <td height="45" bgcolor="#f1f1f1" class="input_text" align="right" >
    <select dir="rtl"  name="mar" id="mar" style="width:170px ; height:40px" >
      <option value="0">کلیه مراکز</option>
      <?php
$query = "SELECT DISTINCT id_mar,mar FROM  list_city WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
      <option value="<?php echo $row['id_mar'] ;?>" 
      <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>>  
	  <?php echo $row['mar'] ;?></option>
      <?php }?>
    </select>
  </td>
  <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2">: مرکز خدمات</font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" bgcolor="#FFFFFF" class="input_text" align="right" >
  <select dir="rtl"  name="bakh" id="bakh" style="width:170px ; height:40px" >
  <option value="0">کلیه بخش های شهرستان</option>
  <?php
$query = "SELECT DISTINCT add_bakh,bakh FROM  list_city WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
    <option value="<?php echo $row['add_bakh'] ;?>"
   <?php if ($row['add_bakh']==$add_bakh) echo 'selected=selected'?>>  
    <?php echo $row['bakh'] ;?></option>
<?php }?>
  </select></td>
  <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> :بخش</font></td>
</tr>
<tr bgcolor='#ffffff' > <td colspan=2 align=center><p>&nbsp;
  </p>
  <p>
    <input type=reset value='پاک کردن ' style="width:150px ; height:45px" >
    <input type=submit name="action" value='جستجو' style="width:150px ; height:45px" />
  </p>  </font></td></tr>
</table>
</form>
</div>

  <p>
    <?php if(isset($_POST['action']))
{
$id_mar = $_POST['mar'] ; 
$add_bakh = $_POST['bakh'] ; 
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_bakh == 0) { $v_add_bakh = 'add_bakh=add_bakh' ;} else { $v_add_bakh = "add_bakh='$add_bakh'" ;}
$query = "SELECT * FROM  list_city where id_city = '$id_city' and  $v_id_mar and $v_add_bakh  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>  
  <table width="90%" height="100" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td height="50" colspan="3" bgcolor="#999999">عملیات</td>
      <td width="12%" height="50" bgcolor="#999999"><p> آخرین بروز رسانی اطلاعات<br />
      </p></td>
      <td colspan="2" bgcolor="#999999">مشخصات مروج </td>
      <td width="13%" bgcolor="#999999">نام شهر</td>
      <td width="12%" bgcolor="#999999">شهرستان</td>
      <td width="7%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_city = $row['add_city'] ;
$query2 = "SELECT * FROM  users  where cod_m = $cod_m " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
// تاریخ بروز رسانی اطلاعات عمومی 
$add_city = $row['add_city'] ;
$query3 = "SELECT * FROM  public_city  where add_city = $add_city " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$up_date = $row3['up_date'] ; 
if ($up_date=='') $up_date =  '<p style=color:red> عدم بروز رسانی</p>' ;
?>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" height="58" class="normalTextSmaller"><form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
        <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
        <input type="hidden" name="tel_m" value="<?php echo $row2['tel_m'] ;?>" />
        <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><form  action="send_pm.php" method="post">
        <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
        <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
      </form></td>
      <td width="6%"><form  action="public_abadi.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
        <button><img src="../files/view.png" border="0"  title="مشاهده اطلاعات عمومی آبادی" width="28" height="23" /></button>
      </form></td>
      <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $up_date ;?></td>
      <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="19%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
      <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><img src="../files/users/<?php echo $pic_mo;?>" width="37" height="45"  alt=""/></td>
      <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['abadi'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
      <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
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
