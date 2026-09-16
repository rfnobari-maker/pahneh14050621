<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=unknownbee_list.xls");
?>
<?php 
include('../../lock_p3.php');
include('../../event.php') ;
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ;
 $sal = $_POST['sal'] ;
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
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
$query = "SELECT * FROM  unknown_bee where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar and sal = '$sal'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC' dir="rtl">
        <tr class="text1">
          <td bgcolor="#FFCC99">تاریخ ثبت </td>
          <td bgcolor="#FFCC99">شماره همراه</td>
          <td bgcolor="#FFCC99">کد ملی</td>
          <td width="6%" bgcolor="#FFCC99">نام مروج </td>
          <td width="28%" bgcolor="#FFCC99">توضیحات</td>
          <td width="4%" bgcolor="#FFCC99">جمع کندو</td>
          <td width="5%" height="56" bgcolor="#FFCC99">تعداد کندوی مدرن</td>
          <td width="6%" bgcolor="#FFCC99">تعدادکندوی سنتی</td>
          <td width="5%" bgcolor="#FFCC99"><p>نوع زنبورستان</p></td>
          <td width="5%" bgcolor="#FFCC99">آبادی</td>
          <td width="4%" bgcolor="#FFCC99">شهر</td>
          <td width="10%" bgcolor="#FFCC99">شهرستان</td>
          <td width="9%" bgcolor="#FFCC99">استان</td>
          <td width="4%" bgcolor="#FFCC99">ردیف</td>
        </tr>
          <?php  
		   $r = 1 ;
		  foreach($stmt as $row){ 
        $pic = user_pic($row['mor_cod_m']) ; 
        if($row['no_zan']=='1') 
		  {
	     $v_no_zan = 'غیرمهاجر'; 
    	   $v_m_ostan = '' ; 
		  }
		  
		  else
		  {
		   $v_no_zan = 'مهاجر' ;
		  }
  ?>
        <tr>
          <td width="4%" height="41" bgcolor="#FFFFCC"><span class="normalTextSmall"><?php echo $row['date_s'] ?></span></td>
          <td width="5%"><?php echo user_tel($row['mor_cod_m'])?></td>
          <td width="5%"><?php echo $row['mor_cod_m']?></td>
          <td class="normalTextSmaller"><p><?php echo user_name($row['mor_cod_m'])?></p></td>
          <td class="normalTextSmaller"><span class="normalTextSmall"><?php echo $row['comment'] ;   ?></span></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td class="normalTextSmall"><?php echo $v_no_zan?></td>
          <td class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall"><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall"><?php echo $r;?></td>
        </tr>
        <?php 
		 $r++ ; 
}
$query = "SELECT SUM(tk_bo) AS kol_k_bo ,SUM(tk_mo) AS kol_k_mo,SUM(to_bo) AS kol_t_bo,SUM(to_mo) AS kol_t_mo,,SUM(t_sha) AS kol_t_sha from bee where id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
$kol_k_mo = $row['kol_k_mo'] ; 
$kol_t_bo = $row['kol_t_bo'];
$kol_t_mo = $row['kol_t_mo'] ; 
$kol_to = round(($kol_t_mo + $kol_t_bo),2) ;
$kol_tk = round(($kol_k_mo + $kol_k_bo),2) ;
?>
      </table>
      <p>
    </p></td>
  </tr>
</table>
</body>
</html>