<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=bee_list.xls");
?>
<?php 
include('../../lock_expsh.php');
include('../../event.php') ;
require_once('../../Jalali.php');
 date_default_timezone_set('Asia/Tehran') ;
 $date_em = jdate("Y");
 $id_ostan1 = $_POST['id_ostan'] ;
 $mab_ostan = $_POST['mab_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_zan = $_POST['no_zan'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $sal = $_POST['sal'] ;
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
include ('../../login/config.php');
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;} else{ $v_id_ostan  = "bee.id_ostan='$id_ostan1'" ;}
 if ($mab_ostan == '-1')    { $v_m_ostan    = 1 ;} else{ $v_m_ostan   = "bee.m_ostan='$mab_ostan'" ;}
 if ($id_city == 0)         { $v_id_city    = 1 ;} else{ $v_id_city   = "bee.id_city='$id_city'" ;}
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;} else{ $v_id_mar    = "bee.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')    { $f_add_abadi  = 1 ;} else{ $f_add_abadi = "bee.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city   = 1 ;} else{ $f_add_city  = "bee.add_city = '$add_city'" ;}
 if ($no_zan == '0')        { $f_no_zan     = 1 ;} else{ $f_no_zan    = "bee.no_zan = '$no_zan'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m  = 1 ;} else{ $v_mor_cod_m = "bee.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m  = 1 ;} else{ $v_bah_cod_m = "bee.bah_cod_m = '$bah_cod_m'" ;}
 if ($sal == '')            { $v_sal        = 1 ;} else{ $v_sal       = "bee.sal = '$sal'" ;}
$query = "SELECT bee.*,bah.m_tah,bah.date_t,bah.tel_m,bah.m_tah,bah.name,bah.last_name,ostanname.ostan,cityname.city 
FROM  bee 
left join bah on bah.bah_cod_m = bee.bah_cod_m and bah.num_bah = bee.num_bah
left join ostanname on bee.id_ostan = ostanname.id_ostan 
left join cityname on bee.id_ostan = cityname.id_ostan and  bee.id_city = cityname.id_city
where bee.date_s > '1397/10/30' and $v_id_ostan  and  $v_m_ostan and  $v_id_city and $v_id_mar and $v_sal and $f_add_abadi and $f_add_city and $f_no_zan and $v_mor_cod_m and $v_bah_cod_m  ORDER BY bah_cod_m ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC' dir="rtl">
        <tr class="text1">
          <td align="center" bgcolor="#FFCC99">تاریخ ثبت </td>
          <td align="center" bgcolor="#FFCC99">شماره همراه</td>
          <td align="center" bgcolor="#FFCC99">کد ملی</td>
          <td align="center" width="2%" height="31" bgcolor="#FFCC99">نام مروج </td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید ژل رویال Kg</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید برموم Kg</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید موم Kg</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید گرده Kg</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید جمع Kg</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید مدرن</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تولید بومی</td>
          <td align="center" width="2%" bgcolor="#FFCC99">جمع</td>
          <td align="center" width="2%" height="31" bgcolor="#FFCC99">تعداد مدرن</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تعداد بومی</td>
          <td align="center" width="2%" bgcolor="#FFCC99">بیمه کلنی</td>
          <td align="center" width="3%" bgcolor="#FFCC99">بیمه زنبوردار</td>
          <td align="center" width="3%" bgcolor="#FFCC99">تعداد شاغلین</td>
          <td align="center" width="3%" bgcolor="#FFCC99">شماره دفترچه</td>
          <td align="center" width="2%" bgcolor="#FFCC99">محل تامین ملکه</td>
          <td align="center" width="4%" bgcolor="#FFCC99">استان قشلاق (بومی)</td>
          <td align="center" width="3%" bgcolor="#FFCC99">استان ییلاق (بومی)</td>
          <td align="center" width="4%" bgcolor="#FFCC99">شماره مجوز (مهاجر)</td>
          <td align="center" width="5%" bgcolor="#FFCC99">شهرستان مبداء(مهاجر)</td>
          <td align="center" width="5%" bgcolor="#FFCC99">استان مبداء(مهاجر)</td>
          <td align="center" width="4%" bgcolor="#FFCC99"><p>نوع زنبورستان</p></td>
          <td align="center" width="3%" bgcolor="#FFCC99">عضو تعاونی</td>
          <td align="center" width="3%" bgcolor="#FFCC99">شناسه زنبورستان </td>
          <td align="center" width="3%" bgcolor="#FFCC99">شماره همراه</td>
          <td align="center" width="4%" bgcolor="#FFCC99">مدرک تحصیلی</td>
          <td align="center" width="2%" bgcolor="#FFCC99">سن</td>
          <td align="center" width="2%" bgcolor="#FFCC99">تاریخ تولد </td>
          <td align="center" width="2%" bgcolor="#FFCC99">کد ملی </td>
          <td align="center" width="4%" bgcolor="#FFCC99">نام </td>
          <td align="center" width="4%" bgcolor="#FFCC99"> نام خانوادگی</td>
          <td align="center" width="2%" bgcolor="#FFCC99">آبادی</td>
          <td align="center" width="2%" bgcolor="#FFCC99">شهر</td>
          <td align="center" width="12%" bgcolor="#FFCC99">شهرستان</td>
          <td align="center" width="4%" bgcolor="#FFCC99">استان</td>
          <td align="center" width="4%" bgcolor="#FFCC99">ردیف</td>
        </tr>
        <?php  
		   $r = 1 ;
		  foreach($stmt as $row){ 
        $age = $date_em - substr($row['date_t'],0,4) ; 
        if ($age>150) $age = '-' ; 
        $pic = user_pic($row['mor_cod_m']) ; 
        if($row['no_zan']=='1') 
		  {
	     $v_no_zan = 'بومی '; 
		  }
		  else
		  {
		   $v_no_zan = 'مهاجر' ;
		  }
       if($row['mt_mom']=="1") $v_mt_mom ="داخل کشور";
       if($row['mt_mom']=="2") $v_mt_mom ="خارج از کشور";
       if($row['oz_tav']=="1") $v_oz_tav ="بلی";
       if($row['oz_tav']=="2") $v_oz_tav ="خیر";
       if($row['bem_zan']=="1") $v_bem_zan ="بیمه زنبورداری";
       if($row['bem_zan']=="2") $v_bem_zan ="سایر بیمه ها";
       if($row['bem_zan']=="3") $v_bem_zan ="ندارد";
       if($row['bem_kand']=="1") $v_bem_kand ="دارد";
       if($row['bem_kand']=="2") $v_bem_kand ="ندارد";
       if($row['m_tah']=="1") $v_m_tah ="بیسواد";
       if($row['m_tah']=="2") $v_m_tah ="خواندن و نوشتن";
       if($row['m_tah']=="3") $v_m_tah ="سیکل";
       if($row['m_tah']=="4") $v_m_tah ="دیپلم";
       if($row['m_tah']=="5") $v_m_tah ="فوق دیپلم";
       if($row['m_tah']=="6") $v_m_tah ="لیسانس";
       if($row['m_tah']=="7") $v_m_tah ="فوق لیسانس";
       if($row['m_tah']=="8") $v_m_tah ="دکتری";
       if($row['m_tah']=="9") $v_m_tah ="تحصیلات حوزوی";
  ?>
        <tr>
          <td width="2%" bgcolor="#FFFFCC"><span class="normalTextSmall"><?php echo $row['date_s'] ?></span></td>
          <td width="3%"><?php echo user_tel($row['mor_cod_m'])?></td>
          <td width="2%"><?php echo $row['mor_cod_m']?></td>
          <td height="41" class="normalTextSmaller"><p><?php echo user_name($row['mor_cod_m'])?></p></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_jel'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_bar'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_mom'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_gar'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_bem_kand ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_bem_zan ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['t_sha'] ?></td>
          <td class="normalTextSmall"><?php echo $row['sh_zan'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_mt_mom  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo ostan_name($row['g_ostan']) ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo ostan_name($row['e_ostan']) ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['no_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_city'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo ostan_name($row['m_ostan']) ?></td>
          <td class="normalTextSmall"><?php echo $v_no_zan?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_oz_tav?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['cod_sh'] ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tel_m'] ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_m_tah ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $age ; ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['date_t'] ?></td>
          <td height="41" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['bah_cod_m'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['name']?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['last_name']?></td>
          <td class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall"><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall"><?php echo $row['city']; ?></td>
          <td class="normalTextSmall"><?php echo $row['ostan']; ?></td>
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
      </table>      <p>
    </p></td>
  </tr>
</table>
</body>
</html>