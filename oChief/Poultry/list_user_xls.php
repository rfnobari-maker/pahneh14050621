<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=bee_list.xls");
?>
<?php 
include('../../lock_oce.php');
include('../../event.php') ;
echo $id_ostan = $_POST['id_ostan'] ;
echo $id_city = $_POST['id_city'] ;
echo $id_mar = $_POST['id_mar'] ;

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
$query = "SELECT * FROM  users where  S_access='1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC' dir="rtl">
        <tr class="text1">
          <td width="16%" height="31" bgcolor="#FFCC99"><span dir="rtl">تلفن همراه</span></td>
          <td width="15%" bgcolor="#FFCC99"><span dir="rtl">تلفن ثابت به همراه كد</span></td>
          <td width="17%" bgcolor="#FFCC99"><span dir="rtl">رشته تحصيلي</span></td>
          <td width="18%" bgcolor="#FFCC99"><span dir="rtl">مقطع تحصيلي</span></td>
          <td width="14%" bgcolor="#FFCC99">نام خانوادگی</td>
          <td width="13%" bgcolor="#FFCC99">نام</td>
          <td width="7%" bgcolor="#FFCC99">ردیف</td>
        </tr>
          <?php  
		   $r = 1 ;
		  foreach($stmt as $row){ 
        $pic = user_pic($row['mor_cod_m']) ; 
        if($row['no_zan']=='1') 
		  {
	     $v_no_zan = 'بومی '; 
    	   $v_m_ostan = '' ; 
        if($row['e_ostan']=="1")   $v_e_ostan ='آذربایجان شرقی' ; 
        if($row['e_ostan']=="2")   $v_e_ostan ='آذربایجان غربی';
        if($row['e_ostan']=="31")  $v_e_ostan ='اردبیل';
        if($row['e_ostan']=="3")   $v_e_ostan ='اصفهان';
        if($row['e_ostan']=="4")   $v_e_ostan ='البرز';
        if($row['e_ostan']=="5")   $v_e_ostan ='ایلام';
        if($row['e_ostan']=="6")   $v_e_ostan ='بوشهر';
        if($row['e_ostan']=="7")   $v_e_ostan ='تهران';
        if($row['e_ostan']=="8")   $v_e_ostan ="چهار محال و بختیاری";
        if($row['e_ostan']=="9")   $v_e_ostan ="خراسان جنوبی";
        if($row['e_ostan']=="10")  $v_e_ostan ="خراسان رضوی";
        if($row['e_ostan']=="11")  $v_e_ostan ="خراسان شمالی";
        if($row['e_ostan']=="12")  $v_e_ostan ="خوزستان";
        if($row['e_ostan']=="13")  $v_e_ostan ="زنجان";
        if($row['e_ostan']=="14")  $v_e_ostan ="سمنان";
        if($row['e_ostan']=="15")  $v_e_ostan ="سیستان و بلوچستان" ;
        if($row['e_ostan']=="16")  $v_e_ostan ="فارس";
        if($row['e_ostan']=="17")  $v_e_ostan ="قزوین";
        if($row['e_ostan']=="18")  $v_e_ostan ="قم";
        if($row['e_ostan']=="19")  $v_e_ostan ="کردستان";
        if($row['e_ostan']=="20")  $v_e_ostan ="کرمان";
        if($row['e_ostan']=="21")  $v_e_ostan ="کرمانشاه";
        if($row['e_ostan']=="22")  $v_e_ostan ="کهگیلویه و بویر احمد";
        if($row['e_ostan']=="23")  $v_e_ostan ="گلستان";
        if($row['e_ostan']=="24")  $v_e_ostan ="گیلان";
        if($row['e_ostan']=="25")  $v_e_ostan ="لرستان";
        if($row['e_ostan']=="26")  $v_e_ostan ="مازندران";
        if($row['e_ostan']=="27")  $v_e_ostan ="مرکزی";
        if($row['e_ostan']=="28")  $v_e_ostan ="هرمزگان";
        if($row['e_ostan']=="29")  $v_e_ostan ="همدان";
        if($row['e_ostan']=="30")  $v_e_ostan ="یزد";
 
        if($row['g_ostan']=="1")  $v_g_ostan ='آذربایجان شرقی' ; 
        if($row['g_ostan']=="2")  $v_g_ostan ='آذربایجان غربی';
        if($row['g_ostan']=="31") $v_g_ostan ='اردبیل';
        if($row['g_ostan']=="3")  $v_g_ostan ='اصفهان';
        if($row['g_ostan']=="4")  $v_g_ostan ='البرز';
        if($row['g_ostan']=="5")  $v_g_ostan ='ایلام';
        if($row['g_ostan']=="6")  $v_g_ostan ='بوشهر';
        if($row['g_ostan']=="7")  $v_g_ostan ='تهران';
        if($row['g_ostan']=="8")  $v_g_ostan ="چهار محال و بختیاری";
        if($row['g_ostan']=="9")  $v_g_ostan ="خراسان جنوبی";
        if($row['g_ostan']=="10") $v_g_ostan ="خراسان رضوی";
        if($row['g_ostan']=="11") $v_g_ostan ="خراسان شمالی";
        if($row['g_ostan']=="12") $v_g_ostan ="خوزستان";
        if($row['g_ostan']=="13") $v_g_ostan ="زنجان";
        if($row['g_ostan']=="14") $v_g_ostan ="سمنان";
        if($row['g_ostan']=="15") $v_g_ostan ="سیستان و بلوچستان" ;
        if($row['g_ostan']=="16") $v_g_ostan ="فارس";
        if($row['g_ostan']=="17") $v_g_ostan ="قزوین";
        if($row['g_ostan']=="18") $v_g_ostan ="قم";
        if($row['g_ostan']=="19") $v_g_ostan ="کردستان";
        if($row['g_ostan']=="20") $v_g_ostan ="کرمان";
        if($row['g_ostan']=="21") $v_g_ostan ="کرمانشاه";
        if($row['g_ostan']=="22") $v_g_ostan ="کهگیلویه و بویر احمد";
        if($row['g_ostan']=="23") $v_g_ostan ="گلستان";
        if($row['g_ostan']=="24") $v_g_ostan ="گیلان";
        if($row['g_ostan']=="25") $v_g_ostan ="لرستان";
        if($row['g_ostan']=="26") $v_g_ostan ="مازندران";
        if($row['g_ostan']=="27") $v_g_ostan ="مرکزی";
        if($row['g_ostan']=="28") $v_g_ostan ="هرمزگان";
        if($row['g_ostan']=="29") $v_g_ostan ="همدان";
        if($row['g_ostan']=="30") $v_g_ostan ="یزد";
		  }
		  
		  else
		  {
		   $v_no_zan = 'مهاجر' ;
		   $v_e_ostan = '' ; 
		   $v_g_ostan = '' ; 
	    if($row['m_ostan']=="1")  $v_m_ostan ='آذربایجان شرقی' ; 
        if($row['m_ostan']=="2")  $v_m_ostan ='آذربایجان غربی';
        if($row['m_ostan']=="31") $v_m_ostan ='اردبیل';
        if($row['m_ostan']=="3")  $v_m_ostan ='اصفهان';
        if($row['m_ostan']=="4")  $v_m_ostan ='البرز';
        if($row['m_ostan']=="5")  $v_m_ostan ='ایلام';
        if($row['m_ostan']=="6")  $v_m_ostan ='بوشهر';
        if($row['m_ostan']=="7")  $v_m_ostan ='تهران';
        if($row['m_ostan']=="8")  $v_m_ostan ="چهار محال و بختیاری";
        if($row['m_ostan']=="9")  $v_m_ostan ="خراسان جنوبی";
        if($row['m_ostan']=="10")  $v_m_ostan ="خراسان رضوی";
        if($row['m_ostan']=="11")  $v_m_ostan ="خراسان شمالی";
        if($row['m_ostan']=="12")  $v_m_ostan ="خوزستان";
        if($row['m_ostan']=="13")  $v_m_ostan ="زنجان";
        if($row['m_ostan']=="14")  $v_m_ostan ="سمنان";
        if($row['m_ostan']=="15")  $v_m_ostan ="سیستان و بلوچستان" ;
        if($row['m_ostan']=="16")  $v_m_ostan ="فارس";
        if($row['m_ostan']=="17")  $v_m_ostan ="قزوین";
        if($row['m_ostan']=="18")  $v_m_ostan ="قم";
        if($row['m_ostan']=="19")  $v_m_ostan ="کردستان";
        if($row['m_ostan']=="20")  $v_m_ostan ="کرمان";
        if($row['m_ostan']=="21")  $v_m_ostan ="کرمانشاه";
        if($row['m_ostan']=="22")  $v_m_ostan ="کهگیلویه و بویر احمد";
        if($row['m_ostan']=="23")  $v_m_ostan ="گلستان";
        if($row['m_ostan']=="24")  $v_m_ostan ="گیلان";
        if($row['m_ostan']=="25")  $v_m_ostan ="لرستان";
        if($row['m_ostan']=="26")  $v_m_ostan ="مازندران";
        if($row['m_ostan']=="27")  $v_m_ostan ="مرکزی";
        if($row['m_ostan']=="28")  $v_m_ostan ="هرمزگان";
        if($row['m_ostan']=="29")  $v_m_ostan ="همدان";
        if($row['m_ostan']=="30")  $v_m_ostan ="یزد";
		  }
		  
       if($row['mt_mom']=="1") $v_mt_mom ="خود زنبورستان";
       if($row['mt_mom']=="2") $v_mt_mom ="سایر زنبورستان ها";
       if($row['mt_mom']=="3") $v_mt_mom ="ترکیبی";
	
       if($row['m_tah']=="1") $v_m_tah ="لیسانس";
       if($row['m_tah']=="2") $v_m_tah ="فوق لیسانس";
       if($row['m_tah']=="3") $v_m_tah ="دکتری";
       if($row['m_tah']=="4") $v_m_tah ="دیپلم";
       if($row['m_tah']=="5") $v_m_tah ="فوق دیپلم";


  ?>
        <tr>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tel_m']; ?></td>
          <td height="41" bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tel_s']; ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['r_tah'];?></td>
          <td class="normalTextSmall"><?php echo $v_m_tah; ?></td>
          <td class="normalTextSmall"><?php echo $row['Last_name']; ?></td>
          <td class="normalTextSmall"><?php echo $row['name']; ?></td>
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