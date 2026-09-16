<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=tk_arazi.xls");
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
            نوع29 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع28 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع27 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع26 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع25 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع24 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع23</td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع22 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع21 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع20 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع19 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع18 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع17 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع16 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع15 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع14 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع13 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع12</td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع11 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع10 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع9 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع8 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع7 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع6 </td>
          <td width="3%" height="31" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع5 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع4 </td>
          <td width="4%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع3 </td>
          <td width="3%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع2 </td>
          <td width="2%" bgcolor="#FFCC99">تغییر کاربری<br />
            نوع 1</td>
          <td width="6%" bgcolor="#FFCC99">آدرس محل</td>
          <td width="4%" bgcolor="#FFCC99">مختصات<br /> 
            Y
</td>
          <td width="6%" bgcolor="#FFCC99">مختصات<br />
          X</td>
          <td width="6%" bgcolor="#FFCC99">متراز<br />
متر مربع</td>
          <td width="6%" bgcolor="#FFCC99">نوع اراضی</td>
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
 
        if ($row['tk_1']=='on') $v_tk_1 = '*' ;
        if ($row['tk_2']=='on') $v_tk_2 = '*' ;
        if ($row['tk_3']=='on') $v_tk_3 = '*' ;
        if ($row['tk_4']=='on') $v_tk_4 = '*' ;
        if ($row['tk_5']=='on') $v_tk_5 = '*' ;
        if ($row['tk_6']=='on') $v_tk_6 = '*' ;
        if ($row['tk_7']=='on') $v_tk_7 = '*' ;
        if ($row['tk_8']=='on') $v_tk_8 = '*' ;
        if ($row['tk_9']=='on') $v_tk_9 = '*' ;
        if ($row['tk_10']=='on') $v_tk_10 = '*' ;
        if ($row['tk_11']=='on') $v_tk_11 = '*' ;
        if ($row['tk_12']=='on') $v_tk_12 = '*' ;
        if ($row['tk_13']=='on') $v_tk_13 = '*' ;
        if ($row['tk_14']=='on') $v_tk_14 = '*' ;
        if ($row['tk_15']=='on') $v_tk_15 = '*' ;
        if ($row['tk_16']=='on') $v_tk_16 = '*' ;
        if ($row['tk_17']=='on') $v_tk_17 = '*' ;
        if ($row['tk_18']=='on') $v_tk_18 = '*' ;
        if ($row['tk_19']=='on') $v_tk_19 = '*' ;
        if ($row['tk_20']=='on') $v_tk_20 = '*' ;
        if ($row['tk_21']=='on') $v_tk_21 = '*' ;
        if ($row['tk_22']=='on') $v_tk_22 = '*' ;
        if ($row['tk_23']=='on') $v_tk_23 = '*' ;
        if ($row['tk_24']=='on') $v_tk_24 = '*' ;
        if ($row['tk_25']=='on') $v_tk_25 = '*' ;
        if ($row['tk_26']=='on') $v_tk_26 = '*' ;
        if ($row['tk_27']=='on') $v_tk_27 = '*' ;
        if ($row['tk_28']=='on') $v_tk_28 = '*' ;
        if ($row['tk_29']=='on') $v_tk_29 = '*' ;


  ?>
        <tr>
          <td width="2%" bgcolor="#FFFFCC"><span class="normalTextSmall"><?php echo $row['date_s'] ?></span></td>
          <td width="3%"><?php echo user_tel($row['mor_cod_m'])?></td>
          <td width="2%"><?php echo $row['mor_cod_m']?></td>
          <td height="41" class="normalTextSmaller"><p><?php echo user_name($row['mor_cod_m'])?></p></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall" ><?php echo $row['sa_tk'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall" ><?php echo $v_tk_29 ;  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_tk_28 ;  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_tk_27 ;  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_tk_26 ;  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $v_tk_25 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_24 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_23 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_22 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_21 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_20 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_19 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_18 ; ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_17 ; ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_16 ; ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_15 ; ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_14 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_13 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_12 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_11 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_10 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_9 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_8 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_7 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_6 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_5 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_4 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_3 ;  ?></td>
          <td class="normalTextSmall"><?php echo $v_tk_2 ;  ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $v_tk_1 ;  ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['address'] ?></td>
          <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $row['lat'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['lng'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['m_tk'] ; ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo  $v_no_ara ?></td>
          <td class="normalTextSmall"><?php echo $v_no_ka?></td>
          <td height="41" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['tk_cod_m'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo $row['last_name'].' - '.$row['name'] ; ?></td>
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