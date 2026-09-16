<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_اختصاصی_محصولات_گلخانه.xls");
include('../../lock_ce.php');
include('../../event.php');
  $id_ostan1 = $_POST['id_ostan1'] ;
 $id_city = $_POST['id_city'] ;
 $no_kesht = $_POST['no_kesht'] ;
 $y_prod = $_POST['y_prod'] ;
 $skb1 = $_POST['skb1'] ;
 $skb2 = $_POST['skb2'] ;
 $date_1_kesh = $_POST['date_1_kesh'] ;
 $date_2_kesh = $_POST['date_2_kesh'] ;
 $date_1_bar = $_POST['date_1_bar'] ;
 $date_2_bar = $_POST['date_2_bar'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;

// کد گروه و کد محصول
 $group_cod = $_POST['group_cod'] ;
 $mah_cod = $_POST['mah_cod'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
      <p align="center"  class="style8">گزارش محصولات گلخانه 
        <?php
 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($no_kesht == '0')  { $f_no_kesht  = 1  ; }else{ $f_no_kesht = "no_kesht = '$no_kesht'" ;}
 if ($y_prod == '')  { $v_y_prod  = 1  ; }else{ $v_y_prod = "y_prod = '$y_prod'" ;}
 if ($group_cod == '')  { $v_group_cod  = 1  ; }else{ $v_group_cod = "group_cod = '$group_cod'" ;}
 if ($mah_cod == '')  { $v_mah_cod  = 1  ; }else{ $v_mah_cod = "mah_cod = '$mah_cod'" ;}
 if ($skb1 == '')  { $v_skb1  = 1  ; }else{ $v_skb1 = "s_kesh >= $skb1" ;}
 if ($skb2 == '')  { $v_skb2  = 1  ; }else{ $v_skb2 = "s_kesh <= $skb2" ;}
 if ($date_1_kesh == '')  { $v_date_1_kesh  = 1  ; }else{ $v_date_1_kesh = "date_1_kesh >= $date_1_kesh" ;}
 if ($date_2_kesh == '')  { $v_date_2_kesh  = 1  ; }else{ $v_date_2_kesh = "date_2_kesh <= $date_2_kesh" ;}
 if ($date_1_bar == '')  { $v_date_1_bar  = 1  ; }else{ $v_date_1_bar = "date_1_bar >= $date_1_bar" ;}
 if ($date_2_bar == '')  { $v_date_2_bar  = 1  ; }else{ $v_date_2_bar = "date_2_bar <= $date_2_bar" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "m_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "m_tol <= $mtol2" ;}
 include_once('../../login/config.php');

if ($id_ostan1 == '-1') {
   $query = " SELECT sum(s_kesh) as s_kesh , sum(m_tol) as m_tol , id_ostan, mah_cod , group_cod , no_kesht 
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city and $f_no_kesht and 
 $v_y_prod and $v_group_cod and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2 group by id_ostan,no_kesht,group_cod,mah_cod ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')  "; 
}
else
{
   $query = " SELECT sum(s_kesh) as s_kesh , sum(m_tol) as m_tol , id_ostan,id_city , mah_cod , group_cod , no_kesht 
FROM Greenprod_annual
where  $v_id_ostan  and $v_id_city and $f_no_kesht and 
 $v_y_prod and $v_group_cod and $v_mah_cod and $v_date_1_kesh and $v_date_2_kesh and $v_date_1_bar and $v_date_2_bar and $v_skb1 and $v_skb2 
 and $v_mtol1 and $v_mtol2 group by id_city,no_kesht,group_cod,mah_cod order by id_city   "; 
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td align="center" width="4%" bgcolor="#CCCCCC">عملکرد</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">میزان تولید</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سطح زیر کشت <br />
          مترمربع</td>
          <td width="6%" align="center" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">گروه محصولات</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">نوع کاشت</td>
          <td align="center" width="9%" bgcolor="#CCCCCC"><?php if($id_ostan1=='-1') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
          <td align="center" width="4%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['no_kesht']=="1")  $v_no_kesht = 'گلخانه'  ;
if($row['no_kesht']=="2")  $v_no_kesht = 'فضای باز' ;

if ($row['date_1_kesh'] == '01') $n_date_1_kesh = 'فروردین' ;
if ($row['date_1_kesh'] == '02') $n_date_1_kesh = 'اردیبهشت' ;
if ($row['date_1_kesh'] == '03') $n_date_1_kesh = 'خرداد' ;
if ($row['date_1_kesh'] == '04') $n_date_1_kesh = 'تیر' ;
if ($row['date_1_kesh'] == '05') $n_date_1_kesh = 'مرداد' ;
if ($row['date_1_kesh'] == '06') $n_date_1_kesh = 'شهریور' ;
if ($row['date_1_kesh'] == '07') $n_date_1_kesh = 'مهر' ;
if ($row['date_1_kesh'] == '08') $n_date_1_kesh = 'آبان' ;
if ($row['date_1_kesh'] == '09') $n_date_1_kesh = 'آذر' ;
if ($row['date_1_kesh'] == '10') $n_date_1_kesh = 'دی' ;
if ($row['date_1_kesh'] == '11') $n_date_1_kesh = 'بهمن' ;
if ($row['date_1_kesh'] == '12') $n_date_1_kesh = 'اسفند' ;

if ($row['date_2_kesh'] == '01') $n_date_2_kesh = 'فروردین' ;
if ($row['date_2_kesh'] == '02') $n_date_2_kesh = 'اردیبهشت' ;
if ($row['date_2_kesh'] == '03') $n_date_2_kesh = 'خرداد' ;
if ($row['date_2_kesh'] == '04') $n_date_2_kesh = 'تیر' ;
if ($row['date_2_kesh'] == '05') $n_date_2_kesh = 'مرداد' ;
if ($row['date_2_kesh'] == '06') $n_date_2_kesh = 'شهریور' ;
if ($row['date_2_kesh'] == '07') $n_date_2_kesh = 'مهر' ;
if ($row['date_2_kesh'] == '08') $n_date_2_kesh = 'آبان' ;
if ($row['date_2_kesh'] == '09') $n_date_2_kesh = 'آذر' ;
if ($row['date_2_kesh'] == '10') $n_date_2_kesh = 'دی' ;
if ($row['date_2_kesh'] == '11') $n_date_2_kesh = 'بهمن' ;
if ($row['date_2_kesh'] == '12') $n_date_2_kesh = 'اسفند' ;

if ($row['date_1_bar'] == '01') $n_date_1_bar = 'فروردین' ;
if ($row['date_1_bar'] == '02') $n_date_1_bar = 'اردیبهشت' ;
if ($row['date_1_bar'] == '03') $n_date_1_bar = 'خرداد' ;
if ($row['date_1_bar'] == '04') $n_date_1_bar = 'تیر' ;
if ($row['date_1_bar'] == '05') $n_date_1_bar = 'مرداد' ;
if ($row['date_1_bar'] == '06') $n_date_1_bar = 'شهریور' ;
if ($row['date_1_bar'] == '07') $n_date_1_bar = 'مهر' ;
if ($row['date_1_bar'] == '08') $n_date_1_bar = 'آبان' ;
if ($row['date_1_bar'] == '09') $n_date_1_bar = 'آذر' ;
if ($row['date_1_bar'] == '10') $n_date_1_bar = 'دی' ;
if ($row['date_1_bar'] == '11') $n_date_1_bar = 'بهمن' ;
if ($row['date_1_bar'] == '12') $n_date_1_bar = 'اسفند' ;

if ($row['date_2_bar'] == '01') $n_date_2_bar = 'فروردین' ;
if ($row['date_2_bar'] == '02') $n_date_2_bar = 'اردیبهشت' ;
if ($row['date_2_bar'] == '03') $n_date_2_bar = 'خرداد' ;
if ($row['date_2_bar'] == '04') $n_date_2_bar = 'تیر' ;
if ($row['date_2_bar'] == '05') $n_date_2_bar = 'مرداد' ;
if ($row['date_2_bar'] == '06') $n_date_2_bar = 'شهریور' ;
if ($row['date_2_bar'] == '07') $n_date_2_bar = 'مهر' ;
if ($row['date_2_bar'] == '08') $n_date_2_bar = 'آبان' ;
if ($row['date_2_bar'] == '09') $n_date_2_bar = 'آذر' ;
if ($row['date_2_bar'] == '10') $n_date_2_bar = 'دی' ;
if ($row['date_2_bar'] == '11') $n_date_2_bar = 'بهمن' ;
if ($row['date_2_bar'] == '12') $n_date_2_bar = 'اسفند' ;

  ?>
          <td height="22" bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['m_tol'] / ($row['s_kesh']/10000)),2) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tol'],4)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesh']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_green($row['mah_cod']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo group_name_green($row['group_cod']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesht ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($id_ostan1=='-1') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$row['id_ostan'])  ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
    </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }
?>   
</body>
</html>


