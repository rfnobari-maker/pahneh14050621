<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=promo_action.xls");
?>
<?php 
include('../lock_p3.php');
include('../event.php') ;
include('counter2.php');
 $id_ostan = $_POST['id_ostan'] ;
 $id_mar = $_POST['id_mar'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ; 
 $date_s1 = $_POST['date_s1'] ;
 $date_s2 = $_POST['date_s2'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../login/config.php');
if ($date_s1 == '') { $v_date_s1 = 'id=id' ;} else { $v_date_s1 = "date_s>'$date_s1'" ;}
if ($date_s2 == '') { $v_date_s2 = 'id=id' ;} else { $v_date_s2 = "date_s<'$date_s2'" ;}
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($mor_cod_m == 0) { $v_mor_cod_m = 1    ;} else { $v_mor_cod_m = "cod_m='$mor_cod_m'" ;}
$query = "SELECT * FROM  users where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_mor_cod_m and S_access = '1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
  <table width="100%" height="131" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC" >
    <tr align="center" class="text1">
      <td height="50" colspan="15" bordercolor="#66CCFF" bgcolor="#999999"><p><?php echo 'استان ' .ostan_name($id_ostan)?> <br />
        گزارش عملکرد کارشناسان پهنه در سامانه پهنه بندی و مدیریت داده های کشاورزی <?php if($id_city<>0) echo  'شهرستان '.city_name1($id_city,$id_ostan) ?> <?php if($id_mar>0) echo '- مرکز جهاد کشاورزی '. mar_name($id_mar)?>
        <br />
     <?php if($date_s1<>'') echo  'از تاریخ : '.$date_s1 .'تا تاریخ : '.$date_s2 ?>
      </p></td>
      </tr>
    <tr align="center" class="text1">
      <td width="6%" bordercolor="#66CCFF" bgcolor="#999999">زنبورستان</td>
      <td width="6%" height="36" bordercolor="#66CCFF" bgcolor="#999999"> تعداد مزارع تکثیر و پرورش آبزیان </td>
      <td width="6%" bordercolor="#66CCFF" bgcolor="#999999"> تعداد گلخانه</td>
      <td width="6%" bordercolor="#66CCFF" bgcolor="#999999"> تعداد قطعات باغی</td>
      <td width="5%" bordercolor="#66CCFF" bgcolor="#999999"> تعداد قطعات زراعی</td>
      <td width="7%" bordercolor="#66CCFF" bgcolor="#999999"> تعداد بهره بردارثبت شده</td>
      <td width="8%" bordercolor="#66CCFF" bgcolor="#999999"> تعداد آبادی تحت پوشش </td>
      <td width="7%" bgcolor="#999999"> تعداد شهر تحت پوشش</td>
      <td bgcolor="#999999">مرکز </td>
      <td bgcolor="#999999">شهرستان</td>
      <td bgcolor="#999999">استان</td>
      <td bgcolor="#999999"> همراه مروج</td>
      <td colspan="2" bgcolor="#999999">مشخصات کارشناس مروج </td>
      <td width="3%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['cod_m'] ;
$pic_mo = $row['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; ?>
      <td  align="center" bordercolor="#66CCFF"><?php echo mor_bee_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td  align="center" bordercolor="#66CCFF"><?php echo mor_Aquatic_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td align="center" bordercolor="#66CCFF"> <?php echo mor_Greenhous_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td align="center" bordercolor="#66CCFF"> <?php echo mor_Garden_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td align="center" bordercolor="#66CCFF"> <?php echo mor_Agri_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td align="center" bordercolor="#66CCFF"> <?php echo mor_bah_count($cod_m,$v_date_s1,$v_date_s2)?></td>
      <td align="center" bordercolor="#66CCFF"> <?php echo mor_abadi_count($cod_m)?></td>
      <td align="center" > <?php echo mor_shahr_count($cod_m)?></td>
      <td align="center" width="7%"  ><span class="style2">  <?php echo mar_name($row['id_mar']);?></span></td>
      <td align="center" width="9%"  ><span class="style2">  <?php echo city_name1($row['id_city'],$row['id_ostan']);?></span></td>
      <td align="center" width="11%"  ><span class="style2"> <?php echo ostan_name($row['id_ostan']);?></span></td>
      <td align="center" width="8%"  ><span class="style2">  <?php  echo user_tel($row['username']);?></span></td>
      <td align="center" width="9%"  ><?php echo $cod_m?></td>
      <td align="center" width="8%"  ><?php echo $row['Last_name'].' '.$row['name'];?>
    
      </td>
 <td ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
?>
  </table>
      </table>      <p>
    </p></td>
  </tr>
</table>
</body>
</html>