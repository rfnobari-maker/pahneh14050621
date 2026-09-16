<?php 
include('../lock_ad.php');
include('../event.php') ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
      <p>
        <?
include('../login/config.php');
$query = "SELECT * from bah "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array());
?>
      </p>
      <p>&nbsp; </p>
      <p class="style1">لیست بهره برداران</p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="98%" height="153" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
    <td height="99" colspan="3" bgcolor="#999999">عملیات</td>
    <td width="9%" bgcolor="#999999">کارشناس مروج</td>
    <td height="99" bgcolor="#999999">شماره همراه</td>
    <td width="11%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="10%" bgcolor="#999999">نام خانوادگی</td>
    <td width="11%" bgcolor="#999999"> نام </td>
    <td width="12%" bgcolor="#999999">شهر / آبادی </td>
    <td width="12%" bgcolor="#999999">شهرستان </td>
    <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m) ;
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}

//echo $row2['User_Name'] ; 
?>
  <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="51" class="normalTextSmaller">
    <form  action="del_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
    <button onclick="return confirm('از حذف اطلاعات بهره بردار مطمئن هستید ؟ ')"><img src="../files/del1.png" title="حذف اطلاعات بهره بردار"    width="33" height="26"  alt=""/></button>
    </form></td>
    <td width="6%" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="edit_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
    <button><img src="../files/edit.png" title="ویرایش اطلاعات بهره بردار" width="33" height="26"  alt=""/></button>
    </form>
</td>
    <td width="6%" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="view_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
    <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
    </form>
  </td>
    <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../files/users/<? echo $pic ?>" width="37" height="43"  alt=""/><br />
      <?php echo user_name($mor_cod_m)?><br/>
      <?php echo $mor_cod_m?><br /></td>
    
  <td <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="11%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
    <td  class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
    <td class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
    <td class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
    <td class="normalTextSmaller"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>



