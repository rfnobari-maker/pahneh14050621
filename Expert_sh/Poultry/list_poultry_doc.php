<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=poultry_list.doc");
?>
<?php 
include('../../lock_expsh.php');
include('../../event.php') ;
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../../login/config.php');
 $query = "SELECT * FROM  spoultry where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar ORDER BY BINARY id_city,add_city,add_abadi ASC  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <p align="center">لیست مرغداری های صنعتی شهرستان <?php echo $city?> </p>
    <table width="98%" height="96" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text_r">
    <td width="9%" bgcolor="#999999">تلفن همراه کارشناس مسئول پهنه</td>
    <td width="9%" bgcolor="#999999">کد ملی کارشناس مسئول پهنه</td>
    <td width="9%" bgcolor="#999999">نام کارشناس مسئول پهنه</td>
    <td width="9%" height="42" bgcolor="#999999">ظرفیت</td>
    <td width="9%" bgcolor="#999999">نوع مجوز</td>
    <td width="9%" bgcolor="#999999">نوع بهره برداری</td>
    <td width="9%" bgcolor="#999999">کد مرغداری</td>
    <td width="9%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="11%" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="11%" bgcolor="#999999">شهر / آبادی </td>
    <td width="10%" bgcolor="#999999">شهرستان </td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($row['no_bah']=='1') $v_no_bah='مرغ گوشتی' ;	 
if ($row['no_bah']=='2') $v_no_bah='مرغ تخمگذار' ;	 
if ($row['no_bah']=='3') $v_no_bah='مادر گوشتی' ;	 
if ($row['no_bah']=='4') $v_no_bah='مادر تخمگذار' ;	 
if ($row['no_bah']=='5') $v_no_bah='اجداد گوشتی' ;	 
if ($row['no_bah']=='6') $v_no_bah='اجداد تخمگذار' ;	 
if ($row['no_bah']=='7') $v_no_bah='پولت تخمگذار' ;	 
if ($row['no_bah']=='8') $v_no_bah='جوجه کشی' ;	 
if ($row['no_bah']=='9') $v_no_bah='شترمرغ مولد' ;	 
if ($row['no_bah']=='10') $v_no_bah='شترمرغ پرواری' ;	 
if ($row['no_bah']=='11') $v_no_bah='بوقلمون مولد' ;	 
if ($row['no_bah']=='12') $v_no_bah='بوقلمون گوشتی' ;	 
if ($row['no_bah']=='13') $v_no_bah='بلدرچین' ;	 
if ($row['no_bah']=='14') $v_no_bah='کبک' ;	 
if ($row['no_bah']=='15') $v_no_bah='پرندگان زینتی' ;	 
if ($row['no_bah']=='16') $v_no_bah='سایر ماکیان' ;	 
if ($row['no_moj']=='1') $v_no_moj='پروانه بهره برداری' ;	 
if ($row['no_moj']=='2') $v_no_moj='کارت شناسائی' ;	 
if ($row['no_moj']=='3') $v_no_moj='فاقد مجوز' ;	 



//echo $row2['User_Name'] ; 
?>
<td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m'])?></td>
<td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
<td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m'])?></td>
  <td height="51"  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_unit']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_moj ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_bah?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['poul_cod'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name($row['id_city']); ?></span></td>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>