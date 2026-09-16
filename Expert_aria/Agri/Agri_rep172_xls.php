<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_ویژه_زراعی.xls");
include('../../lock_expar.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $m_ab      = $_POST['m_ab'] ;
 $no_ab     = $_POST['no_ab'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $z_sal = $_POST['z_sal'] ;
 $zka1 = $_POST['zka1'] ;
 $zka2 = $_POST['zka2'] ;
 $zkb1 = $_POST['zkb1'] ;
 $zkb2 = $_POST['zkb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $sba1 = $_POST['sba1'] ;
 $sba2 = $_POST['sba2'] ;
 $sbb1 = $_POST['sbb1'] ;
 $sbb2 = $_POST['sbb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $mtolp1 = $_POST['mtolp1'] ;
 $mtolp2 = $_POST['mtolp2'] ;
 $Agri_table     = 'Agri'.str_replace('-','_',$z_sal) ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول
// $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
 $mah_kh = $_POST['mah_kh'] ;
 $mah_bem = $_POST['mah_bem'] ;
 $date_s1 = $_POST['date_s1'];
$date_s2 = $_POST['date_s2'];

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
      <p align="center"  class="style8">گزارش اختصاصی اطلاعات زراعی 
        <?php
$filters = array(
    'date_s1' => $date_s1,
    'date_s2' => $date_s2,
    'id_ostan1' => $id_ostan1,
    'id_city' => $id_city,
    'id_mar' => $id_mar,
    'add_abadi' => $add_abadi,
    'add_city' => $add_city,
    'no_kesh' => $no_kesh,
    'm_ab' => $m_ab,
    'no_ab' => $no_ab,
    'mor_cod_m' => $mor_cod_m,
    'bah_cod_m' => $bah_cod_m,
    'mah_name' => $mah_name,
    'zka1' => $zka1,
    'zka2' => $zka2,
    'zkb1' => $zkb1,
    'zkb2' => $zkb2,
    'sba1' => $sba1,
    'sba2' => $sba2,
    'sbb1' => $sbb1,
    'sbb2' => $sbb2,
    'mtol1' => $mtol1,
    'mtol2' => $mtol2,
    'mtolp1' => $mtolp1,
    'mtolp2' => $mtolp2,
    'mah_kh' => $mah_kh,
    'mah_bem' => $mah_bem,
);

// ایجاد یک آرایه برای شرایط
$query_parts = array();

// بررسی و اضافه کردن هر فیلتر به آرایه شرایط
foreach ($filters as $key => $value) {
    if ($value != '') {
        switch ($key) {
            case 'date_s1':
                $query_parts[] = "$Agri_prod_table.date_s >= '$value'";
                break;
            case 'date_s2':
                $query_parts[] = "$Agri_prod_table.date_s <= '$value'";
                break;
            case 'id_ostan1':
                if ($value != '-1') {
                    $query_parts[] = "$Agri_prod_table.id_ostan = '$value'";
                }
                break;
            case 'id_city':
                $query_parts[] = "$Agri_prod_table.id_city = '$value'";
                break;
            case 'id_mar':
                $query_parts[] = "$Agri_prod_table.id_mar = '$value'";
                break;
            case 'add_abadi':
                $query_parts[] = "$Agri_prod_table.add_abadi = '$value'";
                break;
            case 'add_city':
                $query_parts[] = "$Agri_prod_table.add_city = '$value'";
                break;
            case 'no_kesh':
                $query_parts[] = "$Agri_prod_table.no_kesh = '$value'";
                break;
            case 'm_ab':
                $query_parts[] = "$Agri_table.m_ab = '$value'";
                break;
            case 'no_ab':
                $query_parts[] = "$Agri_table.no_ab = '$value'";
                break;
            case 'mor_cod_m':
                $query_parts[] = "$Agri_prod_table.mor_cod_m = '$value'";
                break;
            case 'bah_cod_m':
                $query_parts[] = "$Agri_prod_table.bah_cod_m = '$value'";
                break;
            case 'mah_name':
                $query_parts[] = "$Agri_prod_table.cod_mah = '$value'";
                break;
            case 'zka1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a >= '$value'";
                break;
            case 'zka2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a <= '$value'";
                break;
            case 'zkb1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b >= '$value'";
                break;
            case 'zkb2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b <= '$value'";
                break;
            case 'sba1':
                $query_parts[] = "$Agri_prod_table.s_bar_a >= '$value'";
                break;
            case 'sba2':
                $query_parts[] = "$Agri_prod_table.s_bar_a <= '$value'";
                break;
            case 'sbb1':
                $query_parts[] = "$Agri_prod_table.s_bar_b >= '$value'";
                break;
            case 'sbb2':
                $query_parts[] = "$Agri_prod_table.s_bar_b <= '$value'";
                break;
            case 'mtol1':
                $query_parts[] = "$Agri_prod_table.mah_tol >= '$value'";
                break;
            case 'mtol2':
                $query_parts[] = "$Agri_prod_table.mah_tol <= '$value'";
                break;
            case 'mtolp1':
                $query_parts[] = "$Agri_prod_table.mah_tolp >= '$value'";
                break;
            case 'mtolp2':
                $query_parts[] = "$Agri_prod_table.mah_tolp <= '$value'";
                break;
            case 'mah_kh':
                $query_parts[] = "$Agri_prod_table.mah_kh = '$value'";
                break;
            case 'mah_bem':
                $query_parts[] = "$Agri_prod_table.mah_bem = '$value'";
                break;
        }
    }
}

// ایجاد شرایط کوئری
$query_conditions = implode(' AND ', $query_parts);
 include_once('../../login/config.php');
  $query = "SELECT $Agri_prod_table.*,$Agri_table.m_ab, $Agri_table.no_ab,$Agri_table.no_mal,$Agri_table.m_cod_m 
          FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          WHERE $query_conditions
          ORDER BY bah_cod_m ASC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="4%" align="center" bgcolor="#CCCCCC">همراه مروج</td>
          <td width="4%" align="center" bgcolor="#CCCCCC"> کد ملی مروج</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام مروج</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام و نام خانوادگی مالک</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">کد ملی مالک</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نوع مالکیت</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">خسارت</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">بیمه</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" width="4%" bgcolor="#CCCCCC"> پیش بینی تولید /تن</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">کل سطح برداشت هکتار</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">سطح برداشت کشت مجدد / هکتار</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">سطح برداشت کشت اول/ هکتار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">کل سطح زیر کشت /هکتار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سطح زیر کشت مجدد / هکتار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سطح زیر کشت اول / هکتار</td>
          <td align="center" width="3%" bgcolor="#CCCCCC">نوع کشت</td>
          <td align="center" width="3%" bgcolor="#CCCCCC">همراه بهره بردار</td>
          <td align="center" width="3%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="6%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام آبادی </td>
          <td align="center" width="4%" bgcolor="#CCCCCC">آدرس آماری آبادی </td>
          <td align="center" width="3%" bgcolor="#CCCCCC">نام شهر </td>
          <td align="center" width="6%" bgcolor="#CCCCCC">آدرس آماری شهر</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">تاریخ ثبت / ویرایش</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">مرکز</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_kesh']=='1' ) $v_no_kesh= 'آبی' ; 
if ($row['no_kesh']=='2' ) $v_no_kesh= 'دیم' ; 
if ($row['mah_bem']=='1' ) $v_mah_bem= 'هست' ; 
if ($row['mah_bem']=='2' ) $v_mah_bem= 'نیست' ; 

if ($row['mah_kh']=='1' ) $v_mah_kh= 'دیده' ; 
if ($row['mah_kh']=='2' ) $v_mah_kh= 'ندیده' ; 

$add_abadi = '"'.$row['add_abadi'].'"' ; 
$add_city = '"'.$row['add_city'].'"' ; 

$no_mal  = $row['no_mal'] ; 

if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;

$m_cod_m = $row['m_cod_m'] ; 
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php if($row['bah_cod_m'] == $row['m_cod_m']) echo bah_name($row['bah_cod_m']) ; else echo m_name($row['m_cod_m']) ;?></div></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $m_cod_m ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_kh ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_bem ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo bah_tel_m($row['bah_cod_m']);?></span></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $add_abadi ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $add_city ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
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