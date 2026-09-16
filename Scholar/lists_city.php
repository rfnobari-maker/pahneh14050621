<?php include('../lock_Sc.php');
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
  #img1
    {
	border-radius:40px ; 
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
  <?php include('top.php'); ?>
<?php include('../login/config.php');
$query = "SELECT * FROM  list_city WHERE  id_ostan = '$id_ostan' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>&nbsp;</p>
           <p class="style1">لیست شهر های تحت پوشش </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="85%" height="97" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="49" colspan="2" bgcolor="#CCCCCC">مشخصات مروج</td>
    <td width="15%" bgcolor="#CCCCCC">تعداد بهره بردار</td>
    <td width="15%" bgcolor="#CCCCCC">آدرس آماری شهر</td>
    <td width="12%" bgcolor="#CCCCCC">نام شهر</td>
    <td width="15%" bgcolor="#CCCCCC">بخش</td>
    <td width="17%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="16%" bgcolor="#CCCCCC">استان</td>
    <td width="9%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
    
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td width="11%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m']);?></td>
    <td width="5%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../files/users/<?php echo user_pic($row['mor_cod_m']) ?>" width="42" height="46"  alt=""/></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller">
 <form action="city_list_bah.php" method="post">
  <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
  <button><?php echo shahr_bah_count($row['add_city'],$id_ostan)?></button>
</form>
 </td>
<td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'];?></td>
<td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['bakh'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



