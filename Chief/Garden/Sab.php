<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');

// فقط متغیر ورودی سال زراعی باقی می‌ماند
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

// 1. تابع برای اجرای فرم‌های نمودار که نیاز به ارسال POST دارند (جایگزین target_popup)
function open_popup_for_form_submit(form) {
    // ابعاد پاپ‌آپ برای نمودار (بزرگ)
    window.open("null", "formpopup", "location=0,status=0,scrollbars=1,width=1000,height=800"); 
    form.target = 'formpopup';
}

// 2. تابع AJAX برای اجرای payesh_k و جلوگیری از نمایش آدرس در پاپ‌آپ
function run_pakesh_k_ajax() {
    // آدرس پاپ‌آپ باید خالی باشد تا آدرس فایل payesh_k نمایش داده نشود.
    // ابعاد 400x250 مناسب برای نمایش پیام استایل‌دار فارسی است.
    var popup = window.open("", "pakesh_result_popup", "location=0,status=0,scrollbars=0,width=400,height=350"); 
    if (!popup) {
        alert("لطفاً باز شدن پنجره‌های پاپ‌آپ را در مرورگر خود مجاز کنید.");
        return;
    }
    
    // نمایش پیام لودینگ فارسی در پنجره پاپ‌آپ، قبل از دریافت نتیجه
    popup.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>در حال به‌روزرسانی</title></head><body dir="rtl" style="font-family:Tahoma; text-align:center; padding-top:40px; background-color: #f7f7f7;"><h2>در حال اجرای عملیات...</h2><p style="font-size: 14px;">لطفاً صبر کنید. این فرآیند ممکن است چند ثانیه طول بکشد.</p></body></html>');
    
    // 3. اجرای فایل PHP در پس‌زمینه با AJAX
    // فرض می‌شود فایل payesh_k.php در همین دایرکتوری (در کنار Sab.php) است.
    $.ajax({
        url: '../../web/payesh_k.php', 
        type: 'POST',
        data: {}, 
        success: function(response) {
            // 4. تزریق HTML کامل (شامل استایل‌ها و پیام فارسی) که از payesh_k.php برگردانده شده است
            popup.document.open();
            popup.document.write(response);
            popup.document.close();
        },
        error: function(xhr, status, error) {
            // نمایش خطای سرور در پنجره پاپ‌آپ با استایل خطا
            var error_msg = 'خطای سرور: ' + (xhr.status === 0 ? 'عدم دسترسی به سرویس' : xhr.status + ' (' + error + ')');
            
            var error_html = '<!DOCTYPE html><html lang="fa" dir="rtl"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>خطا</title><style>body {font-family: Tahoma; text-align: center; background-color: #f0f0f0; margin: 0; padding: 0;} .message-box {width: 90%; max-width: 350px; margin: 20px auto; padding: 20px; border: 1px solid #cc0000; background-color: #ffeeee; color: #cc0000; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);} h3 { margin-top: 0; font-size: 16px; color: #cc0000;} .icon { font-size: 24px; display: block; margin-bottom: 10px;} button { padding: 8px 15px; margin-top: 15px; background-color: #cc0000; color: white; border: none; border-radius: 5px; cursor: pointer; font-family: Tahoma;}</style></head><body><div class="message-box"><span class="icon">❌</span><h3>خطا در اجرا</h3><p>' + error_msg + '</p><button onclick="window.close()">بستن پنجره</button></div></body></html>';
            
            popup.document.open();
            popup.document.write(error_html);
            popup.document.close();
        }
    });
}
</script>
    <style type="text/css">
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.column {
  float: left;
  width:12.25%;
  padding: 5px;
}
.row {
	width: 100%
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
/* جدول نتایج مدرن و واکنش‌گرا */
.agri-table {
  width: 95%;
  margin: 24px auto;
  border-collapse: collapse;
  font-family: Tahoma, Arial, sans-serif;
  font-size: 15px;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border-radius: 12px;
  overflow: hidden;
  /* direction: rtl; */
}
.agri-table th, .agri-table td {
  padding: 10px 8px;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
}
.agri-table th:last-child, .agri-table td:last-child {
  border-right: none;
}
.agri-table th {
  background: #006699;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}
.agri-table tr:nth-child(even) {
  background: #f9f9f9;
}
.agri-table tr:nth-child(odd) {
  background: #fff;
}
.agri-table tr:hover {
  background: #e6f2ff;
}
@media (max-width: 900px) {
  /* فقط فونت و سایز جدول را کوچک‌تر می‌کنیم، ساختار جدول حفظ شود */
  .agri-table {
    font-size: 13px;
  }
  .agri-table th, .agri-table td {
    padding: 8px 4px;
  }
  .agri-table tr { margin-bottom: 15px; }
  .agri-table td, .agri-table th {
    text-align: right;
    padding: 10px 5px;
    border: none;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
  }
  .agri-table th {
    background: #006699;
    color: #fff;
    font-size: 15px;
    border-radius: 0;
  }
}
/* استایل جدید برای ظرف دکمه‌های عملیات */
.action-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin: 20px auto;
    flex-wrap: wrap;
    direction: rtl;
}

.action-bar form {
    margin: 0;
}

.action-bar button {
    background: #ffffff;
    border: 1px solid #d0d7de;
    border-radius: 12px;
    padding: 10px 18px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    font-family: Tahoma;
    font-size: 13px;
    color: #333;
    outline: none; /* حذف کادر مشکی پیش‌فرض */
    min-width: 90px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* حذف کادر در حالت فوکوس */
.action-bar button:focus {
    outline: none;
}

/* افکت هاور عمومی */
.action-bar button:hover {
    background-color: #f8fbff;
    border-color: #006699;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* استایل اختصاصی برای دکمه اکسل */
.btn-excel:hover {
    border-color: #217346 !important;
    color: #217346 !important;
}

/* استایل اختصاصی برای دکمه رفرش */
.btn-refresh {
    background: #fffafa !important;
}
.btn-refresh:hover {
    border-color: #d32f2f !important;
}

.action-bar img {
    display: block;
    transition: transform 0.2s;
}

.action-bar button:hover img {
    transform: scale(1.1);
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <span class="style8">برنامه الگوی کشت ابلاغی محصولات باغی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="213" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected=selected'?>>1404</option>
                   </select>
                 </div>
                 </td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال </span></td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' />
                 </td>
               </tr>
             </table>
        </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action']) && !empty($z_sal))
 {
 $query = "
    SELECT 
        o.id_ostan,
        osn.ostan,
        SUM(o.s_nobar_dem) AS total_s_nobar_dem,
        SUM(o.s_nobar_abi) AS total_s_nobar_abi,

        SUM(o.s_bar_dem) AS total_s_bar_dem,
        SUM(o.s_bar_abi) AS total_s_bar_abi,

        SUM(o.t_dem) AS total_t_dem,
        SUM(o.t_abi) AS total_t_abi

    FROM Garden_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    WHERE o.z_sal = :z_sal
    GROUP BY o.id_ostan, osn.ostan
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal
));
$t_row = $stmt->rowCount();

if ($t_row > 0) {
?>
      <div class="action-bar">

    <button type="button" class="btn-refresh" onclick="run_pakesh_k_ajax()" title="به‌روزرسانی دیتابیس کود">
        <img src="../../files/refresh.jpg" width="40" height="40" alt="Refresh"/>
        <span>به‌روزرسانی</span>
    </button>

    <form action="payesh_chart.php" method="post" onsubmit="open_popup_for_form_submit(this)">
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button type="submit" title="نمودار کود">
            <img src="../../files/chart1.jpg" width="40" height="40" alt="Chart"/>
            <span>نمودار کود</span>
        </button>
    </form>

    <form action="Sab_bar_chart.php" method="post" onsubmit="open_popup_for_form_submit(this)">
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button type="submit" title="نمودار بارور">
            <img src="../../files/chart1.jpg" width="40" height="40" alt="Chart"/>
            <span>نمودار بارور</span>
        </button>
    </form>

    <form action="Sab_nobar_chart.php" method="post" onsubmit="open_popup_for_form_submit(this)">
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button type="submit" title="نمودار غیربارور">
            <img src="../../files/chart1.jpg" width="40" height="40" alt="Chart"/>
            <span>غیربارور</span>
        </button>
    </form>
    <form action="Sab_xls.php" method="post">
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button type="submit" class="btn-excel" title="دانلود اکسل">
            <img src="../../files/xls.png" width="40" height="40" alt="Excel"/>
            <span>خروجی اکسل</span>
        </button>
    </form>

</div>
            <table class="my-table" align="center">
              <tr class="text1">
                <td height="35" colspan="3" bgcolor="#006699">تولید کل / تن <br /></td>
                <td colspan="3" bgcolor="#006699"><p>سطح کل بارور  / هکتار<br /></p></td>
                <td colspan="3" bgcolor="#006699">سطح کل   غیر بارور/ هکتار</td>
                <td width="18%" rowspan="2" bgcolor="#006699">استان </td>
                <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="13%" bgcolor="#006699">مجموع</td>
                <td width="13%" bgcolor="#006699">دیم</td>
                <td width="13%" bgcolor="#006699">آبی</td>
                <td width="13%" bgcolor="#006699">مجموع</td>
                <td width="13%" bgcolor="#006699">دیم</td>
                <td width="13%" bgcolor="#006699">آبی</td>
                <td width="13%" bgcolor="#006699">مجموع</td>
                <td width="13%" bgcolor="#006699">دیم</td>
                <td width="13%" bgcolor="#006699">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                foreach($stmt as $row){
$grand_total_s_nobar  = $row['total_s_nobar_dem'] + $row['total_s_nobar_abi'] ;
$grand_total_s_bar  = $row['total_s_bar_dem'] + $row['total_s_bar_abi'] ;
$grand_total_t = $row['total_t_dem'] + $row['total_t_abi'] ; 

              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_t*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_s_bar*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_bar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_bar_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $grand_total_s_nobar*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_nobar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_s_nobar_abi']*1; ?></td>
                <td class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <?php
              $r++ ;
              }
              ?>
            </table>
            <p class="style2" align="center">
            <?php
} else {
    echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً سال را انتخاب و جستجو کنید.</p>';
}
 } else {
     echo '<p class="style8"></p>';
 }
?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>
</body>
</html>