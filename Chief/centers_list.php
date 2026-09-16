<?php 
include('../lock_ce.php');
include('counter.php');
$id_ostan_sh = $_POST['id_ostan'];
//echo $ostan_sh = $_POST['ostan'];
$id_city_sh = $_POST['id_city'];
$city_sh = $_POST['city'] ;
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
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
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
      <?php include('top.php');?>
      </p>
<?php include_once('../login/config.php');
$query = "SELECT * FROM  mar WHERE  id_ostan = '$id_ostan_sh' and id_city = '$id_city_sh' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1">مشخصات مراکز جهاد کشاورزی شهرستان <?php echo $city_sh ?> </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="90%" height="144" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="4" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999">تعداد  تحت پوشش</td>
    <td width="8%" rowspan="2" bgcolor="#999999">کارشناس  پهنه<br /></td>
    <td width="7%" rowspan="2" bgcolor="#999999">تلفن همراه</td>
    <td height="56" colspan="3" bgcolor="#999999">مشخصات رئیس مرکز</td>
    <td width="16%" rowspan="2" bgcolor="#999999">نام مرکز </td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bordercolor="#FFFFFF" bgcolor="#999999"> آبادی <br /></td>
    <td bordercolor="#FFFFFF" bgcolor="#999999">شهر</td>
    <td width="10%" height="43" bgcolor="#999999">نام خانوادگی</td>
    <td width="10%" bgcolor="#999999">نام</td>
    <td width="6%" bgcolor="#999999">تصویر</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row)
  {
$id_mar = $row['id_mar'];
$query2 = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan_sh' and  id_city = '$id_city_sh' and  S_access = '2' 
and id_mar = '$id_mar'"   ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

	 
?>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="68" class="normalTextSmaller">
    <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <input type="hidden" name="tel_m" value="<?php echo $row2['tel_m'] ;?>" />
      <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
      </form>
  </td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="center_operation1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="31" height="30" /></button>
      </form>
  </td>
    
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="center_profile1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <input type="hidden" name="cod_m" value="<?php echo $row2['cod_m'] ;?>" />
      <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="31" height="30" /></button>
      </form>
  </td>
<td width="7%" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
<form  action="mar_listsabadi.php#1" method="post" onsubmit="target_popup2(this)">
  <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
  <input type="hidden" name="mar" value="<?php echo $row['mar'] ;?>" />
  <button><?php echo mar_abadi_count($row['id_mar'])  ; ?></button>
</form></td>
<td width="7%" bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="mar_listscity.php#1" method="post" onsubmit="target_popup2(this)">
  <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
  <input type="hidden" name="mar" value="<?php echo $row['mar'] ;?>" />
  <button><?php echo mar_shahr_count($row['id_mar'])  ;?></button>
</form></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_mor_count($row['id_mar'])?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['tel_m'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row2['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['mar'];?><br />
      <?php echo $row['id_mar'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="centers.php" title="برگشت به صفحه قبل"> <form  action="centers.php" method="POST">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
      <button style="width:120px ; height:30px ; font-family:Tahoma ; font-size:16px ">برگشت</button>
      </form> </a></p>    </p>
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



