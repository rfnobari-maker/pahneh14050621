<?php include('../lock_ad.php');?>
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
  <?php include('top.php'); ?>
      <table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?php include('../login/config.php');
//$query = "SELECT * FROM  public_abadi4 WHERE  id_ostan = $id_ostan" ;

//$query = "SELECT public_abadi4.add_abadi ,public_abadi4.abadi , public_abadi4.deh , public_abadi4.city , public_abadi4.id_ostan FROM public_abadi4
//LEFT OUTER JOIN list_abadi ON public_abadi4.add_abadi = list_abadi.add_abadi
//WHERE public_abadi4.id_ostan = '$id_ostan' and list_abadi.add_abadi IS NULL GROUP BY city";


//$query = "SELECT * 
//  FROM public_abadi LEFT OUTER JOIN list_abadi 
//       ON public_abadi.add_abadi = list_abadi.add_abadi 
//  where add_abadi is null  ";

//$query = "SELECT public_abadi4.* 
$query = "SELECT public_abadi4.add_abadi,public_abadi4.abadi,public_abadi4.deh,public_abadi4.city,public_abadi4.id_ostan

FROM public_abadi4
LEFT JOIN list_abadi ON list_abadi.add_abadi = public_abadi4.add_abadi
WHERE list_abadi.add_abadi IS NULL and public_abadi4.id_ostan  = $id_ostan" ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><span class="normalTextSmall">لیست آبادی های غیر فعال استان</span></p>
           <p><a href="inactive_abadi_xls.php"><img src="../files/xls.png" width="75" height="80"  alt=""/></a></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div align="right" class="LinkRedTitle" style="margin-right:45px">
             
           </div>
           
           <table width="90%" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="10%" height="41" bgcolor="#CCCCCC">عملیات</td>
    <td width="27%" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="19%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="20%" bgcolor="#CCCCCC">دهستان</td>
    <td width="16%" bgcolor="#CCCCCC">شهرستان </td>
    <td width="8%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td height="55" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="doactive_abadi.php" method="post">
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <button><img src="../files/ok.png" border="0"  title="فعال سازی آبادی" width="39" height="39" /></button>
</form></td>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['add_abadi'];?></span></td>
     <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a>
            </p>
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
