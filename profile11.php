<?php 
// تضمین شده که lock_p1.php شامل session_start() و اعتبارسنجی کاربر است
include('lock_p1.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
	<link rel="stylesheet" href="jspc-gray.css">
	<script type="text/javascript" src="js-persian-cal.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <style type="text/css">
</style>
	<script src="./assets/js/jquery-3.6.0.min.js" type="text/javascript"></script> 
    <script src="15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>

    <style type="text/css">
</style>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu_profile.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
            <p>
              <?php
include('date_con.php');
include('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('login/config.php');

// فقط یک بار کوئری را برای دریافت تمام اطلاعات کاربر اجرا می‌کنیم
$query = "SELECT pic,username,ostan,city,markaz,cod_m,name,Last_name,jens,sh_sh,date_t,m_sodor,fname,m_tah,r_tah,univer,m_date,avre,v_tahol,cod_p,tel_s,tel_m,addres,shaba FROM users WHERE username=?";
$stmt = $dbh->prepare($query);
// استفاده از سینتکس array() سازگار با PHP 5.3
$stmt->execute(array($user_check)); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// استخراج متغیرها از $row
if ($row) {
    extract($row);
} else {
    // مدیریت خطا در صورت عدم یافتن کاربر
    die("خطا: اطلاعات کاربر یافت نشد.");
}

// **منطق آپلود و حذف تصویر از این فایل حذف شده و به image_handler.php منتقل شده است.**
?>
            </p>
            <p align="center" ><span class="style1">ویرایش اطلاعات کاربر</span><br />
            </p>
            <p align="center" class="RedTitleSmall" >تکمیل اطلاعات کاربری و آپلود عکس پرسنلی 
            الزامی است</p>
            <p align="center" ><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            
            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                    <td width="282" height="239" align="center" bgcolor="#FFFFFF">
                        <p align="justify" class="normalTextSmall" style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >تصویر کاربر </p>
                        <p align="justify" class="style2" style="direction:rtl; color:#900 ; margin-right:20px ; margin-left:20px" >- حجم فایل ارسالی نباید از 3 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد</p>
                        <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- برای تغییر تصویر موجود ، ابتدا تصویر قبلی را حذف نمایید .</p>
                        <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px">- پسوند فایل ارسالی با حروف کوچک تایپ شود</p>
                        <p align="justify" class="style2" style="direction:rtl ; color:#900; margin-right:20px ; margin-left:20px"> <a href="help.html" target="new" class="style8" >- راهنمای تبدیل پسوند فایل به حروف کوچک</a> <img src="files/jadid.gif" width="35" height="15"  alt=""/></p>
                    </td>
                    
                    <td width="257" align="center" bgcolor="#FFFFFF">
                        <div id="image_status_message" style="margin-bottom: 10px; color: red;"></div>
                        
                        <div id="image_container">
                            <?php if($pic <> ""): ?>
                                <img style="border:1px solid #021a40;" id="user_pic" 
                                     src="<?php echo '../files/users/'.$pic;?>?m=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'/files/users/'.$pic) ?>" 
                                     width="87" height="107"/>    
                                <p class="up_row">
                                    <button type="button" id="del_pic_btn" style="width:100px; height:30px ; font-family:Tahoma, Geneva, sans-serif ">حذف تصویر</button>
                                </p>
                            <?php else: ?>
                                <img style="border:1px solid #021a40;" id="user_pic" src="../files/users/no_pic.png" width="87" height="107"/>
                            <?php endif; ?>
                        </div>
                        
                        <form id="upload_form" enctype="multipart/form-data" style="margin-top: 10px;">
                            <input type="hidden" name="action_type" value="upload" />
                            <input type="hidden" name="username" value="<?php echo $username; ?>" />
                            
                            <input name="pic" type="file" id="pic_input" accept=".jpg,.JPG,.jpeg,.gif,.png" style="display:none;"/>
                            
                            <button type="button" id="select_file_btn" style="width:100px; height:30px;" 
                                <?php if($pic <> "") echo 'disabled="disabled"'; ?>>انتخاب فایل</button>
                            <button type="submit" id="upload_btn" style="width:100px; height:30px; display:none;">آپلود</button>
                        </form>
                    </td>
                </tr>
            </table>
            <form action="" method="post" id="form1" name="form1">
        <div align="center">
          <p>
    <input type="hidden" name="cod_p" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_p ;?>" />
          <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="48" colspan="5" class="style9" ><span style="color: #069"></span>
                <div style="margin-right:40px" align="right"><strong>اطلاعات محل خدمت </strong></div></td>
            </tr>
            <tr>
              <td width="319" height="48"><div align="right">
                <input name="city" type="text" id="city" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $city ?>" readonly />
              </div></td>
              <td width="148"><div align="right">:شهرستان </div></td>
              <td width="30">&nbsp;</td>
              <td width="237"><div align="right" >
                <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan ; ?>" maxlength="50" xml:lang="fa" readonly/>
              </div></td>
              <td width="158"><div style="margin-right:15px" align="right">: استان</div></td>
            </tr>
            <tr>
              <td height="48"><div align="right">
                <input name="cod_m" type="text" id="cod_m" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_m ?>" readonly />
              </div></td>
              <td><div align="right">: کد ملی</div></td>
              <td>&nbsp;</td>
              <td><div align="right">
                <input name="markaz" type="text" id="markaz" style="height:26px ; font-size:12px ; background:#0CF ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $markaz ?>" readonly />
              </div></td>
              <td><div style="margin-right:15px" align="right">: مرکز جهاد کشاورزی </div></td>
            </tr>
            <tr>
              <td height="38" colspan="5" align="center"><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></td>
            </tr>
            <tr>
              <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات کاربر</strong></div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <input name="last_name" type="text" class="required" style="width:200px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام خانوادگی</div></td>
              <td rowspan="8">&nbsp;</td>
              <td><div align="right">
                <input name="name" type="text" class="required" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $name ; ?>" maxlength="50" readonly xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: نام</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:شماره شناسنامه</div></td>
              <td><div align="right">
                <select name="jens" class="required" id="jens" style="height:40px ; width:100px ; direction:rtl" tabindex="3">
                  <option value="">انتخاب کنید</option>
                  <option value="مرد"<?php if ($jens=='مرد') { echo 'selected="selected"' ; } ?>>آقا</option>
                  <option value="زن"<?php if ($jens=='زن') { echo 'selected="selected"' ; } ?>>خانم</option>
                </select>
              </div></td>
              <td><div style="margin-right:15px" align="right" >: جنسیت</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="m_sodor" type="text" class="required" id="m_sodor" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_sodor ; ?>" maxlength="35" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:محل صدور</div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" > : تاریخ تولد</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right">
                <select name="m_tah" class="required" id="m_tah" style="height:40px ; width:150px ; direction:rtl" tabindex="8">
                  <option value="">انتخاب کنید</option>
                  <option value="4" <?php if ($m_tah=='4') { echo 'selected="selected"' ; } ?>>دیپلم</option>
                  <option value="5" <?php if ($m_tah=='5') { echo 'selected="selected"' ; } ?>>فوق دیپلم</option>
                  <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
                  <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
                  <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
                </select>
              </div></td>
              <td><div align="right">:مدرک تحصیلی</div></td>
              <td><div align="right">
                <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >: نام پدر</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="univer" type="text" class="required" id="univer" style="width:200px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $univer ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام دانشگاه</div></td>
              <td><div align="right">
                <input name="r_tah" type="text" class="required" id="r_tah" style="width:200px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="avre" type="text" class="required" id="avre" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $avre ; ?>" maxlength="5" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:معدل </div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="m_date" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $m_date ; ?>" maxlength="10" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:تاریخ اخذ مدرک</div></td>
            </tr>
            <tr>
              <td height="42"><div align="right">
                <input name="cod_p" type="text" class="required" id="cod_p" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $cod_p ; ?>" maxlength="35" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:کد پرسنلی</div></td>
              <td height="38"><div align="right">
                <select name="v_tahol" class="required" id="v_tahol" style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                  <option value="">انتخاب کنید</option>
                  <option value="1"<?php if ($v_tahol=='1') { echo 'selected="selected"' ; } ?>>متاهل</option>
                  <option value="2"<?php if ($v_tahol=='2') { echo 'selected="selected"' ; } ?>>مجرد</option>
                </select>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:وضعیت تاهل</div></td>
            </tr>
            <tr>
              <td height="38"><div align="right"><span class="style2"><img src="files/sms.png" width="28" height="32" /></span>
                <input name="tel_m" type="text" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa"  value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa" />
              </div></td>
              <td><div align="right">:شماره همراه</div></td>
              <td><div align="right">
                <input name="tel_s" type="text" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
            </tr>
            <tr>
              <td height="38" colspan="4"><div align="right">
                <input name="addres" type="text" class="required" id="addres" style="width:700px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="300" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:آدرس محل سکونت</div></td>
            </tr>
            <tr>
              <td width="319"></p></td>
            </tr>
            <tr>
              <td height="46" colspan="2" align="center">             <span id="tel_m_status" style="margin-right: 10px;"></span></td>
              <td align="center">&nbsp;</td>
              <td align="center"><div align="right">
                <input type="text" name="shaba" class="required digits" id="shaba" value="<?php echo $shaba ;?>" style=" height:30px;width:200px" tabindex="18" />
              </div></td>
              <td align="center"><div style="margin-right:15px" align="right" >:شماره شبا</div></td>
            </tr>
            <tr>
              <td height="30" align="center">&nbsp;</td>
              <td colspan="3" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
          </table>
          <p>
   <input type="hidden" name="username"  value="<?php echo $username ;?>" />
   <input type="hidden" name="previous" value="<?php echo $previous ;?>">
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="39" />
   </p>
   </p>
 </div>
    </form>
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		  </script>
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );
		  </script>
      <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal3' );
		  </script>
</td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
// فانکشن test_input از فایل اصلی برداشته شده و فرض می‌شود در lock_p1.php یا فایل دیگری موجود است

 if (isset($_POST['action'])) 
 {  
 $name = test_input($_POST['name']); 
 $last_name = test_input($_POST['last_name']); 
 $jens = test_input($_POST['jens']); 
 $sh_sh = test_input($_POST['sh_sh']); 
 $date_t = date_con(test_input($_POST['date_t'])); 
 $m_sodor = test_input($_POST['m_sodor']); 
 $fname = test_input($_POST['fname']); 
 $m_tah = test_input($_POST['m_tah']); 
 $r_tah = test_input($_POST['r_tah']); 
 $univer = test_input($_POST['univer']); 
 $m_date = date_con($_POST['m_date']); 
 $avre = test_input($_POST['avre']); 
 $v_tahol = test_input($_POST['v_tahol']); 
 $cod_p = test_input($_POST['cod_p']); 
 $tel_s = test_input($_POST['tel_s']); 
 $tel_m = test_input($_POST['tel_m']); 
 $addres = test_input($_POST['addres']); 
 $shaba = test_input($_POST['shaba']); 

{ 
include('login/config.php');
$query = "UPDATE users 
        SET  name=?,Last_name=?,jens=?,sh_sh=?,date_t=?,m_sodor=?,fname=?,m_tah=?,r_tah=?,univer=?,m_date=?,avre=?,v_tahol=?,cod_p=?,tel_s=?,tel_m=?,addres=?,shaba=?,valid=?
		WHERE username=?";
$q = $dbh->prepare($query);
// استفاده از سینتکس array() سازگار با PHP 5.3
$q->execute(array($name,$last_name,$jens,$sh_sh,$date_t,$m_sodor,$fname,$m_tah,$r_tah,$univer,$m_date,$avre,$v_tahol,$cod_p,$tel_s,$tel_m,$addres,$shaba,'200',$username
));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ویرایش اطلاعات کاربر',$id_ostan) ; 
alert('اطلاعات کاربری شما با موفقیت تصحیح شد ') ;
?>
<form name="myform" class="myform" method="post" action="indexbenef.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 }
 ?>
<?php if(isset($_GET["a"]))  
{
$string = 'برای استفاده از امکانات سامانه تکمیل اطلاعات کاربری و آپلود عکس پرسنلی الزامی است' ;
echo '<script type="text/javascript">alert("' . $string . '");</script>' ; 
}
?>
<script type="text/javascript">
$(document).ready(function() {
    
    // ===============================================
    // منطق آپلود و حذف تصویر با AJAX (بدون تغییر در PHP ورژن)
    // ===============================================
    
    // شبیه‌سازی کلیک روی input type="file"
    $('#select_file_btn').click(function() {
        if (!$(this).is(':disabled')) {
            $('#pic_input').click();
        }
    });

    // نمایش دکمه آپلود پس از انتخاب فایل
    $('#pic_input').change(function() {
        var $selectBtn = $('#select_file_btn');
        var $uploadBtn = $('#upload_btn');
        var $msg = $('#image_status_message');
        
        if ($(this).val()) {
            var file = this.files[0];
            var isValid = true;
            
            // اعتبارسنجی حجم سمت کلاینت (2KB تا 30KB)
            if (file && (file.size < 2000 || file.size > 30000)) {
                $msg.html('<span style="color: red;">❌ حجم فایل باید بین ۲ تا ۳۰ کیلوبایت باشد.</span>');
                isValid = false;
            } else {
                $msg.html('');
            }
            
            $uploadBtn.toggle(isValid);
            $selectBtn.text('فایل جدید انتخاب شد');

        } else {
            $uploadBtn.hide();
            $selectBtn.text('انتخاب فایل');
            $msg.html('');
        }
    });

    // ------------------------------------
    // آپلود تصویر با AJAX (با استفاده از FormData)
    // ------------------------------------
    $('#upload_form').submit(function(e) {
        e.preventDefault();
        
        if ($('#pic_input')[0].files.length === 0 || $('#upload_btn').is(':disabled')) {
             $('#image_status_message').html('<span style="color: red;">فایلی انتخاب نشده یا دارای اشکال حجم است.</span>');
             return;
        }

        var $msg = $('#image_status_message');
        $msg.html('<span style="color: blue;">در حال آپلود... لطفا صبر کنید.</span>');

        $.ajax({
            url: 'image_handler.php', 
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // فرض شده که image_handler.php یک JSON object برمی‌گرداند
                $msg.html(response.message);
                $('#image_container').html(response.html); // به‌روزرسانی تصویر و دکمه‌های حذف
                
                // به‌روزرسانی وضعیت دکمه‌ها
                if (response.is_uploaded) {
                    $('#select_file_btn').prop('disabled', true).hide();
                    $('#upload_btn').hide();
                } else {
                    $('#select_file_btn').prop('disabled', false).show();
                    $('#upload_btn').hide();
                }
                
                // پاک کردن ورودی فایل برای آپلود بعدی
                $('#pic_input').val(''); 
            },
            error: function() {
                $msg.html('<span style="color: red;">خطا در برقراری ارتباط با سرور.</span>');
            },
            dataType: 'json' 
        });
    });

    // ------------------------------------
    // حذف تصویر با AJAX (استفاده از Event Delegation)
    // ------------------------------------
    $(document).on('click', '#del_pic_btn', function() {
        if (!confirm('آیا مطمئنید می‌خواهید تصویر را حذف کنید؟')) {
            return;
        }

        var $msg = $('#image_status_message');
        $msg.html('<span style="color: blue;">در حال حذف...</span>');

        $.ajax({
            url: 'image_handler.php',
            type: 'POST',
            data: {
                'action_type': 'delete',
                'username': '<?php echo $username; ?>' 
            },
            success: function(response) {
                $msg.html(response.message);
                $('#image_container').html(response.html); // به‌روزرسانی به تصویر no_pic
                
                // فعال کردن دکمه‌های آپلود
                $('#select_file_btn').prop('disabled', false).show().text('انتخاب فایل');
                $('#upload_btn').hide();
            },
            error: function() {
                $msg.html('<span style="color: red;">خطا در برقراری ارتباط با سرور.</span>');
            },
            dataType: 'json'
        });
    });
    
    // ===============================================
    // منطق اعتبارسنجی شاهکار (کد اصلی شما)
    // ===============================================

    // متغیرهای وضعیت و المان‌ها
    var shahkar_match_status = null; 
    var $status = $('#tel_m_status'); 
    var $form = $('#form1'); 

    function validateTelMShahkar() {
        var $tel_m_input = $('#tel_m');
        var $cod_m_input = $('#cod_m');

        var tel_m_val = $tel_m_input.val();
        var cod_m_val = $cod_m_input.val();
        
        $status.html('');
        shahkar_match_status = null;

        if (tel_m_val.length !== 11 || tel_m_val.substring(0, 1) !== '0') {
            $status.html('<span style="color: red; font-weight: bold;">❌ شماره همراه باید ۱۱ رقم بوده و با صفر شروع شود.</span>');
            shahkar_match_status = false; 
            $tel_m_input.val(''); 
            $tel_m_input.focus(); 
            return; 
        }

        if (cod_m_val.length !== 10) {
            $status.html('<span style="color: red; font-weight: bold;">❌ کد ملی باید ۱۰ رقم باشد.</span>');
            shahkar_match_status = false;
            return; 
        }
        
        $status.html('<span style="color: blue;">در حال استعلام...</span>');

        $.ajax({
            type: 'POST',
            url: 'tel_m_valid.php', 
            data: {
                'tel_m': tel_m_val,
                'cod_m': cod_m_val
            },
            success: function(response) {
                var trimmedResponse = $.trim(response);
                if (trimmedResponse === 'success') {
                    $status.html('<span style="color: green; font-weight: bold;">✔ مطابقت دارد</span>');
                    shahkar_match_status = true; 
                } else {
                    shahkar_match_status = false; 
                    
                    if (trimmedResponse === 'no_match') {
                        $status.html('<span style="color: red; font-weight: bold;">✘ عدم مطابقت شماره/کد ملی</span>');
                        alert('شماره موبایل و کد ملی مطابقت ندارند. لطفاً شماره موبایل را مجدداً وارد کنید.');
                        $tel_m_input.val(''); 
                        $tel_m_input.focus();
                    } else {
                        $status.html('<span style="color: orange; font-weight: bold;">! خطای استعلام (فنی)</span>');
                        alert('خطای فنی در اعتبارسنجی رخ داد. لطفا دوباره تلاش کنید.');
                    }
                }
            },
            error: function() {
                $status.html('<span style="color: red; font-weight: bold;">خطا در برقراری ارتباط با سرور</span>');
                shahkar_match_status = false;
            },
             // افزودن این خط برای مدیریت درست فضاهای خالی
             dataType: 'text' 
        });
    }

    // --- منطق جلوگیری از ارسال فرم ---
    $form.submit(function(e) {
        // از آنجا که form1.validate() قبلاً فراخوانی شده، اگر خطایی نباشد، این بلوک اجرا می‌شود
        
        if (shahkar_match_status === false || shahkar_match_status === null) {
            e.preventDefault(); 
            if (shahkar_match_status === null) {
                 validateTelMShahkar();
            }
            alert('لطفاً خطاهای اعتبارسنجی شماره همراه و کد ملی را برطرف کنید.');
            return false;
        }
    });

    // فراخوانی تابع اعتبارسنجی هنگام از دست دادن فوکوس (blur) فیلدها
    $('#tel_m').on('blur', validateTelMShahkar);
    $('#cod_m').on('blur', validateTelMShahkar);

});
</script>