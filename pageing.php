<html xmlns="http://www.w3.org/1999/xhtml">
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


</head>
<body>
<div id="content">
<?php
$start=0;
$limit=10;

if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

include('login/config.php');
$query = "SELECT * FROM  log ORDER BY date DESC , time DESC LIMIT $start, $limit" ;
$query1 = "SELECT * FROM  log ORDER BY date DESC , time DESC " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>مشاهده عملکرد زنده کاربران در سامانه </p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="85%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="11%" height="49" bgcolor="#CCCCCC">عملیات</td>
    <td width="18%" height="49" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="11%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="12%" bgcolor="#CCCCCC">دهستان</td>
    <td width="15%" bgcolor="#CCCCCC">بخش</td>
    <td width="15%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="12%" bgcolor="#CCCCCC">استان</td>
    <td width="6%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td class="normalTextSmaller"><?php echo $row['username'];?></td>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td class="normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?

$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	echo "<a href='?id=".($id-1)."' class='button'>قبلی</a>";
}
if($id!=$total)
{
	echo "<a href='?id=".($id+1)."' class='button'>بعدی</a>";
}

echo "<ul class='page'>";
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			
			else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
echo "</ul>";
?>
</div>
</body>
</html>