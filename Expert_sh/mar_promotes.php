<?php 
include('../lock_expsh.php');
include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

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
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<?php
include('top.php');
if (isset($_POST['id_mar'])) 
{
include('../login/config.php');
$id_mar = $_POST['id_mar'] ;
$mar = $_POST['mar'] ;
$query = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and S_access = '1'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>&nbsp;</p>
           <p class="style1">لیست مروجین  مرکز جهاد کشاورزی  <?php echo $mar ; ?></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="93%" height="116" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="58" colspan="4" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999"> تعداد و لیست آبادی <br />
      های تحت پوشش</td>
    <td width="13%" bgcolor="#999999">تلفن همراه</td>
    <td width="12%" bgcolor="#999999">کد ملی</td>
    <td width="14%" bgcolor="#999999">نام خانوادگی</td>
    <td width="10%" bgcolor="#999999">نام</td>
    <td width="6%" bgcolor="#999999">تصویر</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> height="58" class="normalTextSmaller"><form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
      <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
    </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><form  action="send_pm.php" method="post">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
    </form></td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
  <form  action="prom_operation.php" method="post">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <input type="hidden" name="id_city" value="<?php echo  $row['id_city']  ;?>">
    <input type="hidden" name="city" value="<?php echo  $row['city'] ;?>">
    <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="40" height="35" /></button>
    </form>
</td>

<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
      <form  action="promo_profile.php" method="post">
      <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
      <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="40" height="35" /></button>
      </form>
</td>
    <td width="9%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="promo_listsabadi.php" method="post">
      <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
      <input type="hidden" name="name" value="<?php echo $row['name'] ;?>" />
      <input type="hidden" name="last_name" value="<?php echo $row['Last_name'] ;?>" />
      <button><img src="../files/abadi.png" border="0"  title="مشاهده لیست آبادی ها" width="38" height="28" /></button>
      </form>
   </td>
    <td width="6%" class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_abadi_count($row['cod_m'])?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
<?php } else { echo '<p style="color:red">'.'مجوز دسترسی به این صفحه را ندارید '.'</p>';}?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="city_promo.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



