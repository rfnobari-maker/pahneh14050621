<?php include('../lock_ce.php');
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
function close_window() {
      close();
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
   <?php include('top.php'); 
if (isset($_POST['id_mar']))
{
$id_mar = $_POST['id_mar'];
$mar = $_POST['mar'] ;
include('../login/config.php');
$query = "SELECT * FROM  list_city WHERE  id_mar = '$id_mar'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>&nbsp;</p>
           <p class="style1">لیست شهر های تحت پوشش </p>
           <p class="style1"><span class="style8">مرکز جهاد کشاورزی  : <?php echo  $mar  ?> <span class="style21"><a name="1" id="1"></a></span></span></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="85%" height="97" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="style8">
    <td width="19%" height="49" bgcolor="#FFFFCC">آدرس آماری شهر</td>
    <td width="14%" bgcolor="#FFFFCC">شهر</td>
    <td width="16%" bgcolor="#FFFFCC">بخش</td>
    <td width="15%" bgcolor="#FFFFCC">شهرستان</td>
    <td width="14%" bgcolor="#FFFFCC">استان</td>
    <td width="7%" bgcolor="#FFFFCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td height="48" class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $row['add_city'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $row['shahr'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $row['bakh'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $row['city'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#f1f1f1' ?>><?php echo $r;?></td>
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
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p>
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



