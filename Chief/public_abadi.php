<?php include('../lock_ce.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
	<!-- استایل‌های سفارشی برای Accordion - باید بعد از فایل CSS jQuery UI باشد -->
	<style type="text/css">
		/* استایل بهینه شده برای Accordion (تب‌ها) - Override استایل‌های jQuery UI */
		#accordion {
			margin: 20px 0;
			direction: rtl;
			width: 100%;
		}

		/* استایل هدر تب‌ها - با اولویت بالا */
		#accordion h4,
		#accordion .ui-accordion-header {
			font-size: 14px !important;
			font-family: Tahoma, Arial, sans-serif !important;
			font-weight: bold !important;
			background-color: #4CAF50 !important;
			background: #4CAF50 !important;
			color: #FFFFFF !important;
			padding: 12px 15px !important;
			margin: 0 !important;
			border: 1px solid #45a049 !important;
			border-bottom: none !important;
			cursor: pointer !important;
			text-align: right !important;
			position: relative !important;
		}

		/* حالت hover برای تب‌ها */
		#accordion h4:hover,
		#accordion .ui-accordion-header:hover {
			background-color: #45a049 !important;
			background: #45a049 !important;
			color: #FFFFFF !important;
		}

		/* تب فعال (باز شده) */
		#accordion h4.ui-state-active,
		#accordion .ui-accordion-header.ui-state-active {
			background-color: #006699 !important;
			background: #006699 !important;
			border-color: #005580 !important;
			color: #FFFFFF !important;
		}

		#accordion h4.ui-state-active:hover,
		#accordion .ui-accordion-header.ui-state-active:hover {
			background-color: #005580 !important;
			background: #005580 !important;
			color: #FFFFFF !important;
		}

		/* اطمینان از رنگ سفید برای تمام حالت‌های jQuery UI */
		#accordion h4.ui-state-default,
		#accordion .ui-accordion-header.ui-state-default {
			background-color: #4CAF50 !important;
			background: #4CAF50 !important;
			color: #FFFFFF !important;
		}

		#accordion h4.ui-state-hover,
		#accordion .ui-accordion-header.ui-state-hover {
			background-color: #45a049 !important;
			background: #45a049 !important;
			color: #FFFFFF !important;
		}

		#accordion h4.ui-state-focus,
		#accordion .ui-accordion-header.ui-state-focus {
			background-color: #4CAF50 !important;
			background: #4CAF50 !important;
			color: #FFFFFF !important;
		}

		/* اطمینان از رنگ سفید برای تمام عناصر داخل h4 */
		#accordion h4,
		#accordion h4 *,
		#accordion h4 a,
		#accordion .ui-accordion-header,
		#accordion .ui-accordion-header *,
		#accordion .ui-accordion-header a {
			color: #FFFFFF !important;
			text-decoration: none !important;
		}

		/* Override تمام استایل‌های jQuery UI که ممکن است رنگ را تغییر دهند */
		#accordion .ui-widget-content .ui-state-default,
		#accordion .ui-widget-header .ui-state-default {
			background-color: #4CAF50 !important;
			background: #4CAF50 !important;
			color: #FFFFFF !important;
		}

		#accordion .ui-widget-content .ui-state-active,
		#accordion .ui-widget-header .ui-state-active {
			background-color: #006699 !important;
			background: #006699 !important;
			color: #FFFFFF !important;
		}

		#accordion .ui-widget-content .ui-state-hover,
		#accordion .ui-widget-header .ui-state-hover {
			background-color: #45a049 !important;
			background: #45a049 !important;
			color: #FFFFFF !important;
		}

		/* حذف آیکون پیش‌فرض jQuery UI */
		#accordion .ui-accordion-header-icon {
			display: none !important;
		}

		/* استایل محتوای تب‌ها */
		#accordion .ui-accordion-content {
			padding: 15px;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
			border-top: none;
		}

		/* استایل برای div های داخل accordion */
		#accordion > div {
			margin-bottom: 2px;
		}

		#accordion > div:last-child {
			margin-bottom: 0;
		}

		/* بهبود ظاهر فرم‌ها داخل تب‌ها */
		#accordion form {
			margin: 0;
		}

		#accordion table {
			margin: 0 auto;
		}

		/* استایل برای حالت focus */
		#accordion h4:focus,
		#accordion .ui-accordion-header:focus {
			outline: 2px solid #006699;
			outline-offset: -2px;
		}
	</style>
		<!-- jQuery 1.8.3 - کاملاً سازگار با jQuery UI 1.8.16 -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script type="text/javascript">
			// Fallback: اگر CDN کار نکرد، از فایل محلی استفاده کن
			if (typeof jQuery === 'undefined') {
				document.write('<script type="text/javascript" src="../assets/js/jquery-1.8.3.min.js"><\/script>');
			}
		</script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
    	<script type="text/javascript">
			$(document).ready(function(){
				// بررسی وجود jQuery و jQuery UI
				if (typeof jQuery === 'undefined') {
					alert('خطا: jQuery لود نشده است!');
					return;
				}
				if (typeof jQuery.ui === 'undefined') {
					alert('خطا: jQuery UI لود نشده است!');
					return;
				}
				
				// Accordion - استفاده از syntax صحیح برای jQuery UI 1.8.16
				try {
					$("#accordion").accordion({ 
						header: "h4",
						collapsible: true,
						active: false
					});
				} catch(e) {
					console.error('خطا در ایجاد Accordion:', e);
					alert('خطا در ایجاد تب‌ها: ' + e.message);
				}
			});
			function close_window() {
      close();
 }
		</script>
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >

<h1 class="style1"><a name="1" id="1"></a>اطلاعات عمومی آبادی </h1>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
      <?php
if (isset($_POST['add_abadi'])) 
{
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$add_abadi = $_POST['add_abadi'] ; 
include_once('../login/config.php');
$query = "SELECT * FROM public_abadi4 WHERE add_abadi='".$add_abadi."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$abadi= $row['abadi'];
$deh =$row['deh'];
$bakh = $row['bakh'];
$city = $row['city'];
$ostan=$row['ostan'];
$vaz_abadi = $row['vaz_abadi']; 
$rah_zamin = $row['rah_zamin']; 
 $rah_ahan = $row['rah_ahan']; 
 $rah_abi = $row['rah_abi']; 
 $vaz_soko = $row['vaz_soko']; 
 $s_mosem = $row['s_mosem']; 
 $e_mosem = $row['e_mosem']; 
 $t_hadi = $row['t_hadi']; 
 $learn_1 = $row['learn_1'] ; 
 $learn_2 = $row['learn_2'] ; 
 $learn_3 = $row['learn_3'] ; 
 $learn_4 = $row['learn_4'] ; 
 $learn_5 = $row['learn_5'] ; 
 $learn_6 = $row['learn_6'] ; 
 $learn_7 = $row['learn_7'] ; 
 $learn_8 = $row['learn_8'] ; 
 $learn_9 = $row['learn_9'] ; 
 $learn_10 = $row['learn_10'] ; 
 $sport_1 = $row['sport_1'] ; 
 $sport_2 = $row['sport_2'] ; 
 $sport_3 = $row['sport_3'] ; 
 $sport_4 = $row['sport_4'] ; 
 $mazhab_1 = $row['mazhab_1'] ; 
 $mazhab_2 = $row['mazhab_2'] ; 
 $mazhab_3 = $row['mazhab_3'] ; 
 $mazhab_4 = $row['mazhab_4'] ; 
 $mazhab_5 = $row['mazhab_5'] ; 
 $mazhab_6 = $row['mazhab_6'] ; 
 $mazhab_7 = $row['mazhab_7'] ; 
 $mazhab_8 = $row['mazhab_8'] ; 
 $siyasi_1 = $row['siyasi_1'] ; 
 $siyasi_2 = $row['siyasi_2'] ; 
 $siyasi_3 = $row['siyasi_3'] ; 
 $siyasi_4 = $row['siyasi_4'] ; 
 $siyasi_5 = $row['siyasi_5'] ; 
 $niro_1 = $row['niro_1'] ; 
 $niro_2 = $row['niro_2'] ; 
 $niro_3 = $row['niro_3'] ; 
 $niro_4 = $row['niro_4'] ; 
 $niro_5 = $row['niro_5'] ; 
 $niro_6 = $row['niro_6'] ; 
 $beh_1 = $row['beh_1'] ; 
 $beh_2 = $row['beh_2'] ; 
 $beh_3 = $row['beh_3'] ; 
 $beh_4 = $row['beh_4'] ; 
 $beh_5 = $row['beh_5'] ; 
 $beh_6 = $row['beh_6'] ; 
 $beh_7 = $row['beh_7'] ; 
 $beh_8 = $row['beh_8'] ; 
 $beh_9 = $row['beh_9'] ; 
 $beh_10 = $row['beh_10'] ; 
 $beh_11 = $row['beh_11'] ; 
 $beh_12 = $row['beh_12'] ; 
 $beh_13 = $row['beh_13'] ; 
 $beh_14 = $row['beh_14'] ; 
 $beh_15 = $row['beh_15'] ; 
 $beh_16 = $row['beh_16'] ; 
 $beh_17 = $row['beh_17'] ; 
 $khad_1 = $row['khad_1'] ; 
 $khad_2 = $row['khad_2'] ; 
 $khad_3 = $row['khad_3'] ; 
 $khad_4 = $row['khad_4'] ; 
 $khad_5 = $row['khad_5'] ; 
 $khad_6 = $row['khad_6'] ; 
 $khad_7 = $row['khad_7'] ; 
 $khad_8 = $row['khad_8'] ; 
 $khad_9 = $row['khad_9'] ; 
 $khad_10 = $row['khad_10'] ; 
 $khad_11 = $row['khad_11'] ; 
 $khad_12 = $row['khad_12'] ; 
 $ertebat_1 = $row['ertebat_1'] ; 
 $ertebat_2 = $row['ertebat_2'] ; 
 $ertebat_3 = $row['ertebat_3'] ; 
 $ertebat_4 = $row['ertebat_4'] ; 
 $ertebat_5 = $row['ertebat_5'] ; 
 $ertebat_6 = $row['ertebat_6'] ; 
 $ertebat_7 = $row['ertebat_7'] ; 
 $ertebat_8 = $row['ertebat_8'] ; 
 $nofos_1 = $row['nofos_1'] ; 
 $nofos_2 = $row['nofos_2'] ; 
 $nofos_3 = $row['nofos_3'] ; 
 $nofos_4 = $row['nofos_4'] ; 
 $nofos_5 = $row['nofos_5'] ; 
 $add_abadi = $row['add_abadi'];
?>
</P>
    </p>
    <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="11%" height="40" bgcolor="#CCCCCC">بروزرسانی</td>
    <td width="15%" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="15%" bgcolor="#CCCCCC">دهستان</td>
    <td width="12%" bgcolor="#CCCCCC">بخش</td>
    <td width="18%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="14%" bgcolor="#CCCCCC">استان</td>
    </tr>
  <tr>
 <td height="30" class="normalTextSmall" ><?php echo $row['up_date'];?></td>
 <td height="30" class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td><?php echo $row['deh'];?></td>
    <td><?php echo $row['bakh'];?></td>
    <td><?php echo $row['city'];?></td>
    <td><?php echo $row['ostan'];?></td>
    </tr>
</table>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<P style="text-align:center;color:#093;font-size:14px"><?php echo $_POST['meg1'];?>
<div id="accordion">
			<div>
				<h4>اطلاعات پایه</h4>
				<div dir="rtl" align="justify">
                <form action="" method="post" id="form1" name="form1"><div align="center">
          <table style="border:3px solid #069;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td height="38"><div align="right">
       <input name="nofos_3" type="text" id="nofos_3" style="height:25px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" value="<?php echo $nofos_3 ;  ?>" readonly="readonly" />
     </div></td>
     <td height="38"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:جمعیت زن</div></td>
     <td height="38"><div align="right">
       <input name="nofos_2" type="text" id="nofos_2" style="height:25px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" value="<?php echo $nofos_2 ;  ?>" readonly="readonly" />
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >: جمعیت مرد</div></td>
     <td height="38"><div align="right">
       <input name="nofos_1" type="text" id="nofos_1" style="height:25px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" value="<?php echo $nofos_1 ;  ?>" readonly="readonly" />
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:کل جمعیت </div></td>
   </tr>
   <tr>
     <td height="27" colspan="3"><div align="right">
       <input name="nofos_5" type="text" id="nofos_5" style="height:25px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" value="<?php echo $nofos_5 ;  ?>" readonly="readonly" />
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:تعداد واحد مسکونی  </div></td>
     <td height="27"><div align="right">
       <input name="nofos_4" type="text" id="nofos_4" style="height:25px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" value="<?php echo $nofos_4 ;  ?>" readonly="readonly" />
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:تعداد خانوار  </div></td>
   </tr>
   <tr>
     <td height="40" colspan="3">&nbsp;</td>
     <td width="158">&nbsp;</td>
     <td width="228" height="40"><div align="right">
       <select name="vaz_abadi" disabled="disabled" class="required" id="vaz_abadi" style="height:40px ; width:200px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($vaz_abadi=='1') { echo 'selected="selected"' ; } ?>>دشتی</option>
         <option value="2"<?php if ($vaz_abadi=='2') { echo 'selected="selected"' ; } ?>>جنگلی واقع در دشت</option>
         <option value="3"<?php if ($vaz_abadi=='3') { echo 'selected="selected"' ; } ?>>کوهستانی ، دره ای یا تپه ای</option>
         <option value="4"<?php if ($vaz_abadi=='4') { echo 'selected="selected"' ; } ?>>جنگلی واقع در کوهستان یا تپه</option>
         
         </select>
     </div></td>
     <td width="153"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:وضع طبیعی آبادی</div></td>
   </tr>
   <tr>
     <td width="139" height="40"><div align="right">
       <select name="rah_abi" disabled="disabled" class="required" id="rah_abi" style="height:40px ; width:120px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="6"<?php if ($rah_abi=='6') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="0"<?php if ($rah_abi=='0') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="129"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:راه آبی</div></td>
     <td width="132"><div align="right">
       <select name="rah_ahan" disabled="disabled" class="required" id="rah_ahan" style="height:40px ; width:120px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="5"<?php if ($rah_ahan=='5') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="0"<?php if ($rah_ahan=='0') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:ایستگاه راه آهن</div></td>
     <td><div align="right">
       <select name="rah_zamin" disabled="disabled" class="required" id="rah_zamin" style="height:40px ; width:150px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($rah_zamin=='1') { echo 'selected="selected"' ; } ?>>جاده آسفالته</option>
         <option value="2"<?php if ($rah_zamin=='2') { echo 'selected="selected"' ; } ?>>شوسه / شن ریزی شده </option>
         <option value="3"<?php if ($rah_zamin=='3') { echo 'selected="selected"' ; } ?>>جاده خاکی</option>
         <option value="4"<?php if ($rah_zamin=='4') { echo 'selected="selected"' ; } ?>>مالرو</option>
         </select>
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:نوع راه زمینی</div></td>
   </tr>
   <tr>
     <td height="40" bgcolor="#FFFFCC"><div align="right">
       <select name="e_mosem" disabled="disabled" id="e_mosem" style="height:40px ; width:120px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($e_mosem=='1') { echo 'selected="selected"' ; } ?>>فروردین</option>
         <option value="2"<?php if ($e_mosem=='2') { echo 'selected="selected"' ; } ?>>اردیبهشت</option>
         <option value="3"<?php if ($e_mosem=='3') { echo 'selected="selected"' ; } ?>>خرداد</option>
         <option value="4"<?php if ($e_mosem=='4') { echo 'selected="selected"' ; } ?>>تیر</option>
         <option value="5"<?php if ($e_mosem=='5') { echo 'selected="selected"' ; } ?>>مرداد</option>
         <option value="6"<?php if ($e_mosem=='6') { echo 'selected="selected"' ; } ?>>شهریور</option>
         <option value="7"<?php if ($e_mosem=='7') { echo 'selected="selected"' ; } ?>>مهر</option>
         <option value="8"<?php if ($e_mosem=='8') { echo 'selected="selected"' ; } ?>>آبان</option>
         <option value="9"<?php if ($e_mosem=='9') { echo 'selected="selected"' ; } ?>>آذر</option>
         <option value="10"<?php if ($e_mosem=='10') { echo 'selected="selected"' ; } ?>>دی</option>
         <option value="11"<?php if ($e_mosem=='11') { echo 'selected="selected"' ; } ?>>بهمن</option>
         <option value="12"<?php if ($e_mosem=='12') { echo 'selected="selected"' ; } ?>>اسفند</option>
       </select>
     </div></td>
     <td height="40" bgcolor="#FFFFCC"><div align="right" class="normalTextSmall" style="margin-right:15px" >:خاتمه </div></td>
     <td height="40" bgcolor="#FFFFCC"><div align="right">
       <select name="s_mosem" disabled="disabled" id="s_mosem" style="height:40px ; width:120px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($s_mosem=='1') { echo 'selected="selected"' ; } ?>>فروردین</option>
         <option value="2"<?php if ($s_mosem=='2') { echo 'selected="selected"' ; } ?>>اردیبهشت</option>
         <option value="3"<?php if ($s_mosem=='3') { echo 'selected="selected"' ; } ?>>خرداد</option>
         <option value="4"<?php if ($s_mosem=='4') { echo 'selected="selected"' ; } ?>>تیر</option>
         <option value="5"<?php if ($s_mosem=='5') { echo 'selected="selected"' ; } ?>>مرداد</option>
         <option value="6"<?php if ($s_mosem=='6') { echo 'selected="selected"' ; } ?>>شهریور</option>
         <option value="7"<?php if ($s_mosem=='7') { echo 'selected="selected"' ; } ?>>مهر</option>
         <option value="8"<?php if ($s_mosem=='8') { echo 'selected="selected"' ; } ?>>آبان</option>
         <option value="9"<?php if ($s_mosem=='9') { echo 'selected="selected"' ; } ?>>آذر</option>
         <option value="10"<?php if ($s_mosem=='10') { echo 'selected="selected"' ; } ?>>دی</option>
         <option value="11"<?php if ($s_mosem=='11') { echo 'selected="selected"' ; } ?>>بهمن</option>
         <option value="12"<?php if ($s_mosem=='12') { echo 'selected="selected"' ; } ?>>اسفند</option>
       </select>
     </div></td>
     <td bgcolor="#FFFFCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:شروع سکونت موسمی</div></td>
     <td><div align="right">
       <select name="vaz_soko" disabled="disabled" class="required" id="vaz_soko" style="height:40px ; width:150px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($vaz_soko=='1') { echo 'selected="selected"' ; } ?>>دارای سکنه دائمی</option>
         <option value="2"<?php if ($vaz_soko=='2') { echo 'selected="selected"' ; } ?>>دارای سکنه موسمی</option>
         <option value="3"<?php if ($vaz_soko=='3') { echo 'selected="selected"' ; } ?>>خالی از سکنه دائمی</option>
         <option value="4"<?php if ($vaz_soko=='4') { echo 'selected="selected"' ; } ?>>خالی از سکنه موسمی</option>
         </select>
     </div></td>
     <td><div align="right" class="normalTextSmaller" style="margin-right:15px" >:وضع سکونت آبادی </div></td>
   </tr>
   <tr>
     <td height="40" colspan="4" align="center" bgcolor="#FFFFCC"><div align="right" class="normalTextSmall" style="margin-right:15px" >در صورتیکه وضع سکونت آبادی از نوع موسمی باشد تکمیل شود  </div></td>
     <td align="center"><div align="right">
       <select name="t_hadi" disabled="disabled" class="required" id="t_hadi" style="height:40px ; width:150px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($t_hadi=='1') { echo 'selected="selected"' ; } ?>>اجرا شده است </option>
         <option value="2"<?php if ($t_hadi=='2') { echo 'selected="selected"' ; } ?>>در حال اجرا است </option>
         <option value="3"<?php if ($t_hadi=='3') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:طرح هادی</div></td>
   </tr>
          </table>
         
            <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
            <input type="hidden" name="previous" value="<?php echo $previous ;?>">
                </div>

    </form>
			</div>
            	<div>
				<h4>آموزشی</h4>
				<div>
                                <form action="" method="post" id="form2" name="form2"><div align="center">

                                  <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="166" height="44" align="center"><div align="right">
       <select name="learn_2" disabled="disabled" class="required" id="learn_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="246" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبستان</div></td>
     <td width="122" align="center"><div align="right">
       <select name="learn_1" disabled="disabled" class="required" id="learn_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="216" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:روستا مهد</div></td>
   </tr>
   <tr>
     <td height="41" align="center"><div align="right">
       <select name="learn_4" disabled="disabled" class="required" id="learn_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان شبانه روزی دخترانه</div></td>
     <td align="center"><div align="right">
       <select name="learn_3" disabled="disabled" class="required" id="learn_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان شبانه روزی پسرانه</div></td>
   </tr>
   <tr>
     <td height="40" align="center"><div align="right">
       <select name="learn_6" disabled="disabled" class="required" id="learn_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان نظری دخترانه</div></td>
     <td align="center"><div align="right">
       <select name="learn_5" disabled="disabled" class="required" id="learn_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان نظری پسرانه</div></td>
   </tr>
   <tr>
     <td height="40" align="center"><div align="right">
       <select name="learn_8" disabled="disabled" class="required" id="learn_8" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_8=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_8=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان کارو دانش دخترانه</div></td>
     <td align="center"><div align="right">
       <select name="learn_7" disabled="disabled" class="required" id="learn_7" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_7=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_7=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دبیرستان کارو دانش پسرانه</div></td>
   </tr>
   <tr>
     <td height="39" align="center"><div align="right">
       <select name="learn_10" disabled="disabled" class="required" id="learn_10" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="10">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_10=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_10=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:هنرستان فنی و حرفه ای دخترانه</div></td>
     <td align="center"><div align="right">
       <select name="learn_9" disabled="disabled" class="required" id="learn_9" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="9">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($learn_9=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($learn_9=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:هنرستان فنی و حرفه ای پسرانه</div></td>
   </tr>
          </table>
                                  <p>
                                    <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
                                    <input type="hidden" name="previous" value="<?php echo $previous ;?>">
                                  </p>
   			                    </div>

    </form>
			</div>
            	<div>
				<h4>فرهنگی و ورزشی</h4>
				<div>
               <form action="" method="post" id="form3" name="form3">
                 <div align="center">
                   <p>&nbsp;</p>
                   <table style="border:3px solid #069;" width="70%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="166" height="55" align="center"><div align="right">
       <select name="sport_2" disabled="disabled" class="required" id="sport_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($sport_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($sport_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="246" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:کتابخانه عمومی</div></td>
     <td width="122" align="center"><div align="right">
       <select name="sport_1" disabled="disabled" class="required" id="sport_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($sport_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($sport_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="216" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:بوستان روستایی</div></td>
   </tr>
   <tr>
     <td height="51" align="center"><div align="right">
       <select name="sport_4" disabled="disabled" class="required" id="sport_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($sport_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($sport_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:سالن ورزشی</div></td>
     <td align="center"><div align="right">
       <select name="sport_3" disabled="disabled" class="required" id="sport_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($sport_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($sport_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:زمین ورزشی</div></td>
   </tr>
          </table>
                   <p>
                     <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
                     <input type="hidden" name="previous" value="<?php echo $previous ;?>">
                   </p>
   			     </div>

    </form>

                </div>
			</div>
            	<div>
				<h4>مذهبی</h4>
				<div>
            <form action="" method="post" id="form4" name="form4">
              <div align="center">
            <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="166" height="44" align="center"><div align="right">
       <select name="mazhab_2" disabled="disabled" class="required" id="mazhab_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="246" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:امام زاده</div></td>
     <td width="122" align="center"><div align="right">
       <select name="mazhab_1" disabled="disabled" class="required" id="mazhab_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="216" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:مسجد</div></td>
   </tr>
   <tr>
     <td height="41" align="center"><div align="right">
       <select name="mazhab_4" disabled="disabled" class="required" id="mazhab_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:اماکن مذهبی سایر ادیان</div></td>
     <td align="center"><div align="right">
       <select name="mazhab_3" disabled="disabled" class="required" id="mazhab_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:سایر اماکن مذهبی</div></td>
   </tr>
   <tr>
     <td height="40" align="center"><div align="right">
       <select name="mazhab_6" disabled="disabled" class="required" id="mazhab_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دارالقرآن</div></td>
     <td align="center"><div align="right">
       <select name="mazhab_5" disabled="disabled" class="required" id="mazhab_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:مدرسه علمیه</div></td>
   </tr>
   <tr>
     <td height="40" align="center"><div align="right">
       <select name="mazhab_8" disabled="disabled" class="required" id="mazhab_8" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_8=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_8=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:خانه عالم </div></td>
     <td align="center"><div align="right">
       <select name="mazhab_7" disabled="disabled" class="required" id="mazhab_7" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($mazhab_7=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($mazhab_7=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:امام جماعت دایمی</div></td>
   </tr>
          </table>
            <p>
              <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="previous" value="<?php echo $previous ;?>">
            </p>
   			  </div>
    </form>
                </div>
			</div>
            	<div>
				<h4>سیاسی و اداری</h4>
				<div>
                            <form action="" method="post" id="form5" name="form5">
              <div align="center">
            <p>&nbsp;</p>
            <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="166" height="44" align="center"><div align="right">
       <select name="siyasi_2" disabled="disabled" class="required" id="siyasi_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($siyasi_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($siyasi_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="246" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دهیار</div></td>
     <td width="122" align="center"><div align="right">
       <select name="siyasi_1" disabled="disabled" class="required" id="siyasi_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($siyasi_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($siyasi_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="216" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:شورای اسلامی روستا</div></td>
   </tr>
   <tr>
     <td height="41" align="center"><div align="right">
       <select name="siyasi_4" disabled="disabled" class="required" id="siyasi_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($siyasi_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($siyasi_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:شورای حل اختلاف </div></td>
     <td align="center"><div align="right">
       <select name="siyasi_3" disabled="disabled" class="required" id="siyasi_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($siyasi_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($siyasi_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:پاسگاه نیروی انتظامی </div></td>
   </tr>
   <tr>
     <td height="40" align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center"><div align="right">
       <select name="siyasi_5" disabled="disabled" class="required" id="siyasi_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($siyasi_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($siyasi_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:شرکت تعاونی روستایی </div></td>
   </tr>
          </table>
            <p>
              <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="previous" value="<?php echo $previous ;?>">
            </p>
   			  </div>
    </form>
                </div>
			</div>
            	<div>
				<h4>برق ، گاز و آب</h4>
				<div>
                                            <form action="" method="post" id="form6" name="form6">
              <div align="center">
            <p>&nbsp;</p>
            <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="166" height="44" align="center"><div align="right">
       <select name="niro_4" disabled="disabled" class="required" id="niro_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td colspan="2" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > : گاز لوله کشی  </div></td>
     <td width="122" align="center" bgcolor="#FFFFCC"><div align="right">
       <select name="niro_1" disabled="disabled" class="required" id="niro_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="156" align="center" bgcolor="#FFFFCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:شبکه سراسری</div></td>
     <td width="60" rowspan="3" align="center" bgcolor="#FFFFCC">برق</td>
   </tr>
   <tr>
     <td height="41" align="center" bgcolor="#FFCCCC"><div align="right">
       <select name="niro_5" disabled="disabled" class="required" id="niro_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="191" align="center" bgcolor="#FFCCCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:آب لوله کشی </div></td>
     <td width="55" rowspan="2" align="center" bgcolor="#FFCCCC">آب </td>
     <td align="center" bgcolor="#FFFFCC"><div align="right">
       <select name="niro_2" disabled="disabled" class="required" id="niro_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center" bgcolor="#FFFFCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:موتور برق دیزلی</div></td>
     </tr>
   <tr>
     <td height="41" align="center" bgcolor="#FFCCCC"><div align="right">
       <select name="niro_6" disabled="disabled" class="required" id="niro_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center" bgcolor="#FFCCCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:سامانه تصفیه آب </div></td>
     <td align="center" bgcolor="#FFFFCC"><div align="right">
       <select name="niro_3" disabled="disabled" class="required" id="niro_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($niro_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($niro_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center" bgcolor="#FFFFCC"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:انرژی نو خورشیدی ، بادی </div></td>
     </tr>
          </table>
            <p>
              <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="previous" value="<?php echo $previous ;?>">
            </p>
   			  </div>
    </form>
                </div>
			</div>
            	<div>
				<h4>بهداشتی و درمانی</h4>
				<div>
                                   <form action="" method="post" id="form7" name="form7">
              <div align="center">
            <table style="border:3px solid #069;" width="98%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td  height="42" align="center"><div align="right">
       <select name="beh_3" disabled="disabled" class="required" id="beh_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :داروخانه </div></td>
     <td  align="center"><div align="right">
       <select name="beh_2" disabled="disabled" class="required" id="beh_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :مرکز بهداشتی ، درمانی</div></td>
     <td  align="center"><div align="right">
       <select name="beh_1" disabled="disabled" class="required" id="beh_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:حمام عمومی</div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="beh_6" disabled="disabled" class="required" id="beh_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:مرکز تسهیلات زایمان</div></td>
     <td height="40" align="center"><div align="right">
       <select name="beh_5" disabled="disabled" class="required" id="beh_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:پایگاه بهداشت روستایی  </div></td>
     <td align="center"><div align="right">
       <select name="beh_4" disabled="disabled" class="required" id="beh_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:خانه بهداشت</div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="beh_9" disabled="disabled" class="required" id="beh_9" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="9">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_9=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_9=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دندانپزشک ، بهداشت کار دهان و دندان </div></td>
     <td height="48" align="center"><div align="right">
       <select name="beh_8" disabled="disabled" class="required" id="beh_8" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_8=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_8=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:پزشک </div></td>
     <td align="center"><div align="right">
       <select name="beh_7" disabled="disabled" class="required" id="beh_7" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_7=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_7=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:پزشک خانواده </div></td>
     </tr>
   <tr>
     <td width="140" align="center"><div align="right">
       <select name="beh_12" disabled="disabled" class="required" id="beh_12" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="12">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_12=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_12=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="199" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :بهورز </div></td>
     <td width="122" align="center"><div align="right">
       <select name="beh_11" disabled="disabled" class="required" id="beh_11" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="11">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_11=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_11=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="150" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :بهیار یا مامای روستایی</div></td>
     <td width="113" align="center"><div align="right">
       <select name="beh_10" disabled="disabled" class="required" id="beh_10" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="10">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_10=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_10=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="168" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دندانپزشک تجربی ، دندان ساز </div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="beh_15" disabled="disabled" class="required" id="beh_15" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="15">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_15=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_15=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:آزمایشگاه و رایولوژی</div></td>
     <td align="center"><div align="right">
       <select name="beh_14" disabled="disabled" class="required" id="beh_14" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="14">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_14=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_14=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:تکنسین دامپزشکی</div></td>
     <td align="center"><div align="right">
       <select name="beh_13" disabled="disabled" class="required" id="beh_13" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="13">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_13=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_13=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دامپزشک</div></td>
     </tr>
   <tr>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center"><div align="right">
       <select name="beh_17" disabled="disabled" class="required" id="beh_17" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="17">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_17=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_17=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:سامانه جمع آوری زباله</div></td>
     <td align="center"><div align="right">
       <select name="beh_16" disabled="disabled" class="required" id="beh_16" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="16">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($beh_16=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($beh_16=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:غسالخانه </div></td>
     </tr>
            </table>
              <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="previous" value="<?php echo $previous ;?>">
              </div>
    </form>

                </div>
			</div>
            	<div>
				<h4>بازرگانی و خدمات</h4>
				<div>
				  <form action="" method="post" id="form8" name="form8">
              <div align="center">
            <table style="border:3px solid #069;" width="98%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td  height="42" align="center"><div align="right">
       <select name="khad_3" disabled="disabled" class="required" id="khad_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :نمایندگی پخش سیلندر گاز</div></td>
     <td  align="center"><div align="right">
       <select name="khad_2" disabled="disabled" class="required" id="khad_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :نمایندگی پخش نفت سفید</div></td>
     <td  align="center"><div align="right">
       <select name="khad_1" disabled="disabled" class="required" id="khad_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:پایگاه آتش نشانی</div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="khad_6" disabled="disabled" class="required" id="khad_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:نانوایی</div></td>
     <td height="40" align="center"><div align="right">
       <select name="khad_5" disabled="disabled" class="required" id="khad_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:بقالی  </div></td>
     <td align="center"><div align="right">
       <select name="khad_4" disabled="disabled" class="required" id="khad_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:فروشگاه تعاونی</div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="khad_9" disabled="disabled" class="required" id="khad_9" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="9">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_9=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_9=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:بانک </div></td>
     <td height="48" align="center"><div align="right">
       <select name="khad_8" disabled="disabled" class="required" id="khad_8" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_8=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_8=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:قهوه خانه</div></td>
     <td align="center"><div align="right">
       <select name="khad_7" disabled="disabled" class="required" id="khad_7" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_7=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_7=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:گوشت فروشی</div></td>
     </tr>
   <tr>
     <td width="140" align="center"><div align="right">
       <select name="khad_12" disabled="disabled" class="required" id="khad_12" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="12">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_12=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_12=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="199" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :جایگاه سوخت</div></td>
     <td width="122" align="center"><div align="right">
       <select name="khad_11" disabled="disabled" class="required" id="khad_11" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="11">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_11=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_11=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="150" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :تعمیرگاه ماشین آلات غیر کشاورزی</div></td>
     <td width="113" align="center"><div align="right">
       <select name="khad_10" disabled="disabled" class="required" id="khad_10" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="10">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($khad_10=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($khad_10=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="168" align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:تعمیرگاه ماشین آلات کشاورزی</div></td>
     </tr>
            </table>
              <p>
                <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
                <input type="hidden" name="previous" value="<?php echo $previous ;?>">
              </p>
              </div>
    </form>
</div>
			</div>
            	<div>
				<h4>ارتباطات و حمل و نقل</h4>
				<div>
                              <form action="" method="post" id="form9" name="form9">
              <div align="center">
            <table style="border:3px solid #069;" width="98%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
   <tr>
     <td width="140"  height="42" align="center"><div align="right">
       <select name="ertebat_3" disabled="disabled" class="required" id="ertebat_3" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="3">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_3=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_3=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td width="199"  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :دفتر مخابرات</div></td>
     <td width="122"  align="center"><div align="right">
       <select name="ertebat_2" disabled="disabled" class="required" id="ertebat_2" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="2">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_2=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_2=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="150"  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" > :دفتر پست </div></td>
     <td width="113"  align="center"><div align="right">
       <select name="ertebat_1" disabled="disabled" class="required" id="ertebat_1" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="1">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_1=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_1=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td width="168"  align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:صندوق پست</div></td>
     </tr>
   <tr>
     <td align="center"><div align="right">
       <select name="ertebat_6" disabled="disabled" class="required" id="ertebat_6" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="6">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_6=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_6=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
       </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دسترسی به روزنامه و مجله</div></td>
     <td height="40" align="center"><div align="right">
       <select name="ertebat_5" disabled="disabled" class="required" id="ertebat_5" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="5">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_5=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_5=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دسترسی عمومی به اینترنت</div></td>
     <td align="center"><div align="right">
       <select name="ertebat_4" disabled="disabled" class="required" id="ertebat_4" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="4">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_4=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_4=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center" dir="rtl"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:ICT روستایی</div></td>
     </tr>
   <tr>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td height="48" align="center"><div align="right">
       <select name="ertebat_8" disabled="disabled" class="required" id="ertebat_8" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="8">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_8=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_8=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دسترسی به ایستگاه راه آهن</div></td>
     <td align="center"><div align="right">
       <select name="ertebat_7" disabled="disabled" class="required" id="ertebat_7" style="height:40px ; width:100px ; font-size:11px ; color:#900 ; direction:rtl" tabindex="7">
         <option value="">انتخاب کنید</option>
         <option value="1"<?php if ($ertebat_7=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
         <option value="2"<?php if ($ertebat_7=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
         </select>
     </div></td>
     <td align="center"><div align="right" class="normalTextSmaller" style="margin-right:15px" >:دسترسی به وسیله نقلیه عمومی</div></td>
     </tr>
            </table>
              <p>
                <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ;?>" />
                <input type="hidden" name="previous" value="<?php echo $previous ;?>">
              </p>
              </div>
    </form>

                </div>
			</div>
		</div>
            <p>&nbsp;</p>
                   <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p>  
            <!-- Tabs -->
<?php } else { echo '<p style="color:red">'.'مجوز دسترسی به این صفحه را ندارید '.'</p>';}?>
    </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
