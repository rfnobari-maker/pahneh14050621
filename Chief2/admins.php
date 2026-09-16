<?php 
include('../lock_ce.php');
include('../event.php');
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
<?php include('../login/config.php');
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style8">داشبورد مدیریتی ادمین های استانی سامانه</p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="129" height="56" border="0" align="center">
             <tr>
               <td width="61"><form  action="admins_xls.php" method="post">
                 <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="39" height="43"  alt=""/></button>
               </form></td>
               <td width="58"><form  action="admins_doc.php" method="post">
                 <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="39" height="43"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <table width="98%" height="159" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="3" rowspan="3" bgcolor="#999999">عملیات</td>
    <td colspan="7" bgcolor="#999999">تعداد</td>
    <td height="39" colspan="4" bgcolor="#999999">مشخصات ادمین استان</td>
    <td width="12%" rowspan="3" bgcolor="#999999">استان </td>
    <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td height="28" colspan="2" bgcolor="#999999">       آبادی <br /></td>
    <td colspan="2" bgcolor="#999999">شهر</td>
    <td rowspan="2" bgcolor="#999999">کارشناس مروج<br /></td>
    <td width="5%" rowspan="2" bgcolor="#999999">مرکز</td>
    <td width="7%" rowspan="2" bgcolor="#999999">شهرستان<br /></td>
    <td width="9%" rowspan="2" bgcolor="#999999">همراه</td>
    <td width="7%" height="66" rowspan="2" bgcolor="#999999">نام خانوادگی</td>
    <td width="5%" rowspan="2" bgcolor="#999999">نام</td>
    <td width="7%" rowspan="2" bgcolor="#999999">تصویر</td>
  </tr>
  <tr align="center" class="text1">
    <td width="5%" bgcolor="#999999">فعال</td>
    <td width="4%" bgcolor="#999999">کل</td>
    <td width="5%" bgcolor="#999999">فعال</td>
    <td width="5%" bgcolor="#999999">کل</td>
  </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ;
$query2 = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan' and  S_access = '98' "  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
 <td  width="6%" height="58" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
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
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php echo ostan_abadi_count($row['id_ostan']);?></td>
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <?php echo kol_abadi_count($row['id_ostan']);?></td>
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_count($row['id_ostan']);?></td>
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo kol_shahr_count($row['id_ostan']);?></td>
    <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="ostan_promotes.php" method="post" onsubmit="return ray.ajax()">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
      <button><?php echo ostan_mor_count($row['id_ostan']);?></button>
    </form></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="ocenters_list.php" method="post" onsubmit="return ray.ajax()">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
      <button><?php echo ostan_mar_count($row['id_ostan']);?></button>
    </form></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="centers.php" method="post" onsubmit="return ray.ajax()">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
      <button><?php echo  ostan_city_count($row['id_ostan']);?></button>
    </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php  echo user_tel($row2['cod_m']) ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php  echo $row2['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><form  action="last_login.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <button><img id="img1" src="../files/users/<?php echo $pic;?>" width="37" height="45"  alt=""/></button>
      </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="users.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



