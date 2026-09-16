<?php include('../lock_cp.php');
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
.tabel { margin-right:45px }
.text_r { margin-right:0px }
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
    <td><p><!--تاریخ فارسی-->
      <head>

      <style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
      </style>
    </p>
 <?php include('top.php') ;?>
  <body>
      </p>
      <p>&nbsp;</p>
      <div id="content">
  <p  align="center" class="style8">مشاهده عملکرد  کاربر در سامانه 
    <?php
if(isset($_POST['username']))
{
$username = $_POST['username'] ; 
include_once('../login/config.php');
$query = "SELECT * FROM  log  where username = '$username'  ORDER BY date DESC , time DESC " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$query2 = "SELECT * FROM  users  where username = '$username' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    ?>
  <a name="1" id="1"></a></p>
  <table  style=" margin-right:35px" width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
    <tr>
      <td width="111" rowspan="2"><p class="style8"><img src="../files/users/<?php echo $row2['pic'];?>" width="61" height="75"  alt=""/></p></td>
      <td height="45" colspan="4"><span class="style8"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></span></td>
      </tr>
    <tr>
      <td width="216" height="44" align="right" ><?php echo $row2['cod_m'] ;  ?></td>
      <td width="184" align="right" ><span class="style8">:کد ملی</span></td>
      <td width="204"><?php  echo '<dir style=margin-right:45px>'.$row2['name'].' '.$row2['Last_name'].'</div>'; ?></td>
      <td width="139"><span class="style8">:نام و نام خانوادگی </span></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
   <table width="90%" height="107" border="1" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="style8">
    <td width="17%"  height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="13%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="14%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="21%"  bgcolor="#CCCCCC">نام آبادی</td>
    <td width="27%"  bgcolor="#CCCCCC">عملیات</td>
    <td width="8%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
foreach($stmt as $row){
	$add_abadi =  $row['add_abadi'] ; 
$query3 = "SELECT * FROM  list_abadi  where add_abadi = '$add_abadi' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
    <td height="56" class="normalTextSmall"><?php echo $row['ip'];?></td>
    <td class="normalTextSmall"><?php echo $row['time'];?></td>
    <td class="normalTextSmall"><?php echo $row['date'];?></td>
    <td class="normalTextSmall"><?php echo $row3['abadi'];?></td>
    <td class="normalTextSmall"><?php echo $row['verb'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?php }
else 
{
    echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
</div>
          </p>
      <p>
        <!--end form --> 
     <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>