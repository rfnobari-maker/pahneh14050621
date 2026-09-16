<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_قطعات_صیفی.xls");
include('../../lock_ce.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar   = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city  = $_POST['add_city'] ;
 $b_time    = $_POST['b_time'] ;
 $m_ab    = $_POST['m_ab'] ;
 $confi    = $_POST['confi'] ;
 $confi2    = $_POST['confi2'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
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
               <?php
 if (isset($_POST['id_ostan'])) 
 {  
 if ($id_ostan1 == '-1')    { $v_id_ostan= 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'"    ;}
 if ($id_city == 0)         { $v_id_city=  1 ;}else{ $v_id_city  = "id_city='$id_city'"       ;}
 if ($id_mar  == 0)         { $v_id_mar=   1 ;}else{ $v_id_mar   = "id_mar='$id_mar'"         ;}
 if ($add_abadi  == '0')    { $f_add_abadi=1 ;}else{ $f_add_abadi= "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city= 1 ;}else{ $f_add_city = "add_city = '$add_city'"   ;}
 if ($b_time == '')        { $f_b_time=   1 ;}else{ $f_b_time   = "b_time = '$b_time'"       ;}
 if ($m_ab == '')          { $f_m_ab=     1 ;}else{ $f_m_ab     = "m_ab = '$m_ab'"           ;}
 if ($confi == '')         { $f_confi=    1 ;}else{ $f_confi    = "confi = '$confi'"         ;}
 if ($confi2 == '')        { $f_confi2=   1 ;}else{ $f_confi2   = "confi2 = '$confi2'"       ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m=1 ;}else{ $v_mor_cod_m= "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m=1 ;}else{ $v_bah_cod_m= "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')          { $v_z_sal=    1 ;}else{ $v_z_sal    = "z_sal = '$z_sal'"         ;}

 include_once('../../login/config.php');
$query = "SELECT * from Vege where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_b_time and $f_m_ab and $f_confi and $f_confi2 and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal  ORDER BY bah_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <P align="center"> لیست قطعات صیفی </P>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td align="center" width="10%" bgcolor="#CCCCCC"> کد ملی کارشناس<br /></td>
          <td align="center" width="8%" bgcolor="#CCCCCC">نظر تکمیلی</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">نظر اولیه</td>
          <td width="8%" align="center" bgcolor="#CCCCCC">عرض جغرافیایی</td>
          <td width="8%" align="center" bgcolor="#CCCCCC">طول جغرافیایی</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">مساحت زمین /<span class="style2">هکتار</span></td>
          <td align="center" width="5%" bgcolor="#CCCCCC">منبع آب </td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نوع طرح</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">شماره قطعه</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سال زراعی</td>
          <td align="center" width="3%" bgcolor="#CCCCCC">کد ملی </td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">شهر/آبادی</td>
          <td width="7%" align="center" bgcolor="#CCCCCC">مرکز</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="10%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
if ($row['m_ab']=='1')  $v_m_ab='چشمه';
if ($row['m_ab']=='2')  $v_m_ab='قنات';
if ($row['m_ab']=='3')  $v_m_ab='رودخانه'; 
if ($row['m_ab']=='4')  $v_m_ab='سد';
if ($row['m_ab']=='5')  $v_m_ab='چاه سطحی';
if ($row['m_ab']=='6')  $v_m_ab='چاه عمیق';
if ($row['m_ab']=='7')  $v_m_ab='چاه نیمه عمیق';
if ($row['m_ab']=='8')  $v_m_ab='زهکش';
if ($row['m_ab']=='9')  $v_m_ab='پساب';
if ($row['m_ab']=='10')  $v_m_ab='آب بندان' ;
if ($row['m_ab']=='11')  $v_m_ab='سایر' ;
?>
          <td align="center" height="26"  bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['confi2']=='1') { echo 'بررسی نشده' ; }?>
            <?php if ($row['confi2']=='2') { echo 'تایید شده' ; }?>
            <?php if ($row['confi2']=='3') { echo 'تایید نشده' ; }?>
            </td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['confi']=='1') { echo 'بررسی نشده' ; }?>
            <?php if ($row['confi']=='2') { echo 'تایید شده' ; }?>
            <?php if ($row['confi']=='3') { echo 'تایید نشده' ; }?>
           </td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lat']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lng']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']); ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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


