<?php 
include('../lock_ce.php');
include('../event.php') ;
$page = 'http://10.7.1.144/Chief/live_view.php' ; 
$sec = "10";
header("Refresh: $sec; url=$page");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
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
    <td><p><!--تاریخ فارسی--></p>
      <p>
  
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
      <?php include('top.php');?>
      
<div id="content">
  <p  align="center" class="style8">مشاهده عملکرد بروز کاربران در سامانه </p>
           <p  align="center" class="style8"> 
             <?php
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
include('../login/config.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
echo $date_edit ; 
$query = "SELECT ip,time,date,add_abadi,verb,username FROM  log  where date = '$date_edit'  ORDER BY date DESC , time DESC LIMIT $start, $limit" ;
$query1 = "SELECT id FROM log  where date = '$date_edit'  ORDER BY date DESC , time DESC " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           : امروز</p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table  width="90%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="style8">
    <td width="12%"  height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="8%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="9%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="16%"  bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="21%"  bgcolor="#CCCCCC">عملیات</td>
    <td  colspan="2"  bgcolor="#CCCCCC">مشخصات کاربر</td>
    <td width="4%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = $start+1 ;
 foreach($stmt as $row){
$username = $row['username'] ; 
$query2 = "SELECT ostan,Last_name,name,city,markaz,pic FROM  users  where username = '$username' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td class="persianumber normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="persianumber normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo abadi_name($row['add_abadi']).' '.$row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td width="24%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'].' / '.$row2['city'].' - '.$row2['markaz'];?></td>
    <td width="6%" class="normalTextSmaller"><a href="#" title="<?php echo 'استان'.'&nbsp;'.$row2['ostan']?>"><img id="img1" src="../files/users/<?php echo $row2['pic'];?>" width="28" height="33"  alt=""/></a></td>
    <td class="persianumber normalTextSmaller"><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<br />
<div class="persianumber"   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if(isset($id) && $id>1)
{
	echo "<a href='?id=".($id-1)."' class='button'>قبلی</a>";
}
if(isset($id) && $id!=$total)
{
	echo "<a href='?id=".($id+1)."' class='button'>بعدی</a>";
}

echo "<ul class='page'>";
		for($i=1;$i<=$total;$i++)
		{
			if(isset($id) && $i==$id) { echo "<li class='current'>".$i."</li>"; }
			
			else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
echo "</ul>";
?>
</div>
</div>
          </p>
      <p>
        <!--end form --> 
      <a href="users.php"><img src="../files/goback.jpg" width="102" height="49"  alt=""/></a></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="persianumber.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.persianumber').persiaNumber();
});
</script>
</body>
</html>