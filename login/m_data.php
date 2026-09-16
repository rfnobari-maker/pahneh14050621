<?php 
 include("../login/config.php");
 function short_monthname($month)
{
    if($month=="01") return "فروردين";
    if($month=="02") return "ارديبهشت";
    if($month=="03") return "خرداد";
    if($month=="04") return  "تير";
    if($month=="05") return "مرداد";
    if($month=="06") return "شهريور";
    if($month=="07") return "مهر";
    if($month=="08") return "آبان";
    if($month=="09") return "آذر";
    if($month=="10") return "دی";
    if($month=="11") return "بهمن";
    if($month=="12") return "اسفند";
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>اطلاعات موجود بر اساس ماه / سال </title>
<link href="FA.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><?php include('menu.php'); ?>
      <p>    
      <p>&nbsp;</p>
<p><?PHP
       // never trust what user wrote! We must ALWAYS sanitize user input
    $result0 = mysql_query("SELECT Calc_YearMonth,Calc_Year,Calc_Month FROM Pay_FishFile GROUP BY Calc_YearMonth "); 
?>
</p>
</div>
<?php
 function short_monthname($month)
{
    if($month=="01") return "فروردين";
    if($month=="02") return "ارديبهشت";
    if($month=="03") return "خرداد";
    if($month=="04") return  "تير";
    if($month=="05") return "مرداد";
    if($month=="06") return "شهريور";
    if($month=="07") return "مهر";
    if($month=="08") return "آبان";
    if($month=="09") return "آذر";
    if($month=="10") return "دی";
    if($month=="11") return "بهمن";
    if($month=="12") return "اسفند";
}
?>
<table width="336" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CC99FF">
  <tr>
    <td width="95" height="49" class="style4"><div align="center">ماه   </div></td>
    <td width="152" class="style4"><div align="center">سال</div></td>
    <td width="81" class="style4"><div align="center">رديف</div></td>
    </tr>
  
  <?php 
$no_row = 1 ;
while ($row = mysql_fetch_array($result0)) {
//$row = mysql_fetch_array($result0) ;
?>
  <tr>
    <td height="46" class="style4"><div align="center"><?php echo short_monthname($row['Calc_Month']); ?></div></td>
    <td class="style4"><div align="center"><?php echo farsidigit($row['Calc_Year']); ?></div></td>
    <td class="style4"><div align="center"><?php echo farsidigit($no_row);  ?></div></td>
    </tr>
  <?php
  $no_row++ ; 
}
	
	?>
</table>
