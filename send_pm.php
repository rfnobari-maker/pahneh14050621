<?php
// === بخش ۱: پردازش PHP (بالای صفحه) ===
include("lock_p1.php");

if(session_id() == '') {
    @session_start();
}

include('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran');

$file_send = '';
$mess = '';
$message_sent_successfully = false; 

function upload($file_id, $folder="", $types="") 
{
    if(!$_FILES[$file_id]['name']) return array('','No file specified');
    $file_title = $_FILES[$file_id]['name'];
    $ext = substr(strrchr(basename($file_title), '.'), 1);
    $no_file = $_POST['s_user'].'_'.jdate("md").'_'.date('Hi');
    $file_name = $no_file.'.' . $ext;
    $all_types = explode(",",strtolower($types));
    
    if($types && !in_array($ext,$all_types)) {
        return array('',$result = 'فايل غير مجاز');
    }

    $uploadfile = ($folder ? $folder . '/' : '') . $file_name;
    $result = 1;

    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد ";
    } else {
        if(!$_FILES[$file_id]['size']) {
            @unlink($uploadfile);
            $result = " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد ";
        } elseif ((($_FILES[$file_id]['size'])<1000) || (($_FILES[$file_id]['size'])>500000)) {
             $result = " حجم فایل ارسالی نباید از 1 کیلوبایت کمتر و از 500 کیلوبایت بیشتر باشد "; 
        } else {
            @chmod($uploadfile,0777);
        }
    }
    return array($file_name, $result);
}

// === پردازش فرم ===
$redirect_with_alert = false;

if (isset($_POST['action'])) {
    
    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
        
        unset($_SESSION['token']);
        
        $title   = isset($_POST['title']) ? trim($_POST['title']) : '';
        $s_user  = isset($_POST['s_user']) ? trim($_POST['s_user']) : '';
        $r_user  = isset($_POST['username']) ? trim($_POST['username']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        
        if(empty($title) || empty($message)) {
            $mess = "<br align='center'> <font size=3 color='#900' >لطفاً موضوع و متن پیام را وارد کنید</font></br>";
        } else {
            
            include('login/config.php');
            
            if (isset($dbh)) {
                $date_edit = jdate("Y/m/d");
                $time_now = date('H:i:s');
                
                // بررسی تکراری در 30 ثانیه اخیر
                $check_sql = "SELECT COUNT(*) as count FROM pm WHERE s_user = :s_user AND r_user = :r_user AND s_date = :s_date AND s_time >= :time_limit";
                $time_limit = date('H:i:s', strtotime('-30 second'));
                
                $check_stmt = $dbh->prepare($check_sql);
                $check_stmt->execute(array(
                    ':s_user' => $s_user,
                    ':r_user' => $r_user,
                    ':s_date' => $date_edit,
                    ':time_limit' => $time_limit
                ));
                $result_check = $check_stmt->fetch(PDO::FETCH_ASSOC);
                
                if($result_check['count'] > 0) {
                    $mess = "<br align='center'> <font size=3 color='#900' >شما چند لحظه قبل پیام ارسال کرده‌اید. لطفاً 30 ثانیه صبر کنید.</font></br>";
                    $message_sent_successfully = false;
                } else {
                    
                    $upload_error = false;
                    if($_FILES['pic']['name']) {
                        list($name,$result) = upload('pic','pm_files','jpg,jpeg,gif,png,JPG,JPEG,PNG,xlsx,xls,doc,docx,pdf');
                        if ($result == 1) {
                            $file_send = $name;
                        } else {
                            $mess = "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."</font></br>";
                            $upload_error = true;
                        }
                    }
                    
                    if (!$upload_error) {
                        $query = "INSERT INTO pm (file, title, r_user, s_user, message, no_pm, s_date, s_time) 
                                  VALUES (:file, :title, :r_user, :s_user, :message, :no_pm, :s_date, :s_time)";
                        $q = $dbh->prepare($query);
                        
                        if ($q->execute(array(
                            ':file' => $file_send,
                            ':title' => $title,
                            ':r_user' => $r_user,
                            ':s_user' => $s_user,
                            ':message' => $message,
                            ':no_pm' => '1',
                            ':s_date' => $date_edit,
                            ':s_time' => $time_now
                        ))) {
                            $message_sent_successfully = true;
                            $redirect_with_alert = true; // علامت برای هدایت با alert
                            
                            sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time_now, '', 'ارسال پیام / '.user_name($r_user), $id_ostan);
                        } else {
                            $mess = "<br align='center'> <font size=3 color='#900' >خطا: در ذخیره پیام مشکلی پیش آمد</font></br>";
                        }
                    }
                }
            } else {
                $mess = "<br align='center'> <font size=3 color='#900' >خطا: اتصال به دیتابیس برقرار نشد</font></br>";
            }
        }
    } else {
        $mess = "<br align='center'> <font size=3 color='#900' >درخواست تکراری تشخیص داده شد. صفحه را مجدداً بارگذاری کنید</font></br>";
    }
}

// اگر پیام با موفقیت ارسال شد، هدایت با جاوااسکریپت انجام میشه
if($redirect_with_alert) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <script>
            alert('✅ پیام شما با موفقیت ارسال شد');
            window.location.href = 'indexbenef.php';
        </script>
    </head>
    <body>
    </body>
    </html>
    <?php
    exit();
}

// === ایجاد توکن جدید ===
$token = md5(uniqid(rand(), true) . session_id());
$_SESSION['token'] = $token;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fa" xml:lang="fa">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo isset($title) ? $title : 'ارسال پیام'; ?></title>
    <script src="./assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var formSubmitted = false;
            
            $("#form1").validate({
                submitHandler: function(form) {
                    if(formSubmitted) {
                        return false;
                    }
                    
                    formSubmitted = true;
                    $('#submitBtn').val('در حال ارسال...').attr('disabled', 'disabled').css('opacity', '0.6');
                    
                    form.submit();
                }
            });
            
            $.validator.addMethod("IsDate",
                function (value, element) {
                    var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                    if (value.length == 0) return true;
                    else return result;
                },
                "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>
            );
            
            // جلوگیری از ارسال با کلید Enter
            $('input, textarea').keypress(function(e) {
                if (e.which == 13 && e.target.type != 'textarea') {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <style>
        #box { 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            width: 90%; 
            max-width: 600px; 
            background-color: #FFF; 
            margin: 20px auto; 
            border: 1px solid #E0E0E0; 
            border-radius: 8px; 
            padding: 20px;
        }
        .form-row { display: flex; align-items: center; padding: 10px 0; border-bottom: 1px solid #EEE; }
        .form-row:last-child { border-bottom: none; }
        .form-label { width: 100px; text-align: right; font-weight: bold; color: #333; padding-left: 10px; }
        .form-field { flex-grow: 1; }
        .input_text, textarea { width: 100%; padding: 10px; border: 1px solid #CCC; border-radius: 4px; box-sizing: border-box; font-family: Tahoma, sans-serif; font-size: 13px; }
        .input_text:focus, textarea:focus { border-color: #007bff; outline: none; }
        textarea { resize: vertical; min-height: 100px; }
        #submitBtn {
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            padding: 10px 20px; 
            cursor: pointer; 
            font-size: 16px; 
            width: 150px; 
            height: 45px;
        }
        #submitBtn:hover:not(:disabled) { background-color: #0056b3; }
        #submitBtn:disabled { background-color: #a0a0a0; cursor: not-allowed; opacity: 0.7; }
        .message-success { color: #006600; font-size: 14px; padding: 10px; text-align: center; background: #e8f5e8; border-radius: 5px; }
        .message-error { color: #990000; font-size: 14px; padding: 10px; text-align: center; background: #ffe8e8; border-radius: 5px; }
        .file-info { font-size: 11px; color: #555; text-align: center; margin-top: 5px; }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" alt="Header" style="display: block;" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"></td>
                        <td width="840">
                            <?php include('top.php'); ?>
                            
                            <?php if (isset($_POST['username']) || isset($_GET['username'])) : ?>
                                <?php 
                                $username = isset($_POST['username']) ? $_POST['username'] : (isset($_GET['username']) ? $_GET['username'] : '');
                                ?>
                                <br />
                                <h2>ارسال پیام</h2>
                                <p align="center"><img src="files/horizontal-line-700x223.png" width="700" height="19" alt="Line"/></p>
                                
                                <?php if(!empty($mess)): ?>
                                <p class="<?php echo ($message_sent_successfully) ? 'message-success' : 'message-error'; ?>">
                                    <?php echo $mess; ?>
                                </p>
                                <?php endif; ?>
                                
                                <form action="" method="post" enctype="multipart/form-data" id="form1" name="form1">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                                    
                                    <div id="box">
                                        <table width="100%" border="0" align="center">
                                            <tr class="form-row">
                                                <td width="129" height="66">
                                                    <img src="../files/users/<?php echo user_pic($username); ?>" width="57" height="64" alt="User Pic"/>
                                                </td>
                                                <td width="250" class="form-field">
                                                    <input name="title2" type="text" class="input_text" id="title2" tabindex="1" dir="rtl" value="<?php echo user_name($username).'&nbsp;&nbsp;';?>" readonly="readonly" />
                                                </td>
                                                <td><div align="right" class="form-label">: گیرنده</div></td>
                                            </tr>
                                            
                                            <tr class="form-row">
                                                <td height="49" colspan="2" class="form-field">
                                                  <input name="title" type="text" class="required input_text" id="title" tabindex="2" dir="rtl" value="<?php echo (isset($_POST['title']) && !$message_sent_successfully) ? htmlspecialchars($_POST['title']) : ''; ?>" maxlength="250" />
                                                </td>
                                                <td><div align="right" class="form-label">: موضوع پیام</div></td>
                                            </tr>
                                            
                                            <tr class="form-row">
                                                <td height="127" colspan="2" class="form-field">
                                                    <textarea name="message" class="required" id="textarea" cols="45" rows="5" dir="rtl"><?php echo (isset($_POST['message']) && !$message_sent_successfully) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                                                </td>
                                                <td><div align="right" class="form-label">:متن پیام</div></td>
                                            </tr>
                                            
                                            <tr class="form-row">
                                                <td height="37" colspan="2" class="form-field">
                                                    <input name="pic" type="file" id="pic" tabindex="4" accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG,.xlsx,.xls,.doc,.docx,.pdf" /> 
                                                </td>
                                                <td><div align="right" class="form-label">:پیوست فایل</div></td>
                                            </tr>
                                            
                                            <tr>
                                                <td height="24" colspan="3" class="file-info">
                                                    <span style="color:#007bff;">پسوند فایل های مجاز:</span> jpg, jpeg, gif, png, xlsx, xls, doc, docx, pdf | 
                                                    <span style="color:#007bff;">حداکثر حجم:</span> 500 کیلو بایت
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <div align="center" style="margin-top: 20px;">
                                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>" />
                                            <input type="hidden" name="s_user" value="<?php echo htmlspecialchars($login_session); ?>" />
                                            <input name="action" type="submit" id="submitBtn" tabindex="5" value="ارسال پیام" />
                                        </div>
                                    </div>
                                </form> 
                                <p>&nbsp;</p>
                                <p><a href="indexbenef.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47" alt="Go Back"/> </a></p>  
                                
                            <?php else : ?>
                                <br/>
                                <p align="center" style="color:red"> مجوز دسترسی به این صفحه را ندارید </p>
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>