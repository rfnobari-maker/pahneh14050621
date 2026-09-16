<?php
include '../lock_oce.php' ;
include '../login/config.php' ; 
$username = $_POST['username'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه پهنه بندی آبادی های  آذربایجان شرقی</title>
<script>
function close_window() {
      close();
 }
</script>
<style>
#send
{ font-family:Tahoma ; color:#039 ; border-radius:10px 
	
	}

#send:hover
{ background-color:#FF6
	
}
#notok
{
	  padding-top:100px ; color:#FFF ; line-height:200% ; font-family:Tahoma ; font-size:16px ; width:200px 
}
body {
	background-color: #09C;
	text-align: center;
}
</style>
</head>
<body>
<div align="center">
<?php 
$query = "SELECT  * FROM Last_user WHERE  PersCode =  '$username' ORDER BY date DESC , time DESC LIMIT 20 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p style="font-family: Tahoma; font-size: 16px; color: #FFF;">آخرین بازید از سامانه </p>
<table width="100%" height="142" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
    <tr align="center" class="style8">
      <td width="16%" height="74" bgcolor="#CCCCCC">ساعت </td>
      <td width="17%" bgcolor="#CCCCCC">تاریخ</td>
      <td width="7%" bgcolor="#CCCCCC">ردیف</td>

    </tr>
    <tr>
      <?php
	  $r = 1 ;
 foreach($stmt as $row)
 {
?>
      <td align="center" height="68" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['time'];?></td>
      <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date'];?></td>
      <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
	$r++ ; 
}
?>
</table>