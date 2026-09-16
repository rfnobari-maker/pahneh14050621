<?php include('../lock_p3.php');?>
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
<?php include ('top.php') ;
if (isset($_POST['mor_cod_m']))
{
$mor_cod_m = $_POST['mor_cod_m'] ; 
include('../login/config.php');
$query = "SELECT * FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>&nbsp;</p>
           <p class="style1">لیست آبادی های تحت پوشش </p>
           <p class="style8">نام و نام خانوادگی مروج کشاورزی : <?php echo  $_POST['last_name'].' - '.$_POST['name']  ?> </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="85%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="19%" height="49" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="14%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">دهستان</td>
    <td width="16%" bgcolor="#CCCCCC">بخش</td>
    <td width="15%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="14%" bgcolor="#CCCCCC">استان</td>
    <td width="7%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$id_mar = $row['id_mar']
?>
<td height="48" class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td class="normalTextSmaller"><?php echo $row['bakh'];?></td>
    <td class="normalTextSmaller"><?php echo $row['city'];?></td>
    <td class="normalTextSmaller"><?php echo $row['ostan'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
else 
{
	echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
</table>
           <p>&nbsp;</p>
          <form name='back' action="mar_promotes.php" method="post">
           <input type="hidden" name="id_mar" value="<?php echo $id_mar  ;?>">
           <input type="hidden" name="mar" value="<?php echo $markaz ;?>">
           <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="39" />
          </form>
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



