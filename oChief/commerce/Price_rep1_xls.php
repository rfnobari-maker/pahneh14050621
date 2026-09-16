<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=قیمت_اقلام_خوراکی.xls");
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$id_ostan1 = $_POST['id_ostan'] ;
$id_city = $_POST['id_city5'] ;
$s_date = $_POST['s_date'] ; 
$year = $_POST['year'] ;
$mont = $_POST['mont'] ;
$p_cod = $_POST['p_cod'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
        <?php
 if (isset($_POST['year'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan   = 1 ;}else{ $v_id_ostan = "price_record.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "price_record.id_city='$id_city'" ;}
 if ($s_date  == 0)      {$v_s_date     = 1 ;}else{ $v_s_date = "price_record.s_date='$s_date'" ;}
 if ($p_cod == '0')       {$v_p_cod      = 1 ;}else{ $v_p_cod = "price_record.p_cod = '$p_cod'" ;}
 include('../../login/config.php');
$start=0;
 $query = "SELECT  price_record.* , price_pro_list.p_name,price_pro_list.p_unit from price_record 
 inner join price_pro_list ON price_pro_list.p_cod = price_record.p_cod
 where year = $year and mont = $mont and $v_id_ostan  and $v_id_city and  $v_s_date and $v_p_cod  ORDER BY id_ostan,id_city,p_cod,s_date  ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ; ?>
    <div align="center">گزارش قیمت اقلام خوراکی به تفکیک شهرستان / تاریخ تهیه گزارش :<?php echo $date_edit?> </div>
     <table width="100%" border="1" align="center" cellpadding="1" cellspacing="1"  bordercolor="#0099CC">
      <tr class="text1">
        <td width="12%" bgcolor="#999999">درصد تغییرات نسبت به روز قبل<br /></td>
        <td width="12%" bgcolor="#999999">میزان تغییرات نسبت به روز قبل 
        ریال</td>
        <td width="8%" bgcolor="#999999">قیمت روز قبل</td>
        <td width="8%" bgcolor="#999999">قیمت                ریال</td>
        <td width="12%" bgcolor="#999999">تاریخ قیمت گیری</td>
        <td width="12%" bgcolor="#999999">واحد</td>
        <td width="12%" bgcolor="#999999">نام محصول</td>
        <td width="9%" bgcolor="#999999">شهرستان</td>
        <td width="11%" bgcolor="#999999"> استان</td>
        <td width="4%" bgcolor="#999999">ردیف</td>
        </tr>
      <tr>
        <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$s_date = $row['s_date'] ; 
$id_ostan = $row['id_ostan'] ; 
$id_city = $row['id_city'] ; 
$p_cod = $row['p_cod'] ; 
$p_price = $row['p_price'] ; 
$arr_parts = explode('/', $s_date);
 $jYear  = $arr_parts[0];
 $jMonth = $arr_parts[1];
 $jDay   = $arr_parts[2];
 $time1   = jalali_to_gregorian($jYear, $jMonth, $jDay);
 $time3 = $time1[0].'-'.$time1[1].'-'.$time1[2] ; 
 $newdate = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $time3 ) )) ;
$arr_parts = explode('-', $newdate);
 $jYear  = $arr_parts[0];
 $jMonth = $arr_parts[1];
 $jDay   = $arr_parts[2];
 $time1   = gregorian_to_jalali($jYear, $jMonth, $jDay);
// اضافه کردن 0 به اول ماه و روزهای تک رقمی
if(strlen($time1[1]) ==1) $time1[1] = '0'.$time1[1] ; 
if(strlen($time1[2]) ==1) $time1[2] = '0'.$time1[2] ; 
//
 $time3 = $time1[0].'/'.$time1[1].'/'.$time1[2] ; 
$price_ago_day = price_ago_day($id_ostan,$id_city,$p_cod,$time3) ;
if($price_ago_day > 0) $m_t = $p_price - $price_ago_day ; else  $m_t = '-' ; 
if($price_ago_day > 0) $d_t = round((($p_price / $price_ago_day)*100)-100,2) ; else  $d_t = '-' ; 
  ?>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php 
		  		  if($d_t <0)  echo '<p style="color:red">'.$d_t.' % ' ; 
		   else
		  if($d_t >0) echo '<p style="color:green">'.$d_t.' % ' ;
		  else
          echo $d_t ;  ?>
        </td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php 
		  if($m_t <0)  echo '<p style="color:red">'.$m_t ; 
		   else
		  if($m_t >0) echo '<p style="color:green">'.$m_t ;
		  else
          echo $m_t ;
			   ?>
          </td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $price_ago_day ;  ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $p_price ; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_date ; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"  dir="rtl"><?php echo $row['p_unit']?></div></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['p_name']?></div></td>
        <td align="center" height="22" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($id_city,$id_ostan) ?></td>
        <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo ostan_name($id_ostan)?></div></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
      <?php 
	$r++ ; 
	}
	?>
    </table>
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
</body>
</html>
<?php
function price_ago_day($id_ostan,$id_city,$p_cod,$s_date)
{
include ('../../login/config.php') ;
 $query = "SELECT p_price FROM price_record WHERE 
 id_ostan = '$id_ostan' and id_city = '$id_city' and p_cod = '$p_cod' and s_date = '$s_date'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['p_price'] ;
$dbh = null;
}
?>