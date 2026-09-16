<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=bee_list.xls");
?>
<?php 
include('../../lock_ce.php');
include('../../event.php') ;
require_once('../../Jalali.php');
 date_default_timezone_set('Asia/Tehran') ;
 $date_em = jdate("Y");
 $id_ostan1 = $_POST['id_ostan'] ;
 $m_ostan = $_POST['m_ostan'] ;
 $m_city = $_POST['m_city'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_zan = $_POST['no_zan'] ;
  $no_bah = $_POST['no_bah'] ;
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
 if ($m_ostan == '-1')      { $v_m_ostan    = 1 ;} else{ $v_m_ostan   = "bee.m_ostan='$m_ostan'" ;}
 if ($m_city =='')          { $v_m_city    = 1  ;} else{ $v_m_city    = "bee.m_city='$m_city'" ;}
 if ($id_city == 0)         { $v_id_city    = 1 ;} else{ $v_id_city   = "bee.id_city='$id_city'" ;}
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;} else{ $v_id_mar    = "bee.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')    { $f_add_abadi  = 1 ;} else{ $f_add_abadi = "bee.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city   = 1 ;} else{ $f_add_city  = "bee.add_city = '$add_city'" ;}
 if ($no_zan == '0')        { $f_no_zan     = 1 ;} else{ $f_no_zan    = "bee.no_zan = '$no_zan'" ;}
 if ($no_bah == '0')        { $f_no_bah     = 1 ;} else{ $f_no_bah    = "bah.no_bah = '$no_bah'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m  = 1 ;} else{ $v_mor_cod_m = "bee.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m  = 1 ;} else{ $v_bah_cod_m = "bee.bah_cod_m = '$bah_cod_m'" ;}
 if ($sal == '')            { $v_sal        = 1 ;} else{ $v_sal       = "bee.sal = '$sal'" ;}
$query = "SELECT bee.*,bah.nation,bah.co_name,bah.sh_meli,bah.no_bah,bah.m_tah,bah.date_t,bah.tel_m,bah.m_tah,bah.name,bah.last_name,ostanname.ostan,cityname.city 
FROM  bee 
right join bah on bah.bah_cod_m = bee.bah_cod_m and bah.num_bah = bee.num_bah
right join ostanname on bee.id_ostan = ostanname.id_ostan 
right join cityname on bee.id_ostan = cityname.id_ostan and  bee.id_city = cityname.id_city
where  $f_no_bah and $v_id_ostan  and  $v_m_ostan and  $v_m_city and  $v_id_city and $v_id_mar and $v_sal and $f_add_abadi and $f_add_city and $f_no_zan and $v_mor_cod_m and $v_bah_cod_m   group by bee.id ORDER BY bah_cod_m ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC' dir="rtl">
        <tr class="text1">
          <td rowspan="2" align="center" bgcolor="#FFCC99">تاریخ ثبت </td>
          <td rowspan="2" align="center" bgcolor="#FFCC99">شماره همراه</td>
          <td rowspan="2" align="center" bgcolor="#FFCC99">کد ملی</td>
          <td width="2%" height="31" rowspan="2" align="center" bgcolor="#FFCC99">نام مروج </td>
          <td width="2%" colspan="5" align="center" bgcolor="#FFCC99">تلفات ناشی از بیماری </td>
          <td width="2%" colspan="5" align="center" bgcolor="#FFCC99"> تلفات ناشی از حوادث</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید نان زنبور<br />
            Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تعداد کلنی تولید کننده نان زنبور</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید زهر g </td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید ژل رویال g</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تعداد کلنی تولید کننده ژل رویال</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید برموم Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید موم Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید گرده Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">کل عسل تولیدی Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید عسل مدرن Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تولید عسل سنتی
          Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">مصرف سالانه شکر Kg</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">جمع</td>
          <td width="2%"  rowspan="2" align="center" bgcolor="#FFCC99">تعداد کندوی مدرن</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تعدادکندوی سنتی</td>
          <td width="4%" colspan="6" align="center" bgcolor="#FFCC99">تعداد  ملکه های خریداری شده</td>
          <td colspan="3" align="center" bgcolor="#FFCC99">تعداد ملکه تولیدی</td>
          <td width="4%" colspan="5" align="center" bgcolor="#FFCC99">نژاد ملکه های موجود </td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">شماره مجوز (مهاجر)</td>
          <td width="5%" rowspan="2" align="center" bgcolor="#FFCC99">شهرستان مبداء(مهاجر)</td>
          <td width="5%" rowspan="2" align="center" bgcolor="#FFCC99">استان مبداء(مهاجر)</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">استان قشلاق (غیرمهاجر)</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">استان ییلاق (غیر مهاجر)</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99"><p> نوع زنبورداری </p></td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">بیمه کلنی</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">نوع بیمه زنبوردار</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">تعداد شاغلین</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">شماره پروانه زنبورداری</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">عضو تعاونی</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">زنبورداری شغل</td>
          <td width="3%" rowspan="2" align="center" bgcolor="#FFCC99">شماره همراه</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">مدرک تحصیلی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">سن</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تاریخ تولد </td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">تبعه</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">کد ملی </td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">نام </td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99"> نام خانوادگی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">شناسه ملی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">نام شرکت / موسسه</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">نوع بهره بردار</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">عرض جغرافیایی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">طول جغرافیایی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">آبادی</td>
          <td width="2%" rowspan="2" align="center" bgcolor="#FFCC99">شهر</td>
          <td width="12%" rowspan="2" align="center" bgcolor="#FFCC99">شهرستان</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">استان</td>
          <td width="4%" rowspan="2" align="center" bgcolor="#FFCC99">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="1%" align="center" bgcolor="#FFCC99">سایر</td>
          <td width="1%" align="center" bgcolor="#FFCC99">لارو میری</td>
          <td width="1%" align="center" bgcolor="#FFCC99">CCD</td>
          <td width="2%" align="center" bgcolor="#FFCC99">نوزما</td>
          <td width="2%" align="center" bgcolor="#FFCC99">گنه واروآ</td>
          <td width="1%" align="center" bgcolor="#FFCC99">سایر</td>
          <td width="1%" align="center" bgcolor="#FFCC99">خشکسالی</td>
          <td width="2%" align="center" bgcolor="#FFCC99">حمله وحوش</td>
          <td width="2%" align="center" bgcolor="#FFCC99">سیل</td>
          <td width="2%" align="center" bgcolor="#FFCC99">سمپاشی</td>
          <td align="center" bgcolor="#FFCC99">کل </td>
          <td align="center" bgcolor="#FFCC99">سایر</td>
          <td align="center" bgcolor="#FFCC99">ایتالیایی</td>
          <td align="center" bgcolor="#FFCC99">قفقازی</td>
          <td align="center" bgcolor="#FFCC99">کارنیکا</td>
          <td align="center" bgcolor="#FFCC99">ایرانی</td>
          <td width="3%" align="center" bgcolor="#FFCC99">کل </td>
          <td width="3%" align="center" bgcolor="#FFCC99">عرضه شده</td>
          <td width="3%" align="center" bgcolor="#FFCC99">خود مصرفی</td>
          <td align="center" bgcolor="#FFCC99">سایر</td>
          <td align="center" bgcolor="#FFCC99">ایتالیایی</td>
          <td align="center" bgcolor="#FFCC99">قفقازی</td>
          <td align="center" bgcolor="#FFCC99">کارنیکا</td>
          <td align="center" bgcolor="#FFCC99">ایرانی</td>
        </tr>
        <?php  
		   $r = 1 ;
		  foreach($stmt as $row){ 
        $age = $date_em - substr($row['date_t'],0,4) ; 
        if ($age>150) $age = '-' ; 
        $pic = user_pic($row['mor_cod_m']) ; 
        if($row['no_zan']=='1') 
		  {
	     $v_no_zan = 'غیرمهاجر '; 
		  }
		  else
		  {
		   $v_no_zan = 'مهاجر' ;
		  }
		  
       $tm_kol  = $row['tm_kh'] + $row['tm_arz'] ; 
       $tmk_kol =  $row['tmk_nejad1'] + $row['tmk_nejad2'] + $row['tmk_nejad3'] + $row['tmk_nejad4'] + $row['tmk_nejad5'] ;
       if($row['vaz_zan']=="1") $v_vaz_zan ="اصلی";
       if($row['vaz_zan']=="2") $v_vaz_zan ="فرعی";	 

       if($row['no_bah']=="1") $v_no_bah ="حقیقی";
       if($row['no_bah']=="2") $v_no_bah ="حقوقی";	 
	     

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
          <td align="center" width="2%" bgcolor="#FFFFCC"><span class="normalTextSmall"><?php echo $row['date_s'] ?></span></td>
          <td align="center" width="3%"><?php echo user_tel($row['mor_cod_m'])?></td>
          <td align="center" width="2%"><?php echo $row['mor_cod_m']?></td>
          <td align="center" height="35" class="normalTextSmaller"><p><?php echo user_name($row['mor_cod_m'])?></p></td>
          <td align="center" bgcolor="#FFCCFF" class="normalTextSmall" ><?php echo $row['tal_b_s'] ; ?></td>
          <td align="center" bgcolor="#FFCCFF" class="normalTextSmall" ><?php echo $row['tal_b_lav'] ; ?></td>
          <td align="center" bgcolor="#FFCCFF" class="normalTextSmall" ><?php echo $row['tal_b_ccd'] ; ?></td>
          <td align="center" bgcolor="#FFCCFF" class="normalTextSmall" ><?php echo $row['tal_b_noz'] ; ?></td>
          <td align="center" bgcolor="#FFCCFF" class="normalTextSmall" ><?php echo $row['tal_b_var'] ; ?></td>
          <td align="center" bgcolor="#FFCCCC" class="normalTextSmall" ><?php echo $row['tal_h_s'] ; ?></td>
          <td align="center" bgcolor="#FFCCCC" class="normalTextSmall" ><?php echo $row['tal_h_kh'] ; ?></td>
          <td align="center" bgcolor="#FFCCCC" class="normalTextSmall" ><?php echo $row['tal_h_hv'] ; ?></td>
          <td align="center" bgcolor="#FFCCCC" class="normalTextSmall" ><?php echo $row['tal_h_sel'] ; ?></td>
          <td align="center" bgcolor="#FFCCCC" class="normalTextSmall" ><?php echo $row['tal_h_sam'] ; ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_nan'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_k_nan'] ; ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_zah'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_jel'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_k_jel'] ; ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_bar'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_mom'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['t_gar'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
          <td align="center" bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['m_shaker'] ; ?></td>
          <td align="center" bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td align="center" bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td align="center" bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $tmk_kol ; ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tmk_nejad5'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tmk_nejad4'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tmk_nejad3'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tmk_nejad2'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tmk_nejad1'] ?></td>
          <td align="center" class="normalTextSmall"><?php echo $tm_kol ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['tm_arz']  ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['tm_kh'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_nejad5'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_nejad4'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_nejad3'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_nejad2'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_nejad1'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['no_mo'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo city_name1($row['m_city'],$row['m_ostan']) ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo ostan_name($row['m_ostan']) ?></td>
          <td align="center" class="normalTextSmall"><?php echo ostan_name($row['g_ostan']) ?></td>
          <td align="center" class="normalTextSmall"><?php echo ostan_name($row['e_ostan']) ?></td>
          <td align="center" class="normalTextSmall"><?php echo $v_no_zan?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_bem_kand ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_bem_zan ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['t_sha'] ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['sh_zan'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_oz_tav?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_vaz_zan ;  ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tel_m'] ;  ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_m_tah ;  ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $age ; ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['date_t'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['nation'] ;  ?></td>
          <td align="center" height="35" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['bah_cod_m'] ?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['name']?></td>
          <td align="center" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['last_name']?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['sh_meli']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['co_name']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo $v_no_bah ;  ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['lat']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['lng']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" class="normalTextSmall"><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['city']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo $row['ostan']; ?></td>
          <td align="center" class="normalTextSmall"><?php echo $r;?></td>
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