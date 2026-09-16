<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=مددکاران_تسهیلگران.xls");
?>
<?php 
include('../../../lock_p2.php');
include('../../../event.php') ;
 $add_abadi = $_POST['add_abadi'] ;
 $g_tah = $_POST['g_tah'] ;
 $no_oz = $_POST['no_oz'] ;
 $sal_z = $_POST['sal_z'] ;
  $no_ham = $_POST['no_ham']  ;      
 if ($add_abadi == '0') { $v_add_abadi = 1 ; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($sal_z == '')  { $v_sal_z    = 1  ; }else{ $v_sal_z = "sal_z = '$sal_z'" ;}
 if ($g_tah == '')  { $f_g_tah    = 1  ; }else{ $f_g_tah = "g_tah = '$g_tah'" ;}
 if ($no_oz == '0')  { $f_no_oz    = 1  ; }else{ $f_no_oz = "no_oz = '$no_oz'" ;}
 if ($no_ham == '')  { $f_no_ham  = 1  ; }else{ $f_no_ham = "no_ham = '$no_ham'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
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
    <td>
      <?php 
include ('../../../login/config.php');
 $query = "SELECT * from Eworker where  id_mar = :id_mar and $v_add_abadi and $v_sal_z and $f_g_tah and $f_no_oz and $f_no_ham ORDER BY cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
?>
    </p>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
        <tr class="style8">
          <td width="4%" bgcolor="#FFFFCC">نوع عضویت</td>
          <td width="8%" bgcolor="#FFFFCC">گرایش تحصیلی</td>
          <td width="8%" bgcolor="#FFFFCC">رشته تحصیلی</td>
          <td width="6%" bgcolor="#FFFFCC">آدرس محل سکونت</td>
          <td width="5%" bgcolor="#FFFFCC">فاصله محل استقرار </td>
          <td width="5%" bgcolor="#FFFFCC">تعداد افراد تحت تکفل</td>
          <td width="5%" bgcolor="#FFFFCC">وضعیت تاهل</td>
          <td width="5%" bgcolor="#FFFFCC">سال جذب</td>
          <td width="5%" bgcolor="#FFFFCC">کد شناسایی</td>
          <td width="10%" bgcolor="#FFFFCC">کد ملی </td>
          <td width="13%" bgcolor="#FFFFCC">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#FFFFCC">آبادی</td>
          <td width="9%" bgcolor="#FFFFCC">شهرستان</td>
          <td width="6%" bgcolor="#FFFFCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $v_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $v_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $v_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $v_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $v_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $v_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $v_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $v_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $v_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $v_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $v_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $v_g_tah='فاقد مدرک دانشگاهی' ;	 
if ($row['no_oz']=='1') $v_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $v_no_oz='غیرفعال' ;	 
if ($row['v_tah']=='1') $v_v_tah='مجرد' ;	 
if ($row['v_tah']=='2') $v_v_tah='متاهل' ;	 

  ?>
          <?php if($row['id_mar'] == $id_mar) {?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_oz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_g_tah; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['addres']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['f_tm']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_fam']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_v_tah; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_sh_m'] ?></td>
          <td height="36" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['cod_m'],'1')?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 }
	?>
</table>    