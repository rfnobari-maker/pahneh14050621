<?php 
include('../lock_oce.php');
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<?php include('../login/config.php');
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' order by id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1">داشبورد مدیریتی /  شهرستان های استان </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
           </p>
           <p><a href="centers_xls.php"><img src="../files/xls.png" width="59" height="65"  alt=""/></a> </p>
           <table  align="center" class="my-table"  >
             <tr align="center" class="text1">
    <td height="56" colspan="3" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="5" bgcolor="#999999">تعداد</td>
    <td height="56" colspan="3" bgcolor="#999999">مشخصات مدیر شهرستان </td>
    <td width="13%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">تعداد  بهره بردار</td>
    <td bgcolor="#999999"> آبادی <br /></td>
    <td bgcolor="#999999">شهر</td>
    <td bgcolor="#999999">مروج<br /></td>
    <td width="5%" bgcolor="#999999">مرکز<br /></td>
    <td width="13%" height="66" bgcolor="#999999">نام خانوادگی</td>
    <td width="11%" bgcolor="#999999">نام</td>
    <td width="5%" bgcolor="#999999">تصویر</td>
  </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
	 $id_city = $row['id_city'] ;
$query2 = "SELECT  username,tel_m,cod_m,pic,Last_name,name FROM  users WHERE  id_city = '$id_city' and id_ostan = '$id_ostan' and  S_access = '3'"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
  <td width="6%" height="58" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="send_pm.php" method="post">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
    </form>  </td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="center_operation.php" method="post">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="31" height="30" /></button>
      </form>
  </td>
    
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="8%" class="normalTextSmaller">
    <form  action="center_profile.php" method="post">
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <input type="hidden" name="cod_m" value="<?php echo $row2['cod_m'] ;?>" />
      <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="31" height="30" /></button>
      </form>
  </td>
  <?php if(city_status($id_ostan,$row['id_city'])=='1') $conf_status='../files/ok.png'; ?>
  <?php if(city_status($id_ostan,$row['id_city'])=='2') $conf_status='../files/notok.png'; ?>
    
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="liste_benef.php" method="post">
    <input type="hidden" name="id_city2" value="<?php echo $row['id_city'] ;?>" />
    <input type="hidden" name="city2" value="<?php echo $row['city'] ;?>" />
    <button><?php echo city_bah_count($id_ostan,$row['id_city'])?></button>
  </form></td>
  <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="center_listsabadi.php" method="POST">
      <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
      <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
      <button><?php echo city_abadi_count($id_ostan,$row['id_city'])?></button>
      </form>
  </td>
    <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="center_listscity.php" method="post">
      <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
      <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
      <button><?php echo city_shahr_count($id_ostan,$row['id_city'])?></button>
      </form></td>
    <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="city_promotes.php" method="post">
      <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
      <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
      <button><?php echo city_mor_count($id_ostan,$row['id_city'])?></button>
      </form></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="centers_list.php" method="post">
        <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
        <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
        <button><?php echo city_mar_count($id_ostan,$row['id_city']);?></button>
        </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row2['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row2['name'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p class="style8"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p class="style8">کل  بهره بردار ثبت شده استان : 
             <?php echo ostan_bah_count($id_ostan)?> نفر</p>
           <p class="style8">&nbsp;</p>
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