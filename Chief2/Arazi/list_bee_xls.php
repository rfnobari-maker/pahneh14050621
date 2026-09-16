<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=bee_list.xls");
?>
<?php 
include('../../lock_ce.php');
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
$query = "SELECT * FROM  tk_arazi where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC' dir="rtl">
        <tr class="text1">
          <td bgcolor="#FFCC99">تاریخ ثبت </td>
          <td bgcolor="#FFCC99">شماره همراه</td>
          <td bgcolor="#FFCC99">کد ملی</td>
          <td width="3%" height="31" bgcolor="#FFCC99">نام مروج </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            سایر</td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            29 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            28 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            27 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            26 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            25 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            24 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            23</td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            22 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            21 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            20 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            19 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            18 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            17 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            16 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            15 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            14 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            13 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            12</td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            11 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            10 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            9 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            8 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            7 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            6 </td>
          <td width="3%" height="31" bgcolor="#FFCC99">تغییر کاربری<br />
            5 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            4 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            3 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            2 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            1</td>
          <td width="6%" bgcolor="#FFCC99">آدرس محل</td>
          <td width="4%" bgcolor="#FFCC99">مختصات<br /> 
            Y
</td>
          <td width="6%" bgcolor="#FFCC99">مختصات<br />
          X</td>
          <td width="6%" bgcolor="#FFCC99">متراز<br />
متر مربع</td>
          <td width="6%" bgcolor="#FFCC99">نوع زمین</td>
          <td width="4%" bgcolor="#FFCC99">نوع کاربری</td>
          <td width="2%" bgcolor="#FFCC99">کد ملی </td>
          <td width="4%" bgcolor="#FFCC99">نام و نام خانوادگی</td>
          <td width="7%" bgcolor="#FFCC99">آبادی</td>
          <td width="7%" bgcolor="#FFCC99">شهرستان</td>
          <td width="3%" bgcolor="#FFCC99">ردیف</td>
        </tr>
          <?php  
		   $r = 1 ;
		  foreach($stmt as $row){ 
        $pic = user_pic($row['mor_cod_m']) ; 
       
	    if ($row['no_ka']=='1') $v_no_ka = 'زراعی'; else $v_no_ka = 'باغی' ;
        if ($row['no_ara']=='1') $v_no_ara = 'آبی'; else $v_no_ara = 'دیم' ;

  ?>
        <tr>
          <td width="2%" bgcolor="#FFFFCC"><span class="normalTextSmall"><?php echo $row['date_s'] ?></span></td>
          <td width="3%"><?php echo user_tel($row['mor_cod_m'])?></td>
          <td width="2%"><?php echo $row['mor_cod_m']?></td>
          <td height="41" class="normalTextSmaller"><p><?php echo user_name($row['mor_cod_m'])?></p></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['t_sha'] ?></td>
          <td class="normalTextSmall"><?php echo $row['sh_zan'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_mt_mom  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php 
		  if ($row['to_mo'] > 0) {
		  echo round(($row['to_mo'] / $row['tk_mo']),1) ;
		  }
		  else 
		  {
			  echo 0 ; 
		  }
		   ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php 
		  if ($row['to_bo'] > 0) {
		  echo round(($row['to_bo'] / $row['tk_bo']),1) ; 
		  }
		  else 
		  {
			  echo 0 ; 
		  }
		  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['t_sha'] ?></td>
          <td class="normalTextSmall"><?php echo $row['sh_zan'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_mt_mom  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php 
		  if ($row['to_mo'] > 0) {
		  echo round(($row['to_mo'] / $row['tk_mo']),1) ;
		  }
		  else 
		  {
			  echo 0 ; 
		  }
		   ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php 
		  if ($row['to_bo'] > 0) {
		  echo round(($row['to_bo'] / $row['tk_bo']),1) ; 
		  }
		  else 
		  {
			  echo 0 ; 
		  }
		  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['t_sha'] ?></td>
          <td class="normalTextSmall"><?php echo $row['sh_zan'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_mt_mom  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_g_ostan
 ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_e_ostan ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['no_mo'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_city'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_m_ostan ?></td>
          <td class="normalTextSmall"><?php echo $v_no_zan?></td>
          <td height="41" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tk_cod_m'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></td>
          <td class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall"><?php echo city_name($row['id_city']); ?></td>
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
      <p></p>
      <table width="25%" align="right" cellpadding="0" cellspacing="0" class="input_text">
        <tr>
          <td width="455" height="31" style="text-align: right" dir="rtl">&nbsp;عبور شبکه‎های برق</td>
          <td width="24" style="text-align: left">15</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;برداشت یا افزایش    شن و ماسه</td>
          <td width="48" style="text-align: left">1</td>
        </tr>
        <tr>
          <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;انتقال و تغییر    حقابه اراضی زارعی و باغات به سایر اراضی و فعالیت‎های غیر کشاورزی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">16</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;ایجاد بنا و    تأسیسات</td>
          <td bgcolor="#CCCCCC" style="text-align: left">2</td>
        </tr>
        <tr>
          <td width="455" height="41" style="text-align: right" dir="rtl">&nbsp;سوازندن، قطع و    ریشه کنی و خشک کردن باغات به هر طریق</td>
          <td style="text-align: left">17</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;خاکبرداری و    خاکریزی</td>
          <td style="text-align: left">3</td>
        </tr>
        <tr>
          <td width="455" height="37" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;مخلوط ریزی و شن    ریزی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">18</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;گود برداری</td>
          <td bgcolor="#CCCCCC" style="text-align: left">4</td>
        </tr>
        <tr>
          <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث راه‎آهن و فرودگاه</td>
          <td style="text-align: left">19</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث کوره‎های آجر    و گچ‎پزی</td>
          <td style="text-align: left">5</td>
        </tr>
        <tr>
          <td width="455" height="38" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;احداث پارک و فضای    سبز.</td>
          <td bgcolor="#CCCCCC" style="text-align: left">20</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;پی کنی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">6</td>
        </tr>
        <tr>
          <td width="455" height="41" style="text-align: right" dir="rtl">&nbsp;پیست‎های ورزشی</td>
          <td style="text-align: left">21</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;دیوار کشی اراضی</td>
          <td style="text-align: left">7</td>
        </tr>
        <tr>
          <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استخرهای ذخیره آب    غیر کشاورزی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">22</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دپوی زباله، نخاله    و مصالح ساختمانی، شن و ماسه و ضایعات فلزی.</td>
          <td bgcolor="#CCCCCC" style="text-align: left">8</td>
        </tr>
        <tr>
          <td width="455" height="40" style="text-align: right" dir="rtl">&nbsp;احداث پارکینگ مسقف    و غیرمسقف</td>
          <td style="text-align: left">23</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;ایجاد سکونتگاههای    موقت</td>
          <td style="text-align: left">9</td>
        </tr>
        <tr>
          <td width="455" height="47" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">محوطه سازی (شامل سنگفرش    و آسفالت کاری، جدول گذاری، سنگ ریزی و موارد مشابه)</td>
          <td bgcolor="#CCCCCC" style="text-align: left">24</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;استقرار کانکس و    آلاچیق</td>
          <td bgcolor="#CCCCCC" style="text-align: left">10</td>
        </tr>
        <tr>
          <td width="455" height="42" style="text-align: right" dir="rtl">&nbsp;صنایع تبدیلی و    تکمیلی و غذایی و طرح‎های موضوع تبصره 4 فوق‎الذکر.</td>
          <td style="text-align: left">25</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;احداث جاده و راه</td>
          <td style="text-align: left">11</td>
        </tr>
        <tr>
          <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;صنایع دستی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">26</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;دفن زباله‎های    واحدهای صنعتی</td>
          <td bgcolor="#CCCCCC" style="text-align: left">12</td>
        </tr>
        <tr>
          <td width="455" height="49" style="text-align: right" dir="rtl">&nbsp;طرح‎های خدمات    عمومی</td>
          <td style="text-align: left">27</td>
          <td width="453" style="text-align: right" dir="rtl">&nbsp;رها کردن پساب‎های    واحدهای صنعتی، فاضلاب‎های شهری، ضایعات کارخانجات</td>
          <td style="text-align: left">13</td>
        </tr>
        <tr>
          <td width="455" height="42" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;طرح‎های تملک    دارایی‎های سرمایه‎ای مصوب مجلس شورای اسلامی (ملی – استانی).</td>
          <td bgcolor="#CCCCCC" style="text-align: left">28</td>
          <td width="453" bgcolor="#CCCCCC" style="text-align: right" dir="rtl">&nbsp;لوله گذاری</td>
          <td bgcolor="#CCCCCC" style="text-align: left">14</td>
        </tr>
        <tr>
          <td height="42" bgcolor="#FFFFFF" style="text-align: right" dir="rtl">&nbsp;</td>
          <td bgcolor="#FFFFFF" style="text-align: left">&nbsp;</td>
          <td bgcolor="#FFFFFF" style="text-align: right" dir="rtl">تغییر طرح های موضوع تبصره 4 به طرح های موضوع تبصره یک </td>
          <td bgcolor="#FFFFFF" style="text-align: left">29</td>
        </tr>
      </table>
      <p></p>
    <p> </p></td>
  </tr>
</table>
</body>
</html>