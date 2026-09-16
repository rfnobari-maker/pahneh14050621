<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آبادی.xls");
include('../lock_ce.php');
include('counter.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
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
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
width:50px
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
  <p>
    <?php 
include ('../login/config.php');
?>
<p align="center" class="style1">لیست آبادی های تحت پوشش </p>
    <?php if(isset($_POST['id_ostan']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_mar = $_POST['id_mar'] ; 
if ($id_ostan == '-1') { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_deh == 0) { $v_add_deh = 'add_deh=add_deh' ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
 // برای نمایش 
$query = "SELECT add_abadi,abadi,deh,mar,bakh,city,ostan,mor_cod_m,post_cod FROM  list_abadi where  $v_id_ostan and  $v_id_city and $v_id_mar  ORDER BY  mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<table width="95%" height="62" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td width="8%" bgcolor="#999999">کد ملی مروج</td>
               <td width="8%" bgcolor="#999999">تعداد بهره بردار</td>
               <td width="20%" bgcolor="#999999">کد پستی</td>
    <td width="20%" height="36" bgcolor="#999999">آدرس آماری آبادی</td>
    <td width="11%" bgcolor="#999999">نام آبادی</td>
    <td width="7%" bgcolor="#999999">دهستان</td>
    <td width="11%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="11%" bgcolor="#999999">بخش</td>
    <td width="12%" bgcolor="#999999">شهرستان</td>
    <td width="10%" bgcolor="#999999">استان</td>
    <td width="10%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['mor_cod_m']?> </td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo abadi_bah_count($row['add_abadi'])?> </td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['post_cod'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> height="26" class="normalTextSmaller"><?php echo '&nbsp;'.$row['add_abadi'].'&nbsp;';?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['bakh'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['ostan'];?></td>
    <td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
 }
}
?>
</table>
<p align="center">پایان گزارش</p>
</body>
</html>



