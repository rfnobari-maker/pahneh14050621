<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='تولید_قطعی.xls");
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city'])) $id_city = $_POST['id_city'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'] ;
if(isset($_POST['add_city'])) $add_city = $_POST['add_city'] ;
if(isset($_POST['no_kesh'])) $no_kesh = $_POST['no_kesh'] ;
if(isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'] ;
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ;
if(isset($_POST['z_sal'])) 
{
$z_sal = $_POST['z_sal'] ;
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
}
if(isset($_POST['dis'])) $dis = $_POST['dis'] ;
// کد گروه و کد محصول
if(isset($_POST['mah_qroup']))  $mah_qroup = $_POST['mah_qroup'] ;
if(isset($_POST['mah_name']))  $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <script src="../../15_files/jquery.js" type="text/javascript"></script>
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
.column {
  float: left;
  width:21.25%;
  padding: 5px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>
<p align="center" dir="rtl">بررسی اطلاعات سطح برداشت و تولید قطعی محصولات زراعی</p>     
               <?php
 if (1==1) 
 {  
 if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = $mor_cod_m " ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m' " ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
 if ($dis == '1')  { $v_dis  = 1  ; }else{ $v_dis = "mah_tol = 0 and mah_kh !='1'" ;}
 include('../../login/config.php');
 $query  = "SELECT  id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi,id_ostan,id_city,id_mar,mor_cod_m from $Agri_prod_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and  $v_dis ORDER BY bah_cod_m,sh_gat ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="6%" bgcolor="#999999"> همراه مروج</td>
                <td width="6%" bgcolor="#999999"> کد ملی مروج</td>
                <td width="6%" bgcolor="#999999">نام مروج</td>
                <td width="6%" bgcolor="#999999"> وضعیت بهره بردار</td>
          <td width="6%" bgcolor="#999999">میزان تولید قطعی<span class="style2"> تن</span></td>
          <td width="7%" bgcolor="#999999"><p>سطح برداشت دوم هکتار</p></td>
          <td width="7%" bgcolor="#999999">سطح برداشت اول هکتار</td>
          <td width="6%" bgcolor="#999999"><p>پیش بینی تولی تن<span class="style2"></span></p></td>
          <td width="5%" bgcolor="#999999">سطح زیر کشت دوم هکتار</td>
          <td width="5%" bgcolor="#999999"><p>سطح زیر کشت اول هکتار</p></td>
          <td width="9%" bgcolor="#999999">نام محصول</td>
          <td width="4%" bgcolor="#999999">نوع کشت</td>
          <td width="5%" bgcolor="#999999">شماره قطعه<br /></td>
          <td width="8%" bgcolor="#999999">کد ملی</td>
          <td width="12%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td width="6%" bgcolor="#999999">مرکز</td>
          <td width="7%" bgcolor="#999999">شهرستان</td>
          <td width="9%" bgcolor="#999999">استان</td>
          <td width="4%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;
foreach($stmt as $row){ 
$bah_vaz = bah_vaz($row['bah_cod_m']) ;
if ($bah_vaz=='1') $v_bah_vaz='زنده' ;	 
if ($bah_vaz=='2') $v_bah_vaz='فوتی' ;	 
if ($bah_vaz=='3') $v_bah_vaz='تایید نشده' ;	 

if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
 $t_r = $r ; 
  ?>
          <td height="23" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_bah_vaz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']; ?>
          <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $row['zer_kesht_a']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']); ?><br />
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?><br />
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
</table>
</body>
</html>